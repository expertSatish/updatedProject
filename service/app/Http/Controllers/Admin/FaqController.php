<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Helper;

use DB;



class FaqController extends Controller

{



    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    function index($category_id)
    {

        $getdata = DB::table('faq')->where('category_id', $category_id)->orderby('id', 'DESC')->get();
        $nav_heading = DB::table('nav_heading')->where('role', 7)->where('category_id', $category_id)->first();
        $category_id = $category_id;

        return view('control-panel.faq.faq-management')->with(array('getData' => $getdata, 'nav_heading' => $nav_heading, 'category_id' => $category_id));
    }


    function New($category_id)

    {
        return view('control-panel.faq.add-faq')->with(array('flag' => false));
    }


    function Update($Id)

    {

        $getdata = DB::table('faq')->where('id', $Id)->first();

        return view('control-panel.faq.add-faq')->with(array('flag' => true, 'array_data' => $getdata));
    }



    function Save(Request $r)

    {



        $Currency = $r->Currency;

        $Details = $r->Details;

        $categoryId = $r->categoryId;



        if (empty($Currency)) {

            return redirect()->back()->with(array('error_msg' => 'Please choose atleast one data.'));
        }



        foreach ($Currency as $Key => $Row) :



            $Curr = '';

            $Dtl = '';





            if (!empty($Currency[$Key])) {
                $Curr = $Currency[$Key];
            }

            if (!empty($Details[$Key])) {
                $Dtl = $Details[$Key];
            }



            DB::table('faq')->insert(['title' => $Curr, 'text' => $Dtl, 'category_id' => $categoryId]);



        endforeach;









        return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
    }





    function Edit(Request $r, $Id)

    {



        $Currency = $r->Currency;

        $Details = $r->Details;





        if (empty($Currency)) {

            return redirect()->back()->with(array('error_msg' => 'Please choose atleast one data.'));
        }



        foreach ($Currency as $Key => $Row) :



            $Curr = '';

            $Dtl = '';





            if (!empty($Currency[$Key])) {
                $Curr = $Currency[$Key];
            }

            if (!empty($Details[$Key])) {
                $Dtl = $Details[$Key];
            }



            DB::table('faq')->where('id', $Id)->update(['title' => $Curr, 'text' => $Dtl]);



        endforeach;









        return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
    }



    function Remove(Request $r)

    {



        $Check = $r->check;



        foreach ($Check as $Rows) :



            DB::table('faq')->where('id', $Rows)->delete();



        endforeach;



        return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
    }



    function Status($Status, $Id)

    {



        if (DB::table('faq')->where('id', $Id)->update(['status' => $Status])) {



            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {



            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }
}
