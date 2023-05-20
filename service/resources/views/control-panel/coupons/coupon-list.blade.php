@include('control-panel.inc.header')

<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      @include('control-panel.inc.side-menu')

      <div class="right_col" role="main">
        <div class="row">
          @if(session()->has('success_msg')) <?php echo Helper::SuccessAlert(session()->get('success_msg')); ?> @endif
          @if(session()->has('error_msg')) <?php echo Helper::ErrorAlert(session()->get('error_msg')); ?> @endif

        </div>

        <div class="row">
          <!--------------------table data start-------------------------->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Coupon Management</small></h2>
                <a href="{!! url('control-panel/coupon-add') !!}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Coupon </a>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable" class="table table-striped table-bordered bulk_action">
                  <thead>
                    <tr>
                      <th>Sr.No. </th>
                      <th>Coupon Name</th>
                      <th>Percentage</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($coupons as $i)
                    <tr>
                      <td> {{ $loop->iteration }} </td>
                      <td> {{ $i->name }} </td>
                      <td> {{ $i->percentage }}% </td>
                      <td> {{ date("d-m-Y", strtotime($i->start_date)) }} </td>
                      <td> {{ date("d-m-Y", strtotime($i->end_date)) }} </td>
                      <td>
                        @if($i->status==1)
                        <a href="{{url('/control-panel/coupon-status/'.$i->coupon_id)}}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Active</a>
                        @else
                        <a href="{{url('/control-panel/coupon-status/'.$i->coupon_id)}}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactive</a>
                        @endif
                      </td>
                      <td>
                        <a href="{{url('/control-panel/coupon-edit/'.$i->coupon_id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="{{url('/control-panel/coupon-delete/'.$i->coupon_id)}}" onclick="return confirm('Are you sure? Want to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-pencil"></i> Remove</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
            </div>
          </div>
          <!--------------------table data end-------------------------->
        </div>
      </div>


      <footer> @include('control-panel.inc.footer') </footer>