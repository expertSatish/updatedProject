<?php



namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;

use PDF;
use Image;

use Mail;

use Sendgrid;

use OilBanner;

use Cart;

use Session;

use Hash;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Transactions\DbTransactionHandler;

class CartController extends Controller

{

  function index()
  {

    $meta = DB::table('page_section')->where('id', 45)->first();
    $data = DB::table('cms_pages')->whereIn('id', array(20, 21, 22))->get();

    return view('home')->with(['meta' => $meta, 'data' => $data]);
  }

  function service($alias)
  {

    $nav_id = DB::table('nav_category')->where('alias', $alias)->first();

    $id = $nav_id->id;

    return view('service')->with(['id' => $id]);
  }


  function add_to_cart(Request $request, $product_id)
  {

    $product_id = base64_decode($product_id);

    $quantity = $request->input('quantity');
    $name = $request->input('name');
    $price = $request->input('price');

    if (empty($quantity)) {
      $quantity = '1';
    }


    // Cart::add(['id' => $product_id, 'name' => $name, 'qty' => $quantity, 'price' => $price, 'options' => ['selling_price' => $price,'weight'=>0]]);
    Cart::add(['id' => $product_id, 'name' => $name, 'qty' => $quantity, 'price' => $price, 'weight' => 0, 'options' => ['size' => 'large']]);


    return back()->with(array('success_msg' => 'Item added to cart.'));

    //	

  }

  function cart_product_remove(Request $request, $rowId)
  {
    Cart::remove($rowId);
    $cart_total = Cart::subtotal();
    if (round($cart_total) == 0) {
      Session::put('coupan', '');
      Session::put('coupan_percentage', '');
    }
    return back()->with(array('success_msg' => 'Item removed from cart.'));
  }

  public function cart_detail(Request $request)
  {
    $cartItems = Cart::content();
    $cart_amount = Cart::subtotal();
    $cart_amount1 = str_replace(",", "", $cart_amount);
    $cart_total = floatval($cart_amount1);
    $setting = DB::table('setting')->where('id', 1)->first();
    $gst = $setting->gst;
    $gst_amount = (($cart_total) * $gst) / 100;
    $request->session()->put('gst_amount', $gst_amount);
    return view('cart-detail', ['cartItems' => $cartItems]);
  }


  function shipping_details(Request $request)
  {
    $cartItems = Cart::content();
    return view('shipping-details')->with(array('cartItems' => $cartItems));
  }

  function add_shipping_details()
  {

    $cartItems = Cart::content();
    $cities = DB::table('cities')->where('country_name', 'india')->get();
    $state = DB::table('states')->where('con_name', 'India')->first();
    $states = DB::table('states')->where('country_id', $state->country_id)->get();

    return view('add-shipping-details', compact('cartItems', 'cities', 'states'));
  }


  public function add_ship_detail(Request $request)
  {

    $name = $request->input('name');
    $phone = $request->input('phone');
    $email = $request->input('email');
    $business = $request->input('business');
    $gst = $request->input('gst');
    $address = $request->input('address');
    $city = $request->input('city');
    $state = $request->input('state');

    $validator = $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email',
      'phone' => 'required|numeric',

    ], [
      'name.required' => ' The Name field is required.',
      'email.required' => ' The Email field is required.',
      'phone.required' => ' The Phone field is required.',
      'phone.unique' => ' The Phone field already exist.',
      'phone.numeric' => ' The Phone field must be numeric.',
    ]);


    $id = DB::table('user_address')->insertGetId([
      'user_id' => Auth::user()->id,
      'name' => $name,
      'phone' => $phone,
      'email' => $email,
      'business' => $business,
      'gst' => $gst,
      'address' => $address,
      'city' => $city,
      'state' => $state,
    ]);



    return redirect('/shipping-details')->with(array('success_msg' => 'Address added successfully.'));
  }


  function edit_shipping_detail($id)
  {

    $data = DB::table('user_address')->where('id', $id)->first();
    $cities = DB::table('cities')->where('country_name', 'india')->get();
    $state = DB::table('states')->where('con_name', 'India')->first();
    $states = DB::table('states')->where('country_id', $state->country_id)->get();
    $selected_city = DB::table('cities')->where('id', $data->city)->first();
    //return json_encode($data);


    return view('edit-shipping-details', compact('data', 'cities', 'states', 'selected_city'));
  }




  public function edit_ship_detail(Request $request, $id)
  {
    $name = $request->input('name');
    $phone = $request->input('phone');
    $email = $request->input('email');
    $business = $request->input('business');
    $gst = $request->input('gst');
    $address = $request->input('address');
    $city = $request->input('city');
    $state = $request->input('state');

    $validator = $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email',
      'phone' => 'required|numeric',

    ], [
      'name.required' => ' The Name field is required.',
      'email.required' => ' The Email field is required.',
      'phone.required' => ' The Phone field is required.',
      'phone.unique' => ' The Phone field already exist.',
      'phone.numeric' => ' The Phone field must be numeric.',
    ]);


    $id = DB::table('user_address')->where('id', $id)->update([
      'user_id' => Auth::user()->id,
      'name' => $name,
      'phone' => $phone,
      'email' => $email,
      'business' => $business,
      'gst' => $gst,
      'address' => $address,
      'city' => $city,
      'state' => $state,
    ]);



    return redirect()->back()->with(array('success_msg' => 'Address updated successfully.'));
  }



  function payment(Request $request)
  {

    $address_id = $request->input('address_id');
    if ($address_id != null) {
      $request->session()->put('address_id', $address_id);
      return redirect('/save-payment');
    } else {
      return redirect()->back()->with(['error_msg' => 'Select Address first!']);
    }
  }

  function save_payment(Request $request)
  {
    $cartItems = Cart::content();
    return view('payment')->with(array('cartItems' => $cartItems));
  }


  function coupon_cancel(){
    Session::forget('coupan');
    Session::forget('coupan_percentage');
    return redirect()->back()->with(['error_msg' => 'Coupon has been canceled successfully.']);
  }

  function coupon_check(Request $request)
  {
    date_default_timezone_set('Asia/Kolkata');
    $current_date = date('Y-m-d');
    $data = DB::table('coupon')
      ->where('name',$request->name)
      ->where('status', 1)
      ->first();
    $coupon_start_date = $data->start_date;
    $coupon_end_date = $data->end_date;
    if ($current_date >= $coupon_start_date && $current_date <= $coupon_end_date) {
        if(!empty($data)) {
        $request->session()->put('coupan',1);
        $request->session()->put('coupan_percentage',$data->percentage);
        echo "s^1^" . $data->percentage . "^s";
      } else {

        Session::put('', '');
        Session::put('', '');

        echo  "s^0^0^s";
      }
    } else {
      echo  "s^0^0^s";
    }
  }





  function remove_shipping_detail($id)

  {



    if (DB::table('user_address')->where('id', $id)->delete()) {

      return redirect()->back()->with(array('success_msg' => "Address deleted successfully."));
    } else {

      return redirect()->back()->with(array('error_msg' => "Address not deleted."));
    }
  }



  function payment_success(Request $request)

  {

    $cartItems = Cart::content();

    $address_id = $request->input('address_id');
    $total = $request->input('total');
    $discount = $request->input('discount');
    $igst = $request->input('igst');
    $coupon = $request->input('counpon');
    $subtotal = $request->input('subtotal');

    $Txn = 'Txn' . rand(10000, 99999999);


    $address = DB::table('user_address')->where('id', $address_id)->first();

    $order_id = DB::table('order')->insertGetId([
      'user_id' => Auth::user()->id,
      'currency' => 'INR',
      'subtotal' => $subtotal,
      'total' => $total,
      'coupon' => $coupon,
      'discount' => $discount,
      'igst' => $igst,
      'status' => 1,
      'payment_status' => 0,
      'transaction_id' => $Txn,
      'name' => $address->name,
      'phone' => $address->phone,
      'email' => $address->email,
      'business' => $address->business,
      'gst' => $address->gst,
      'address' => $address->address,
      'city' => $address->city,
      'state' => $address->state,
      'landmark' => '',

    ]);

    $Title = '';

    foreach ($cartItems as $item) {

      $prc = DB::table('pricing')->where('id', $item->id)->first();

      DB::table('order_details')->insertGetId([
        'order_id' => $order_id,
        'price_id' => $prc->id,
        'title' => $prc->title,
        'currency' => $prc->currency,
        'text' => $prc->text,
        'amount' => $prc->amount,
      ]);


      $Title = $Title . $prc->title . ',';
    }

    $GetUrl = self::getCallbackUrl();


    echo "s^" . $order_id . "^" . $total . "^" . $Title . "^" . $address->name . "^" . $address->phone . "^" . $address->email . "^" . $GetUrl . "^" . $Txn . "^s";

    // return view('gateway')->with(['order_id' => $order_id,'amount'=>$total,'productinfo'=>$Title,'name'=>$address->name,'phone'=>$address->phone,'email'=>$address->email,'getCallbackUrl'=>$GetUrl,'address'=>$address->address,'city'=>$address->city,'state'=>$address->state]);
  }




  function Generate_hash(Request $r)
  {

    $data = $r->all();



    $hash = hash('sha512', $data['key'] . '|' . $data['txnid'] . '|' . $data['amount'] . '|' . $data['pinfo'] . '|' . $data['fname'] . '|' . $data['email'] . '|||||' . $data['udf5'] . '||||||' . $data['salt']);
    $json = array();
    $json['success'] = $hash;
    echo  $hash;
  }


  function getCallbackUrl()
  {
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];





    return url('gateway-response');
  }



  function Gateway_Response(Request $r)
  {

    if ($r->status == 'success') {
      cart::destroy();
      $order = DB::table('order_status')->where('status_name', 'Purchased')->first();
      $order_status = $order->order_status_id;
      DB::table('order')->where('transaction_id', $r->txnid)->update(['payment_status' => 1, 'order_status_id' => $order_status]);
      $data = DB::table('order')->where('transaction_id', $r->txnid)->first();
      
        $Table ='You have received a new order from a expertbells.com. Please click below link for order information <a href="'.url('control-panel/order-details/'.$data->id).'">'.url('control-panel/order-details/'.$data->id).'</a>';
        Helper::MailHtml($Table,'',Helper::ProjectMailToEmail(),'You have received a new inquiry');

      return view('thankyou')->with(['transaction_id' => $r->txnid, 'message' => $r->txnMessage]);
    } else {
      DB::table('order')->where('transaction_id', $r->txnid)->update(['payment_status' => 2]);

      return view('sorry')->with(['transaction_id' => $r->txnid, 'message' => $r->txnMessage]);
    }
  }



  function Product($Alias = null)
  {

    if (empty($Alias)) {
      $meta = DB::table('page_section')->where('id', 51)->first();
      $data = DB::table('cms_pages')->whereIn('id', array(20, 21, 22))->get();

      return view('project')->with(['meta' => $meta, 'data' => $data]);
    } else {
      $meta = DB::table('page_section')->where('slug', $Alias)->first();
      $data = DB::table('cms_pages')->whereIn('alias', array($Alias))->first();

      return view('project-detail')->with(['meta' => $meta, 'data' => $data]);
    }
  }



  function my_account()

  {

    $order_count = DB::table('order')->join('order_status', 'order_status.order_status_id', 'order.order_status_id')
      ->where('user_id', Auth::user()->id)
      ->where('status', 1)
      ->count();

    return view('my-account')->with(['order_count' => $order_count]);
  }


  function order(){
    $order_arr = DB::table('order')->where(array('user_id' => Auth::user()->id, 'status' => 1))->get();
    foreach ($order_arr as $order) { $order_id[] = $order->id; }
    
    if (empty($order_id)) { $orderId = 0;
    }else{$orderId = $order_id;}
    
    return view('order')->with(['order_id' => $orderId]);
  }

  function order_cancel(Request $request){
    $order_status = DB::table('order_status')->where('status_name', 'Cancelled')->first();
    $order_status_id = $order_status->order_status_id;
    date_default_timezone_set('Asia/Kolkata');
    $current_date = date('Y-m-d H:i:s');
    DB::table('order')->where('id', $request->id)
      ->update([
        'order_status_id' => $order_status_id,
        'cancel_date' => $current_date,
      ]);
    return redirect()->back()->with(['success_msg' => 'Order Cancelled Successfully']);
  }

  function order_detail(Request $request)

  {
    $order = DB::table('order')
      ->join('order_status', 'order_status.order_status_id', 'order.order_status_id')
      ->where('order.id', $request->id)
      ->first();

    $order_detail = DB::table('order_details')
      ->where('order_id', $request->id)
      ->get();
    $number_of_products = count($order_detail);
    return view('order-detail', compact('order', 'order_detail', 'number_of_products'));
  }

  function account_setting()
  {

    $user = DB::table('users')->where('id', Auth::user()->id)->first();

    return view('account-setting')->with(['user' => $user]);
  }




  public function update_account(Request $request)
  {

    $old_password = $request->input('old_password');
    $password = $request->input('password');
    $cpassword = $request->input('cpassword');
    $first_name = $request->input('first_name');
    $last_name = $request->input('last_name');
    $phone = $request->input('phone');
    $dob = $request->input('dob');
    $gender = $request->input('gender');
    $subscription = $request->input('subscription');

    if (!empty($password)) {

      $validator = $this->validate($request, [
        'old_password' => 'required',
        'password' => 'required',
        'cpassword' => 'required',

      ], [
        'old_password.required' => ' The Current Password field is required.',
        'password.min' => ' The Current Password field is required.',
        'cpassword.required' => ' The Confirm Password field is required.',
      ]);


      $get_pass = DB::table('users')->where('id', Auth::user()->id)->get();
      foreach ($get_pass as $data) {
        $db_password = $data->password;
      }

      if (Hash::check($old_password, $db_password)) {
        if ($password == $cpassword) {
          DB::table('users')->where('id', Auth::user()->id)->update(['password' => bcrypt($password), 'first_name' => $first_name, 'last_name' => $last_name, 'phone' => $phone, 'dob' => $dob, 'gender' => $gender, 'subscription' => $subscription]);
          return redirect()->back()->with(array(
            'success_msg' => 'Account details successfully updated.'
          ));
        } else {
          return redirect()->back()->with(array(
            'error_msg' => 'Both passwords does not match.'
          ));
        }
      } else {
        return redirect()->back()->with(array(
          'error_msg' => 'Old password does not match.'
        ));
      }
    } else {

      DB::table('users')->where('id', Auth::user()->id)->update(['first_name' => $first_name, 'last_name' => $last_name, 'phone' => $phone, 'dob' => $dob, 'gender' => $gender, 'subscription' => $subscription]);
      return redirect()->back()->with(array(
        'success_msg' => 'Account details successfully updated.'
      ));
    }
  }




  function upload_documents()

  {
    $user_documents = DB::table('user_document')->where('user_id', Auth::user()->id)->get();
    return view('upload-documents', compact('user_documents'));
  }

  function review_and_ratings(){
      $lists = DB::table('testimonial')->where('user_id',Auth::user()->id)->orderby('id','DESC')->get();
    return view('review-and-ratings',compact('lists'));
  }



  public function add_review(Request $request)
  {

    $request->validate([
      'name' => 'required',
      'email' => 'required|email',
      'message' => 'required|max:250',
      'rating' => 'required',
    ]);
    $name = $request->input('name');
    $email = $request->input('email');
    $message = $request->input('message');
    $rating = $request->input('rating');
    if ($request->image) {
      $Image = $request->image;
      $filename = Helper::sizeImage('/assets/uploads/testimonials/', 100, 100, $Image);
    } else {
      $filename = null;
    }
    DB::table('testimonial')->insert([
      'title' => $name,
      'content' => $message,
      'designation' => $email,
      'rating' => $rating,
      'status' => 0,
      'user_id' => !empty(Auth::user()->id)?Auth::user()->id:0,
      'image' => $filename,
    ]);

    return redirect()->back()->with(array('success_msg' => 'Review added successfully.'));
  }


  function Contact()

  {

    $meta = DB::table('page_section')->where('id', 46)->first();
    $data = DB::table('cms_pages')->where('id', 30)->first();

    return view('contact-us')->with(['meta' => $meta, 'data' => $data]);
  }





  function About()

  {
    $meta = DB::table('page_section')->where('id', 47)->first();
    $data = DB::table('cms_pages')->where('id', 24)->first();
    return view('about-us')->with(['meta' => $meta, 'data' => $data]);
  }



  function Property_Management()
  {
    $meta = DB::table('page_section')->where('id', 48)->first();
    $data = DB::table('cms_pages')->where('id', 19)->first();
    return view('property-management')->with(['meta' => $meta, 'data' => $data]);
  }



  function Gallery()
  {
    $meta = DB::table('page_section')->where('id', 49)->first();
    $data = DB::table('gallery')->where('status', 1)->get();
    return view('media')->with(['meta' => $meta, 'data' => $data]);
  }




  function Team()
  {
    $meta = DB::table('page_section')->where('id', 50)->first();
    $data = DB::table('testimonial')->where('status', 1)->get();
    return view('team')->with(['meta' => $meta, 'data' => $data]);
  }

  function user_documents_save(Request $request)
  {
    $user_id = Auth::user()->id;
    if ($request->document) {
      $request->validate([
        'document[]' => 'mimes:pdf,jpeg,jpg,png|max:10000',
      ]);
      foreach ($request->document as $docs) {
        $extention = $docs->getClientOriginalExtension();
        $filename = rand(0, 9999) . '.' . $extention;
        $docs->move('resources/assets/uploads/user-documents/', $filename);
        $db = $filename;
        DB::table('user_document')->insert([
          'document' => $db,
          'user_id' => $user_id,
        ]);
      }
    }
    return redirect()->back()->with(['success_msg' => 'Documents Uploaded']);
  }
  function user_documents_update(Request $request)
  {
    $request->validate([
      'document_name' => 'required|max:250',
    ]);
    DB::table('user_document')->where('id', $request->id)
      ->update([
        'document_name' => $request->document_name,
      ]);
    return redirect()->back()->with(['success_msg' => 'Documents Name Change']);
  }

  function document_delete(Request $request)
  {
    DB::table('user_document')->where('id', $request->id)->delete();
    return redirect()->back()->with(['success_msg' => 'Document Deleted Successfully']);
  }

  function document_verify(Request $request)
  {
    DB::table('user_document')->where('id', $request->id)->update([
      'status' => 1,
    ]);
    return redirect()->back()->with(['success_msg' => 'Document Verified Successfully']);
  }

  function document_reject(Request $request)
  {
    DB::table('user_document')->where('id', $request->id)->update([
      'status' => 2,
    ]);
    return redirect()->back()->with(['success_msg' => 'Document Rejected Successfully']);
  }

  function download_invoice(Request $request)
  {
    $order = DB::table('order')
      ->join('order_status', 'order_status.order_status_id', 'order.order_status_id')
      ->where('order.id', $request->id)
      ->first();

    $order_detail = DB::table('order_details')
      ->where('order_id', $request->id)
      ->get();
    $number_of_products = count($order_detail);
    $customer = DB::table('users')
      ->where('id', Auth::user()->id)
      ->first();
    $company = DB::table('setting')->where('Id', 1)->first();

    $InvoiceNo = "EBOR" . date("Ym", strtotime($order->date)) . $order->id;

    $pdf = PDF::loadView('invoice', compact('order', 'order_detail', 'number_of_products', 'customer', 'company', 'InvoiceNo'));
    return $pdf->download($InvoiceNo . '.pdf');
    //return view('invoice', compact('order', 'order_detail', 'number_of_products', 'customer', 'company', 'InvoiceNo'));
  }
}
