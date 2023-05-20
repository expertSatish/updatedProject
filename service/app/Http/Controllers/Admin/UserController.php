<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Validator;

use Image;
use Helper;
use Hash;
use Auth;
use URL;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth.admin');
  }



  public function index()
  {
    $users = DB::table('users')->get();
    return view('admin.user-management')->with(array('users' => $users));
  }




  public function view_user_details($id)
  {
    $users =  DB::table('users')->where('id', $id)->get();
    return view('admin.view-user-details')->with(array('users' => $users));
  }


  public function delete_user($id)
  {

    DB::table('users')->where('id', $id)->delete();
    return redirect()->back()->with(array('success_msg' => Helper::removeMSG()));
  }


  public function change_user_status(Request $request, $status, $id)
  {


    DB::table('users')
      ->where('id', $id)
      ->update([
        'status' => $status,
      ]);

    return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
  }


  function AddUsers()
  {
    return view('admin.add-user')->with(array('flag' => false));
  }


  function UpdateUsers($id)
  {
    $users =  DB::table('users')->where('id', $id)->first();
    return view('admin.add-user')->with(array('Arr' => $users, 'flag' => true));
  }


  function Save_User(Request $r)
  {
    $Id = $r->Id;
    $Name = $r->Name;
    $Email = $r->Email;
    $Phone = $r->Phone;
    $Password = $r->Password;
    $Permission = $r->Permission;

    if ($Id > 0) {
      if ($Password != '') {
        $Data = array('name' => $Name, 'email' => $Email, 'mobile' => $Phone, 'password' => bcrypt($Password), 'permission' => $Permission,);
      } else {
        $Data = array('name' => $Name, 'email' => $Email, 'mobile' => $Phone, 'permission' => $Permission,);
      }


      $Query = DB::table('users')->where('id', $Id)->update($Data);

      $Message = array('success_msg' => Helper::updateMSG());
    } else {
      $Data = array('name' => $Name, 'email' => $Email, 'mobile' => $Phone, 'password' => bcrypt($Password), 'permission' => $Permission,);
      $Query = DB::table('users')->insert($Data);

      $Message = array('success_msg' => Helper::saveMSG());


      $to = $Email;
      $subject = "Registration with " . Helper::ProjectName();
      $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml">
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <title>' . Helper::ProjectName() . ' Mailer </title>
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
                                  <td><img style="display:block; margin:auto;" src="' . Helper::LOGOIMGURl(Helper::ProjectLOGO()) . '" /></td>
                                </tr>
                                <tr>
                                  <td height="10">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><table style="width:700px; padding:20px 20px 10px;  border-top:2px solid #033f79 ;  border-bottom:2px solid #033f79 ;  margin:auto; background:#fff;" cellpadding="0" cellspacing="0"  border="0">
                                      
                                        <tbody>
                                        <tr>
                                          <td colspan="2"><span style="margin:0; display:block; margin-bottom:30px; font:14px arial; color:#333; font-weight:bold">Dear ' . $Name . ',</span>
                                            <h4 style="margin:0; font:13px arial; color:#848484;">You are added by ' . Helper::ProjectName() . ' and your login details is : <br><br> <strong>Username :</strong> ' . $Email . '<br> <strong>Password :</strong> ' . $Password . '</h4>
                                                              
                                        <p style="margin-top:15px; font:12px arial; color:#848484;">If you have any concerns or questions please contact us at ' . Helper::ProjectMailEmail() . '</p>   
                                          
                                          
                                            <span style="margin:50px 0 10px 0; display:block; font:bold 13px arial; color:#808080;">Sincerely,</span> <span style="margin:10px 0  15px 0; display:block;  font:bold 13px arial; color:#808080;">The ' . Helper::ProjectName() . ' Team</span></td>
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
            color:#848484; text-decoration:none;" href="#">' . Helper::ProjectName() . '</a></p></td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
              </tbody>
            </table>
            </body>
            </html>';


      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

      // More headers
      $headers .= 'From:' . Helper::ProjectMailEmail() . "\r\n";

      mail($to, $subject, $message, $headers);
    }


    if ($Query) {
      return redirect()->back()->with($Message);
    } else {
      return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
    }
  }

  public function change_admin_account(Request $request, $id)
  {

    $email = $request->input('email');

    $password = $request->input('password');
    $cpassword = $request->input('cpassword');

    $get_pass =  DB::table('admins')->where('id', $id)->get();

    if ($password == "") {

      DB::table('admins')
        ->where('id', $id)
        ->update([
          'email' => $email,
        ]);

      return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
    } else {

      if ($password == $cpassword) {

        DB::table('admins')
          ->where('id', $id)
          ->update([
            'email' => $email,
            'password' => bcrypt($password),
          ]);

        return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
      } else {
        return redirect()->back()->with(array('success_msg' => 'Both passwords does not match.'));
      }
    }
  }





  public function reviews($id)
  {

    $reviews =  DB::table('reviews')->where('user_id', $id)->orderBy('id', 'desc')->get();
    return view('admin.reviews')->with(array('reviews' => $reviews, 'user_id' => $id));
  }


  public function change_review_status(Request $request, $status, $id)
  {


    DB::table('reviews')
      ->where('id', $id)
      ->update([
        'status' => $status,
      ]);

    return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
  }


  public function set_review_home(Request $request, $status, $id)
  {


    DB::table('reviews')
      ->where('id', $id)
      ->update([
        'home_status' => $status,
      ]);

    return redirect()->back()->with(array('success_msg' => Helper::updateMSG()));
  }


  public function view_review_images($user_id, $id)
  {

    $review_images =  DB::table('review_images')->where('review_id', $id)->get();
    return view('admin.review-images')->with(array('reviews' => $review_images, 'user_id' => $user_id));
  }




  public function delete_review_image($id)
  {
    $review_images =  DB::table('review_images')->select('image')->where('id', $id)->first();

    if (!empty($review_images)) {
      if (file_exists(resource_path('/assets/uploads/review/' . $review_images->image))) {
        unlink(resource_path('/assets/uploads/review/' . $review_images->image));
      }
    }
    DB::table('review_images')->where('id', $id)->delete();
    return back()->with(array('success_msg' => Helper::removeMSG()));
  }


  public function delete_review($id)
  {
    $review_images =  DB::table('reviews')->select('profile')->where('id', $id)->first();


    if (!empty($review_images)) {
      if (file_exists(resource_path('/assets/uploads/review/' . $review_images->profile))) {
        unlink(resource_path('/assets/uploads/review/' . $review_images->profile));
      }
    }
    DB::table('reviews')->where('id', $id)->delete();
    return back()->with(array('success_msg' => Helper::removeMSG()));
  }


  public function ShowReviewDetail(Request $request)
  {
    $id = $request->input('ID');

    $Query = DB::table('reviews')->where('id', $id)->first();
    $formdata = '';
    $formdata .= '<table class="table">
                        <tr>
                            <th class="hd-tbbrd"> Name: </th>
                            <td class="hd-tbbrd">' . $Query->name . '</td>
                            <td class="hd-tbbrd"><img src="' . asset('resources/assets/uploads/review/' . $Query->profile) . '" class="img-mg" style="width:40%!important;"></td>
                        </tr>
                        
                        <tr>
                            <th> Email: </th>
                            <td colspan="2">' . $Query->email . '</td>
                        </tr>
                        
                        <tr>
                            <th> Subject: </th>
                            <td colspan="2">' . $Query->title . '</td>
                        </tr>
                        
                        <tr>
                            <th> Location: </th>
                            <td colspan="2">' . $Query->location . '</td>
                        </tr>
                
                        <tr>
                            <th> Message: </th>
                            <td colspan="2">' . $Query->content . '</td>
                        </tr>
                     </table>';


    echo $formdata;
  }



  public function User_Verified($Status, $id)
  {

    $Data  = array('email_verification_status' => $Status);

    if (DB::table('users')->where('id', $id)->update($Data)) {

      if ($Status == 1) {
        $MSG = "Your account at " . Helper::ProjectName() . " has been approved, Please login at this link to access your account.<br><br> <a href=" . url('login') . ">Login Here</a>";

        $Subject = "Congratulations! Your account has been approved at " . Helper::ProjectName();
      } else {
        $MSG = "Your sign up request at " . Helper::ProjectName() . " has been rejected. Thank you for showing interest in our services.";
        $Subject = "We`re sorry, Your account could not be approved: " . Helper::ProjectName();
      }


      $Users = DB::table('users')->where('id', $id)->first();


      Helper::SendMailWithSubj($Users->name, $Users->email, $Subject, $MSG);

      return back()->with(array('success_msg' => Helper::updateMSG()));
    } else {
      return back()->with(array('error_msg' => Helper::errorMSG()));
    }
  }

  public function user_list(Request $request)
  {
    $users = DB::table('users')->paginate(10);
    return view('control-panel.users.user-list', ['users' => $users]);
  }

  public function user_status(Request $request)
  {
    $user = DB::table('users')->where('id', $request->id)->first();
    $status = $user->status;
    if ($status == 0) {
      DB::table('users')
        ->where('id', $request->id)
        ->update([
          'status' => 1
        ]);
    } else {
      DB::table('users')
        ->where('id', $request->id)
        ->update([
          'status' => 0
        ]);
    }
    return redirect('/control-panel/user-list')->with('success_msg', 'Status Change');
  }

  public function user_delete(Request $request)
  {
    DB::table('users')->where('id', $request->id)->delete();

    return redirect('/control-panel/user-list')->with('success_msg', 'User Deleted Successfully');
  }

  public function user_detail(Request $request)
  {
    $user = DB::table('users')->where('id', $request->id)->first();

    $address = DB::table('user_address')->where('user_id', $request->id)->get();
    $documents = DB::table('user_document')->where('user_id', $request->id)->get();

    return view('control-panel.users.user-detail', compact('user', 'address', 'documents'));
  }
}
