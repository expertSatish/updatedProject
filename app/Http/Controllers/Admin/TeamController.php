<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
class TeamController extends Controller{
    public function index(){
        $banners = Team::orderBy('sequence','DESC')->paginate(20);
        return view('admin.team.list',compact('banners'));
    }
    public function create(){
        return view('admin.team.add');
    }
    public function store(Request $request){
        $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif,svg,webp,mp4|required',
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        if(!empty($request->image)){
            $extension =  $request->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/team/',$request->image);
            }else{
                $FileName = autoheight('uploads/team/',220,$request->image);
            }
        }
        $data = new Team();       
        $data->title = $request->title;    
        $data->designation = $request->designation;         
        $data->description = $request->description;
        $data->sequence = (Team::max('sequence') + 1);         
        $data->facebook = $request->facebook;         
        $data->linkedin = $request->linkedin;         
        $data->twitter = $request->twitter;         
        $data->instagram = $request->instagram;         
        $data->pinterest = $request->pinterest;
        $data->image = $FileName;
        $data->save();
        
        return back()->with('success','Data Saved!');
    }
    public function edit($id){
        $data = Team::find($id);
        if(empty($data)){ return 'Sorry! this data is not available at this moment.'; }
        return view('admin.team.edit',compact('data'));
    }
    public function update(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        if(!empty($request->image)){
            $extension =  $request->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/team/',$request->image);
            }else{
                $FileName = autoheight('uploads/team/',220,$request->image);
            }
        } 

        $data = Team::find($request->preid);  
        $data->title = $request->title;    
        $data->designation = $request->designation;         
        $data->description = $request->description;
        if(!empty($request->image)){ $data->image = $FileName; }       
        $data->facebook = $request->facebook;         
        $data->linkedin = $request->linkedin;         
        $data->twitter = $request->twitter;         
        $data->instagram = $request->instagram;         
        $data->pinterest = $request->pinterest;
        $data->save();
        return back()->with('success','Data Updated!');
    }
    public function destory($removeId){
        $data = Team::find($removeId);
        if(!empty($data->image) && file_exists(public_path('storage/uploads/team/'.$data->image))){
            unlink(public_path('storage/uploads/team/'.$data->image));
        }
        if(!empty($data->image) && file_exists(public_path('storage/uploads/team/'.$data->image.'.webp'))){
            unlink(public_path('storage/uploads/team/'.$data->image.'.webp'));
        }
        if(!empty($data->image) && file_exists(public_path('storage/uploads/team/jpg/'.$data->image.'.jpg'))){
            unlink(public_path('storage/uploads/team/jpg/'.$data->image.'.jpg'));
        }
        $data->delete();
        return back()->with('success', 'Data have been removed!');
    }
    public function bulkdestory(Request $request){
        if(empty($request->check)){ return back()->with(['error_msg' => 'Please choose at least one data.']); }
        foreach($request->check as $removeId){
            $data = Team::find($removeId);
            if(!empty($data->image) && file_exists(public_path('storage/uploads/team/'.$data->image))){
                unlink(public_path('storage/uploads/team/'.$data->image));
            }
            if(!empty($data->image) && file_exists(public_path('storage/uploads/team/'.$data->image.'.webp'))){
                unlink(public_path('storage/uploads/team/'.$data->image.'.webp'));
            }
            if(!empty($data->image) && file_exists(public_path('storage/uploads/team/jpg/'.$data->image.'.jpg'))){
                unlink(public_path('storage/uploads/team/jpg/'.$data->image.'.jpg'));
            }
            $data->delete();
        }
        return back()->with('success', 'Data Removed!');
    }
    public function status(Request $request){
        Team::where('id',$request->id)->update(['is_publish'=>$request->status]);
        return response()->json([
            'success' => 'Status updated!'
        ]);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence){
            $data = Team::find($id);
            $data->sequence = $sequence;
            $data->save();
        }
        return back()->with(['success' => 'Sequence updated!']);
    }
}
