<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ScheduleController extends Controller{
    public function index($type=null){
        $lists = \App\Models\SlotBook::latest();
        if($type=='booked'){ 
            $lists = $lists->whereIn('status',[0,1])->where(function($q){                
                $q->where('booking_time','>=',date('Y-m-d H:i:s'));
            });  
        }
        if($type=='closed'){ 
            $lists = $lists->where(function($q){
                $q->where('call_invitation','>',0);
                $q->where('reschedule_slot',0);
                $q->where('status','>',0);
            });  
        }
        if($type=='reschedule'){ 
            $lists = $lists->where(function($q){
                $q->where('reschedule_slot','>',0);
            });  
        }
        if($type=='rejected'){ 
            $lists = $lists->whereIn('status',[2]);            
            $lists = $lists->where('reschedule_slot',0);
        }
        if($type=='expired'){ 
            $lists = $lists->where('booking_time','<',date('Y-m-d H:i:s'));
            $lists = $lists->where('call_invitation',0);        
            $lists = $lists->whereIn('status',[0,1]);
            $lists = $lists->where('reschedule_slot',0);
        }
        if(!empty(request('month'))){ $lists = $lists->whereMonth('booking_date',request('month')); }
        if(!empty(request('year'))){ $lists = $lists->whereYear('booking_date',request('year')); }
        
        $lists = $lists->paginate(20);
        return view('admin.schedules.list',compact('lists'));
    }
    public function information(Request $r){
        $lists = \App\Models\SlotBook::find($r->id);
        if(empty($lists)){ return 'This schedules is not available in our records.'; }
        return view('admin.schedules.information',compact('lists'));
    }
    public function assignexpert(Request $r){
        $lists = \App\Models\SlotBook::find($r->id);
        if(empty($lists)){ return 'This schedules is not available in our records.'; }
        $experts = \App\Models\Expert::where('is_publish',1)->get();
        // ->whereNotIn('id',[$lists->expert_id])
        return view('admin.schedules.assignexpert',compact('lists','experts'));
    }
    public function assignexpertinfo(Request $r){
        $lists = \App\Models\Expert::find($r->expert);
        $booking = \App\Models\SlotBook::find($r->booking);
        $availability = \App\Models\Slotavailability::where(['expert_id'=>$lists->id,'day'=>date('l',strtotime($booking->booking_date))])->get();
        
        if(!empty($lists)){
            $from_time = strtotime($booking->booking_date.' '.$booking->booking_start_time); 
            $to_time = strtotime($booking->booking_date.' '.$booking->booking_end_time); 
            $diff_minutes = round(abs($from_time - $to_time) / 60,2);
            $html='';
            $html .='<hr>';            
            $html .='<h6 class="card-title tx-uppercase tx-12 my-3">Expert Slot Charges</h6>';
            if(!empty($lists->slotcharges)):
                foreach($lists->slotcharges as $key => $slotcharges):
                    if($diff_minutes==$slotcharges->time->minute){
                        $html .='<small><b>'.$slotcharges->time->minute.' Minutes : </b> '.defaultcurrency().' '.$slotcharges->charges.' <i class="far fa-check"></i></small><br>';
                    }else{
                        $html .='<small><b>'.$slotcharges->time->minute.' Minutes : </b> '.defaultcurrency().' '.$slotcharges->charges.'</small><br>';
                    }
                endforeach;
            else:
                $html .='<p>'.$lists->name.' has not yet added slot charges.</p>';
            endif;
            $html .='<hr>';
            $html .='<h6 class="card-title tx-uppercase tx-12 my-3">Expert Availability</h6>';
            if($availability->count()==0){
                $html .='<div class="col-12 my-3 text-danger">
                            <small>'.$lists->name.' is not available on '.date('F, d, Y',strtotime($booking->booking_date)).'.</small>
                        </div>';
            } 
            if($availability->count()>0){
                $html .='<div class="col-12 my-3 text-success">
                            <small>'.$lists->name.' is available on '.date('F, d, Y',strtotime($booking->booking_date)).'.</small>
                        </div>';
            } 
            $html .='<hr>';

            return response()->json([
                'html' => $html,
                'availability' => $availability->count()
            ]);
        }
    }
    public function reassignexpert(Request $r){
        $bookingid = $r->id;
        $newexpert = $r->expert;
        $booking = \App\Models\SlotBook::find($bookingid)->toArray();
        $newbooking = \App\Models\SlotBook::create($booking);

        $data = \App\Models\SlotBook::find($newbooking->id);
        $data->booking_id = generatebookingno();
        $data->status = 0;
        $data->reject_date = Null;
        $data->reject_reason = Null;
        $data->created_at = date('Y-m-d H:i:s');
        $data->updated_at = date('Y-m-d H:i:s');
        $data->save();

        $predata = \App\Models\SlotBook::find($bookingid);
        $predata->reassign_slot = $data->id;
        $predata->save();

        return response()->json([
            'success' => $data->expert->name.' has been assigned booking #12542.'
        ]);
    }
    public function destroy($id){
        $data =  \App\Models\SlotBook::find($id);
        if(!empty($data->reschedule)){
            return back()->with(['error'=>'You cannot remove this slot because this slot has been rescheduled!']);
        }
        if(!empty($data->prereschedule)){
            return back()->with(['error'=>'You cannot remove this slot because this slot has been rescheduled!']);
        }
        if($data->payment==3){
            $user = \App\Models\User::find($data->user_id);
            $user->increment('wallet',$data->paid_amount);
        }
        $data->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
}
