<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function dashboard(){
        return view('expert.dashboard');
    }
    public function reports(){     
        $histories = \App\Models\SlotBook::where('expert_id',expertinfo()->id)->latest()->paginate(20);
        return view('expert.reports',compact('histories'));
    }
    public function reportpdf(){
        $histories = \App\Models\SlotBook::where('expert_id',expertinfo()->id)->latest()->paginate(100);
        $pdf = \PDF::loadView('expert.pdf.reports', array('histories' =>  $histories));
        return $pdf->download('expertbells-report.pdf'); 
        // return view('expert.pdf.reports',compact('histories'));  
    }

    /// PROFILE
    public function editprofile(){
        $currentUserInfo = \Location::get(myipaddress());
        $ccode = \App\Models\Country::where('status',1);
        if(!empty(expertinfo()->ccode)){ $ccode = $ccode->where('phonecode',expertinfo()->ccode); }
        else{
            if(!empty($currentUserInfo->countryCode)){ $ccode = $ccode->where('sortname',$currentUserInfo->countryCode); }
            else{
                $ccode = $ccode->where('phonecode',91);
            }
        }
        $ccode = $ccode->first();
        $countries = \App\Models\Country::where('status',1)->get();
        return view('expert.editprofile',compact('countries','ccode'));
    }
    public function account(){
        $expert = \App\Models\Expert::find(expertinfo()->id);
        $currentUserInfo = \Location::get(myipaddress());
        $countries = \App\Models\Country::where('status',1);
        if(!empty(expertinfo()->ccode)){ $countries = $countries->where('phonecode',expertinfo()->ccode); }
        else{
            if(!empty($currentUserInfo->countryCode)){ $countries = $countries->where('sortname',$currentUserInfo->countryCode); }
            else{
                $countries = $countries->where('phonecode',91);
            }
        }
        $countries = $countries->first();
        $languages = \App\Models\ExpertLanguage::where('expert_id',expertinfo()->id)->get();
        $roles = \App\Models\ExpertRole::where('expert_id',expertinfo()->id)->get();
        $industries = \App\Models\ExpertIndustry::where('expert_id',expertinfo()->id)->get();
        $expertise = \App\Models\ExpertExpertise::where('expert_id',expertinfo()->id)->get();
        return view('expert.account',compact('expert','countries','roles','industries','languages','expertise'));
    }
    public function addwhatexpect(){
        $whatexpects = \App\Models\WhatExpect::where(['is_publish'=>1,'expert_id'=>expertinfo()->id])->orderBy('sequence','ASC')->get(); 
        return view('expert.whatexpect',compact('whatexpects'));
    }
    public function otherinformation(){
        $qualifications = \App\Models\Qualification::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $workings = \App\Models\Working::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $expertise = \App\Models\Expertise::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $languages = \App\Models\Language::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $roles = \App\Models\Role::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $expert = \App\Models\Expert::find(expertinfo()->id);
        $expertiseArr=[];
        $languagesArr=[];
        $industriesArr=[];
        $roleArr=[];
        foreach($expert->expertise as $rl){
            array_push($expertiseArr,$rl->expertise_id);
        } 
        foreach($expert->languages as $lang){
            array_push($languagesArr,$lang->language_id);
        } 
        foreach($expert->industries as $indu){
            array_push($industriesArr,$indu->industry_id);
        } 
        foreach($expert->roles as $rol){
            array_push($roleArr,$rol->role);
        }
        return view('expert.otherinformation',compact('expert','roles','roleArr','industriesArr','languagesArr','expertiseArr','qualifications','workings','expertise','languages','industries'));
    }

    public function bankDetails(){
        $qualifications = \App\Models\Qualification::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $workings = \App\Models\Working::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $expertise = \App\Models\Expertise::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $languages = \App\Models\Language::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $roles = \App\Models\Role::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $expert = \App\Models\Expert::find(expertinfo()->id);
        $expertiseArr=[];
        $languagesArr=[];
        $industriesArr=[];
        $roleArr=[];
        foreach($expert->expertise as $rl){
            array_push($expertiseArr,$rl->expertise_id);
        } 
        foreach($expert->languages as $lang){
            array_push($languagesArr,$lang->language_id);
        } 
        foreach($expert->industries as $indu){
            array_push($industriesArr,$indu->industry_id);
        } 
        foreach($expert->roles as $rol){
            array_push($roleArr,$rol->role);
        }
        return view('expert.bankDetails',compact('expert','roles','roleArr','industriesArr','languagesArr','expertiseArr','qualifications','workings','expertise','languages','industries'));
    }

    /// VIDOES
    public function videos(){
        $videos = \App\Models\ExpertVideo::where('expert_id',expertinfo()->id)->orderBy('sequence','DESC')->get();        
        return view('expert.videos',compact('videos'));
    }
    public function addvideo(){
        $industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        return view('expert.addvideos',compact('industries'));
    }
    public function editvideo(Request $r){
        $industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get(); 
        $videos = \App\Models\ExpertVideo::find($r->id);    
        if(empty($videos)){ return "This video is not exists"; }    
        return view('expert.editvideos',compact('industries','videos'));
    }
    public function removevideo($id){
        $videos = \App\Models\ExpertVideo::find($id);
        if(!empty($videos->video)){
            if(file_exists(public_path('uploads/expert/video/'.$videos->video))){
                unlink(public_path('uploads/expert/video/'.$videos->video));
            }
        }
        if(!empty($videos->video_image)){
            if(file_exists(public_path('uploads/expert/video/'.$videos->video_image))){
                unlink(public_path('uploads/expert/video/'.$videos->video_image));
            }
            if(file_exists(public_path('uploads/expert/video/jpg/'.$videos->video_image.'.jpg'))){
                unlink(public_path('uploads/expert/video/jpg/'.$videos->video_image.'.jpg'));
            }
            if(file_exists(public_path('uploads/expert/video/'.$videos->video_image.'.webp'))){
                unlink(public_path('uploads/expert/video/'.$videos->video_image.'.webp'));
            }
        }
        $videos->delete();
        return back()->with('success','Video Removed!');
    }

    ///SLOTS
    public function slots(){
        $times = \App\Models\SlotTime::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $booktimes = \App\Models\SlotCharge::where(['expert_id'=>expertinfo()->id])->get();
        return view('expert.slots',compact('times','booktimes'));
    }
    public function removeavailability($id){
        $data = \App\Models\SlotAvailability::find($id);
        $data->delete();
        return back()->with('success','Availability Removed!');
    }
    public function slotinfo(){
        return view('expert.slot-info');
    }
    public function questionnaire($bookingid){
        $bookings = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id,'booking_id'=>$bookingid])->first();
        return view('expert.questionnaire',compact('bookings'));
    }
    public function copyslotfornextweek(){
        $startMonth = explode('-',request('start'));
        $endMonth = explode('-',request('end'));
        $data = \App\Models\SlotAvailability::where(['expert_id'=>expertinfo()->id]);
        $data = $data->whereMonth('date',$startMonth[1]);
        $data = $data->whereYear('date',$startMonth[0]);
        $data = $data->get();
        \App\Models\SlotAvailability::where(['expert_id'=>expertinfo()->id])
        ->where('date','>=',date('Y-m-d',strtotime('+ 1 week'.implode(',',$startMonth) )))
        ->where('date','<=',date('Y-m-d',strtotime('+ 1 week'.implode(',',$endMonth))))
        ->delete();
            
        foreach ($data as $key => $value) {
            $check = \App\Models\SlotAvailability::where(['expert_id'=>expertinfo()->id,'date'=>date('Y-m-d',strtotime('+ 1 week'.$value->date))])->first();
            if(empty($check)){
                $nextdata = new \App\Models\SlotAvailability();
                $nextdata->expert_id = expertinfo()->id;
                $nextdata->from_time = $value->from_time;
                $nextdata->to_time = $value->to_time;
                $nextdata->date = date('Y-m-d',strtotime('+ 1 week'.$value->date));
                $nextdata->day = date('D',strtotime('+ 1 week'.$value->date));
                $nextdata->is_publish = $value->is_publish;
                $nextdata->sequence = (\App\Models\SlotAvailability::where(['expert_id'=>expertinfo()->id])->max('sequence') + 1);
                $nextdata->save();
            }            
        }
        return back()->with(['success'=>'Slot saved for next month!']);
    }
    

    ///Schedels
    public function schedules(){
        $bookings = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id]);
        if(empty(request('type'))){
            $bookings = $bookings->whereIn('status',[1]);
            $bookings = $bookings->whereIn('reschedule_slot',[0]);
            $bookings = $bookings->where('booking_date','>=',date('Y-m-d'));
            $bookings = $bookings->where('booking_time','>=',date('Y-m-d H:i:s')); 
                } else{
            $bookings = $bookings->whereIn('status',[1,2,3]);
        } 
        $bookings = $bookings->orderBy('id','DESC');
        $bookings = $bookings->paginate(50);
        $experts = \App\Models\Expert::find(expertinfo()->id);
        $slots = \App\Models\SlotAvailability::where(['is_publish'=>1,'expert_id'=>$experts->id,'day'=>date('l',strtotime('Y-m-d'))])->get();
        return view('expert.schedule',compact('bookings','experts'));
    }
    public function rejectschedules(){
        $bookings = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id]);        
        $bookings = $bookings->where('reschedule_slot',0);
        $bookings = $bookings->where('call_invitation',0);        
        $bookings = $bookings->whereIn('status',[1,2]);
        $bookings = $bookings->paginate(50);
        $user = \App\Models\Expert::find(expertinfo()->id);
        return view('expert.schedule',compact('bookings','user'));
    }
    public function closeschedules(){
        // $bookings = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id,'reschedule_slot'=>0])->whereIn('status',[2,3])->orderBy('id','DESC')->paginate(50);
        $bookings = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id]);
        $bookings = $bookings->where('call_invitation','>',0);
        $bookings = $bookings->where('status','>',0);
        $bookings = $bookings->where('reschedule_slot',0);
        $bookings = $bookings->orderBy('id','DESC');
        $bookings = $bookings->paginate(50);
        $experts = \App\Models\Expert::find(expertinfo()->id);
        $slots = \App\Models\SlotAvailability::where(['is_publish'=>1,'expert_id'=>$experts->id,'day'=>date('l',strtotime('Y-m-d'))])->get();
        return view('expert.schedule',compact('bookings','experts'));
    }
    public function scheduleinfo($bookingid){
        $bookings = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id,'booking_id'=>$bookingid])->first();
        return view('expert.scheduleinfo',compact('bookings'));
    }
    public function reschedules(){
        $bookings = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id])->where('reschedule_slot','>',0)->orderBy('id','DESC')->paginate(50);
        $experts = \App\Models\Expert::find(expertinfo()->id);
        $slots = \App\Models\SlotAvailability::where(['is_publish'=>1,'expert_id'=>$experts->id,'day'=>date('l',strtotime('Y-m-d'))])->get();
        return view('expert.schedule',compact('bookings','experts'));
    }
    public function bookinginformation($bookingid){
        $bookings = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id,'booking_id'=>$bookingid])->first();
        if(empty($bookings)){
            return 'This slot is not available in our records.';
        }else{
            $html='';
            if($bookings->call_end_by==0){
                if($bookings->call_invitation==1){
                    $html .='<small class="text-success"><i class="fad fa-circle" style="font-size: 8px;"></i> Call Invitation Sent</small>';
                }
                if($bookings->call_invitation==2){
                    $html .='<small class="text-success"><i class="fad fa-circle" style="font-size: 8px;"></i> Invitation Accept & Join</small>';
                }
            }else{
                $html .='<small class="text-danger">';
                    $html .='This call is ended by '.($booking->call_end_by_type==1?'You ':'User ('.($booking->user_name ?? '').') on '.datetimeformat($booking->call_end));
                $html .='</small>';
            }
            $html .='<h6 class="title" style="font-size: 13px;font-weight: bold;"><u>BOOKING INFORMATION</u></h6>';
            $html .='<table class="table">';
                $html .='<tr>';
                    $html .='<td style="width: 145px;">Booking No: </td>';
                    $html .='<td>#'.$bookings->booking_id.'</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>Booking Date: </td>';
                    $html .='<td>'.dateformat($bookings->booking_date).'</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>Booking Time: </td>';
                    $html .='<td>'.substr($bookings->booking_start_time,0,-3).' to '.substr($bookings->booking_end_time,0,-3).'</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>Booking Amount: </td>';
                    $html .='<td>&#8377; '.$bookings->booking_amount.'</td>';
                $html .='</tr>';
                if($bookings->coupon_discount>0):
                $html .='<tr>';
                    $html .='<td>Booking Discount: </td>';
                    $html .='<td>&#8377; '.$bookings->coupon_discount.'</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>Paid Amount: </td>';
                    $html .='<td>&#8377; '.$bookings->paid_amount.'</td>';
                $html .='</tr>';                
                endif;
                $html .='<tr>';
                    $html .='<td>Payment: </td>';
                    $html .='<td>';
                        if($bookings->payment==0): $html .='<small class="text-secondary"><i class="fad fa-circle" style="font-size: 10px;"></i> Incomplete Process</small>'; endif;
                        if($bookings->payment==1): $html .='<small class="text-success"><i class="fad fa-circle" style="font-size: 10px;"></i> Paid</small>'; endif;
                        if($bookings->payment==2): $html .='<small class="text-danger"><i class="fad fa-circle" style="font-size: 10px;"></i> Failed</small>'; endif;
                    $html .='</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>Status: </td>';
                    $html .='<td>';
                        if(date('Y-m-d H:i:s') < date('Y-m-d H:i:s',strtotime($bookings->booking_date.' '.$bookings->booking_start_time))):
                            if($bookings->reschedule_slot==0): 
                                if($bookings->status==0): $html .='<small class="text-secondary">New</small>'; endif;
                                if($bookings->status==1): $html .='<small class="text-success">Confirm</small>'; endif;
                                if($bookings->status==2): $html .='<small class="text-danger">Rejected</small>'; endif;
                            else: 
                            $html.='<small class="text-danger">Reschedule</small> ';
                            if($bookings->reschedule_slot>0): 
                                $html.='<small class="text-success">(New booking #'.($bookings->reschedule->booking_id ?? 0).')</small>';
                            endif;
                            endif;
                            if($bookings->refund>0):
                                $html .='<small class="text-success ms-3">(Refunded &#8377; '.($bookings->refund ?? 0).')</small>';
                            endif;
                        endif;
                    $html .='</td>';
                $html .='</tr>';
                if($bookings->status==2):
                    $html .='<tr>';
                        $html .='<td>Reject Date: </td>';
                        $html .='<td>'.datetimeformat($bookings->reject_date).'</td>';
                    $html .='</tr>';
                    $html .='<tr>';
                        $html .='<td>Reject Reason: </td>';
                        $html .='<td>'.$bookings->reject_reason.'</td>';
                    $html .='</tr>';
                endif;
            $html .='</table>';
            $html .='<h6 class="title" style="font-size: 13px;font-weight: bold;"><u>USER INFORMATION</u></h6>';
            $html .='<table class="table">';
                $html .='<tr>';
                    $html .='<td style="width: 105px;">User Name: </td>';
                    $html .='<td>'.$bookings->user_name.'(#'.$bookings->user->user_id.')</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>User Email: </td>';
                    $html .='<td>'.$bookings->user_email.'</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>Contact No: </td>';
                    $html .='<td>'.$bookings->user_number.'</td>';
                $html .='</tr>';
                $html .='<tr>';
                    $html .='<td>User Query: </td>';
                    $html .='<td>'.$bookings->query.'</td>';
                $html .='</tr>';
                
            $html .='</table>';
            return $html;
        }
    }
    public function scheduleconfirm($confirm,$schedule){
        $data = \App\Models\SlotBook::find($schedule);
        if(empty($data)){ return back()->with('error','This schedule is not registered in our records.please choose correct schedule slot.'); }
        $data->status=$confirm;
        if($confirm==2){
            $data->reject_date=date('Y-m-d H:i:s');
            $data->reject_reason=request('reason');
        }
        $data->save();

        
        if($data->status==2){
            $html = '<b>Hi '.$data->user_name.'</b><br>';
            $html .= 'I just wanted to drop you a quick note to let you know that your booked schedule #'.$data->booking_id.' has been rejected by the '.ucwords(expertinfo()->name).'.<br>';
            // $html .= 'Don`t worry, we will soon assign your schedule to another expert And you will be informed about the same by email.';
            $html .= 'Don`t worry, we will refund you money in your expertbells wallet with in 1 hours.';
            $body = ['message'=>$html,'subject'=>'Schedules #'.$data->booking_id.' has been rejected' ];
            \Mail::to($data->user_email)->send(new \App\Mail\EnquiryMail($body));

            $user = \App\Models\User::find($data->user_id);
            if(!empty($user)){ $user->increment('wallet',$data->paid_amount); }
            

            $refund = new \App\Models\UserWalletHistory();
            $refund->transationno = generatetransationno();
            $refund->user_id = $data->user_id;
            $refund->amount = $data->paid_amount;
            $refund->type = 'refund';
            $refund->amounttype = 'c';
            $refund->is_publish = 1;
            $refund->sequence = (\App\Models\UserWalletHistory::max('sequence') + 1);
            $refund->save();

            \App\Models\SlotBook::find($schedule)->increment('refund',$data->paid_amount);
            /// ADMIN
            $html = '<b>Hi<br>';
            $html .= 'I just wanted to drop you a quick note to let you know that booked schedule #'.$data->booking_id.' has been rejected by the '.ucwords(expertinfo()->name).'.<br>';
            $body = ['message'=>$html,'subject'=>'Schedules #'.$data->booking_id.' has been rejected' ];
            \Mail::to(adminmail())->CC(ccadminmail())->send(new \App\Mail\EnquiryMail($body));
            return back()->with('success','This schedule has been rejected.');
        }
        
    }

     /// Help
    public function help(){
        $lists = \App\Models\HelpCenter::where(['type'=>1,'is_publish'=>1]);
        if(!empty(request('search'))){
            $search = request('search');
            $lists = $lists->where(function($q) use($search){
                $q->where('title','LIKE','%'.$search.'%');
                // $q->orwhere('description','Like','%'.$search.'%');
            });
        }
        $lists = $lists->paginate(50);
        return view('expert.help',compact('lists'));
    }


    /// GRAPH
    public function generatepiechart(){
        $scheduled = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id])->whereYear('booking_date',request('year'))->count();
        $closescheduled = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id])->where('call_end_by','>',0)->whereYear('booking_date',request('year'))->count();
        $rescheduled = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id])->whereYear('booking_date',request('year'))->where('reschedule_slot','>',0)->count();
        return response()->json([
            'data' => [$scheduled,$closescheduled,$rescheduled]
        ]);
    }
    public function scheduledchart(){
        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','DEC'];
        $result=[];
        foreach($months as $m => $month):
            $scheduled = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id]);
            $scheduled = $scheduled->whereMonth('booking_date',($m+1));
            $scheduled = $scheduled->whereYear('booking_date',request('year'));
            $scheduled = $scheduled->where('reschedule_slot',0);
            $scheduled = $scheduled->count();
            $result[]=$scheduled;
        endforeach;
        return response()->json([
            'data' => $result,
            'month' => $months
        ]);
    }
    public function rescheduledchart(){
        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','DEC'];
        $result=[];
        foreach($months as $m => $month):
            $scheduled = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id]);
            $scheduled = $scheduled->whereMonth('booking_date',($m+1));
            $scheduled = $scheduled->whereYear('booking_date',request('year'));
            $scheduled = $scheduled->where('reschedule_slot','>',0);
            $scheduled = $scheduled->count();
            $result[]=$scheduled;
        endforeach;
        return response()->json([
            'data' => $result,
            'month' => $months
        ]);
    }
    public function closescheduledchart(){
        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','DEC'];
        $result=[];
        foreach($months as $m => $month):
            $scheduled = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id]);
            $scheduled = $scheduled->whereMonth('booking_date',($m+1));
            $scheduled = $scheduled->whereYear('booking_date',request('year'));
            $scheduled = $scheduled->where('call_end_by','>',0);
            $scheduled = $scheduled->count();
            $result[]=$scheduled;
        endforeach;
        return response()->json([
            'data' => $result,
            'month' => $months
        ]);
    }
    public function generatematerialchart(){
        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','DEC'];
        foreach($months as $m => $month):
            $Booking = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id])->whereYear('booking_date',request('year'))->sum('paid_amount');
            $Tax = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id])->whereYear('booking_date',request('year'))->sum('gst_amount');
            $TDS = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id])->whereYear('booking_date',request('year'))->sum('tds_amount');;
            $Earning= ($Booking - $Tax - $TDS);
            $result[] = [$month, $Booking, $Tax, $TDS, $Earning];
        endforeach;
        return response()->json([
            'data' => $result,
        ]);
    }

    /// Wallet
    public function wallet(){
        $lists = \App\Models\ExpertWalletHistory::where(['expert_id'=>expertinfo()->id])->latest()->paginate(20);
        return view('expert.wallet',compact('lists'));
    }

    /// MESSAGE
    public function message($type=null){  

        $lists = \App\Models\ComposeMessage::where(function($q) use ($type){                        
            if(!in_array($type,['sent','star','trash','archive',''])){
                $q->where('id',base64_decode($type));
            }elseif($type=='sent'){
                $q->where('archive_expert',0);
                $q->where('delete_expert',0);
                $q->where('send_by',1);
            }elseif($type=='archive'){
                $q->orwhere('archive_expert',1);                
            }elseif($type=='trash'){
                $q->orwhere('delete_expert',1);                
            }else{
                $q->where('archive_expert',0);
                $q->where('delete_expert',0);   
                $q->where('send_by',2);            
            }
        }); 
        if(!empty(request('search'))){
            $search = request('search');
            $lists = $lists->where(function($r) use ($search){
                $r->orwhere('subject','LIKE','%'.$search.'%');
                $users = \App\Models\User::where('email','LIKE','%'.$search.'%')->orwhere('name','LIKE','%'.$search.'%')->paginate(10);
                foreach($users as $user){
                    $r->orwhere('user_id',$user->id);
                }
            });
        }
        $lists = $lists->where('expert_id',expertinfo()->id);  
        $lists = $lists->orderBy('sequence','DESC')->paginate(50); 

        $unread = \App\Models\ComposeMessage::where(function($q){
            $q->where('read_to',0);
            $q->where('expert_id',expertinfo()->id);
            $q->where('archive_expert',0);
            $q->where('delete_expert',0);   
            $q->where('send_by',2);
        });
        $unread = $unread->count(); 
        if(in_array($type,['sent','star','trash','archive',''])){
            return view('expert.message',compact('lists','unread'));
        }else{
            return view('expert.message-detail',compact('lists','unread'));
        }
        
    }

    //// VIDEO CALL
    public function videocall($schedule=null){
        if(empty($schedule)){ abort(404);}
        $checkbooking = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id,'booking_id'=>$schedule])->first();
        $permission=1;
        $errormsg='';
        if(empty($checkbooking)){ abort(404); }
        return view('expert.videocall.call',compact('permission','errormsg','checkbooking'));
    }    
}