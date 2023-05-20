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
                <h2 class="pull-left">Social Media Management</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-lg-12">
                    <table id="datatable1" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>S. No.</th>
                          <th>Name</th>
                          <th width="20%">Link</th>
                          <th>Status</th>
                          <th width="10%">Actions</th>
                        </tr>
                      </thead>
                      @foreach($social_media as $i)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$i->name}}</td>
                        <td><a href="{{$i->link}}" target="_blank">Go to Link</a></td>
                        <td>
                          @if($i->status==1)
                          <a href="{{url('/control-panel/social-status/'.$i->id)}}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Active</a>
                          @else
                          <a href="{{url('/control-panel/social-status/'.$i->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactive</a>
                          @endif
                        </td>
                        <td>
                          <a href="{{url('/control-panel/social-edit/'.$i->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                        </td>
                      </tr>
                      @endforeach
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--------------------table data end-------------------------->
        </div>
      </div>


      <footer> @include('control-panel.inc.footer') </footer>

      <script>
        $(document).ready(function() {

          CKEDITOR.replace('Description1');



        });
      </script>