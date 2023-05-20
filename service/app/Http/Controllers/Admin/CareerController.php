<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CareerController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    public function career_enquiry_list(Request $request)
    {
        $enquiry = DB::table('career_enquiry')->latest()->get();
        return view('control-panel.career.list', compact('enquiry'));
    }

    public function career_enquiry_remove(Request $request)
    {
        DB::table('career_enquiry')->where('career_enquiry_id', $request->id)->delete();
        return redirect('/control-panel/career-enquiry-list')->with(['success_msg' => 'Enquiry Deleted Successfully']);
    }
}
