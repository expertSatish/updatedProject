<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Notifications\Notification;



use Helper;



use Validator;



use Image;



use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;





class CMSController extends Controller

{

    public function __construct()

    {

        $this->middleware('auth.admin');
    }









    function Contact_Us()

    {

        $Query = DB::table('contacts')->get();



        return view('control-panel.update-contact')->with(['flag' => true, 'array_data' => $Query]);
    }





    function Corporate_Management()

    {

        $Query = DB::table('cms_pages')->whereIn('id', array(19, 20, 21, 22, 23))->get();



        return view('control-panel.corporate-management')->with(['arr_data' => $Query, 'Type' => '']);
    }





    function Our_Business()

    {

        $Query = DB::table('cms_pages')->whereIn('id', array(33, 34, 35, 36))->get();



        return view('control-panel.our-business')->with(['arr_data' => $Query]);
    }





    function Career()

    {

        $Query = DB::table('cms_pages')->whereIn('id', array(37))->get();



        return view('control-panel.career')->with(['arr_data' => $Query]);
    }





    function About_Management()

    {

        $Query = DB::table('cms_pages')->whereIn('id', array(24, 26, 27))->get();



        return view('control-panel.about-management')->with(['arr_data' => $Query, 'Type' => '']);
    }





    function Why_ICT_Status($Status, $Id)

    {

        if (DB::table('cms_pages')->where('id', $Id)->update(['status' => $Status])) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }







    function Update_CMS($Id)

    {



        $Query = DB::table('cms_pages')->where('id', $Id)->first();



        return view('control-panel.update-cms')->with(['flag' => true, 'array_data' => $Query]);
    }





    function Edit_CMS(Request $r, $Id)

    {

        $Text1 = $r->text_1;

        $Text2 = $r->text_2;

        $Text3 = $r->text_3;

        $Text4 = $r->text_4;

        $Text5 = $r->text_5;

        $Text6 = $r->text_6;



        $name = $r->name;



        $description = $r->description;

        $Shortdescription = $r->short_description;



        $image = $r->image;

        $preimage = $r->preimage;

        $imageAlt = $r->image_alt;



        if (empty($image)) {

            $fileName = $preimage;
        } else {

            $extension =  $image->getClientOriginalExtension(); // getting image extension

            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

            $imagesource = resource_path('/assets/uploads/cms/' . $fileName); // upload path 



            if ($Id == 19) {

                Image::make($image->getRealPath())->resize(585, 390)->brightness(1)->save($imagesource);
            } elseif ($Id == 37 || $Id == 34) {

                Image::make($image->getRealPath())->resize(600, 450)->brightness(1)->save($imagesource);
            } elseif ($Id == 30) {

                Image::make($image->getRealPath())->resize(860, 650)->brightness(1)->save($imagesource);
            } elseif ($Id == 21 || $Id == 20 || $Id == 22) {

                Image::make($image->getRealPath())->resize(580, 450)->brightness(1)->save($imagesource);
            } elseif ($Id == 56 || $Id == 57 || $Id == 58) {

                Image::make($image->getRealPath())->resize(100, 100)->brightness(1)->save($imagesource);
            } elseif ($Id == 24) {

                Image::make($image->getRealPath())->resize(450, 390)->brightness(1)->save($imagesource);
            } else {



                Image::make($image->getRealPath())->resize(1920, 300)->brightness(1)->save($imagesource);
            }
        }







        $Data = array(

            'title' => $name,

            'text_1' => $Text1,

            'text_2' => $Text2,

            'text_3' => $Text3,

            'text_4' => $Text4,

            'text_5' => $Text5,

            'text_6' => $Text6,

            'description' => $description,

            'short_description' => $Shortdescription,

            'image' => $fileName,

            'image_alt' => $imageAlt,

        );



        DB::table('cms_pages')->where('id', $Id)->update($Data);



        return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
    }









    function Save_Contact_Us(Request $r)

    {

        $Id = $r->Id;

        $name  = $r->name;

        $description  = $r->description;

        $image  = $r->image;

        $preimage  = $r->preimage;





        foreach ($Id as $Key => $Ro) :



            if (empty($image[$Key])) {

                $fileName = $preimage[$Key];
            } else {

                $extension =  $image[$Key]->getClientOriginalExtension(); // getting image extension

                $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

                $imagesource = resource_path('/assets/uploads/contact/' . $fileName); // upload path 

                Image::make($image[$Key]->getRealPath())->resize(30, 30)->brightness(1)->save($imagesource);
            }





            DB::table('contacts')->where('id', $Ro)->update(['title' => $name[$Key], 'description' => $description[$Key], 'image' => $fileName]);







        endforeach;



        return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
    }









    /**************************** OUR PARTNERS ******************************/





    function Our_Partners()

    {

        return view('control-panel.our-partners');
    }







    function Save_Our_Partners(Request $r)

    {



        $Title = $r->title;

        $Country = $r->country;









        if (count($Title) == 0) {



            return redirect()->back()->with(array('error_msg' => 'Please enter at leat one data.'));
        }



        foreach ($Title as $Key => $Ro) :





            if (!empty($Title[$Key])) :



                DB::table('our_partners')->insert(['title' => $Title[$Key], 'country' => $Country[$Key]]);



            endif;



        endforeach;



        return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
    }







    function Edit_Our_Partners(Request $r)

    {



        $Id = $r->Id;

        $Title = $r->title;

        $Country = $r->country;





        if (DB::table('our_partners')->where('id', $Id)->update(['title' => $Title, 'country' => $Country])) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }









    function Remove_Our_Partners($Id)

    {



        if (DB::table('our_partners')->where('id', $Id)->delete()) {

            return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }





    function Our_Partners_Status($Status, $Id)

    {



        if (DB::table('our_partners')->where('id', $Id)->update(['status' => $Status])) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }
}
