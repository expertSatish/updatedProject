<?php

namespace App\Http\Controllers\Admin;

use App\Heading;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeadingController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    public function heading_list(Request $request)
    {
        $headings = Heading::where('page', 'homepage')->where('service_id', 0)->get();
        return view('control-panel.headings.list', compact('headings'));
    }

    // public function heading_status(Request $request)
    // {
    //     $heading = Heading::where('heading_id', $request->id)->first();
    //     $status = $heading->status;
    //     if ($status == 0) {
    //         Heading::where('heading_id', $request->id)
    //             ->update([
    //                 'status' => 1
    //             ]);
    //     } else {
    //         Heading::where('heading_id', $request->id)
    //             ->update([
    //                 'status' => 0
    //             ]);
    //     }
    //     return redirect('/control-panel/heading-list')->with(['success_msg' => 'Heading Status Change']);
    // }

    public function heading_edit(Request $request)
    {
        $heading = Heading::where('heading_id', $request->id)->first();
        return view('control-panel.headings.edit', compact('heading'));
    }

    public function heading_update(Request $request)
    {
        Heading::where('heading_id', $request->id)
            ->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        return redirect()->back()->with(['success_msg' => 'Heading Updated Successfully']);
    }
}
