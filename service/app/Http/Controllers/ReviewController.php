<?php

namespace App\Http\Controllers;

use Hash;
use Image;
use Cart;
use Auth;
use URL;
use Session;
use Helper;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class ReviewController extends Controller
{
   
  
  public function add_review(Request $request)
        {
		
		$product_id = $request->input('product_id');
		
      
        if(!empty(Auth::user()->id))
        {
          $user_id = Auth::user()->id;   
        }
        else
        {
           $user_id = '0'; 
        }
      
        
		$Name = $request->input('Name');
		$Email = $request->input('Email');
        $Mobile = $request->input('Mobile');
        $Message = $request->input('Message');
        $image = $request->file('profile');
		date_default_timezone_set('Asia/Kolkata');
		$date = date('d-M-Y h:i:s a');
		$rating = $request->input('rating');
		$quantity = $request->input('quantity');
        $type = $request->input('type');
      
        if(empty($image)) 
         {
             $fileName=NULL;
         }
         else
         {
          $extension =  $image->getClientOriginalExtension(); // getting image extension
          $fileName = date("Y-m-d").rand(1111111,9999999).'.'.$extension; // renameing image
          $imagesource = resource_path('/assets/uploads/review/'. $fileName); // upload path 
          Image::make($image->getRealPath())->resize(50, 50)->brightness(1)->save($imagesource);
         }
      
      
          $captcha_response = $request->input('g-recaptcha-response');
          $responseData = Helper::CaptchaResponce($captcha_response);  
      
      
      
      
      if($responseData > 0)
      {
   
       $review_id=DB::table('reviews')->insertGetId([
        
            'product_id' => $product_id,
            'user_id' => $user_id,
            'user_name' => $Name,
            'user_email' => $Email,
            'user_mobile' => $Mobile,
            'image' => $fileName,
            'rating' => $rating,
            'content' => $Message,
            'quantity'=>$quantity,
            'type'=>$type,
            'date' => $date,
		
         ]);
		 
		 if(!empty($rating))
		 {
			 DB::table('ratings')->insert([
        [
            'review_id' => $review_id,
            'map_product' => $product_id,
            'map_user' => $user_id,
            'ratings' => $rating,
            
		]
         ]);
		 }
		
		 if($type=='Enquiry')
         {
             return redirect('/thank-you')->with(array('success_msg'=>Helper::InstantEnquiryMSG()));
         }
        else
         {
            return redirect('/thank-you')->with(array('success_msg'=>Helper::reviewMSG()));
         }
          
          
          $Product = DB::table('products')->where('id',$product_id)->first();
          
          
            $Table='';
       
            $Table .= '<tr>';
                $Table .= '<td width="100">Name </td>';
				  $Table .= '<td width="40">:</td>';
                $Table .= '<td>'.$Name.'</td>';
            $Table .= '</tr>';
        
            $Table .= '<tr>';
                $Table .= '<td width="100">Mobile </td>';
				  $Table .= '<td width="40">:</td>';
                $Table .= '<td>'.$Mobile.'</td>';
            $Table .= '</tr>';
        
             $Table .= '<tr>';
                $Table .= '<td width="100">Email </td>';
				  $Table .= '<td width="40">:</td>';
                $Table .= '<td>'.$Email.'</td>';
            $Table .= '</tr>';
        
            
             $Table .= '<tr>';
                $Table .= '<td width="100"><strong>Requirements </strong></td>';
				  $Table .= '<td width="40">:</td>';
                $Table .= '<td>'.$Product->name.'</td>';
            $Table .= '</tr>';
        
             $Table .= '<tr>';
                $Table .= '<td width="100">Rating </td>';
				  $Table .= '<td width="40">:</td>';
                $Table .= '<td><strong>'.$rating.'</strong></td>';
            $Table .= '</tr>';
        
            $Table .= '<tr>';
                $Table .= '<td width="100">Quantity </td>';
				  $Table .= '<td width="40">:</td>';
                $Table .= '<td>'.$quantity.'</td>';
            $Table .= '</tr>';
        
        
            $Table .= '<tr>';
                $Table .= '<td width="100">Message </td>';
				  $Table .= '<td width="40">:</td>';
                $Table .= '<td>'.$Message.'</td>';
            $Table .= '</tr>';
        
             $Table .= '<tr>';
                $Table .= '<td colspan="3" height="10"></td>';
            $Table .= '</tr>';
             
            $Table .= '<tr>';
                $Table .= '<td colspan="3">Inquiry placed on date and time : '. Helper::currentDate().'</td>';
            $Table .= '</tr>';
             
        
          
         Helper::SendAdminMail($Name,$Table);
          
         Helper::SendCUSTOMERMail($name,$Email);  
		 

       }
      else
       {
         return redirect()->back()->with(array('error_msg'=> Helper::CaptcherrorMSG() ));
       }
      
      
    } 
	
	
	public function my_reviews(Request $request)
		{
			
		return view('my-reviews');
		}
		
	public function salon_reviews(Request $request,$salon_id)
		{
		$reviews = DB::table('reviews')->where('salon_id', $salon_id)->orderBy('id', 'desc')->get();
		return view('salon-reviews')->with(array('arr_data'=>$reviews,'salon_id'=>$salon_id));;
		}
		
		
		

  
  
  
	
   
   
}
