<?php
use App\Http\Controllers\CartController;

Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});

Auth::routes();
Route::post('logout', 'Auth\LoginController@logout');
Route::any('login/facebook', 'Auth\SocialController@redirectToProvider');
Route::any('login/facebook/callback', 'Auth\SocialController@handleProviderCallback');
Route::any('login/google', 'Auth\GoogleController@redirectToProvider');
Route::any('login/google/callback', 'Auth\GoogleController@handleProviderCallback');
Route::group(['middleware' => 'revalidate'], function () {
    
    $services = DB::table('nav_category')->where(['status'=>1])->orderby('title','ASC')->get();
    $AproSer = '';
    foreach($services as $service){
        $AproSer =  $AproSer.$service->alias.'|';
    }
    
   
    Route::get('/error', function () {
        abort(404);
    });
    Route::get('/login', 'Auth\LoginController@login');
    Route::get('check-useremail', 'HomeController@Check_UserEmail');
    Route::any('login-account', 'Auth\LoginController@login_account');
    Route::any('signup', 'Auth\RegisterController@signup');
    Route::any('signup-account', 'Auth\RegisterController@signup_account');
    Route::any('/email-verification/{email_verification}',[
        'uses' => 'Auth\LoginController@email_verification',
        'as'   => 'email-verification'
    ]);
    Route::any('forgot-password', 'Auth\LoginController@forgot_password');
    Route::get('/check-forget-email', [
        'uses' => 'Auth\LoginController@Check_Email_Address',
        'as'   => 'check-forget-email'
    ]);
    Route::post('/reset-pass', [
        'uses' => 'Auth\LoginController@reset_pass',
        'as'   => 'reset-pass'
    ]);
    Route::get('/', 'HomeController@index');
    Route::get('/{service}', 'PageController')->name('service')->where('service',$AproSer);
    Route::get('home', 'HomeController@index');
    Route::get('thank-you', 'HomeController@Thank_You');
    // Route::get('service/{alias?}', 'HomeController@service');
    Route::get('contact-us', 'HomeController@Contact');
    Route::get('about-us', 'HomeController@About');
    Route::get('team', 'HomeController@Team');
    Route::get('media', 'HomeController@Gallery');
    Route::get('property-management', 'HomeController@Property_Management');
    Route::get('project/{alias}', 'HomeController@Product');
    Route::get('projects/', 'HomeController@Product');
    Route::get('/terms-and-conditions', 'HomeController@terms_and_conditions');
    Route::get('/privacy-policy', 'HomeController@privacy_policy');
    Route::get('/refund-policy', 'HomeController@refund_policy');
    Route::get('/career', 'HomeController@career');
    Route::post('/career-enquiry-save', 'HomeController@career_enquiry_save');
    //Route::get('/about-us', 'HomeController@about_us');
    Route::get('/online-payment', 'HomeController@online_payment');
    Route::get('/online-payment-save', 'HomeController@online_payment_save');
    Route::any('/online-payment-response', 'HomeController@online_payment_response');
    // Route::post('/consultancy-form-save', 'HomeController@form_save')->name('consultancy-form');
    Route::get('/add-to-cart/{productId}', [
        'uses' => 'CartController@add_to_cart',
        'as'   => 'add-to-cart'
    ]);
    Route::get('/add-shipping-details', [
        'uses' => 'CartController@add_shipping_details',
        'as'   => 'add-shipping-details'
    ]);
    Route::post('/add-ship-detail', [
        'uses' => 'CartController@add_ship_detail',
        'as'   => 'add-ship-detail'
    ]);
    Route::post('/add-contact', [
        'uses' => 'HomeController@add_contact',
        'as'   => 'add-contact'
    ]);
    Route::post('/edit-ship-detail/{id}', [
        'uses' => 'CartController@edit_ship_detail',
        'as'   => 'edit-ship-detail'
    ]);
    Route::any('/cart-detail', [
        'uses' => 'CartController@cart_detail',
        'as'   => 'cart-detail'
    ]);
    Route::get('/cart-product-remove/{rowId}', [
        'uses' => 'CartController@cart_product_remove',
        'as'   => 'cart-product-remove'
    ]);




    Route::any('/payment-success', [

        'uses' => 'CartController@payment_success',

        'as'   => 'payment-success'

    ]);

    Route::get('/generate-hash', 'CartController@Generate_hash');

    Route::any('/gateway-response', 'CartController@Gateway_Response');


    Route::get('/cart-product-remove/{rowId}', [

        'uses' => 'CartController@cart_product_remove',

        'as'   => 'cart-product-remove'

    ]);

    Route::post('/update-account', [

        'uses' => 'CartController@update_account',

        'as'   => 'update-account'

    ]);



    Route::post('/add-review', [

        'uses' => 'CartController@add_review',

        'as'   => 'add-review'

    ]);




    Route::post('save-project-form', 'SaveFormController@Save_Project');

    Route::post('save-contact-form', 'SaveFormController@Save_Contact');

    Route::post('save-footer-form', 'SaveFormController@Save_Footer');

    /*-----------------Frontend management end------------------------*/


    Route::get('/my-account', [

        'uses' => 'CartController@my_account',

        'as'   => 'my-account'

    ]);

    Route::get('/order', [

        'uses' => 'CartController@order',

        'as'   => 'order'

    ]);

    Route::get('/account-setting', [

        'uses' => 'CartController@account_setting',

        'as'   => 'account-setting'

    ]);

    Route::get('/upload-documents', [

        'uses' => 'CartController@upload_documents',

        'as'   => 'upload-documents'

    ]);

    Route::post('/user-documents-save', 'CartController@user_documents_save');
    Route::get('/document-delete/{id}', 'CartController@document_delete');
    Route::get('/document-verify/{id}', 'CartController@document_verify');
    Route::get('/document-reject/{id}', 'CartController@document_reject');
    Route::post('/user-documents-update', 'CartController@user_documents_update');



    Route::get('/review-and-ratings', [

        'uses' => 'CartController@review_and_ratings',

        'as'   => 'review-and-ratings'

    ]);
    Route::get('/order-cancel/{id}', 'CartController@order_cancel');

    Route::get('/order-detail/{id}', 'CartController@order_detail');
    Route::get('/download-invoice/{id}', 'CartController@download_invoice');






    // LoginUser Group

    Route::group(['middleware' => 'LoggedUser'], function () {

        Route::get('/shipping-details', [

            'uses' => 'CartController@shipping_details',

            'as'   => 'shipping-details'

        ]);

        Route::post('/payment', [

            'uses' => 'CartController@payment',

            'as'   => 'payment'

        ]);

        Route::get('/edit-shipping-detail/{id}', [

            'uses' => 'CartController@edit_shipping_detail',

            'as'   => 'edit-shipping-detail'

        ]);

        Route::any('/remove-shipping-detail/{id}', [

            'uses' => 'CartController@remove_shipping_detail',

            'as'   => 'remove-shipping-detail'

        ]);

        Route::any('/coupon-check/', 'CartController@coupon_check');

        Route::any('/coupon-cancel', 'CartController@coupon_cancel');

        Route::get('/save-payment', 'CartController@save_payment');
    });


    /*-----------------Admin management start------------------------*/



    Route::group(['namespace' => 'Admin', 'prefix' => 'control-panel'], function () {



        Route::get('/', 'Auth\LoginController@showLoginForm');

        Route::any('admin-login', 'Auth\LoginController@admin_login');

        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');

        Route::post('password/reset', 'Auth\ResetPasswordController@reset');

        /*----------------   Route::get('register', 'Auth\RegisterController@showRegistrationForm');  -----------*/

        /*----------------  Route::post('register', 'Auth\RegisterController@register');  -----------*/

        Route::get('dashboard', 'HomeController@index');
        
        Route::get('popup-management', 'HomeController@Popup');
        Route::post('edit-popup', 'HomeController@Update_Popup');
        Route::get('remove-popup-image', 'HomeController@Remove_Popup_Image');

        Route::get('setting-management', 'HomeController@Setting');
        Route::post('edit-setting', 'HomeController@Update_Setting');

        Route::post('/reset-admin-password', [

            'uses' => 'PasswordController@reset_admin_password',

            'as'   => 'reset-admin-password'

        ]);





        Route::get('get-graphdata', 'HomeController@Grafh');


        Route::get('update-cms/{id}', 'CMSController@Update_CMS');

        Route::any('edit-cms/{id}', 'CMSController@Edit_CMS');

        Route::get('contact-us', 'CMSController@Contact_Us');

        Route::any('save-contact-us', 'CMSController@Save_Contact_Us');



        Route::get('corporate-management', 'CMSController@Corporate_Management');

        Route::get('about-management', 'CMSController@About_Management');



        /************************ PAGE SECTION MANAGEMENT ********************/

        Route::get('page-section', 'HomeController@Page_Section');

        Route::get('identification/page-section', 'HomeController@Identification_Page_Section');

        Route::get('page-sections', 'HomeController@Page_Sections');

        Route::get('/update-page-section/{id}', 'HomeController@Update_Page_Section');

        Route::any('edit-page-section', 'HomeController@Edit_Page_Section');

        /************************* END PAGESECTION **************************/






        /******************* START Testimonial MANAGEMENT *************************/

        Route::get('/testimonial-management', 'TeamController@index');
        Route::get('/new-testimonial', 'TeamController@New');
        Route::get('/update-testimonial/{Id}', 'TeamController@Update');
        Route::post('/save-testimonial', 'TeamController@Save');
        Route::post('/edit-testimonial/{id}', 'TeamController@Edit');
        Route::post('/remove-testimonial', 'TeamController@Remove');
        Route::get('/testimonial-status/{status}/{id}', 'TeamController@Status');
        Route::get('/testimonial-slider-status/{id}', 'TeamController@slider_status');


        /******************* END TEAM MANAGEMENT *************************/





        /********************** Our Clients Management ********************/

        Route::get('/our-clients', 'GalleryController@index')->name('gallery-management');
        Route::get('/our-clients-status/{status}/{id}', 'GalleryController@Status')->name('gallery-status');
        Route::get('/our-clients-remove/{orderid}', 'GalleryController@Remove')->name('gallery-remove');
        Route::post('/save-our-clients', 'GalleryController@Save')->name('save-gallery');
        Route::get('/update-our-clients/{id}', 'GalleryController@Update')->name('update-gallery');
        Route::post('/edit-our-clients', 'GalleryController@Edit')->name('edit-gallery');

        /****************** End Our Clients Management ********************/





        /********************** Why Choose Us ********************/

        Route::get('/why-choose-us', 'WhyChooseController@index');
        Route::get('/update-why-choose-us/{id}', 'WhyChooseController@Update');
        Route::get('/why-choose-us-status/{status}/{id}', 'WhyChooseController@Status');
        Route::get('/why-choose-us-remove/{id}', 'WhyChooseController@Remove');
        Route::post('/save-why-choose-us', 'WhyChooseController@Save');
        Route::post('/edit-why-choose-us', 'WhyChooseController@Edit');


        /****************** End Why Choose Us ********************/







        /********************** Order Management ********************/

        Route::get('/order-management', 'OrderController@index');
        Route::get('/order-details/{id}', 'OrderController@Details');
        Route::get('/order-remove/{id}', 'OrderController@Remove');
        Route::get('/order-status-change/{id}/{order_id}', 'OrderController@order_status_change');
        Route::get('/payment-status-change/{id}/{order_id}', 'OrderController@payment_status_change');

        /****************** End Order Management ********************/











        /******************** Blog Management Routes Start **************************/

        Route::get('/blog-management', 'BlogController@index');
        Route::get('/blog-category', 'BlogController@blog_category');
        Route::get('/blog-post', 'BlogController@blog_post');
        Route::post('/blog-add-category', 'BlogController@add_category');
        Route::post('/cat-change-sequence', 'BlogController@cat_change_sequence');
        Route::get('/blog-home-status/{id}', 'BlogController@blog_home_status');

        Route::get('/blog-delete-category/{id}', [
            'uses' => 'BlogController@category_delete',
            'as'   => 'blog-delete-category'
        ]);
        Route::get('/change-category-status/{status}/{id}', [
            'uses' => 'BlogController@category_status',
            'as'   => 'change-category-status'
        ]);
        Route::get('/blog-edit-category/{id}', [
            'uses' => 'BlogController@edit_blog',
            'as'   => 'blog-edit-category'
        ]);
        Route::post('/update-blog-category/{id}', [
            'uses' => 'BlogController@update_category',
            'as'   => 'update-blog-category'
        ]);
        Route::get('/add-blog-post', 'BlogController@add_post');
        Route::post('/post-add', [
            'uses' => 'BlogController@post_add',
            'as'   => 'post-add'
        ]);
        Route::get('/blog-edit-post/{id}', [
            'uses' => 'BlogController@edit_post',
            'as'   => 'blog-edit-post'
        ]);

        Route::get('/change-post-status/{id}/{status}', [
            'uses' => 'BlogController@change_post_status',
            'as'   => 'change-post-status'
        ]);

        Route::get('/change-top5-status/{id}/{status}', [
            'uses' => 'BlogController@change_top5_status',
            'as'   => 'change-top5-status'
        ]);


        Route::get('/change-press-room-status/{id}/{status}', [
            'uses' => 'BlogController@change_Press_Room_status',
            'as'   => 'change-press-room-status'
        ]);


        Route::get('/change-post-status-trend/{id}/{status}', [
            'uses' => 'BlogController@change_post_status_trend',
            'as'   => 'change-post-status-trend'
        ]);
        Route::post('/post-change-sequence', [
            'uses' => 'BlogController@post_change_sequence',
            'as'   => 'post-change-sequence'
        ]);
        Route::post('/post-update/{id}', [
            'uses' => 'BlogController@post_update',
            'as'   => 'post-update'
        ]);
        Route::get('/blog-delete-post/{id}/{image?}', [
            'uses' => 'BlogController@post_delete',
            'as'   => 'blog-delete-post'
        ]);
        Route::get('/blog-post-slider/{id}/{image?}', [
            'uses' => 'BlogController@slider_post_delete',
            'as'   => 'blog-post-slider'
        ]);
        Route::get('/blog-meta', 'BlogController@blog_meta');
        Route::post('/update-meta-blog', 'BlogController@blog_meta_update');

        Route::get('/blog-comment-list', 'BlogController@blog_comment_list');
        Route::get('/comment-edit-form/{id}', 'BlogController@blog_comment_EditForm');
        Route::get('/comment-status/{id}', 'BlogController@comment_status');
        Route::get('/comment-delete/{id}', 'BlogController@comment_delete');
        Route::post('/edit-comment', 'BlogController@Edit_Comment');


        /******************* Blog Management Routes End ***************************/






        /**************************** Pricing *******************************/

        Route::get('pricing/{catgory_id}', 'InstallmentsController@index');

        Route::get('new-pricing/{catgory_id}', 'InstallmentsController@New');

        Route::post('save-pricing', 'InstallmentsController@Save');

        Route::get('update-pricing/{id}', 'InstallmentsController@Update');

        Route::post('edit-pricing/{id}', 'InstallmentsController@Edit');

        Route::get('pricing-status/{status}/{id}', 'InstallmentsController@Status');

        Route::post('remove-pricing', 'InstallmentsController@Remove');

        Route::get('remove-pricing-list/{id}', 'InstallmentsController@Remove_Lists');
        Route::get('top-selling/{id}', 'InstallmentsController@top_selling');



        /**************************** END Pricing ***************************/





        /********************** Service Management ********************/

        Route::get('/service-management/{id?}', 'ServiceController@index');
        Route::get('/service-status/{status}/{id}', 'ServiceController@Status');
        Route::post('/save-service/', 'ServiceController@Save');
        Route::get('/update-service/{id}', 'ServiceController@Update');
        Route::get('/service-remove/{id}', 'ServiceController@Remove');
        Route::post('/edit-service', 'ServiceController@Edit');
        Route::get('/service-category-change/{type}/{category_id}', 'ServiceController@service_category_change');




        Route::get('/category-banner/{id}', 'ServiceController@Banner');

        Route::post('/edit-service-banner', 'ServiceController@Edit_Banner');

        Route::get('/remove-banner-list/{id}', 'ServiceController@Remove_Lists');


        Route::get('/home-status/{id}', 'ServiceController@home_status');
        Route::get('/footer-status/{id}', 'ServiceController@footer_status');
        Route::get('/menu-status/{id}', 'ServiceController@menu_status');

        /****************** End Service Management ********************/








        /********************** TAX Management ********************/

        Route::get('/tax-return', 'TaxController@index');
        Route::get('/tax-return-status/{status}/{id}', 'TaxController@Status');
        Route::post('/save-tax-return/', 'TaxController@Save');
        Route::get('/update-tax-return/{id}', 'TaxController@Update');
        Route::get('/tax-return-remove/{id}', 'TaxController@Remove');
        Route::post('/edit-tax-return', 'TaxController@Edit');

        Route::get('/tax-banner/{id}', 'TaxController@Update');


        Route::post('/tax-enquiry-save', 'TaxController@tax_enquiry_save');
        Route::get('/tax-enquiry-list', 'TaxController@tax_enquiry_list');
        Route::get('/tax-enquiry-delete/{id}', 'TaxController@tax_enquiry_delete');
        Route::get('/tax-document-list/{id}', 'TaxController@tax_document_list');

        Route::get('/tax-top-status/{id}', 'TaxController@tax_top_status');
        Route::get('/tax-home-status/{id}', 'TaxController@tax_home_status');




        /****************** End TAX Management ********************/






        /**************************** FAQ *******************************/

        Route::get('faq-management/{category_id}', 'FaqController@index');

        Route::get('new-faq/{category_id}', 'FaqController@New');

        Route::post('save-faq', 'FaqController@Save');

        Route::get('update-faq/{id}', 'FaqController@Update');

        Route::post('edit-faq/{id}', 'FaqController@Edit');

        Route::get('faq-status/{status}/{id}', 'FaqController@Status');

        Route::post('remove-faq', 'FaqController@Remove');


        /**************************** END FAQ ***************************/





        /**************************** Pre Requirements *******************************/

        Route::get('pre-requirements/{category_id}', 'PreRequirementsController@index');

        Route::get('new-pre-requirements/{category_id}', 'PreRequirementsController@New');

        Route::post('save-pre-requirements', 'PreRequirementsController@Save');

        Route::get('update-pre-requirements/{id}', 'PreRequirementsController@Update');

        Route::post('edit-pre-requirements/{id}', 'PreRequirementsController@Edit');

        Route::get('pre-requirements-status/{status}/{id}', 'PreRequirementsController@Status');

        Route::post('remove-pre-requirements', 'PreRequirementsController@Remove');


        /**************************** END Pre Requirements ***************************/






        /**************************** Annual Roc *******************************/

        Route::get('annual-roc/{category_id}', 'ROCController@index');

        Route::get('new-annual-roc/{category_id}', 'ROCController@New');

        Route::post('save-annual-roc', 'ROCController@Save');

        Route::get('update-annual-roc/{id}', 'ROCController@Update');

        Route::post('edit-annual-roc/{id}', 'ROCController@Edit');

        Route::get('annual-roc-status/{status}/{id}', 'ROCController@Status');

        Route::post('remove-annual-roc', 'ROCController@Remove');


        /**************************** END Annual Roc ***************************/







        /**************************** Documents *******************************/

        Route::get('documents/{category_id}', 'DocumentController@index');

        Route::get('new-documents/{category_id}', 'DocumentController@New');

        Route::post('save-documents', 'DocumentController@Save');

        Route::get('update-documents/{id}', 'DocumentController@Update');

        Route::post('edit-documents/{id}', 'DocumentController@Edit');

        Route::get('documents-status/{status}/{id}', 'DocumentController@Status');

        Route::post('remove-documents', 'DocumentController@Remove');


        /**************************** END Documents ***************************/










        /********************************* ENQUIRY MANAGEMENT *************************/

        Route::get('/contact-enquiry', 'EnquiryController@Contact_Enquuiry');

        Route::get('/contact-enquiry-remove/{id}', 'EnquiryController@Remove_Contact_Enquuiry');


        Route::get('/footer-enquiry', 'EnquiryController@Footer_Enquuiry');

        Route::get('/footer-enquiry-remove/{id}', 'EnquiryController@Remove_Contact_Enquuiry');



        Route::get('/project-enquiry', 'EnquiryController@Project_Enquuiry');

        Route::get('/project-enquiry-remove/{id}', 'EnquiryController@Remove_Contact_Enquuiry');


        /********************************* END ENQUIRY MANAGEMENT *************************/


        /********************** Advantages Management ********************/

        Route::get('/advantages/{id}', 'AdvantagesController@index');
        Route::get('/advantages-status/{status}/{id}', 'AdvantagesController@Status');
        Route::get('/advantages-remove/{id}', 'AdvantagesController@Remove');
        Route::post('/save-advantages', 'AdvantagesController@Save');
        Route::get('/update-advantages/{id}', 'AdvantagesController@Update');
        Route::post('/edit-advantages', 'AdvantagesController@Edit');

        /****************** End Advantages Management ********************/


        /********************** Process Management ********************/

        Route::get('/process/{id}', 'ProcessController@index');
        Route::get('/process-status/{status}/{id}', 'ProcessController@Status');
        Route::get('/process-remove/{id}', 'ProcessController@Remove');
        Route::post('/save-process', 'ProcessController@Save');
        Route::get('/update-process/{id}', 'ProcessController@Update');
        Route::post('/edit-process', 'ProcessController@Edit');

        Route::post('/nav-heading-save', 'ProcessController@nav_heading_save');

        Route::post('/pr-requirement-list-update', 'ProcessController@pr_requirement_list_update');
        Route::post('/pr-requirement-list-add', 'ProcessController@pr_requirement_list_add');
        Route::get('/pr-requirement-list-delete/{id}', 'ProcessController@pr_requirement_list_delete');



        /****************** End Process ********************/








        /******************* START BANNER MANAGEMENT *************************/

        Route::get('/banner-management', 'BannerController@index');
        Route::get('/new-banner', 'BannerController@New_Banner');
        Route::get('/update-banner/{bannerId}', 'BannerController@Update_Banner');
        Route::post('/save-banner', 'BannerController@Save_Banner');
        Route::post('/edit-banner/{bannerid}', 'BannerController@Edit_Banner');
        Route::post('/remove-banner', 'BannerController@Banner_Remove');
        Route::get('/banner-status/{status}/{bannerid}', 'BannerController@Banner_Status');
        Route::get('/banner-main-heading/{status}/{bannerid}', 'BannerController@Banner_Main_Status');
        Route::post('/save-content/{contentid}', 'BannerController@Save_BannerContent');

        /******************* END BANNER MANAGEMENT *************************/







        /*------------------Change Account start----------------------*/



        Route::post('/change-admin-account/{id}', [

            'uses' => 'UserController@change_admin_account',

            'as'   => 'change-admin-account'

        ]);



        /*-----------------change account end-------------------------*/





        /*-------------------Social Icon Route start--------------------*/







        Route::get('/social-icon-links', 'SocialiconController@index');



        Route::post('/edit-social-links/{id}', [

            'uses' => 'SocialiconController@edit_social_links',

            'as'   => 'edit-social-links'

        ]);



        Route::get('/newsletters-export', [

            'uses' => 'HomeController@newletter_export',

            'as'   => 'newsletters-export'

        ]);

        Route::get('/contact-export', [

            'uses' => 'CmsController@contact_export',

            'as'   => 'contact-export'

        ]);


        /*-------------------Online payment start-------------------*/

        Route::get('/online-payment-list', 'PaymentController@online_payment_list');
        Route::get('/online-payment-detail/{id}', 'PaymentController@online_payment_detail');
        Route::get('/online-payment-delete/{id}', 'PaymentController@online_payment_delete');


        /*-------------------Online payment ends-------------------*/


        /*-------------------User Management start-------------------*/

        Route::get('/user-list', 'UserController@user_list');
        Route::get('/user-status/{id}', 'UserController@user_status');
        Route::get('/user-detail/{id}', 'UserController@user_detail');
        Route::get('/user-delete/{id}', 'UserController@user_delete');


        /*-------------------User Management ends-------------------*/

        /*-------------------Coupon Management start-------------------*/

        Route::get('/coupon-add', 'CouponController@coupon_add');
        Route::post('/coupon-save', 'CouponController@coupon_save');
        Route::get('/coupon-list', 'CouponController@coupon_list');
        Route::get('/coupon-status/{id}', 'CouponController@coupon_status');
        Route::get('/coupon-edit/{id}', 'CouponController@coupon_edit');
        Route::post('/coupon-update', 'CouponController@coupon_update');
        // /Route::get('/coupon-detail/{id}', 'CouponController@coupon_detail');
        Route::get('/coupon-delete/{id}', 'CouponController@coupon_delete');


        /*-------------------Coupon Management ends-------------------*/


        /*-------------------Promoter Management start-------------------*/

        Route::get('/promoter-add', 'PromoterController@promoter_add');
        Route::post('/promoter-save', 'PromoterController@promoter_save');
        Route::get('/promoter-list', 'PromoterController@promoter_list');
        Route::get('/promoter-status/{id}', 'PromoterController@promoter_status');
        Route::get('/promoter-edit/{id}', 'PromoterController@promoter_edit');
        Route::post('/promoter-update', 'PromoterController@promoter_update');
        Route::get('/promoter-delete/{id}', 'PromoterController@promoter_delete');


        /*-------------------Promoter Management ends-------------------*/

        /*-------------------Heading Section start-------------------*/

        Route::get('/heading-list', 'HeadingController@heading_list');
        Route::get('/heading-edit/{id}', 'HeadingController@heading_edit');
        Route::post('/heading-update', 'HeadingController@heading_update');


        /*-------------------Heading Section ends-------------------*/


        /*-------------------Consultancy Enquiry start-------------------*/

        Route::get('/consultancy-enquiry-list', 'ConsultancyController@consultancy_enquiry_list');
        Route::get('/consultancy-enquiry-delete/{id}', 'ConsultancyController@consultancy_enquiry_delete');


        /*-------------------Consultancy Enquiry ends-------------------*/

        /*-------------------Newsletter start-------------------*/

        Route::get('/newsletter-list', 'NewsLetterController@newsletter_list');
        Route::get('/newsletter-delete/{id}', 'NewsLetterController@newsletter_delete');

        /*-------------------Newsletter ends-------------------*/

        /*-------------------career-enquiry start-------------------*/

        Route::get('/career-enquiry-list', 'CareerController@career_enquiry_list');
        Route::get('/career-enquiry-remove/{id}', 'CareerController@career_enquiry_remove');

        /*-------------------career-enquiry ends-------------------*/

        /*-------------------Social Media Management start-------------------*/

        Route::get('/social-list', 'SocialMediaController@social_list');
        Route::get('/social-edit/{id}', 'SocialMediaController@social_edit');
        Route::post('/social-update', 'SocialMediaController@social_update');
        Route::get('/social-save', 'SocialMediaController@social_save');
        Route::get('/social-status/{id}', 'SocialMediaController@social_status');


        /*-------------------Social Media Management ends-------------------*/
    });

    Route::get('/blog', 'HomeController@blog');
    Route::get('/blog-detail/{alias}', 'HomeController@blog_detail');
    Route::get('/category-wise-blog-post/{id}', 'HomeController@category_wise_blog_post');
    Route::get('/month-wise-post/{month}', 'HomeController@month_wise_post');

    Route::post('/comment-save', 'HomeController@comment_save');

    Route::get('/tax-detail/{alias}', 'HomeController@tax_detail');


    Route::post('/consultancy-form-save', 'HomeController@form_save');

    Route::post('/newsletter-save', 'Admin\NewsLetterController@newsletter_save');

    Route::get('/get-cities/{id}', 'HomeController@get_cities');

    Route::get('/testimonial-list', 'HomeController@testimonial_list');



    /*-----------------Admin management end------------------------*/
});
