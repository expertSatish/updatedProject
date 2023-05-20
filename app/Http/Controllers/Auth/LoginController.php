<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Tzsk\Otp\Facades\Otp;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware(['guest','guest:expert']);
    }

    public function userlogin(Request $r){ 
        $r->validate([
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
        ],[
            'email.required' => 'phone no / email address field is required.',
        ]);  
        $check = \App\Models\User::where('email',$r->email)->orwhere('mobile',$r->email)->first();
        if(empty($check)){
            return response()->json(['errors'=>['email'=>'this credential does not found in our records.']],422);
        }
        if($check->is_publish==0){
            return response()->json(['errors'=>['email'=>'this user is not active by administrator.']],422);
        }
        $otp = generateotp(4);
        $otp_expires_time = Carbon::now('Asia/Kolkata')->addSeconds(30);        
        $user = \App\Models\User::find($check->id);
        $user->otp = $otp;
        $user->save();
        $otpfor=0;
        if(!is_numeric($r->email)){
            // $r->validate([
            //     'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            // ]);
            $body = ['otp'=>$otp ];
            \Mail::to($check->email)->send(new \App\Mail\SendEmailOtp($body));
            $otpfor=1;
        }
        return response()->json([
            'success' => 'OTP has been sent on '.$r->email,
            'otp' => $otp,
            'otpfor' => $otpfor
        ]); 
    }
    public function userloginotpcheck(Request $r){        
        $r->validate([
            'otp' => 'required',
        ]); 
        $check = \App\Models\User::where('email',$r->email)->orwhere('mobile',$r->email)->first();
        if(empty($check)){
            return response()->json(['errors'=>['email'=>'this credential does not found in our records.']],422);
        }
        if($r->otp==$check->otp){
            if($check->complete_profile==0){  session()->flash('warning','You have not complete your profile.complete your profile first.');}
            else{  session()->flash('success','Welcome to expertbells!');}            
            \Auth::login($check);
            $user = \App\Models\User::find($check->id);
            $user->otp = 0;
            $user->save();
            if(!empty($r->redirect)){
                return response()->json([ 'redirect'=>$r->redirect ]);
            }else{
                return response()->json([ 'redirect'=>route('user.dashboard') ]);
            }           
        }else{
            return response()->json(['errors'=>['otp'=>'Invalid OTP!']],422);
        }       
    }

    /// EXPERT
    public function expertlogin(Request $r){ 
        $r->validate([
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
        ],[
            'email.required' => 'phone no / email address field is required.',
        ]);  
        $check = \App\Models\Expert::where('email',$r->email)->orwhere('mobile',$r->email)->first();
        if(empty($check)){
            return response()->json(['errors'=>['email'=>'this credential does not found in our records.']],422);
        }
        if($check->is_publish==0){
            return response()->json(['errors'=>['email'=>'this expert is not active by administrator.']],422);
        }
        $otp = generateotp(4);    
        $user = \App\Models\Expert::find($check->id);
        $user->otp = $otp;
        $user->save();
        $otpfor=0;
        if(!is_numeric($r->email)){
            // $r->validate([
            //     'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            // ]);
            $body = ['otp'=>$otp ];
            \Mail::to($check->email)->send(new \App\Mail\SendEmailOtp($body));
            $otpfor=1;
        }
        return response()->json([
            'success' => 'OTP has been sent on '.$r->email,
            'otp' => $otp,
            'otpfor' => $otpfor
        ]); 
    }
    public function expertloginotpcheck(Request $r){        
        $r->validate([
            'otp' => 'required',
        ]); 
        $check = \App\Models\Expert::where('email',$r->email)->orwhere('mobile',$r->email)->first();
        if(empty($check)){
            return response()->json(['errors'=>['email'=>'this credential does not found in our records.']],422);
        }
        if($r->otp==$check->otp){
            if (\Auth::guard('expert')->attempt(['email'=>$check->email,'password'=>$check->password_text])) {
                session()->flash('success','Welcome to expertbells!');        
                $user = \App\Models\Expert::find($check->id);
                $user->otp = 0;
                $user->save();
                if($user->profile_complete==0){
                    // if($user->registration_step > 2){
                    //     return response()->json([
                    //         'redirect'=>route('expert.register',['type'=>'s'.($user->registration_step + 1)])
                    //     ]);
                    // }else{
                    //     return response()->json([
                    //         'redirect'=>route('expert.register',['type'=>'s1'])
                    //     ]);
                    // }
                    return response()->json([
                        'redirect'=>route('expert.register',['type'=>'s3'])
                    ]);
                    
                }
                return response()->json([
                    'redirect'=>route('expert.dashboard')
                ]);
            }            
        }else{
            return response()->json(['errors'=>['otp'=>'Invalid OTP!']],422);
        }       
    }
}
