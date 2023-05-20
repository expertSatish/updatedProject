<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use Helper;    
use Image;

class BannerController extends Controller
{
    
     public function __construct()
    {
        $this->middleware('auth.admin');
    }
    
    function index()
    {
        $getBanner = Banner::all();
        $getBannertext = '';
        return view('control-panel.banner.banner-management')->with(array('getBanner'=>$getBanner,'getBannertext'=>$getBannertext));
    }
    
    
    function New_Banner()
    {
       return view('control-panel.banner.add-banner')->with(array('flag'=>false));  
    }
    
    
    function Update_Banner($BannerId)
    {
        $getBanner = Banner::find($BannerId);    
         return view('control-panel.banner.add-banner')->with(array('flag'=>true,'array_data'=>$getBanner));  
    }
    
    function Save_Banner(Request $r)
    {
        $Banner = new Banner();
        
        $Banner->img_alt = $r->image_alt;
        $Banner->image = $r->PreImage;
       
        if($Banner->save()){ return redirect()->back()->with(array('success_msg'=>Helper::saveMSG())); }

        else{ return redirect()->back()->with(array('error_msg'=>Helper::errorMSG())); }
        
    }
    
    
    function Edit_Banner(Request $r,$Bannerid)
    {
        $Banner = Banner::find($Bannerid);
        
        
        if(empty($r->Image))
        {
            $FileName = $r->PreImage;
        }
        else
        {
            $FileName = '';
        }
        
        
        
        $Banner->img_alt = $r->image_alt;
        $Banner->image = $FileName;
       
        if($Banner->save()){
            
             return redirect()->back()->with(array('success_msg'=>Helper::updateMSG()));
            
        }
        else
        {
            
             return redirect()->back()->with(array('error_msg'=>Helper::errorMSG()));
            
        }
    }
    
    function Banner_Remove(Request $r)
    {
        $Banner = new Banner();
        
        $Check = $r->check;
        
        foreach($Check as $Rows):
           
           $Banner = Banner::find($Rows);
           $Banner->delete();
        
        endforeach;
        
         return redirect()->back()->with(array('success_msg'=>Helper::removeMSG()));
        
        
    }
    
    function Banner_Status($Status,$bannerId)
    {
         $Banner = new Banner();
        
         $Banner = Banner::find($bannerId);
        
         $Banner->status = $Status;
        
         if($Banner->save())
         {
            
             return redirect()->back()->with(array('success_msg'=>Helper::updateMSG()));
            
        }
        else
        {
            
             return redirect()->back()->with(array('error_msg'=>Helper::errorMSG()));
            
        }
        
        
    }




    function Banner_Main_Status($Status,$bannerId)
    {
        $Banner = new Banner();
        
         $Banner = Banner::find($bannerId);
        
         $Banner->main_heading = $Status;
        
         if($Banner->save()){

              Banner::where('id','!=',$bannerId)->update(['main_heading'=>0]);
            
             return redirect()->back()->with(array('success_msg'=>Helper::updateMSG()));
            
        }
        else
        {
            
             return redirect()->back()->with(array('error_msg'=>Helper::errorMSG()));
            
        }
    }
    
    
}
