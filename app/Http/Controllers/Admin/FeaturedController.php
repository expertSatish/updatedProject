<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeaturedController extends Controller
{
    public function index(){
        $lists = \App\Models\Featured::latest()->paginate(10);
        return view('admin.featured.list',compact('lists'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255|string|unique:expert_categories',
            'image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:2024',
        ],[
            'title.required'=>'title filed is required.',
            'title.unique'=>'this title already exsist.'
        ]);
        if(!empty($request->image)){
            $extension =  $request->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/featured/',$request->image);
            }else{
                $FileName = autoheight('uploads/featured/',220,$request->image);
            }
        }
        $data = new \App\Models\Featured();
        $data->title = $request->title;
        $data->is_publish = 1;
        $data->image = $FileName;
        $data->sequence = (\App\Models\Featured::max('sequence') + 1);
        $data->save();
        return back()->with(['success'=>'Data Saved!']);
    }
    public function edit(Request $request){
        $lists = \App\Models\Featured::find($request->id);
        return view('admin.featured.edit',compact('lists'));
    }    
    public function update(Request $request){
        $request->validate([
            'title' => 'required|max:255|string',
        ]);
        if(!empty($r->image)){
            $extension =  $r->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/featured/',$r->image);
            }else{
                $FileName = autoheight('uploads/featured/',220,$r->image);
            }
        }
        $data = \App\Models\Featured::find($request->id);
        $data->title = $request->title;
        if(!empty($r->image)){ $data->image = $FileName; }
        $data->save();
        return response()->json([
            'success'=>'Data Updated!'
        ]);
    }
    public function status(Request $request){
        $data =  \App\Models\Featured::find($request->id);
        $data->is_publish = $request->status;
        $data->save();
    }
    public function destroy($id){
        $data =  \App\Models\Featured::find($id);
        if(!empty($data->image) && file_exists(public_path('storage/uploads/featured/'.$data->image))){
            unlink(public_path('storage/uploads/featured/'.$data->image));
        }
        if(!empty($data->image) && file_exists(public_path('storage/uploads/featured/'.$data->image.'.webp'))){
            unlink(public_path('storage/uploads/featured/'.$data->image.'.webp'));
        }
        if(!empty($data->image) && file_exists(public_path('storage/uploads/featured/jpg/'.$data->image.'.jpg'))){
            unlink(public_path('storage/uploads/featured/jpg/'.$data->image.'.jpg'));
        }
        $data = $data->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence):
            $data =  \App\Models\Featured::find($id);
            $data->sequence = $sequence;
            $data->save();
        endforeach;
        return back()->with(['success'=>'Sequence Updated!']);
    }
    public function bulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\Featured::find($id);
            if(!empty($data->image) && file_exists(public_path('storage/uploads/featured/'.$data->image))){
                unlink(public_path('storage/uploads/featured/'.$data->image));
            }
            if(!empty($data->image) && file_exists(public_path('storage/uploads/featured/'.$data->image.'.webp'))){
                unlink(public_path('storage/uploads/featured/'.$data->image.'.webp'));
            }
            if(!empty($data->image) && file_exists(public_path('storage/uploads/featured/jpg/'.$data->image.'.jpg'))){
                unlink(public_path('storage/uploads/featured/jpg/'.$data->image.'.jpg'));
            }
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }
}
