<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LoveyCom\CashFree\PaymentGateway\Order;
class OtherController extends Controller
{
    public function checkbookingemail(Request $request){
        $request->validate([
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            // 'name' => 'required',
        ],[
            'email.required' => 'email field is required.',
            'email.regex' => 'invalid email.',
            'email.unique' => 'this email already exists.',
            'name.required' => 'name field is required.'
        ]);
        $checkexpertemail = \App\Models\Expert::where(['email'=>$request->email])->first();
        if(!empty($checkexpertemail)){
            return response()->json(['errors'=>['email'=>'This email address already exists agains of expert.']],422);
        }
        $checkemail = \App\Models\User::where(['email'=>$request->email])->first();
        $redirect='';
        if(!empty($checkemail)){
            $otp = generateotp(4);
            $data = \App\Models\User::find($checkemail->id);
            $data->otp = $otp;
            $data->save();  
            $redirect = route('payment',['booking'=>$request->booking]);                   
        }else{
            $otp = generateotp(4);
            $data = new \App\Models\User();
            $data->otp = $otp;
            $data->email = $request->email;
            $data->user_id = generateuserno();
            $data->save();
            $redirect = route('expertbooking2',['booking'=>$request->booking]);
        }
        
        $html = '';
        $html .= '<p>Your email verification code is '.$otp.'. please don`t share this otp to others.</p>';
        $body = ['message'=>$html,'subject'=>'Email verification code is '.$otp.'.' ];
        \Mail::to($request->email)->send(new \App\Mail\EnquiryMail($body));
        return response()->json([
            'success' => 'OTP sended on you email address. please check your inbox.',
            'otp'=>$otp,
            'redirect' => $redirect
        ]);
    }
    public function checkbookingmobile(Request $request){
        $request->validate([
            'mobile' => 'required|min:8',
        ],[
            'mobile.required' => 'mobile field is required.'
        ]);
        $html = '';
        $otp = generateotp(4);
        $html .= '<p>Your email verification code is '.$otp.'. please don`t share this otp to others.</p>';
        return response()->json([
            'success' => 'OTP sended on you mobile.',
            'otp'=>$otp
        ]);
    }
    public function bookingloginprocess(Request $request){
        $request->validate([
            'mobile' => 'required|min:10|max:10',
            'name' => 'required',
        ]);

        $checkexpertemail = \App\Models\Expert::where(['mobile'=>$request->mobile])->first();
        if(!empty($checkexpertemail)){
            return response()->json(['errors'=>['mobile'=>'This mobile number already exists agains of expert.']],422);
        }
        $checkemail = \App\Models\User::where(['mobile'=>$request->mobile])->first();
        if(!empty($checkexpertemail)){
            return response()->json(['errors'=>['mobile'=>'This mobile number already exists.']],422);
        }

        $data = \App\Models\User::find(userinfo()->id);
        $data->mobile = $request->mobile;
        $data->name = $request->name;
        $data->ccode = $request->ccode;
        $data->mobile_verify = 1;
        $data->is_publish=1;
        $data->complete_profile=1;
        $data->last_login = date('Y-m-d H:i:s');
        $data->save();

        $bookingslot = \App\Models\SlotBook::where('booking_id',$request->booking)->first();
        if(!empty($bookingslot)){
            $slost = \App\Models\SlotBook::find($bookingslot->id);
            $slost->user_id = $data->id ?? 0;
            $slost->user_number = $data->ccode.$data->mobile ?? '';
            $slost->user_email = $data->email ?? '';
            $slost->user_name = $data->name ?? '';
            $slost->save();  
        }
          
        $redirect = route('payment',['booking'=>$request->booking]);
        return response()->json([
            'redirect' => $redirect
        ]);

    }

    public function couponapply(Request $request){
        $request->validate([
            'coupon' => 'required',
        ],[
            'coupon.required' => 'coupon field is required.'
        ]);
        $checkcoupon = \App\Models\Coupon::where(['is_publish'=>1,'coupon_code'=>$request->coupon])->first();
        $checkusercoupon = \App\Models\SlotBook::where(['user_id'=>userinfo()->id,'coupon_code'=>$request->coupon])->first();
        if(empty($checkcoupon)){
            return back()->withErrors(['coupon'=>'Invalid coupon code']);
        }
        if($checkcoupon->coupon_end < date('Y-m-d')){
            return back()->withErrors(['coupon'=>'Invalid coupon code']);
        }
        if($checkcoupon->coupon_start > date('Y-m-d')){
            return back()->withErrors(['coupon'=>'Invalid coupon code']);
        }
        if(!empty($checkusercoupon)){
            return back()->withErrors(['coupon'=>'You have already use this coupon.']);
        }
        $data = \App\Models\SlotBook::find($request->booking);
        $data->coupon_code = $checkcoupon->coupon_code;
        $data->coupon_discount = '';
        $data->paid_amount = '';
        $data->save();
        return back()->with('success','Coupon Applied!');
    }
    public function couponcancel($booking){
        $checkusercoupon = \App\Models\SlotBook::where(['user_id'=>userinfo()->id,'booking_id'=>$booking])->first();
        if(empty($checkusercoupon)){
            return back()->with(['error'=>'Sorry! please try again later.']);
        }
        $data = \App\Models\SlotBook::find($checkusercoupon->id);
        $data->coupon_code = '';
        $data->coupon_discount = '';
        $data->paid_amount = $data->booking_amount;
        $data->save();
        return back()->with('success','Coupon Cancelled!');
    }
    
    /*------------------CASHFREE GATEWAY---------------*/
    // public function paymentresponse($booking){
    //     if(empty(userinfo()->id)){
    //         return back()->with(['error'=>'You are not login. please login with user account and process next step.']);
    //     }
    //     $checkusercoupon = \App\Models\SlotBook::where(['user_id'=>userinfo()->id,'booking_id'=>$booking])->first();
    //     if(empty($checkusercoupon)){
    //         return back()->with(['error'=>'Sorry! please try again later.']);
    //     }

    //     $Walamount = 0;
    //     $paid_amount = $checkusercoupon->paid_amount;
    //     $orderNote='Book Slot';
    //     $returnUrl = route('cashfree').'?userid='.userinfo()->user_id;
        
    //     if(!empty(request('walletamount'))){

    //         if(request('walletamount') < $checkusercoupon->paid_amount){
    //             $Walamount = request('walletamount');
    //             $paid_amount = $checkusercoupon->paid_amount - $Walamount;
    //         }

    //         if(request('walletamount') >= $checkusercoupon->paid_amount){
    //             $Walamount = $checkusercoupon->paid_amount;
    //             $paid_amount = 0;
    //         }

    //         $transationno = generatetransationno();       
    //         $checktransationno = new \App\Http\Controllers\User\UserController();
    //         $history = new \App\Models\UserWalletHistory();
    //         $history->transationno = $checktransationno->checktransationno($transationno);
    //         $history->user_id = $checkusercoupon->user_id;
    //         $history->amount = $Walamount;
    //         $history->type = 'purchase';
    //         $history->purchase_booking_id = $checkusercoupon->id;
    //         $history->amounttype = 'd';
    //         $history->is_publish = 1;
    //         $history->sequence = (\App\Models\UserWalletHistory::max('sequence') + 1);
    //         $history->save();

    //         $user = \App\Models\User::find($checkusercoupon->user_id);
    //         $user->decrement('wallet',$Walamount);

    //         $orderNote="User has paid ".userinfo()->wallet." from his wallet and he is doing the rest of the balance online";
    //         $returnUrl = route('cashfree').'?booking_id='.$checkusercoupon->booking_id.'&walletpaid='.$Walamount.'&historywallet='.$history->id.'&userid='.userinfo()->user_id;
        
    //     }
 
    //     $data = \App\Models\SlotBook::find($checkusercoupon->id);
    //     $data->user_name = request('name');
    //     $data->user_email = request('email');
    //     $data->user_number = request('phone');
    //     $data->user_city = request('city');
    //     $data->wallet_amount = $Walamount;
    //     $data->save();

    //     if($paid_amount==0){

    //         $expertdtl = \App\Models\Expert::find($checkusercoupon->expert_id);

    //         $data = \App\Models\SlotBook::find($checkusercoupon->id);
    //         $data->payment = 3;
    //         $data->status=1;
    //         $data->payment_date = date('Y-m-d H:i:s');
    //         $data->service_charges_percentage = $expertdtl->service_charges ?? 0;
    //         $data->service_charges = (($data->paid_amount * $data->service_charges_percentage)/100);
    //         $data->save(); 

    //         $body = ['slot'=>$data ];
    //         if(!empty($data->user->email)){
    //             \Mail::to($data->user_email)->send(new \App\Mail\User\PaymentReceived($body));
    //         }
    //         if(!empty($data->expert->email)){

    //             \Mail::to($data->expert->email)->send(new \App\Mail\Expert\NewSlotBook($body));
    //         }
    //         \Mail::to(adminmail())->CC(ccadminmail())->send(new \App\Mail\Admin\NewSlotBook($body));
    //         return redirect(route('paymentquery',['booking'=>$booking]))->with('success','Thank you very much. We really appreciate it.');

    //     }else{
    //         $order = new Order();
    //         $od["orderId"] = "EXB-OR-".$checkusercoupon->booking_id;
    //         $od["orderAmount"] = $paid_amount;
    //         $od["orderNote"] = $orderNote;
    //         $od["customerPhone"] = "+".$data->user_number;
    //         $od["customerName"] = $data->user_name;
    //         $od["customerEmail"] = $data->user_email;
    //         $od["returnUrl"] = $returnUrl;
    //         $od["notifyUrl"] = $returnUrl;
    //         $order->create($od);    
    //         $link = $order->getLink($od['orderId']);

    //         if(!empty($link->reason)){

    //             if($data->payment==3){
    //                 $transationno = generatetransationno();       
    //                 $checktransationno = new \App\Http\Controllers\User\UserController();
    //                 $history = new \App\Models\UserWalletHistory();
    //                 $history->transationno = $checktransationno->checktransationno($transationno);
    //                 $history->user_id = $checkusercoupon->user_id;
    //                 $history->amount = $Walamount;
    //                 $history->type = 'refund';
    //                 $history->purchase_booking_id = $checkusercoupon->id;
    //                 $history->amounttype = 'c';
    //                 $history->is_publish = 1;
    //                 $history->sequence = (\App\Models\UserWalletHistory::max('sequence') + 1);
    //                 $history->save();
    
    //                 $user = \App\Models\User::find($checkusercoupon->user_id);
    //                 $user->increment('wallet',$Walamount);
    //             }
                
    
    //             return back()->with('error',$link->reason); 

    //         }else{

    //             return redirect($link->paymentLink);
    //         }

    //     }     
    // }

    // public function cashfree(Request $request){
    //     $txStatus = $request->txStatus;
    //     $booking = str_replace('EXB-OR-','',$request->orderId);
    //     $checkusercoupon = \App\Models\SlotBook::where(['booking_id'=>$booking])->first();
    //     $userid = request('userid');
    //     $userdata = \App\Models\User::where('user_id',$userid)->first();
    //     if(!empty($userdata)){ \Auth::login($userdata); }        
    //     $expertdtl = \App\Models\Expert::find($checkusercoupon->expert_id);
    //     if($txStatus=='SUCCESS'){
    //         $data = \App\Models\SlotBook::find($checkusercoupon->id);
    //         $data->payment = 1;
    //         $data->reference_id = $request->referenceId;
    //         $data->status=1;
    //         $data->payment_date = date('Y-m-d H:i:s');
    //         $data->service_charges_percentage = $expertdtl->service_charges ?? 0;
    //         $data->service_charges = (($data->paid_amount * $data->service_charges_percentage)/100);
    //         $data->save();        
            
    //         $body = ['slot'=>$data ];
    //         if(!empty($data->user->email)){
    //             \Mail::to($data->user_email)->send(new \App\Mail\User\PaymentReceived($body));
    //         }
    //         if(!empty($data->expert->email)){
    
    //             \Mail::to($data->expert->email)->send(new \App\Mail\Expert\NewSlotBook($body));
    //         }
    //         \Mail::to(adminmail())->CC(ccadminmail())->send(new \App\Mail\Admin\NewSlotBook($body));
    
    //         return redirect(route('paymentquery',['booking'=>$booking]))->with('success','Thank you very much. We really appreciate it.');
    //     }else{
    //         $data = \App\Models\SlotBook::find($checkusercoupon->id);
    //         $data->payment = 2;
    //         $data->reference_id = $request->referenceId;
    //         $data->status=1;
    //         $data->payment_date = date('Y-m-d H:i:s');
    //         $data->save(); 
            
    //         if(!empty(request('walletpaid'))){
    //             $transationno = generatetransationno();       
    //             $checktransationno = new \App\Http\Controllers\User\UserController();
    //             $history = new \App\Models\UserWalletHistory();
    //             $history->transationno = $checktransationno->checktransationno($transationno);
    //             $history->user_id = $data->user_id;
    //             $history->amount = request('walletpaid');
    //             $history->type = 'refund';
    //             $history->purchase_booking_id = $data->id;
    //             $history->amounttype = 'c';
    //             $history->is_publish = 1;
    //             $history->sequence = (\App\Models\UserWalletHistory::max('sequence') + 1);
    //             $history->save();

    //             $user = \App\Models\User::find($data->user_id);
    //             $user->increment('wallet',request('walletpaid'));
    //         }
            
    //         return redirect(url('payment/'.$booking))->with('error','Your payment has been canceled or declined!');
    //     }
    // }
   
    /*------------------CASHFREE GATEWAY---------------*/



    /*--------------------- Payumoney ---------------------------*/
        public function paymentresponse(Request $r,$booking){
            $r->validate([
                'amount' => 'required',
                'name' => 'required|max:255',
                'email' => 'required|email',
                'phone' => 'required|min:8|max:12',
                'city' => 'required|max:255',
            ]); 
            if(empty(userinfo()->id)){
                return back()->with(['error'=>'You are not login. please login with user account and process next step.']);
            }
            $checkusercoupon = \App\Models\SlotBook::where(['user_id'=>userinfo()->id,'booking_id'=>$booking])->first();
            if(empty($checkusercoupon)){
                return back()->with(['error'=>'Sorry! please try again later.']);
            }

            $Walamount = 0;
            $paid_amount = $checkusercoupon->paid_amount;
            if(!empty(request('walletamount'))){

                if(request('walletamount') < $checkusercoupon->paid_amount){
                    $Walamount = request('walletamount');
                    $paid_amount = $checkusercoupon->paid_amount - $Walamount;
                }

                if(request('walletamount') >= $checkusercoupon->paid_amount){
                    $Walamount = $checkusercoupon->paid_amount;
                    $paid_amount = 0;
                }

                $transationno = generatetransationno();       
                $checktransationno = new \App\Http\Controllers\User\UserController();
                $history = new \App\Models\UserWalletHistory();
                $history->transationno = $checktransationno->checktransationno($transationno);
                $history->user_id = $checkusercoupon->user_id;
                $history->amount = $Walamount;
                $history->type = 'purchase';
                $history->purchase_booking_id = $checkusercoupon->id;
                $history->amounttype = 'd';
                $history->is_publish = 1;
                $history->sequence = (\App\Models\UserWalletHistory::max('sequence') + 1);
                $history->save();

                $user = \App\Models\User::find($checkusercoupon->user_id);
                $user->decrement('wallet',$Walamount);
            }

            $data = \App\Models\SlotBook::find($checkusercoupon->id);
            $data->user_name = request('name');
            $data->user_email = request('email');
            $data->user_number = request('phone');
            $data->user_city = request('city');
            $data->wallet_amount = $Walamount;
            $data->save();

            if($paid_amount==0){

                $expertdtl = \App\Models\Expert::find($checkusercoupon->expert_id);
    
                $data = \App\Models\SlotBook::find($checkusercoupon->id);
                $data->payment = 3;
                $data->status=1;
                $data->payment_date = date('Y-m-d H:i:s');
                $data->service_charges_percentage = $expertdtl->service_charges ?? 0;
                $data->service_charges = (($data->booking_amount * $data->service_charges_percentage)/100);
                $data->save(); 
    
                $body = ['slot'=>$data ];
                if(!empty($data->user->email)){
                    \Mail::to($data->user_email)->send(new \App\Mail\User\PaymentReceived($body));
                }
                if(!empty($data->expert->email)){
    
                    \Mail::to($data->expert->email)->send(new \App\Mail\Expert\NewSlotBook($body));
                }
                \Mail::to(adminmail())->CC(ccadminmail())->send(new \App\Mail\Admin\NewSlotBook($body));
                return redirect(route('paymentquery',['booking'=>$booking]))->with('success','Thank you very much. We really appreciate it.');
    
            }else{
                $walletby = request('walletamount');
                return view('booking.payumoney',compact('data','walletby'));
            }
        }
        public function payumoney_paymentfailed(Request $r,$booking){
            $status = $r->status;
            $errormessage = $r->error_Message;
            $slot = \App\Models\SlotBook::where('booking_id',$booking)->first();
            $user = \App\Models\User::where('user_id',request('userinfo'))->first();
            \Auth::login($user);

            if($slot->wallet_amount > 0){
                $transationno = generatetransationno();       
                $checktransationno = new \App\Http\Controllers\User\UserController();
                $history = new \App\Models\UserWalletHistory();
                $history->transationno = $checktransationno->checktransationno($transationno);
                $history->user_id = $slot->user_id;
                $history->amount = $slot->wallet_amount;
                $history->type = 'refund';
                $history->purchase_booking_id = $slot->id;
                $history->amounttype = 'c';
                $history->is_publish = 1;
                $history->sequence = (\App\Models\UserWalletHistory::max('sequence') + 1);
                $history->save();
    
                $user = \App\Models\User::find($slot->user_id);
                $user->increment('wallet', $slot->wallet_amount);
            }
            

            return redirect(route('payment',['booking'=>$booking]))->with('error',$errormessage);
        }
        public function payumoney_paymentsuccess(Request $r,$booking){
            $status = $r->status;
            $slot = \App\Models\SlotBook::where('booking_id',$booking)->first();
            $user = \App\Models\User::where('user_id',request('userinfo'))->first();
            \Auth::login($user);
            $expertdtl = \App\Models\Expert::find($slot->expert_id);
            if($status=='success'){
                $data = \App\Models\SlotBook::find($slot->id);
                $data->payment = 1;
                $data->reference_id = $r->txnid;
                $data->status=1;
                $data->payment_date = date('Y-m-d H:i:s');
                $data->service_charges_percentage = $expertdtl->service_charges ?? 0;
                $data->service_charges = (($data->booking_amount * $data->service_charges_percentage)/100);
                $data->save();        
                
                $body = ['slot'=>$data ];
                if(!empty($data->user->email)){
                    \Mail::to($data->user_email)->send(new \App\Mail\User\PaymentReceived($body));
                }
                if(!empty($data->expert->email)){
        
                    \Mail::to($data->expert->email)->send(new \App\Mail\Expert\NewSlotBook($body));
                }
                \Mail::to(adminmail())->CC(ccadminmail())->send(new \App\Mail\Admin\NewSlotBook($body));
        
                return redirect(route('paymentquery',['booking'=>$booking]))->with('success','Thank you very much. We really appreciate it.');
            }
            return redirect(route('payment',['booking'=>$booking]))->with('error','An Error Occurred! Please Try Again Later');
        }

        public function deposit_payumoney_success(Request $r,$transationno){
            $status = $r->status;
            $errormessage = $r->error_Message;
            $checkusercoupon = \App\Models\UserWalletHistory::where(['transationno'=>$transationno])->first();
            $user = \App\Models\User::where('user_id',request('userinfo'))->first();
            \Auth::login($user);
            $data = \App\Models\UserWalletHistory::find($checkusercoupon->id ?? 0);
            
            if($data->payment==0){
                $user = \App\Models\User::find($data->user_id);
                $user->increment('wallet',$data->amount);
            }            

            $data->payment = 1;
            $data->reference_id = $r->txnid;
            $data->is_publish=1;
            $data->payment_date = date('Y-m-d H:i:s');
            $data->save();  
            
            $body = ['transation'=>$data ];
            if(!empty($data->user->email)){
                \Mail::to($data->user->email)->send(new \App\Mail\User\DepositMoney($body));
            }
            
            \Mail::to(adminmail())->CC(ccadminmail())->send(new \App\Mail\Admin\DepositMoney($body));
    
            return redirect(route('user.wallet'))->with('success','Thank you very much. your wallet updated soon.');
        }

        public function deposit_payumoney_failed(Request $r,$transationno){
            $status = $r->status;
            $errormessage = $r->error_Message;
            $checkusercoupon = \App\Models\UserWalletHistory::where(['transationno'=>$transationno])->first();
            $user = \App\Models\User::where('user_id',request('userinfo'))->first();
            \Auth::login($user);
            if(!empty($checkusercoupon)){
                $data = \App\Models\UserWalletHistory::find($checkusercoupon->id);
                $data->payment = 2;
                $data->reference_id = $r->txnid;
                $data->is_publish=1;
                $data->payment_date = date('Y-m-d H:i:s');
                $data->save();      
            }
            return redirect(route('user.wallet'))->with('error',$errormessage);
        }

    /*--------------------- Payumoney ---------------------------*/


    
    public function bookingquery(Request $request){
        $request->validate([
            'startup' => 'required',
            'facing_challenges' => 'required',
            'ask_question' => 'required',
            'experience' => 'required',
            'attachment'=>'nullable|max:10000|mimes:doc,docx,pdf'
        ]);

        if(!empty($request->attachment)){
            $FileName = directFile('uploads/booking-attachment/',$request->attachment);
        }
        
        $data = \App\Models\SlotBook::find($request->booking);
        $data->query = $request->startup;
        $data->facing_challenges_query = $request->facing_challenges;
        $data->ask_question_query = $request->ask_question;
        $data->experience_query = $request->experience;
        if(!empty($request->attachment)){
            $data->query_attachment = $FileName;
        }
        $data->save();
        return redirect(route('user.schedules'))->with(['success'=>'Your query has been submited.']);
    }

    //// HELP
    public function posthelpquery(Request $request){
        $request->validate([
            'description' => 'required',
        ],[
            'description.required' => 'query field is required.'
        ]);

        $data = new \App\Models\HelpQuery();
        $data->type_id = $request->type_id;
        $data->type = $request->type;
        $data->description = $request->description;
        $data->sequence = (\App\Models\HelpQuery::max('sequence') + 1);
        $data->save();
        return response()->json([
            'success'=>'Your query has been submited.'
        ]);
    }


    // SEARCH
    public function expertsearch(Request $r){
        $experts = \App\Models\Expert::where(['experts.is_publish'=>1,'experts.profile_visibility'=>1]);
        if(!empty($r->search)){
            $search = $r->search;
            $experts = $experts->where(function($q) use ($search){
                $q->where('experts.name','LIKE','%'.$search.'%');
                $q->orwhere('experts.mobile','LIKE','%'.$search.'%');
                $q->orwhere('experts.email','LIKE','%'.$search.'%');
                $q->orwhere('experts.user_id','LIKE','%'.$search.'%');
            });
        }
        if(!empty($r->industries)){
            $experts = $experts->join('expert_industries as industrie','experts.id','industrie.expert_id');
            $experts = $experts->whereIn('industrie.industry_id',$r->industries);     
        }  
        if(!empty($r->roles)){
            $experts = $experts->join('expert_roles as roles','experts.id','roles.expert_id');
            $experts = $experts->whereIn('roles.role',$r->roles);     
        } 
        if(!empty($r->expertise)){
            $experts = $experts->join('expert_expertises as expertises','experts.id','expertises.expert_id');
            $experts = $experts->whereIn('expertises.expertise_id',$r->expertise);     
        }       
        
        $experts = $experts->select('experts.*');
        $experts = $experts->orderBy('experts.sequence','ASC');
        $experts = $experts->groupBy('experts.id');
        $experts = $experts->whereNotIn('experts.id',[expertinfo()->id ?? 0]);
        $experts = $experts->paginate(80);
        $html='';
        foreach($experts as $expert):
            $html .='<div class="col-lg-3 col-md-4 col-sm-6">';
                $html .='<div class="card ExpBlock verify">';
                    $html .='<a href="'.route('experts',['alias'=>$expert->user_id]).'" class="card-header">';
                    if (in_array(checkimagetype($expert->profile), ['SVG','AVIF']) && file_exists(public_path('/uploads/expert/' . $expert->profile))):
                        $html .='<img loading="lazy" src="'.asset('/uploads/expert/' . $expert->profile).'" alt="'.($expert->name ?? '').'" width="380" height="480">';
                        $html .='<div loading="lazy" style="background:url('.asset('/uploads/expert/' . $expert->profile).')"></div>';
                    elseif(in_array(checkimagetype($expert->profile), ['WEBP']) && file_exists(public_path('/uploads/expert/' . $expert->profile))):
                        $html .='<picture>';
                            $html .='<img loading="lazy" src="'.asset('/uploads/expert/' . $expert->profile).'" alt="'.($expert->name ?? '').'" width="380" height="480">';
                        $html .='</picture>';
                        $html .='<div loading="lazy" style="background:url('.asset('/uploads/expert/' . $expert->profile).')"></div>';
                    elseif(file_exists(public_path('/uploads/expert/' . $expert->profile . '.webp'))):
                        $html .='<picture>';
                            $html .='<source srcset="'.asset('/uploads/expert/' . $expert->profile . '.webp').'" type="image/webp">';
                            $html .='<img loading="lazy" src="'.asset('/uploads/expert/' . 'jpg/'. $expert->profile . '.jpg').'" alt="'.($expert->name ?? '').'" width="380" height="480">';
                        $html .='</picture>';
                        $html .='<div loading="lazy" style="background:url('.asset('/uploads/expert/' . $expert->profile . '.webp').')"></div>';
                    elseif(file_exists(public_path('/uploads/expert/jpg/' . $expert->profile . '.jpg'))):
                        $html .='<picture>';
                            $html .='<source srcset="'.asset('/uploads/expert/' . $expert->profile . '.webp').'" type="image/webp">';
                            $html .='<img loading="lazy" src="'.asset('/uploads/expert/' . 'jpg/'. $expert->profile . '.jpg').'" alt="'.($expert->name ?? '').'" width="380" height="480">';
                        $html .='</picture>';
                        $html .='<div loading="lazy" style="background:url('.asset('/uploads/expert/' . $expert->profile . '.webp').')"></div>';
                    else:
                        $html .='<picture>';
                        $html .='<source srcset="'.asset('frontend/image/no-img.webp').'" type="image/webp">';
                        $html .='<img loading="lazy" src="'.asset('frontend/image/no-img.jpg').'"  alt="'.($expert->name ?? '').'" width="380" height="480">';
                        $html .='</picture>';
                        $html .='<div loading="lazy" style="background:url('.asset('frontend/image/no-img.webp').')"></div>';
                    endif;
                    $html .='</a>';
                    $html .='<a href="'.route('experts',['alias'=>$expert->user_id]).'" class="card-body">';
                        $html .='<div>';                             
                             if(!empty($expert->expertise)):
                                foreach ($expert->expertise as $ek=>$expertise):
                                    if (!empty($expertise->expertiseinfo) && $ek < 2):
                                        $html .='<small class="bg-warning rounded-1 d-inline-block text-black mb-2 me-1">';
                                            $html .=$expertise->expertiseinfo->title;
                                        $html .='</small>';
                                    endif;
                                endforeach;
                            endif;   
                        $html .='</div>';
                        $html .='<div class="ExpCon">';                         
                            $html .='<h3>'.($expert->name ?? '').'</h3>';
                            $html .='<small class="text-white fw-lighter">';
                                
                                if(!empty($expert->roles)):
                                    foreach ($expert->roles as $rk => $roles):
                                        if (!empty($roles->roleinfo) && $rk < 1):
                                            $html .= $roles->roleinfo->title. ($rk < 0 ? ', ' : '');                                            
                                        endif;
                                    endforeach;
                                endif;
                                $html .= ($expert->compnay_name && count($expert->expertise) > 0 ? ', ' . $expert->compnay_name : $expert->compnay_name) ;
                            $html .='</small>';
                        $html .='</div>';
                        $html .='<div class="h5 text-white price m-0 fw-normal"><i
                                class="fal fa-rupee-sign fw-normal h6 m-0"></i> '.round(($expert->defaultcharges->charges) + ($expert->defaultcharges->charges * 0) / 100).'/-';
                        $html .='</div>';
                    $html .='</a>';
                $html .='</div>';
            $html .='</div>';
        endforeach;
        if($experts->count()==0):
            $html='<div class="col-12 text-center mt-5">
                    <h6>WE ARE APOLOGIES.</h6>
                    <p><small>NO ANY EXPERTS ARE FOUND IN OUR RECORDS.</small></p>
                </div>';
        endif;
        return response()->json([
            'html' => $html
        ]);
    }

    //// Frontend Form
    public function savenewsletter(Request $r){
        $r->validate([
            'subscribe_email' => 'required|unique:newsletters,email,NULL,id,deleted_at,NULL',
        ]);
        $data = new \App\Models\Newsletter();
        $data->email = $r->subscribe_email;
        $data->ip = request()->ip();
        $data->save();

        $Message ='Dear Customer,<br><br>';
        $Message .='Thank you for subscribe our newsletter.<br>';
        $Message .='We will now keep you posted about new services, blogs, and expert.<br>';
        $Message .='You received this email because you subscribe '.project().' newsletter.';

        $mailData = [
            'subject' => 'Thank you for subscribing : '.project().'.',
            'message' => $Message
        ];         
        \Mail::to($data->email)->send(new \App\Mail\EnquiryMail($mailData));

        return response()->json([
            'message' => 'Thankyou for subscribe our newsletter!'
        ]);
    }
    public function contactus(Request $r){
        $r->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'mobile' => 'required|min:10|max:10',
            'reason' => 'required',
            'message' => 'required'
        ]);
        $data = new \App\Models\ContactInquiry();
        $data->name = $r->name;
        $data->email = $r->email;
        $data->mobile = $r->mobile;
        $data->reason = $r->reason;
        $data->message = $r->message;
        $data->sequence = (\App\Models\ContactInquiry::max('sequence') + 1);
        $data->business_sector = $r->business_sector ?? 0;
        $data->ip = request()->ip();
        $data->save();


        /*****ADMIN*/
        $Message ='<h5>Hi,</h5>';
        $Message .='<p>We have recived a new contact enquiry. below are customer information:</p>';
        $Message .='<table>';
            $Message .='<tr>';
                $Message .='<td>Name : '.$data->name.'</td>';
            $Message .='</tr>';
            $Message .='<tr>';
                $Message .='<td>Email : '.$data->email.'</td>';
            $Message .='</tr>';
            $Message .='<tr>';
                $Message .='<td>Phone : '.$data->mobile.'</td>';
            $Message .='</tr>';
            if(!empty($data->businesssector)):
            $Message .='<tr>';
                $Message .='<td>Business Sector : '.$data->businesssector->title.'</td>';
            $Message .='</tr>';
            endif;
            $Message .='<tr>';
                $Message .='<td>Reason : '.$data->reason.'</td>';
            $Message .='</tr>';
            $Message .='<tr>';
                $Message .='<td>Message : '.$data->message.'</td>';
            $Message .='</tr>';
            $Message .='<tr>';
                $Message .='<td>IP : '.$data->ip.'</td>';
            $Message .='</tr>';
        $Message .='</table>';
        $mailData = [
            'subject' => 'Contact Enquiry Have Received From '.project().'.',
            'message' => $Message,
        ];         
        \Mail::to(mailsupportemail())->CC(ccadminmail())->send(new \App\Mail\EnquiryMail($mailData));

        $Message ='<h5>Hi '.$data->name.',</h5>';
        $Message .='<p>Thank you for contacting '.project().'. Below are the information you`ve provided</p>';
        $Message .='<table>';
            $Message .='<tr>';
                $Message .='<td>Name : '.$data->name.'</td>';
            $Message .='</tr>';
            $Message .='<tr>';
                $Message .='<td>Email : '.$data->email.'</td>';
            $Message .='</tr>';
            $Message .='<tr>';
                $Message .='<td>Phone : '.$data->mobile.'</td>';
            $Message .='</tr>';
            if(!empty($data->businesssector)):
            $Message .='<tr>';
                $Message .='<td>Business Sector : '.$data->businesssector->title.'</td>';
            $Message .='</tr>';
            endif;
            $Message .='<tr>';
                $Message .='<td>Reason : '.$data->reason.'</td>';
            $Message .='</tr>';
            $Message .='<tr>';
                $Message .='<td>Message : '.$data->message.'</td>';
            $Message .='</tr>';
            $Message .='<tr>';
                $Message .='<td>IP : '.$data->ip.'</td>';
            $Message .='</tr>';
        $Message .='</table>';
        $mailData = [
            'subject' => 'Thank you for your query : '.project().'.',
            'message' => $Message,
        ];         
        \Mail::to($data->email)->send(new \App\Mail\EnquiryMail($mailData));


        return back()->with(['success' => 'Thankyou! we are contact you soon.']);
    }
    public function saveblogcomment(Request $r){
        $r->validate([
            'email' => 'required|email',
            'name'=>'required|max:255|string',
            'message' => 'required'
        ]);
        $data = new \App\Models\BlogComment();
        $data->blog_id = $r->blog_id;
        $data->email = $r->email;
        $data->name = $r->name;
        $data->message = $r->message;
        $data->ip = request()->ip();
        $data->sequence = (\App\Models\BlogComment::max('sequence') + 1);
        $data->save();
        return response()->json([
            'message' => 'Thankyou! your comment saved!'
        ]);
    }
    public function requestjob(Request $r){
        $r->validate([
            'name'=>'required|max:255|string',
            'email'=>'required|email',
            'phone' => 'required|min:10|max:10',
            'experience' => 'required',
            'message' => 'required',
            'resume' => 'required',
        ]);

        if(!empty($r->resume)){ $FileName = directFile('uploads/resume/',$r->resume); }
        

        $data = new \App\Models\JobApply();
        $data->job = $r->jobid;        
        $data->name = $r->name;        
        $data->experience = $r->experience;
        $data->email = $r->email;        
        $data->phone = $r->ccode.$r->phone;  
        if(!empty($r->resume)){ $data->resume = $FileName;  }     
        $data->message = $r->message;
        $data->sequence = (\App\Models\JobApply::max('sequence') + 1);
        $data->save();

        /*****ADMIN*/
        $Message ='<h5>Hi,</h5>';
        $Message .='<p>We have recived a new job enquiry. below are customer information:</p>';
        $Message .='<table>';
            $Message .='<tr>';
                $Message .='<td>Name : '.$data->name.'</td>';
            $Message .='</tr>';
            if(!empty($data->jobs)):
            $Message .='<tr>';
                $Message .='<td>Job : '.$data->jobs->title.'</td>';
            $Message .='</tr>';
            endif;
            if(!empty($data->experience)):
            $Message .='<tr>';
                $Message .='<td>Experience : '.$data->experience.'</td>';
            $Message .='</tr>';
            endif;
            $Message .='<tr>';
                $Message .='<td>Email : '.$data->email.'</td>';
            $Message .='</tr>';
            $Message .='<tr>';
                $Message .='<td>Phone : '.$data->phone.'</td>';
            $Message .='</tr>';
            if(!empty($data->resume)):
            $Message .='<tr>';
                // $Message .='<th>Resume : <a href='.asset('uploads/resume/'.$data->resume).' download>Download Resume</a></th>';
            $Message .='</tr>';
            endif;
            $Message .='<tr>';
                $Message .='<td>Message : '.$data->message.'</td>';
            $Message .='</tr>';
        $Message .='</table>';
        $mailData = [
            'subject' => 'Job Enquiry Have Recived From '.project().'.',
            'message' => $Message,
            'resume' => $data->resume
        ];         
        \Mail::to(mailsupportemail())->CC(ccadminmail())->send(new \App\Mail\EnquiryMail($mailData));

        $Message ='<h5>Hi '.$data->name.',</h5>';
        $Message .='<p>Thankyou for apply. Below are the information you`ve provided</p>';
        $Message .='<table>';
            $Message .='<tr>';
                $Message .='<td>Name : '.$data->name.'</td>';
            $Message .='</tr>';
            if(!empty($data->jobs)):
            $Message .='<tr>';
                $Message .='<td>Job : '.$data->jobs->title.'</td>';
            $Message .='</tr>';
            endif;
            if(!empty($data->experience)):
            $Message .='<tr>';
                $Message .='<td>Experience : '.$data->experience.'</td>';
            $Message .='</tr>';
            endif;
            $Message .='<tr>';
                $Message .='<td>Email : '.$data->email.'</td>';
            $Message .='</tr>';
            $Message .='<tr>';
                $Message .='<td>Phone : '.$data->phone.'</td>';
            $Message .='</tr>';
            if(!empty($data->resume)):
            // $Message .='<tr>';
            //     $Message .='<th>Resume : <a href='.asset('storage/uploads/resume/'.$data->resume).' download>Download Resume</a></th>';
            // $Message .='</tr>';
            endif;
            $Message .='<tr>';
                $Message .='<td>Message : '.$data->message.'</td>';
            $Message .='</tr>';
        $Message .='</table>';
        $mailData = [
            'subject' => 'Thank you for your query : '.project().'.',
            'message' => $Message,
            'resume' => $data->resume
        ];         
        \Mail::to($data->email)->send(new \App\Mail\EnquiryMail($mailData));

        return response()->json([
            'success'=>'It is a pleasure to receive your inquiry.'
        ]);
    }
}