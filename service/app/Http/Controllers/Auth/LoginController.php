<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use URL;
use Auth;
use Hash;
use Validator;
use Illuminate\Support\Str;
use Helper;
use Illuminate\Support\Facades\Session;
use Cart;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = URL::previous();

        $this->middleware('guest')->except('logout');
    }




    public function login(Request $request)
    {
        //session(['link' => url()->previous()]);
        return view('auth/login');
    }

    public function forgot_password(Request $request)
    {
        return view('auth/forgot-password');
    }

    public function logout(){
        Auth::logout();
        Cart::destroy();
        return  redirect('/login')->with(array('success_msg' => 'You are logout! thanks for coming!'));
    }

    public function email_verification(Request $request, $email_verification){
        $Counts = DB::table('users')->where('email_verification', $email_verification)->count();
        if($Counts>0){
            DB::table('users')->where('email_verification', $email_verification)->update(['email_verification_status' => 1 ]);
    		return redirect(url('login'))->with(array('success_msg' => 'Email has been successfully verified. you can login now.'));
        }else{
            return redirect(url('login'))->with(array('error_msg' => 'Sorry! this verification link is not correct.'));
        }
	    
	}
		


    public function login_account(Request $request){




        //echo 'dvbmbvm';exit;
        $email = $request->input('email');
        $password = $request->input('password');
        $terms = $request->input('terms');


    

        $email_count = DB::table('users')->where('email', $email)->count();
        if ($email_count == 1) {
            $get_pass = DB::table('users')->where('email', $email)->get();
            
            if($get_pass[0]->email_verification_status==0):
                return redirect()->back()->with(array('error_msg' => 'This account is not verify please click the link given on email to verify account!')); 
            endif;    
            
            foreach ($get_pass as $data) {
                $db_password = $data->password;
            }

            if (Hash::check($password, $db_password)) {
                $random_data = Str::random(8);



                DB::table('users')->where('email', $email)->update(['random_data' => $random_data]);
                if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])) {
                    if (Session::get('backurl') == null) {
                        return redirect(url('/'))->with(array(
                            'success_msg' => 'You have loggedin.',
                        ));
                    } else {
                        return redirect(url(Session::get('backurl')));
                    }
                } else {
                    return redirect()->back()->with(array(
                        'error_msg' => 'Sorry, Your account deactivate by admin.',
                        'email' => $email,
                    ));
                }
            } else {
                return redirect()->back()->with(array(
                    'error_msg' => 'Password does not match.',
                    'email' => $email,
                ));
            }
        } else {
            return redirect()->back()->with(array(
                'error_msg' => 'Sorry! Email not registered.'
            ));
        }





        // return redirect()->back()->with(array('success_msg'=>'correct Updated.'));

    }




    /*----------Reset password start--------------------*/

    public function Check_Email_Address(Request $request){
        $email = $request->input('Email');
        $get_email = DB::table('users')->where('email', $email)->count();
        // echo $get_email;
    }


    public function reset_pass(Request $request)
    {

        $email = $request->input('email');

        $Captch = $request->captcha;

        // if (Helper::CaptchaResponce($Captch) > 0) {

            $get_email = DB::table('users')->where('email', $email)->count();

            if ($get_email == 0) {
                return redirect()->back()->with(array(
                    'error_msg' => 'This email is not registered.Please choose a registred email address.'
                ));
            } else {

                $social_ids = DB::table('users')->select('facebook_id', 'google_id', 'first_name')->where('email', $email)->first();
                if (!empty($social_ids->first_name)) {
                    $name = $social_ids->first_name;
                }
                if (empty($social_ids->facebook_id) and empty($social_ids->google_id)) {

                    $password = Str::random(8);
                    DB::table('users')->where('email', $email)->update(['password' => bcrypt($password),]);
                    $to = $email;
                    $subject = "New Reset Password";
                    $break = explode(" ", $name);
                    if (count($break) > 0) {
                        $first = $break[0];
                    } else {
                        $first = $name;
                    }

                    $subject = 'Reset Password';
                    $message = 'Dear ' . $first . ',<br>
                                Your password has been reset.New Login Details:<br>
                                <table rules="none" cellpadding="5" cellspacing="5" border="0" style="width:100%; margin-left:-5px;">
                                    <tr>
                                      <td style="  font:13px arial; color:#848484;" width="130"> Email: </td>
                                      <td style="font:13px arial; color:#848484;" >' . $email . '</td>
                                    </tr>
                                    <tr>
                                      <td style=" font:13px arial; color:#848484;" width="130"> Password: </td>
                                      <td style=" font:13px arial; color:#848484;" >' . $password . ' </td>
                                    </tr>
                                </table><br>
                                Please update your password next time you login.';

                    $mailHTML = Helper::MailHtml($message,$first,$email,$subject);

                    // Helper::Sendgride_Mail($email, $first, $subject, $mailHTML);



                    return redirect()->back()->with(array(
                        'success_msg' => 'Password sent to your email address.'
                    ));
                } else {
                    return redirect()->back()->with(array(
                        'error_msg' => "You can't reset your account's password because you have login with your social account"
                    ));
                }
            }
        // } else {
        //     return redirect()->back()->with(array('error_msg' => 'Invaild Captcha. Please Try Again.'));
        // }
        /*-----------Reset password end-----------------------*/
    }
}
