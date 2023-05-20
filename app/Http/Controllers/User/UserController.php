<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LoveyCom\CashFree\PaymentGateway\Order;

class UserController extends Controller
{
    public function userregister2(){
        $lists = \App\Models\Role::where('is_publish',1)->orderBy('sequence','ASC')->get();
        return view('auth.user.user-register-second',compact('lists'));
    }
    public function savestep2(Request $r){
        $r->validate([
            'role' => 'required',
        ]);
        $user = \App\Models\User::find(userinfo()->id);
        $user->role = $r->role ?? 0;
        $user->save();
        return redirect()->route('user.userregister3');
    }
    public function userregister3(){
        $industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get();
        return view('auth.user.user-register-third',compact('industries'));
    }    
    public function savestep3(Request $r){
        $r->validate([
            'industry' => 'required',
        ]);
        $user = \App\Models\User::find(userinfo()->id);
        $user->industry = $r->industry ?? 0;
        $user->save();
        return redirect()->route('user.userregister4');
    }
    public function userregister4(){
        $lists = \App\Models\GetBetter::where('is_publish',1)->orderBy('sequence','ASC')->get();
        return view('auth.user.user-register-fourth',compact('lists'));
    }    
    public function savestep4(Request $r){
        $r->validate([
            'get_better' => 'required',
        ]);
        $user = \App\Models\User::find(userinfo()->id);
        $user->get_better = json_encode($r->get_better) ?? 0;
        $user->save();  
        return redirect()->route('user.userregister5');
    }
    public function userregister5(){
        $lists = \App\Models\HearAbout::where('is_publish',1)->orderBy('sequence','ASC')->get();
        return view('auth.user.user-register-fifth',compact('lists'));
    }    
    public function savestep5(Request $r){
        $r->validate([
            'hear_about_us' => 'required',
        ]);
        $user = \App\Models\User::find(userinfo()->id);
        $user->hear_about_us = json_encode($r->hear_about_us) ?? 0;
        $user->save();  
        return redirect()->route('user.userregister6');
    }
    public function userregister6(){
        return view('auth.user.user-register-sixth');
    }    
    public function savestep6(Request $r){
        $r->validate([
            'growth_challenge' => 'required',
        ]);
        $user = \App\Models\User::find(userinfo()->id);
        $user->growth_challenge = $r->growth_challenge ?? '';
        $user->complete_profile = 1;
        $user->save();

        $body = ['user'=>$user ];
        \Mail::to($user->email)->send(new \App\Mail\Completeprofile($body));

        return redirect()->route('user.dashboard');
    }
    public function userlogout(){
        session()->flash('success','Thank you for coming!');      
        \Auth::logout();
        return redirect()->route('login');
    }

    //// SCHEDULE

    public function bookingrescheduleprocess(Request $r){
        $bookingid = $r->bookingid;
        $booking = \App\Models\SlotBook::find($bookingid)->toArray();
        $oldbooking = \App\Models\SlotBook::find($bookingid);
        $newbooking = \App\Models\SlotBook::create($booking);

        $data = \App\Models\SlotBook::find($newbooking->id);
        $data->booking_id = generatebookingno();
        $data->status = 1;
        $data->reject_date = Null;
        $data->reject_reason = Null;
        $data->booking_time = $r->booking_date.' '.explode('-',$r->timing)[1];
        $data->booking_start_time = explode('-',$r->timing)[0] ?? '';
        $data->booking_end_time = explode('-',$r->timing)[1] ?? '';
        $data->booking_date = $r->booking_date;
        $data->created_at = date('Y-m-d H:i:s');
        $data->updated_at = date('Y-m-d H:i:s');
        $data->reschedule_by = 2;
        $data->save();

        $predata = \App\Models\SlotBook::find($bookingid);
        $predata->reschedule_slot = $data->id;
        $predata->save();

        $body = ['booking' => $data,'oldbooking'=>$oldbooking,'schedule'=> $data->user->name ?? 'Customer' ];
        \Mail::to($data->expert->email)->send(new \App\Mail\Expert\Reschedule($body));
        \Mail::to(adminmail())->CC(ccadminmail())->send(new \App\Mail\Admin\Reschedule($body));

        return response()->json([
            'success' => 'Booking has been reschedule with booking #'.$data->booking_id.'.'
        ]);
    }
    public function schedulequeries(Request $request){
        $request->validate([
            'startup' => 'required',
            'facing_challenges' => 'required',
            'ask_questions' => 'required',
            'experience' => 'required',
            'attachment'=>'nullable|max:10000|mimes:doc,docx,pdf'
        ]);
        
        if(!empty($request->attachment)){
            $FileName = directFile('uploads/booking-attachment/',$request->attachment);
        }
        $data = \App\Models\SlotBook::find($request->booking);
        $data->query = $request->startup;
        $data->facing_challenges_query = $request->facing_challenges;
        $data->ask_question_query = $request->ask_questions;
        $data->experience_query = $request->experience;
        if(!empty($request->attachment)){
            $data->query_attachment = $FileName;
        }
        $data->save();
        return back()->with(['success'=>'Query details has been updated!']);
    }

    /// PROFILE
    public function countrystates(Request $r){
        $states = \App\Models\State::where(['status'=>1,'country_id'=>$r->country])->get();
        $Html='<option value="">Choose State</option>';
        foreach($states as $state){
            $Html .='<option value="'.$state->id.'" '.(userinfo()->state==$state->id?'selected':'').' >'.$state->name.'</option>';
        }
        return response()->json([
            'data'=>$Html
        ]);
    }
    public function statecities(Request $r){
        $cities = \App\Models\City::where(['status'=>1,'state_id'=>$r->state])->get();
        $Html='<option value="">Choose City</option>';
        foreach($cities as $city){
            $Html .='<option value="'.$city->id.'" '.(userinfo()->city==$city->id?'selected':'').' >'.$city->name.'</option>';
        }
        return response()->json([
            'data'=>$Html
        ]);
    }
    public function emailnotification(Request $r){
        $data = \App\Models\User::find(userinfo()->id);
        $data->email_notification = $r->permission ;
        $data->save();
        if($r->permission==0){ $message='Permission De-Actived';}
        if($r->permission==1){ $message='Permission Actived';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function mobilenotification(Request $r){
        $data = \App\Models\User::find(userinfo()->id);
        $data->mobile_notification = $r->permission ;
        $data->save();
        if($r->permission==0){ $message='Permission De-Actived';}
        if($r->permission==1){ $message='Permission Actived';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function deleteaccount(Request $r){
        $data = \App\Models\User::find(userinfo()->id);
        $data->delete();
        if($r->permission==0){ $message='Account Restore Deleted';}
        if($r->permission==1){ $message='Account Deleted';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function updateotherinformation(Request $r){
        $r->validate([
            'designation' => 'required',
            'industry' => 'required',
            'company_name' => 'required',
            'stage_of_startup' => 'required',
            'gst_number' => 'required',
        ]); 
        $data = \App\Models\User::find(userinfo()->id);
        $data->designation = $r->designation ;
        $data->industry = $r->industry ;
        $data->company_name = $r->company_name;
        $data->stage_of_startup = $r->stage_of_startup ;
        $data->gst_number = $r->gst_number ;
        $data->objectives = implode(',', $r->objectives);
        $data->save();
        return response()->json([
            'success'=>'Information Updated!'
        ]);
    }
    public function updateprofile(Request $r){
        $r->validate([
            'profile_name' => 'required|max:255|string',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,'.userinfo()->id.',id,deleted_at,NULL',
            'mobile' => 'required|min:8|unique:users,mobile,'.userinfo()->id.',id,deleted_at,NULL',
            'gender' => 'required',
            'dob' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ],[
            'profile_name.required'=>'profile name is required.',
            'email.required'=>'email address is required.',
            'mobile.required'=>'mobile number is required.',
            'gender.required'=>'gender is required.',
            'dob.required'=>'dob is required.',
            'country.required'=>'country is required.',
            'state.required'=>'state is required.',
            'city.required'=>'city is required.',
            'email.unique' => 'this email address already exists.',
            'mobile.unique' => 'this mobile number already exists.',
        ]);

        $data = \App\Models\User::find(userinfo()->id); 
        $data->name = $r->profile_name;
         $data->user_id = auth()->user()->user_id;
        $data->email = $r->email;
        $data->mobile = $r->mobile;
        $data->ccode = $r->ccode;
        $data->country = $r->country;
        $data->state = $r->state;
        $data->city = $r->city;
        $data->gender = $r->gender;
        $data->dob = (!empty($r->dob) ? date('Y-m-d',strtotime($r->dob)) : NULL);
        if(!empty($r->profile)){
            $extension =  $r->profile->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $FileName = directFile('uploads/user/',$r->profile);
            }else{
                $FileName = autoheight('uploads/user/',476,$r->profile);
            }
            if(!empty(userinfo()->profile)){
                if(file_exists(public_path('uploads/user/'.userinfo()->profile))){
                    unlink(public_path('uploads/user/'.userinfo()->profile));
                }
                if(file_exists(public_path('uploads/user/jpg/'.userinfo()->profile.'.jpg'))){
                    unlink(public_path('uploads/user/jpg/'.userinfo()->profile.'.jpg'));
                }
                if(file_exists(public_path('uploads/user/'.userinfo()->profile.'.webp'))){
                    unlink(public_path('uploads/user/'.userinfo()->profile.'.webp'));
                }
            }
            $data->profile = $FileName;
            
        }
        $data->complete_profile=1;
        $data->save();
        return response()->json([
            'success'=>'Information Updated!'
        ]);
    }
    
    /// REVIEWS
    public function reviews(Request $r){
        $r->validate([
            'rating' => 'required',
            'expert' => 'required',
            'message' => 'required'
        ],[
            'rating.required'=>'rating filed is required.',
            'expert.required'=>'expert filed is required.',
            'message.required'=>'message filed is required.',
        ]);

        if(!empty($r->preid)){ 
            $data = \App\Models\ExpertReview::find($r->preid); 
        }else{ 
            $data = new \App\Models\ExpertReview();
            $data->user_id = userinfo()->id;             
            $data->sequence = (\App\Models\ExpertReview::max('sequence') + 1);
        }   
        $data->expert_id = $r->expert;
        $data->rating = $r->rating;
        $data->description = $r->message;
        $data->save();

        return back()->with('success','Review submitted!');
    }

    /// Wallet
    public function checktransationno($transation){
        if(\App\Models\UserWalletHistory::where('transationno',$transation)->count() > 0){
            $transationno = generatetransationno();
            return $this->checktransationno($transationno);
        }else{
            return $transation;
        }
    }
    public function depositmoney(Request $r){
        if(empty($r->amount)){
            return back()->with('error','The amount field is required.');
        }
        if($r->amount < settingdata()->minimum_deposit){
            return back()->with('error','You can`t add less than '.settingdata()->minimum_deposit.' '.defaultcurrency().'.');
        }

        $transationno = generatetransationno();       
        $checktran = $this->checktransationno($transationno);
        $data = new \App\Models\UserWalletHistory();
        $data->transationno = "$checktran";
        $data->user_id = userinfo()->id;
        $data->amount = $r->amount;
        $data->type = 'deposit';
        $data->amounttype = 'c';
        $data->is_publish = 1;
        $data->sequence = (\App\Models\UserWalletHistory::max('sequence') + 1);
        $data->save();

        $user = userinfo();
       
        // $order = new Order();
        // $od["orderId"] = "TRX-".$data->transationno;
        // $od["orderAmount"] = $r->amount;
        // $od["orderNote"] = "Deposit Money";
        // $od["customerPhone"] = "+".userinfo()->ccode.''.userinfo()->mobile;
        // $od["customerName"] = userinfo()->name;
        // $od["customerEmail"] = userinfo()->email;
        // $od["returnUrl"] = route('depositcashfree').'?userid='.userinfo()->user_id;
        // $od["notifyUrl"] = route('depositcashfree').'?userid='.userinfo()->user_id;
        // $order->create($od);    
        // $link = $order->getLink($od['orderId']);
        // return redirect($link->paymentLink);      
        return view('booking.deposit-payumoney',compact('data','user'));   
    }
    public function depositcashfree(Request $request){
        $txStatus = $request->txStatus;
        $transationno = str_replace('TRX-','',$request->orderId);
        $checkusercoupon = \App\Models\UserWalletHistory::where(['transationno'=>$transationno])->first();
        $userid = request('userid');
        $userdata = \App\Models\User::where('user_id',$userid)->first();
        \Auth::login($userdata);
        if($txStatus=='SUCCESS'){
            $data = \App\Models\UserWalletHistory::find($checkusercoupon->id ?? 0);
            
            if($data->payment==0){
                $user = \App\Models\User::find($data->user_id);
                $user->increment('wallet',$data->amount);
            }            

            $data->payment = 1;
            $data->reference_id = $request->referenceId;
            $data->is_publish=1;
            $data->payment_date = date('Y-m-d H:i:s');
            $data->save();  
            
            $body = ['transation'=>$data ];
            if(!empty($data->user->email)){
                \Mail::to($data->user->email)->send(new \App\Mail\User\DepositMoney($body));
            }
            
            \Mail::to(adminmail())->CC(ccadminmail())->send(new \App\Mail\Admin\DepositMoney($body));
    
            return redirect(route('user.wallet'))->with('success','Thank you very much. your wallet updated soon.');
        }else{
            if(!empty($checkusercoupon)){
                $data = \App\Models\UserWalletHistory::find($checkusercoupon->id);
                $data->payment = 2;
                $data->reference_id = $request->referenceId;
                $data->is_publish=1;
                $data->payment_date = date('Y-m-d H:i:s');
                $data->save();      
            }
              
            
            return redirect(route('user.wallet'))->with('error','Your payment has been canceled or declined!');
        }
    }


    public function withdrawalrequest(Request $r){
        $r->validate([
            'account_holder_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:200',
            'ifsc_code' => 'required|max:20',
            'account_number' => 'required|max:16|unique:user_banks',
            're_enter_account_number' => 'required|max:16',
            'amount' => 'required'
        ]);
        if($r->amount<settingdata()->minimum_withdraw){
            return response()->json(['errors'=>['amount'=>'Minimum withdrawal amount is '.defaultcurrency().' '.settingdata()->minimum_withdraw]],422);
        }
        if($r->re_enter_account_number!=$r->account_number){
            return response()->json(['errors'=>['re_enter_account_number'=>'Re enter account number does not match.']],422);
        }
        if($r->amount > userinfo()->wallet){
            return response()->json(['errors'=>['amount'=>'You have insufficient wallet amount.']],422);
        }
        $bankId = $r->bankid;
        if(empty($r->bankid)){
            $bank = new \App\Models\UserBank();
            $bank->user_id = userinfo()->id;
            $bank->account_holder_name = $r->account_holder_name;
            $bank->bank_name = $r->bank_name;
            $bank->ifsc_code = $r->ifsc_code;
            $bank->account_number = $r->account_number;
            $bank->save();
            
            $bankId = $bank->id;
        }
        
        $data = new \App\Models\WithdrawalRequest();
        $data->user_id = userinfo()->id;
        $data->bank_id = $bankId;
        $data->amount = $r->amount;
        $data->is_publish = 1;
        $data->sequence = (\App\Models\WithdrawalRequest::max('sequence') + 1);
        $data->save();

        $transationno = generatetransationno();       

        $transation = new \App\Models\UserWalletHistory();
        $transation->transationno = $this->checktransationno($transationno);
        $transation->user_id = userinfo()->id;
        $transation->amount = $r->amount;
        $transation->type = 'withdrawal';
        $transation->amounttype = 'd';
        $transation->is_publish = 0;
        $transation->sequence = (\App\Models\UserWalletHistory::max('sequence') + 1);
        $transation->save();
        return response()->json([
            'message' => 'Withdrawal request sent!'
        ]);
    }
    public function claimrequest(Request $r){
        $r->validate([
            'request_for' => 'required',
            'message' => 'required|string'
        ]);

        $data = new \App\Models\ClaimRequest();
        $data->user_id = userinfo()->id;
        $data->request_for = $r->request_for;
        $data->message = $r->message;
        $data->is_publish = 1;
        $data->sequence = (\App\Models\ClaimRequest::max('sequence') + 1);
        $data->save();
        
        return response()->json([
            'message' => 'Claim request sent!'
        ]);
    }

    //// MESSAGE
    public function sendmessage(Request $r){
        $r->validate([
            'to_recipient_email' => 'required|email',
            // 'subject' => 'required|string|max:200'
        ]);

        $check = \App\Models\SlotBook::join('experts','slot_books.expert_id','experts.id');
        $check = $check->where('slot_books.user_id',userinfo()->id);
        $check = $check->where('experts.email',$r->to_recipient_email);
        $check = $check->select('experts.*');
        $check->get();
        if($check->count()==0){
            return response()->json(['errors'=>['to_recipient_email'=>'To recipient email address is not exists.']],422);
        }  
        
        $expert = \App\Models\Expert::where('email',$r->to_recipient_email)->first();
        if(empty($expert)){
            return response()->json(['errors'=>['to_recipient_email'=>'To recipient email address is not exists.']],422);
        } 

        $message = new \App\Models\ComposeMessage();
        $message->expert_id = $expert->id;        
        $message->user_id =userinfo()->id;           
        $message->subject = $r->subject;      
        $message->message = $r->message;
        $message->send_by = 2;
        $message->reply_id = $r->sendreply ?? 0;
        $message->sequence = (\App\Models\ComposeMessage::max('sequence') + 1);
        $message->save();

        $sendAttacement=[];
        if(!empty($r->attachment)){ 
            foreach($r->attachment as $attach){
                $attachment = new \App\Models\ComposeMessageAttachment();
                $attachment->message_id = $message->id;
                if(!empty($attach)){                     
                    $attachment->attachment = directFile('uploads/message/',$attach);  
                    $attachment->attachment_size = \File::size(public_path('uploads/message/'.$attachment->attachment));
                    $attachment->attachment_type = $attach->getClientOriginalExtension();
                } 
                $attachment->save();
                if(!empty($attachment->attachment)){
                    array_push($sendAttacement,public_path('uploads/message/'.$attachment->attachment));
                }                
            }            
        }
        $mailData = [
            'subject' => ($message->subject ?? 'Message has  sent by '.$expert->name.' (EXPERT) ').':'.project(),
            'message' => $message->message,
            'attach' => $sendAttacement,
            'to' => $expert->email,
        ];     
        \Mail::to($expert->email)->send(new \App\Mail\EnquiryMail($mailData));

        return response()->json([
            'message' => 'Message Sent!'
        ]);
    }
    public function archivemessage($id){
        $checkposition = \App\Models\ComposeMessage::find($id);        
        if($checkposition->user_id==userinfo()->id){ 
            if($checkposition->archive_to==0){ $checkposition->archive_to = 1; }
            else{ $checkposition->archive_to = 0; }
        }
        $checkposition->save();
        return redirect(request('previous'))->with(['success'=>'Data Archived!']);
    }
    public function deletemessage($id){
        $checkposition = \App\Models\ComposeMessage::find($id);        
        if($checkposition->user_id==userinfo()->id){ 
            if($checkposition->delete_to==0){ $checkposition->delete_to = 1; }
            elseif(request('confirm')==true){ $checkposition->delete_to = 2; }
            else{ $checkposition->delete_to = 0; }
        }
        $checkposition->save();
        return redirect(request('previous'))->with(['success'=>'Data Deleted!']);
    }
    public function bulkarchivemessage(Request $r){
        if(empty($r->check)){
            return back()->with(['error'=>'Please checked at least one data!']);
        }
        foreach($r->check as $id){
            $checkposition = \App\Models\ComposeMessage::find($id);        
            if($checkposition->user_id==userinfo()->id){ 
                if($checkposition->archive_to==0){ $checkposition->archive_to = 1; }
                else{ $checkposition->archive_to = 0; }
            }
            $checkposition->save();
        }
        return redirect(request('previous'))->with(['success'=>'Data Archived!']);
    }
    public function bulkdeletemessage(Request $r){
        if(empty($r->check)){
            return back()->with(['error'=>'Please checked at least one data!']);
        }
        foreach($r->check as $id){
            $checkposition = \App\Models\ComposeMessage::find($id);        
            if($checkposition->user_id==userinfo()->id){ 
                if($checkposition->delete_to==0){ $checkposition->delete_to = 1; }
                elseif(request('confirm')==true){ $checkposition->delete_to = 2; }
                else{ $checkposition->delete_to = 0; }
            }
            $checkposition->save();
        }
        return redirect(request('previous'))->with(['success'=>'Data Deleted!']);
    }


    /// VIDEO CALL
    public function videocallend(Request $r){
        $slot = \App\Models\SlotBook::where('call_meeting_code',$r->meeting)->first();
        $gstamount = $slot->gst_amount;
        $tdsamount = ($slot->paid_amount * settingdata()->tds) / 100;
        $transfer = $slot->paid_amount - $gstamount - $tdsamount - $slot->service_charges;
        
        $data = \App\Models\SlotBook::where('call_meeting_code',$r->meeting)->update([
            'call_end_by' => userinfo()->id,
            'call_end_by_type' => 2,
            'status' => 3,
            'call_end' => date('Y-m-d H:i:s'),
            'tds' => settingdata()->tds,
            'tds_amount' => $tdsamount,
            'transfer_amount' => $transfer,
            'transfer_date' => date('Y-m-d H:i:s')
        ]);
        
        $history = \App\Models\CallRecordingHistory::where('id',$slot->lasthistory->id ?? 0)->update([
            'call_end_by' => userinfo()->id,
            'call_end_by_type' => 2,
            'call_end' => date('Y-m-d H:i:s'),
        ]);

        $expert = \App\Models\Expert::find($slot->expert_id);
        $expert->increment('wallet',$transfer);

        $transationno = generatetransationno();       
        $checktransationno = new \App\Http\Controllers\User\UserController();
        $history = new \App\Models\ExpertWalletHistory();
        $history->transationno = $checktransationno->checktransationno($transationno);
        $history->expert_id = $slot->expert_id;
        $history->amount = $transfer;
        $history->type = 'purchase';
        $history->purchase_booking_id = $slot->id;
        $history->amounttype = 'c';
        $history->is_publish = 1;
        $history->sequence = (\App\Models\ExpertWalletHistory::max('sequence') + 1);
        $history->save();

        return response()->json([
            'success' => true
        ]);
    }
    public function videorecording(Request $r){
        
        $data = \App\Models\SlotBook::where('call_meeting_code',$r->meeting)->update([
            'call_recording_id' => $r->recordingid,
        ]);
        $slot = \App\Models\SlotBook::where('call_meeting_code',$r->meeting)->first();

        $history = \App\Models\CallRecordingHistory::where('id',$slot->lasthistory->id ?? 0)->update([
            'call_recording_id' => $r->recordingid
        ]);
        return response()->json([
            'success' => true
        ]);
    }
}
