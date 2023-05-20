<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Helper;
use Validator;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EnquiryController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }

    function Contact_Enquuiry(){
        $Query = DB::table('contact_enquiry')->where('page', NULL)->orderby('id', 'DESC')->get();
        return view('control-panel.enquiry.contact-enquiry')->with(['arr_data' => $Query]);
    }

    function Footer_Enquuiry(){
        $Query = DB::table('contact_enquiry')->where('page', 'Footer Section')->orderby('id', 'DESC')->get();
        return view('control-panel.enquiry.contact-enquiry')->with(['arr_data' => $Query]);
    }

    function Project_Enquuiry(){
        $Query = DB::table('contact_enquiry')->where('page', 'Project Section')->orderby('id', 'DESC')->get();
        return view('control-panel.enquiry.contact-enquiry')->with(['arr_data' => $Query]);
    }

    function Remove_Contact_Enquuiry($Id){
        if (DB::table('contact_enquiry')->where('id', $Id)->delete()) {
            return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }
}
