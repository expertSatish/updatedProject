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
                <h2 class="pull-left">Social Media</h2>
                <a href="{!! url('control-panel/social-list') !!}" class="btn btn-info pull-right"><i class="fa fa-reply"></i> Back </a>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-lg-12">
                    <form action="{{url('/control-panel/social-update')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="col-lg-6 form-group">
                        <label>Name</label>
                        <input type="hidden" value="{{$social->id}}" name="id">
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$social->name}}" required>
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Icon</label>
                        <input type="text" class="form-control" name="icon" placeholder="Enter Name" value="{{$social->icon}}" required>
                      </div>

                      <div class="col-lg-6 form-group">
                        <label>Link</label>
                        <input type="text" class="form-control" name="link" placeholder="Enter Link" value="{{$social->link}}"">
                      </div>

                      <div class=" col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary" style="margin-top: 2%;">Submit</button>
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

          CKEDITOR.replace('Description1');



        });
      </script>