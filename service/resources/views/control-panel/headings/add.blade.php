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
                <h2 class="pull-left">Add Promoter</h2>
                <a href="{!! url('control-panel/promoter-list') !!}" class="btn btn-info pull-right"><i class="fa fa-reply"></i> Back </a>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-lg-12">
                    <form action="{{url('/control-panel/promoter-save')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="col-lg-6 form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{old('name')}}" required>
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Designation</label>
                        <input type="text" class="form-control" name="designation" placeholder="Designation" value="{{old('designation')}}" required>
                      </div>
                      <div class="col-lg-12 form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" id="Description1">{{old('description')}}</textarea>
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Image</label> <span class="text-danger">(Best image Size 80 X 80px)</span>
                        <input type="file" class="form-control" name="image_url" required>
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Facebook Link</label>
                        <input type="text" class="form-control" name="facebook_url" placeholder="Enter Facebook Link" value="{{old('facebook_url')}}">
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Instagram Link</label>
                        <input type="text" class="form-control" name="instagram_url" placeholder="Enter Instagram Link" value="{{old('instagram_url')}}">
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Linkedin Link</label>
                        <input type="text" class="form-control" name="linkedin_url" placeholder="Enter LinkedIn Link" value="{{old('linkedin_url')}}">
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Twitter Link</label>
                        <input type="text" class="form-control" name="twitter_url" placeholder="Enter Twitter Link" value="{{old('twitter_url')}}">
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Youtube Link</label>
                        <input type="text" class="form-control" name="youtube_url" placeholder="Enter Youtube Link" value="{{old('youtube_url')}}">
                      </div>

                      <div class="col-lg-12 text-center">
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