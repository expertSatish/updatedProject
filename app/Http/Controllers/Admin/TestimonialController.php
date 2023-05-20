<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
class TestimonialController extends Controller
{
    public function index()
    {
        $lists = Testimonial::orderBy('sequence','ASC')->paginate(20);
        return view('admin.testimonial.list',compact('lists'));
    }

    public function create()
    {
        return view('admin.testimonial.add');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'required',
            'image' => 'mimes:jpeg,jpg,png,gif,svg,webp,avif|required',
        ]);
        if(!empty($request->image)){
            $extension =  $request->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/testimonial/',$request->image);
            }else{
                $FileName = autoheight('uploads/testimonial/',575,$request->image);
            }
        }        
        $data = new Testimonial();       
        $data->name = $request->title;
        $data->description = $request->description;
        $data->sequence = (Testimonial::max('sequence') + 1);
        $data->image = $FileName;
        $data->rating = $request->rating;
        $data->save();
       return back()->with('success','Data has been saved!');
    }

    public function show()
    {
        $lists = Testimonial::latest();
        if(!empty($_GET['status'])){
            if($_GET['status']=='publish'){ $lists = $lists->where('is_publish',1);}
            if($_GET['status']=='non-publish'){ $lists = $lists->where('is_publish',0);}
        }
        $lists = $lists->paginate(50);
        return view('admin.testimonial.table',compact('lists'));
    }

    public function edit($editid)
    {
        $data = Testimonial::find($editid);
        if(empty($data)){ return 'Sorry! this data is not available at this moment.'; }
        return view('admin.testimonial.edit',compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'required',
        ]);
        if(!empty($request->image)){
            $extension =  $request->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP'){
                $FileName = directFile('uploads/testimonial/',$request->image);
            }else{
                $FileName = autoheight('uploads/testimonial/',575,$request->image);
            }
        }
        
        $data = Testimonial::find($request->preid);      
        $data->name = $request->title;
        $data->description = $request->description;
        if(!empty($request->image)){ $data->image = $FileName; }  
        $data->rating = $request->rating;      
        $data->save();
        return back()->with('success','Data has been updated!');
    }

    public function status(Request $request){
        Testimonial::where('id',$request->id)->update(['is_publish'=>$request->status]);
        return response()->json([
            'success_msg' => 'Status have been updated!'
        ]);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence){
            $data = Testimonial::find($id);
            $data->sequence = $sequence;
            $data->save();
        }
        return back()->with(['success_msg' => 'Sequence have been updated!']);
    }
    public function bulkdestory(Request $request){
        if(empty($request->check)){ return back()->with(['error_msg' => 'Please choose at least one data.']); }
        foreach($request->check as $removeId){
            $data = Testimonial::find($removeId);
           if(!empty($data->image) && file_exists(public_path('storage/uploads/testimonial/'.$data->image))){
                unlink(public_path('storage/uploads/testimonial/'.$data->image));
            }
            if(!empty($data->image) && file_exists(public_path('storage/uploads/testimonial/'.$data->image.'.webp'))){
                unlink(public_path('storage/uploads/testimonial/'.$data->image.'.webp'));
            }
            if(!empty($data->image) && file_exists(public_path('storage/uploads/testimonial/jpg/'.$data->image.'.jpg'))){
                unlink(public_path('storage/uploads/testimonial/jpg/'.$data->image.'.jpg'));
            }

            $data->delete();
        }
        return back()->with('success_msg', 'Data have been removed!');
    }
    public function destroy($removeId)
    {
        $data = Testimonial::find($removeId);
        if(!empty($data->image) && file_exists(public_path('storage/uploads/testimonial/'.$data->image))){
            unlink(public_path('storage/uploads/testimonial/'.$data->image));
        }
        if(!empty($data->image) && file_exists(public_path('storage/uploads/testimonial/'.$data->image.'.webp'))){
            unlink(public_path('storage/uploads/testimonial/'.$data->image.'.webp'));
        }
        if(!empty($data->image) && file_exists(public_path('storage/uploads/testimonial/jpg/'.$data->image.'.jpg'))){
            unlink(public_path('storage/uploads/testimonial/jpg/'.$data->image.'.jpg'));
        }

        $data->delete();
        return back()->with('success_msg', 'Data have been removed!');
    }
}
