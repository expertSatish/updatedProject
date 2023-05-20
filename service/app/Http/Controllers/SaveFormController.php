<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use OilBanner;
use Sendgrid;
use Helper;
use Image;
use Auth;
use Mail;
use DB;
class SaveFormController extends Controller{
    function Save_Contact(Request $r){
        $First_Name = $r->name;
        $Email = $r->email;
        $phone = $r->mobile;
        $subject = $r->subject;
        $comment = $r->message;
        $Captch = $r->captcha;
        if(Helper::CaptchaResponce($Captch) > 0){
            if(DB::table('contact_enquiry')->insert(['name'=>$First_Name,'email'=>$Email,'phone'=>$phone,'subject'=>$subject,'message'=>$comment])){
                Helper::MailHtml(Helper::CustomerMailSMS(),$First_Name,$Email,'Thank you for contact with us');
                
                $Table ='You have received a new inquiry from a expertbells.com.below are customer contact details.<br>';
                $Table .= $this->Table($r->all());
                Helper::MailHtml($Table,'',Helper::ProjectMailToEmail(),'You have received a new inquiry');
                
                return redirect()->back()->with(array('success_msg' => Helper::InstantEnquiryMSG()));
            }else{
                return redirect()->back()->with(array('error_msg' => Helper::errorMSG()));
            }
        }else{
           return redirect('/thank-you')->with(array( 'error_msg' => 'Invaild Captcha. Please Try Again.' ));
        }
    }
    function Save_Footer(Request $r){
        $First_Name = $r->firstName;
        $Last_Name = $r->lastName;
        $Email = $r->email;
        $phone = $r->mobile;
        $comment = $r->Message;
        if(DB::table('contact_enquiry')->insert(['name'=>$First_Name.' '.$Last_Name,'email'=>$Email,'phone'=>$phone,'page'=>'Footer Section','message'=>$comment])){
            Helper::MailHtml(Helper::CustomerMailSMS(),$First_Name.' '.$Last_Name,$Email,'Thank you for contact with us');
            
            $Table ='You have received a new inquiry from a expertbells.com.below are customer contact details.<br>';
            $Table .= $this->Table($r->all());
            Helper::MailHtml($Table,'',Helper::ProjectMailToEmail(),'You have received a new inquiry');
            return redirect()->back()->with(array('success_msg' => Helper::InstantEnquiryMSG()));
        }else{
            return redirect('/thank-you')->with(array('error_msg' => Helper::errorMSG()));
        }
    }
    function Save_Project(Request $r){
        $First_Name = $r->name;
        $Subject = $r->subject;
        $Email = $r->email;
        $phone = $r->mobile;
        $comment = $r->message;
        if(DB::table('contact_enquiry')->insert(['name'=>$First_Name,'email'=>$Email,'subject'=>$Subject,'phone'=>$phone,'page'=>'Project Section','message'=>$comment])){
            Helper::MailHtml(Helper::CustomerMailSMS(),$First_Name,$Email,'Thank you for contact with us');
            
            $Table ='You have received a new inquiry from a expertbells.com.below are customer contact details.<br>';
            $Table .= $this->Table($r->all());
            Helper::MailHtml($Table,'',Helper::ProjectMailToEmail(),'You have received a new inquiry');
            
            return redirect()->back()->with(array('success_msg' => Helper::InstantEnquiryMSG()));
        }else{
            return redirect('/thank-you')->with(array('error_msg' => Helper::errorMSG()));
        }
    }
    
    
    function Table($data){
        $Html='';
        $Html .='<table class="table">';
            if(!empty($data['firstName'])):
                $Html .='<tr>';
                    $Html .='<th>Name: <th>';
                    $Html .='<td>'.$data['firstName'].' '.$data['lastName'].'<td>';
                $Html .='</tr>';
            endif;
            if(!empty($data['name'])):
                $Html .='<tr>';
                    $Html .='<th>Name: <th>';
                    $Html .='<td>'.$data['name'].'<td>';
                $Html .='</tr>';
            endif;
            if(!empty($data['enquiry_name'])):
                $Html .='<tr>';
                    $Html .='<th>Name: <th>';
                    $Html .='<td>'.$data['enquiry_name'].'<td>';
                $Html .='</tr>';
            endif;
            if(!empty($data['email'])):
                $Html .='<tr>';
                    $Html .='<th>Email: <th>';
                    $Html .='<td>'.$data['email'].'<td>';
                $Html .='</tr>';
            endif;
            if(!empty($data['mobile'])):
                $Html .='<tr>';
                    $Html .='<th>Mobile: <th>';
                    $Html .='<td>'.$data['mobile'].'<td>';
                $Html .='</tr>';
            endif;
            if(!empty($data['subject'])):
                $Html .='<tr>';
                    $Html .='<th>Subject: <th>';
                    $Html .='<td>'.$data['subject'].'<td>';
                $Html .='</tr>';
            endif;
            if(!empty($data['message'])):
                $Html .='<tr>';
                    $Html .='<th>Message: <th>';
                    $Html .='<td>'.$data['message'].'<td>';
                $Html .='</tr>';
            endif;
            if(!empty($data['Message'])):
                $Html .='<tr>';
                    $Html .='<th>Message: <th>';
                    $Html .='<td>'.$data['Message'].'<td>';
                $Html .='</tr>';
            endif;
        $Html .='</table>';
        return $Html;
    }
    
}

