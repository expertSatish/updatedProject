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

use App\User;

use DB;

use Helper;
use Image;


class ProcessController extends Controller

{

public function __construct(){
        $this->middleware('auth.admin');
    }



    public function index($Id)

    {

        $categories = DB::table('process')->where('service_id', $Id)->orderBy('id', 'desc')->get();
        $nav_heading = DB::table('nav_heading')->where('role', 1)->where('category_id', $Id)->first();
        $category_id = $Id;
        return view('control-panel.service.process.process-management')->with(array('arr_data' => $categories, 'serviceId' => $Id, 'nav_heading' => $nav_heading, 'category_id' => $category_id));
    }





    public function Update($Id)

    {

        $data = DB::table('process')->where('id', $Id)->first();



        return view('control-panel.service.process.update-process')->with(array('data' => $data));
    }





    function Status($Status, $Id)

    {

        if (DB::table('process')->where('id', $Id)->update(['status' => $Status])) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }





    function HomeStatus($Status, $Id){
        if (DB::table('process')->where('id', $Id)->update(['home_status' => $Status])) {
            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }


    function MenuStatus($Status, $Id){

        if (DB::table('process')->where('id', $Id)->update(['menu_status' => $Status])) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }


    function Remove($Id)

    {

        if (DB::table('process')->where('id', $Id)->delete()) {



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

                $path = '/assets/uploads/process/';
                $extension =  $rows->getClientOriginalExtension(); // getting image extension
                $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image
                $imagesource = resource_path($path . $fileName); // upload path
                Image::make($rows->getRealPath())->resize(60, 60)->brightness(1)->save($imagesource);

                DB::table('process')
                    ->insertGetId(array('title' => $fileName, 'type' => $detail[$key], 'alt' => $Alt[$key], 'service_id' => $ServiceId));
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


        if ($image) {
            $path = '/assets/uploads/process/';
            $extension =  $image->getClientOriginalExtension(); // getting image extension
            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image
            $imagesource = resource_path($path . $fileName); // upload path
            Image::make($image->getRealPath())->resize(60, 60)->brightness(1)->save($imagesource);

            DB::table('process')->where('id', $Id)
                ->update([
                    'title' => $fileName,
                ]);
        } else {

            DB::table('process')->where('id', $Id)
                ->update([
                    'type' => $Detail,
                    'alt' => $Alt
                ]);
        }
        return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
    }
    public function nav_heading_save(Request $request)
    {
        $request->validate([
            'title' => 'required',
            // 'tab' => 'required',
        ]);
        if ($request->nav_heading_id == null) {
            DB::table('nav_heading')->insert([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'tab' => $request->tab,
                'description' => $request->description,
                'role' => $request->role,
            ]);
        } else {
            DB::table('nav_heading')->where('nav_heading_id', $request->nav_heading_id)
                ->update([
                    'title' => $request->title,
                    'tab' => $request->tab,
                    'description' => $request->description,
                ]);
        }
        return redirect()->back()->with(['success_msg' => 'Process Done']);
    }
    public function pr_requirement_list_update(Request $request)
    {
        $request->validate([
            'text_1' => 'required',
            'text_2' => 'required',
            'category_id' => 'required'
        ]);

        DB::table('pre_requirement_heading')
            ->where('id', $request->id)
            ->where('category_id', $request->category_id)
            ->update([
                'text_1' => $request->text_1,
                'text_2' => $request->text_2,
            ]);

        return redirect()->back()->with(['success_msg' => 'Detail Update Successfully']);
    }
    public function pr_requirement_list_add(Request $request)
    {
        $request->validate([
            'text_1' => 'required',
            'text_2' => 'required',
        ]);

        DB::table('pre_requirement_heading')
            ->insert([
                'text_1' => $request->text_1,
                'text_2' => $request->text_2,
                'category_id' => $request->category_id,
            ]);

        return redirect()->back()->with(['success_msg' => 'Detail Added Successfully']);
    }
    public function pr_requirement_list_delete(Request $request)
    {
        DB::table('pre_requirement_heading')->where('id', $request->id)->delete();

        return redirect()->back()->with(['success_msg' => 'Detail Deleted Successfully']);
    }
}
