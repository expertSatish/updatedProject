<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Testimonial;

use Helper;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller

{



    public function __construct()

    {

        $this->middleware('auth.admin');
    }





    function index()

    {

        $getdata = Testimonial::orderBy('id','DESC')->get();



        return view('control-panel.team.team-management')->with(array('getData' => $getdata));
    }





    function New()

    {

        return view('control-panel.team.add-team')->with(array('flag' => false));
    }





    function Update($BannerId)

    {

        $getdata = Testimonial::find($BannerId);

        return view('control-panel.team.add-team')->with(array('flag' => true, 'array_data' => $getdata));
    }



    function Save(Request $r)

    {

        $Data = new Testimonial();



        $Image = $r->Image;



        if (empty($Image)) {

            $filename = $r->PreImage;
        } else {

            $filename = Helper::sizeImage('/assets/uploads/testimonials/', 250, 290, $Image);
        }


        $Data->designation = $r->Designation;

        $Data->title = $r->Title;

        $Data->content = $r->Description;

        $Data->image = $filename;

        $Data->company_name = $r->company;

        if ($Data->save()) {

            return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }


    function Edit(Request $r, $Id)
    {

        $Data = Testimonial::find($Id);

        $Image = $r->Image;



        if (empty($Image)) {

            $filename = $r->PreImage;
        } else {

            $filename = Helper::sizeImage('/assets/uploads/testimonials/', 250, 290, $Image);
        }





        $Data->designation = $r->Designation;

        $Data->title = $r->Title;

        $Data->content = $r->Description;

        $Data->image = $filename;

        $Data->company_name = $r->company;





        if ($Data->save()) {



            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {



            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }



    function Remove(Request $r)

    {



        $Check = $r->check;



        foreach ($Check as $Rows) :



            $Data = Testimonial::find($Rows);

            $Data->delete();



        endforeach;



        return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
    }



    function Status($Status, $Id)

    {



        $Data = Testimonial::find($Id);



        $Data->status = $Status;



        if ($Data->save()) {



            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {



            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }
    public function slider_status(Request $request)
    {
        $slider = DB::table('testimonial')->where('Id', $request->id)->first();
        $status = $slider->slider_status;
        if ($status == 0) {
            DB::table('testimonial')->where('Id', $request->id)
                ->update([
                    'slider_status' => 1
                ]);
        } else {
            DB::table('testimonial')->where('Id', $request->id)
                ->update([
                    'slider_status' => 0
                ]);
        }
        return redirect()->back()->with('success_msg', 'Slider Status Change');
    }
}
