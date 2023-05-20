<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FindExpertStepController extends Controller
{
    public function index(){
        $lists = \App\Models\FindExpertStep::latest()->paginate(10);
        return view('admin.findexpertstep.list',compact('lists'));
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255|string',
            'image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif|max:2024',
            'description' => 'required'
        ],[
            'title.required'=>'title filed is required.',
            'title.unique'=>'this title already exsist.'
        ]);
        if(!empty($request->image)){
            $extension =  $request->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/findexpertstep/',$request->image);
            }else{
                $FileName = autoheight('uploads/findexpertstep/',50,$request->image);
            }
        }
        $data = new \App\Models\FindExpertStep();
        $data->title = $request->title;
        $data->is_publish = 1;
        $data->description = $request->description ?? '';
        $data->image = $FileName;
        $data->sequence = (\App\Models\FindExpertStep::max('sequence') + 1);
        $data->save();
        return back()->with(['success'=>'Data Saved!']);
    }
    public function edit(Request $request){
        $lists = \App\Models\FindExpertStep::find($request->id);
        return view('admin.findexpertstep.edit',compact('lists'));
    }    
    public function update(Request $request){
        $request->validate([
            'title' => 'required|max:255|string',
            'description' => 'required'
        ]);
        if(!empty($r->image)){
            $extension =  $r->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/findexpertstep/',$r->image);
            }else{
                $FileName = autoheight('uploads/findexpertstep/',50,$r->image);
            }
        }
        $data = \App\Models\FindExpertStep::find($request->id);
        $data->title = $request->title;
        if(!empty($r->image)){ $data->image = $FileName; }
        $data->description = $request->description ?? '';
        $data->save();
        return response()->json([
            'success'=>'Data Updated!'
        ]);
    }
    public function status(Request $request){
        $data =  \App\Models\FindExpertStep::find($request->id);
        $data->is_publish = $request->status;
        $data->save();
    }
    public function destroy($id){
        $data =  \App\Models\FindExpertStep::find($id);
        if(!empty($data->image) && file_exists(public_path('storage/uploads/findexpertstep/'.$data->image))){
            unlink(public_path('storage/uploads/findexpertstep/'.$data->image));
        }
        if(!empty($data->image) && file_exists(public_path('storage/uploads/findexpertstep/'.$data->image.'.webp'))){
            unlink(public_path('storage/uploads/findexpertstep/'.$data->image.'.webp'));
        }
        if(!empty($data->image) && file_exists(public_path('storage/uploads/findexpertstep/jpg/'.$data->image.'.jpg'))){
            unlink(public_path('storage/uploads/findexpertstep/jpg/'.$data->image.'.jpg'));
        }
        $data = $data->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence):
            $data =  \App\Models\FindExpertStep::find($id);
            $data->sequence = $sequence;
            $data->save();
        endforeach;
        return back()->with(['success'=>'Sequence Updated!']);
    }
    public function bulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\FindExpertStep::find($id);
            if(!empty($data->image) && file_exists(public_path('storage/uploads/findexpertstep/'.$data->image))){
                unlink(public_path('storage/uploads/findexpertstep/'.$data->image));
            }
            if(!empty($data->image) && file_exists(public_path('storage/uploads/findexpertstep/'.$data->image.'.webp'))){
                unlink(public_path('storage/uploads/findexpertstep/'.$data->image.'.webp'));
            }
            if(!empty($data->image) && file_exists(public_path('storage/uploads/findexpertstep/jpg/'.$data->image.'.jpg'))){
                unlink(public_path('storage/uploads/findexpertstep/jpg/'.$data->image.'.jpg'));
            }
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }
}
