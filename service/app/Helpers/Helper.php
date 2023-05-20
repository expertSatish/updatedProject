<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Validator;
use Image;
use Sendgrid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Helper
{


    static function AdminReceviedEmail()
    {
        return Helper::ProjectMailEmail();
    }


    static function Site_Key()
    {
        return "6LeXVcgUAAAAAA1QskVNyCTmzVprDfHvJurvOTe4";
    }

    static function Secret_Key()
    {
        return "6LeXVcgUAAAAAFT7rqeGdlHHv_5aMgKZ7F-HEusR";
    }



    static function MailHtml($msg, $name, $email, $subject){

        $to = $email;
        $subject = $subject;

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml">
                        
                            <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <title>' . Helper::ProjectName() . ' Mailer</title>
                            </head>

                            <body style="margin:0" bgcolor="#f2f2f2">
                                <table style="width: 100%;" cellpadding="0" cellspacing="0"  border="0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table style="width:740px; margin:auto; background:#ddd;" cellpadding="0" cellspacing="0"  border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center" height="20" style="height:10px;">&nbsp;</td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <table style="width:700px; margin:auto; background:#fff;" cellpadding="0" cellspacing="0"  border="0">
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
                                                                                <td>
                                                                                    <table style="width:700px; padding:20px 20px 10px;  border-top:2px solid #119949 ;  border-bottom:2px solid #119949 ;  margin:auto; background:#fff;" cellpadding="0" cellspacing="0"  border="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td colspan="2">
                                                                                                    <span style="margin:0; display:block; margin-bottom:30px; font:14px arial; color:#333; font-weight:bold">Hi ' . $name . ',</span>
                                                                                                    <h4 style="margin:0; font:13px arial; color:#848484;"> ' . $msg . ' </h4>
                                                                                                </td>
                                                                                            </tr>

                                                                                             <tr>
                                                                                                <td colspan="2">
                                                                                                    <p style="margin-top:15px; font:12px arial; color:#848484;">If you have any concerns or questions please contact us at ' . Helper::ProjectMailEmail() . '</p>
                                                                                                    <span style="margin:50px 0 10px 0; display:block; font:bold 13px arial; color:#808080;">Sincerely,</span> <span style="margin:10px 0  15px 0; display:block;  font:bold 13px arial; color:#808080;">The ' . Helper::ProjectName() . ' Team</span>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="2">

                                                                                                    <p style="margin:0; text-align:left; padding:15px 0 2px  0px; font:12px arial; color:#848484; border-top:1px solid #d8d8d8;">
                                                                                                        <a style="font:13px arial; color:#848484; text-decoration:none;" href="#">Need Help ?</a>
                                                                                                    </p>

                                                                                                    <p style="margin:0; text-align:left; padding:2px 0 10px 0px; font:12px arial; color:#848484;">Please feel free to contact us at
                                                                                                        <a style="font:13px arial; color:#848484; text-decoration:none;" href="emailto:' . Helper::ProjectMailEmail() . '"> ' . Helper::ProjectMailEmail() . '</a>
                                                                                                    </p>

                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>

                                                        <tr>
                                                            <td align="center">
                                                                <p style="font:13px arial; color:#848484; text-align:center; margin:0; padding:15px 0;">&copy;
                                                                    <a style="font:13px arial;color:#848484; text-decoration:none;" href="' . url('/') . '"> ' . Helper::ProjectName() . '</a>
                                                               </p>
                                                           </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </body>
                        </html>';


        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $headers .= 'From: <' . Helper::ProjectMailEmail() . '>';

       

        return mail($to, $subject, $message, $headers);
    }



    static function SettingID()
    {
        return '1';
    }

    static function ProjectName()
    {
        $QRY = DB::table('setting')->where('Id', Helper::SettingID())->first();
        return $QRY->site_name;
    }

    static function ProjectLOGO()
    {
        $QRY = DB::table('setting')->where('Id', Helper::SettingID())->first();
        return $QRY->site_logo;
    }


    static function ProjectMailEmail()
    {
        $QRY = DB::table('setting')->where('Id', Helper::SettingID())->first();
        return $QRY->email;
    }


    static function ProjectMailToEmail()
    {
        $QRY = DB::table('setting')->where('Id', Helper::SettingID())->first();
        return $QRY->email_to;
    }

    static function ProjectMailMobile()
    {
        $QRY = DB::table('setting')->where('Id', Helper::SettingID())->first();
        return $QRY->mobile;
    }

    static function ProjectMailAddress()
    {
        $QRY = DB::table('setting')->where('Id', Helper::SettingID())->first();
        return $QRY->address;
    }


    static function LOGOIMGURl($FileName)
    {
        return asset('resources/assets/uploads/logo/' . $FileName);
    }

    static function GenerateAliesh($Text)
    {
        return strtolower(str_replace(" ", "-", $Text));
    }



    //////////////////// ALL MSG /////////////////////////////////////

    static function saveMSG()
    {
        return 'Data has been save successfully.';
    }

    static function removeMSG()
    {
        return 'Data has been deleted successfully.';
    }

    static function updateMSG()
    {
        return 'Data has been modify successfully.';
    }

    static function errorMSG()
    {
        return 'An error occurred, please try again later.';
    }

    static function reviewMSG()
    {
        return 'Thank you for your review.';
    }

    static function InstantEnquiryMSG()
    {
        return 'Thank you for your inquiry. Our representative will call you back soon';
    }

    static function SubScriptionMSG()
    {
        return 'Thank you for your subscription.';
    }


    static function CaptcherrorMSG()
    {
        return 'Sorry! Invalid Captcha.';
    }



    static function CheckDataStatus($URl, $ID, $Status)
    {
        if ($Status > 0) {
            return Helper::ActiveBTN($URl . '/0/' . $ID);
        } else {
            return Helper::DeactiveBTN($URl . '/1/' . $ID);
        }
    }


    static function BackBtn($Action)
    {
        return '<a href="' . $Action . '"  class="btn btn-danger  pull-right"><i class="fa fa-backward"></i> Back</a>';
    }


    static function ProcessingBTN()
    {
        return '<button type="button" id="prcbtn" class="btn btn-warning pull-right"><i class="fa fa-spinner"></i> Processing...</button>';
    }

    static function SaveBTN()
    {
        return '<button type="submit" id="svbtn" class="btn btn-success pull-right" onClick="return validation()"><i class="fa fa-floppy-o"></i> Save</button>';
    }


    static function EditBTN($Action)
    {
        return '<a href="' . $Action . '" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a>';
    }


    static function HRFRemoveBTN($Action)
    {
        return '<a href="' . $Action . '"  onClick="return deleletconfig()" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a>';
    }


    static function RemoveBTN()
    {
        return '<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</button>';
    }



    static function ActiveBTN($Action)
    {
        return '<a href="' . $Action . '" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Activated</a>';
    }



    static function DeactiveBTN($Action)
    {
        return '<a href="' . $Action . '" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactivated</a>';
    }

    //////////////////// END ALL MSG /////////////////////////////////////


    static function SuccessAlert($success_msg)
    {
        return '<div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-success">
                        <strong>Success!</strong> ' . $success_msg . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div> ';
    }


    static function ErrorAlert($error_msg)
    {
        return '<div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="alert alert-danger">
                        <strong>Error!</strong> ' . $error_msg . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div> ';
    }



    static function CustomerMailSMS()
    {
        return 'Thank You for your interest to be the part of ' . Helper::ProjectName() . '. We have received your Inquiry, our expert team shall contact you shortly';
    }


    static function CaptchaResponce($captcha)
    {
        $secret = Helper::Secret_Key();
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
        $responseData = json_decode($verifyResponse);
        return $responseData->success;
    }

    static function NewAlias($Table, $Field, $Title)
    {
        $table = $Table;      /*------------Write table name---------------*/
        $field = $Field;       /*------------Write field name---------------*/
        $slug = $Title;  /*------------Write title for slug-----------*/
        $slug = Str::slug($Title, "-");
        $key = NULL;
        $value = NULL;
        $i = 0;
        $params = array();
        $params[$field] = $slug;
        if ($key) $params["$key !="] = $value;
        while (DB::table($table)->where($params)->get()->count()) {
            if (!preg_match('/-{1}[0-9]+$/', $slug))
                $slug .= '-' . ++$i;
            else
                $slug = preg_replace('/[0-9]+$/', ++$i, $slug);
            $params[$field] = $slug;
        }

        return  $alias = $slug;
    }



    static function sizeImage($path, $width, $height, $image)
    {
        /*----------------------------Image Uploading script start--------------------------- */

        $extension =  $image->getClientOriginalExtension(); // getting image extension
        $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image
        $imagesource = resource_path($path . $fileName); // upload path
        // Image::make($image->getRealPath())->resize($width, $height)->brightness(1)->save($imagesource);
       
        // Image::make($image->getRealPath())->brightness(1)->save($imagesource);
        $image->move(resource_path($path), $fileName);
        /*----------------------------Image Uploading script end--------------------------- */
        return $fileName;
    }


    static function withoutsizeImage($path, $image)
    {
        /*----------------------------Image Uploading script start--------------------------- */

        $extension =  $image->getClientOriginalExtension(); // getting image extension
        $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension; // renameing image
        $imagesource = resource_path($path . $fileName); // upload path
        Image::make($image->getRealPath())->brightness(1)->save($imagesource);

        /*----------------------------Image Uploading script end--------------------------- */


        return $fileName;
    }


    static function PDFSAVE($Path, $Image)
    {
        $extension =  $Image->getClientOriginalExtension();
        $fileName = date("Y-m-d") . rand(1111111, 9999999) . '.' . $extension;
        $Image->move($Path, $fileName);

        return $fileName;
    }



    static function AmountInWords(float $amount)
    {
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(
            0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
        );
        $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($x < $count_length) {
            $get_divider = ($x == 2) ? 10 : 100;
            $amount = floor($num % $get_divider);
            $num = floor($num / $get_divider);
            $x += $get_divider == 10 ? 1 : 2;
            if ($amount) {
                $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                $string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
           ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
           ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
            } else $string[] = null;
        }
        $implode_to_Rupees = implode('', array_reverse($string));
        $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
       " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
        return ($implode_to_Rupees ? $implode_to_Rupees . ' ' : '') . $get_paise;
    }

    static function youtube_preview($data, $height)
    {
        // $url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<iframe class='w-100' height='" . $height . "' src='//www.youtube.com/embed/$1\' frameborder='0' allowfullscreen></iframe>", $data);
        $url = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<div class=\"youtube-player\" data-id=\"$1\"></div>", $data);

        return $url;
    }

    static function order_status($status)
    {
        if ($status = 1) {
            $status_name = 'Confirm';
        }
        if ($status = 2) {
            $status_name = 'Dispatched';
        }
        if ($status = 3) {
            $status_name = 'Delivered';
        }
        if ($status = 4) {
            $status_name = 'Delivered Failed';
        }
        if ($status = 5) {
            $status_name = 'Cancel Order';
        }
        if ($status = 6) {
            $status_name = 'Cancellation Approve';
        }
        if ($status = 7) {
            $status_name = 'Return Order';
        }
        if ($status = 8) {
            $status_name = 'Return Approve';
        }
        if ($status = 9) {
            $status_name = 'Refund';
        }
        return $status_name;
    }

    static function TwoColor($str){
        $data = explode(" ", $str);
        $data1 = '';

        $counter = count($data);
        $count = round($counter / 2);
        for ($i = 0; $i < $count; $i++) {
            $data1 .= $data[$i] . ' ';
        }
        $data2 = '';
        for ($j = $count; $j < $counter; $j++) {
            $data2 .= $data[$j] . ' ';
        }
        return [$data1, $data2];
    }
}
