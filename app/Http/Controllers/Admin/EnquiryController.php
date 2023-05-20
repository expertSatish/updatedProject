<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function enquiry($type){
        if(empty($type)){ abort(404); }
        else{
            if($type=='comments'){ return $this->BlogComment(); }
            if($type=='jobs'){  return $this->Jobs(); }
            if($type=='newsletter'){  return $this->Newsletter(); }
            if($type=='contact'){  return $this->Contact(); }
            abort(404);
        }
    }
    public function enquiryinfo($type){
        if(empty($type)){ abort(404); }
        else{
            if($type=='comments'){ 
                $lists = \App\Models\BlogComment::find(request('id'));
                return view('admin.enquiry.commentinfo',compact('lists'));
            }
            if($type=='jobs'){
                $lists = \App\Models\JobApply::find(request('id'));
                return view('admin.enquiry.jobinfo',compact('lists'));
            }
            abort(404);
        }
    }
    public function publish($type,Request $request){
        if(empty($type)){ abort(404); }
        else{
            if($type=='comments'){ 
                \App\Models\BlogComment::where('id',$request->id)->update(['is_publish'=>$request->status]);
            }
            if($type=='jobs'){  
                \App\Models\JobApply::where('id',$request->id)->update(['is_publish'=>$request->status]);
            }
            return response()->json([
                'success_msg' => 'Status have been updated!'
            ]);
        }
    }
    public function sequence($type,Request $request){
        if(empty($type)){ abort(404); }
        else{
            if($type=='comments'){ 
                foreach($request->sequence as $id => $sequence){
                    $data = \App\Models\BlogComment::find($id);
                    $data->sequence = $sequence;
                    $data->save();
                }
            }
            if($type=='jobs'){ 
                foreach($request->sequence as $id => $sequence){
                    $data = \App\Models\JobApply::find($id);
                    $data->sequence = $sequence;
                    $data->save();
                }
            }
            return back()->with(['success'=>'Sequence have been updated!']);
        }
    }
    public function bulkdestory($type,Request $request){
        if(empty($type)){ abort(404); }
        else{
            if(empty($request->check)){ return back()->with(['error' => 'Please choose at least one data.']); }
            if($type=='comments'){ 
                foreach($request->check as $removeId){
                    $data = \App\Models\BlogComment::find($removeId);
                    $data->delete();
                }
            }
            if($type=='jobs'){ 
                foreach($request->check as $removeId){
                    $data = \App\Models\JobApply::find($removeId);
                    $data->delete();
                }
             }
            if($type=='contact'){ 
                foreach($request->check as $removeId){
                    $data = \App\Models\ContactInquiry::find($removeId);
                    $data->delete();
                }
            }
            if($type=='newsletter'){  
                foreach($request->check as $removeId){
                    $data = \App\Models\Newsletter::find($removeId);
                    $data->delete();
                }
            }
            if($type=='withdrawal'){  
                foreach($request->check as $removeId){
                    $data = \App\Models\WithdrawalRequest::find($removeId);
                    $data->delete();
                }
            }
            if($type=='claim'){  
                foreach($request->check as $removeId){
                    $data = \App\Models\ClaimRequest::find($removeId);
                    $data->delete();
                }
            }
            if($type=='deposit'){  
                foreach($request->check as $removeId){
                    $data = \App\Models\UserWalletHistory::find($removeId);
                    $data->delete();
                }
            }
            return back()->with(['success'=>'Data have been removed!']);
        }
    }
    public function BlogComment(){
        $lists = \App\Models\BlogComment::latest()->paginate(20);
        return view('admin.enquiry.comments',compact('lists'));
    }
    
    public function Jobs(){
        $lists = \App\Models\JobApply::latest()->paginate(20);
        return view('admin.enquiry.job',compact('lists'));
    }
    public function Contact(){
        $lists = \App\Models\ContactInquiry::latest()->paginate(20);
        return view('admin.enquiry.contact',compact('lists'));
    }
    public function Newsletter(){
        $lists = \App\Models\Newsletter::latest()->paginate(20);
        return view('admin.enquiry.newsletter',compact('lists'));
    }

    public function wallet($type){
        if($type=='deposit'){ return $this->depositrequest(); }
        if($type=='withdrawal'){ return $this->withdrawalrequest(); }
        if($type=='claim'){ return $this->claimrequest(); }
        abort(404);
    }
    public function depositrequest(){
        $lists = \App\Models\UserWalletHistory::where('type','deposit')->latest()->paginate(20);
        return view('admin.wallet.deposit',compact('lists'));
    }
    public function withdrawalrequest(){
        $lists = \App\Models\WithdrawalRequest::latest()->paginate(20);
        return view('admin.wallet.withdrawal',compact('lists'));
    }
    public function withdrawal_status($id,$status){
        $data = \App\Models\WithdrawalRequest::find($id);
        $data->is_publish = $status;
        $data->save();

        $userhistorydata = \App\Models\UserWalletHistory::where(['is_publish'=>0,'type'=>'withdrawal'])->first();
        $userhistory = \App\Models\UserWalletHistory::find($userhistorydata->id);
        $userhistory->is_publish = $status;
        $userhistory->save();

        if($status==1){

            $user = \App\Models\User::find($data->user_id);
            $user->decrement('wallet',$data->amount);
            
            if(!empty($data->user)){
                $Message ='Dear '.$data->user->name.',<br>';
                $Message .='Your withdrawal request has been approved by '.project().' and your withdrawal amount debited in your account soon.<br><br>';
                $Message .='if your withdrawal amount not debited in your account please wait 48 hours.<br>';
        
                $mailData = [
                    'subject' => 'Your withdrawal request approved : '.project().'.',
                    'message' => $Message
                ];         
                \Mail::to($data->user->email)->send(new \App\Mail\EnquiryMail($mailData));
            }
            
        }
        if($status==2){
            if(!empty($data->user)){
                $Message ='Dear '.$data->user->name.',<br><br>';
                $Message .='Your withdrawal request has been rejected by '.project().'.<br>';
                
                $mailData = [
                    'subject' => 'Your withdrawal request rejected : '.project().'.',
                    'message' => $Message
                ];         
                \Mail::to($data->user->email)->send(new \App\Mail\EnquiryMail($mailData));
            }
        }
        return back()->with('success','withdrawal status has been updated!');
    }
    public function claimrequest(){
        $lists = \App\Models\ClaimRequest::latest()->paginate(20);
        return view('admin.wallet.claim',compact('lists'));
    }
}