<nav>

  <div class="nav toggle">
    <!-- <a id="menu_toggle"><i class="fa fa-bars"></i></a> -->
  </div>

  <ul class="nav navbar-nav navbar-right">
    <li class="">
      <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('resources/assets/admin/images/img.png') }}" alt="">
        {{ Auth::guard('admins')->user()->name }}&nbsp;<span class=" fa fa-angle-down"></span>
      </a>

      <ul class="dropdown-menu dropdown-usermenu pull-right">
        <li><a href="{{url('control-panel/setting-management')}}"><i class="fa fa-cogs pull-right"></i> Setting</a></li>
        <li><a href="#edit_account" data-toggle="modal"><i class="fa fa-user pull-right"></i> Profile</a></li>
        <li>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out pull-right"></i> Logout
          </a>

          <form id="logout-form" action="{{ url('/control-panel/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>

        </li>
      </ul>
    </li>


  </ul>
</nav>


<!-- Modal -->
<div id="edit_account" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Profile</h4>
      </div>
      <form method="post" action="{!! route('change-admin-account', ['id'=>Auth::guard('admins')->user()->id]) !!}">
        <div class="modal-body">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{!! Auth::guard('admins')->user()->email !!}" required>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="cpassword" class="form-control" placeholder="Password">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
        </div>
      </form>
    </div>

  </div>
</div>
