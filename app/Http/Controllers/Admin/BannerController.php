<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(){
        $lists = \App\Models\Banner::latest()->paginate(10);
        return view('admin.banner.list',compact('lists'));
    }
    public function store(Request $request){
        $request->validate([
            'type' => 'required',
            'youtube' => 'required_if:type,==,youtube',
            'title' => 'required_if:type,==,image',
            'image' => 'required_if:type,==,image',
        ]);
        if(!empty($request->image) && $request->type=='image'){
            $extension =  $request->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/banner/',$request->image);
            }else{
                $FileName = autoheight('uploads/banner/',1150,$request->image);
            }
        }
        if(!empty($request->image) && $request->type=='video'){
            $FileName = directFile('uploads/banner/',$request->image);
        }
        $data = new \App\Models\Banner();
        $data->type = $request->type;
        if($request->type=='youtube'){ 
            $data->title = $request->youtube;
        }else{            
            $data->title = $request->title;
            $data->image = $FileName;
        }
        $data->is_publish = 1;        
        $data->sequence = (\App\Models\Banner::max('sequence') + 1);
        $data->save();
        return back()->with(['success'=>'Data Saved!']);
    }
    public function edit(Request $request){
        $lists = \App\Models\Banner::find($request->id);
        return view('admin.banner.edit',compact('lists'));
    }    
    public function update(Request $request){
        $request->validate([
            'type' => 'required',
            'youtube' => 'required_if:type,==,youtube',
            'title' => 'required_if:type,==,image',
        ]);

        if(!empty($r->image) && $request->type=='image'){
            $extension =  $r->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/banner/',$r->image);
            }else{
                $FileName = autoheight('uploads/banner/',1150,$r->image);
            }
        }
        if(!empty($request->image) && $request->type=='video'){
            $FileName = directFile('uploads/banner/',$request->image);
        }
        $data = \App\Models\Banner::find($request->id);
        $data->type = $request->type;
        if($request->type=='youtube'){ 
            $data->title = $request->youtube;
        }else{     
            $data->title = $request->title;
            if(!empty($request->image)){ $data->image = $FileName; }
        }    
        $data->save();
        
        return response()->json([
            'success'=>'Data Updated!'
        ]);
    }
    public function status(Request $request){
        $data =  \App\Models\Banner::find($request->id);
        $data->is_publish = $request->status;
        $data->save();
    }
    public function destroy($id){
        $data =  \App\Models\Banner::find($id);
        if(!empty($data->image) && file_exists(public_path('uploads/banner/'.$data->image))){
            unlink(public_path('uploads/banner/'.$data->image));
        }
        if(!empty($data->image) && file_exists(public_path('uploads/banner/'.$data->image.'.webp'))){
            unlink(public_path('uploads/banner/'.$data->image.'.webp'));
        }
        if(!empty($data->image) && file_exists(public_path('uploads/banner/jpg/'.$data->image.'.jpg'))){
            unlink(public_path('uploads/banner/jpg/'.$data->image.'.jpg'));
        }
        $data = $data->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence):
            $data =  \App\Models\Banner::find($id);
            $data->sequence = $sequence;
            $data->save();
        endforeach;
        return back()->with(['success'=>'Sequence Updated!']);
    }
    public function bulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\Banner::find($id);
            if(!empty($data->image) && file_exists(public_path('uploads/banner/'.$data->image))){
                unlink(public_path('uploads/banner/'.$data->image));
            }
            if(!empty($data->image) && file_exists(public_path('uploads/banner/'.$data->image.'.webp'))){
                unlink(public_path('uploads/banner/'.$data->image.'.webp'));
            }
            if(!empty($data->image) && file_exists(public_path('uploads/banner/jpg/'.$data->image.'.jpg'))){
                unlink(public_path('uploads/banner/jpg/'.$data->image.'.jpg'));
            }
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }
}
