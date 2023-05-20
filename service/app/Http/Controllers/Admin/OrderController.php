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



class OrderController extends Controller

{


    public function __construct(){
        $this->middleware('auth.admin');
    }


    public function index()

    {

        $data = DB::table('order')->orderBy('id', 'desc')->get();

        return view('control-panel.order.order-management')->with(array('arr_data' => $data));
    }




    public function Details(Request $request)

    {
        $Id = $request->id;
        $data = DB::table('order')
            ->join('order_status', 'order_status.order_status_id', 'order.order_status_id')
            ->where('id', $Id)
            ->first();
        $Orderdata = DB::table('order_details')
                            ->join('pricing','pricing.id','order_details.price_id')
                            ->join('nav_category','nav_category.id','pricing.category_id')
                            ->where('order_details.order_id', $Id)
                            ->select('order_details.*','nav_category.title as servicetitle')
                            ->get();
        $order_status = DB::table('order_status')->get();
        return view('control-panel.order.order-details')->with(array('data' => $data, 'details' => $Orderdata, 'order_status' => $order_status));
    }






    function Remove($Id)

    {

        if (DB::table('order')->where('id', $Id)->delete()) {



            return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
        } else {

            return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
        }
    }

    public function order_status_change(Request $request)
    {
        DB::table('order')
            ->where('id', $request->order_id)
            ->update([
                'order_status_id' => $request->id,
            ]);
        return redirect()->back()->with(['success_msg' => 'Order Status Changed']);
    }

    public function payment_status_change(Request $request)
    {
        DB::table('order')
            ->where('id', $request->order_id)
            ->update([
                'payment_status' => $request->id,
            ]);
        return redirect()->back()->with(['success_msg' => 'Order Status Changed']);
    }
}
