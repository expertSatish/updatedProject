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



class TaxController extends Controller

{
    public function __construct(){
        $this->middleware('auth.admin');
    }
    
    public function index()
    {
        $data = DB::table('tax')->orderBy('id', 'ASC')->get();

        return view('control-panel.tax.tax-management')->with(array('arr_data' => $data));
    }



    public function Update($Id)

    {

        $data = DB::table('tax')->where('id', $Id)->first();



        return view('control-panel.tax.update-tax')->with(array('data' => $data));
    }


    function Status($Status, $Id)

    {

        if (DB::table('tax')->where('id', $Id)->update(['status' => $Status])) {

            return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }




    function Remove($Id)

    {

        if (DB::table('tax')->where('id', $Id)->delete()) {

            return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }




    function Save(Request $r)
    {
        $Parent = $r->parentId;
        $Type = $r->alt;
        $Heading = $r->Heading;
        $Currency = $r->Currency;
        $Amount = $r->Amount;
        $meta_title = $r->title;
        $meta_keywords = $r->keywords;
        $meta_description = $r->description;

        if (empty($Type)) {
            return redirect()->back()->with(array('error_msg' => 'Please enter one category name.'));
        }

        foreach ($Type as $key => $value) {
            if (!empty($value)) {
                $Alias = Helper::NewAlias('tax', 'title', $value);

                DB::table('tax')
                    ->insert([
                        'alias' => $Alias,
                        'title' => $value,
                        'heading' => $Heading[$key],
                        'currency' => $Currency[$key],
                        'price' => $Amount[$key],
                        'meta_title' => $meta_title[$key],
                        'meta_keywords' => $meta_keywords[$key],
                        'meta_description' => $meta_description[$key],
                    ]);
            }
        }


        return redirect()->back()->with(array('success_msg' => Helper::saveMSG()));
    }




    function Edit(Request $r)

    {

        $PageLocation = $r->PageLocation;

        $Id = $r->EditId;

        $Title = $r->Title;
        $Alias = $r->Alias;
        $meta_title = $r->meta_title;
        $meta_keywords = $r->meta_keywords;
        $meta_description = $r->meta_description;

        $Heading = $r->Heading;
        $Currency = $r->Currency;
        $Amount = $r->Amount;

        $BannerTitle = $r->BannerTitle;
        $ListTitle = $r->ListTitle;

        $banner = $r->banner;
        $prebanner = $r->prebanner;

        $BannerDescription = $r->BannerDescription;
        $AboutDescription = $r->AboutDescription;
        $home_description = $r->home_description;

        $list = $r->list;
        $type = $r->type;
        $listId = $r->listId;

        if ($PageLocation != 'tax-banner') {
            DB::table('tax')->where('id', $Id)
                ->update([
                    'title' => $Title,
                    'alias' => $Alias,
                    'price' => $Amount,
                    'currency' => $Currency,
                    'heading' => $Heading,
                    'meta_title' => $meta_title,
                    'meta_keywords' => $meta_keywords,
                    'meta_description' => $meta_description,
                ]);
        } else {

            if (empty($banner)) {
                $file = $prebanner;
            } else {
                $file = Helper::sizeImage('/assets/uploads/banner/', 1600, 700, $banner);
            }


            DB::table('tax')->where('id', $Id)->update(['banner_image' => $file, 'about' => $AboutDescription, 'banner_text' => $BannerDescription, 'list_title' => $ListTitle, 'banner_title' => $BannerTitle, 'home_description' => $home_description]);

            if (!empty($list)) {

                foreach ($list as $key => $value) {

                    if (!empty($value)) {
                        if (!empty($listId[$key])) {
                            DB::table('tax_list')->where('id', $listId[$key])->update(['list_for' => $type[$key], 'title' => $value]);
                        } else {
                            DB::table('tax_list')->insert(['list_for' => $type[$key], 'title' => $value, 'tax_id' => $Id]);
                        }
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

    function tax_enquiry_save(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|min:10|max:12',
            'pan' => 'required|min:10|max:10',
            'message' => 'required',
        ]);
        if ($request->document) {
            foreach ($request->document as $i) {
                $extention = $i->getClientOriginalExtension();

                if ($extention !== 'pdf' && $extention !== 'png' && $extention !== 'jpg' && $extention !== 'jpeg') {
                    return redirect()->back()->with(['error_msg' => 'document support PDF, PNG, JPG, JPEG Only.']);
                }
            }
        }

        $is_exist = DB::table('tax_enquiry')
            ->where('name', $request->name)
            ->where('email', $request->email)
            ->where('message', $request->message)
            ->first();
        if (isset($is_exist)) {
            return redirect()->back()->with(['error_msg' => 'Enquiry Already Exists']);
        } else {
            $data_id = DB::table('tax_enquiry')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'pan' => $request->pan,
                'message' => $request->message,
            ]);
            $data = DB::table('tax_enquiry')->where('tax_enquiry_id', $data_id)->first();
            if ($request->document) {
                foreach ($request->document as $document) {
                    $extention = $document->getClientOriginalExtension();
                    $filename = rand(0, 99999) . '.' . $extention;
                    $document->move('resources/assets/uploads/tax/', $filename);
                    $db = $filename;
                    DB::table('tax_enquiry_documents')->insert([
                        'tax_enquiry_id' => $data->tax_enquiry_id,
                        'document' => $db,
                    ]);
                }
            }

            return redirect()->back()->with(['success_msg' => 'Enquiry Saved Successfully']);
        }
    }
    function tax_enquiry_list(Request $request)
    {
        $enquiry = DB::table('tax_enquiry')->orderBy('tax_enquiry.tax_enquiry_id', 'DESC')->paginate(10);
        return view('control-panel.tax-enquiry.list', compact('enquiry'));
    }

    function tax_document_list(Request $request)
    {
        $tax_payer = DB::table('tax_enquiry')->where('tax_enquiry_id', $request->id)->first();
        $documents = DB::table('tax_enquiry_documents')
            ->where('tax_enquiry_id', $request->id)->get();
        return view('control-panel.tax-enquiry.documents', compact('documents', 'tax_payer'));
    }

    function tax_enquiry_delete(Request $request)
    {
        DB::table('tax_enquiry')->where('tax_enquiry_id', $request->id)->delete();
        return redirect()->back()->with(['success_msg' => 'Enquiry Deleted Successfully']);
    }

    public function tax_top_status(Request $request)
    {
        $tax = DB::table('tax')
            ->where('id', $request->id)
            ->first();
        $top_status = $tax->top_status;
        if ($top_status == 0) {
            DB::table('tax')->update(array('top_status' => 0));

            DB::table('tax')
                ->where('id', $request->id)
                ->update([
                    'top_status' => 1
                ]);
        } else {
            DB::table('tax')->update(array('top_status' => 1));
            DB::table('tax')
                ->where('id', $request->id)
                ->update([
                    'top_status' => 0
                ]);
        }
        return redirect()->back()->with('success_msg', 'Tax Top Status Change');
    }
    public function tax_home_status(Request $request)
    {
        $tax = DB::table('tax')
            ->where('id', $request->id)
            ->first();
        $home_status = $tax->home_status;
        if ($home_status == 0) {
            DB::table('tax')
                ->where('id', $request->id)
                ->update([
                    'home_status' => 1
                ]);
        } else {
            DB::table('tax')
                ->where('id', $request->id)
                ->update([
                    'home_status' => 0
                ]);
        }
        return redirect()->back()->with('success_msg', 'Tax Home Status Change');
    }
}
