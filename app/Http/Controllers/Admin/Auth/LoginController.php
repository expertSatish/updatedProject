<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }
    public function create(){
        return view('admin.auth.login');
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);   
        $credentials = $request->only('email', 'password');
        if (\Auth::guard('admin')->attempt($credentials)) {
            $this->generateOtp(admininfo()->id);
            return redirect()->intended(RouteServiceProvider::ADMINHOME)->with(['success_msg'=>'Welcome to '.project().' admin panel: '.admininfo()->name]);
        }
  
        return redirect()->route("admin.login")->withErrors(['email'=>'These credentials do not match our records.']);
    }
    public function generateOtp($adminid){
        $verificationCode = \App\Models\VerificationCode::where(['user_id'=>$adminid,'type'=>'admin'])->latest()->first();
        $now = \Carbon\Carbon::now();
        $otp = rand(123456, 999999);
        $message = '';
        $message .='Hello Expertbells,<br>';
        $message .='We would like to inform you that the expertbells control panel has been login from this IP Address: '.request()->ip().'<br>';
        $message .='Login verification code is '.$otp.'. Please do not share someone else for security porpose.';

        $mailData = [
            'subject' => 'Control panel login verification : '.project().'.',
            'message' => $message
        ];   
        \Mail::to(env('App_ADMIN_LOGIN','rahul@expertbells.com'))->send(new \App\Mail\EnquiryMail($mailData));
        return \App\Models\VerificationCode::create([
            'user_id' => $adminid,
            'otp' => $otp,
            'type' => 'admin',
            'ip' => request()->ip(),
            'expire_at' => \Carbon\Carbon::now()->addMinutes(15)
        ]);        
    }
    public function destroy(){
        \Auth::guard('admin')->logout();
        return back()->with('success','Logout!');
    }
}