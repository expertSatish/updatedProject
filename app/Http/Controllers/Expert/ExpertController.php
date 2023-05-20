<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ExpertController extends Controller
{
    public function expertlogout(){
        if(expertinfo()->profile_complete>0){
            session()->flash('success','Thank you for coming!');       
        }
           
        \Auth::guard('expert')->logout();
        return redirect()->route('login');
    }

    public function registeration($type){
        if($type=='s3'){
            $workings = \App\Models\Working::where('is_publish',1)->orderBy('sequence','ASC')->get();        
            return view('auth.expert.register-3',compact('workings'));
        }elseif($type=='s4'){
            $roles = \App\Models\Role::where('is_publish',1)->orderBy('sequence','ASC')->get();
            $expertroles = \App\Models\ExpertRole::where('expert_id',expertinfo()->id)->get();
            $exrol=[];
            foreach($expertroles as $rl){
                array_push($exrol,$rl->role);
            }
            return view('auth.expert.register-4',compact('roles','exrol'));
        }elseif($type=='s5'){
            $expertises = \App\Models\Expertise::where('is_publish',1)->orderBy('sequence','ASC')->get();  
            $expertexprt = \App\Models\ExpertExpertise::where('expert_id',expertinfo()->id)->get();
            $extr=[];
            foreach($expertexprt as $rl){
                array_push($extr,$rl->expertise_id);
            }      
            return view('auth.expert.register-5',compact('expertises','extr'));
        }elseif($type=='s6'){
            $Industries = \App\Models\Industry::where('is_publish',1)->orderBy('sequence','ASC')->get();
            $expertIndustries = \App\Models\ExpertIndustry::where('expert_id',expertinfo()->id)->get();
            $exind=[];
            foreach($expertIndustries as $rl){
                array_push($exind,$rl->industry_id);
            }
            return view('auth.expert.register-6',compact('Industries','exind'));
        }elseif($type=='s7'){
            $languages = \App\Models\Language::where('is_publish',1)->orderBy('sequence','ASC')->get();
            $expertlanguages = \App\Models\ExpertLanguage::where('expert_id',expertinfo()->id)->get();
            $exlang=[];
            foreach($expertlanguages as $rl){
                array_push($exlang,$rl->language_id);
            }
            return view('auth.expert.register-7',compact('languages','exlang'));
        }elseif($type=='s8'){
            return view('auth.expert.register-8');
        }elseif($type=='s9'){
            return view('auth.expert.register-9');
        }elseif($type=='s10'){
            return view('auth.expert.register-10');
        }elseif($type=='s11'){
            return view('auth.expert.register-11');
        }elseif($type=='s12'){
            return view('auth.expert.register-12');
        }elseif($type=='s13'){
            $terms = \App\Models\ExpertRegisterTerms::where('is_publish',1)->get();
            return view('auth.expert.register-13',compact('terms'));
        }else{
            return $this->expertlogout();
        }
    }

    public function saveregisteration(Request $r,$step){
        if($step=='s3'){
            $r->validate([
                'working' => 'required'
            ]);
            return $this->SaveRegistrationStep3($r->all());

        }elseif($step=='s4'){
            $r->validate([
                'company_name' => 'required',
                'role' => 'required',
                'other_role' => 'required_if:role,==,27'
            ]);
            return $this->SaveRegistrationStep4($r->all());

        }elseif($step=='s5'){
            $r->validate([
                'expertise' => 'required'
            ]);
            if(count($r->expertise)>2){
                return back()->with('error','Sorry! you can`t add more than 2 expertise.');
            }
            return $this->SaveRegistrationStep5($r->all());
            
        }elseif($step=='s6'){
            $r->validate([
                'industry' => 'required'
            ]);
            return $this->SaveRegistrationStep6($r->all());
            
        }elseif($step=='s7'){
            $r->validate([
                'language' => 'required'
            ]);
            return $this->SaveRegistrationStep7($r->all());
            
        }elseif($step=='s8'){
            $r->validate([
                'charge' => 'required'
            ]);
            return $this->SaveRegistrationStep8($r->all());
            
        }elseif($step=='s9'){
            $r->validate([
                'take_session' => 'required'
            ]);
            return $this->SaveRegistrationStep9($r->all());
            
        }elseif($step=='s10'){
            $r->validate([
                'bio' => 'required'
            ]);
            return $this->SaveRegistrationStep10($r->all());
            
        }elseif($step=='s11'){
            $r->validate([
                'linkedin' => 'nullable|url',
                'instagram' => 'nullable|url',
                'youtube_channel' => 'nullable|url',
                'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000'
            ]);
            return $this->SaveRegistrationStep11($r->all());
            
        }
        elseif($step=='s12'){
            $r->validate([
                'experience' => 'required',
            ]);
            return $this->SaveRegistrationStep12($r->all());
        }
        elseif($step=='s13'){
            return $this->SaveRegistrationStep13($r->all());
        }
    }

    public function SaveRegistrationStep3($request){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->currently_working_as = $request['working'];
        $data->registration_step = 3;
        $data->save();
        return redirect(route('expert.register',['type'=>'s4']));
    }

    public function SaveRegistrationStep4($request){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->compnay_name = $request['company_name'];
        $data->registration_step = 4;
        $data->save();

        if(!empty($request['role'])){
            \App\Models\ExpertRole::where('expert_id',$data->id)->delete();
            foreach($request['role'] as $role){
                $expertrole = new \App\Models\ExpertRole();
                $expertrole->role = $role;
                $expertrole->other_role = $request['other_role'];
                $expertrole->expert_id = $data->id;
                $expertrole->save();
            }
        }

        return redirect(route('expert.register',['type'=>'s5']));
    }

    public function SaveRegistrationStep5($request){
        
        if(!empty($request['expertise'])){
            \App\Models\ExpertExpertise::where('expert_id',expertinfo()->id)->delete();
            foreach($request['expertise'] as $expertise){
                $data = new \App\Models\ExpertExpertise();
                $data->expertise_id = $expertise;
                $data->expert_id = expertinfo()->id;
                $data->save();
            }
        }
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->registration_step = 5;
        $data->save();
        return redirect(route('expert.register',['type'=>'s6']));
    }

    public function SaveRegistrationStep6($request){
        if(!empty($request['industry'])){
            \App\Models\ExpertIndustry::where('expert_id',expertinfo()->id)->delete();
            foreach($request['industry'] as $industry){
                $expertrole = new \App\Models\ExpertIndustry();
                $expertrole->industry_id = $industry;
                $expertrole->expert_id = expertinfo()->id;
                $expertrole->save();
            }
        }
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->registration_step = 6;
        $data->save();
        return redirect(route('expert.register',['type'=>'s7']));
    }

    public function SaveRegistrationStep7($request){
        if(!empty($request['language'])){
            \App\Models\ExpertLanguage::where('expert_id',expertinfo()->id)->delete();
            foreach($request['language'] as $language){
                $expertrole = new \App\Models\ExpertLanguage();
                $expertrole->language_id = $language;
                $expertrole->expert_id = expertinfo()->id;
                $expertrole->save();
            }
        }
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->registration_step = 7;
        $data->save();
        return redirect(route('expert.register',['type'=>'s8']));
    }

    public function SaveRegistrationStep8($request){
        $charge =  $request['charge'] * 75/100;
        $msg = "you can't charge more than 75% of Hourly rate";
        if($request['charge_30_min'] > $charge){
            return redirect()->back()->with('danger', $msg);
        }
       
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->charge = $request['charge'];
        $data->registration_step = 8;
        $data->save();
        \App\Models\SlotCharge::where('expert_id',expertinfo()->id)->delete();
        $charges = new \App\Models\SlotCharge();
        $charges->expert_id = expertinfo()->id;
        $charges->slot_time_id = 2;
        $charges->charges = $data->charge;        
        $charges->is_publish = 1;        
        $charges->sequence = (\App\Models\SlotCharge::max('sequence') + 1);
        $charges->save();
        $charges = new \App\Models\SlotCharge();
        $charges->expert_id = expertinfo()->id;
        $charges->slot_time_id = 1;
        $charges->charges = $request['charge_30_min'];   
        $charges->is_publish = 1;        
        $charges->sequence = (\App\Models\SlotCharge::max('sequence') + 1);
        $charges->save();

        return redirect(route('expert.register',['type'=>'s9']));
    }

    public function SaveRegistrationStep9($request){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->take_session = $request['take_session'];
        $data->registration_step = 9;
        $data->save();
        return redirect(route('expert.register',['type'=>'s10']));
    }

    public function SaveRegistrationStep10($request){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->bio = $request['bio'];
        $data->registration_step = 10;
        $data->save();
        return redirect(route('expert.register',['type'=>'s11']));
    }

    public function SaveRegistrationStep11($request){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->linkedin = $request['linkedin'];
        $data->instagram = $request['instagram'];
        $data->registration_step = 11;
        $data->youtube_channel_link = $request['youtube_channel'];
        $data->save();

        
        if(!empty($request['video'])){
            $VideoName = directFile('uploads/expert/video/',$request['video']);
            $data = new \App\Models\ExpertVideo();
            $data->title = 'My Introduction';
            $data->industries = 0;
            $data->expert_id = expertinfo()->id;
            $data->video_type = 2;
            $data->video = $VideoName ?? '';
            $data->description = 'My Introduction video';
            $data->is_publish = 1;
            $data->video_id = generateexpertvideoid();
            $data->sequence = (\App\Models\ExpertVideo::max('sequence') + 1);
            $data->save();
        }
        

        return redirect(route('expert.register',['type'=>'s12']));
    }

    public function SaveRegistrationStep12($request){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->experience = $request['experience'];
        $data->registration_step = 12;
        $data->save();
        // \Auth::guard('expert')->logout();
        return redirect(route('expert.register',['type'=>'s13']));
        // return redirect(route('login'))->with('success','Thank you! your profile is completed. please wait for admin approval!');
        // return redirect(route('expert.dashboard'));
    }

    public function SaveRegistrationStep13($request){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->agree_terms=$request['agree']; 
        if($request['agree']==1){
            $data->registration_step = 13;
            $data->profile_complete=1;
        }     
        $data->save();
        \Auth::guard('expert')->logout();
        if($request['agree']==1){
            return redirect(route('login'))->with('success','Thank you! your profile is completed. please wait for admin approval!');
        }else{
            return redirect(route('home'));
        }
    }


    /// END Registration
    public function updatebankDetails(Request $r){
        $r->validate([
            'holder_name' => 'required',
            'bank_name' => 'required',
            'ifsc' => 'required',
            'account_no' => 'required',
        ]); 
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->holder_name = $r->holder_name ;
        $data->bank_name = $r->bank_name ;
        $data->ifsc = $r->ifsc ;
        $data->account_no = $r->account_no ;
        $data->save();

        return response()->json([
            'success'=>'Information Updated!'
        ]);
    }
    public function removewhatexpect(Request $r){
        $whatexpects = \App\Models\WhatExpect::find($r->removeid);
        $whatexpects->delete();
        return response()->json([
            'success' => 'Data removed!'
        ]);
    }
    public function getwhatexpect(){
        $whatexpects = \App\Models\WhatExpect::where(['is_publish'=>1,'expert_id'=>expertinfo()->id])->orderBy('sequence','ASC')->get(); 
        $Html ='<ul class="prolist AllDetail">';
        foreach($whatexpects as $key => $whatexpect):
            $Html .='<li class="d-block listbox">';
                $Html .='<strong>'.($key + 1).'. '.$whatexpect->description.'</strong>';
                $Html .='<a href="javascript:void(0)" class="ms-3 p-2 py-1 rounded removeexpect" data-bs-removeid="'.$whatexpect->id.'"><i class="fal fa-trash-alt"></i></a>';
            $Html .='</li>';
        endforeach;
        $Html .='</ul>';
        return response()->json([
            'html' => $Html
        ]);
    }
    public function countrystates(Request $r){
        $states = \App\Models\State::where(['status'=>1,'country_id'=>$r->country])->get();
        $Html='<option value="">Choose State</option>';
        foreach($states as $state){
            $Html .='<option value="'.$state->id.'" '.(expertinfo()->state==$state->id?'selected':'').' >'.$state->name.'</option>';
        }
        return response()->json([
            'data'=>$Html
        ]);
    }
    public function statecities(Request $r){
        $cities = \App\Models\City::where(['status'=>1,'state_id'=>$r->state])->get();
        $Html='<option value="">Choose City</option>';
        foreach($cities as $city){
            $Html .='<option value="'.$city->id.'" '.(expertinfo()->city==$city->id?'selected':'').' >'.$city->name.'</option>';
        }
        return response()->json([
            'data'=>$Html
        ]);
    }
    public function savewhatexpect(Request $r){
        foreach($r->description as $description):
            $data = new \App\Models\WhatExpect();
            $data->description = $description;
            $data->expert_id = expertinfo()->id;
            $data->is_publish = 1;
            $data->sequence = (\App\Models\WhatExpect::max('sequence') + 1);
            $data->save();
        endforeach;
        return response()->json([
            'success'=>'Data Saved!'
        ]);
    }
    public function emailnotification(Request $r){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->email_notification = $r->permission ;
        $data->save();
        if($r->permission==0){ $message='Permission De-Actived';}
        if($r->permission==1){ $message='Permission Actived';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function mobilenotification(Request $r){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->mobile_notification = $r->permission ;
        $data->save();
        if($r->permission==0){ $message='Permission De-Actived';}
        if($r->permission==1){ $message='Permission Actived';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function profilevisibility(Request $r){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->profile_visibility = $r->permission ;
        $data->save();
        if($r->permission==0){ $message='Permission De-Actived';}
        if($r->permission==1){ $message='Permission Actived';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function videovisibility(Request $r){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->video_visibility = $r->permission ;
        $data->save();
        if($r->permission==0){ $message='Permission De-Actived';}
        if($r->permission==1){ $message='Permission Actived';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function deleteaccount(Request $r){
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->delete();
        if($r->permission==0){ $message='Account Restore Deleted';}
        if($r->permission==1){ $message='Account Deleted';}
        return response()->json([
            'success' => $message
        ]);
    }
    public function updateotherinformation(Request $r){
        $r->validate([
            // 'company_name' => 'required',
            'currently_working' => 'required',
            'role' => 'required',
            'take_session' => 'required|max:3',
            // 'charge' => 'required',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube_channel' => 'nullable|url',
            'expertises' => 'required',
            'languages' => 'required',
            'industries' => 'required',
            'bio' => 'required',
        ]); 
        if(count($r->expertises) > 2){
            return response()->json(['errors'=>['expertises'=>'You can`t add more than 2 expertises']],422);
        }
        $data = \App\Models\Expert::find(expertinfo()->id);
        $data->linkedin = $r->linkedin ;
        $data->compnay_name = $r->company_name ;
        $data->take_session = $r->take_session ;
         $data->experience = $r->experience ;
        // $data->charge = $r->charge ;
        $data->linkedin = $r->linkedin ;
        $data->instagram = $r->instagram ;
        $data->youtube_channel_link = $r->youtube_channel ;
        $data->bio = $r->bio ;
        $data->currently_working_as = $r->currently_working ;
        $data->save();

        // for($A=1;$A<=2;$A++){
        //     if($A==1){ $charges = $data->charge / 2; }
        //     else{ 
        //         $charges = $data->charge; 
        //         $slotprice = \App\Models\SlotCharge::where(['expert_id'=>expertinfo()->id,'slot_time_id'=>$A]);
        //         $slotprice = $slotprice->update(['charges'=>$charges]);
        //     }
            
        // }

        if(!empty($r->expertises)){
            \App\Models\ExpertExpertise::where('expert_id',expertinfo()->id)->delete();
            foreach($r->expertises as $expertise){
                $data = new \App\Models\ExpertExpertise();
                $data->expertise_id = $expertise;
                $data->expert_id = expertinfo()->id;
                $data->save();
            }
        }

        if(!empty($r->role)){
            \App\Models\ExpertRole::where('expert_id',expertinfo()->id)->delete();
            foreach($r->role as $role){
                $expertrole = new \App\Models\ExpertRole();
                $expertrole->role = $role;
                $expertrole->other_role = $r->other_role;                
                $expertrole->expert_id = expertinfo()->id;
                $expertrole->save();
            }
        }

        if(!empty($r->industries)){
            \App\Models\ExpertIndustry::where('expert_id',expertinfo()->id)->delete();
            foreach($r->industries as $industry){
                $expertrole = new \App\Models\ExpertIndustry();
                $expertrole->industry_id = $industry;
                $expertrole->expert_id = expertinfo()->id;
                $expertrole->save();
            }
        }

        if(!empty($r->languages)){
            \App\Models\ExpertLanguage::where('expert_id',expertinfo()->id)->delete();
            foreach($r->languages as $language){
                $expertrole = new \App\Models\ExpertLanguage();
                $expertrole->language_id = $language;
                $expertrole->expert_id = expertinfo()->id;
                $expertrole->save();
            }
        }

        return response()->json([
            'success'=>'Information Updated!'
        ]);
    }
    public function updateprofile(Request $r){
        $r->validate([
            'profile_name' => 'required|max:255|string',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:experts,email,'.expertinfo()->id.',id,deleted_at,NULL',
            'mobile' => 'required|min:10|max:10|unique:experts,mobile,'.expertinfo()->id.',id,deleted_at,NULL',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'profile' => 'nullable|mimes:jpg,png,jpeg,webp,avif,svg',
        ]);

        $data = \App\Models\Expert::find(expertinfo()->id); 
        $data->name = $r->profile_name;
        $data->email = $r->email;
        $data->mobile = $r->mobile;
        $data->ccode = $r->ccode;
        $data->country = $r->country;
        $data->state = $r->state;
        $data->city = $r->city;
        $data->gender = $r->gender;
        if(!empty($r->profile)){
            $extension =  $r->profile->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/expert/',$r->profile);
            }else{
                $FileName = autoheight('uploads/expert/',476,$r->profile);
            }
            if(!empty(expertinfo()->profile)){
                if(file_exists(public_path('uploads/expert/'.expertinfo()->profile))){
                    unlink(public_path('uploads/expert/'.expertinfo()->profile));
                }
                if(file_exists(public_path('uploads/expert/jpg/'.expertinfo()->profile.'.jpg'))){
                    unlink(public_path('uploads/expert/jpg/'.expertinfo()->profile.'.jpg'));
                }
                if(file_exists(public_path('uploads/expert/'.expertinfo()->profile.'.webp'))){
                    unlink(public_path('uploads/expert/'.expertinfo()->profile.'.webp'));
                }
            }
            $data->profile = $FileName;
            
        }
        $data->save();
        return response()->json([
            'success'=>'Information Updated!'
        ]);
    }
    public function savevideo(Request $r){
        $r->validate([
            'title' => 'required',
            'video_type' => 'required',
            'video_url' => 'required_if:video_type,==,1',
            'video' => 'required_if:video_type,==,2',
            // 'video_image' => 'required_if:video_type,==,2',
            // 'industries' => 'required',
            'description' => 'required',
        ],[
            'video_url.required_if' => 'The video url field is required.',
            'video.required_if' => 'The video field is required.',
            'video_image.required_if' => 'The video image field is required.'
        ]);

        if(!empty($r->video_image)){
            $extension =  $r->video_image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $FileName = directFile('uploads/expert/video/',$r->video_image);
            }else{
                $FileName = autoheight('uploads/expert/video/',480,$r->video_image);
            }
        }
        if(!empty($r->video)){
            $VideoName = directFile('uploads/expert/video/',$r->video);
        }

        $data = new \App\Models\ExpertVideo();
        $data->title = $r->title;
        $data->expert_id = expertinfo()->id;
        $data->video_type = $r->video_type;
        $data->video_url = $r->video_url ?? '';
        $data->video = $VideoName ?? '';
        $data->video_image = $FileName ?? '';
        // $data->industries = (!empty($r->industries) ? json_encode($r->industries) : '' );
        $data->description = $r->description;
        $data->is_publish = 1;
        $data->video_id = generateexpertvideoid();
        $data->sequence = (\App\Models\ExpertVideo::max('sequence') + 1);
        $data->save();
        return response()->json([
            'success'=>'Video Uploaded!'
        ]);
    }
    public function updatevideo(Request $r){
        $r->validate([
            'title' => 'required',
            'video_type' => 'required',
            'video_url' => 'required_if:video_type,==,1',
            // 'industries' => 'required',
            'description' => 'required',
        ],[
            'video_url.required_if' => 'The video url field is required.',
            'video.required_if' => 'The video field is required.',
            'video_image.required_if' => 'The video image field is required.'
        ]);

        if(!empty($r->video_image)){
            $extension =  $r->video_image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $FileName = directFile('uploads/expert/video/',$r->video_image);
            }else{
                $FileName = autoheight('uploads/expert/video/',480,$r->video_image);
            }
        }
        if(!empty($r->video)){
            $VideoName = directFile('uploads/expert/video/',$r->video);
        }

        $data = \App\Models\ExpertVideo::find($r->preid);
        $data->title = $r->title;
        $data->video_type = $r->video_type;
        $data->video_url = $r->video_url ?? '';
        if(!empty($r->video)){
            $data->video = $VideoName ?? '';
        }
        if(!empty($r->video_image)){
            $data->video_image = $FileName ?? '';
        }
        // $data->industries = (!empty($r->industries) ? json_encode($r->industries) : '' );
        $data->description = $r->description;
        $data->save();
        return response()->json([
            'success'=>'Video Updated!'
        ]);
    }


    public function withdrawalrequest(Request $r){
        $r->validate([
            'account_holder_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:200',
            'ifsc_code' => 'required|max:11|min:11',
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
        if($r->amount > expertinfo()->wallet){
            return response()->json(['errors'=>['amount'=>'You have insufficient wallet amount.']],422);
        }
        $bankId = $r->bankid;
        if(empty($r->bankid)){
            $bank = new \App\Models\ExpertBank();
            $bank->expert_id = expertinfo()->id;
            $bank->account_holder_name = $r->account_holder_name;
            $bank->bank_name = $r->bank_name;
            $bank->ifsc_code = $r->ifsc_code;
            $bank->account_number = $r->account_number;
            $bank->save();
            
            $bankId = $bank->id;
        }
        
        $data = new \App\Models\WithdrawalRequest();
        $data->expert_id = expertinfo()->id;
        $data->bank_id = $bankId;
        $data->amount = $r->amount;
        $data->is_publish = 1;
        $data->sequence = (\App\Models\WithdrawalRequest::max('sequence') + 1);
        $data->save();

        $transationno = generatetransationno();       
        $checktransationno = new \App\Http\Controllers\User\UserController();
        $transation = new \App\Models\ExpertWalletHistory();
        $transation->transationno = $checktransationno->checktransationno($transationno);
        $transation->expert_id = expertinfo()->id;
        $transation->amount = $r->amount;
        $transation->type = 'withdrawal';
        $transation->amounttype = 'd';
        $transation->is_publish = 0;
        $transation->sequence = (\App\Models\ExpertWalletHistory::max('sequence') + 1);
        $transation->save();
        return response()->json([
            'message' => 'Withdrawal request sent!'
        ]);
    }
    public function claimrequest(Request $r){
        $r->validate([
            'transaction_id' => 'required',
            'message' => 'required|string'
        ]);

        $data = new \App\Models\ClaimRequest();
        $data->expert_id = expertinfo()->id;
        $data->request_for = $r->transaction_id;
        $data->message = $r->message;
        $data->is_publish = 1;
        $data->sequence = (\App\Models\ClaimRequest::max('sequence') + 1);
        $data->save();
        
        return response()->json([
            'message' => 'Claim request sent!'
        ]);
    }

    ///SLOT
    public function addexpertslotprice(Request $r){
        foreach($r->charges as $key => $charges){
            $check = \App\Models\SlotCharge::where(['expert_id'=>expertinfo()->id,'slot_time_id'=>$key])->first();
            if(empty($check)){
                $data = new \App\Models\SlotCharge();
                $data->slot_time_id = $key;
                $data->charges = $charges;
                $data->is_publish = 1;
                $data->sequence = (\App\Models\SlotCharge::max('sequence') + 1);
                $data->expert_id = expertinfo()->id;
                $data->save();       
            }else{
                $data = \App\Models\SlotCharge::find($check->id);
                $data->slot_time_id = $key;
                $data->charges = $charges;
                $data->expert_id = expertinfo()->id;
                $data->save();
            }   
            
            if($data->slot_time_id==2){
                $expert = \App\Models\Expert::find(expertinfo()->id);
                $expert->charge = $charges;
                $expert->save();
            }
        }
        return response()->json([
            'success'=>'Slot Charges Updated!'
        ]);
    }
    public function expertslotavailability(Request $r){
        $r->validate([
            'from_time' => 'required',
            'to_time' => 'required',
        ],[
            'from_time.required' => 'The from filed is required.',
            'to_time.required' => 'The to filed is required.',
        ]);

        if(empty($r->preid)){ 
        $data = new \App\Models\SlotAvailability();             
        $data->is_publish = 1;
        $data->sequence = (\App\Models\SlotAvailability::max('sequence') + 1);
        }else{ 
            $data = \App\Models\SlotAvailability::find($r->preid); 
        }        
        $data->from_time = $r->from_time;
        $data->to_time = $r->to_time;
        $data->expert_id = expertinfo()->id;
        $data->day = $r->Available_for;
        $data->date = $r->Available_date;
        $data->save();

        return response()->json([
            'success'=>'Availability Saved!'
        ]);
    }
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
        $data->reschedule_by = 1;
        $data->save();

        $predata = \App\Models\SlotBook::find($bookingid);
        $predata->reschedule_slot = $data->id;
        $predata->save();

        $body = ['booking' => $data,'oldbooking'=>$oldbooking,'schedule'=> $data->expert->name ?? 'Expert' ];
        \Mail::to($data->expert->email)->send(new \App\Mail\User\Reschedule($body));
        \Mail::to(adminmail())->CC(ccadminmail())->send(new \App\Mail\Admin\Reschedule($body));


        return response()->json([
            'success' => 'Booking has been reschedule with booking #'.$data->booking_id.'.'
        ]);
    }


    //// MESSAGE
    public function sendmessage(Request $r){
        $r->validate([
            'to_recipient_email' => 'required|email',
            // 'subject' => 'required|string|max:200'
        ]);

        $check = \App\Models\SlotBook::join('users','slot_books.user_id','users.id');
        $check = $check->where('slot_books.expert_id',expertinfo()->id);
        $check = $check->where('users.email',$r->to_recipient_email);
        $check = $check->select('users.*');
        $check->get();
        if($check->count()==0){
            return response()->json(['errors'=>['to_recipient_email'=>'To recipient email address is not exists.']],422);
        }  
        
        $user = \App\Models\User::where('email',$r->to_recipient_email)->first();
        if(empty($user)){
            return response()->json(['errors'=>['to_recipient_email'=>'To recipient email address is not exists.']],422);
        } 
        $message = new \App\Models\ComposeMessage();
        $message->expert_id = expertinfo()->id;        
        $message->user_id = $user->id;      
        $message->subject = $r->subject;      
        $message->message = $r->message;
        $message->send_by = 1;
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
            'subject' => ($message->subject ?? 'Message has  sent by '.$user->name.' (USER) ').':'.project(),
            'message' => $message->message,
            'attach' => $sendAttacement,
            'to' => $user->email,
        ];     
        \Mail::to($user->email)->send(new \App\Mail\EnquiryMail($mailData));

        return response()->json([
            'message' => 'Message Sent!'
        ]);
    }
    public function archivemessage($id){
        $checkposition = \App\Models\ComposeMessage::find($id);        
        if($checkposition->expert_id==expertinfo()->id){ 
            if($checkposition->archive_expert==0){ $checkposition->archive_expert = 1; }
            else{ $checkposition->archive_expert = 0; }
        }
        $checkposition->save();
        return redirect(request('previous'))->with(['success'=>'Data Archived!']);
    }
    public function deletemessage($id){
        $checkposition = \App\Models\ComposeMessage::find($id);        
        if($checkposition->expert_id==expertinfo()->id){ 
            if($checkposition->delete_expert==0){ $checkposition->delete_expert = 1; }
            elseif(request('confirm')==true){ $checkposition->delete_expert = 2; }
            else{ $checkposition->delete_expert = 0; }
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
            if($checkposition->expert_id==expertinfo()->id){ 
                if($checkposition->archive_expert==0){ $checkposition->archive_expert = 1; }
                else{ $checkposition->archive_expert = 0; }
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
            if($checkposition->expert_id==expertinfo()->id){ 
                if($checkposition->delete_expert==0){ $checkposition->delete_expert = 1; }
                elseif(request('confirm')==true){ $checkposition->delete_expert = 2; }
                else{ $checkposition->delete_expert = 0; }
            }
            $checkposition->save();
        }
        return redirect(request('previous'))->with(['success'=>'Data Deleted!']);
    }

    /// VIDEO CALL
    public function sendinvitationlink(Request $r){
        $slotbook = \App\Models\SlotBook::find($r->slot);

        $data = \App\Models\SlotBook::find($r->slot);
        $data->call_invitation = 1;
        $data->call_meeting_code = $r->meeting;
        $data->call_end_by = NULL;
        $data->call_end_by_type = NULL;
        $data->call_end = NULL;
        $data->call_recording_id = NULL;
        $data->save();

        $callhistory = new \App\Models\CallRecordingHistory();
        $callhistory->slot_book_id = $slotbook->id;
        $callhistory->call_meeting_code = $r->meeting ?? NULL;
        $callhistory->call_recording_id = $slotbook->call_recording_id ?? NULL;
        $callhistory->call_end_by = $slotbook->call_end_by ?? NULL;
        $callhistory->call_end_by_type = $slotbook->call_end_by_type ?? NULL;
        $callhistory->call_end = $slotbook->call_end ?? NULL;
        $callhistory->save();
        
        $to = \Carbon\Carbon::parse($data->booking_date.' '.$data->booking_start_time);
        $from = \Carbon\Carbon::parse($data->booking_date.' '.$data->booking_end_time);
        $mins  = $to->diffInMinutes($from);
        $message = '<h5>Hi` '.$data->user->name ?? $data->user_name.'</h5><br><br>';
        $message .= '<p>'.expertinfo()->name.' has sent you an invite link for video call.<br>';
        $message .= 'please click below link for join a video call.<br>';
        $message .= '<a href="'.route('user.videocall',['schedule'=>$data->booking_id]).'">'.route('user.videocall',['schedule'=>$data->booking_id]).'</a><br>' ;
        $message .='This video call is for your booking (#'.$data->booking_id.') schedule and this video call is for '.$mins.' minutes only.</p>';
        $body = [
            'subject' => 'You have received an invitation (Booking: #'.$data->booking_id.') to attend the call : '.project(),
            'message' => $message,
        ];
        \Mail::to($data->user->email ?? $data->email)->send(new \App\Mail\EnquiryMail($body));
        return response()->json([
            'success' => true
        ]);
    }
    public function videocallend(Request $r){
        $slot = \App\Models\SlotBook::where('call_meeting_code',$r->meeting)->first();
        $gstamount = $slot->gst_amount;
        $tdsamount = ($slot->paid_amount * settingdata()->tds) / 100;
        $transfer = $slot->paid_amount - $gstamount - $tdsamount - $slot->service_charges;
        
        $data = \App\Models\SlotBook::where('call_meeting_code',$r->meeting)->update([
            'call_end_by' => expertinfo()->id,
            'call_end_by_type' => 1,
            'status' => 3,
            'call_end' => date('Y-m-d H:i:s'),
            'tds' => settingdata()->tds,
            'tds_amount' => $tdsamount,
            'transfer_amount' => $transfer,
            'transfer_date' => date('Y-m-d H:i:s')
        ]);
        
        $history = \App\Models\CallRecordingHistory::where('id',$slot->lasthistory->id ?? 0)->update([
            'call_end_by' => expertinfo()->id,
            'call_end_by_type' => 1,
            'call_end' => date('Y-m-d H:i:s'),
        ]);

        $expert = \App\Models\Expert::find(expertinfo()->id);
        $expert->increment('wallet',$transfer);

        $transationno = generatetransationno();       
        $checktransationno = new \App\Http\Controllers\User\UserController();
        $history = new \App\Models\ExpertWalletHistory();
        $history->transationno = $checktransationno->checktransationno($transationno);
        $history->expert_id = expertinfo()->id;
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


    /// Graf
    public function dashboardgraf(){
        $Month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $schedulesArr=[];
        $schedulesArr[] = ['Month', 'Schedules', 'Reject Schedules', 'Re-Schedules', 'Book Schedules', 'Income'];
        foreach($Month as $k => $Mont){

            $schedules = \App\Models\SlotBook::whereMonth('booking_date',($k+1));
            $schedules = $schedules->whereYear('booking_date',request('year'));
            $schedules = $schedules->where('expert_id',expertinfo()->id);
            $schedules = $schedules->whereIn('status',[1,2]);
            $schedules = $schedules->count();

            $rejectschedules = \App\Models\SlotBook::whereMonth('booking_date',($k+1));
            $rejectschedules = $rejectschedules->whereYear('booking_date',request('year'));
            $rejectschedules = $rejectschedules->where('expert_id',expertinfo()->id);
            $rejectschedules = $rejectschedules->where('status',2);
            $rejectschedules = $rejectschedules->count();

            $reschedules = \App\Models\SlotBook::whereMonth('booking_date',($k+1));
            $reschedules = $reschedules->whereYear('booking_date',request('year'));
            $reschedules = $reschedules->where('expert_id',expertinfo()->id);
            $reschedules = $reschedules->where('reschedule_slot','>',0);
            $reschedules = $reschedules->count();

            $bookedschedules = \App\Models\SlotBook::whereMonth('booking_date',($k+1));
            $bookedschedules = $bookedschedules->whereYear('booking_date',request('year'));
            $bookedschedules = $bookedschedules->where('expert_id',expertinfo()->id);
            $bookedschedules = $bookedschedules->whereIn('status',[1]);
            $bookedschedules = $bookedschedules->count();

            $incomes = \App\Models\SlotBook::whereMonth('booking_date',($k+1));
            $incomes = $incomes->whereYear('booking_date',request('year'));
            $incomes = $incomes->where('expert_id',expertinfo()->id);
            $incomes = $incomes->whereIn('payment',[1,3]);
            $incomes = $incomes->max('transfer_amount');

            $schedulesArr[]=[$Mont,$schedules,$rejectschedules,$reschedules,$bookedschedules,$incomes ?? 0];
        }
        
        return response()->json([
            'data' => $schedulesArr
        ]);
    }
}