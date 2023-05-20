<?php

namespace App\Http\Controllers\Admin;

use App\ConsultancyModel;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultancyController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    public function form_save(Request $request)
    {
        $request->validate([
            'enquiry_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|min:10|max:10',
            // 'message' => 'required',
        ]);
        ConsultancyModel::create([
            'name' => $request->enquiry_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);
        return redirect('/thank-you')->with(['success_msg' => Helper::InstantEnquiryMSG()]);
    }

    public function consultancy_enquiry_list(Request $request)
    {
        $enquiry = ConsultancyModel::latest()->get();
        return view('control-panel.consultancy-enquiry.list', compact('enquiry'));
    }
    public function consultancy_enquiry_delete(Request $request)
    {
        ConsultancyModel::where('consultancy_enquiry_id', $request->id)->delete();

        return redirect('/control-panel/consultancy-enquiry-list')->with(['success_msg' => Helper::removeMSG()]);
    }
}
