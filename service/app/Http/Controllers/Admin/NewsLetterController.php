<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsLetterController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    public function newsletter_save(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        DB::table('newsletters')->insert([
            'email' => $request->email,
        ]);
        return redirect()->back()->with(['success_msg' => Helper::SubScriptionMSG()]);
    }

    public function newsletter_list(Request $request)
    {
        $newsletter = DB::table('newsletters')->latest()->get();
        return view('control-panel.newsletter.list', compact('newsletter'));
    }

    public function newsletter_delete(Request $request)
    {
        DB::table('newsletters')->where('id', $request->id)->delete();
        return redirect('/control-panel/newsletter-list')->with(['success_msg' => Helper::removeMSG()]);
    }
}
