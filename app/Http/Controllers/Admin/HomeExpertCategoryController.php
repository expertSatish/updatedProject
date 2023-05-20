<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeExpertCategoryController extends Controller
{
    public function index(){
        $lists = \App\Models\HomeExpertCategory::latest()->paginate(10);
        return view('admin.homeexpertscategtory.list',compact('lists'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255|string|unique:home_expert_categories,deleted_at,NULL',
            // 'image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:2024',
            // 'short_description' => 'required'
        ],[
            'title.required'=>'title filed is required.',
            'title.unique'=>'this title already exsist.'
        ]);
        if(!empty($request->image)){
            $extension =  $request->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/homecategory/',$request->image);
            }else{
                $FileName = autoheight('uploads/homecategory/',300,$request->image);
            }
        }
        $data = new \App\Models\HomeExpertCategory();
        $data->title = $request->title;
        $data->is_publish = 1;
        $data->short_description = $request->short_description ?? '';
        if(!empty($request->image)){ 
            $data->image = $FileName;
        }        
        $data->sequence = (\App\Models\HomeExpertCategory::max('sequence') + 1);
        $data->save();
        return back()->with(['success'=>'Data Saved!']);
    }
    public function edit(Request $request){
        $lists = \App\Models\HomeExpertCategory::find($request->id);
        return view('admin.homeexpertscategtory.edit',compact('lists'));
    }    
    public function update(Request $request){
        $request->validate([
            'title' => 'required|max:255|string|unique:home_expert_categories,title,'.$request->id.',id',
            // 'short_description' => 'required'
        ]);
        if(!empty($request->image)){
            $extension =  $request->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/homecategory/',$request->image);
            }else{
                $FileName = autoheight('uploads/homecategory/',300,$request->image);
            }
        }
        $data = \App\Models\HomeExpertCategory::find($request->id);
        $data->title = $request->title;
        if(!empty($request->image)){ $data->image = $FileName; }
        $data->short_description = $request->short_description ?? '';
        $data->save();
        return response()->json([
            'success'=>'Data Updated!'
        ]);
    }
    public function status(Request $request){
        $data =  \App\Models\HomeExpertCategory::find($request->id);
        $data->is_publish = $request->status;
        $data->save();
    }
    public function destroy($id){
        $data =  \App\Models\HomeExpertCategory::find($id);
        if(!empty($data->image) && file_exists(public_path('storage/uploads/homecategory/'.$data->image))){
            unlink(public_path('storage/uploads/homecategory/'.$data->image));
        }
        if(!empty($data->image) && file_exists(public_path('storage/uploads/homecategory/'.$data->image.'.webp'))){
            unlink(public_path('storage/uploads/homecategory/'.$data->image.'.webp'));
        }
        if(!empty($data->image) && file_exists(public_path('storage/uploads/homecategory/jpg/'.$data->image.'.jpg'))){
            unlink(public_path('storage/uploads/homecategory/jpg/'.$data->image.'.jpg'));
        }
        $data = $data->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence):
            $data =  \App\Models\HomeExpertCategory::find($id);
            $data->sequence = $sequence;
            $data->save();
        endforeach;
        return back()->with(['success'=>'Sequence Updated!']);
    }
    public function bulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\HomeExpertCategory::find($id);
            if(!empty($data->image) && file_exists(public_path('storage/uploads/homecategory/'.$data->image))){
                unlink(public_path('storage/uploads/homecategory/'.$data->image));
            }
            if(!empty($data->image) && file_exists(public_path('storage/uploads/homecategory/'.$data->image.'.webp'))){
                unlink(public_path('storage/uploads/homecategory/'.$data->image.'.webp'));
            }
            if(!empty($data->image) && file_exists(public_path('storage/uploads/homecategory/jpg/'.$data->image.'.jpg'))){
                unlink(public_path('storage/uploads/homecategory/jpg/'.$data->image.'.jpg'));
            }
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }
}
