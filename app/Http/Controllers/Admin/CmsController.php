<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmsController extends Controller
{
   
    public function cmsmodal($id){
        $lists = \App\Models\Cms::find($id);
        return view('admin.cms.cms-modal',compact('lists'));
    }
    public function about(){
        $lists = \App\Models\Cms::find(4);
        return view('admin.cms.edit',compact('lists'));
    }
    public function mission(){
        $lists = \App\Models\Cms::find(5);
        return view('admin.cms.edit',compact('lists'));
    }
    public function vission(){
        $lists = \App\Models\Cms::find(6);
        return view('admin.cms.edit',compact('lists'));
    }
    public function teamcms(){
        $lists = \App\Models\Cms::find(7);
        return view('admin.cms.edit',compact('lists'));
    }   
    public function privacypolicy(){
        $lists = \App\Models\Cms::find(8);
        return view('admin.cms.edit',compact('lists'));
    }
    public function termscondition(){
        $lists = \App\Models\Cms::find(9);
        return view('admin.cms.edit',compact('lists'));
    }
    public function blogcms(){
        $lists = \App\Models\Cms::find(10);
        return view('admin.cms.edit',compact('lists'));
    }
    public function contactcms(){
        $lists = \App\Models\Cms::find(11);
        return view('admin.cms.edit',compact('lists'));
    }
    public function contact(){
        $lists = \App\Models\Cms::find(12);
        return view('admin.cms.edit',compact('lists'));
    }
    public function becomeanexpertbanner(){
        $lists = \App\Models\Cms::find(13);
        return view('admin.cms.edit',compact('lists'));
    }
    public function becomeanexpertcontent(){
        $lists = \App\Models\Cms::find(14);
        return view('admin.cms.edit',compact('lists'));
    }
    public function becomeanexpertabout(){
        $lists = \App\Models\Cms::find(15);
        return view('admin.cms.edit',compact('lists'));
    }
    public function memtorcms(){
        $lists = \App\Models\Cms::find(16);
        return view('admin.cms.edit',compact('lists'));
    }
    public function callingprocesscms(){
        $lists = \App\Models\Cms::find(17);
        return view('admin.cms.edit',compact('lists'));
    }
    public function testimonialcms(){
        $lists = \App\Models\Cms::find(18);
        return view('admin.cms.edit',compact('lists'));
    }
    public function careercms(){
        $lists = \App\Models\Cms::find(19);
        return view('admin.cms.edit',compact('lists'));
    }
    public function faqcms(){
        $lists = \App\Models\Cms::find(20);
        return view('admin.cms.edit',compact('lists'));
    }
    public function homeexpertcms(){
        $lists = \App\Models\Cms::find(21);
        return view('admin.cms.edit',compact('lists'));
    }
    public function homeexpertcategorycms(){
        $lists = \App\Models\Cms::find(22);
        return view('admin.cms.edit',compact('lists'));
    }
    public function hometestimonialcms(){
        $lists = \App\Models\Cms::find(23);
        return view('admin.cms.edit',compact('lists'));
    }
    public function homenewscms(){
        $lists = \App\Models\Cms::find(24);
        return view('admin.cms.edit',compact('lists'));
    }
    public function youanexpert(){
        $lists = \App\Models\Cms::find(25);
        return view('admin.cms.edit',compact('lists'));
    }
    public function findexpertstepcms(){
        $lists = \App\Models\Cms::find(26);
        return view('admin.cms.edit',compact('lists'));
    }
    public function featuredcms(){
        $lists = \App\Models\Cms::find(27);
        return view('admin.cms.edit',compact('lists'));
    }
    public function bannercms(){
        $lists = \App\Models\Cms::find(28);
        return view('admin.cms.edit',compact('lists'));
    }
    public function videocms(){
        $lists = \App\Models\Cms::find(29);
        return view('admin.cms.edit',compact('lists'));
    }
    public function findexpertcategorycms(){
        $lists = \App\Models\Cms::find(30);
        return view('admin.cms.edit',compact('lists'));
    }
    public function updatecms(Request $request)
    {
      if(!empty($request->image)){
          $extension =  $request->image->getClientOriginalExtension();
          if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
              $FileName = directFile('uploads/cms/',$request->image);
          }else{
              $FileName = autoheight('uploads/cms/',600,$request->image);
          }
      }
      if(!empty($request->image2)){
          $extension =  $request->image2->getClientOriginalExtension();
          if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
              $FileName2 = directFile('uploads/cms/',$request->image2);
          }else{
              $FileName2 = autoheight('uploads/cms/',246,$request->image2);
          }
      }

        $lists = \App\Models\Cms::find($request->id);
        $lists->title = $request->title;
        $lists->heading = $request->heading;
        $lists->description = $request->description;
        if(!empty($request->image)){ $lists->image = $FileName; }
        if(!empty($request->image2)){ $lists->image_2 = $FileName2; }
        $lists->save();
       return back()->with('success','Data Updated!');
    }
    public function updatecmsmodal(Request $request)
    {
      if(!empty($request->image)){
          $extension =  $request->image->getClientOriginalExtension();
          if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
              $FileName = directFile('uploads/cms/',$request->image);
          }else{
              $FileName = autoheight('uploads/cms/',600,$request->image);
          }
      }
      if(!empty($request->image2)){
          $extension =  $request->image2->getClientOriginalExtension();
          if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
              $FileName2 = directFile('uploads/cms/',$request->image2);
          }else{
              $FileName2 = autoheight('uploads/cms/',246,$request->image2);
          }
      }

        $lists = \App\Models\Cms::find($request->id);
        $lists->title = $request->title;
        $lists->heading = $request->heading;
        $lists->description = $request->description;
        if(!empty($request->image)){ $lists->image = $FileName; }
        if(!empty($request->image2)){ $lists->image_2 = $FileName2; }
        $lists->save();
        return response()->json([
            'success'=>'Data Updated!'
        ]);
    }


    public function editorimage(){
        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
              $name = md5(rand(100, 200));
              $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
              $filename = $name.
              '.'.$ext;
              $destination = public_path('/uploads/editor/'.$filename); //change this directory
              $location = $_FILES["file"]["tmp_name"];
              move_uploaded_file($location, $destination);
              $message = asset('uploads/editor/'.$filename); //change this URL
              return response()->json([
                'url' => $message
              ]);
            } else {
              echo $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
            }
          }
    }
}
