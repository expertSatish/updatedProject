<div class="br-header">

    <div class="br-header-left">

      <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a></div>

      <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a></div>

      {{-- <div class="input-group hidden-xs-down wd-170 transition">

        <input id="searchbox" type="text" class="form-control" placeholder="Search">

        <span class="input-group-btn">

          <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>

        </span>

      </div> --}}

    </div><!-- br-header-left -->

    <div class="br-header-right">

      <nav class="nav">

        <div class="dropdown">

          <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">

            <span class="logged-name hidden-md-down">{{Auth::guard('admin')->user()->name}}</span>

            <img src="{{asset('admin/img/img.jpg')}}" class="wd-32 rounded-circle" alt="">

            <span class="square-10 bg-success"></span>

          </a>

          <div class="dropdown-menu dropdown-menu-header wd-200">

            <ul class="list-unstyled user-profile-nav">

              <li><a href="{{route('admin.change-password')}}"><i class="icon ion-ios-unlocked"></i> Change Password</a></li>

              <li><a href="{{route('admin.socialmedia')}}"><i class="icon ion-link"></i> Social Media</a></li>

              <li><a href="{{route('admin.footersection')}}"><i class="icon ion-ios-gear"></i> Footer Section</a></li>

              <li><a href="{{route('admin.logout')}}"><i class="icon ion-power"></i> Sign Out</a></li>

            </ul>

          </div>

        </div>

      </nav>

    </div>

  </div>