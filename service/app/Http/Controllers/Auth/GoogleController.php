<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use URL;
use Socialite;
class GoogleController extends Controller
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		 $this->redirectTo = URL::previous();
		 $user = Auth::user();
        $this->middleware('guest');
    }
	
	
	/**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider(Request $request)
    {
        session()->put('state', $request->input('state'));
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {
        session()->put('state', $request->input('state'));
      $user =   $user = Socialite::driver('google')->user();
	  
	  
	  $authUser = $this->findOrCreateUser($user);
	  
	   foreach($authUser as $key=>$value){
		  if($key=='email_verification_status'){
			  $email_verify_status = $value;
			  }
		  }
	  
	  if($email_verify_status==1)
	  {
	  
	   $request->session()->put('random_data', $authUser->random_data);
	   
	   Auth::loginUsingId($authUser->id, true);
        
        return redirect($this->redirectTo);
	  }
	  else
	  {
		 
		 //$request->session()->put('authUser', $authUser);
		  //return redirect('signup');
		   $authid = DB::table('users')->insertGetId(array(
		'name' => $authUser['name'], 
		'email' => $authUser['email'],
		'random_data' => $authUser['random_data'],
		'google_id' => $authUser['social_id'],
		'status' => 1, 
		'email_verification_status' => 1, 
		'register_status' => 1, 
		));
		 
		  Auth::loginUsingId($authid, true);
		   return redirect($this->redirectTo);
	  }


		
    }
	
	
	public function findOrCreateUser($user)
    {
		
        $random_data = str_random(8);
		
        $authUser = DB::table('users')->where('email', $user->email)->first(); 
		
		
		
        if ($authUser) {
            
             DB::table('users')
            ->where('id', $authUser->id)
            ->update([
                
		'random_data' => $random_data,
			]);
			
          $authUser = DB::table('users')->where('id', $authUser->id)->first(); 
           return $authUser;
        }
        
		 $authUser=array('name'=>$user->name,'email'=>$user->email,'social_role'=>'google','random_data'=>$random_data,'social_id'=>$user->id,'email_verification_status'=>0);
		 
		return $authUser;
		
    }
	
	
	
	
	
	
}
