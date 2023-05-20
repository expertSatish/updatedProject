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
                <h2 class="pull-left">Edit Heading</h2>
                <!-- <a href="{!! url('control-panel/heading-list') !!}" class="btn btn-info pull-right"><i class="fa fa-reply"></i> Back </a> -->
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">

                  <div class="col-lg-12">
                    <form action="{{url('/control-panel/heading-update')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="col-lg-6 form-group">
                        <label>Name</label>
                        <input type="hidden" class="form-control" name="id" value="{{$heading->heading_id}}">
                        <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{$heading->title}}" required>
                      </div>
                      <div class="col-lg-12 form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" id="Description2">{{$heading->description}}</textarea>
                      </div>
                      <div class="col-lg-12 text-center">
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

      <script>
        $(document).ready(function() {
          CKEDITOR.replace('Description2');
        });
      </script>