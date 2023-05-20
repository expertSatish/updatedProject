<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller{
    public function index(){
        $lists = \App\Models\User::latest();
        if(!empty(request('month'))){ $lists = $lists->whereMonth('created_at',request('month')); }
        if(!empty(request('year'))){ $lists = $lists->whereYear('created_at',request('year')); }
        if(!empty(request('search'))){
            $search = request('search');
            $lists = $lists->where(function($q) use ($search){
                $q->where('name','LIKE','%'.$search.'%');
                $q->orwhere('email','LIKE','%'.$search.'%');
                $q->orwhere('mobile','LIKE','%'.$search.'%');
                $q->orwhere('user_id','LIKE','%'.$search.'%');
            });
        }
        $lists = $lists->paginate(10);
        return view('admin.users.lists',compact('lists'));
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence):
            $data =  \App\Models\User::find($id);
            $data->sequence = $sequence;
            $data->save();
        endforeach;
        return back()->with(['success'=>'Sequence Updated!']);
    }
    public function status(Request $request){
        $data =  \App\Models\User::find($request->id);
        $data->is_publish = $request->status;
        $data->save();
    }
    public function destroy($id){
        $data =  \App\Models\User::find($id)->delete();
        return back()->with(['success'=>'Data Removed!']);
    }
    public function bulkremove(Request $request){
        if(empty($request->check)){ return back()->with(['error'=>'Please choose at least one data']); }
        foreach($request->check as $id ):
            $data =  \App\Models\User::find($id);
            $data->delete();
        endforeach;
        return back()->with(['success'=>'Data Removed!']);
    }
    public function information($page,$id){
        $data =  \App\Models\User::find($id);
        if(empty($data)){ abort(404); }
        if($page=='info'){ return view('admin.users.information',compact('data')); }
        if($page=='slot'){ 
            $lists = \App\Models\SlotBook::where(['user_id'=>$id])->paginate(100);
            return view('admin.users.slot',compact('data','lists')); 
        }
        abort(404);
    }
    public function edit($id){
        $lists = \App\Models\User::findOrFail($id);
        $countries = \App\Models\Country::where('status',1)->get();
        return view('admin.users.edit',compact('lists','countries'));
    }
    public function update(Request $r){
        $r->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,'.$r->preid.',id,deleted_at,NULL',
            'mobile' => 'required|min:8|unique:users,mobile,'.$r->preid.',id,deleted_at,NULL',
        ],[
            'name.required'=>'profile name is required.',
            'email.required'=>'email address is required.',
            'mobile.required'=>'mobile number is required.',
            'email.unique' => 'this email address already exists.',
            'mobile.unique' => 'this mobile number already exists.',
        ]);

        $data = \App\Models\User::find($r->preid); 
        $data->name = $r->name;
        $data->email = $r->email;
        $data->mobile = $r->mobile;
        $data->ccode = $r->ccode;
        $data->country = $r->country;
        $data->state = $r->state;
        $data->city = $r->city;
        $data->gender = $r->gender;
        $data->dob = (!empty($r->dob) ? date('Y-m-d',strtotime($r->dob)) : NULL);
        if(!empty($r->profile)){
            $extension =  $r->profile->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $FileName = directFile('uploads/user/',$r->profile);
            }else{
                $FileName = autoheight('uploads/user/',476,$r->profile);
            }
            if(!empty($r->profile)){
                if(file_exists(public_path('uploads/user/'.$r->profile))){
                    unlink(public_path('uploads/user/'.$r->profile));
                }
                if(file_exists(public_path('uploads/user/jpg/'.$r->profile.'.jpg'))){
                    unlink(public_path('uploads/user/jpg/'.$r->profile.'.jpg'));
                }
                if(file_exists(public_path('uploads/user/'.$r->profile.'.webp'))){
                    unlink(public_path('uploads/user/'.$r->profile.'.webp'));
                }
            }
            $data->profile = $FileName;
            
        }
        $data->complete_profile=1;
        $data->save();
        return back()->with('success','User Information Updated!');
    }
    public function countrystates(Request $r){
        $states = \App\Models\State::where(['status'=>1,'country_id'=>$r->country])->get();
        return response()->json([
            'data'=>$states
        ]);
    }
    public function statecities(Request $r){
        $cities = \App\Models\City::where(['status'=>1,'state_id'=>$r->state])->get();
        return response()->json([
            'data'=>$cities
        ]);
    }



}
