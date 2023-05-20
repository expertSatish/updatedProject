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
                <h2>Testimonial Management</h2>
                <a href="{{url('control-panel/heading-edit/6')}}" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> Heading Section </a>
                <a href="{{url('control-panel/new-testimonial')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New </a>

                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <form action="{{url('control-panel/remove-testimonial')}}" method="post">
                  {{csrf_field()}}

                  <table id="datatable1" class="table table-striped table-bordered bulk_action">
                    <thead>
                      <tr>
                        <th width="5%"> {!! Helper::RemoveBTN() !!} <input type="checkbox" id="checkAll" name="checkAll"> </th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Designation / Country</th>
                        <th>Slider Status</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>




                    @foreach($getData as $Rows)

                    <tr>
                      <td><input type="checkbox" id="check" name="check[]" value="{{$Rows->Id}}"></td>
                      <td>
                          @if(!empty($Rows->image))
                          <img src="{{asset('resources/assets/uploads/testimonials/'.$Rows->image)}}"  width="100"> 
                          @else
                          <img src=" {{asset('resources/assets/img/NoImage.png')}}" width="100"> 
                          @endif
                         
                       </td>
                      <td>{{$Rows->title}}</td>
                      <td>{{$Rows->designation}}</td>
                      <td>
                        @if($Rows->slider_status==1)
                        <a href="{{url('/control-panel/testimonial-slider-status/'.$Rows->Id)}}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Active</a>
                        @else
                        <a href="{{url('/control-panel/testimonial-slider-status/'.$Rows->Id)}}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactive</a>
                        @endif
                      </td>
                      <td>{!! Helper::CheckDataStatus(url('control-panel/testimonial-status'),$Rows->Id,$Rows->status) !!}</td>

                      <td>

                        {!! Helper::EditBTN(url('control-panel/update-testimonial/'.$Rows->Id)) !!}

                      </td>

                    </tr>

                    @endforeach


                    <tbody>

                    </tbody>
                  </table>


                </form>


              </div>
            </div>
          </div>
          <!--------------------table data end-------------------------->
        </div>
      </div>

      <footer> @include('control-panel.inc.footer') </footer>

      <script>
        $(document).ready(function() {

          $("#datatable1").dataTable();
        });
      </script>




</body>