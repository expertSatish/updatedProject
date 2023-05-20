@include('control-panel.inc.header')

<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      @include('control-panel.inc.side-menu')

      <div class="right_col" role="main">
        <div class="row">
          @if(session()->has('success_msg')) <?php echo Helper::SuccessAlert(session()->get('success_msg')); ?> @endif
          @if(session()->has('error_msg')) <?php echo Helper::ErrorAlert(session()->get('error_msg')); ?> @endif
          @include('control-panel.inc.alerts')

        </div>

        <div class="row">
          <!--------------------table data start-------------------------->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2 class="pull-left">Edit Coupon</h2>
                <a href="{!! url('control-panel/coupon-list') !!}" class="btn btn-info pull-right"><i class="fa fa-reply"></i> Back </a>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-lg-12">
                    <form action="{{url('/control-panel/coupon-update')}}" method="post">
                      @csrf
                      <div class="col-lg-6 form-group">
                        <label>Coupon Name</label>
                        <input type="hidden" value="{{$coupon->coupon_id}}" name="id">
                        <input type="text" class="form-control" name="name" value="{{$coupon->name}}" required>
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Coupon Percentage</label>
                        <input type="text" class="form-control" name="percentage" onkeypress="return isNumberKey(event);" value="{{$coupon->percentage}}" required>
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Start Date</label>
                        <input type="text" class="form-control datepicker" placeholder="Select date" name="start_date" value="{{date('d-m-Y', strtotime($coupon->start_date))}}" readonly>
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>End Date</label>
                        <input type="text" class="form-control datepicker" placeholder="Select date" name="end_date" value="{{date('d-m-Y', strtotime($coupon->end_date))}}" readonly>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="margin-top: 2%;">Update</button>
                      </div>
                    </form>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!--------------------table data end-------------------------->
        </div>
      </div>


      <footer> @include('control-panel.inc.footer') </footer>