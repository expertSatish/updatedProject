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
                <h2 class="pull-left">Edit Promoter</h2>
                <a href="{!! url('control-panel/promoter-list') !!}" class="btn btn-info pull-right"><i class="fa fa-reply"></i> Back </a>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  <div class="col-lg-12">
                    <form action="{{url('/control-panel/promoter-update')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="col-lg-6 form-group">
                        <label>Name</label>
                        <input type="hidden" class="form-control" name="id" value="{{$promoter->promoter_id}}">
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$promoter->name}}" required>
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Designation</label>
                        <input type="text" class="form-control" name="designation" placeholder="Designation" value="{{$promoter->designation}}" required>
                      </div>
                      <div class="col-lg-12 form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" id="Description2">{{$promoter->description}}</textarea>
                      </div>


                      <div class="col-lg-6 form-group">
                        <label>Facebook Link</label>
                        <input type="text" class="form-control" name="facebook_url" placeholder="Enter Facebook Link" value="{{$promoter->facebook_url}}">
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Instagram Link</label>
                        <input type="text" class="form-control" name="instagram_url" placeholder="Enter Instagram Link" value="{{$promoter->instagram_url}}">
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Linkedin Link</label>
                        <input type="text" class="form-control" name="linkedin_url" placeholder="Enter LinkedIn Link" value="{{$promoter->linkedin_url}}">
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Twitter Link</label>
                        <input type="text" class="form-control" name="twitter_url" placeholder="Enter Twitter Link" value="{{$promoter->twitter_url}}">
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Youtube Link</label>
                        <input type="text" class="form-control" name="youtube_url" placeholder="Enter Youtube Link" value="{{$promoter->youtube_url}}">
                      </div>

                      <div class="col-lg-6 form-group">
                        <label>Image</label><br>
                        <img src="{{asset('resources/assets/uploads/promoters/'.$promoter->image_url)}}" alt="" width="100px" height="100px">
                      </div>
                      <div class="col-lg-6 form-group">
                        <label>Change Image</label>
                        <input type="file" class="form-control" name="image_url">
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