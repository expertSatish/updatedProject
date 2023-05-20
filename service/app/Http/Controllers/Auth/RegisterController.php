<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use URL;
use Auth;
use Helper;
use Session;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    
     public function signup(Request $request)
		{
		return view('auth/signup');
		}
    
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
    
    
    
    		
		
  public function signup_account(Request $request){
    $first_name = $request->input('first_name');
    $last_name = $request->input('last_name');
	$email = $request->input('email');
    $password = $request->input('password');
	$phone = $request->input('phone');
    $validator=$this->validate($request,[
        'first_name' => 'required',
        'email' => 'required|unique:users|email',
        'phone' => 'required|numeric|unique:users',	
        'password' => 'required',
        'password_confirmation' => 'required|same:password',
        'terms' => 'required'
    ],[
          'first_name.required' => ' The First Name field is required.',
        'email.required' => ' The Email field is required.',
      'phone.required' => ' The Phone field is required.',
      'phone.unique' => ' The Phone field already exist.',
        'phone.numeric' => ' The Phone field must be numeric.',
    ]);
  
    $random_data = Str::random(8);
    $email_verification = Str::random(10);
    $id = DB::table('users')->insertGetId([
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'phone' => $phone,	
        'password' => bcrypt($password),	 
        'random_data' => $random_data, 
        'email_verification' => $email_verification, 
        'email_verification_status'=>1
    ]);

    
       self::EmailVerificationMail($email,$first_name.' '.$last_name,$email_verification);
     
    //   return redirect()->back()->with(array('success_msg'=>'Thank You for creating your account. We have sent a verification link on your Email ID, please click it to verify your Email ID.'));
        return redirect()->back()->with(array('success_msg'=>'Thank You for creating your account. you can login know.'));
    }
  

   function EmailVerificationMail($email,$name,$email_verification){
       $to = $email;
		$subject = "Email Verification Link";

		$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>' . Helper::ProjectName() . '</title>
		</head>
		<body style="margin:0" bgcolor="#f2f2f2">
		<style id="media-query">

		  </style>
		<table style="width: 100%;" cellpadding="0" cellspacing="0"  border="0">
		  <tbody>
		    <tr>
		      <td><table style="width:740px; margin:auto; background:#ddd;" cellpadding="0" cellspacing="0"  border="0">
		          <tbody>
		            <tr>
		              <td align="center" height="20" style="height:10px;">&nbsp;</td>
		            </tr>
		            <tr>
		              <td><table style="width:700px; margin:auto; background:#fff;" cellpadding="0" cellspacing="0"  border="0">
		                  <tbody>
		                    <tr>
		                      <td height="10">&nbsp;</td>
		                    </tr>
		                    <tr>
		                      <td><img style="display:block; margin:auto;width: 200px;" src="' . Helper::LOGOIMGURl(Helper::ProjectLOGO()) . '" /></td>
		                    </tr>
		                    <tr>
		                      <td height="10">&nbsp;</td>
		                    </tr>
		                    <tr>
		                      <td><table style="width:700px; padding:20px 20px 10px;  border-top:2px solid #ffc44b ;  border-bottom:2px solid #ffc44b ;  margin:auto; background:#fff;" cellpadding="0" cellspacing="0"  border="0">
		                          
		                             <tbody>
		                            <tr>
		                              <td colspan="2"><span style="margin:0; display:block; margin-bottom:30px; font:14px arial; color:#333; font-weight:bold">Dear '.$name.',</span>
		                                <h4 style="margin:0; font:13px arial; color:#848484;">Thank you for signup.</h4>
		                                <h6 style="margin:15px 0; font:bold 13px arial; color:#34b931;">Please click on below link for email verification</h6>
		                                
		                                
		                                
		                                <p style="margin-top:15px; font:12px arial; color:#848484;"><a href='.URL::to('/').'/email-verification/'.$email_verification.' target="_new">Click here for verification</a></p>
		                                                  
		                             <p style="margin-top:15px; font:12px arial; color:#848484;">If you have any concerns or questions please contact us at ' . Helper::ProjectMailEmail() . '</p>   
		                               
		                               
		                                <span style="margin:50px 0 10px 0; display:block; font:bold 13px arial; color:#808080;">Sincerely,</span> <span style="margin:10px 0  15px 0; display:block;  font:bold 13px arial; color:#808080;">The Expertbells Team</span></td>
		                            </tr>
		                            <tr>
		                              <td colspan="2"><p style="margin:0; text-align:left; padding:15px 0 2px  0px; font:12px arial; color:#848484; border-top:1px solid #d8d8d8;"><a style="font:13px arial; color:#848484; text-decoration:none;" href="#">Need Help ?</a></p>
		                                <p style="margin:0; text-align:left; padding:2px 0 10px 0px; font:12px arial; color:#848484;">Please feel free to contact us at <a style="font:13px arial; color:#848484; text-decoration:none;" href="emailto:' . Helper::ProjectMailEmail() . '">' . Helper::ProjectMailEmail() . '</a></p></td>
		                            </tr>
		                          </tbody>
		                        </table></td>
		                    </tr>
		                    
		                  </tbody>
		                </table></td>
		            </tr>
		            <tr>
		              <td align="center"><p style="font:13px arial; color:#848484; text-align:center; margin:0; padding:15px 0;">&copy; <a style="font:13px arial;
		color:#848484; text-decoration:none;" href="'.url('/').'">'.Helper::ProjectName().'</a></p></td>
		            </tr>
		          </tbody>
		        </table></td>
		    </tr>
		  </tbody>
		</table>
		</body>
		</html>
		';


		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// More headers
		$headers .= 'From:<noreply@expertbells.com>' . "\r\n";

		return mail($to,$subject,$message,$headers);
   }
    
    
    
    
    
}
