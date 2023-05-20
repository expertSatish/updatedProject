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
                <h2>Tax Documents</small></h2>
                <!-- <a href="{!! url('control-panel/add-blog-post') !!}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add User </a> -->
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div>
                  <center>
                    <h4><u><strong>Detail</strong></u></h4>
                  </center>
                </div>
                <table class="table table-striped table-bordered bulk_action">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <td> {{ $tax_payer->name }} </td>
                      <th>Email</th>
                      <td> {{ $tax_payer->email }} </td>
                    </tr>
                    <tr>
                      <th>Phone</th>
                      <td> {{ $tax_payer->phone }} </td>
                      <th>Pan Number</th>
                      <td>{{ $tax_payer->pan }}</td>
                    </tr>
                    <tr>
                      <th>Message</th>
                      <td colspan="3"> {{ $tax_payer->message }} </td>
                    </tr>
                  </thead>

                </table>
                <div>
                  <center>
                    <h4><u><strong>Documents</strong></u></h4>
                  </center>
                </div>
                <div class="row">
                  @foreach($documents as $i)
                  @if(pathinfo($i->document, PATHINFO_EXTENSION)=='jpg' || pathinfo($i->document, PATHINFO_EXTENSION)=='png' || pathinfo($i->document, PATHINFO_EXTENSION)=='jpeg')
                  <div class="col-lg-2">
                    <img src="{{asset('/resources/assets/uploads/tax/'.$i->document)}}" width="100px" height="100px" alt="">
                  </div>

                  @else
                  <div class="col-lg-2">
                    <a href="{{url('/resources/assets/uploads/tax/'.$i->document)}}" target="_blank"><img src="{{asset('resources/assets/frontend/images/unnamed.png')}}" width="100px" height="100px" alt=""></a>
                  </div>
                  @endif
                  @endforeach
                </div>


              </div>
            </div>
          </div>
          <!--------------------table data end-------------------------->
        </div>
      </div>


      <footer> @include('control-panel.inc.footer') </footer>