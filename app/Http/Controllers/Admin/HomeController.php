<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function loginverification(){
        $verificationCode   = \App\Models\VerificationCode::where(['user_id'=>\Auth::guard('admin')->user()->id,'type'=>'admin'])->latest()->first();
        $now = \Carbon\Carbon::now();
        if($now->isAfter($verificationCode->expire_at)==true){
            \Auth::guard('admin')->logout();
            session()->flash('success','Logout! Verification Expired');
            return redirect()->route('admin.login');
        }
        return view('admin.login-verification');
    }
    public function checkloginverification(Request $request){
        $request->validate([
            'otp' => 'required',
        ]); 
        $verificationCode   = \App\Models\VerificationCode::where(['user_id'=>admininfo()->id,'type'=>'admin'])->where('otp', $request->otp)->first();

        $now = \Carbon\Carbon::now();
        if (!$verificationCode) {
            return back()->withErrors(['otp'=>'Your OTP is not correct']);
        }

        $verificationCode->update([
            'expire_at' => \Carbon\Carbon::now(),
            'verify' => 1
        ]);

        return redirect()->route('admin.dashboard')->with(['success_msg'=>'Welcome to '.project().' admin panel: '.admininfo()->name]);
    }
    public function create(){
        $experts = \App\Models\Expert::whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->count();
        $texperts = \App\Models\Expert::count();
        $users = \App\Models\User::whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->count();
        $tusers = \App\Models\User::count();
        $slots = \App\Models\SlotBook::whereMonth('booking_date',date('m'))->whereYear('booking_date',date('Y'))->count();
        $tslots = \App\Models\SlotBook::count();
        $incomes = \App\Models\SlotBook::whereIn('payment',[1,3])->where('call_end_by','>',0)->whereMonth('booking_date',date('m'))->whereYear('booking_date',date('Y'))->sum('paid_amount');
        $tincomes = \App\Models\SlotBook::whereIn('payment',[1,3])->where('call_end_by','>',0)->sum('paid_amount');
        
        $todayslots = \App\Models\SlotBook::whereDate('booking_date',date('Y-m-d'))->get();
        $todayexperts = \App\Models\Expert::whereDate('created_at',date('Y-m-d'))->get();
        $todayusers = \App\Models\User::whereDate('created_at',date('Y-m-d'))->get();
        
        return view('admin.dashboard',compact('experts','todayexperts','todayusers','todayslots','texperts','users','slots','incomes','tusers','tslots','tincomes'));
    }
    function Change_Password(){
        return view('admin.change-password');
    }
    public function Update_Password(Request $r){
        $validated = $r->validate([
            'email_address' => 'required|email',
        ]);
        $check = \App\Models\Admin::where('email',$r->email_address)->where('id','!=',admininfo()->id)->count();
        if($check>0){ return back()->with('error', 'Sorry! this email address already taken!'); }
        if($r->password!=$r->confirm_password){
            return back()->with('error', 'Sorry! confirm password does`t match!');
        }
        $data = \App\Models\Admin::find(admininfo()->id);
        $data->name = $r->name;
        $data->email = $r->email_address;
        if(!empty($r->password)){ $data->password = bcrypt($r->password); }
        $data->save();
        return back()->with('success', 'Detail have been updated!');
    }
    public function footersection(){
        $lists = \App\Models\Setting::find(1);
        return view('admin.footer-section',compact('lists'));
    }
    public function savefooter(Request $r){
        $data = \App\Models\Setting::find($r->id);
        $data->footer_about = $r->about;
        $data->footer_support = $r->support;
        $data->save();
        return back()->with('success', 'Detail have been updated!');
    }

    /// Home Videos 
    public function homeexpertvidoes(){
        $lists = \App\Models\ExpertVideo::latest()->paginate(30);
        return view('admin.expert-video',compact('lists'));
    }
    public function homeexpertvidoesstaus(Request $r){
        \App\Models\ExpertVideo::where('is_publish',1)->update(['set_home'=>0]);
        if(!empty($r->set)):
            foreach($r->set as $id => $value):
                $data = \App\Models\ExpertVideo::find($id);
                $data->set_home = 1;
                $data->save();
            endforeach;
        endif;       
        return back()->with('success', 'Status have been updated!');
    }
}
