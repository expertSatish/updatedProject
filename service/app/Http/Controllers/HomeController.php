<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper as Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\SaveFormController;
use App\ConsultancyModel;
use App\OnlinePayment;
use App\BlogComment;
use Carbon\Carbon;
use OilBanner;
use Sendgrid;
use Helper;
use Image;
use Auth;
use Mail;
use Cart;

class HomeController extends Controller{
    
    function index(){
        $meta = DB::table('page_section')->where('id', 45)->first();
        $data = DB::table('cms_pages')->whereIn('id', array(20, 21, 22))->get();
        $tax = DB::table('tax')->where('top_status', 1)->where('status', 1)->first();
        $blog_post = DB::table('blog_post')->where('post_status', 1)->latest()->paginate(7);
        $category1 = DB::table('nav_category')->where('parent', 0)->where('level', 1)->get();
        $plan_heading = DB::table('heading')->where('heading_id', 1)->where('page', 'homepage')->first();
        $reason_heading = DB::table('heading')->where('heading_id', 3)->where('page', 'homepage')->first();
        $blog_heading = DB::table('heading')->where('heading_id', 4)->where('page', 'homepage')->first();
        $client_heading = DB::table('heading')->where('heading_id', 5)->where('page', 'homepage')->first();
        $taxes = DB::table('tax')
            ->where('status', 1)
            ->where('home_status', 1)
            ->orderBy('id', 'DESC')
            ->get();


        $plans = DB::table('nav_category')
            ->where('home_status', 1)
            ->where('status', 1)
            ->get();

        $price = array();
        foreach ($plans as $i) {

            $data = DB::table('pricing')
                ->where('category_id', $i->id)
                ->orderBy('amount', 'ASC')
                ->select('currency', 'amount')
                ->first();

            $currency = '';
            $amount = '';

            if (!empty($data->amount)) {

                $currency = $data->currency;
                $amount = $data->amount;
            }

            $price[] = array('amount' => $amount, 'currency' => $currency, 'data' => $i);
        }
        
      

        $AboutUs = DB::table('cms_pages')->where(['id' => 24])->first();
        $str = $AboutUs->title;
        $data = Helpers::TwoColor($str);
        $data1 = $data[0];
        $data2 = $data[1];

        $str = $plan_heading->title;
        $data = Helpers::TwoColor($str);
        $plan1 = $data[0];
        $plan2 = $data[1];

        $str = $reason_heading->title;
        $data = Helpers::TwoColor($str);
        $reason_heading1 = $data[0];
        $reason_heading2 = $data[1];

        return view('home')->with([
            'meta' => $meta, 'data' => $data, 'blog_post' => $blog_post, 'category1' => $category1, 'taxes' => $taxes, 'plans' => $plans, 'price' => $price,
            'tax' => $tax, 'plan_heading' => $plan_heading, 'reason_heading' => $reason_heading, 'blog_heading' => $blog_heading, 'client_heading' => $client_heading,
            'data1' => $data1, 'data2' => $data2, 'AboutUs' => $AboutUs, 'plan1' => $plan1, 'plan2' => $plan2, 'reason_heading1' => $reason_heading1,
            'reason_heading2' => $reason_heading2
        ]);
    }

    function service($alias=null)
    {
        if(empty($alias)){
            $services = DB::table('nav_category')->where(['status'=>1,'level'=>1,'menu_status'=>1])->orderby('title','ASC')->get();
            $Result='<ul>';
            foreach($services as $service){
                $Child = $this->getServiceChild($service);
                $Result .= '<li>
                                <a href="javascript:void(0);">
                                    <h2 class="h5 m-0">'.$service->title.'</h2>
                                    '.$Child.'
                                </a>
                            </li>';
            }
            $Result .='</ul>';
            
            $services2 = DB::table('nav_category')->where(['status'=>1,'level'=>1])->orderby('title','ASC')->get();
            $Result2='<ul>';
            foreach($services2 as $service2){
                $Child2 = $this->getServiceChild2($service2);
                $Result2 .= '<li>
                                <a href="javascript:void(0);">
                                    <h2 class="h5 m-0">'.$service2->title.'</h2>
                                    <ul>'.$Child2.'</ul>
                                </a>
                            </li>';
            }
            $Result2 .='</ul>';
            $meta = DB::table('page_section')->where('id', 56)->first();
            return view('all-service',compact('services','Result','Result2','meta'));
        }else{
            $nav_id = DB::table('nav_category')->where('alias', $alias)->first();
            if(empty($nav_id)){ abort(404);}
            $id = $nav_id->id;
            $process_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 1)->first();
            $advantages_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 2)->first();
            $documents_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 3)->first();
            $pre_requirement_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 4)->first();
            $annual_roc_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 5)->first();
            $pricing_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 6)->first();
            $faq_heading = DB::table('nav_heading')->where('category_id', $id)->where('role', 7)->first();
            $pre_requirment_list_heading = DB::table('pre_requirement_heading')->where('category_id', $id)->first();
            return view('service', compact('id', 'process_heading', 'advantages_heading', 'documents_heading', 'pre_requirement_heading', 'annual_roc_heading', 'pricing_heading', 'faq_heading', 'pre_requirment_list_heading'));
        }
    }
    
    function getServiceChild($Service){
        $services = DB::table('nav_category')->where(['status'=>1,'level'=>$Service->level+1,'parent'=>$Service->id,'menu_status'=>1])->orderby('title','ASC')->get();
        $Result='<ul>';
        foreach($services as $service){
            $Child = $this->getServiceChild($service);
           
                if($service->level<3){
                    $Result .= '<li>
                                <a href="javascript:void(0);">
                                    <strong>'.$service->title.'</strong>
                                    '.$Child.'
                                </a>
                            </li>';
                }else{
                    $Result .= '<li>
                                    <a href="'.url('service/'.$service->alias).'">'.$service->title.'
                                        '.$Child.'
                                    </a>
                                </li>';
                }
           
        }  
        $Result .='</ul>';
        return $Result;
    }
    
    function getServiceChild2($Service){
        if($Service->level==1){
            $services = DB::table('nav_category')->where(['status'=>1,'level'=>$Service->level+1,'parent'=>$Service->id,'menu_status'=>1])->orderby('title','ASC')->get();
        }else{
            $services = DB::table('nav_category')->where(['status'=>1,'level'=>$Service->level+1,'parent'=>$Service->id,'menu_status'=>0])->orderby('title','ASC')->get();
        }
        $Result ='';
          
            foreach($services as $service){
                
                    $Child = $this->getServiceChild2($service);
                  
                    
                        if($service->level<3){
                            if(!empty($Child)){
                                $Result .= '<li>
                                        <a href="javascript:void(0);">
                                            <strong>'.$service->title.'</strong>
                                            <ul>'.$Child.'</ul>
                                        </a>
                                    </li>';
                            }
                            
                        }else{
                            $Result .= '<li>
                                            <a href="'.url('service/'.$service->alias).'">'.$service->title.'
                                                <ul>'.$Child.'</ul>
                                            </a>
                                        </li>';
                        }
                  
                        
                   
            }  
           
       
        return $Result;
    }


    function add_cart($price)
    {
        echo Cart::count();
        //Cart::add('293ad', 'Product 1', 1, $price);
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


    function Contact()

    {

        $meta = DB::table('page_section')->where('id', 46)->first();
        $data = DB::table('cms_pages')->where('id', 30)->first();

        return view('contact-us')->with(['meta' => $meta, 'data' => $data]);
    }


    public function add_contact(Request $request){

        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subject = $request->input('subject');
        $message = $request->input('message');

        $validator = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
        ], [
            'name.required' => ' The Name field is required.',
            'email.required' => ' The Email field is required.',
            'subject.required' => ' The Subject field is required.',

        ]);

        $id = DB::table('contact_enquiry')->insertGetId([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,

        ]);
        Helper::MailHtml(Helper::CustomerMailSMS(),$name,$email,'Thank you for contact with us');
            
            $Table ='You have received a new inquiry from a expertbells.com.below are customer contact details.<br>';
            $tabcon = new SaveFormController();
            $Table .= $tabcon->Table($request->all());
            Helper::MailHtml($Table,'',Helper::ProjectMailToEmail(),'You have received a new inquiry');
        return redirect('/thank-you')->with(array('success_msg' => 'Form submitted successfully, We’ll get back to you soon.'));
    }

    function About()

    {
        $meta = DB::table('page_section')->where('id', 47)->first();
        $data = DB::table('cms_pages')->where('id', 24)->first();
        $promoter = DB::table('promoter')->where('status', 1)->get();
        return view('about-us')->with(['meta' => $meta, 'data' => $data, 'promoter' => $promoter]);
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

    public function terms_and_conditions(Request $request)
    {
        $meta = DB::table('page_section')->where('id', 52)->first();
        $data = DB::table('cms_pages')->where('id', 20)->first();
        return view('terms-and-conditions', ['data' => $data, 'meta' => $meta]);
    }

    public function privacy_policy(Request $request)
    {
        $meta = DB::table('page_section')->where('id', 54)->first();
        $data = DB::table('cms_pages')->where('id', 21)->first();
        return view('privacy-policy', ['data' => $data, 'meta' => $meta]);
    }

    public function refund_policy(Request $request)
    {
        $meta = DB::table('page_section')->where('id', 55)->first();
        $data = DB::table('cms_pages')->where('id', 22)->first();
        return view('refund_policy', ['data' => $data, 'meta' => $meta]);
    }
    public function career(Request $request)
    {
        $meta = DB::table('page_section')->where('id', 48)->first();
        $data = DB::table('cms_pages')->where('id', 19)->first();
        $we_are_friendly = DB::table('cms_pages')->where('id', 56)->first();
        $on_time_payment = DB::table('cms_pages')->where('id', 57)->first();
        $on_time_growth = DB::table('cms_pages')->where('id', 58)->first();
        return view('career', ['data' => $data, 'meta' => $meta, 'we_are_friendly' => $we_are_friendly, 'on_time_payment' => $on_time_payment, 'on_time_growth' => $on_time_growth]);
    }

    public function career_enquiry_save(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits:10',
            'subject' => 'required|max:255',
            'message' => 'required',
            'file' => 'required|mimes:docx,doc,pdf|max:2048',
        ]);
        if ($request->file) {
            $file = $request->file('file');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('resources/assets/uploads/career/', $filename);
            $db = $filename;
        }
        DB::table('career_enquiry')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'file' => $db,
        ]);
        $Table ='You have received a new career inquiry from a expertbells.com. below are candidate contact details.<br>';
        $tabcon = new SaveFormController();
        $Table .= $tabcon->Table($request->all());
        Helper::MailHtml($Table,'',Helper::ProjectMailToEmail(),'You have received a new career inquiry');
            
        return redirect('/thank-you')->with(['success_msg' => 'Resume Sent Successfully']);
    }

    public function about_us(Request $request)
    {
        $data = DB::table('cms_pages')->where('id', 24)->first();
        $meta = DB::table('page_section')->where('id', 47)->first();
        return view('about-us', ['data' => $data, 'meta' => $meta]);
    }

    public function online_payment(Request $request)
    {
        return view('online-payment');
    }

    public function online_payment_save(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|max:255',
        //     'amount' => 'required|max:255',
        //     'email' => 'required|email|max:255',
        //     'contact' => 'required',
        //     'message' => 'required',
        // ]);

        $Name = $request->name;
        $Amount = $request->amount;
        $Email = $request->email;
        $Mobile = $request->contact;
        $Message = $request->message;

        $data = OnlinePayment::create([
            'name' => $Name,
            'amount' => $Amount,
            'email' => $Email,
            'contact' => $Mobile,
            'message' => $Message,
        ]);

        $SuccessUrl = url("/online-payment-response");
        $PaymentId = $data->online_payment_id;
        $Tax = 'Tax' . date('Ym')
            . $PaymentId;
        OnlinePayment::where('online_payment_id', $data->online_payment_id)
            ->update([
                'tranx_id' => $Tax,
            ]);

        echo "s^" . $Name . "^" . $Amount . "^" . $Email . "^" . $Mobile . "^" . $SuccessUrl . "^" . $Tax . "^" . $PaymentId . "^s";

        // return view('gateway2', compact('data'));
    }

    public function online_payment_response(Request $request)
    {
        $status = $request->status;
        $transaction_message = $request->txnMessage;
        $transaction_status = $request->txnStatus;
        $trans_id = $request->txnid;
        if ($status == 'success') {
            OnlinePayment::where('tranx_id', $trans_id)
                ->update([
                    'payment_status' => 1,
                    'transaction_message' => $transaction_message,
                ]);
            return redirect('/online-payment')->with(['success_msg' => $transaction_message]);
        } else {
            OnlinePayment::where('tranx_id', $trans_id)
                ->update([
                    'payment_status' => 0,
                    'transaction_message' => $transaction_message,
                ]);
            return redirect('/online-payment')->with(['error_msg' => $transaction_message]);
        }
    }

    public function blog(Request $request)
    {
        $blog_post = DB::table('blog_post')->where('post_status', 1)->orderby('post_id','DESC')->get();
        $meta = DB::table('page_section')->where('id', 49)->first();
        return view('blog', ['blog_post' => $blog_post, 'meta' => $meta]);
    }

    public function blog_detail(Request $request)
    {
        $detail = DB::table('blog_post')->where('post_alias', $request->alias)->first();
        $latest_post = DB::table('blog_post')->orderBy('post_id', 'desc')->take(5)->get();
        $category = DB::table('blog_category')->orderBy('cate_id', 'asc')->get();
        $comments = BlogComment::where(['status'=>1,'blog_id'=>$detail->post_id])->get();
        $month_year = DB::table('blog_post')
            ->select('post_month', 'post_mapped_id')
            ->groupBy('post_month')
            ->orderby('post_date','DESC')
            ->get();
        return view('blog-detail', ['detail' => $detail, 'latest_post' => $latest_post, 'category' => $category, 'month_year' => $month_year, 'comments' => $comments]);
    }

    public function category_wise_blog_post(Request $request)
    {
        $blog_post = DB::table('blog_post')
            ->where('post_mapped_id', $request->id)
            ->get();
        $meta = DB::table('page_section')->where('id', 49)->first();
        return view('blog', ['blog_post' => $blog_post, 'meta' => $meta]);
    }

    public function month_wise_post(Request $request)
    {
        $blog_post = DB::table('blog_post')
            ->where('post_month', $request->month)
            ->get();
        $meta = DB::table('page_section')->where('id', 49)->first();
        return view('blog', ['blog_post' => $blog_post, 'meta' => $meta]);
    }

    public function comment_save(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required'
        ]);
        $data = BlogComment::create([
            'name' => $request->name,
            'blog_id' => $request->blog_id,
            'email' => $request->email,
            'comment' => $request->comment,
        ]);
        if ($data) {
            return redirect()->back()->with('success_msg', 'Comment Post Successfully');
        } else {
            return redirect()->back()->with('error_msg', 'Error Occurs During Posting a Comment');
        }
    }

    public function tax_detail(Request $request)
    {
        $taxes = DB::table('tax')
            ->where('alias', $request->alias)
            ->first();
        $taxes_list1 = DB::table('tax_list')
            ->where('tax_id', $taxes->id)
            ->where('list_for', 1)
            ->get();
        $taxes_list2 = DB::table('tax_list')
            ->where('tax_id', $taxes->id)
            ->where('list_for', 2)
            ->get();
        return view('taxes-for-individuals-and-businesses', compact('taxes', 'taxes_list1', 'taxes_list2'));
    }
    public function get_cities(Request $request)
    {
        $cities = DB::table('cities')
            ->where('state_id', $request->id)
            ->select('id', 'name')
            ->get();
        return $cities;
    }
    public function testimonial_list(Request $request)
    {
        $testimonials = DB::table('testimonial')->where('status', 1)->get();
        //$banner = DB::table('cms_pages')->where('id', 60)->first();
        $page_section = DB::table('page_section')->where('id', 50)->first();

        return view('testimonial', compact('testimonials', 'page_section'));
    }
    
    
    function Thank_You(){
        return view('enquiry-thanks');
    }
    public function form_save(Request $request)
    {
        $request->validate([
            'enquiry_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|min:10|max:10',
            // 'message' => 'required',
        ]);
        ConsultancyModel::create([
            'name' => $request->enquiry_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);
        $Table ='You have received a new career inquiry from a expertbells.com. below are customer contact details.<br>';
        $tabcon = new SaveFormController();
        $Table .= $tabcon->Table($request->all());
        Helper::MailHtml($Table,'',Helper::ProjectMailToEmail(),'You have received a new inquiry');
        return redirect('/thank-you')->with(['success_msg' => Helper::InstantEnquiryMSG()]);
    }
}
