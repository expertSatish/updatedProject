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
class HomeController extends Controller{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    public function index(){
        $Contact = DB::table('contact_enquiry')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        $TaxEnquiry = DB::table('tax_enquiry')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
        $Oredrs = DB::table('order')->whereMonth('date', date('m'))->whereYear('date', date('Y'))->count();
        $ContactData = DB::table('contact_enquiry')->whereDate('created_at', date('Y-m-d'))->get();
        $TaxEnquiryData = DB::table('tax_enquiry')->whereDate('created_at', date('Y-m-d'))->get();
        $OredrsData = DB::table('order')->whereDate('date', date('Y-m-d'))->get();
        return view('control-panel.home', compact('Contact', 'TaxEnquiry', 'Oredrs', 'ContactData', 'TaxEnquiryData', 'OredrsData'));
    }
    public function home_management(){
        return view('control-panel.home-management');
    }
    public function header_content($id){
        $cms_pages =  DB::table('cms_pages')->where('id', $id)->get();
        return view('admin.header-content')->with(array('cms_pages' => $cms_pages));
    }
    function Post_Category_Management(){
        return view('control-panel.artical.categories-management');
    }
    function Add_Artical_Category(){
        return view('control-panel.artical.add-categories')->with(['flag' => false]);
    }
    function Update_Artical_Category($Id){
        $Query = DB::table('artical_category')->where('category_id', $Id)->first();
        return view('control-panel.artical.add-categories')->with(['array_data' => $Query, 'flag' => true]);
    }
    function Save_Artical_Category(Request $r){
        $Id = $r->Id;
        $name = $r->name;
        $Description = $r->Description;
        $meta_title = $r->meta_title;
        $meta_keywords = $r->meta_keywords;
        $meta_description = $r->meta_description;
        $Alias = $r->Alias;
        if (empty($Alias)) {
            $Alias = Helper::NewAlias('artical_category', 'category_name', $name);
        }
        $data = array(
            'category_name' => $name,
            'category_alias' => $Alias,
            'category_description' => $Description,
            'meta_title' => $meta_title,
            'meta_keywords' => $meta_keywords,
            'meta_description' => $meta_description,
        );
        if ($Id > 0) {
            $Query = DB::table('artical_category')->where('category_id', $Id)->update($data);
            $MSG = Helper::updateMSG();
        } else {
            $Query = DB::table('artical_category')->insert($data);
            $MSG = Helper::saveMSG();
        }
        if ($Query) {
            return redirect()->back()->with(array('success_msg' => $MSG));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }
    function Artical_Category_Status($Status, $Id){
        if (DB::table('artical_category')->where('category_id', $Id)->update(['status' => $Status])) {
            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }
    function Artical_Category_Remove($Id){
        if (DB::table('artical_category')->where('category_id', $Id)->delete()) {
            return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }
    function Artical_Sub_Category($Id){
        $Query = DB::table('artical_category')->where('parent', $Id)->orderby('category_id', 'DESC')->get();
        return view('control-panel.artical.subcategories-management')->with(['arr_data' => $Query, 'parent' => $Id]);
    }
    function Add_Artical_SubCategory($Parent){
        return view('control-panel.artical.add-subcategories')->with(['flag' => false, 'parent' => $Parent]);
    }
    function Update_Artical_SubCategory($Id){
        $Query = DB::table('artical_category')->where('category_id', $Id)->first();
        return view('control-panel.artical.add-subcategories')->with(['array_data' => $Query, 'flag' => true]);
    }
    function Save_Artical_SubCategory(Request $r){
        $Id = $r->Id;
        $parent = $r->parent;
        $level = $r->level;
        $name = $r->name;
        $Description = $r->Description;
        $meta_title = $r->meta_title;
        $meta_keywords = $r->meta_keywords;
        $meta_description = $r->meta_description;
        $Alias = $r->Alias;
        if (empty($Alias)) {
            $Alias = Helper::NewAlias('artical_category', 'category_name', $name);
        }
        $data = array(
            'category_name' => $name,

            'category_alias' => $Alias,

            'category_description' => $Description,

            'meta_title' => $meta_title,

            'meta_keywords' => $meta_keywords,

            'meta_description' => $meta_description,

            'parent' => $parent,

            'level' => $level

        );







        if ($Id > 0) {

            $Query = DB::table('artical_category')->where('category_id', $Id)->update($data);

            $MSG = Helper::updateMSG();
        } else {

            $Query = DB::table('artical_category')->insert($data);

            $MSG = Helper::saveMSG();
        }









        if ($Query) {

            return redirect()->back()->with(array('success_msg' => $MSG));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }







    function Get_Level_Category(Request $r)

    {

        $Category  = $r->Category;

        $Precategory = $r->Precategory;



        $Query = DB::table('artical_category')->where('parent', $Category)->get();



        if ($Query->count() > 0) {



            $Html = "<option value='0'>Choose One</option>";



            foreach ($Query as $Rows) :



                if ($Precategory == $Rows->category_id) {
                    $select = 'selected';
                } else {
                    $select = '';
                }



                $Html .= "<option value=" . $Rows->category_id . " " . $select . ">" . $Rows->category_name . "</option>";



            endforeach;
        } else {



            $Html = "<option value=''>Choose One</option>";
        }



        echo $Html;
    }







    function Save_Artical_Question(Request $r)

    {

        $Id = $r->Id;



        $name = $r->name;

        $Description = $r->Description;

        $meta_title = $r->meta_title;

        $meta_keywords = $r->meta_keywords;

        $meta_description = $r->meta_description;



        $Alias = $r->Alias;





        $Category1 = $r->category;

        $Category2 = $r->category2;

        $Category3 = $r->category3;





        if (empty($Alias)) {

            $Alias = Helper::NewAlias('artical_question', 'question', $name);
        }









        $data = array(



            'question' => $name,

            'alias' => $Alias,

            'message' => $Description,

            'meta_title' => $meta_title,

            'meta_keywords' => $meta_keywords,

            'meta_description' => $meta_description,

            'category_id' => $Category1,

            'category2' => $Category2,

            'category3' => $Category3

        );







        if ($Id > 0) {

            $Query = DB::table('artical_question')->where('id', $Id)->update($data);

            $MSG = Helper::updateMSG();
        } else {

            $Query = DB::table('artical_question')->insert($data);

            $MSG = Helper::saveMSG();
        }









        if ($Query) {

            return redirect()->back()->with(array('success_msg' => $MSG));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }





    function Artical_Question()

    {

        return view('control-panel.artical.question-management');
    }





    function Add_Artical_Question()

    {

        return view('control-panel.artical.add-question')->with(['flag' => false]);
    }





    function Update_Artical_Question($QuestionId)

    {

        $Query = DB::table('artical_question')->where('id', $QuestionId)->first();



        return view('control-panel.artical.add-question')->with(['flag' => true, 'array_data' => $Query]);
    }





    function Artical_Question_ListStatus($Status, $Id)

    {

        if (DB::table('artical_question')->where('id', $Id)->update(['set_on_list' => $Status])) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }





    function Artical_Question_Status($Status, $Id)

    {

        if (DB::table('artical_question')->where('id', $Id)->update(['status' => $Status])) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }







    function Artical_Question_Remove($Id)

    {

        if (DB::table('artical_question')->where('id', $Id)->delete()) {

            return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }

















    function Artical_Answer($QuestinId)

    {

        return view('control-panel.artical.answer-management')->with(['questionId' => $QuestinId]);
    }



    function Add_Artical_Answer($QuestinId)

    {

        return view('control-panel.artical.add-answer')->with(['questionId' => $QuestinId, 'flag' => false]);
    }



    function Update_Artical_Answer($AnswerId)

    {

        $Query = DB::table('artical_answer')->where('id', $AnswerId)->first();



        return view('control-panel.artical.add-answer')->with(['questionId' => $Query->question_id, 'array_data' => $Query, 'flag' => true]);
    }





    function Save_Artical_Answer(Request $r)

    {

        $Id  = $r->Id;

        $QuestionId  = $r->QuestionId;

        $Messages  = $r->Description;





        if ($Id > 0) {

            $Data = array(



                'question_id' => $QuestionId,

                'message' => $Messages,



            );



            $Query =  DB::table('artical_answer')->where('id', $Id)->update($Data);
        } else {

            $Data = array(



                'question_id' => $QuestionId,

                'message' => $Messages,

                'status' => 1,



            );



            $Query = DB::table('artical_answer')->insert($Data);
        }





        if ($Query) {

            return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }







    function Artical_Response($type, $Id)

    {



        $check = DB::table('artical_answer_response')->where(['answer_id' => $Id, 'company_id' => 0])->first();



        if (!empty($check)) {

            DB::table('artical_answer_response')->where(['answer_id' => $Id, 'company_id' => 0])->delete();





            $checkRes = DB::table('artical_answer')->where('id', $Id)->first();





            if ($check->type == 'like') {
                $data = array('like' => $checkRes->like - 1);
            } else {
                $data = array('unlike' => $checkRes->unlike - 1);
            }



            DB::table('artical_answer')->where('id', $Id)->update($data);
        }





        if (DB::table('artical_answer_response')->insert(['type' => $type, 'answer_id' => $Id, 'company_id' => 0, 'user_id' => 0])) {



            $checkRes = DB::table('artical_answer')->where('id', $Id)->first();





            if ($type == 'like') {
                $data = array('like' => $checkRes->like + 1);
            } else {
                $data = array('unlike' => $checkRes->unlike + 1);
            }



            DB::table('artical_answer')->where('id', $Id)->update($data);



            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }







    function Artical_Answer_Status($Status, $Id)

    {

        if (DB::table('artical_answer')->where('id', $Id)->update(['status' => $Status])) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }







    function Artical_Answer_Remove($Id)

    {

        if (DB::table('artical_answer')->where('id', $Id)->delete()) {

            return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }



















    public function edit_header_content(Request $request, $id)

    {



        $description = $request->input('description');





        DB::table('cms_pages')

            ->where('id', $id)

            ->update([



                'description' => $description,



            ]);



        return redirect()->back()->with(array('success_msg' => 'Content Updated.'));
    }





    public function scroll_content($id)

    {

        $cms_pages =  DB::table('cms_pages')->where('id', $id)->get();

        return view('admin.scroll-content')->with(array('cms_pages' => $cms_pages));
    }





    public function edit_scroll_content(Request $request, $id)

    {



        $description = $request->input('description');





        DB::table('cms_pages')

            ->where('id', $id)

            ->update([

                'description' => $description,

            ]);



        return redirect()->back()->with(array('success_msg' => 'Content Updated.'));
    }





    public function footer_content($id)

    {

        $cms_pages =  DB::table('cms_pages')->where('id', $id)->get();

        return view('admin.footer-content')->with(array('cms_pages' => $cms_pages));
    }





    public function edit_footer_content(Request $request, $id)

    {



        $description = $request->input('description');





        DB::table('cms_pages')

            ->where('id', $id)

            ->update([



                'description' => $description,



            ]);



        return redirect()->back()->with(array('success_msg' => 'Content Updated.'));
    }







    public function informations()

    {

        $home_information = DB::table('home_information')->orderBy('id', 'desc')->get();

        return view('admin.home-informations')->with(array('arr_data' => $home_information));
    }





    public function add_information(Request $request)

    {



        $title = $request->input('title');

        $description = $request->input('description');

        $image = $request->file('image');





        /*----------------------------Image Uploading script start--------------------------- */



        $extension =  $image->getClientOriginalExtension(); // getting image extension

        $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

        $imagesource = resource_path('/assets/uploads/home/' . $fileName); // upload path 

        Image::make($image->getRealPath())->fit(50, 65)->brightness(1)->save($imagesource);



        /*----------------------------Image Uploading script end--------------------------- */



        DB::table('home_information')->insert([

            [

                'title' => $title,

                'description' => $description,

                'image' => $fileName,

            ]

        ]);



        return redirect()->back()->with(array('success_msg' => 'Imfomation Successfully Added.'));
    }



    public function update_information($id)

    {

        $home_information =  DB::table('home_information')->where('id', $id)->get();

        return view('admin.update-home-information')->with(array('arr_data' => $home_information));
    }





    public function edit_information(Request $request, $id)

    {



        $title = $request->input('title');

        $description = $request->input('description');







        $image = $request->file('image');

        $old_image = $request->input('old_image');



        if ($image == "") {

            $fileName = $old_image;
        } else {

            if (!empty($old_image)) {

                if (file_exists(resource_path('/assets/uploads/home/' . $old_image))) {

                    unlink(resource_path('/assets/uploads/home/' . $old_image));
                }
            }



            /*----------------------------Image Uploading script start--------------------------- */



            $extension =  $image->getClientOriginalExtension(); // getting image extension

            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

            $imagesource = resource_path('/assets/uploads/home/' . $fileName); // upload path 

            Image::make($image->getRealPath())->fit(50, 65)->brightness(1)->save($imagesource);



            /*----------------------------Image Uploading script end--------------------------- */
        }







        DB::table('home_information')

            ->where('id', $id)

            ->update([

                'title' => $title,

                'description' => $description,

                'image' => $fileName,



            ]);



        return redirect(url('/admin/informations'))->with(array('success_msg' => 'Infomation Updated.'));
    }





    public function delete_information($id)

    {





        $home_information =  DB::table('home_information')->select('image')->where('id', $id)->get();

        foreach ($home_information as $data) {

            $image = $data->image;



            if (!empty($image)) {

                if (file_exists(resource_path('/assets/uploads/home/' . $image))) {

                    unlink(resource_path('/assets/uploads/home/' . $image));
                }
            }
        }



        DB::table('home_information')->where('id', $id)->delete();

        return redirect()->back()->with(array('success_msg' => 'Infomation Deleted Successfully.'));
    }





    public function expert_cat()

    {

        $expert_cat = DB::table('expert_cat')->orderBy('id', 'desc')->get();

        return view('admin.expert-cat')->with(array('arr_data' => $expert_cat));
    }





    public function add_expert_category(Request $request)

    {



        $name = $request->input('name');



        /*----------------------Slug Start-------------------------------*/



        $table = 'expert_cat';      /*------------Write table name---------------*/

        $field = 'alias';          /*------------Write field name---------------*/

        $slug = $name;  /*------------Write title for slug-----------*/

        $slug = Str::slug($name, "-");

        $key = NULL;

        $value = NULL;



        $i = 0;

        $params = array();

        $params[$field] = $slug;



        if ($key) $params["$key !="] = $value;



        while (DB::table($table)->where($params)->get()->count()) {

            if (!preg_match('/-{1}[0-9]+$/', $slug))

                $slug .= '-' . ++$i;

            else

                $slug = preg_replace('/[0-9]+$/', ++$i, $slug);

            $params[$field] = $slug;
        }



        $alias = $slug;



        /*----------------------Slug End-------------------------------*/





        DB::table('expert_cat')->insert([

            [

                'name' => $name,

                'alias' => $alias,



            ]

        ]);



        return redirect()->back()->with(array('success_msg' => 'Infomation Successfully Added.'));
    }





    public function update_expert_cat($id)

    {

        $expert_cat =  DB::table('expert_cat')->where('id', $id)->get();

        return view('admin.update-expert-cat')->with(array('arr_data' => $expert_cat));
    }







    public function edit_expert_cat(Request $request, $id)

    {



        $name = $request->input('name');

        $alias = $request->input('alias');

        $old_alias = $request->input('old_alias');



        /*----------------------Slug Start-------------------------------*/





        $table = 'expert_cat';      /*------------Write table name---------------*/

        $field = 'alias';          /*------------Write field name---------------*/

        $slug = $alias;  /*------------Write title for slug-----------*/

        $slug = Str::slug($slug, "-");

        $key = NULL;

        $value = NULL;



        $i = 0;

        $params = array();

        $params[$field] = $slug;



        if ($key) $params["$key !="] = $value;

        if ($alias != $old_alias) {

            while (DB::table($table)->where($params)->get()->count()) {

                if (!preg_match('/-{1}[0-9]+$/', $slug))

                    $slug .= '-' . ++$i;

                else

                    $slug = preg_replace('/[0-9]+$/', ++$i, $slug);

                $params[$field] = $slug;
            }



            $alias2 = $slug;
        } else {

            $alias2 = $alias;
        }



        /*----------------------Slug End-------------------------------*/





        DB::table('expert_cat')

            ->where('id', $id)

            ->update([

                'name' => $name,

                'alias' => $alias2,



            ]);



        return redirect(url('/admin/expert-categories'))->with(array('success_msg' => 'Infomation Successfully Updated.'));
    }





    public function delete_expert_cat($id)

    {





        DB::table('expert_cat')->where('id', $id)->delete();

        return redirect()->back()->with(array('success_msg' => 'Infomation Successfully Deleted.'));
    }





    public function change_expert_cat_home_status($home_status, $id)

    {



        DB::table('expert_cat')

            ->where('id', $id)

            ->update([

                'home_status' => $home_status,

            ]);

        if ($home_status == 1) {

            $msg = "Display Status Activated.";
        }

        if ($home_status == 0) {

            $msg = "Display Status Deactivated.";
        }

        return back()->with(array('success_msg' => $msg));
    }





    public function experts($cat_id)

    {

        $experts = DB::table('experts')->where('cat_id', $cat_id)->orderBy('id', 'desc')->get();

        return view('admin.experts')->with(array('arr_data' => $experts, 'cat_id' => $cat_id));
    }





    public function add_expert(Request $request)

    {



        $name = $request->input('name');

        $cat_id = $request->input('cat_id');

        $title = $request->input('title');

        $description = $request->input('description');

        $image = $request->file('image');



        $facebook = $request->input('facebook');

        $twitter = $request->input('twitter');

        $instagram = $request->input('instagram');

        $youtube = $request->input('youtube');

        $pinterest = $request->input('pinterest');

        $google = $request->input('google');





        /*----------------------------Image Uploading script start--------------------------- */



        $extension =  $image->getClientOriginalExtension(); // getting image extension

        $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

        $imagesource = resource_path('/assets/uploads/home/' . $fileName); // upload path 

        Image::make($image->getRealPath())->fit(270, 315)->brightness(1)->save($imagesource);



        /*----------------------------Image Uploading script end--------------------------- */



        DB::table('experts')->insert([

            [

                'name' => $name,

                'cat_id' => $cat_id,

                'title' => $title,

                'description' => $description,

                'image' => $fileName,

                'facebook' => $facebook,

                'twitter' => $twitter,

                'instagram' => $instagram,

                'youtube' => $youtube,

                'pinterest' => $pinterest,

                'google' => $google,

            ]

        ]);



        return redirect()->back()->with(array('success_msg' => 'Expert Successfully Added.'));
    }



    public function update_expert($id, $cat_id)

    {

        $experts =  DB::table('experts')->where('id', $id)->get();

        return view('admin.update-expert')->with(array('arr_data' => $experts, 'cat_id' => $cat_id));
    }





    public function edit_expert(Request $request, $id)

    {



        $name = $request->input('name');

        $cat_id = $request->input('cat_id');

        $title = $request->input('title');

        $description = $request->input('description');



        $facebook = $request->input('facebook');

        $twitter = $request->input('twitter');

        $instagram = $request->input('instagram');

        $youtube = $request->input('youtube');

        $pinterest = $request->input('pinterest');

        $google = $request->input('google');



        $email = $request->input('email');

        $blog = $request->input('blog');









        $image = $request->file('image');

        $old_image = $request->input('old_image');



        if ($image == "") {

            $fileName = $old_image;
        } else {

            if (!empty($old_image)) {

                if (file_exists(resource_path('/assets/uploads/home/' . $old_image))) {

                    unlink(resource_path('/assets/uploads/home/' . $old_image));
                }
            }







            /*----------------------------Image Uploading script start--------------------------- */



            $extension =  $image->getClientOriginalExtension(); // getting image extension

            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

            $imagesource = resource_path('/assets/uploads/home/' . $fileName); // upload path 

            Image::make($image->getRealPath())->fit(270, 315)->brightness(1)->save($imagesource);



            /*----------------------------Image Uploading script end--------------------------- */
        }







        DB::table('experts')

            ->where('id', $id)

            ->update([

                'name' => $name,

                'title' => $title,

                'description' => $description,

                'image' => $fileName,

                'facebook' => $facebook,

                'twitter' => $twitter,

                'instagram' => $instagram,

                'youtube' => $youtube,

                'pinterest' => $pinterest,

                'google' => $google,

                'email' => $email,

                'blog' => $blog,

            ]);



        return redirect(url('/admin/experts/' . $cat_id))->with(array('success_msg' => 'Expett Infomation Successfully Updated.'));
    }





    public function delete_expert($id)

    {





        $expert =  DB::table('experts')->select('image')->where('id', $id)->get();

        foreach ($expert as $data) {

            $image = $data->image;



            if (!empty($image)) {

                if (file_exists(resource_path('/assets/uploads/home/' . $image))) {

                    unlink(resource_path('/assets/uploads/home/' . $image));
                }
            }
        }



        DB::table('experts')->where('id', $id)->delete();

        return redirect()->back()->with(array('success_msg' => 'Expert Deleted Successfully.'));
    }





    public function change_expert_home_status($home_status, $id)

    {



        DB::table('experts')

            ->where('id', $id)

            ->update([

                'home_status' => $home_status,

            ]);



        return back()->with(array('success_msg' => 'Status Changed.'));
    }









    public function offer_banners()

    {

        $offer_banners = DB::table('offer_banners')->orderBy('id', 'desc')->get();

        return view('admin.offer-banners')->with(array('arr_data' => $offer_banners));
    }





    public function update_offer_banner($id)

    {

        $offer_banners = DB::table('offer_banners')->where('id', $id)->get();

        return view('admin.update-offer-banner')->with(array('arr_data' => $offer_banners));
    }









    public function edit_offer_banner(Request $request, $id)

    {



        $link = $request->input('link');

        $image = $request->file('image');

        $old_image = $request->input('old_image');



        if ($image == "") {

            $fileName = $old_image;
        } else {

            if (!empty($old_image)) {

                if (file_exists(resource_path('/assets/home/' . $old_image))) {

                    unlink(resource_path('/assets/uploads/home/' . $old_image));
                }
            }



            /*----------------------------Image Uploading script start--------------------------- */



            $extension =  $image->getClientOriginalExtension(); // getting image extension

            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

            $imagesource = resource_path('/assets/uploads/home/' . $fileName); // upload path 

            Image::make($image->getRealPath())->fit(1170, 90)->brightness(1)->save($imagesource);



            /*----------------------------Image Uploading script end--------------------------- */
        }







        DB::table('offer_banners')

            ->where('id', $id)

            ->update([

                'link' => $link,

                'image' => $fileName,

            ]);



        return redirect(url('/admin/offer-banners'))->with(array('success_msg' => 'Form Updated.'));
    }





    public function delete_offer_banner($id)

    {





        $offer_banners =  DB::table('offer_banners')->select('image')->where('id', $id)->get();

        foreach ($offer_banners as $data) {

            $image = $data->image;



            if (!empty($image)) {

                if (file_exists(resource_path('/assets/uploads/home/' . $image))) {

                    unlink(resource_path('/assets/uploads/home/' . $image));
                }
            }
        }



        DB::table('offer_banners')

            ->where('id', $id)

            ->update([



                'image' => '',



            ]);

        return redirect()->back()->with(array('success_msg' => 'Data Deleted.'));
    }





    public function newsletters()

    {

        $newsletters =  DB::table('newsletter')->get();

        return view('admin.newsletter')->with(array('arr_data' => $newsletters));
    }









    public function delete_newsletter(Request $request)

    {





        $id = $request->input('news_id');



        if (empty($id)) {

            return redirect()->back()->with(array('error_msg' => 'Please select a ID first.'));
        } else {



            foreach ($id as $row) {

                DB::table('newsletter')->where('id', $row)->delete();
            }

            return redirect()->back()->with(array('success_msg' => 'ID Successfully Deleted.'));
        }
    }



    public function newletter_export()
    {

        $contacts = DB::table('newsletter')->orderBy('id', 'desc')->get();

        $csv[] = ['SNo' => "", 'Email' => ""];

        $i = 1;

        foreach ($contacts as $contact) {

            $csv[] = [$i, $contact->email];

            $i++;
        }



        return \Excel::create('NewLetter' . date('d-m-Y H:i:s'), function ($excel) use ($csv) {

            $excel->sheet('NewLetter', function ($sheet) use ($csv) {

                $sheet->fromArray($csv);
            });
        })->download('csv');
    }







    public function shop_by_category()

    {

        return view('admin.shop-by-category');
    }





    public function edit_shop_category($id)

    {

        $cms_pages = DB::table('cms_pages')->where('id', $id)->get();

        return view('admin.update-shop-category')->with(array('arr_data' => $cms_pages, 'id' => $id));
    }





    public function update_shop_category(Request $request, $id)

    {







        $title = $request->input('title');

        $description = $request->input('description');

        $url = $request->input('url');





        $validator = $this->validate($request, [

            'title' => 'required',

            'description' => 'required',

        ], [

            'title.required' => ' The Title1 field is required.',

            'description.required' => ' The Title2 field is required.',

        ]);









        $image = $request->file('image');

        $old_image = $request->input('old_image');



        if (empty($image)) {

            $fileName = $old_image;
        } else {

            if ($old_image != "") {

                if (file_exists(resource_path('/assets/uploads/home/' . $old_image))) {

                    unlink(resource_path('/assets/uploads/home/' . $old_image));
                }
            }



            /*----------------------------Image Uploading script start--------------------------- */



            $extension =  $image->getClientOriginalExtension(); // getting image extension

            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

            $imagesource = resource_path('/assets/uploads/home/' . $fileName); // upload path 

            Image::make($image->getRealPath())->fit(370, 400)->brightness(1)->save($imagesource);



            /*----------------------------Image Uploading script end--------------------------- */
        }









        DB::table('cms_pages')

            ->where('id', $id)

            ->update([

                'title' => $title,

                'description' => $description,

                'url' => $url,

                'image' => $fileName,

            ]);



        return redirect(url('/admin/shop-by-category'))->with(array('success_msg' => 'Record Successfully Updated.'));
    }





    public function benefits_of_vaping()

    {

        return view('admin.benefits-of-vaping');
    }





    public function edit_vaping_benefits($id)

    {

        $cms_pages = DB::table('cms_pages')->where('id', $id)->get();

        return view('admin.update-vaping-benefits')->with(array('arr_data' => $cms_pages, 'id' => $id));
    }





    public function update_vaping_benefits(Request $request, $id)

    {







        $title = $request->input('title');

        $description = $request->input('description');







        $validator = $this->validate($request, [

            'title' => 'required',

            'description' => 'required',

        ], [

            'title.required' => ' The Title1 field is required.',

            'description.required' => ' The Title2 field is required.',

        ]);













        DB::table('cms_pages')

            ->where('id', $id)

            ->update([

                'title' => $title,

                'description' => $description,

            ]);



        return redirect(url('/admin/benefits-of-vaping'))->with(array('success_msg' => 'Record Successfully Updated.'));
    }









    public function update_vaping_background_image(Request $request)

    {







        $image = $request->file('image');

        $old_image = $request->input('old_image');



        if (empty($image)) {

            $fileName = $old_image;
        } else {

            if ($old_image != "") {

                if (file_exists(resource_path('/assets/uploads/home/' . $old_image))) {

                    unlink(resource_path('/assets/uploads/home/' . $old_image));
                }
            }



            /*----------------------------Image Uploading script start--------------------------- */



            $extension =  $image->getClientOriginalExtension(); // getting image extension

            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

            $imagesource = resource_path('/assets/uploads/home/' . $fileName); // upload path 

            Image::make($image->getRealPath())->brightness(1)->save($imagesource);



            /*----------------------------Image Uploading script end--------------------------- */
        }









        DB::table('cms_pages')

            ->where('id', 31)

            ->update([



                'image' => $fileName,

            ]);



        return redirect(url('/admin/benefits-of-vaping'))->with(array('success_msg' => 'Background Image Successfully Updated.'));
    }







    public function category_background_image()

    {



        $b_image = DB::table('categories')->where('background_image', '!=', NULL)->get();

        return view('admin.category-background-image')->with(array('b_image' => $b_image));
    }





    public function add_background_image(Request $request)

    {



        $category = $request->input('category');



        $image = $request->file('image');



        $background_image_count =  DB::table('categories')->where(array('category_id' => $category))->where('background_image', '!=', NULL)->count();



        if ($background_image_count == 0) {



            /*----------------------------Image Uploading script start--------------------------- */



            $extension =  $image->getClientOriginalExtension(); // getting image extension

            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

            $imagesource = resource_path('/assets/uploads/category/' . $fileName); // upload path 

            Image::make($image->getRealPath())->fit(1400, 400)->brightness(1)->save($imagesource);



            /*----------------------------Image Uploading script end--------------------------- */





            DB::table('categories')

                ->where('category_id', $category)

                ->update([

                    'background_image' => $fileName,

                ]);







            return redirect()->back()->with(array('success_msg' => 'Image Successfully Added'));
        } else {

            return redirect()->back()->with(array('error_msg' => 'Image Already Exist'));
        }
    }







    public function deletebackgroundimage($category_id)

    {

        $categories =  DB::table('categories')->select('background_image')->where('category_id', $category_id)->first();



        if (!empty($categories)) {

            if (file_exists(resource_path('/assets/uploads/category/' . $categories->background_image))) {

                unlink(resource_path('/assets/uploads/category/' . $categories->background_image));
            }
        }



        DB::table('categories')

            ->where('category_id', $category_id)

            ->update([

                'background_image' => NULL,

            ]);



        return redirect(url('/admin/category-background-image'))->with(array('success_msg' => 'Image Deleted Successfully.'));
    }





    /*--------------------------------------------FAQs START------------------------------------------*/



    public function faq()

    {

        $sliders = DB::table('faqs')->orderby('Id', 'DESC')->get();

        return view('admin.faq')->with(array('sliders' => $sliders));
    }



    public function New_faq()

    {



        return view('admin.add-faq')->with(array('flag' => false));
    }





    public function add_faq(Request $request)

    {



        $brand = $request->input('brand');

        $brand_content = $request->input('brand_content');





        $image = $request->file('image');



        /*----------------------------Image Uploading script start--------------------------- */



        $extension =  $image->getClientOriginalExtension(); // getting image extension

        $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

        $imagesource = resource_path('/assets/uploads/faqs/' . $fileName); // upload path 

        Image::make($image->getRealPath())->resize(24, 24)->brightness(1)->save($imagesource);



        /*----------------------------Image Uploading script end--------------------------- */



        $Data = array(

            'title' => $brand,

            'description' => $brand_content,

            'image' => $fileName,



        );







        $Query =  DB::table('faqs')->insert($Data);







        if ($Query) {

            return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
        } else {

            return redirect()->back()->with(array('success_msg' => Helper::errorMSG()));
        }
    }





    public function faqbyid($id)

    {

        $sliders =  DB::table('faqs')->where('Id', $id)->get();

        return view('admin.update-faq')->with(array('arr_data' => $sliders));
    }



    public function editfaq(Request $request, $id)

    {



        $brand = $request->input('brand');

        $brand_content = $request->input('brand_content');



        $image = $request->file('image');

        $old_image = $request->input('old_image');





        if ($image == "") {

            $fileName = $old_image;
        } else {

            if (!empty($old_banner)) {





                if (file_exists(resource_path('/assets/uploads/faqs/' . $old_banner))) {

                    unlink(resource_path('/assets/uploads/faqs/' . $old_banner));
                }
            }





            $extension =  $image->getClientOriginalExtension(); // getting image extension

            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

            $imagesource = resource_path('/assets/uploads/faqs/' . $fileName); // upload path 

            Image::make($image->getRealPath())->resize(24, 24)->brightness(1)->save($imagesource);
        }







        DB::table('faqs')

            ->where('Id', $id)

            ->update([

                'title' => $brand,

                'description' => $brand_content,

                'image' => $fileName,



            ]);



        return redirect(url('/admin/faqs'))->with(array('success_msg' => Helper::updateMSG()));
    }





    public function deletefaq($id)

    {

        $brand =  DB::table('faqs')->where('Id', $id)->first();



        if (!empty($brand)) {

            if (file_exists(resource_path('/assets/uploads/faqs/' . $brand->image))) {

                unlink(resource_path('/assets/uploads/faqs/' . $brand->image));
            }
        }

        DB::table('faqs')->where('Id', $id)->delete();

        return redirect(url('/admin/faqs'))->with(array('success_msg' => Helper::removeMSG()));
    }



    public function Statusfaq($id, $status)

    {

        if (DB::table('faqs')->where('Id', $id)->update(['status' => $status])) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('success_msg' => Helper::errorMSG()));
        }
    }





    public function sortfaq(Request $request)

    {

        $Sort = $request->input('Sort');



        foreach ($Sort as $Key => $rows) :



            DB::table('faqs')->where('Id', $Key)->update(['sort' => $rows]);





        endforeach;





        return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
    }



    /*-----------------------------------------------END FAQs--------------------------------------------*/









    /*--------------------------------------------OUR TEAM START------------------------------------------*/



    public function Our_Team()

    {

        $sliders = DB::table('our_team')->orderby('Id', 'DESC')->get();

        return view('admin.our-team')->with(array('sliders' => $sliders));
    }



    public function New_Our_Team()

    {



        return view('admin.add-our-team')->with(array('flag' => false));
    }





    public function add_Our_Team(Request $request)

    {



        $Name = $request->input('Name');

        $Title = $request->input('Title');





        $image = $request->file('image');



        /*----------------------------Image Uploading script start--------------------------- */



        $extension =  $image->getClientOriginalExtension(); // getting image extension

        $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

        $imagesource = resource_path('/assets/uploads/team/' . $fileName); // upload path 

        Image::make($image->getRealPath())->resize(263, 300)->brightness(1)->save($imagesource);



        /*----------------------------Image Uploading script end--------------------------- */



        $Data = array(

            'name' => $Name,

            'title' => $Title,

            'image' => $fileName,



        );







        $Query =  DB::table('our_team')->insert($Data);







        if ($Query) {

            return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
        } else {

            return redirect()->back()->with(array('success_msg' => Helper::errorMSG()));
        }
    }





    public function Our_Teambyid($id)

    {

        $sliders =  DB::table('our_team')->where('Id', $id)->get();

        return view('admin.update-our-team')->with(array('arr_data' => $sliders));
    }



    public function editOur_Team(Request $request, $id)

    {



        $Name = $request->input('Name');

        $title = $request->input('title');



        $image = $request->file('image');

        $old_image = $request->input('old_image');





        if ($image == "") {

            $fileName = $old_image;
        } else {

            if (!empty($old_banner)) {





                if (file_exists(resource_path('/assets/uploads/team/' . $old_banner))) {

                    unlink(resource_path('/assets/uploads/team/' . $old_banner));
                }
            }





            $extension =  $image->getClientOriginalExtension(); // getting image extension

            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

            $imagesource = resource_path('/assets/uploads/team/' . $fileName); // upload path 

            Image::make($image->getRealPath())->resize(263, 300)->brightness(1)->save($imagesource);
        }







        DB::table('our_team')

            ->where('Id', $id)

            ->update([

                'name' => $Name,

                'title' => $title,

                'image' => $fileName,



            ]);



        return redirect(url('/admin/our-team'))->with(array('success_msg' => Helper::updateMSG()));
    }





    public function deleteOur_Team($id)

    {

        $brand =  DB::table('our_team')->where('Id', $id)->first();



        if (!empty($brand)) {

            if (file_exists(resource_path('/assets/uploads/team/' . $brand->image))) {

                unlink(resource_path('/assets/uploads/team/' . $brand->image));
            }
        }

        DB::table('our_team')->where('Id', $id)->delete();

        return redirect(url('/admin/our-team'))->with(array('success_msg' => Helper::removeMSG()));
    }



    public function StatusOur_Team($id, $status)

    {

        if (DB::table('our_team')->where('Id', $id)->update(['status' => $status])) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('success_msg' => Helper::errorMSG()));
        }
    }





    public function sortOur_Team(Request $request)

    {

        $Sort = $request->input('Sort');



        foreach ($Sort as $Key => $rows) :



            DB::table('our_team')->where('Id', $Key)->update(['sort' => $rows]);





        endforeach;





        return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
    }



    /*-----------------------------------------------END OUR TEAM--------------------------------------------*/







    function Support()

    {

        return view('admin.support');
    }





    function Update_Support(Request $request)

    {

        $ID = $request->input('ID');

        $heading = $request->input('heading');

        $title = $request->input('title');

        $mobile = $request->input('mobile');

        $image = $request->file('image');

        $oldimage = $request->input('oldimage');





        if ($image != '') {

            if (!empty($oldimage)) {

                if (file_exists(resource_path('/assets/uploads/logo/' . $oldimage))) {

                    unlink(resource_path('/assets/uploads/logo/' . $oldimage));
                }
            }



            $extension =  $image->getClientOriginalExtension(); // getting image extension

            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

            $imagesource = resource_path('/assets/uploads/logo/' . $fileName); // upload path 

            Image::make($image->getRealPath())->resize(60, 60)->brightness(1)->save($imagesource);
        } else {

            $fileName = $oldimage;
        }





        $data = array(

            'heading' => $heading,

            'title' => $title,

            'text' => $mobile,

            'image' => $fileName,

        );



        if (DB::table('support')->where('Id', $ID)->update($data)) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }

    function Remove_Popup_Image(Request $request){
        $data = DB::table('popup')->where('id', 1)->first();
        DB::table('popup')->where('id', 1)->update(['image'=>'']);
        if (file_exists(resource_path('/assets/uploads/cms/' . $data->image))) {
            unlink(resource_path('/assets/uploads/cms/' . $data->image));
        }
        return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
    }
    function Popup(){
        $popup = DB::table('popup')->where('id', 1)->first();
        return view('control-panel.popup', compact('popup'));
    }
    function Update_Popup(Request $request){
        $image = $request->file('image');
        $oldimage = $request->input('preimage');
        if ($image != '') {
            if (!empty($oldimage)) {
                if (file_exists(resource_path('/assets/uploads/cms/' . $oldimage))) {
                    unlink(resource_path('/assets/uploads/cms/' . $oldimage));
                }
            }
            $extension =  $image->getClientOriginalExtension(); // getting image extension
            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image
            $imagesource = resource_path('/assets/uploads/cms/' . $fileName); // upload path 
            Image::make($image->getRealPath())->resize(700,null)->brightness(1)->save($imagesource);
        } else {
            $fileName = $oldimage;
        }

        $data = array(
            'title' => $request->title,
            'description' => $request->description,
            'image' => $fileName,
            'status' => $request->status,
        );
        DB::table('popup')->where('Id',1)->update($data);
        return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
    }

    function Setting(){
        $setting = DB::table('setting')->where('id', 1)->first();
        return view('control-panel.setting', compact('setting'));
    }
    function Update_Setting(Request $request){
        request()->validate([
            'Image'=>'nullable|mimes:jpg,png,jpeg,webp|max:2024'
            ]);
        $ID = $request->input('SetingID');
        $Name = $request->input('Project');
        $email = $request->input('Email');
        $mobile = $request->input('Mobile');
        $address = $request->input('Address');
        $image = $request->file('Image');
        $oldimage = $request->input('PreImage');
        $gstn = $request->input('gstn');
        $note = $request->input('note');
        if ($image != '') {
            if (!empty($oldimage)) {
                if (file_exists(resource_path('/assets/uploads/logo/' . $oldimage))) {
                    unlink(resource_path('/assets/uploads/logo/' . $oldimage));
                }
            }
            $extension =  $image->getClientOriginalExtension(); // getting image extension
            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image
            $imagesource = resource_path('/assets/uploads/logo/' . $fileName); // upload path 
            Image::make($image->getRealPath())->resize(325, 85)->brightness(1)->save($imagesource);
        } else {

            $fileName = $oldimage;
        }

        $data = array(

            'site_name' => $Name,
            'mobile' => $mobile,
            'email' => $email,
            'address' => $address,
            'site_logo' => $fileName,
            'email_to' => $request->input('EmailTo'),
            'gst' => $request->gst,
            'gstn' => $gstn,
            'note' => $note,
        );

        if (DB::table('setting')->where('Id', $ID)->update($data)) {
            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {
            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }

    function Page_Section()
    {
        $Query = DB::table('page_section')->orderby('page_name', 'ASC')->get();
        return view('control-panel.page-section')->with(['arr_data' => $Query, 'Type' => '']);
    }

    function Update_Page_Section($Id)
    {
        $Query = DB::table('page_section')->where('id', $Id)->first();
        return view('control-panel.update-page-section')->with(['arr_data' => $Query]);
    }







    function Edit_Page_Section(Request $request)

    {



        $image = $request->banner;

        $oldimage = $request->prebanner;



        if ($image != '') {

            if (!empty($oldimage)) {

                if (file_exists(resource_path('/assets/uploads/cms/' . $oldimage))) {

                    unlink(resource_path('/assets/uploads/cms/' . $oldimage));
                }
            }





            $extension =  $image->getClientOriginalExtension(); // getting image extension

            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image

            $imagesource = resource_path('/assets/uploads/cms/' . $fileName); // upload path 

            Image::make($image->getRealPath())->resize(1600, 500)->brightness(1)->save($imagesource);
        } else {

            $fileName = $oldimage;
        }





        if (DB::table('page_section')->where('id', $request->ID)->update(['text_1' => $request->text_1, 'text_2' => $request->text_2, 'text_3' => $request->text_3, 'text_4' => $fileName, 'meta_title' => $request->meta_title, 'meta_keywords' => $request->meta_keywords, 'meta_description' => $request->meta_description])) {

            return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }





    /******************************* NEWS **********************************************************/





    public function News_Management()

    {

        $Qry = DB::table('news')->orderby('Id', 'DESC')->get();

        return view('admin.news_management')->with(array(

            'qryArr' => $Qry

        ));
    }



    public function Add_News()

    {

        return view('admin.add_news')->with(array(

            'Flag' => false

        ));
    }



    public function Update_News($ID)

    {

        $Qry = DB::table('news')->where('Id', '=', $ID)->first();

        return view('admin.add_news')->with(array(

            'Flag' => true,

            'NewsQry' => $Qry

        ));
    }





    public function NewsStatus($Status, $ID)

    {

        $Data = array('status' => $Status);

        $Qry = DB::table('news')->where('Id', '=', $ID)->update($Data);

        if ($Qry) {

            $MSG = array('success_msg' => 'Data modify successfully.');
        } else {

            $MSG = array('error_msg' => 'An error occurred, please try again later.');
        }





        return redirect()->back()->with($MSG);
    }





    public function Remove_News($ID)

    {

        $Qry = DB::table('news')->where('Id', '=', $ID)->delete();

        if ($Qry) {

            $MSG = array('success_msg' => 'Data remove successfully.');
        } else {

            $MSG = array('error_msg' => 'An error occurred, please try again later.');
        }





        return redirect()->back()->with($MSG);
    }





    public function Save_NewsData(Request $request)

    {

        $NewsId = $request->input('NewsId');

        $NewsType = $request->input('NewsType');

        $Title = $request->input('Title');

        $Alias = $request->input('Alias');

        $Short = $request->input('Short');

        $Description = $request->input('Description');



        $meta_title = $request->input('meta_title');

        $meta_keyword = $request->input('meta_keyword');

        $meta_description = $request->input('meta_description');



        $Image = $request->file('Image');

        $Preimage = $request->input('Preimage');



        $big_Image = $request->file('big_Image');

        $Prebigimage = $request->input('Prebigimage');



        if ($Image != '') {

            if ($Preimage != '') {



                if (file_exists(resource_path('/assets/admin/News/' . $Preimage))) {

                    unlink(resource_path('/assets/admin/News/' . $Preimage));
                }
            }



            ///////////////// FOR THUMB IMAGE ////////////////////        



            $extension =  $Image->getClientOriginalExtension(); // getting image extension

            $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image





            $imagesource1 = resource_path('/assets/admin/News/' . $fileName); // upload path 

            Image::make($Image->getRealPath())->fit(386, 298)->brightness(1)->save($imagesource1);





            ///////////////// END THUMB IMAGE ////////////////////    





        } else {

            $fileName = $Preimage;
        }





        if ($big_Image != '') {

            if ($Prebigimage != '') {

                if (file_exists(resource_path('/assets/admin/News/Big/' . $Prebigimage))) {

                    unlink(resource_path('/assets/admin/News/Big/' . $Prebigimage));
                }
            }







            $extension2 =  $big_Image->getClientOriginalExtension(); // getting image extension

            $fileName2 = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension2; // renameing image

            $imagesource2 = resource_path('/assets/admin/News/Big/' . $fileName2); // upload path 



            Image::make($big_Image->getRealPath())->resize(1094, 428)->brightness(1)->save($imagesource2);
        } else {

            $fileName2 = $Prebigimage;
        }









        if ($NewsId > 0) {

            $Data = array(

                'type' => $NewsType,

                'alias' => $Alias,

                'title' => $Title,

                'short_desc' => $Short,

                'full_desc' => $Description,

                'image' => $fileName,

                'big_image' => $fileName2,

                'meta_title' => $meta_title,

                'meta_keyword' => $meta_keyword,

                'meta_description' => $meta_description,

                'adddate' => date('Y-m-d h:i:s')

            );





            $Qry = DB::table('news')->where('Id', '=', $NewsId)->update($Data);

            $MSG = array('success_msg' => 'Data modify successfully.');
        } else {





            /*----------------------Slug Start-------------------------------*/



            $table = 'news';      /*------------Write table name---------------*/

            $field = 'alias';          /*------------Write field name---------------*/

            $slug = $Alias;  /*------------Write title for slug-----------*/

            $slug = Str::slug($Alias, "-");

            $key = NULL;

            $value = NULL;



            $i = 0;

            $params = array();

            $params[$field] = $slug;



            if ($key) $params["$key !="] = $value;



            while (DB::table($table)->where($params)->get()->count()) {

                if (!preg_match('/-{1}[0-9]+$/', $slug))

                    $slug .= '-' . ++$i;

                else

                    $slug = preg_replace('/[0-9]+$/', ++$i, $slug);

                $params[$field] = $slug;
            }



            $Alias = $slug;







            /*----------------------Slug End-------------------------------*/









            $Data = array(

                'type' => $NewsType,

                'title' => $Title,

                'alias' => $Alias,

                'short_desc' => $Short,

                'full_desc' => $Description,

                'image' => $fileName,

                'big_image' => $fileName2,

                'meta_title' => $meta_title,

                'meta_keyword' => $meta_keyword,

                'meta_description' => $meta_description,

                'status' => '1',

                'adddate' => date('Y-m-d h:i:s')

            );







            $Qry = DB::table('news')->insert($Data);

            $MSG = array('success_msg' => 'Data saved successfully.');
        }



        if ($Qry) {
        } else {

            $MSG = array('error_msg' => 'An error occurred, please try again later.');
        }



        return redirect()->back()->with($MSG);
    }



    public function News_Comment()

    {

        $Qry = DB::table('news_comments')

            ->join('news', 'news_comments.news_Id', '=', 'news.Id')

            ->select('news_comments.*', 'news.title', 'news.image', 'news.type')

            ->orderby('Id', 'DESC')

            ->get();

        return view('admin.news_comments')->with(array(

            'qryArr' => $Qry

        ));
    }





    public function Update_Comment($Status, $ID)

    {

        $data = array(

            'status' => $Status

        );



        $Query = DB::table('news_comments')

            ->where('Id', $ID)

            ->update($data);





        if ($Query) {



            return redirect()->back()->with(array('success_msg' => 'Data modify.'));
        } else {

            return redirect()->back()->with(array('error_msg' => 'An error occurred, please try again later.'));
        }
    }





    public function Remove_Comment($ID)

    {





        $Query = DB::table('news_comments')

            ->where('Id', $ID)

            ->delete();





        if ($Query) {



            return redirect()->back()->with(array('success_msg' => 'Data remove successfully.'));
        } else {

            return redirect()->back()->with(array('error_msg' => 'An error occurred, please try again later.'));
        }
    }




    function Grafh(Request $r)
    {

        $Year = $r->Year;

        $Months = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        $Contact = array();
        $TaxEnquiry = array();
        $Oredrs = array();
        foreach ($Months as $key => $value) {
            $Monh = $key + 1;

            $Contact[] = DB::table('contact_enquiry')->whereMonth('created_at', $Monh)->whereYear('created_at', $Year)->count();
            $TaxEnquiry[] = DB::table('tax_enquiry')->whereMonth('created_at', $Monh)->whereYear('created_at', $Year)->count();
            $Oredrs[] = DB::table('order')->whereMonth('date', $Monh)->whereYear('date', $Year)->count();
        }





        echo 's^' . $Months[0] . '^' . $Months[1] . '^' . $Months[2] . '^' . $Months[3] . '^' . $Months[4] . '^' . $Months[5] . '^' . $Months[6] . '^' . $Months[7] . '^' . $Months[8] . '^' . $Months[9] . '^' . $Months[10] . '^' . $Months[11] . '^' . $Contact[0] . '^' . $Contact[1] . '^' . $Contact[2] . '^' . $Contact[3] . '^' . $Contact[4] . '^' . $Contact[5] . '^' . $Contact[6] . '^' . $Contact[7] . '^' . $Contact[8] . '^' . $Contact[9] . '^' . $Contact[10] . '^' . $Contact[11] . '^' . $TaxEnquiry[0] . '^' . $TaxEnquiry[1] . '^' . $TaxEnquiry[2] . '^' . $TaxEnquiry[3] . '^' . $TaxEnquiry[4] . '^' . $TaxEnquiry[5] . '^' . $TaxEnquiry[6] . '^' . $TaxEnquiry[7] . '^' . $TaxEnquiry[8] . '^' . $TaxEnquiry[9] . '^' . $TaxEnquiry[10] . '^' . $TaxEnquiry[11] . '^' . $Oredrs[0] . '^' . $Oredrs[1] . '^' . $Oredrs[2] . '^' . $Oredrs[3] . '^' . $Oredrs[4] . '^' . $Oredrs[5] . '^' . $Oredrs[6] . '^' . $Oredrs[7] . '^' . $Oredrs[8] . '^' . $Oredrs[9] . '^' . $Oredrs[10] . '^' . $Oredrs[11] . '^s';
    }
}
