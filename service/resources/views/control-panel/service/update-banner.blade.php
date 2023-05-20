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
                <h2>Update banner Management </h2>
                <?php
                $getCatdtl = DB::table('nav_category')->where('id', Request::segment(3))->first();
                if ($getCatdtl->parent == 0) {
                  $Parent = '';
                } else {
                  $Parent = $getCatdtl->parent;
                }
                ?>

                {!! Helper::BackBtn(url('control-panel/service-management/'.$Parent)) !!}
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <form method="post" action="{{url('control-panel/edit-service-banner')}}" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" id="EditId" value="{{$data->id}}">
                  <div class="modal-body">
                    <div class="row">
                      <div id="imagebox">
                        <div class="col-md-12">
                          <span>Banner Title1</span>
                          <input type="text" class="form-control" name="banner_title" id="alt" value="{{$data->banner_title}}">
                        </div>

                        <div class="col-md-12" style="margin-top: 20px;">
                          <span>Banner Title2</span>
                          <input type="text" class="form-control" name="banner_text" id="alt" value="{{$data->banner_text}}">
                        </div>

                        <div class="col-md-12" style="margin-top: 20px;">
                          <span>Banner Title3</span>
                          <input type="text" class="form-control" name="banner_text2" id="alt" value="{{$data->banner_text2}}">
                        </div>

                        <div class="col-md-12" style="margin-top: 20px;">
                          <span>Banner Title4</span>
                          <input type="text" class="form-control" name="banner_text3" id="alt" value="{{$data->banner_text3}}">
                        </div>

                        <div class="col-md-8" style="margin-top: 20px;">
                          <span>Youtube Url</span>
                          <input type="text" class="form-control" name="url" id="alt" value="{{$data->url}}">
                        </div>

                        <div class="col-md-4 text-center" style="margin-top: 20px;">
                          {!! Helper::youtube_preview($data->url,150) !!}
                        </div>



                        <!-- <div class="col-md-12" style="margin-top: 20px;">
                          <span>Banner Description</span>
                          <textarea class="form-control" name="BannerDescription" id="Description1">{{$data->banner_text}}</textarea>
                        </div> -->

                        <div class="col-md-12" style="margin-top: 20px;">
                          <span>About Description</span>
                          <textarea class="form-control" name="about" id="Description1">{{$data->about}}</textarea>
                        </div>
                        <div class="col-md-4" style="margin-top: 20px;">
                          <span>Banner Image</span> <span class="text-danger"> (Best Imaze Size 1600x475) </span>
                          <input type="file" class="form-control" name="banner_image" id="banner" onchange="readURL(this)">
                          <input type="hidden" name="prebanner" value="{{$data->banner_image}}">
                        </div>
                        <div class="col-md-2" style="margin-top: 20px;">
                          @if(!empty($data->banner_image) && file_exists(resource_path('assets/uploads/banner/'.$data->banner_image)))
                          <img src="{{asset('resources/assets/uploads/banner/'.$data->banner_image)}}" id="blah" width="100%">
                          @else
                          <img src="{{asset('resources/assets/img/NoImage.png')}}" id="blah" width="100%">
                          @endif
                        </div>
                        <?php $List = DB::table('banner_list')->where('category_id', $data->id)->get(); ?>
                        @foreach($List as $Rot)
                        <div class="col-md-11" style="margin-top: 20px;">
                          <span>Text</span>
                          <input type="hidden" name="listId[]" value="{{$Rot->id}}">
                          <input type="text" name="list[]" class="form-control" value="{{$Rot->title}}">
                        </div>
                        <div class="col-md-1" style="margin-top: 20px;">
                          <input type="hidden" id="BoxNum" value="1">
                          <a href="{{url('control-panel/remove-banner-list/'.$Rot->id)}}" class="btn btn-danger" style="margin-top: 20px;"><i class="fa fa-trash"></i></a>
                        </div>
                        @endforeach
                        <div class="col-md-11" style="margin-top: 20px;">
                          <span>Text</span>
                          <input type="text" name="list[]" class="form-control">
                        </div>
                        <div class="col-md-1" style="margin-top: 20px;">
                          <input type="hidden" id="BoxNum" value="1">
                          <button class="btn btn-primary" type="button" style="margin-top: 20px;" onclick="AddMoreBox()"><i class="fa fa-plus"></i></button>
                        </div>
                        <div id="boxCT"></div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer> @include('control-panel.inc.footer') </footer>

</body>

<script>
  $(document).ready(function() {

    CKEDITOR.replace('Description1');

    CKEDITOR.replace('Description2');

  });


  function getTypeData(data)

  {

    if (data == 'youtube')

    {

      $('#videobox').show();

      $('#imagebox').hide();

    } else

    {

      $('#imagebox').show();

      $('#videobox').hide();

    }

  }



  function readURL(input) {



    if (input.files && input.files[0]) {

      var reader = new FileReader();



      reader.onload = function(e) {

        $('#blah').attr('src', e.target.result);

      }



      reader.readAsDataURL(input.files[0]);

    }

  }



  function AddMoreBox() {
    var NumBox = $('#BoxNum').val();
    var NewBox = parseInt(NumBox) + parseInt(1);

    $('#BoxNum').val(NewBox);

    $('#boxCT').append('<span id="BoxSe' + NewBox + '"><div class="col-md-11" style="margin-top: 10px;"><span>Text</span><input type="text" name="list[]" class="form-control"></div><div class="col-md-1" style="margin-top: 10px;"><input type="hidden" id="BoxNum" value="1"><button class="btn btn-danger" type="button" style="margin-top: 20px;" onclick="RemoveMoreBox(' + NewBox + ')"><i class="fa fa-trash"></i></button></div></span>');

  }


  function RemoveMoreBox(NewBox) {
    $('#BoxSe' + NewBox).remove();
  }
</script>