<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\SocialMedia;

use Auth;

use Helper;

use Image;

class SocialMediaController extends Controller{ 

    public function __construct(){

        $this->middleware('auth:admin');

    }



    public function index(){

        $lists = SocialMedia::orderBy('id','DESC')->paginate(10);

        $platforms=array('facebook'=>'Facebook','youtube'=>'Youtube','linkedin'=>'Linkedin','twitter'=>'Twitter','instagram'=>'Instagram');

        return view('admin.social-media',compact('lists','platforms'));

    }



    public function Remove(Request $r){

        $Data = SocialMedia::find($r->removeId)->delete();

        return back()->with('success', 'Data have been remove successfully.');

    }



    public function Save(Request $r){

        $validated = $r->validate([

                'platform' => 'required',

                'link' => 'required|url',

            ]);

        $Data = new SocialMedia();

        $Data->title = $r->platform;

        $Data->link = $r->link;

        $Data->save();

        return back()->with('success', 'Data have been saved successfully.');

    }



    public function Update(Request $r){

        $validated = $r->validate([

            'edit_platform' => 'required',

            'edit_link' => 'required|url',

        ]);



        $Data = SocialMedia::find($r->editId);

        $Data->title = $r->edit_platform;

        $Data->link = $r->edit_link;

        $Data->save();

        return back()->with('success', 'Data have been updated!');

    }



    public function Status($Status,$Id){

        SocialMedia::where('id',$Id)->update(['status'=>$Status]);

        return back()->with('success', 'Status has been updated!');

    }



}

