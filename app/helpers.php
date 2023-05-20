<?php

use App\Models\City;
use App\Models\Country;
use App\Models\Expertise;
use App\Models\Industry;
use App\Models\State;

if(!function_exists('admininfo')){
    function admininfo(){
        return Auth::guard('admin')->user();
    }
}
if(!function_exists('expertinfo')){
    function expertinfo(){
        return Auth::guard('expert')->user();
    }
}
if(!function_exists('userinfo')){
    function userinfo(){
        return Auth::user();
    }
}
if (!function_exists('bladeIndustryGetNameById')) {
    function bladeIndustryGetNameById($id)
    {
        return Industry::getName($id);
    }
  }
if (!function_exists('bladeObjectiveGetNameById')) {
    function bladeObjectiveGetNameById($id)
    {
        return Industry::getName($id);
    }
  }
if (!function_exists('bladeObjectiveGetNameById')) {
    function bladeObjectiveGetNameById($id)
    {
        return Expertise::getName($id);
    }
  }
if (!function_exists('bladeCountryGetNameById')) {
    function bladeCountryGetNameById($id)
    {
        return Country::getName($id);
    }
  }
if (!function_exists('bladeStateGetNameById')) {
    function bladeStateGetNameById($id)
    {
        return State::getName($id);
    }
  }
if (!function_exists('bladeCityGetNameById')) {
    function bladeCityGetNameById($id)
    {
        return City::getName($id);
    }
  }

if(!function_exists('defaultcurrency')){
    function defaultcurrency(){
        return "INR";
    }
}

if(!function_exists('settingdata')){
    function settingdata(){
        return \App\Models\Setting::find(1);
    }
}

if(!function_exists('project')){
    function project(){
        return "Expertbells";
    }
}
if(!function_exists('myipaddress')){
    function myipaddress(){
        return request()->ip();
    }
}
if(!function_exists('adminmail')){
    function adminmail(){
        return "info@expertbells.com";
    }
}
if(!function_exists('ccadminmail')){
    function ccadminmail(){
        return "rahul@expertbells.com";        
    }
}
if(!function_exists('mailsupportemail')){
    function mailsupportemail(){
        return "info@expertbells.com";
    }
}
if(!function_exists('generatetransationno')){
    function generatetransationno(){
        return mt_rand(0,999999999999);
    }
}
if(!function_exists('generateotp')){
    function generateotp($n){
        $generator = "1357902468";
        $result = "";  
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }    
        return $result;
    }
}
if(!function_exists('generateuserno')){
    function generateuserno(){
        $numnber = mt_rand(0,999999);
        $checkuser = \App\Models\User::where('user_id',$numnber)->count();
        if($checkuser>0){
            $this->generateuserno();
        }else{
            if(strlen($numnber)<4){ $this->generateuserno(); }
            else{ return $numnber; }            
        }
    }
}
if(!function_exists('generatebookingno')){
    function generatebookingno($incr=null){
        $checkuser = \App\Models\SlotBook::max('id');
        $bookingid = $checkuser + ($incr ?? 1);
        if($checkuser < 10){
            $bookingid = '00000'.$bookingid;
        }
        elseif($checkuser > 9 && $checkuser < 100){
            $bookingid = '0000'.$bookingid;
        }
        elseif($checkuser > 99 && $checkuser < 1000){
            $bookingid = '000'.$bookingid;
        }
        elseif($checkuser > 999 && $checkuser < 10000){
            $bookingid = '00'.$bookingid;
        }
        elseif($checkuser > 9999 && $checkuser < 100000){
            $bookingid = '0'.$bookingid;
        }
        elseif($checkuser > 100000){
            $bookingid = $bookingid;
        } 
        if(\App\Models\SlotBook::where('booking_id',$bookingid)->count() > 0){
            return generatebookingno(2);
        }
        return $bookingid;       
    }
}
if(!function_exists('generateexpertno')){
    function generateexpertno(){
        $numnber = mt_rand(0,999999);
        $checkuser = \App\Models\Expert::where('user_id',$numnber)->count();
        if($checkuser>0){
            $this->generateexpertno();
        }else{
            if(strlen($numnber)<4){ $this->generateexpertno(); }
            else{ return $numnber; }
        }
    }
}
if(!function_exists('generateexpertvideoid')){
    function generateexpertvideoid(){
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-_';
        $result='';
        for ($i = 0; $i < 11; $i++){
            $result .= $characters[mt_rand(0, 63)];
        }
        $checkuser = \App\Models\ExpertVideo::where('video_id',$result)->count();        
        if($checkuser>0){
            $this->generateexpertvideoid();
        }else{            
            return $result;         
        }
    }
}

if(!function_exists('viewcounts')){
    function viewcounts($count){
        for($A=$count;$A<=999;$A++){
            return $A;
        }
        if($count>999 && $count<99999){ 
            for($A=$count;$A<=99999;$A++){
                if(strlen($count)==4){ 
                    $string = substr($A,0,2); 
                    return floatval(substr_replace($string,'.', 1, 0)).'K';
                }
                if(strlen($count)==5){ 
                    $string = substr($A,0,3); 
                    return floatval(substr_replace($string,'.', 2, 0)).'K';
                }        
           }
        }
        if($count>99999 && $count<9999999){ 
            for($A=$count;$A<=9999999;$A++){
                if(strlen($count)==6){ 
                    $string = substr($A,0,2); 
                    return floatval(substr_replace($string,'.', 1, 0)).'M';
                }
                if(strlen($count)==7){ 
                    $string = substr($A,0,3); 
                    return floatval(substr_replace($string,'.', 2, 0)).'M';
                }        
           }
        }
    }
}
if(!function_exists('checkimagetype')){
    function checkimagetype($image){
        $explode = explode('.',$image);     
        return strtoupper(end($explode));
    }
}
if(!function_exists('datetimeformat')){
    function datetimeformat($date){
        return date('d M, Y h:i A',strtotime($date));
    }
}
if(!function_exists('dateformat')){
    function dateformat($date){
        return date('d M, Y',strtotime($date));
    }
}
if(!function_exists('timeformat')){
    function timeformat($date){
        return date('H:s A',strtotime($date));
    }
}
if(!function_exists('messagetime')){
    function messagetime($Date){
        if(date('Y-m-d')==date('Y-m-d',strtotime($Date))){
            return date('H:i A',strtotime($Date));
        }
        if(date('Y-m')==date('Y-m',strtotime($Date))){
            return date('M d',strtotime($Date));
        }
        return date('d M d',strtotime($Date));
    }
}
if(!function_exists('directFile')){
    function directFile($path,$image){
        $name = $image->getClientOriginalName(); 
        $fileName = date("Y-m-d").rand(1111111,9999999).$name;
        $image->move(public_path($path),$fileName);
        return $fileName;
    }
}
if(!function_exists('autoheight')){
    function autoheight($path,$width,$image){
        $name = $image->getClientOriginalName(); 
        $fileName = date("Y-m-d").rand(1111111,9999999);        

        /** webp **/
        $imagesource = public_path($path.$fileName.'.webp'); 
        \Image::make($image->getRealPath())->encode('webp', 90)->resize($width,null,function ($constraint) {
            $constraint->aspectRatio();
        })->brightness(1)->save($imagesource);

         
        /** jpg **/
        $imagesource2 = public_path($path.'jpg/'.$fileName.'.jpg'); 
        \Image::make($image->getRealPath())->encode('jpg', 90)->resize($width,null,function ($constraint) {
            $constraint->aspectRatio();
        })->brightness(1)->save($imagesource2);
       
        return $fileName;
    }
}
if(!function_exists('generatealias')){
    function generatealias($table,$field,$title){

        $table=$table;

        $field=$field; 

        $slug = $title; 

        $slug = Str::slug($title, "-");

        $key=NULL;

        $value=NULL;

        $i = 0;

        $params = array ();

        $params[$field] = $slug;

        if($key)$params["$key !="] = $value;

        while (DB::table($table)->where($params)->get()->count()){

            if (!preg_match ('/-{1}[0-9]+$/', $slug ))

                $slug .= '-' . ++$i;

            else

                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );

                $params [$field] = $slug;

        }

        return  $alias=$slug;

    }
}
if(!function_exists('youtube_preview')){
    function youtube_preview($data,$width,$height){
        $url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<iframe class='".$width."' height='" . $height . "' src='//www.youtube.com/embed/$1\' frameborder='0' allowfullscreen></iframe>", $data);
        return $url;
    }
}

if(!function_exists('TwoColor')){
    function TwoColor($str){

        $data = explode(" ", $str);

        $data1 = '';

        $counter = count($data);

        $count = round($counter / 2);

        for ($i = 0; $i < $count; $i++) {

            $data1 .= $data[$i] . ' ';

        }

        $data2 = '';

        for ($j = $count; $j < $counter; $j++) {

            $data2 .= $data[$j] . ' ';

        }

        return [$data1, $data2];

    }
}

if(!function_exists('trackregistraionstep')){
    function trackregistraionstep($step){
        if($step==2){ return '<span class="badge badge-danger">Left at currently working step (STEP #3)</span>'; }
        if($step==3){ return '<span class="badge badge-danger">Left at company information step (STEP #4)</span>'; }
        if($step==4){ return '<span class="badge badge-danger">Left at expertise step (STEP #5) </span>'; }
        if($step==5){ return '<span class="badge badge-danger">Left at current industry step (STEP #6)</span>'; }
        if($step==6){ return '<span class="badge badge-danger">Left at fluent language step (STEP #7)</span>'; }
        if($step==7){ return '<span class="badge badge-danger">Left at session charges step (STEP #8)</span>'; }
        if($step==8){ return '<span class="badge badge-danger">Left at take session in week step (STEP #9)</span>'; }
        if($step==9){ return '<span class="badge badge-danger">Left at summary of bio step (STEP #10)</span>'; }
        if($step==10){ return '<span class="badge badge-danger">Left at social media profile step (STEP #11)</span>'; }
        if($step==11){ return '<span class="badge badge-danger">Left at experience step (STEP #12)</span>'; }
        if($step==12){ return '<span class="badge badge-danger">Left at Terms & condition step (STEP #13)</span>'; }
    }
}

?>