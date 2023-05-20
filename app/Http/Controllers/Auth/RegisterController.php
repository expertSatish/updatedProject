<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Expertise;
use App\Models\Industry;
use App\Models\State;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class RegisterController extends Controller{    
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(){
        $this->middleware('guest');
        $this->middleware('guest:expert');
    }
    public function sendemailotp(Request $request){
        $request->validate([
            'email' => [
                'required',
                'regex:/(.+)@(.+)\.(.+)/i',
                Rule::unique('experts')->whereNull('deleted_at'),
                Rule::unique('users')->whereNull('deleted_at')
            ]
        ]);
        $otp = generateotp(4);
        $body = ['otp'=>$otp ];
        \Mail::to($request->email)->send(new \App\Mail\SendEmailOtp($body));
        return response()->json([
            'success' => 'OTP sended on you email address. please check your inbox.',
            'otp'=>$otp
        ]);
    }
    public function sendmobileotp(Request $request){
        $request->validate([
            'mobile' => [
                'required',
                'min:10',
                'max:10',
                Rule::unique('experts')->whereNull('deleted_at'),
                Rule::unique('users')->whereNull('deleted_at')
            ],
        ]);
        $otp = generateotp(4);
        $html = '';
        $html .= '<p>Your email verification code is '.$otp.'. please don`t share this otp to others.</p>';
        return response()->json([
            'success' => 'OTP sended on you mobile.',
            'otp'=>$otp
        ]);
    }
    public function userregister(){
        $currentUserInfo = \Location::get(myipaddress());
        $ccode = \App\Models\Country::where('status',1);
        if(!empty($currentUserInfo->countryCode)){ $ccode = $ccode->where('sortname',$currentUserInfo->countryCode); }
        else{ $ccode = $ccode->where('phonecode',91); }
        $ccode = $ccode->first();
        return view('auth.user.user-register',compact('ccode'));
    }
    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function usersavestep1(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|between:3,50|regex:/^[&a-zA-Z\s]+$/',
            'email' => 'between:3,50|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$/|unique:users|unique:experts',
            'mobile' => 'required|regex:/^[6-9][0-9]{9}$/|unique:users|unique:experts',
        ],
        [
            'string' => ':attribute is not invalid .',
            'required' => ':attribute is required.',
            'unique' => ':attribute already exists.',
            'regex' => ':attribute is invalid.',
            'between' => ':attribute must be between :min to :max.',
          ],['first_name' => 'Name', 'email'=>'Email', 'mobile' => 'Mobile']);
        if ($validator->fails()) {
            return Redirect ::back()->withErrors($validator)->withInput($request->all());
        }
        $data = new \App\Models\User();
        $data->name = $request->first_name.' '.$request->last_name;
        $data->mobile = $request->mobile;
        $data->ccode = $request->ccode;
        $data->email = $request->email;
        $data->billing_address = $request->billing_address;
        $data->compnay_name = $request->company_name;
        $data->gst_number = $request->gst_number;
        $data->email_verify = 1;
        $data->mobile_verify = 1;
        $data->email_notification = 1;
        $data->mobile_notification = 1;
        $data->is_publish = 1;
        $data->user_id = generateuserno();
        $data->complete_profile =1;
        $data->last_login = date('Y-m-d H:i:s');
        $data->save();
        return redirect('user-step-sec/'.$data->user_id);
       
    }
    public function usersec($userId){
        $data['countries'] = Country::get(["name", "id"]);
        return view('auth.user.user-register-sec',compact('userId'),$data);
    }
    public function savesecSave(Request $request){
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'designation' => 'required',
            'gst_number' => 'required',
        ],
        [
            'string' => ':attribute is not invalid .',
            'required' => ':attribute is required.',
            'unique' => ':attribute already exists.',
            'regex' => ':attribute is invalid.',
            'between' => ':attribute must be between :min to :max.',
          ],['company_name' => 'CompanyName', 'designation'=>'Designation', 'city' => 'City', 'country'=>'Country']);
        if ($validator->fails()) {
            return Redirect ::back()->withErrors($validator)->withInput($request->all());
        }
        $data = User::userUpdateSec($request,$request->user_id);
        return redirect('user-step-third/'.$data->user_id);
       
    }

    public function savethirdSave($userId){
        $industries = Industry::get();
        return view('auth.user.user_third_step',compact('userId','industries'));
    }

    public function thirdSave(Request $request){
        $validator = Validator::make($request->all(), [
            'stage_of_startup' => 'required',
            'industry' => 'required',
        ],
        [
            'string' => ':attribute is not invalid .',
            'required' => ':attribute is required.',
            'unique' => ':attribute already exists.',
            'regex' => ':attribute is invalid.',
            'between' => ':attribute must be between :min to :max.',
          ],['stage_of_startup' => 'Stage Of Sartup', 'industry'=>'Industry']);
        if ($validator->fails()) {
            return Redirect ::back()->withErrors($validator)->withInput($request->all());
        }
        $data = User::userUpdateThird($request,$request->user_id);
        // \Auth::login($data);
        // return redirect()->route('user.dashboard');
        return redirect('user-step-four/'.$data->user_id);
    }
    public function fourSave(Request $request){
        $validator = Validator::make($request->all(), [
            'objectives' => 'required',
        ],
        [
            'string' => ':attribute is not invalid .',
            'required' => ':attribute is required.',
            'unique' => ':attribute already exists.',
            'regex' => ':attribute is invalid.',
            'between' => ':attribute must be between :min to :max.',
          ],['objectives' => 'Objectives']);
        if ($validator->fails()) {
            return Redirect ::back()->withErrors($validator)->withInput($request->all());
        }
        $data = User::userUpdatefour($request,$request->user_id);
        \Auth::login($data);
        return redirect()->route('user.dashboard');
    }

    public function fourstep($userId){
        $expertise = Expertise::get();
        return view('auth.user.user_four_step',compact('userId','expertise'));
    }
    //// Expert
    public function checkexpertexist(Request $request){
        if(empty($request->email)){
            return response()->json(['errors'=>['email'=>'Email filed is required.']],422);
        }
        if(!empty($request->email)){
            $checkexpert = \App\Models\Expert::where(['email'=>$request->email,'deleted_at'=>null])->count();
            $checkuser = \App\Models\User::where(['email'=>$request->email,'deleted_at'=>null])->count();
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['errors'=>['email'=>'Invalid email format.']],422);
            }elseif(!empty($checkexpert)){ 
                return response()->json(['errors'=>['email'=>'This Email address is already exists in our record.']],422);
            }elseif(!empty($checkuser)){ 
                return response()->json(['errors'=>['email'=>'This Email address is already exists in our record.']],422);
            }
        }
        if(empty($request->mobile)){
            return response()->json(['errors'=>['mobile'=>'Mobile filed is required.']],422);
        }
        if(!empty($request->mobile)){
            $checkexpert = \App\Models\Expert::where(['mobile'=>$request->mobile,'deleted_at'=>null])->count();
            $checkuser = \App\Models\User::where(['mobile'=>$request->mobile,'deleted_at'=>null])->count();
            if(!empty($checkexpert)){ 
                return response()->json(['errors'=>['mobile'=>'This mobile number is already exists in our record.']],422);
            }elseif(!empty($checkuser)){ 
                return response()->json(['errors'=>['mobile'=>'This mobile number is already exists in our record.']],422);
            }
        }
        return response()->json([
            'success'=>1
        ]);
    }
    public function expertregister(){
        if(!empty(request('name'))){
            $currentUserInfo = \Location::get(myipaddress());
            $ccode = \App\Models\Country::where('status',1);
            if(!empty($currentUserInfo->countryCode)){ $ccode = $ccode->where('sortname',$currentUserInfo->countryCode); }
            else{ $ccode = $ccode->where('phonecode',91); }
            $ccode = $ccode->first();
            return view('auth.expert.register-2',compact('ccode'));
        }else{
            return view('auth.expert.register');
        }

        $qualifications = \App\Models\Qualification::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $expertises = \App\Models\Expertise::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $languages = \App\Models\Language::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $Industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $workings = \App\Models\Working::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $categories = \App\Models\ExpertCategory::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $roles = \App\Models\Role::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $currentUserInfo = \Location::get(myipaddress());
        $ccode = \App\Models\Country::where('status',1);
        if(!empty($currentUserInfo->countryCode)){ $ccode = $ccode->where('sortname',$currentUserInfo->countryCode); }
        else{ $ccode = $ccode->where('phonecode',91); }
        $ccode = $ccode->first();
        return view('auth.expert.register',compact('ccode','roles','categories','qualifications','expertises','languages','Industries','workings'));
    }
    public function saveexpertregister(Request $request){   
        $request->validate([
            'email' => 'required|email',
            'mobile' => 'required|max:10|min:10',
            'address' => 'required|max:300',
        ]);

        $checkemail = \App\Models\Expert::where(['email'=>$request->email])->first();
        $checkmobile = \App\Models\Expert::where(['mobile'=>$request->mobile])->first();

        if(!empty($checkemail)){  return back()->with(['email'=>$checkemail->email,'password'=>$checkemail->password_text]); }
        if(!empty($checkmobile)){  return back()->with(['email'=>$checkmobile->email,'password'=>$checkmobile->password_text]); }

        $checkemail = \App\Models\Expert::where(['email'=>$request->email])->withTrashed()->first();
        $checkmobile = \App\Models\Expert::where(['mobile'=>$request->mobile])->withTrashed()->first();

        if(!empty($checkemail)){  return back()->with(['email'=>$checkemail->email,'password'=>$checkemail->password_text]); }
        if(!empty($checkmobile)){  return back()->with(['email'=>$checkmobile->email,'password'=>$checkmobile->password_text]); }

        $password = generateexpertno();
        $data = new \App\Models\Expert();
        $data->user_id = generateexpertno();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->ccode = $request->ccode;
        $data->email = $request->email;
        $data->registration_step = 2;
        $data->address = $request->address;
        $data->password = \Hash::make($password);
        $data->password_text = $password;
        $data->sequence = (\App\Models\Expert::max('sequence') + 1);
        $data->last_login = date('Y-m-d H:i:s');
        $data->save();
        if(\Auth::guard('expert')->attempt(['email'=>$data->email,'password'=>$data->password_text])){ }
        return redirect(route('expert.register',['type'=>'s3']));
        // return redirect(url('login'))->with('success','Thank you for registered in our expert list.we will notified your when your account is approved by administrator.');         
    }
    public function resumeexpertaccount(){
        $checkemail = \App\Models\Expert::withTrashed()->where(['email'=>request('warning_email'),'password_text'=>request('warning_password')])->first();
        if(!empty($checkemail)){
            $data = \App\Models\Expert::withTrashed()->find($checkemail->id)->restore();
            
        }
        if (\Auth::guard('expert')->attempt(['email'=>request('warning_email'),'password'=>request('warning_password')])) {
            return redirect(route('expert.dashboard'))->with('success','Welcome to expertbells!');
        }else{
            return back()->with('error','Something went wrong! Please try again.');
        }     
    }
}
