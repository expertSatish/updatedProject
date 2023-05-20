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
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    public function index($Id = null)
    {
        if (empty($Id)) {
            $categories = DB::table('nav_category')->where('level', 1)->orderBy('id', 'DESC')->get();
        } else {
            $categories = DB::table('nav_category')->where('parent', $Id)->orderBy('id', 'DESC')->get();
        }
        return view('control-panel.service.service-management')->with(array('arr_data' => $categories, 'serviceId' => $Id));
    }

    public function Update($Id)
    {
        $data = DB::table('nav_category')->where('id', $Id)->first();
        return view('control-panel.service.update-service')->with(array('data' => $data));
    }

    public function Banner($Id)
    {
        $data = DB::table('nav_category')->where('id', $Id)->first();
        return view('control-panel.service.update-banner')->with(array('data' => $data));
    }

    function Status($Status, $Id)

    {
        if (DB::table('nav_category')->where('id', $Id)->update(['status' => $Status])) {
            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }

    function Remove($Id)

    {

        if (DB::table('nav_category')->where('id', $Id)->delete()) {

            return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }




    function Save(Request $r)
    {
        $Parent = $r->parentId;

        $Type = $r->alt;

        $meta_title = $r->title;
        $meta_keywords = $r->keywords;
        $meta_description = $r->description;


        $Level = DB::table('nav_category')->where('id', $Parent)->first();


        $NewLevel = $Level->level + 1;

        if (empty($Type)) {
            return redirect()->back()->with(array('error_msg' => 'Please enter one category name.'));
        }

        foreach ($Type as $key => $value) {
            if (!empty($value)) {
                $Alias = Helper::NewAlias('nav_category', 'title', $value);
                DB::table('nav_category')
                    ->insert([
                        'alias' => $Alias,
                        'title' => $value,
                        'parent' => $Parent,
                        'level' => $NewLevel,
                        'meta_title' => $meta_title[$key],
                        'meta_keywords' => $meta_keywords[$key],
                        'meta_description' => $meta_description[$key],
                    ]);
            }
        }

        return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
    }




    function Edit(Request $request)

    {
        if ($request->old_alias == $request->alias) {
            DB::table('nav_category')
                ->where('id', $request->Id)
                ->update([
                    'title' => $request->title,
                    'meta_title' => $request->meta_title,
                    'meta_keywords' => $request->meta_keywords,
                    'meta_description' => $request->meta_description,
                ]);
            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {
            $is_exist = DB::table('nav_category')
                ->where('alias', $request->alias)
                ->get();
            if (count($is_exist) == 0) {
                DB::table('nav_category')
                    ->where('id', $request->Id)
                    ->update([
                        'alias' => $request->alias
                    ]);
                return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
            } else {
                return redirect()->back()->with(array('error_msg' => 'Alias already exist'));
            }
        }
    }

    function Edit_Banner(Request $request)
    {
        $id = $request->id;
        $title = $request->banner_title;
        $text = $request->banner_text;
        $text2 = $request->banner_text2;
        $text3 = $request->banner_text3;
        $url = $request->url;
        $about = $request->about;
        $BannerImage = $request->banner_image;
        if ($BannerImage) {
            $FileName = Helper::sizeImage('assets/uploads/banner/', 1600, 475, $BannerImage);
            
            DB::table('nav_category')->where('id', $id)->update([
                'banner_image' => $FileName,
            ]);
        }
        $list = $request->list;
        $listId =     $request->listId;
        DB::table('nav_category')->where('id', $id)->update([
            'banner_title' => $title,
            'banner_text' => $text,
            'banner_text2' => $text2,
            'banner_text3' => $text3,
            'about' => $about,
            'url' => $url,
        ]);
        if (!empty($list)) {
            foreach ($list as $key => $value) {
                if (!empty($value)) {
                    if (!empty($listId[$key])) {
                        DB::table('banner_list')->where('id', $listId[$key])->update(['title' => $value]);
                    } else {
                        DB::table('banner_list')->insert(['title' => $value, 'category_id' => $id]);
                    }
                }
            }
        }

        return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
    }




    function Remove_Lists($Id)
    {
        if (DB::table('banner_list')->where('id', $Id)->delete()) {
            return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }

    public function home_status(Request $request)
    {
        $home = DB::table('nav_category')
            ->where('id', $request->id)
            ->first();
        $category_type = $home->category_type;
        $status = $home->home_status;
        if ($status == 1) {
            DB::table('nav_category')
                ->where('id', $request->id)
                ->update([
                    'home_status' => 0
                ]);
            return redirect()->back()->with('success_msg', 'Home Status Change');
        } else {
            if ($category_type == 1) {
                DB::table('nav_category')
                    ->where('id', $request->id)
                    ->update([
                        'home_status' => 1
                    ]);
                return redirect()->back()->with('success_msg', 'Home Status Change');
            } else {
                return redirect()->back()->with('error_msg', 'You have not right to access this features');
            }
        }
    }
    
    public function menu_status(Request $request)
    {
        $home = DB::table('nav_category')
            ->where('id', $request->id)
            ->first();
        $category_type = $home->category_type;
        $status = $home->menu_status;
        if ($status == 1) {
            DB::table('nav_category')
                ->where('id', $request->id)
                ->update([
                    'menu_status' => 0
                ]);
            return redirect()->back()->with('success_msg', 'Status Change');
        } else {
            if ($category_type == 1) {
                DB::table('nav_category')
                    ->where('id', $request->id)
                    ->update([
                        'menu_status' => 1
                    ]);
                return redirect()->back()->with('success_msg', 'Status Change');
            } else {
                return redirect()->back()->with('error_msg', 'You have not right to access this features');
            }
        }
    }
    
    public function footer_status(Request $request)
    {
        $category = DB::table('nav_category')
            ->where('footer_status', 1)
            ->count();

        $footer = DB::table('nav_category')
            ->where('id', $request->id)
            ->first();
        $category_type = $footer->category_type;
        $footer_status = $footer->footer_status;
        if ($footer_status == 1) {
            DB::table('nav_category')
                ->where('id', $request->id)
                ->update([
                    'footer_status' => 0
                ]);
            return redirect()->back()->with('success_msg', 'Footer Status Change');
        } else {
            if ($category >= 5) {
                return redirect()->back()->with('error_msg', 'You cannot add more than 5 category on footer');
            } else {
                if ($category_type == 1) {
                    DB::table('nav_category')
                        ->where('id', $request->id)
                        ->update([
                            'footer_status' => 1
                        ]);
                    return redirect()->back()->with('success_msg', 'Footer Status Change');
                } else {
                    return redirect()->back()->with('error_msg', 'You have not right to access this features');
                }
            }
        }
    }

    public function service_category_change(Request $request)
    {
        DB::table('nav_category')
            ->where('id', $request->category_id)
            ->update([
                'category_type' => $request->type,
            ]);
        return redirect()->back()->with(['success_msg' => 'Category Status Change']);
    }
}
