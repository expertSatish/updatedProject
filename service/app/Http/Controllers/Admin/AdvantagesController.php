<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Newsletter;

use App\Appointment;

use App\Enquiry;

use App\Review;

use App\ContactUsEnquiry;

use App\SocialUrl;

use App\Department;

use App\Speciality;

use App\DepartmentSpeciality;
use App\Helpers\Helper as HelpersHelper;
use App\User;

use Illuminate\Support\Facades\DB;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB as FacadesDB;

class AdvantagesController extends Controller

{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    public function index($Id)
    {
        $categories = DB::table('advantages')->where('service_id', $Id)->orderBy('id', 'desc')->get();
        $nav_heading = DB::table('nav_heading')->where('role', 2)->where('category_id', $Id)->first();
        $category_id = $Id;
        return view('control-panel.service.advantages.advantages-management')->with(array('arr_data' => $categories, 'serviceId' => $Id, 'nav_heading' => $nav_heading, 'category_id' => $category_id));
    }

    public function Update($Id)
    {
        $data = DB::table('advantages')->where('id', $Id)->first();
        return view('control-panel.service.advantages.update-advantages')->with(array('data' => $data));
    }

    function Status($Status, $Id)
    {
        if (DB::table('advantages')->where('id', $Id)->update(['status' => $Status])) {
            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }

    function HomeStatus($Status, $Id)
    {
        if (DB::table('advantages')->where('id', $Id)->update(['home_status' => $Status])) {
            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }

    function Remove($Id)
    {
        if (DB::table('advantages')->where('id', $Id)->delete()) {
            return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }

    function Save(Request $r)

    {
        $Image = $r->image;
        $Alt = $r->alt;
        $detail = $r->detail;
        $ServiceId = $r->ServiceId;
        if (empty($Image)) {
            return redirect()->back()->with(array('error_msg' => 'Please choose at least one.'));
        }
        foreach ($Image as $key => $rows) :
            if (!empty($rows)) {

                if ($Image[$key] == "") {

                    $fileName = "";
                } else {

                    $Path = '/assets/uploads/service-gallery/';

                    $width = 60;
                    $height = 60;

                    $fileName = Helper::sizeImage($Path, $width, $height, $Image[$key]);
                }



                DB::table('advantages')->insertGetId(array('title' => $fileName, 'type' => $detail[$key], 'alt' => $Alt[$key], 'service_id' => $ServiceId));
            }



        endforeach;







        return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
    }







    function Edit(Request $r)

    {

        $Id = $r->Id;

        $Type = $r->type;

        $Alt = $r->alt;

        $Detail = $r->detail;

        $image = $r->eimage;

        $preimage = $r->preimage;




        if ($image == "") {

            $fileName = $preimage;
        } else {

            $Path = '/assets/uploads/service-gallery/';
            $width = 60;
            $height = 60;
            $fileName = Helper::sizeImage($Path, $width, $height, $image);
        }



        if (DB::table('advantages')->where('id', $Id)->update(['title' => $fileName, 'type' => $Detail, 'alt' => $Alt])) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }
}
