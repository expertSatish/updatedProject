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
          <form action="{!! url('control-panel/post-change-sequence') !!}" enctype="multipart/form-data" id="demo-form2" method="post" class="form-horizontal form-label-left">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Post Management</small></h2>
                  <a href="{!! url('control-panel/blog-management') !!}" class="btn btn-danger pull-right"><i class="fa fa-backward"></i> Back</a>
                  <button type="submit" class="btn btn-success pull-right"><i class="fa fa-pencil-square-o"></i> Change Sequence</button>
                  <a href="{!! url('control-panel/add-blog-post') !!}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Post </a>


                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table id="datatable" class="table table-striped table-bordered bulk_action">
                    <thead>
                      <tr>
                        <th>Sr.No. </th>
                        <th>Name</th>
                        <th>Post Date</th>
                        <th>Status</th>
                        <!-- <th>Top 5 Status</th> -->
                        <!--                    <th>Press Room</th>  -->
                        <th>Sequence</th>
                        <th>Home Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($categories as $data)


                      <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $data->post_name }} </td>
                        <td> {{ $data->created_at }} </td>

                        <td><?php $category_status = $data->post_status; ?>
                          @if($category_status==1)

                          <a href="{!! route('change-post-status', ['status'=>0,'id'=>$data->post_id]) !!}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Active</a>
                          @else
                          <a href="{!! route('change-post-status', ['status'=>1,'id'=>$data->post_id]) !!}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactive</a>
                          @endif
                        </td>

                        <td style="display: none;"><?php $top5_status = $data->top5_status; ?>
                          @if($top5_status==1)

                          <a href="{!! route('change-top5-status', ['status'=>0,'id'=>$data->post_id]) !!}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Active</a>
                          @else
                          <a href="{!! route('change-top5-status', ['status'=>1,'id'=>$data->post_id]) !!}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactive</a>
                          @endif
                        </td>

                        <!--
                    <td><?php $press_room = $data->press_room; ?>
                    @if($press_room==1) 
                    
                    <a href="{!! route('change-press-room-status', ['status'=>0,'id'=>$data->post_id]) !!}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Active</a>
                    @else 
                    <a href="{!! route('change-press-room-status', ['status'=>1,'id'=>$data->post_id]) !!}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactive</a>
                    @endif </td> 
-->



                        <td>
                          <input type="text" name="sequence[{!! $data->post_id !!}]" style="width:40px" value="{!! $data->post_sort !!}" class="form-control">
                        </td>

                        <td>
                          @if($data->home_status==1)
                          <a href="{{url('/control-panel/blog-home-status/'.$data->post_id)}}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Active</a>
                          @else
                          <a href="{{url('/control-panel/blog-home-status/'.$data->post_id)}}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactive</a>
                          @endif
                        </td>

                        <td>
                          <a href="{!! route('blog-edit-post', ['id'=>$data->post_id]) !!}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                          <?php $image = "";
                          if ($data->type == 1) {
                            $image = $data->post_image;
                          } ?>

                          {!! Helper::HRFRemoveBTN(route('blog-delete-post', ['id'=>$data->post_id,'image'=>$image]))!!}

                        </td>
                      </tr>
                      @endforeach
                    </tbody>

                  </table>
                </div>
              </div>
            </div>
          </form>
          <!--------------------table data end-------------------------->
        </div>
      </div>


      <footer> @include('control-panel.inc.footer') </footer>

      <script>
        function validation() {
          var name = $('#name').val();
          var nameExp = /^[a-zA-Z](.*[a-zA-Z]){2,}?$/;
          if (name == "" || name.trim() == "") {
            toastr.error("Please Fill Name");
            $('#name').css('border-color', 'red');
            $("#name").focus();
            return false;
          }
          if (!nameExp.test(name)) {
            toastr.error("Minimum 3 Character Accepted. Don't Use Special character and Space");
            $('#name').css('border-color', 'red');
            $("#name").focus();
            return false;
          } else {
            return true;
          }
          return false;
        }

        function deleletconfig() {

          var del = confirm("Are you sure you want to delete this record?");
          if (del == true) {} else {

          }
          return del;
        }
      </script>
      <!-- Editor -->
      <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
      </script>