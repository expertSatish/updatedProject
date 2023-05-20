<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Validator;

use Image;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class SocialiconController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth.admin');
    }
	
	
	public function index()
    {
		$social_icons = DB::table('social_icons')->where('id', 1)->get();
        return view('admin.update-social-icons')->with(array('social_icons'=>$social_icons));
    }
	
	public function edit_social_links(Request $request,$id)
    {
		
		 $facebook = $request->input('facebook');
		 $twitter = $request->input('twitter');
		 $instagram = $request->input('instagram');
		 $youtube = $request->input('youtube');
		 $pinterest = $request->input('pinterest');
		 $google = $request->input('google');
		 $reddit = $request->input('reddit');
		 $tumblr = $request->input('tumblr');
		 $email = $request->input('email');
		 $blog = $request->input('blog');
		 $linkedin = $request->input('linkedin');
  
		 DB::table('social_icons')
            ->where('id', $id)
            ->update([
			'facebook' => $facebook, 
		'twitter' => $twitter, 
		'instagram' => $instagram, 
		'youtube' => $youtube, 
		'pinterest' => $pinterest, 
		'google' => $google,
		'reddit' => $reddit, 
		'tumblr' => $tumblr, 
		'email' => $email, 
		'blog' => $blog,
                'linkedin' => $linkedin,
		
			]);
		 
		 return redirect()->back()->with(array('success_msg'=>'Links Updated.'));

    }
	
	
	
}
