<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    public function social_list(Request $request)
    {
        $social_media = SocialMedia::all();
        return view('control-panel.socialmedia.list', compact('social_media'));
    }
    public function social_edit(Request $request)
    {
        $social = SocialMedia::where('id', $request->id)->first();
        return view('control-panel.socialmedia.edit', compact('social'));
    }
    public function social_status(Request $request)
    {
        $social_media = SocialMedia::where('id', $request->id)
            ->first();
        $status = $social_media->status;
        if ($status == 0) {
            SocialMedia::where('id', $request->id)
                ->update([
                    'status' => 1
                ]);
        } else {
            SocialMedia::where('id', $request->id)
                ->update([
                    'status' => 0
                ]);
        }
        return redirect()->back()->with('success_msg', 'Social Status Change');
    }

    public function social_update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'icon' => 'required|max:255',
            'link' => 'required|url|max:255',
        ]);

        SocialMedia::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'icon' => $request->icon,
                'link' => $request->link,
            ]);

        return redirect()->back()->with('success_msg', 'Social Icon Update Successfully');
    }
}
