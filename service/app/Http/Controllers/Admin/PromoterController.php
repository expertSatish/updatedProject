<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Promoter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class PromoterController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    public function promoter_add(Request $request)
    {
        return view('control-panel.promoters.add');
    }

    public function promoter_save(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'description' => 'required',
            'image_url' => 'required',
        ]);
        if ($request->image_url) {
            $image = $request->file('image_url');
            $path = '/assets/uploads/promoters/';
            $extension =  $image->getClientOriginalExtension(); // getting image extension
            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image
            $imagesource = resource_path($path . $fileName); // upload path
            Image::make($image->getRealPath())->resize(80, 80)->brightness(1)->save($imagesource);
            $db = $fileName;

            // $file = $request->file('image_url');
            // $destinationPath = 'resources/assets/uploads/promoters/';
            // $originalFile = $file->getClientOriginalName();
            // $filename = strtotime(date('Y-m-d-H:isa')) . $originalFile;
            // $file->move($destinationPath, $filename);
            // $db = $filename;
        } else {
            $db = null;
        }

        Promoter::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,
            'image_url' => $db,
            'facebook_url' => $request->facebook_url,
            'instagram_url' => $request->instagram_url,
            'twitter_url' => $request->twitter_url,
            'youtube_url' => $request->youtube_url,
            'linkedin_url' => $request->linkedin_url,
        ]);
        return redirect('/control-panel/promoter-list')->with(['success_msg' => 'Promoter Added Successfully']);
    }

    public function promoter_list(Request $request)
    {
        $promoters = Promoter::all();
        return view('control-panel.promoters.list', compact('promoters'));
    }

    public function promoter_status(Request $request)
    {
        $promoter = Promoter::where('promoter_id', $request->id)->first();
        $status = $promoter->status;
        if ($status == 0) {
            Promoter::where('promoter_id', $request->id)
                ->update([
                    'status' => 1
                ]);
        } else {
            Promoter::where('promoter_id', $request->id)
                ->update([
                    'status' => 0
                ]);
        }
        return redirect('/control-panel/promoter-list')->with(['success_msg' => 'Promoter Status Change']);
    }

    public function promoter_edit(Request $request)
    {
        $promoter = Promoter::where('promoter_id', $request->id)->first();
        return view('control-panel.promoters.edit', compact('promoter'));
    }

    public function promoter_update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'description' => 'required',
        ]);
        if ($request->image_url) {
            $image = $request->file('image_url');
            $path = '/assets/uploads/promoters/';
            $extension =  $image->getClientOriginalExtension(); // getting image extension
            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image
            $imagesource = resource_path($path . $fileName); // upload path
            Image::make($image->getRealPath())->resize(80, 80)->brightness(1)->save($imagesource);
            $db = $fileName;
            Promoter::where('promoter_id', $request->id)
                ->update([
                    'image_url' => $db,
                ]);


            // $file = $request->file('image_url');
            // $destinationPath = 'resources/assets/uploads/promoters/';
            // $originalFile = $file->getClientOriginalName();
            // $filename = strtotime(date('Y-m-d-H:isa')) . $originalFile;
            // $file->move($destinationPath, $filename);
            // $db = $filename;
            // Promoter::where('promoter_id', $request->id)
            //     ->update([
            //         'image_url' => $db,
            //     ]);
        }

        Promoter::where('promoter_id', $request->id)
            ->update([
                'name' => $request->name,
                'designation' => $request->designation,
                'description' => $request->description,
                'facebook_url' => $request->facebook_url,
                'instagram_url' => $request->instagram_url,
                'twitter_url' => $request->twitter_url,
                'youtube_url' => $request->youtube_url,
                'linkedin_url' => $request->linkedin_url,
            ]);

        return redirect('/control-panel/promoter-list')->with(['success_msg' => 'Promoter Updated Successfully']);
    }

    public function promoter_delete(Request $request)
    {
        Promoter::where('promoter_id', $request->id)->delete();
        return redirect('/control-panel/promoter-list')->with(['success_msg' => 'Promoter Deleted Successfully']);
    }
}
