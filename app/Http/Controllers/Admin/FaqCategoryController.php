<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function index($parent=null){
        $lists = \App\Models\FaqCategory::where('parent',$parent ?? 0);
        $lists = $lists->latest()->paginate(20);
        $parentdata = \App\Models\FaqCategory::find($parent);
        return view('admin.faq.category.list',compact('lists','parent','parentdata'));
    }
    public function New($parent=null){
        return view('admin.faq.category.add',compact('parent'));    
    }
    public function Edit($Id){
        $parentdata = \App\Models\FaqCategory::find($Id);
        if(empty($parentdata )){ abort(404); }
        return view('admin.faq.category.edit',compact('parentdata'));    
    }
    public function Save(Request $r){
        $validated = $r->validate([
            'title' => 'required|unique:faq_categories,title',
        ]); 
        if(!empty($r->image)){
            $extension =  $r->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/faq/',$r->image);
            }else{
                $FileName = autoheight('uploads/faq/',60,$r->image);
            }
        }
        $data = new \App\Models\FaqCategory();
        $data->title = $r->title;
        $data->alias = generatealias('faq_categories','alias',$r->title);
        $data->sequence = (\App\Models\FaqCategory::where('parent',$r->parent ?? 0)->max('sequence') + 1); 
        $data->parent = $r->parent ?? 0;
        if(!empty($r->image)){ $data->image = $FileName; } 
        $data->meta_title = $r->meta_title ?? $r->title;
        $data->meta_keywords = $r->meta_keywords ?? $r->title;
        $data->meta_description = $r->meta_description ?? $r->title;
        $data->save();
        return back()->with('success', 'Data have been saved successfully.');
    }
    public function Update(Request $r){
        $validated = $r->validate([
            'title' => 'required|unique:faq_categories,title,'.$r->preid,
        ]); 
        if(!empty($r->image)){
            $extension =  $r->image->getClientOriginalExtension();
            if(strtoupper($extension)=='SVG' || strtoupper($extension)=='WEBP' || strtoupper($extension)=='AVIF'){
                $FileName = directFile('uploads/faq/',$r->image);
            }else{
                $FileName = autoheight('uploads/faq/',60,$r->image);
            }
        }
        $data = \App\Models\FaqCategory::find($r->preid);
        $data->title = $r->title;
        if($r->title!=$r->oldtitle){ $data->alias = generatealias('faq_categories','alias',$r->title); }        
        if(!empty($r->image)){ $data->image = $FileName; } 
        $data->meta_title = $r->meta_title ?? $r->title;
        $data->meta_keywords = $r->meta_keywords ?? $r->title;
        $data->meta_description = $r->meta_description ?? $r->title;
        $data->save();
        return back()->with('success', 'Data have been updated!');
    }
    public function Remove($removeId){
        $check = \App\Models\FaqCategory::where('parent',$removeId)->count();
        if($check>0){
            return back()->with('error', 'child categories are available in this category');
        }
        $checkfaq = \App\Models\Faq::where('category_id',$removeId)->count();
        if($checkfaq>0){
            return back()->with('error', 'faqs are available in this category.');
        }
        $Data = \App\Models\FaqCategory::find($removeId);
        if(!empty($Data->image) && file_exists(public_path('storage/uploads/faq/'.$Data->image))){
            unlink(public_path('storage/uploads/faq/'.$Data->image));
        }
        if(!empty($Data->image) && file_exists(public_path('storage/uploads/faq/'.$Data->image.'.webp'))){
            unlink(public_path('storage/uploads/faq/'.$Data->image.'.webp'));
        }
        if(!empty($Data->image) && file_exists(public_path('storage/uploads/faq/jpg/'.$Data->image.'.jpg'))){
            unlink(public_path('storage/uploads/faq/jpg/'.$Data->image.'.jpg'));
        }
        $Data = $Data->delete();
        return back()->with('success', 'Data have been remove successfully.');
    }
    public function bulkdestory(Request $request){
        if(empty($request->check)){ return back()->with(['error' => 'Please choose at least one data.']); }
        foreach($request->check as $removeId){
            $data = \App\Models\FaqCategory::find($removeId);
            $check = \App\Models\FaqCategory::where('parent',$removeId)->count();
            $checkfaq = \App\Models\Faq::where('category_id',$removeId)->count();
            if($check==0 && $checkfaq==0){
                if(!empty($data->image) && file_exists(public_path('storage/uploads/faq/'.$data->image))){
                    unlink(public_path('storage/uploads/faq/'.$data->image));
                }
                if(!empty($data->image) && file_exists(public_path('storage/uploads/faq/'.$data->image.'.webp'))){
                    unlink(public_path('storage/uploads/faq/'.$data->image.'.webp'));
                }
                if(!empty($data->image) && file_exists(public_path('storage/uploads/faq/jpg/'.$data->image.'.jpg'))){
                    unlink(public_path('storage/uploads/faq/jpg/'.$data->image.'.jpg'));
                }
                $data->delete();
            }
        }
        return back()->with('success', 'Data Removed!');
    }
    public function status(Request $request){
        \App\Models\FaqCategory::where('id',$request->id)->update(['is_publish'=>$request->status]);
        return response()->json([
            'success' => 'Status updated!'
        ]);
    }
    public function sequence(Request $request){
        foreach($request->sequence as $id => $sequence){
            $data = \App\Models\FaqCategory::find($id);
            $data->sequence = $sequence;
            $data->save();
        }
        return back()->with(['success' => 'Sequence updated!']);
    }
}
