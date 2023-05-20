<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\Blog;
use Auth;
use Helper;
use Image;

class BlogCategoryController extends Controller{

    public function index(){
        $lists = BlogCategory::latest()->paginate(20);
        return view('admin.blog.blog-category.list',compact('lists'));
    }
    public function New(){
        return view('admin.blog.blog-category.add');
    }
    public function Edit($Id){
        $lists = BlogCategory::find($Id);
        return view('admin.blog.blog-category.edit',compact('lists'));
    }
    public function Remove($removeId){
        $check = Blog::where('category_id',$removeId)->count();
        if($check>0){
            return back()->with('error', 'blogs are mapped in this category.');
        }
        $Data = BlogCategory::find($removeId)->delete();
        return back()->with('success', 'Data have been remove successfully.');
    }

    public function status(Request $request){
        BlogCategory::where('id',$request->id)->update(['is_publish'=>$request->status]);
        return response()->json([
            'success' => 'Status updated!'
        ]);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence){
            $data = BlogCategory::find($id);
            $data->sequence = $sequence;
            $data->save();
        }
        return back()->with(['success' => 'Sequence updated!']);
    }

    public function Save(Request $r){
        $validated = $r->validate([
            'category_name' => 'required|unique:blog_categories,title',
        ]);
        $Data = new BlogCategory();
        $Data->title = $r->category_name;
        $Data->alias = generatealias('blog_categories','alias',$r->category_name);
        $Data->meta_title = $r->meta_title ?? $r->category_name;
        $Data->meta_keywords = $r->meta_keywords ?? $r->category_name;
        $Data->meta_description = $r->meta_description ?? $r->category_name;
        $Data->sequence = (BlogCategory::max('sequence') + 1); 
        $Data->save();
        return back()->with('success', 'Data have been saved successfully.');
    }
    
    public function Update(Request $r){
        $validated = $r->validate([
            'category_name' => 'required',
            'alias' => 'required',
        ]);

        $Data = BlogCategory::find($r->preId);
        $Data->title = $r->category_name;
        $Data->alias = $r->alias;
        $Data->meta_title = $r->meta_title;
        $Data->meta_keywords = $r->meta_keywords;
        $Data->meta_description = $r->meta_description;
        $Data->save();
        return back()->with('success', 'Data have been updated successfully.');
    }

}

