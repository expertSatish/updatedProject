<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use URL;
use Auth;
use Hash;
use Session;
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
    protected $redirectTo = '/control-panel/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest.admin', ['except' => 'logout']);
    }
    
    public function getLogout()
{
    Session::flash('success_msg', 'You have been logged out!');
    return $this->logout();
}

    public function showLoginForm()
    {
        return view('control-panel.auth.login');
    }
	
	public function logout()
{
    Auth::logout();
    Session::flush();
    return redirect('/control-panel/')->with(array(
			'success_msg' => 'You have been logged out!.'
		));
}

/**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
	public function admin_login(Request $request)
	{
	$email = $request->input('email');
	$password = $request->input('password');
	$email_count = DB::table('admins')->where('email', $email)->count();
	
	if(empty($email) AND empty($password))
	{
		return redirect()->back()->with(array(
			'error_msg' => 'Email OR Password should not be empty.'
		));
	}
	else
	{
	if ($email_count == 1)
		{
    		$get_pass = DB::table('admins')->where('email', $email)->get();
    		
    		
    		foreach($get_pass as $data)
    			{
    			  $db_password = $data->password;
    			  $Loginstatus = $data->status;
    			}
    
        
          if($Loginstatus > 0)
           {
              
          
    		if (Hash::check($password, $db_password))
    			{
    			//$random_data = Str::random(8);
    			
    			if (Auth::guard('admins')->attempt(['email' => $email, 'password' => $password]))
    				{
                            
                   
    
        				return redirect('/control-panel/dashboard/');
    				
    				}
    			}
    		  else
    			{
    			return redirect('/control-panel/')->with(array(
    				'error_msg' => 'Password does not match.','email' => $email
    			));
    			}
           }
         else
           {
               return redirect()->back()->with(array( 'error_msg' => 'Sorry! This Account Deactivate.' ));
           }
		}
	  else
		{
		    return redirect()->back()->with(array( 'error_msg' => 'Email not registered.' ));
		}
	}

	// return redirect()->back()->with(array('success_msg'=>'correct Updated.'));

	}

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admins');
    }
}
