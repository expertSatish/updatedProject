<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use DateTime;
use App\Models\ExpertVideo;
use App\Models\SlotBook;
use Carbon\Carbon;

class HomeController extends Controller{    

    public function index(){

        $bannercms = \App\Models\Cms::find(28);
        $banners = \App\Models\Banner::where('is_publish',1)->orderBy('sequence','ASC')->get();

        $findexpertcms = \App\Models\Cms::find(26);
        $findexperts = \App\Models\FindExpertStep::where('is_publish',1)->orderBy('sequence','ASC')->get();

        $expertcms = \App\Models\Cms::find(21);
        $experts = \App\Models\Expert::where(['is_publish'=>1,'top_expert'=>1]);
        if(!empty(expertinfo())){
            $experts = $experts->whereNotIn('id',[expertinfo()->id]);
        }
        $experts = $experts->orderBy('sequence','ASC')->paginate(6);
        
        $featuredcms = \App\Models\Cms::find(27);
        $featureds = \App\Models\Featured::where(['is_publish'=>1])->orderBy('sequence','ASC')->get();

        $expertcategorycms = \App\Models\Cms::find(22);
        $expertcategories = \App\Models\HomeExpertCategory::where(['is_publish'=>1])->orderBy('sequence','ASC')->get();
        
        $findexpertcategorycms = \App\Models\Cms::find(30);
        $findexpertcategories = \App\Models\ExpertCategory::where(['is_publish'=>1,'is_home'=>1])->orderBy('sequence','ASC')->get();
        

        $videoscms = \App\Models\Cms::find(29);
        $videos = \App\Models\ExpertVideo::join('experts','expert_videos.expert_id','experts.id');
        $videos = $videos->where(['experts.is_publish'=>1,'experts.profile_visibility'=>1,'experts.video_visibility'=>1]);
        $videos = $videos->where(['expert_videos.is_publish'=>1,'expert_videos.set_home'=>1]);
        $videos = $videos->select('expert_videos.*')->orderBy('expert_videos.sequence','ASC');
        $videos = $videos->paginate(6);
        
        $youexpert = \App\Models\Cms::find(25);

        $blogcms = \App\Models\Cms::find(24);
        $blogs = \App\Models\Blog::where(['is_publish'=>1,'latest'=>1])->orderBy('sequence','ASC')->paginate(6);
        
        $testimonialscms = \App\Models\Cms::find(23);
        $testimonials = \App\Models\Testimonial::where(['is_publish'=>1])->whereIn('rating',[4,5])->orderBy('sequence','ASC')->paginate(6);
        
        $faqs = \App\Models\Faq::where(['is_publish'=>1,'is_home'=>1])->orderBy('sequence','ASC')->paginate(6);
        $faqscms = \App\Models\Cms::find(25);
        
        return view('home',compact('faqs','faqscms','findexpertcategorycms','findexpertcategories','testimonialscms','testimonials','blogcms','blogs','videoscms','youexpert','videos','expertcategorycms','expertcategories','featuredcms','featureds','bannercms','banners','findexpertcms','findexperts','expertcms','experts'));
    }
    public function contact(){
        $cms = \App\Models\Cms::find(11);
        $contact = \App\Models\Cms::find(12);
        $businesssectors = \App\Models\ExpertCategory::where('is_publish',1)->get();
        return view('contact',compact('contact','cms','businesssectors'));
    }
    public function termsandconditions(){
        $cms = \App\Models\Cms::find(9);
        return view('cms',compact('cms'));
    }
    public function privacypolicy(){
        $cms = \App\Models\Cms::find(8);
        return view('cms',compact('cms'));
    }
    public function about(){
        $banner = \App\Models\Cms::find(4);
        $mission = \App\Models\Cms::find(5);
        $vission = \App\Models\Cms::find(6);
        $teams = \App\Models\Team::where('is_publish',1)->orderBy('sequence','ASC')->get();
        return view('about',compact('banner','mission','vission','teams'));
    }
    public function teamdetails(){
        $teams = \App\Models\Team::where(['is_publish'=>1,'id'=>request('member')])->first();
        return view('team-detail',compact('teams'));
    }
    public function blogcategory($alias){
        $categories = \App\Models\BlogCategory::where(['is_publish'=>1,'alias'=>$alias])->first();
        if(empty($categories)){ abort(404); }  
        $lists = \App\Models\Blog::where(['is_publish'=>1,'category_id'=>$categories->id])->orderBy('sequence','ASC')->paginate(20);
        $cms = \App\Models\Cms::find(10);
        return view('blog',compact('lists','cms'));
    }
    public function blogarchive($alias){
        $explode = explode('-',$alias);
        $lists = \App\Models\Blog::where(['is_publish'=>1])->whereYear('post_date',$explode[0] ?? 0)->whereMonth('post_date',$explode[1] ?? 0)->orderBy('sequence','ASC')->paginate(20);
        $cms = \App\Models\Cms::find(10);
        return view('blog',compact('lists','cms'));
    }
    public function blog($alias=null){
        if(!empty($alias)){
            $list = \App\Models\Blog::where(['is_publish'=>1,'alias'=>$alias])->first();
            if(empty($list)){ abort(404); }  
            $archives = \App\Models\Blog::where(['is_publish'=>1]);
            $archives = $archives->selectRaw('year(post_date) year,month(post_date) month');
            $archives = $archives->groupBy('year','month')->orderBy('sequence','ASC')->get(); 
            $categories = \App\Models\BlogCategory::where(['is_publish'=>1])->orderBy('sequence','ASC')->get();     
            $populars = \App\Models\Blog::where(['is_publish'=>1,'latest'=>1])->whereNotIn('id',[$list->id])->orderBy('sequence','ASC')->paginate(5);
            $next_record = \App\Models\Blog::where(['is_publish'=>1])->where('id', '>', $list->id)->orderBy('id','DESC')->first();
            $previous_record = \App\Models\Blog::where(['is_publish'=>1])->where('id', '<', $list->id)->orderBy('id','DESC')->first();
            $relateds =  \App\Models\Blog::where(['is_publish'=>1,'category_id'=>$list->category_id])->whereNotIn('id',[$list->id])->orderBy('sequence','ASC')->paginate(5);
            return view('blog-detail',compact('list','archives','relateds','next_record','previous_record','populars','categories'));
        }else{
            $cms = \App\Models\Cms::find(10);
            $lists = \App\Models\Blog::where(['is_publish'=>1])->orderBy('sequence','ASC')->paginate(20);
            return view('blog',compact('lists','cms'));
        }
    }
    public function careers($alias=null){
        if(!empty($alias)){
            $list = \App\Models\Career::where(['is_publish'=>1,'alias'=>$alias])->orderBy('sequence','ASC')->first();
            if(empty($list)){ abort(404); }  
            return view('careers-detail',compact('list'));
        }else{
            $cms = \App\Models\Cms::find(19);
            $lists = \App\Models\Career::where('is_publish',1)->orderBy('sequence','ASC')->get();
            return view('careers',compact('lists','cms'));
        }
    }
    public function faq($catgeory=null,$child=null){
        $cms = \App\Models\Cms::find(20);
        $category = \App\Models\FaqCategory::where(['is_publish'=>1,'parent'=>0])->orderBy('sequence','ASC')->get();
        $activecategory = \App\Models\FaqCategory::where(['is_publish'=>1,'parent'=>0]);
        if(!empty($catgeory)){ $activecategory = $activecategory->where('alias',$catgeory); }
        $activecategory = $activecategory->orderBy('sequence','ASC')->first();

        $categoryId = [];
        if(count($activecategory->child) > 0){
            foreach($activecategory->child as $activchild):
                $categoryId[] = $activchild->id ;
            endforeach;
        }else{
            $categoryId[] = $activecategory->id ;
        }
                
        
        if(!empty($child)){  
            $categoryId = [];
            $activechild = \App\Models\FaqCategory::where(['is_publish'=>1]);
            $activechild = $activechild->where('alias',$child);
            $activechild = $activechild->orderBy('sequence','ASC')->first(); 
            $categoryId[] =  $activechild->id;    
        }

        $lists = \App\Models\Faq::where(['is_publish'=>1]);
        $lists = $lists->whereIn('category_id',$categoryId);
        if(!empty(request('search'))){
            $lists = $lists->where('title','LIKE','%'.request('search').'%');
        }
        $lists = $lists->orderBy('sequence','ASC')->paginate(10);

        return view('faqs',compact('lists','cms','category','activecategory'));
    }
    public function becomeanexpert(){
        $banner = \App\Models\Cms::find(13);
        $section2 = \App\Models\Cms::find(14);
        $threeicons = \App\Models\ThreeIcon::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $section4 = \App\Models\Cms::find(16);
        $mentors  = \App\Models\Mentor::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $section5 = \App\Models\Cms::find(15);
        $callingcms = \App\Models\Cms::find(17);
        $callingprocess  = \App\Models\CallingProcess::where('is_publish',1)->orderBy('sequence','ASC')->get();
        $testimonialscms = \App\Models\Cms::find(18);
        $testimonials  = \App\Models\Testimonial::where('is_publish',1)->orderBy('sequence','ASC')->get();
        return view('become-an-expert',compact('banner','testimonialscms','testimonials','callingcms','callingprocess','section2','threeicons','section5','section4','mentors'));
    }
    public function experts($experid=null,$type=null){        
        $experts = \App\Models\Expert::where(['is_publish'=>1,'profile_visibility'=>1]);
        $experts = $experts->orderBy('sequence','ASC');
        if(!empty($experid)){
            if($type=='videos'){ return $this->expertvideos($experid);}
            $experts = $experts->where('user_id',$experid);
            $experts = $experts->first();
            if(empty($experts)){ abort(404); }
            $requestsection = \App\Models\Cms::find(1);
            $giftsection = \App\Models\Cms::find(2);
            $video = ExpertVideo::where('expert_id',$experts->id)->first();
            $notesection = \App\Models\Cms::find(3);
            $slots = \App\Models\SlotAvailability::where(['is_publish'=>1,'expert_id'=>$experts->id,'day'=>date('l',strtotime('Y-m-d'))])->get();
            return view('expert-intro',compact('experts','slots','requestsection','giftsection','notesection','video'));
        }else{
            $experts = $experts->whereNotIn('id',[expertinfo()->id ?? 0]);
            $experts = $experts->paginate(40);
            $expertise = \App\Models\Expertise::where(['is_publish'=>1])->get();
            $industries = \App\Models\Industry::where(['is_publish'=>1])->get();
            $roles = \App\Models\Role::where(['is_publish'=>1])->get();
            $categories = \App\Models\ExpertCategory::where(['is_publish'=>1])->get();
            return view('experts',compact('experts','expertise','categories','industries','roles'));
        }
    }
    public function expertvideos($experid=null){
        if(!empty(request('v'))){
            $experts = \App\Models\Expert::where(['is_publish'=>1,'profile_visibility'=>1,'video_visibility'=>1]);
            $experts = $experts->where('user_id',$experid);
            $experts = $experts->first();
            if(empty($experts)){ abort(404); }
            $info = \App\Models\ExpertVideo::where(['video_id'=>request('v'),'is_publish'=>1])->first();
            if(empty($info)){ abort(404); }
            if(\App\Models\ExpertVideoClick::where(['video_id'=>$info->id,'ip'=>request()->ip()])->count()==0){
                $click = new \App\Models\ExpertVideoClick();
                $click->ip = request()->ip();
                $click->video_id = $info->id;
                $click->save();
            }
            $videos = \App\Models\ExpertVideo::where(['expert_id'=>$experts->id,'is_publish'=>1])->whereNotIn('id',[$info->id])->orderBy('sequence','DESC')->paginate(8);        
            return view('video-intro',compact('experts','videos','info'));
        }
        if(!empty($experid)){
            $experts = \App\Models\Expert::where(['is_publish'=>1,'profile_visibility'=>1,'video_visibility'=>1]);        
            $experts = $experts->where('user_id',$experid);
            $experts = $experts->first();
            if(empty($experts)){ abort(404); }
            $videos = \App\Models\ExpertVideo::where(['expert_id'=>$experts->id,'is_publish'=>1])->orderBy('sequence','DESC')->paginate(45);        
        }else{
            $experts='';
            $videos = \App\Models\ExpertVideo::join('experts','experts.id','expert_videos.expert_id')->where(['expert_videos.is_publish'=>1,'experts.is_publish'=>1,'experts.profile_visibility'=>1,'experts.video_visibility'=>1])->select('expert_videos.*')->orderBy('expert_videos.sequence','DESC')->paginate(45);        
        }        
        return view('expert-videos',compact('experts','videos'));
    }
    

    //// Booking
    public function bookinglogin($bookingid){
        $lists = \App\Models\SlotBook::where('booking_id',$bookingid)->first();
        if(empty($lists)){ abort(404); }
        $countries = \App\Models\Country::where('status',1);
        if(!empty($currentUserInfo->countryCode)){ $countries = $countries->where('sortname',$currentUserInfo->countryCode); }
        else{ $countries = $countries->where('phonecode',91); }
        $countries = $countries->first();
        return view('booking.booking-login',compact('lists','countries'));
    }
    public function bookingstep2($bookingid){
        if(empty(userinfo()->id)){
            return back()->with(['error'=>'You are not login. please login with user account and process next step.']);
        }
        $lists = \App\Models\SlotBook::where('booking_id',$bookingid)->first();
        if(empty($lists)){ abort(404); }
        $countries = \App\Models\Country::where('status',1);
        if(!empty($currentUserInfo->countryCode)){ $countries = $countries->where('sortname',$currentUserInfo->countryCode); }
        else{ $countries = $countries->where('phonecode',91); }
        $countries = $countries->first();
        return view('booking.expert-booking-step2',compact('lists','countries'));
    }
    public function payment($bookingid){
        if(empty(userinfo()->id)){
            return back()->with(['error'=>'You are not login. please login with user account and process next step.']);
        }
        $lists = \App\Models\SlotBook::where('booking_id',$bookingid)->first();
        if(empty($lists)){ abort(404); }

        $slost = \App\Models\SlotBook::find($lists->id);
        $slost->user_id = userinfo()->id;
        $slost->save();

        return view('booking.payment',compact('lists'));
    }
    public function paymentquery($bookingid){
        if(empty(userinfo()->id)){
            return back()->with(['error'=>'You are not login. please login with user account and process next step.']);
        }
        $lists = \App\Models\SlotBook::where('booking_id',$bookingid)->first();
        if(empty($lists)){ abort(404); }
        $to = \Carbon\Carbon::parse($lists->booking_start_time);
        $from = \Carbon\Carbon::parse($lists->booking_end_time);
        $timediffrence = $to->diffInMinutes($from);
        $sessioncategory = \App\Models\SlotTime::where('minute',$timediffrence)->first();
        return view('booking.payment-query',compact('lists','sessioncategory'));
    }
public function applyCoupon(Request $request)
{

    $couponCode = $request->input('coupon_code');
    $data = SlotBook::where('booking_id',$request->booking_id)->where('expert_id',$request->expert_id)->where('user_id',$request->user_id)->first();
    $couponExists = Expert::where('coupon_title', $couponCode)->where('id',$data->expert_id)->first();
    if($request->input('coupon_code') == null){
        $message = 'Invalid coupon code';
        return response()->json(['success' => false, 'message' => $message]);
    }
    elseif ($couponExists) {
        // Coupon code exists, apply it
        // TODO: Implement coupon code application logic
        $amount = $couponExists->percentage;
        if($amount == 100){
            SlotBook::where('booking_id',$data->booking_id)->where('expert_id',$data->expert_id)->where('user_id',$request->user_id)->update(['booking_amount'=>0,'paid_amount'=>0,'coupon'=>$couponCode,'gst_amount'=>0]);
            $discount = $couponExists->percentage;
            // Assuming the coupon code is applied successfully, you can return a success message
            $message = 'Coupon Applied';
            return response()->json(['success' => true, 'message' => $message, 'discount'=>$discount]);
        }
        else{
            $price = $data->booking_amount * $amount / 100;

            $gst_cal =  ($price * $data->gst)/100;
            $total_amt = $price + $gst_cal;
            $data = SlotBook::where('booking_id',$data->booking_id)->where('expert_id',$data->expert_id)->where('user_id',$request->user_id)->update(['booking_amount'=> $price,'paid_amount'=>$total_amt,'coupon' =>$couponCode,'gst_amount'=>$gst_cal]);
            $discount = $couponExists->percentage;
            // Assuming the coupon code is applied successfully, you can return a success message
            $message = 'Coupon Applied';
            return response()->json(['success' => true, 'message' => $message, 'discount'=>$discount]);
        }
        
    } else {
        // Coupon code doesn't exist
        $message = 'Invalid coupon code';
        return response()->json(['success' => false, 'message' => $message]);
    }
}
    public function expertslottimes(Request $r){
        $expert = $r->expert;
        $slot = 0;
        $fees = 0;
        $expert = \App\Models\Expert::find($expert);
        $availabiledays = \App\Models\SlotAvailability::where(['expert_id'=>$expert->id])->get();
        $availabiledate = \App\Models\SlotAvailability::where('expert_id',$expert->id)->where('date','>=',date('Y-m-d'))->first();
        if($availabiledate){
            $date = Carbon::parse($availabiledate->date)->format('Y-m-d');
            $true = '<div class="col-12 text-center my-5 text-success">
            <h6>'.$expert->name.' is  available on '.$date.'.</h6>
        </div>';
        }
        else{
            $true =  $true = '<div class="col-12 text-center my-5 text-danger">
            <h6>'.$expert->name.' is not avaibale.</h6>
        </div>';
        }
        $availability = \App\Models\SlotAvailability::where(['expert_id'=>$expert->id,'date'=>date('Y-m-d',strtotime($r->date))]);
        if($r->date==date('Y-m-d')){
            $availability = $availability->where('to_time','>=',date('H:i:s'));
        }
        $availability = $availability->get();
        foreach($expert->slotcharges as $key => $charges):
            if($key==0){ 
                $slot = $charges->time->minute;
                $fees = $charges->charges + (($charges->charges * 0)/100);
            }
            if($r->slot==$charges->time->minute){ 
                $fees = $charges->charges + (($charges->charges * 0)/100); 
            }
        endforeach;
        if(!empty($r->slot)){ $slot = $r->slot; }
        $Html='';
        if($availability->count() > 0){
        $Html .='<span class="SetInfo thm w-50 '.(empty($availability) ? 'mb-5':'').'"><span><i class="fas fa-info-circle me-2"></i> All times are in UTC+05:30 (IST)</span> <i class="far fa-chevron-right"></i></span>';
            foreach($availability as $availabile){
                $Html .='<ul class="p-0 TimeBox">';        
                $tStart = strtotime($availabile->from_time);
                $tEnd = strtotime($availabile->to_time);
                $tNow = $tStart;
                while($tNow <= $tEnd):
                    $endslot = date("H:i",strtotime('+'.($slot).' minutes',$tNow));

                    $checkbooking = \App\Models\SlotBook::where(['expert_id'=>$expert->id,'booking_date'=>$r->date]);
                    $checkbooking = $checkbooking->where('booking_start_time',date("H:i",$tNow).':00');
                    $checkbooking = $checkbooking->where('booking_end_time',$endslot.':00');
                    $checkbooking = $checkbooking->whereIn('payment',[1,3]);
                    $checkbooking = $checkbooking->whereIn('status',[1,3]);
                    $checkbooking = $checkbooking->whereIn('reschedule_slot',[0]);
                    $checkbooking = $checkbooking->whereIn('call_end_by',[0]);
                    $checkbooking = $checkbooking->count();

                    $bookedclass='';
                    if($checkbooking > 0 && $r->date.date(" H:i",$tNow) >= date('Y-m-d H:i')){
                        $bookedclass =  "sws-bounce sws-top";
                    }
                    $Html .='<li style="cursor:'.($r->date.date(" H:i",$tNow) < date('Y-m-d H:i') || $checkbooking > 0?'not-allowed':'').'" class="'.$bookedclass.'" data-title="Booked"><input type="radio" class="btn-check" '.($r->date.date(" H:i",$tNow) < date('Y-m-d H:i') || $checkbooking > 0?'disabled':'').' name="timing" id="t'.$tNow.'" value="'.date("H:i",$tNow).'-'.$endslot.'"  autocomplete="off"><label class="btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Available" for="t'.$tNow.'">'.date("H:i",$tNow).'</label></li>';
                    $tNow = strtotime('+'.($slot).' minutes',$tNow);
                endwhile;
                $Html .='</ul>';        
            } 
        }
        elseif($availability->count()==0){
            $Html .= $true;
        } 
        $daysArr = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']; 
        $availdays = [];
        $notavailabile = [];
        foreach($availabiledays as $avai){
            if(!in_array($avai->date,$availdays)){
                $availdays[] = $avai->date;
            }
            
        } 
        // foreach($daysArr as $key => $Arr){
        //     if(!in_array($Arr,$availdays)){ $notavailabile[] = $key ; }
        // }    
        return response()->json([
            'html' => $Html,
            'charges' => round($fees),
            'notavailabile' => $notavailabile,
            'availabile' => $availdays,
            'records' => $availability->count()
        ]);
    }
    public function bookingprocess(Request $r){
        $data = new \App\Models\SlotBook();
        $data->booking_time = $r->booking_date.' '.explode('-',$r->timing)[1];
        $data->booking_start_time = explode('-',$r->timing)[0] ?? '';
        $data->booking_end_time = explode('-',$r->timing)[1] ?? '';
        $data->booking_date = $r->booking_date;
        $data->booking_amount = $r->booking_price;
        $data->gst = settingdata()->gst;
        $data->gst_amount = (($r->booking_price * settingdata()->gst) /100);
        $data->paid_amount = ($r->booking_price + $data->gst_amount);
        $data->expert_id = $r->expert;
        $data->booking_id = generatebookingno();
        $data->user_id = userinfo()->id ?? '';
        $data->user_number = (!empty(userinfo()->id) ? userinfo()->ccode.userinfo()->mobile : '');
        $data->user_email = userinfo()->email ?? '';
        $data->user_name = userinfo()->name ?? '';
        $data->status = 0;
        $data->save();


        if(!empty(\Auth::user())){ $redirect = route('payment',['booking'=>$data->booking_id]); }
        else{ $redirect = route('expertbooking',['booking'=>$data->booking_id]); }

        return response()->json([
            'redirect' => $redirect
        ]);
    } 

    /// Auto Search
    public function autosearch(Request $r){
        $search = $r->search;
        $experts = \App\Models\Expert::where('experts.is_publish',1);
        if(!empty($search)){
            $experts = $experts->where(function($q) use($search){               
                $q->where('experts.name','LIKE','%'.$search.'%');
                $q->orwhere('experts.user_id','LIKE','%'.$search.'%');
                $q->orwhere('experts.email','LIKE','%'.$search.'%');
                $q->orwhere('experts.mobile',$search);            
            });

            $expertise = [];
            $roles = [];
            $industry = [];

            $expertiseArr = \App\Models\Expertise::where('is_publish',1)->where('title','LIKE','%'.$search.'%')->get();
            $roleArr = \App\Models\Role::where('is_publish',1)->where('title','LIKE','%'.$search.'%')->get();
            $industryArr = \App\Models\Industry::where('is_publish',1)->where('title','LIKE','%'.$search.'%')->get();
            foreach($expertiseArr as $exparr){
                $expertise[] = $exparr->id;
            }
            foreach($industryArr as $indArr){
                $industry[] = $indArr->id;
            }
            foreach($roleArr as $role){
                $roles[] = $role->id;
            } 
            if(count($industry)>0){
                $experts = $experts->join('expert_industries as industrie','experts.id','industrie.expert_id');
                $experts = $experts->whereIn('industrie.industry_id',$industry);     
            }  
            if(count($roles)>0){
                $experts = $experts->join('expert_roles as roles','experts.id','roles.expert_id');
                $experts = $experts->whereIn('roles.role',$roles);     
            } 
            if(count($expertise)>0){
                $experts = $experts->join('expert_expertises as expertises','experts.id','expertises.expert_id');
                $experts = $experts->whereIn('expertises.expertise_id',$expertise);     
            }  
        }
        $experts = $experts->select('experts.*');
        $experts = $experts->orderBy('experts.sequence','ASC');
        $experts = $experts->groupBy('experts.id');
        $experts = $experts->whereNotIn('experts.id',[expertinfo()->id ?? 0]);
        $experts = $experts->paginate(20);
        $Html='';
        $Html .='<ul>';
        if($experts->count()==0){ $Html .='<li class="text-center">Sorry! No Data Found...</li>';}
        foreach($experts as $expert):
            $Html .='<li><a href="'.route('experts',['alias'=>$expert->user_id]).'" class="d-flex align-items-center img">';
            if (in_array(checkimagetype($expert->profile), ['SVG','WEBP','AVIF']) && file_exists(public_path('uploads/expert/'. $expert->profile))):
                $Html .= '<img style="border-radius: 50%;width: 30px;" src="'.asset('uploads/expert/'.$expert->profile).'"> ';
            elseif(file_exists(public_path('uploads/expert/'.$expert->profile . '.webp'))):
                $Html .= '<img style="border-radius: 50%;width: 30px;" src="'.asset('uploads/expert/'.$expert->profile. '.webp').'"> ';
            elseif(file_exists(public_path('uploads/expert/jpg/'.$expert->profile . '.jpg'))):
                $Html .= '<img style="border-radius: 50%;width: 30px;" src="'.asset('uploads/expert/jpg/'.$expert->profile. '.jpg').'">' ;
            else:
                $Html .= '<img style="border-radius: 50%;width: 30px;" src="'.asset('frontend/image/no-img.jpg').'"> ';
            endif;
                $Html .= '<div class="ms-2"><span>';
                $Html .= $expert->name;
                $Html .= !empty($expert->expertise->title) ? ' ('.$expert->expertise->title.')' : '';
                $Html .= '<span><small class="d-block lh-n">';
                foreach($expert->roles as $k=> $roles):
                    $Html .= $roles->roleinfo->title ?? '';                   
                endforeach;
                $Html .= '</small></div>';
            $Html .='</a></li>';
        endforeach;            
        $Html .='</ul>';
        return response()->json([
            'html' => $Html
        ]);
    }
    public function search(Request $r){
        $search = $r->searchlist;
        $experts = \App\Models\Expert::where('is_publish',1);
        if(!empty($search)){
            $experts = $experts->where(function($q) use($search){
                $expertise = [];
                $qualification = [];
                $category = [];
                $industry = array();

                $expertiseArr = \App\Models\Expertise::where('is_publish',1)->where('title','LIKE','%'.$search.'%')->get();
                $categoryArr = \App\Models\ExpertCategory::where('is_publish',1)->where('title','LIKE','%'.$search.'%')->get();
                $qualificationArr = \App\Models\Qualification::where('is_publish',1)->where('title','LIKE','%'.$search.'%')->get();
                $industryArr = \App\Models\Industry::where('is_publish',1)->where('title','LIKE','%'.$search.'%')->get();
                foreach($expertiseArr as $exparr){
                    $expertise[] = $exparr->id;
                }
                foreach($qualificationArr as $qualArr){
                    $qualification[] = $qualArr->id;
                }
                foreach($categoryArr as $catArr){
                    $category[] = $catArr->id;
                }
                
                $q->where('name','LIKE','%'.$search.'%');
                $q->orwhere('user_id','LIKE','%'.$search.'%');
                $q->orwhere('email','LIKE','%'.$search.'%');
                $q->orwhere('mobile','LIKE','%'.$search.'%');            
            });
        }
        $experts = $experts->paginate(20);
        return view('search',compact('experts'));
    }
    public function searchexpertvideos(Request $r){
        $search = $r->search;
        $videos = \App\Models\ExpertVideo::join('experts','experts.id','expert_videos.expert_id');
        $videos = $videos->where('expert_videos.title','LIKE','%'.$search.'%');
        $videos = $videos->where(['experts.is_publish'=>1,'experts.profile_visibility'=>1,'experts.video_visibility'=>1])->get();
        $html='';
        foreach ($videos as $key => $video) {
            if(str_contains($video->video_url,'v=')){
                $arr = explode('=',$video->video_url);
            }else{
                $arr = explode('/',$video->video_url);
            }
            if(!empty($video->expert)){
                $html .='<div class="col-lg-4 col-sm-6 col-12">';
                    $html .='<div class="card">';
                        $html .='<div class="card-header">';
                            if($video->video_type==1):
                                $html .='<div class="youtube-player" data-id="'.(end($arr) ?? '').'"></div>';
                            endif;
                            if($video->video_type==2):
                                $html .='<video>';
                                    $html .='<source src="'.asset('uploads/expert/video/'.$video->video).'" type="video/mp4" />';
                                $html .='</video>';
                                $html .='<div class="play"></div>';
                            endif;
                            $html .='<a href="'.route('experts',['alias'=>$video->expert->user_id,'type'=>'videos','v'=>$video->video_id,'check'=>request('segment')]).'" class="playVideo"></a>';
                        $html .='</div>';
                        $html .='<a href="'.route('experts',['alias'=>$video->expert->user_id,'type'=>'videos','v'=>$video->video_id,'check'=>request('segment')]).'" class="card-body">';
                                $html .='<h3>'.($video->title ?? '').'</h3>';
                                $html .='<small class="text-secondary me-3"><i class="far fa-user thm me-1"></i> '.($video->expert->name ?? '').'</small>';
                                if(!empty($video->industries)):
                                    $html .='<small class="text-secondary"><i class="far fa-tag thm me-1"></i>';
                                    foreach(json_decode($video->industries) as $k => $industry):
                                        $industry = \App\Models\Industry::find($industry);
                                        $html .= ($industry->title ?? '');
                                        if(($k + 1) < count(json_decode($video->industries))){
                                            $html .=' + ';
                                        }
                                    endforeach;
                                    $html .='</small>';
                                endif;
                            $html .='</a>';
                    $html .='</div>';
                $html .='</div>';
            }
        }
        return response()->json([
            'html' => $html
        ]);
    }

    //// API
    public function Token(){
        $VIDEOSDK_API_KEY = env('VIDEOSDK_API_KEY');
        $VIDEOSDK_SECRET_KEY = env('VIDEOSDK_SECRET_KEY');
        $issuedAt = new DateTime();
        $expire = $issuedAt->modify('+24 hours')->getTimestamp();  
        $payload = [
            'apikey' => $VIDEOSDK_API_KEY,
            'permissions' => ['allow_join', 'allow_mod'],
            'iat' => $issuedAt->getTimestamp(),
            'exp' => $expire,
        ];
        $jwt = JWT::encode($payload, $VIDEOSDK_SECRET_KEY, 'HS256');
        return $jwt;
    }
    public function downloadrecordingapi($recordingId){
        $Token = $this->Token();
        $recordinglist = "https://api.videosdk.live/v2/recordings?roomId=".request('Meething')."&page=1&perPage=20";
        $recording = "https://api.videosdk.live/v2/recordings/".request('Meething');

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $recordinglist,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$Token,
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        $html='';
        if(!empty($response->data[0]->file->fileUrl)){
            $html .='<video class="w-100" controls autoplay>';
                $html .='<source src="'.$response->data[0]->file->fileUrl.'" type="video/mp4">';
            $html .='</video>';
            $html .='<p class="text-center"><a href="'.$response->data[0]->file->fileUrl.'" class="btn btn-thm2" download><i class="fa fa-download me-1"></i> Download Here...</a><button type="button" class="btn btn-thm3 ms-1" data-bs-dismiss="modal" aria-label="Close">Close</button></p>';
        }else{
            $html .='Something went wrong...';
        }
        return $html;
    }
}