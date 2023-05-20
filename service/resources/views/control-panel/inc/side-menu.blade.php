<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="{{ url('/control-panel') }}" class="site_logo">
        <figure><img src="{{ Helper::LOGOIMGURl(Helper::ProjectLOGO()) }}" style="width: 157px;padding-left: 6em;margin-top: 10px;"></figure>
      </a>
    </div>
    <div class="clearfix"></div>
    <!-- menu profile quick info -->
    <div class="profile">
      <div class="profile_pic"> <img src="{{ asset('resources/assets/admin/images/img.png') }}" class="img-circle profile_img"> </div>
      <div class="profile_info"> <span>Welcome,</span>
        <h2>{{ Auth::guard('admins')->user()->name }}</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->
    <br />
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>Admin Panel</h3>
            <ul class="nav side-menu">
                  <li><a href="{{ url('/control-panel/dashboard') }}"><i class="fa fa-desktop"></i>Dashboard</a></li>
                  <li class="treeview">
                    <a href="javascript:void(0)">
                      <i class="fa fa-home"></i> <span>Home Management</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
        
                      <li><a href="{{ url('/control-panel/banner-management') }}"><i class="fa fa-sliders"></i>Banner Management</a></li>
        
                      <li><a href="{{ url('/control-panel/update-cms/24') }}"><i class="fa fa-clipboard"></i>About Management</a></li>
        
                      <li><a href="{{ url('/control-panel/why-choose-us') }}"><i class="fa fa-pagelines"></i>Why Choose Us</a></li>
        
                      <!-- <li><a href="{{ url('/control-panel/blog-management') }}"><i class="fa fa-newspaper-o"></i>Blog Management</a></li> -->
        
                      <li><a href="{{ url('/control-panel/our-clients') }}"><i class="fa fa-picture-o"></i>Our Clients</a></li>
        
                    </ul>
                  </li>
                  <li><a href="{{ url('/control-panel/testimonial-management') }}"><i class="fa fa-users"></i>Testimonials Management</a></li>
                  <li><a href="{{ url('/control-panel/blog-management') }}"><i class="fa fa-newspaper-o"></i>Blog Management</a></li>
                  <li><a href="{{ url('/control-panel/heading-list') }}"><i class="fa fa-users"></i> Homepage Heading Section </a></li>
                  <li><a href="{{ url('/control-panel/tax-return') }}"><i class="fa fa-book"></i>Tax Return</a></li>
                  <li><a href="{{ url('/control-panel/coupon-list') }}"><i class="fa fa-database"></i>Coupon Management</a></li>
                  <!-- <li class="treeview">
                    <a href="javascript:void(0)">
                      <i class="fa fa-code"></i> <span>Coupon Management</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                      <li><a href="{{ url('/control-panel/coupon-list') }}"><i class="fa fa-comments"></i>Coupon List</a></li>
                    </ul>
                  </li> -->

          <li><a href="{{ url('/control-panel/service-management') }}"><i class="fa fa-cubes"></i>Service Management</a></li>

          <li class="treeview">
            <a href="javascript:void(0)">
              <i class="fa fa-comments"></i> <span>Inquiry Management</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="{{ url('/control-panel/contact-enquiry') }}"><i class="fa fa-comments"></i>Contact Enquiry</a></li>
              <li><a href="{{ url('/control-panel/career-enquiry-list') }}"><i class="fa fa-comments"></i>Career Enquiry</a></li>
              <!-- <li><a href="{{ url('/control-panel/footer-enquiry') }}"><i class="fa fa-comments"></i>Footer Enquiry</a></li>
              <li><a href="{{ url('/control-panel/project-enquiry') }}"><i class="fa fa-comments"></i>Project Enquiry</a></li> -->

              <li><a href="{{ url('/control-panel/blog-comment-list') }}"><i class="fa fa-comments"></i>Blog Comments</a></li>
              <li><a href="{{ url('/control-panel/tax-enquiry-list') }}"><i class="fa fa-comments"></i>Tax Enquiry</a></li>
              <li><a href="{{ url('/control-panel/consultancy-enquiry-list') }}"><i class="fa fa-comments"></i>Consultancy Enquiry</a></li>
              <li><a href="{{ url('/control-panel/newsletter-list') }}"><i class="fa fa-comments"></i>News Letter Subscribers</a></li>
            </ul>
          </li>
          <li><a href="{{ url('/control-panel/online-payment-list') }}"><i class="fa fa-comments"></i>Online Payment</a></li>
          <li><a href="{{ url('/control-panel/page-section') }}"><i class="fa fa-globe"></i>CMS/Page Section</a></li>

          <li><a href="{{ url('/control-panel/order-management') }}"><i class="fa fa-shopping-basket"></i> Order Management </a></li>

          <li><a href="{{ url('/control-panel/user-list') }}"><i class="fa fa-user-plus"></i> User Management </a></li>
          <li><a href="{{ url('/control-panel/social-list') }}"><i class="fa fa-users"></i>Social Media Management</a></li>
          <li><a href="{{ url('/control-panel/promoter-list') }}"><i class="fa fa-users"></i> Promoter Management </a></li>

          <li><a href="{{ url('/control-panel/popup-management') }}"><i class="fa fa-image"></i> Popup Management </a></li>
          <li><a href="{{ url('/control-panel/setting-management') }}"><i class="fa fa-cogs"></i> Setting Management </a></li>

        </ul>


      </div>
    </div>

  </div>
</div>

<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu"> @include('control-panel.inc.admin-profile') </div>
</div>
<!-- /top navigation -->