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



class GalleryController extends Controller

{

   
public function __construct(){
        $this->middleware('auth.admin');
    }
	

	public function index()

    {

		$categories = DB::table('gallery')->orderBy('id', 'desc')->get();

        return view('control-panel.gallery.gallery-management')->with(array('arr_data'=>$categories));

    }

	

    public function Update($Id)

    {

		$data = DB::table('gallery')->where('id',$Id)->first();

        

        return view('control-panel.gallery.update-gallery')->with(array('data'=>$data));

    }





    function Status($Status,$Id)

    {

        if(DB::table('gallery')->where('id',$Id)->update(['status'=>$Status]))

        {

                return redirect()->back()->with(array('success_msg'=>Helper::updateMSG()));  

        }

        else

        {

            return redirect()->back()->with(array('error_msg'=>Helper::errorMSG()));  

        }

    }





    function HomeStatus($Status,$Id)

    {

        if(DB::table('gallery')->where('id',$Id)->update(['home_status'=>$Status]))

        {

                return redirect()->back()->with(array('success_msg'=>Helper::updateMSG()));  

        }

        else

        {

            return redirect()->back()->with(array('error_msg'=>Helper::errorMSG()));  

        }

    }





    function Remove($Id)

    {

        if(DB::table('gallery')->where('id',$Id)->delete())

        {

            

                return redirect()->back()->with(array('success_msg'=>Helper::removeMSG()));  

        }

        else

        {

            return redirect()->back()->with(array('error_msg'=>Helper::errorMSG()));  

        }

    }

    





    function Save(Request $r)

    {

        $Type = $r->type;

        $Image = $r->image;

        $Alt = $r->alt;

        $Youtube = $r->youtube;

   

        

    if(empty($Type)) { return redirect()->back()->with(array('error_msg'=>'Please choose at least one.')); }

    foreach($Type as $key => $rows):
      if(!empty($rows)) {
        if($rows=='image'){
            if($Image[$key]==""){ $fileName=""; }
            else{
                    $Path = '/assets/uploads/gallery/';
                    $fileName = Helper::withoutsizeImage($Path,$Image[$key]); 
               }
          }
        else

            {

              $fileName = $Youtube[$key];

            }  


             

              DB::table('gallery')->insertGetId(array('title'=>$fileName,'type'=>$Type[$key],'alt'=>$Alt[$key]));

             

          }



        endforeach;



      

        

          return redirect()->back()->with(array('success_msg'=>Helper::saveMSG()));  

           



    }





    

    function Edit(Request $r)

    {

        $Id = $r->Id;

        $Type = $r->type;

        $Alt = $r->alt;

        $Youtube = $r->youtube;

        $image = $r->eimage;

        $preimage = $r->preimage;



    if($Type=='image'){    



         if($image=="")

                {

                        $fileName=$preimage;

                }

                else

                {

                  $Path = '/assets/uploads/gallery/';

                  $fileName = Helper::withoutsizeImage($Path,$image);   

                } 



    }

    else

    {

        $fileName = $Youtube;

    }



        if(DB::table('gallery')->where('id',$Id)->update(['title'=>$fileName,'type'=>$Type,'alt'=>$Alt]))

        {

                return redirect()->back()->with(array('success_msg'=>Helper::updateMSG()));  

        }

        else

        {

            return redirect()->back()->with(array('error_msg'=>Helper::errorMSG()));  

        }





    }



	

}

