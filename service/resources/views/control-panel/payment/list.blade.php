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
                <h2>Online Payment</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable1" class="table table-striped table-bordered bulk_action">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Amount</th>
                      <th>Contact</th>
                      <th>Payment Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  @foreach($payment_list as $Rows)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$Rows->name}}</td>
                    <td>{{$Rows->email}}</td>
                    <td>{{$Rows->amount}}</td>
                    <td>{{$Rows->contact}}</td>
                    @if($Rows->payment_status==1)
                    <td><span class="badge badge-success text-white">Success</span></td>
                    @else
                    <td><span class="badge badge-danger text-white">Failed</span></td>
                    @endif
                    <td>
                      <div class="dropdown">
                        <button type="button" id="action_btn1" class="btn btn-primary btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-archive"></i> Action <i class="fa fa-angle-down" aria-hidden="true"></i></button>
                        <div class="dropdown-menu" aria-labelledby="action_btn1">
                          <a href="#exampleModalCenter" data-toggle="modal" onclick="getModaldata({{$Rows->online_payment_id}})" class="dropdown-item"><i class="fa fa-pencil"></i> Detail</a>
                          <a href="{{url('/control-panel/online-payment-delete/'.$Rows->online_payment_id)}}" class="dropdown-item"><i class="fa fa-trash"></i> Remove</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!--------------------table data end-------------------------->
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title h4 text-center font-weight-bold" id="exampleModalLongTitle"><strong>Payment Details</strong></h5>
            </div>

            <div class="modal-body" id="modalbox"></div>

            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>




      <footer> @include('control-panel.inc.footer') </footer>
      <script>
        $(document).ready(function() {

          $("#datatable1").dataTable();
        });

        function getModaldata(id) {

          $('#modalbox').html('<center><img src="http://www.distribuidoraselecta.com/images/loading.gif"></center>');

          $(document).ready(function() {
            $.ajax({
              url: "{{url('/control-panel/online-payment-detail')}}" + "/" + id,
              type: 'GET',
              success: function(data) {
                $('#modalbox').html(data);
              }
            });
          });


        }
      </script>
</body>