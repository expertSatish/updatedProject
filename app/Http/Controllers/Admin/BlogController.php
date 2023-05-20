<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Auth;
use Helper;
use Image;
class BlogController extends Controller{
    
    public function index(){
        $lists = Blog::with('category')->latest()->paginate(20);
        return view('admin.blog.list',compact('lists'));
    }
    public function New(){
        $categories = BlogCategory::where('is_publish',1)->get();
        return view('admin.blog.add',compact('categories'));
    }
    public function Edit($Id){
        $lists = Blog::find($Id);
        $categories = BlogCategory::where('is_publish',1)->get();
        return view('admin.blog.edit',compact('lists','categories'));
    }
    public function Remove($removeId){
        $data = Blog::find($removeId);
        if(!empty($data->image) && file_exists(public_path('storage/uploads/blog/'.$data->image))){
            unlink(public_path('storage/uploads/blog/'.$data->image));
        }
        if(!empty($data->image) && file_exists(public_path('storage/uploads/blog/'.$data->image.'.webp'))){
            unlink(public_path('storage/uploads/blog/'.$data->image.'.webp'));
        }
        if(!empty($data->image) && file_exists(public_path('storage/uploads/blog/jpg/'.$data->image.'.jpg'))){
            unlink(public_path('storage/uploads/blog/jpg/'.$data->image.'.jpg'));
        }
        $data->delete();
        return back()->with('success', 'Data have been remove successfully.');
    }

    public function bulkdestory(Request $request){
        if(empty($request->check)){ return back()->with(['error_msg' => 'Please choose at least one data.']); }
        foreach($request->check as $removeId){
            $data = Blog::find($removeId);
            if(!empty($data->image) && file_exists(public_path('storage/uploads/blog/'.$data->image))){
                unlink(public_path('storage/uploads/blog/'.$data->image));
            }
            if(!empty($data->image) && file_exists(public_path('storage/uploads/blog/'.$data->image.'.webp'))){
                unlink(public_path('storage/uploads/blog/'.$data->image.'.webp'));
            }
            if(!empty($data->image) && file_exists(public_path('storage/uploads/blog/jpg/'.$data->image.'.jpg'))){
                unlink(public_path('storage/uploads/blog/jpg/'.$data->image.'.jpg'));
            }
            $data->delete();
        }
        return back()->with('success', 'Data Removed!');
    }
    public function status(Request $request){
        Blog::where('id',$request->id)->update(['is_publish'=>$request->status]);
        return response()->json([
            'success' => 'Status updated!'
        ]);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence){
            $data = Blog::find($id);
            $data->sequence = $sequence;
            $data->save();
        }
        return back()->with(['success' => 'Sequence updated!']);
    }
    public function Popular($Status,$Id){
        $Data = Blog::find($Id);
        $Data->popular = $Status;
        $Data->save();
        return back()->with('success_msg', 'Popular status have been updated successfully.');
    }
    public function Save(Request $r){

            $validated = $r->validate([
                'title' => 'required|max:255',
                'category' => 'required',
                'post_date' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp|max:2024',
                'banner' => 'required|mimes:jpeg,jpg,png,gif,svg,webp|max:2024',
                'description' => 'required',
                'sort_description' => 'required|max:255'
            ]);

        if(!empty($r->image)){
            $extension =  $r->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/blog/',$r->image);
            }else{
                $FileName = autoheight('uploads/blog/',600,$r->image);
            }
        }

        if(!empty($r->banner)){
            $extension =  $r->banner->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $BannerFileName = directFile('uploads/blog/banner/',$r->banner);
            }else{
                $BannerFileName = autoheight('uploads/blog/banner/',928,$r->banner);
            }
        }

        $Data = new Blog();
        $Data->title = $r->title;
        $Data->category_id = $r->category;
        $Data->image = $FileName;
        $Data->banner = $BannerFileName;
        $Data->post_date = date("Y-m-d",strtotime($r->post_date));
        $Data->description = $r->description;
        $Data->short_description = $r->sort_description;
        $Data->meta_title = $r->meta_title ?? $r->title;
        $Data->meta_keywords = $r->meta_keywords ?? $r->title;
        $Data->meta_description = $r->meta_description ?? $r->title;
        $Data->alias = generatealias('blogs','alias',$r->title);
        $Data->sequence = (Blog::max('sequence') + 1); 
        $Data->save();
        return back()->with('success', 'Data have been saved successfully.');
    }
    public function Update(Request $r){
        $validated = $r->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'post_date' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,svg,webp,mp4|max:2024',
            'banner' => 'mimes:jpeg,jpg,png,gif,svg,webp,mp4|max:2024',
            'description' => 'required',
            'sort_description' => 'required|max:255'
        ]);

        if(!empty($r->image)){
            $extension =  $r->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/blog/',$r->image);
            }else{
                $FileName = autoheight('uploads/blog/',600,$r->image);
            }
        }

        if(!empty($r->banner)){
            $extension =  $r->banner->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $BannerFileName = directFile('uploads/blog/banner/',$r->banner);
            }else{
                $BannerFileName = autoheight('uploads/blog/banner/',928,$r->banner);
            }
        }

        $Data = Blog::find($r->preid);
        $Data->title = $r->title;
        $Data->category_id = $r->category;
        if(!empty($r->image)){ $Data->image = $FileName; }
        if(!empty($r->banner)){ $Data->banner = $BannerFileName; }
        $Data->post_date = date("Y-m-d",strtotime($r->post_date));
        $Data->description = $r->description;
        $Data->short_description = $r->sort_description;
        $Data->meta_title = $r->meta_title;
        $Data->meta_keywords = $r->meta_keywords;
        $Data->meta_description = $r->meta_description;
        if($r->oldtitle!=$r->title){
            $data->alias = generatealias('careers','alias',$r->title);
        }
        $Data->save();
        return back()->with('success', 'Data have been updated successfully.');
    }
}