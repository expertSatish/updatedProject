<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpertiseController extends Controller
{
    public function index(){
        $categories =  \App\Models\ExpertCategory::where('is_publish',1)->get();
        $lists = \App\Models\Expertise::latest()->paginate(10);
        return view('admin.expertise.list',compact('lists','categories'));
    }

    public function store(Request $request){
       $request->validate([
        'title' => 'required|max:255|string|unique:expertises',
        'category' => 'required'
       ]);
       $data = new \App\Models\Expertise();
       $data->title = $request->title;
       $data->category_id = $request->category;
       $data->alias = generatealias('expertises','alias',$request->title);
       $data->is_publish = 1;
       $data->sequence = (\App\Models\Expertise::max('sequence') + 1);
       $data->save();
       return back()->with(['success'=>'Data Saved!']);
    }

    public function edit(Request $request){
        $lists = \App\Models\Expertise::find($request->id);
        $categories =  \App\Models\ExpertCategory::where('is_publish',1)->get();
        return view('admin.expertise.edit',compact('lists','categories'));
    }
    
    public function update(Request $request){
        $request->validate([
            'title' => 'required|max:255|string|unique:expertises,title,'.$request->id.',id',
            'category' => 'required'
        ]);
        $data = \App\Models\Expertise::find($request->id);
        $data->title = $request->title;
        $data->category_id = $request->category;
        if($request->title!=$request->oldtitle){
           $data->alias = generatealias('expertises','alias',$request->title);
        }
        $data->save();
        return response()->json([
            'success'=>'Data Updated!'
        ]);
    }

    public function status(Request $request){
        $data =  \App\Models\Expertise::find($request->id);
        $data->is_publish = $request->status;
        $data->save();
    }
    public function destroy($id){
        $data =  \App\Models\Expertise::find($id)->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence):
            $data =  \App\Models\Expertise::find($id);
            $data->sequence = $sequence;
            $data->save();
        endforeach;
        return back()->with(['success'=>'Sequence Updated!']);
    }
    public function bulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\Expertise::find($id);
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }
}
