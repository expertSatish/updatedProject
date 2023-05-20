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
                <h2>Blog Comments</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="datatable1" class="table table-striped table-bordered bulk_action">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Date</th>    
                      <th>Post</th>
                      <th>Name | Email</th>
                      <th>Comment</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  @foreach($comment as $Rows)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{date('d M Y, H:i A',strtotime($Rows->created_at))}}</td>
                    <td>{{!empty($Rows->blog->post_name)?$Rows->blog->post_name:'----'}}</td>
                    <td>{{$Rows->name}} | {{$Rows->email}}</td>
                    <td>{{$Rows->comment}}</td>
                    <td>
                      @if($Rows->status==1)
                      <a href="{{url('/control-panel/comment-status/'.$Rows->blog_comment_id)}}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Activated</a>
                      @else
                      <a href="{{url('/control-panel/comment-status/'.$Rows->blog_comment_id)}}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> De-Activated</a>
                      @endif
                    </td>
                    <td>
                      <a href="{{url('/control-panel/comment-delete/'.$Rows->blog_comment_id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Remove</a>
                      <a href="#editmodal" onClick="getModaldata({{$Rows->blog_comment_id}})" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a>
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
      <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="post" action="{{url('control-panel/edit-comment')}}">@csrf
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title h4 text-center font-weight-bold" id="exampleModalLongTitle"><strong>Edit Comment</strong></h5>
                    </div>
                    <div class="modal-body" id="modalbox"></div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Update</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
      </div>




      <footer> @include('control-panel.inc.footer') </footer>
      <script>
        $(document).ready(function() {

          $("#datatable1").dataTable();
        });

        function getModaldata(id) {

          $('#modalbox').html('<center><img src="https://c.tenor.com/8KWBGNcD-zAAAAAC/loader.gif"></center>');
            $.ajax({
              url: "{{url('/control-panel/comment-edit-form')}}" + "/" + id,
              type: 'GET',
              success: function(data) {
                $('#modalbox').html(data);
              }
            });
        }
      </script>
</body>