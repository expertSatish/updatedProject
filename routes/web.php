<?php

use Illuminate\Support\Facades\Route;
$expertise = \App\Models\ExpertCategory::where('is_publish',1)->get();
$Arrht='';
foreach($expertise as $ex){
    $Arrht .= $Arrht.$ex->alias.'|';
}
Auth::routes();

//Route start  sss
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{expertcategory}/{subcat?}', App\Http\Controllers\CategoryController::class)->name('expertcategory')->where('expertcategory',$Arrht);
Route::get('/become-an-expert', [App\Http\Controllers\HomeController::class, 'becomeanexpert'])->name('becomeanexpert');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/blog/{alias?}', [App\Http\Controllers\HomeController::class, 'blog'])->name('blog');
Route::get('/blogcategory/{alias}', [App\Http\Controllers\HomeController::class, 'blogcategory'])->name('blogcategory');
Route::get('/blogarchive/{alias}', [App\Http\Controllers\HomeController::class, 'blogarchive'])->name('blogarchive');
Route::get('/team-details', [App\Http\Controllers\HomeController::class, 'teamdetails'])->name('teamdetails');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/faq/{category?}/{child?}', [App\Http\Controllers\HomeController::class, 'faq'])->name('faq');
Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacypolicy'])->name('privacypolicy');
Route::get('/terms-and-conditions', [App\Http\Controllers\HomeController::class, 'termsandconditions'])->name('termsandconditions');
Route::get('/career/{alias?}', [App\Http\Controllers\HomeController::class, 'careers'])->name('careers');
Route::get('experts/{alias?}/{type?}', [App\Http\Controllers\HomeController::class, 'experts'])->name('experts');
Route::get('videos', [App\Http\Controllers\HomeController::class, 'expertvideos'])->name('videos');
Route::get('videosearch', [App\Http\Controllers\HomeController::class, 'searchexpertvideos'])->name('videosearch');


Route::get('autosearch', [App\Http\Controllers\HomeController::class, 'autosearch'])->name('autosearch');
Route::get('search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');

Route::post('expert-login', [App\Http\Controllers\Auth\LoginController::class, 'expertlogin'])->name('expertlogin');
Route::post('expert-login-otp-check', [App\Http\Controllers\Auth\LoginController::class, 'expertloginotpcheck'])->name('expertloginotpcheck');
Route::get('expert-register', [App\Http\Controllers\Auth\RegisterController::class, 'expertregister'])->name('expertregister');
Route::post('expert-register', [App\Http\Controllers\Auth\RegisterController::class, 'saveexpertregister'])->name('saveexpertregister');
Route::post('checkexpertexist', [App\Http\Controllers\Auth\RegisterController::class, 'checkexpertexist'])->name('checkexpertexist');
Route::post('resumeexpertaccount', [App\Http\Controllers\Auth\RegisterController::class, 'resumeexpertaccount'])->name('resumeexpertaccount');

Route::post('user-login', [App\Http\Controllers\Auth\LoginController::class, 'userlogin'])->name('userlogin');
Route::post('user-login-otp-check', [App\Http\Controllers\Auth\LoginController::class, 'userloginotpcheck'])->name('userloginotpcheck');

Route::get('user-register', [App\Http\Controllers\Auth\RegisterController::class, 'userregister'])->name('userregister');
Route::post('user-step-first', [App\Http\Controllers\Auth\RegisterController::class, 'usersavestep1'])->name('user.savestep1');
Route::get('user-step-sec/{userId}', [App\Http\Controllers\Auth\RegisterController::class, 'usersec'])->name('user.savesec');
Route::post('user-sec-save', [App\Http\Controllers\Auth\RegisterController::class, 'savesecSave'])->name('user.savesecSave');
Route::post('user-third-save', [App\Http\Controllers\Auth\RegisterController::class, 'thirdSave'])->name('user.thirdSave');
Route::post('user-four-save', [App\Http\Controllers\Auth\RegisterController::class, 'fourSave'])->name('user.fourSave');
Route::get('user-step-third/{userId}', [App\Http\Controllers\Auth\RegisterController::class, 'savethirdSave'])->name('user.savethirdSave');
Route::get('user-step-four/{userId}', [App\Http\Controllers\Auth\RegisterController::class, 'fourstep'])->name('user.fourstep');
Route::post('sendemailotp', [App\Http\Controllers\Auth\RegisterController::class, 'sendemailotp'])->name('sendemailotp');
Route::post('sendmobileotp', [App\Http\Controllers\Auth\RegisterController::class, 'sendmobileotp'])->name('sendmobileotp');
Route::post('api/fetch-states',[App\Http\Controllers\Auth\RegisterController::class, 'fetchState']);
Route::post('api/fetch-cities',[App\Http\Controllers\Auth\RegisterController::class, 'fetchCity']);
Route::post('checkbookingemail', [App\Http\Controllers\OtherController::class, 'checkbookingemail'])->name('checkbookingemail');
Route::post('checkbookingmobile', [App\Http\Controllers\OtherController::class, 'checkbookingmobile'])->name('checkbookingmobile');
Route::post('bookingloginprocess', [App\Http\Controllers\OtherController::class, 'bookingloginprocess'])->name('bookingloginprocess');
Route::post('couponapply', [App\Http\Controllers\OtherController::class, 'couponapply'])->name('couponapply');
Route::get('couponcancel/{booking}', [App\Http\Controllers\OtherController::class, 'couponcancel'])->name('couponcancel');
Route::any('paymentresponse/{booking}', [App\Http\Controllers\OtherController::class, 'paymentresponse'])->name('paymentresponse');
Route::get('paymentwalletresponse/{booking}', [App\Http\Controllers\OtherController::class, 'paymentwalletresponse'])->name('paymentwalletresponse');
Route::any('cashfree/response', [App\Http\Controllers\OtherController::class, 'cashfree'])->name('cashfree');
Route::post('bookingquery', [App\Http\Controllers\OtherController::class, 'bookingquery'])->name('bookingquery');
Route::post('posthelpquery', [App\Http\Controllers\OtherController::class, 'posthelpquery'])->name('posthelpquery');
Route::post('expertsearch', [App\Http\Controllers\OtherController::class, 'expertsearch'])->name('expertsearch');
Route::post('savenewsletter', [App\Http\Controllers\OtherController::class, 'savenewsletter'])->name('savenewsletter');
Route::post('contactus', [App\Http\Controllers\OtherController::class, 'contactus'])->name('contactus');
Route::post('requestjob',[App\Http\Controllers\OtherController::class, 'requestjob'])->name('requestjob');
Route::post('saveblogcomment',[App\Http\Controllers\OtherController::class, 'saveblogcomment'])->name('saveblogcomment');
Route::any('depositcashfree',[App\Http\Controllers\User\UserController::class, 'depositcashfree'])->name('depositcashfree');

Route::any('depositpayu-failed/{transationno}', [App\Http\Controllers\OtherController::class, 'deposit_payumoney_failed'])->name('user.deposit.payumoney.failed');
Route::any('depositpayu-success/{transationno}', [App\Http\Controllers\OtherController::class, 'deposit_payumoney_success'])->name('user.deposit.payumoney.success');


Route::any('payment-failed/{booking}', [App\Http\Controllers\OtherController::class, 'payumoney_paymentfailed'])->name('payumoney.paymentfailed');
Route::any('payment-success/{booking}', [App\Http\Controllers\OtherController::class, 'payumoney_paymentsuccess'])->name('payumoney.paymentsuccess');


Route::post('expertslottimes', [App\Http\Controllers\HomeController::class, 'expertslottimes'])->name('expertslottimes');
Route::post('bookingprocess', [App\Http\Controllers\HomeController::class, 'bookingprocess'])->name('bookingprocess');
Route::get('payment/{booking}', [App\Http\Controllers\HomeController::class, 'payment'])->name('payment');
Route::post('apply-coupon', [App\Http\Controllers\HomeController::class, 'applyCoupon'])->name('applyCoupon');
Route::get('expert-booking/{booking}', [App\Http\Controllers\HomeController::class, 'bookinglogin'])->name('expertbooking');
Route::get('expert-booking-step2/{booking}', [App\Http\Controllers\HomeController::class, 'bookingstep2'])->name('expertbooking2');
Route::get('paymentquery/{booking}', [App\Http\Controllers\HomeController::class, 'paymentquery'])->name('paymentquery');
// Route::get('paymentquery', [App\Http\Controllers\HomeController::class, 'paymentquery'])->name('paymentquery');


Route::get('downloadrecordingapi/{recordingid}', [App\Http\Controllers\HomeController::class, 'downloadrecordingapi'])->name('downloadrecordingapi');

Route::middleware('auth')->name('user.')->prefix('user')->group(function(){
    Route::controller(App\Http\Controllers\User\UserController::class)->group(function(){
        Route::get('user-logout','userlogout')->name('userlogout');
        Route::middleware('userprofilepending')->group(function(){
            Route::get('user-register-second','userregister2')->name('userregister2'); 
            Route::post('user-step-second','savestep2')->name('saveusersetp2');  
            
            Route::get('user-register-third','userregister3')->name('userregister3'); 
            Route::post('user-step-third','savestep3')->name('saveusersetp3'); 
            
            Route::get('user-register-fourth','userregister4')->name('userregister4'); 
            Route::post('user-step-fourth','savestep4')->name('saveusersetp4'); 
            
            Route::get('user-register-fifth','userregister5')->name('userregister5'); 
            Route::post('user-step-fifth','savestep5')->name('saveusersetp5'); 

            Route::get('user-register-sixth','userregister6')->name('userregister6'); 
            Route::post('user-step-sixth','savestep6')->name('saveusersetp6'); 
        });   
        Route::post('bookingrescheduleprocess','bookingrescheduleprocess')->name('bookingrescheduleprocess');
        Route::post('emailnotification','emailnotification')->name('emailnotification');
        Route::post('mobilenotification','mobilenotification')->name('mobilenotification');
        Route::post('deleteaccount','deleteaccount')->name('deleteaccount');
        Route::post('updateprofile','updateprofile')->name('updateprofile');
        Route::post('otherinformation','updateotherinformation')->name('updateotherinformation');
        
        Route::post('countrystates','countrystates')->name('countrystates');        
        Route::post('statecities','statecities')->name('statecities');
        Route::post('reviews','reviews')->name('savereviews');

        Route::post('sendmessage','sendmessage')->name('sendmessage');
        Route::post('bulkarchivemessage','bulkarchivemessage')->name('bulkarchivemessage');
        Route::post('bulkdeletemessage','bulkdeletemessage')->name('bulkdeletemessage');
        Route::get('archivemessage/{id}','archivemessage')->name('archivemessage');
        Route::get('deletemessage/{id}','deletemessage')->name('deletemessage');

        Route::post('depositmoney','depositmoney')->name('depositmoney');
        Route::post('withdrawalrequest','withdrawalrequest')->name('withdrawalrequest');
        Route::post('claimrequest','claimrequest')->name('claimrequest');

        Route::post('videocallend','videocallend')->name('videocallend');
        Route::post('videorecording','videorecording')->name('videorecording');

        Route::post('schedulequeries','schedulequeries')->name('schedulequeries');
    });
    Route::controller(App\Http\Controllers\User\HomeController::class)->group(function(){
        // Route::middleware('userprofilecomplete')->group(function(){
            Route::get('dashboard','dashboard')->name('dashboard');

            Route::get('account','account')->name('account');
            Route::get('otherinformation','otherinformation')->name('otherinformation');      
            Route::get('editprofile','editprofile')->name('editprofile');

            Route::get('schedules','schedules')->name('schedules');
            Route::get('close-schedules','closeschedules')->name('closeschedules');
            Route::get('reject-schedules','rejectschedules')->name('rejectschedules');
            Route::get('scheduleinfo/{booking}','scheduleinfo')->name('scheduleinfo');
            Route::get('reschedules','reschedules')->name('reschedules');
            Route::get('bookinginformation/{bookingid}/','bookinginformation')->name('bookinginformation');
            
            Route::get('videocall/{schedule?}','videocall')->name('videocall');

            Route::get('reviews','reviews')->name('reviews');
            Route::get('removereviews/{id}','removereviews')->name('removereviews');
            Route::get('editreviews','editreviews')->name('editreviews');

            Route::get('help','help')->name('help');

            Route::get('wallet','wallet')->name('wallet');
            
            Route::get('message/{type?}','message')->name('message');
            
            Route::get('questionnaire/{booking}','questionnaire')->name('questionnaire');

        // });
    });
});

Route::middleware('expert')->name('expert.')->prefix('expert')->group(function(){
    Route::controller(App\Http\Controllers\Expert\ExpertController::class)->group(function(){
        Route::get('expert-logout','expertlogout')->name('expertlogout');

        Route::get('register/{type}','registeration')->name('register');
        Route::post('saveregisteration/{step}','saveregisteration')->name('saveregisteration');
        Route::post('bankDetails','updatebankDetails')->name('updatebankDetails');
        Route::post('otherinformation','updateotherinformation')->name('updateotherinformation');
        Route::post('emailnotification','emailnotification')->name('emailnotification');
        Route::post('mobilenotification','mobilenotification')->name('mobilenotification');
        Route::post('profilevisibility','profilevisibility')->name('profilevisibility');
        Route::post('videovisibility','videovisibility')->name('videovisibility');
        Route::post('deleteaccount','deleteaccount')->name('deleteaccount');
        Route::post('getwhatexpect','getwhatexpect')->name('getwhatexpect');
        Route::post('savewhatexpect','savewhatexpect')->name('savewhatexpect');
        Route::post('removewhatexpect','removewhatexpect')->name('removewhatexpect');
        Route::post('updateprofile','updateprofile')->name('updateprofile');

        Route::post('countrystates','countrystates')->name('countrystates');        
        Route::post('statecities','statecities')->name('statecities');

        Route::post('savevideo','savevideo')->name('savevideo');
        Route::post('updatevideo','updatevideo')->name('updatevideo');

        Route::post('withdrawalrequest','withdrawalrequest')->name('withdrawalrequest');
        Route::post('claimrequest','claimrequest')->name('claimrequest');

        Route::post('addexpertslotprice','addexpertslotprice')->name('addexpertslotprice');
        Route::post('expertslotavailability','expertslotavailability')->name('expertslotavailability');
        Route::post('bookingrescheduleprocess','bookingrescheduleprocess')->name('bookingrescheduleprocess');
        Route::post('sendinvitationlink','sendinvitationlink')->name('sendinvitationlink');
        Route::post('videocallend','videocallend')->name('videocallend');

        Route::post('sendmessage','sendmessage')->name('sendmessage');
        Route::post('bulkarchivemessage','bulkarchivemessage')->name('bulkarchivemessage');
        Route::post('bulkdeletemessage','bulkdeletemessage')->name('bulkdeletemessage');
        Route::get('archivemessage/{id}','archivemessage')->name('archivemessage');
        Route::get('deletemessage/{id}','deletemessage')->name('deletemessage');

        Route::post('dashboardgraf','dashboardgraf')->name('dashboardgraf');

    });

    //updatee
    
    Route::controller(App\Http\Controllers\Expert\HomeController::class)->group(function(){
        Route::get('dashboard','dashboard')->name('dashboard');

        Route::get('account','account')->name('account');
        Route::get('bankDetails','bankDetails')->name('bankDetails');        

        Route::get('otherinformation','otherinformation')->name('otherinformation');        
        Route::get('addwhatexpect','addwhatexpect')->name('addwhatexpect');        
        Route::get('editprofile','editprofile')->name('editprofile');

        Route::get('videos','videos')->name('videos');
        Route::get('editvideo','editvideo')->name('editvideo');
        Route::get('addvideo','addvideo')->name('addvideo');  
        Route::get('removevideo/{id}','removevideo')->name('removevideo'); 
        
        Route::get('slots','slots')->name('slots');
        Route::get('copyslotfornextweek','copyslotfornextweek')->name('copyslotfornextweek');
        Route::get('removeavailability/{id}','removeavailability')->name('removeavailability'); 

        Route::get('schedules','schedules')->name('schedules');
        Route::get('reschedules','reschedules')->name('reschedules');
        Route::get('close-schedules','closeschedules')->name('closeschedules');
        Route::get('reject-schedules','rejectschedules')->name('rejectschedules');
        Route::get('scheduleinfo/{booking}','scheduleinfo')->name('scheduleinfo');
        Route::get('scheduleconfirm/{confirm}/{schedule}','scheduleconfirm')->name('scheduleconfirm');
        Route::get('bookinginformation/{bookingid}/','bookinginformation')->name('bookinginformation');
        
        Route::get('videocall/{schedule?}','videocall')->name('videocall');

        Route::get('wallet','wallet')->name('wallet');

        Route::get('help','help')->name('help');

        Route::get('message/{type?}','message')->name('message');
        
        Route::get('reports','reports')->name('reports');
        Route::get('reportpdf','reportpdf')->name('reportpdf');
        Route::get('generatepiechart','generatepiechart')->name('generatepiechart');
        Route::get('rescheduledchart','rescheduledchart')->name('rescheduledchart');
        Route::get('scheduledchart','scheduledchart')->name('scheduledchart');
        Route::get('closescheduledchart','closescheduledchart')->name('closescheduledchart');
        Route::get('generatematerialchart','generatematerialchart')->name('generatematerialchart');

        
        Route::get('slotinfo','slotinfo')->name('slotinfo');
        Route::get('questionnaire/{booking}','questionnaire')->name('questionnaire');
        
    });
});

Route::namespace('Admin')->name('admin.')->prefix('control-panel')->group(function(){
    Route::namespace('Auth')->group(function(){
        Route::get('login',[App\Http\Controllers\Admin\Auth\LoginController::class, 'create'])->name('login');
        Route::post('login',[App\Http\Controllers\Admin\Auth\LoginController::class, 'store'])->name('adminlogin');
    });
    Route::group(['middleware'=>['admin']],function(){
        Route::get('/login-verification',[App\Http\Controllers\Admin\HomeController::class, 'loginverification'])->name('loginverification');
        Route::post('login-verification',[App\Http\Controllers\Admin\HomeController::class, 'checkloginverification'])->name('adminloginverify');
    });
    Route::group(['middleware'=>['admin','otpverification']],function(){
        Route::any('logout',[App\Http\Controllers\Admin\Auth\LoginController::class, 'destroy'])->name('logout');
        
        Route::get('/',[App\Http\Controllers\Admin\HomeController::class, 'create'])->name('index');
        Route::get('/dashboard',[App\Http\Controllers\Admin\HomeController::class, 'create'])->name('dashboard');
        
        Route::get('/qualifications',[App\Http\Controllers\Admin\QualificationController::class, 'index'])->name('qualifications');
        Route::post('/qualifications',[App\Http\Controllers\Admin\QualificationController::class, 'store'])->name('savequalifications');
        Route::post('/updatequalifications',[App\Http\Controllers\Admin\QualificationController::class, 'update'])->name('updatequalifications');
        Route::get('/editqualification',[App\Http\Controllers\Admin\QualificationController::class, 'edit'])->name('editqualification');
        Route::post('/qualificationsequence',[App\Http\Controllers\Admin\QualificationController::class, 'sequence'])->name('qualificationsequence');
        Route::post('/bulkremovequalification',[App\Http\Controllers\Admin\QualificationController::class, 'bulkremove'])->name('bulkremovequalification');
        Route::get('/remove-qualifications/{id}',[App\Http\Controllers\Admin\QualificationController::class, 'destroy'])->name('removequalifications');
        Route::get('/changequalificationstatus',[App\Http\Controllers\Admin\QualificationController::class, 'status'])->name('changequalificationstatus');

        Route::get('/expertise',[App\Http\Controllers\Admin\ExpertiseController::class, 'index'])->name('expertise');
        Route::post('/expertise-save',[App\Http\Controllers\Admin\ExpertiseController::class, 'store'])->name('expertise.save');
        Route::post('/expertise-update',[App\Http\Controllers\Admin\ExpertiseController::class, 'update'])->name('expertise.update');
        Route::get('/expertise-edit',[App\Http\Controllers\Admin\ExpertiseController::class, 'edit'])->name('expertise.edit');
        Route::post('/expertise-sequence',[App\Http\Controllers\Admin\ExpertiseController::class, 'sequence'])->name('expertise.sequence');
        Route::post('/expertise-bulkremove',[App\Http\Controllers\Admin\ExpertiseController::class, 'bulkremove'])->name('expertise.bulkremove');
        Route::get('/expertise-remove/{id}',[App\Http\Controllers\Admin\ExpertiseController::class, 'destroy'])->name('expertise.remove');
        Route::get('/expertise-status',[App\Http\Controllers\Admin\ExpertiseController::class, 'status'])->name('expertise.status');

        Route::get('/language',[App\Http\Controllers\Admin\LanguageController::class, 'index'])->name('language');
        Route::post('/language-save',[App\Http\Controllers\Admin\LanguageController::class, 'store'])->name('language.save');
        Route::post('/language-update',[App\Http\Controllers\Admin\LanguageController::class, 'update'])->name('language.update');
        Route::get('/language-edit',[App\Http\Controllers\Admin\LanguageController::class, 'edit'])->name('language.edit');
        Route::post('/language-sequence',[App\Http\Controllers\Admin\LanguageController::class, 'sequence'])->name('language.sequence');
        Route::post('/language-bulkremove',[App\Http\Controllers\Admin\LanguageController::class, 'bulkremove'])->name('language.bulkremove');
        Route::get('/language-remove/{id}',[App\Http\Controllers\Admin\LanguageController::class, 'destroy'])->name('language.remove');
        Route::get('/language-status',[App\Http\Controllers\Admin\LanguageController::class, 'status'])->name('language.status');

        Route::get('/role',[App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role');
        Route::post('/role-save',[App\Http\Controllers\Admin\RoleController::class, 'store'])->name('role.save');
        Route::post('/role-update',[App\Http\Controllers\Admin\RoleController::class, 'update'])->name('role.update');
        Route::get('/role-edit',[App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('role.edit');
        Route::post('/role-sequence',[App\Http\Controllers\Admin\RoleController::class, 'sequence'])->name('role.sequence');
        Route::post('/role-bulkremove',[App\Http\Controllers\Admin\RoleController::class, 'bulkremove'])->name('role.bulkremove');
        Route::get('/role-remove/{id}',[App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('role.remove');
        Route::get('/role-status',[App\Http\Controllers\Admin\RoleController::class, 'status'])->name('role.status');

        Route::get('/industry',[App\Http\Controllers\Admin\IndustryController::class, 'index'])->name('industry');
        Route::post('/industry-save',[App\Http\Controllers\Admin\IndustryController::class, 'store'])->name('industry.save');
        Route::post('/industry-update',[App\Http\Controllers\Admin\IndustryController::class, 'update'])->name('industry.update');
        Route::get('/industry-edit',[App\Http\Controllers\Admin\IndustryController::class, 'edit'])->name('industry.edit');
        Route::post('/industry-sequence',[App\Http\Controllers\Admin\IndustryController::class, 'sequence'])->name('industry.sequence');
        Route::post('/industry-bulkremove',[App\Http\Controllers\Admin\IndustryController::class, 'bulkremove'])->name('industry.bulkremove');
        Route::get('/industry-remove/{id}',[App\Http\Controllers\Admin\IndustryController::class, 'destroy'])->name('industry.remove');
        Route::get('/industry-status',[App\Http\Controllers\Admin\IndustryController::class, 'status'])->name('industry.status');

        Route::get('/working',[App\Http\Controllers\Admin\WorkingController::class, 'index'])->name('working');
        Route::post('/working-save',[App\Http\Controllers\Admin\WorkingController::class, 'store'])->name('working.save');
        Route::post('/working-update',[App\Http\Controllers\Admin\WorkingController::class, 'update'])->name('working.update');
        Route::get('/working-edit',[App\Http\Controllers\Admin\WorkingController::class, 'edit'])->name('working.edit');
        Route::post('/working-sequence',[App\Http\Controllers\Admin\WorkingController::class, 'sequence'])->name('working.sequence');
        Route::post('/working-bulkremove',[App\Http\Controllers\Admin\WorkingController::class, 'bulkremove'])->name('working.bulkremove');
        Route::get('/working-remove/{id}',[App\Http\Controllers\Admin\WorkingController::class, 'destroy'])->name('working.remove');
        Route::get('/working-status',[App\Http\Controllers\Admin\WorkingController::class, 'status'])->name('working.status');

        Route::get('/getbetter',[App\Http\Controllers\Admin\GetBetterController::class, 'index'])->name('getbetter');
        Route::post('/getbetter-save',[App\Http\Controllers\Admin\GetBetterController::class, 'store'])->name('getbetter.save');
        Route::post('/getbetter-update',[App\Http\Controllers\Admin\GetBetterController::class, 'update'])->name('getbetter.update');
        Route::get('/getbetter-edit',[App\Http\Controllers\Admin\GetBetterController::class, 'edit'])->name('getbetter.edit');
        Route::post('/getbetter-sequence',[App\Http\Controllers\Admin\GetBetterController::class, 'sequence'])->name('getbetter.sequence');
        Route::post('/getbetter-bulkremove',[App\Http\Controllers\Admin\GetBetterController::class, 'bulkremove'])->name('getbetter.bulkremove');
        Route::get('/getbetter-remove/{id}',[App\Http\Controllers\Admin\GetBetterController::class, 'destroy'])->name('getbetter.remove');
        Route::get('/getbetter-status',[App\Http\Controllers\Admin\GetBetterController::class, 'status'])->name('getbetter.status');

        Route::get('/hearabout',[App\Http\Controllers\Admin\HearAboutController::class, 'index'])->name('hearabout');
        Route::post('/hearabout-save',[App\Http\Controllers\Admin\HearAboutController::class, 'store'])->name('hearabout.save');
        Route::post('/hearabout-update',[App\Http\Controllers\Admin\HearAboutController::class, 'update'])->name('hearabout.update');
        Route::get('/hearabout-edit',[App\Http\Controllers\Admin\HearAboutController::class, 'edit'])->name('hearabout.edit');
        Route::post('/hearabout-sequence',[App\Http\Controllers\Admin\HearAboutController::class, 'sequence'])->name('hearabout.sequence');
        Route::post('/hearabout-bulkremove',[App\Http\Controllers\Admin\HearAboutController::class, 'bulkremove'])->name('hearabout.bulkremove');
        Route::get('/hearabout-remove/{id}',[App\Http\Controllers\Admin\HearAboutController::class, 'destroy'])->name('hearabout.remove');
        Route::get('/hearabout-status',[App\Http\Controllers\Admin\HearAboutController::class, 'status'])->name('hearabout.status');

        Route::get('/featured',[App\Http\Controllers\Admin\FeaturedController::class, 'index'])->name('featured');
        Route::post('/featured-save',[App\Http\Controllers\Admin\FeaturedController::class, 'store'])->name('featured.save');
        Route::post('/featured-update',[App\Http\Controllers\Admin\FeaturedController::class, 'update'])->name('featured.update');
        Route::get('/featured-edit',[App\Http\Controllers\Admin\FeaturedController::class, 'edit'])->name('featured.edit');
        Route::post('/featured-sequence',[App\Http\Controllers\Admin\FeaturedController::class, 'sequence'])->name('featured.sequence');
        Route::post('/featured-bulkremove',[App\Http\Controllers\Admin\FeaturedController::class, 'bulkremove'])->name('featured.bulkremove');
        Route::get('/featured-remove/{id}',[App\Http\Controllers\Admin\FeaturedController::class, 'destroy'])->name('featured.remove');
        Route::get('/featured-status',[App\Http\Controllers\Admin\FeaturedController::class, 'status'])->name('featured.status');

        Route::get('/banner',[App\Http\Controllers\Admin\BannerController::class, 'index'])->name('banner');
        Route::post('/banner-save',[App\Http\Controllers\Admin\BannerController::class, 'store'])->name('banner.save');
        Route::post('/banner-update',[App\Http\Controllers\Admin\BannerController::class, 'update'])->name('banner.update');
        Route::get('/banner-edit',[App\Http\Controllers\Admin\BannerController::class, 'edit'])->name('banner.edit');
        Route::post('/banner-sequence',[App\Http\Controllers\Admin\BannerController::class, 'sequence'])->name('banner.sequence');
        Route::post('/banner-bulkremove',[App\Http\Controllers\Admin\BannerController::class, 'bulkremove'])->name('banner.bulkremove');
        Route::get('/banner-remove/{id}',[App\Http\Controllers\Admin\BannerController::class, 'destroy'])->name('banner.remove');
        Route::get('/banner-status',[App\Http\Controllers\Admin\BannerController::class, 'status'])->name('banner.status');

        Route::get('/find-expert-step',[App\Http\Controllers\Admin\FindExpertStepController::class, 'index'])->name('findexpertstep');
        Route::post('/findexpertstep-save',[App\Http\Controllers\Admin\FindExpertStepController::class, 'store'])->name('findexpertstep.save');
        Route::post('/findexpertstep-update',[App\Http\Controllers\Admin\FindExpertStepController::class, 'update'])->name('findexpertstep.update');
        Route::get('/findexpertstep-edit',[App\Http\Controllers\Admin\FindExpertStepController::class, 'edit'])->name('findexpertstep.edit');
        Route::post('/findexpertstep-sequence',[App\Http\Controllers\Admin\FindExpertStepController::class, 'sequence'])->name('findexpertstep.sequence');
        Route::post('/findexpertstep-bulkremove',[App\Http\Controllers\Admin\FindExpertStepController::class, 'bulkremove'])->name('findexpertstep.bulkremove');
        Route::get('/findexpertstep-remove/{id}',[App\Http\Controllers\Admin\FindExpertStepController::class, 'destroy'])->name('findexpertstep.remove');
        Route::get('/findexpertstep-status',[App\Http\Controllers\Admin\FindExpertStepController::class, 'status'])->name('findexpertstep.status');

        Route::get('/are-you-a-mentor',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'index'])->name('homeexpertcategory');
        Route::post('/homeexpertcategory-save',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'store'])->name('homeexpertcategory.save');
        Route::post('/homeexpertcategory-update',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'update'])->name('homeexpertcategory.update');
        Route::get('/homeexpertcategory-edit',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'edit'])->name('homeexpertcategory.edit');
        Route::post('/homeexpertcategory-sequence',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'sequence'])->name('homeexpertcategory.sequence');
        Route::post('/homeexpertcategory-bulkremove',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'bulkremove'])->name('homeexpertcategory.bulkremove');
        Route::get('/homeexpertcategory-remove/{id}',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'destroy'])->name('homeexpertcategory.remove');
        Route::get('/homeexpertcategory-status',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'status'])->name('homeexpertcategory.status');

        // Route::get('/are-you-a-mentor',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'index'])->name('homeexpertcategory');
        // Route::post('/homeexpertcategory-save',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'store'])->name('homeexpertcategory.save');
        // Route::post('/homeexpertcategory-update',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'update'])->name('homeexpertcategory.update');
        // Route::get('/homeexpertcategory-edit',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'edit'])->name('homeexpertcategory.edit');
        // Route::post('/homeexpertcategory-sequence',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'sequence'])->name('homeexpertcategory.sequence');
        // Route::post('/homeexpertcategory-bulkremove',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'bulkremove'])->name('homeexpertcategory.bulkremove');
        // Route::get('/homeexpertcategory-remove/{id}',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'destroy'])->name('homeexpertcategory.remove');
        // Route::get('/homeexpertcategory-status',[App\Http\Controllers\Admin\HomeExpertCategoryController::class, 'status'])->name('homeexpertcategory.status');


        Route::get('/expert-category',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'index'])->name('expertcategory');
        Route::post('/expertcategory-save',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'store'])->name('expertcategory.save');
        Route::post('/expertcategory-update',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'update'])->name('expertcategory.update');
        Route::get('/expertcategory-edit',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'edit'])->name('expertcategory.edit');
        Route::post('/expertcategory-sequence',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'sequence'])->name('expertcategory.sequence');
        Route::post('/expertcategory-bulkremove',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'bulkremove'])->name('expertcategory.bulkremove');
        Route::get('/expertcategory-remove/{id}',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'destroy'])->name('expertcategory.remove');
        Route::get('/expertcategory-status',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'status'])->name('expertcategory.status');
        Route::get('/expertcategory-homestatus',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'homestatus'])->name('expertcategory.homestatus');

        Route::get('/experts',[App\Http\Controllers\Admin\ExpertController::class, 'index'])->name('experts');
        Route::post('/experts-save',[App\Http\Controllers\Admin\ExpertController::class, 'store'])->name('experts.save');
        Route::post('/experts-update',[App\Http\Controllers\Admin\ExpertController::class, 'update'])->name('experts.update');
        Route::get('/experts-edit/{id}',[App\Http\Controllers\Admin\ExpertController::class, 'edit'])->name('experts.edit');
        Route::get('/experts-videos/{id}',[App\Http\Controllers\Admin\ExpertController::class, 'videos'])->name('experts.videos');
        Route::post('/experts-videos',[App\Http\Controllers\Admin\ExpertController::class, 'updatevideos'])->name('experts.updatevideos');
        Route::post('/experts-sequence',[App\Http\Controllers\Admin\ExpertController::class, 'sequence'])->name('experts.sequence');
        Route::post('/experts-bulkremove',[App\Http\Controllers\Admin\ExpertController::class, 'bulkremove'])->name('experts.bulkremove');
        Route::post('/expert-service-charges',[App\Http\Controllers\Admin\ExpertController::class, 'service_charges'])->name('experts.expertservicecharges');
        Route::post('/expert-coupon-code',[App\Http\Controllers\Admin\ExpertController::class, 'coupon_code'])->name('experts.couponCode');
        Route::get('/experts-information/{page}/{id}',[App\Http\Controllers\Admin\ExpertController::class, 'information'])->name('experts.information');
        Route::get('/experts-remove/{id}',[App\Http\Controllers\Admin\ExpertController::class, 'destroy'])->name('experts.remove');
        Route::get('/experts-status',[App\Http\Controllers\Admin\ExpertController::class, 'status'])->name('experts.status');
        Route::get('/experts-topstatus',[App\Http\Controllers\Admin\ExpertController::class, 'topstatus'])->name('experts.topstatus');
        Route::get('/expert-slot-charges/{id}',[App\Http\Controllers\Admin\ExpertController::class, 'slot_charges'])->name('experts.slot-charges');
        Route::post('/saveslotcharges',[App\Http\Controllers\Admin\ExpertController::class, 'saveslotcharges'])->name('experts.saveslotcharges');
        


        Route::get('/users',[App\Http\Controllers\Admin\UserControlExpertControllerler::class, 'index'])->name('users');
        Route::get('/manage-slots/{page}/{id}',[App\Http\Controllers\Admin\ExpertController::class, 'information'])->name('experts.slots');
        Route::get('/copyfornextweek/{id}',[App\Http\Controllers\Admin\ExpertController::class, 'copyfornextweek'])->name('copyfornextweek');
        Route::post('/users-save',[App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.save');
        Route::post('/users-update',[App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
        Route::get('/users-edit/{id}',[App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
        Route::post('/users-sequence',[App\Http\Controllers\Admin\UserController::class, 'sequence'])->name('users.sequence');
        Route::post('/users-bulkremove',[App\Http\Controllers\Admin\UserController::class, 'bulkremove'])->name('users.bulkremove');
        Route::get('/users-information/{page}/{id}',[App\Http\Controllers\Admin\UserController::class, 'information'])->name('users.information');
        Route::get('/users-remove/{id}',[App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.remove');
        Route::get('/users-status',[App\Http\Controllers\Admin\UserController::class, 'status'])->name('users.status');
        Route::post('countrystates',[App\Http\Controllers\Admin\UserController::class, 'countrystates'])->name('users.countrystates');        
        Route::post('statecities',[App\Http\Controllers\Admin\UserController::class, 'statecities'])->name('users.statecities');


        Route::get('/schedules/{booked?}',[App\Http\Controllers\Admin\ScheduleController::class, 'index'])->name('schedules.booked');
        Route::get('/assignexpert',[App\Http\Controllers\Admin\ScheduleController::class, 'assignexpert'])->name('schedules.assignexpert');
        Route::post('/assignexpert',[App\Http\Controllers\Admin\ScheduleController::class, 'reassignexpert'])->name('schedules.reassignexpert');
        Route::post('/assignexpertinfo',[App\Http\Controllers\Admin\ScheduleController::class, 'assignexpertinfo'])->name('schedules.assignexpertinfo');
        Route::get('/information',[App\Http\Controllers\Admin\ScheduleController::class, 'information'])->name('schedules.information');
        Route::get('/schedules-remove/{id}',[App\Http\Controllers\Admin\ScheduleController::class, 'destroy'])->name('schedules.remove');
        
        Route::get('/help-center',[App\Http\Controllers\Admin\HelpCenterController::class, 'index'])->name('helpcenter.list');
        Route::get('/add-help-center',[App\Http\Controllers\Admin\HelpCenterController::class, 'create'])->name('helpcenter.add');
        Route::get('/edit-help-center/{id}',[App\Http\Controllers\Admin\HelpCenterController::class, 'edit'])->name('helpcenter.edit');
        Route::get('/remove-help-center/{id}',[App\Http\Controllers\Admin\HelpCenterController::class, 'destroy'])->name('helpcenter.remove');
        Route::post('/save-help-center',[App\Http\Controllers\Admin\HelpCenterController::class, 'store'])->name('helpcenter.save');
        Route::post('/update-help-center',[App\Http\Controllers\Admin\HelpCenterController::class, 'update'])->name('helpcenter.update');
        Route::post('/help-center-sequence',[App\Http\Controllers\Admin\HelpCenterController::class, 'sequence'])->name('helpcenter.sequence');
        Route::post('/help-center-bulkremove',[App\Http\Controllers\Admin\HelpCenterController::class, 'bulkremove'])->name('helpcenter.bulkremove');
        Route::get('/help-center-status',[App\Http\Controllers\Admin\HelpCenterController::class, 'status'])->name('helpcenter.status');
        
        Route::get('/help-center-query',[App\Http\Controllers\Admin\HelpCenterController::class, 'query'])->name('helpcenterquery.list');
        Route::get('/remove-help-center-query/{id}',[App\Http\Controllers\Admin\HelpCenterController::class, 'querydestroy'])->name('helpcenterquery.remove');
        Route::post('/help-center-query-bulkremove',[App\Http\Controllers\Admin\HelpCenterController::class, 'querybulkremove'])->name('helpcenterquery.bulkremove');
        
        Route::get('/teams',[App\Http\Controllers\Admin\TeamController::class, 'index'])->name('teams');
        Route::get('/teamslist',[App\Http\Controllers\Admin\TeamController::class, 'teamslist'])->name('teamslist');
        Route::get('/addteams',[App\Http\Controllers\Admin\TeamController::class, 'create'])->name('addteams');
        Route::get('/editteams/{id}',[App\Http\Controllers\Admin\TeamController::class, 'edit'])->name('editteams');
        Route::post('/saveteams',[App\Http\Controllers\Admin\TeamController::class, 'store'])->name('saveteams');
        Route::post('/updateteams',[App\Http\Controllers\Admin\TeamController::class, 'update'])->name('updateteams');
        Route::any('/teamspublish',[App\Http\Controllers\Admin\TeamController::class, 'status'])->name('teamspublish');
        Route::post('/teamssequence',[App\Http\Controllers\Admin\TeamController::class, 'sequence'])->name('teamssequence');
        Route::post('/bulkdestory',[App\Http\Controllers\Admin\TeamController::class, 'bulkdestory'])->name('bulkdestoryteams');
        Route::get('/removeteams/{removeid}',[App\Http\Controllers\Admin\TeamController::class, 'destory'])->name('removeteams');

        Route::get('/career',[App\Http\Controllers\Admin\CareerController::class, 'create'])->name('career');
        Route::get('/addcareer',[App\Http\Controllers\Admin\CareerController::class, 'add'])->name('addcareer');
        Route::get('/editcareer/{id}',[App\Http\Controllers\Admin\CareerController::class, 'edit'])->name('editcareer');
        Route::post('/savecareer',[App\Http\Controllers\Admin\CareerController::class, 'store'])->name('savecareer');
        Route::post('/updatecareer',[App\Http\Controllers\Admin\CareerController::class, 'update'])->name('updatecareer');
        Route::any('/careerpublish',[App\Http\Controllers\Admin\CareerController::class, 'status'])->name('careerpublish');
        Route::post('/careersequence',[App\Http\Controllers\Admin\CareerController::class, 'sequence'])->name('careersequence');
        Route::post('/bulkcareerdestory',[App\Http\Controllers\Admin\CareerController::class, 'bulkdestory'])->name('bulkcareerdestory');
        Route::get('/removecareer/{removeid}',[App\Http\Controllers\Admin\CareerController::class, 'destory'])->name('removecareer');
      
        Route::get('/blog-category', [App\Http\Controllers\Admin\BlogCategoryController::class, 'index'])->name('blogcategory');
        Route::get('/new-blog-category', [App\Http\Controllers\Admin\BlogCategoryController::class, 'New'])->name('newblogcategory');
        Route::post('/save-blog-category', [App\Http\Controllers\Admin\BlogCategoryController::class, 'Save'])->name('saveblogcategory');
        Route::get('/edit-blog-category/{id}', [App\Http\Controllers\Admin\BlogCategoryController::class, 'Edit'])->name('editblogcategory');
        Route::post('/update-blog-category', [App\Http\Controllers\Admin\BlogCategoryController::class, 'Update'])->name('updateblogcategory');
        Route::any('/blog-category-publish',[App\Http\Controllers\Admin\BlogCategoryController::class, 'status'])->name('blogcategorypublish');
        Route::post('/blog-category-sequence',[App\Http\Controllers\Admin\BlogCategoryController::class, 'sequence'])->name('blogcategorysequence');
        Route::post('/bulk-blog-category-destory',[App\Http\Controllers\Admin\BlogCategoryController::class, 'bulkdestory'])->name('bulkblogcategorydestory');
        Route::get('/remove-blog-category/{removeid}', [App\Http\Controllers\Admin\BlogCategoryController::class, 'Remove'])->name('blogcategoryremove');

        Route::get('/blog-management', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('blogs');
        Route::get('/new-blog', [App\Http\Controllers\Admin\BlogController::class, 'New'])->name('newblog');
        Route::post('/save-blog', [App\Http\Controllers\Admin\BlogController::class, 'Save'])->name('saveblog');
        Route::get('/edit-blog/{id}', [App\Http\Controllers\Admin\BlogController::class, 'Edit'])->name('editblog');
        Route::post('/update-blog', [App\Http\Controllers\Admin\BlogController::class, 'Update'])->name('updateblog');
        Route::get('/blog-popular/{status}/{id}', [App\Http\Controllers\Admin\BlogController::class, 'Popular'])->name('blogpopular');
        Route::any('/blogpublish',[App\Http\Controllers\Admin\BlogController::class, 'status'])->name('blogpublish');
        Route::post('/blogsequence',[App\Http\Controllers\Admin\BlogController::class, 'sequence'])->name('blogsequence');
        Route::post('/bulkblogdestory',[App\Http\Controllers\Admin\BlogController::class, 'bulkdestory'])->name('bulkblogdestory');
        Route::get('/remove-blog/{removeid}', [App\Http\Controllers\Admin\BlogController::class, 'Remove'])->name('blogremove');

        Route::get('/faqs-category/{id?}', [App\Http\Controllers\Admin\FaqCategoryController::class, 'index'])->name('faqscategory');
        Route::get('/new-faqs-category/{id?}', [App\Http\Controllers\Admin\FaqCategoryController::class, 'New'])->name('newfaqscategory');
        Route::post('/save-faqs-category', [App\Http\Controllers\Admin\FaqCategoryController::class, 'Save'])->name('savefaqscategory');
        Route::get('/edit-faqs-category/{id}', [App\Http\Controllers\Admin\FaqCategoryController::class, 'Edit'])->name('editfaqscategory');
        Route::post('/update-faqs-category', [App\Http\Controllers\Admin\FaqCategoryController::class, 'Update'])->name('updatefaqscategory');
        Route::any('/faqs-category-publish',[App\Http\Controllers\Admin\FaqCategoryController::class, 'status'])->name('faqscategorypublish');
        Route::post('/faqs-category-sequence',[App\Http\Controllers\Admin\FaqCategoryController::class, 'sequence'])->name('faqscategorysequence');
        Route::post('/bulk-faqs-category-destory',[App\Http\Controllers\Admin\FaqCategoryController::class, 'bulkdestory'])->name('bulkfaqscategorydestory');
        Route::get('/remove-faqs-category/{removeid}', [App\Http\Controllers\Admin\FaqCategoryController::class, 'Remove'])->name('faqscategoryremove');

        Route::get('/faqs', [App\Http\Controllers\Admin\FaqController::class, 'index'])->name('faqs');
        Route::get('/new-faqs/{id?}', [App\Http\Controllers\Admin\FaqController::class, 'New'])->name('newfaqs');
        Route::post('/save-faqs', [App\Http\Controllers\Admin\FaqController::class, 'Save'])->name('savefaqs');
        Route::get('/edit-faqs/{id}', [App\Http\Controllers\Admin\FaqController::class, 'Edit'])->name('editfaqs');
        Route::post('/update-faqs', [App\Http\Controllers\Admin\FaqController::class, 'Update'])->name('updatefaqs');
        Route::any('/faqs-publish',[App\Http\Controllers\Admin\FaqController::class, 'status'])->name('faqspublish');
        Route::any('/faqs-publish-home',[App\Http\Controllers\Admin\FaqController::class, 'homestatus'])->name('faqspublishhome');
        Route::post('/faqs-sequence',[App\Http\Controllers\Admin\FaqController::class, 'sequence'])->name('faqssequence');
        Route::post('/bulk-faqs-destory',[App\Http\Controllers\Admin\FaqController::class, 'bulkdestory'])->name('bulkfaqsdestory');
        Route::get('/remove-faqs/{removeid}', [App\Http\Controllers\Admin\FaqController::class, 'Remove'])->name('faqsremove');

        Route::get('/three-icons',[App\Http\Controllers\Admin\ThreeIconController::class, 'index'])->name('threeicons');
        Route::post('/threeicons',[App\Http\Controllers\Admin\ThreeIconController::class, 'store'])->name('savethreeicons');
        Route::post('/updatethreeicons',[App\Http\Controllers\Admin\ThreeIconController::class, 'update'])->name('updatethreeicons');
        Route::get('/editthreeicons',[App\Http\Controllers\Admin\ThreeIconController::class, 'edit'])->name('editthreeicon');
        Route::post('/threeiconsequence',[App\Http\Controllers\Admin\ThreeIconController::class, 'sequence'])->name('threeiconsequence');
        Route::post('/bulkremovethreeicons',[App\Http\Controllers\Admin\ThreeIconController::class, 'bulkremove'])->name('bulkremovethreeicon');
        Route::get('/remove-threeicons/{id}',[App\Http\Controllers\Admin\ThreeIconController::class, 'destroy'])->name('removethreeicons');
        Route::get('/changethreeiconstatus',[App\Http\Controllers\Admin\ThreeIconController::class, 'status'])->name('changethreeiconstatus');

        Route::get('/calling-process',[App\Http\Controllers\Admin\CallingProcessController::class, 'index'])->name('callingprocess');
        Route::post('/callingprocess',[App\Http\Controllers\Admin\CallingProcessController::class, 'store'])->name('savecallingprocess');
        Route::post('/updatecallingprocess',[App\Http\Controllers\Admin\CallingProcessController::class, 'update'])->name('updatecallingprocess');
        Route::get('/editcallingprocess',[App\Http\Controllers\Admin\CallingProcessController::class, 'edit'])->name('editcallingprocess');
        Route::post('/callingprocessequence',[App\Http\Controllers\Admin\CallingProcessController::class, 'sequence'])->name('callingprocessequence');
        Route::post('/bulkremovecallingprocess',[App\Http\Controllers\Admin\CallingProcessController::class, 'bulkremove'])->name('bulkremovecallingprocess');
        Route::get('/remove-callingprocess/{id}',[App\Http\Controllers\Admin\CallingProcessController::class, 'destroy'])->name('removecallingprocess');
        Route::get('/changecallingprocesstatus',[App\Http\Controllers\Admin\CallingProcessController::class, 'status'])->name('changecallingprocesstatus');

        Route::get('/mentor',[App\Http\Controllers\Admin\MentorController::class, 'index'])->name('mentor');
        Route::post('/mentor',[App\Http\Controllers\Admin\MentorController::class, 'store'])->name('savementor');
        Route::post('/updatementor',[App\Http\Controllers\Admin\MentorController::class, 'update'])->name('updatementor');
        Route::get('/editmentor',[App\Http\Controllers\Admin\MentorController::class, 'edit'])->name('editmentor');
        Route::post('/mentorequence',[App\Http\Controllers\Admin\MentorController::class, 'sequence'])->name('mentorsequence');
        Route::post('/bulkremovementor',[App\Http\Controllers\Admin\MentorController::class, 'bulkremove'])->name('bulkremovementor');
        Route::get('/remove-mentor/{id}',[App\Http\Controllers\Admin\MentorController::class, 'destroy'])->name('removementor');
        Route::get('/changementortatus',[App\Http\Controllers\Admin\MentorController::class, 'status'])->name('changementorstatus');

        Route::get('/testimonials',[App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('testimonials');
        Route::get('/addtestimonial',[App\Http\Controllers\Admin\TestimonialController::class, 'create'])->name('addtestimonial');
        Route::get('/edittestimonial/{id}',[App\Http\Controllers\Admin\TestimonialController::class, 'edit'])->name('edittestimonial');
        Route::post('/savetestimonial',[App\Http\Controllers\Admin\TestimonialController::class, 'store'])->name('savetestimonial');
        Route::post('/updatetestimonial',[App\Http\Controllers\Admin\TestimonialController::class, 'update'])->name('updatetestimonial');
        Route::get('/testimonialpublish',[App\Http\Controllers\Admin\TestimonialController::class, 'status'])->name('testimonialpublish');
        Route::post('/testimonialsequence',[App\Http\Controllers\Admin\TestimonialController::class, 'sequence'])->name('testimonialsequence');
        Route::post('/bulkdestorytestimonial',[App\Http\Controllers\Admin\TestimonialController::class, 'bulkdestory'])->name('bulkdestorytestimonial');
        Route::get('/removetestimonial/{removeid}',[App\Http\Controllers\Admin\TestimonialController::class, 'destroy'])->name('removetestimonial');

        Route::get('/cmsmodal/{id}',[App\Http\Controllers\Admin\CmsController::class, 'cmsmodal'])->name('cmsmodal');
        Route::get('/about',[App\Http\Controllers\Admin\CmsController::class, 'about'])->name('about');
        Route::get('/mission',[App\Http\Controllers\Admin\CmsController::class, 'mission'])->name('mission');
        Route::get('/vission',[App\Http\Controllers\Admin\CmsController::class, 'vission'])->name('vission');
        Route::get('/teamcms',[App\Http\Controllers\Admin\CmsController::class, 'teamcms'])->name('teamcms');
        Route::get('/careercms',[App\Http\Controllers\Admin\CmsController::class, 'careercms'])->name('careercms');
        Route::get('/faqcms',[App\Http\Controllers\Admin\CmsController::class, 'faqcms'])->name('faqcms');
        Route::get('/memtorcms',[App\Http\Controllers\Admin\CmsController::class, 'memtorcms'])->name('memtorcms');
        Route::get('/testimonialcms',[App\Http\Controllers\Admin\CmsController::class, 'testimonialcms'])->name('testimonialcms');
        Route::get('/callingprocesscms',[App\Http\Controllers\Admin\CmsController::class, 'callingprocesscms'])->name('callingprocesscms');
        Route::get('/contact',[App\Http\Controllers\Admin\CmsController::class, 'contact'])->name('contact');
        Route::get('/contactcms',[App\Http\Controllers\Admin\CmsController::class, 'contactcms'])->name('contactcms');
        Route::get('/blogcms',[App\Http\Controllers\Admin\CmsController::class, 'blogcms'])->name('blogcms');
        Route::get('/privacy-policy',[App\Http\Controllers\Admin\CmsController::class, 'privacypolicy'])->name('privacypolicy');
        Route::get('/terms-condition',[App\Http\Controllers\Admin\CmsController::class, 'termscondition'])->name('termscondition');
        Route::post('/updatecmsmodal',[App\Http\Controllers\Admin\CmsController::class, 'updatecmsmodal'])->name('updatecmsmodal');
        
        Route::get('/homeexpertcms',[App\Http\Controllers\Admin\CmsController::class, 'homeexpertcms'])->name('homeexpertcms');
        Route::get('/findexpertstepcms',[App\Http\Controllers\Admin\CmsController::class, 'findexpertstepcms'])->name('findexpertstepcms');
        Route::get('/featuredcms',[App\Http\Controllers\Admin\CmsController::class, 'featuredcms'])->name('featuredcms');
        Route::get('/bannercms',[App\Http\Controllers\Admin\CmsController::class, 'bannercms'])->name('bannercms');
        Route::get('/homeexpertcategorycms',[App\Http\Controllers\Admin\CmsController::class, 'homeexpertcategorycms'])->name('homeexpertcategorycms');
        Route::get('/hometestimonialcms',[App\Http\Controllers\Admin\CmsController::class, 'hometestimonialcms'])->name('hometestimonialcms');
        Route::get('/findexpertcategorycms',[App\Http\Controllers\Admin\CmsController::class, 'findexpertcategorycms'])->name('findexpertcategorycms');
        Route::get('/homenewscms',[App\Http\Controllers\Admin\CmsController::class, 'homenewscms'])->name('homenewscms');
        Route::get('/feqshomecms',[App\Http\Controllers\Admin\CmsController::class, 'youanexpert'])->name('youanexpert');
        Route::get('/videocms',[App\Http\Controllers\Admin\CmsController::class, 'videocms'])->name('videocms');
       
        Route::post('/updatecms',[App\Http\Controllers\Admin\CmsController::class, 'updatecms'])->name('updatecms');
        
        Route::get('/become-an-expert-banner',[App\Http\Controllers\Admin\CmsController::class, 'becomeanexpertbanner'])->name('becomeanexpertbanner');
        Route::get('/become-an-expert-about',[App\Http\Controllers\Admin\CmsController::class, 'becomeanexpertabout'])->name('becomeanexpertabout');
        Route::get('/become-an-expert-content',[App\Http\Controllers\Admin\CmsController::class, 'becomeanexpertcontent'])->name('becomeanexpertcontent');
                
        Route::post('/editorimage',[App\Http\Controllers\Admin\CmsController::class, 'editorimage'])->name('editorimage');
        
        Route::get('/social-media',[App\Http\Controllers\Admin\SocialMediaController::class, 'index'])->name('socialmedia');
        Route::post('/remove-social-media',[App\Http\Controllers\Admin\SocialMediaController::class, 'Remove'])->name('social-media-remove');    
        Route::post('/save-social-media',[App\Http\Controllers\Admin\SocialMediaController::class, 'Save'])->name('save-social-media');    
        Route::post('/update-social-media',[App\Http\Controllers\Admin\SocialMediaController::class, 'Update'])->name('update-social-media');    
        Route::get('/social-media-status/{status}/{id}',[App\Http\Controllers\Admin\SocialMediaController::class, 'Status'])->name('socialmediastatus');  

        Route::get('/footersection',[App\Http\Controllers\Admin\HomeController::class, 'footersection'])->name('footersection');
        Route::post('/savefooter', [App\Http\Controllers\Admin\HomeController::class, 'savefooter'])->name('savefooter');
        Route::get('/home-expert-vidoes',[App\Http\Controllers\Admin\HomeController::class, 'homeexpertvidoes'])->name('homeexpertvidoes');
        Route::post('/home-expert-vidoes-status', [App\Http\Controllers\Admin\HomeController::class, 'homeexpertvidoesstaus'])->name('changehomeexpertvidoesstatus');
        
        Route::get('/change-password', [App\Http\Controllers\Admin\HomeController::class, 'Change_Password'])->name('change-password');
        Route::post('/update-password', [App\Http\Controllers\Admin\HomeController::class, 'Update_Password'])->name('update-password');
        
        Route::get('/enquiry/{type}',[App\Http\Controllers\Admin\EnquiryController::class, 'enquiry'])->name('enquiry');
        Route::get('/enquiryinfo/{type}',[App\Http\Controllers\Admin\EnquiryController::class, 'enquiryinfo'])->name('enquiryinfo');
        Route::get('/enquirypublish/{type}',[App\Http\Controllers\Admin\EnquiryController::class, 'publish'])->name('enquirypublish');
        Route::post('/enquirybulkdestory/{type}',[App\Http\Controllers\Admin\EnquiryController::class, 'bulkdestory'])->name('enquirybulkdestory');
        Route::post('/enquirysequence/{type}',[App\Http\Controllers\Admin\EnquiryController::class, 'sequence'])->name('enquirysequence');
        
        Route::get('/wallet/{request}',[App\Http\Controllers\Admin\EnquiryController::class, 'wallet'])->name('wallet');
        Route::get('/withdrawalstatus/{id}/{status}',[App\Http\Controllers\Admin\EnquiryController::class, 'withdrawal_status'])->name('withdrawalstatus');
        
    });
});