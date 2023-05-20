<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOtpVerification
{
   
    public function handle(Request $request, Closure $next)
    {
        if(\Auth::guard('admin')->check()){
            $now = \Carbon\Carbon::now();
            $verificationCode   = \App\Models\VerificationCode::where(['user_id'=>\Auth::guard('admin')->user()->id,'type'=>'admin'])->latest()->first();
            if($now->isAfter($verificationCode->expire_at)==true && $verificationCode->verify==0){
                \Auth::guard('admin')->logout();
                session()->flash('success','Logout! Verification Expired');
                return redirect()->route('admin.login');
            }
            if($verificationCode->verify==0 && $now->isAfter($verificationCode->expire_at)==false){
                return redirect()->route('admin.loginverification');
            }                  
        }
        return $next($request);
    }
}
