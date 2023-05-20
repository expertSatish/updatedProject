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
                <h2>Update @if($flag){{$array_data->title}}@else CMS @endif </h2>

                <?php if ($array_data->id == 30) { ?>
                  <a href="{{url('control-panel/update-page-section/46')}}" class="btn btn-warning pull-right"><i class="fa fa-file-text"></i> Meta Management </a>
                <?php } ?>

                <?php if ($array_data->id == 19) { ?>
                  <a href="{{url('control-panel/update-page-section/48')}}" class="btn btn-warning pull-right"><i class="fa fa-file-text"></i> Meta Management </a>
                  <a href="{{url('control-panel/update-cms/56')}}" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> WE ARE FRIENDLY </a>
                  <a href="{{url('control-panel/update-cms/57')}}" class="btn btn-success pull-right"><i class="fa fa-file-text"></i> ONTIME PAYMENT </a>
                  <a href="{{url('control-panel/update-cms/58')}}" class="btn btn-info pull-right"><i class="fa fa-file-text"></i> ONTIME GROWTH </a>
                <?php } ?>

                <?php if ($array_data->id == 56) { ?>
                  <a href="{{url('control-panel/update-cms/19')}}" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> Careers </a>
                  <a href="{{url('control-panel/update-cms/57')}}" class="btn btn-success pull-right"><i class="fa fa-file-text"></i> ONTIME PAYMENT </a>
                  <a href="{{url('control-panel/update-cms/58')}}" class="btn btn-info pull-right"><i class="fa fa-file-text"></i> ONTIME GROWTH </a>
                <?php } ?>


                <?php if ($array_data->id == 57) { ?>
                  <a href="{{url('control-panel/update-cms/19')}}" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> Careers </a>
                  <a href="{{url('control-panel/update-cms/56')}}" class="btn btn-warning pull-right"><i class="fa fa-file-text"></i> WE ARE FRIENDLY </a>
                  <a href="{{url('control-panel/update-cms/58')}}" class="btn btn-info pull-right"><i class="fa fa-file-text"></i> ONTIME GROWTH </a>
                <?php } ?>

                <?php if ($array_data->id == 58) { ?>
                  <a href="{{url('control-panel/update-cms/19')}}" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> Careers </a>
                  <a href="{{url('control-panel/update-cms/56')}}" class="btn btn-warning pull-right"><i class="fa fa-file-text"></i> WE ARE FRIENDLY </a>
                  <a href="{{url('control-panel/update-cms/57')}}" class="btn btn-success pull-right"><i class="fa fa-file-text"></i> ONTIME PAYMENT </a>
                <?php } ?>

                <?php if ($array_data->id == 37) { ?>
                  <a href="{{url('control-panel/current-opening')}}" class="btn btn-warning pull-right"><i class="fa fa-plus"></i> Current Opening</a>
                  <a href="{{url('control-panel/update-page-section/51')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Meta Management</a>
                <?php } ?>

                <?php if ($array_data->id == 20) { ?>
                  <a href="{{url('control-panel/update-page-section/52')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Meta Management</a>
                <?php } ?>

                <?php if ($array_data->id == 21) { ?>
                  <a href="{{url('control-panel/update-page-section/54')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Meta Management</a>
                <?php } ?>

                <?php if ($array_data->id == 22) { ?>
                  <a href="{{url('control-panel/update-page-section/55')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Meta Management</a>
                <?php } ?>

                <?php if ($array_data->id == 24) { ?>
                  <a href="{{url('control-panel/update-page-section/47')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Meta Management</a>
                <?php } ?>

                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="modal-body">
                  <form action="{{url('control-panel/edit-cms/'.$array_data->id)}}" id="demo-form2" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    @csrf
                    <div class="form-group">
                      <div class="col-md-12">
                        <label class="control-label" for="first-name">Title <span class="text-danger required">*</span> </label>
                        <input type="text" name="name" id="name" <?php if ($array_data->id == 30 || $array_data->id == 37) {
                                                                    echo "readonly";
                                                                  } ?> placeholder="Enter Page Name." value="@if($flag){{$array_data->title}}@endif" class="form-control">
                      </div>
                    </div>
                    <?php if ($array_data->id != 56  && $array_data->id != 57  && $array_data->id != 58  && $array_data->id != 20  && $array_data->id != 21  && $array_data->id != 22  && $array_data->id != 23 && $array_data->id != 24 && $array_data->id != 19 && $array_data->id != 39 && $array_data->id != 40) { ?>
                      <div class="form-group">
                        <div class="col-md-6">

                          <label class="control-label" for="first-name"><?php if ($array_data->id == 30) {
                                                                          echo "Title";
                                                                        } else {
                                                                          echo "Text 1";
                                                                        } ?> <span class="text-danger required">*</span> </label>

                          <input type="text" name="text_1" id="text_1" placeholder="Write Somthing Here.." value="@if($flag){{$array_data->text_1}}@endif" class="form-control">

                        </div>
                        <div class="col-md-6">
                          <label class="control-label" for="first-name"><?php if ($array_data->id == 30) {
                                                                          echo "Address";
                                                                        } else {
                                                                          echo "Text 2";
                                                                        } ?> <span class="text-danger required">*</span> </label>

                          <input type="text" name="text_2" id="text_2" placeholder="Write Somthing Here.." value="@if($flag){{$array_data->text_2}}@endif" class="form-control">

                        </div>

                      </div>
                    <?php } ?>
                    <?php if ($array_data->id != 56  && $array_data->id != 57  && $array_data->id != 58 && $array_data->id != 37 && $array_data->id != 19 && $array_data->id != 20 && $array_data->id != 21  && $array_data->id != 22 && $array_data->id != 23 && $array_data->id != 24  && $array_data->id != 34 && $array_data->id != 39 && $array_data->id != 40) { ?>
                      <div class="form-group">
                        <div class="col-md-6">
                          <label class="control-label" for="first-name"><?php if ($array_data->id == 30) {
                                                                          echo "Email";
                                                                        } else {
                                                                          echo "Text 3";
                                                                        } ?> <span class="text-danger required">*</span> </label>

                          <input type="text" name="text_3" id="text_3" placeholder="Write Somthing Here.." value="@if($flag){{$array_data->text_3}}@endif" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="control-label" for="first-name"><?php if ($array_data->id == 30) {
                                                                          echo "Phone";
                                                                        } else {
                                                                          echo "Text 4";
                                                                        } ?> <span class="text-danger required">*</span> </label>

                          <input type="text" name="text_4" id="text_4" placeholder="Write Somthing Here.." value="@if($flag){{$array_data->text_4}}@endif" class="form-control">
                        </div>
                      </div>
                    <?php } ?>

                    <?php if ($array_data->id != 56  && $array_data->id != 57  && $array_data->id != 58 && $array_data->id != 37 && $array_data->id != 19 && $array_data->id != 20 && $array_data->id != 21 && $array_data->id != 22 && $array_data->id != 23 && $array_data->id != 24 && $array_data->id != 34 && $array_data->id != 39) { ?>
                      <div class="form-group">
                        <div class="col-md-6">
                          <label class="control-label" for="first-name"><?php if ($array_data->id == 30) {
                                                                          echo "WhatsApp";
                                                                        } else {
                                                                          echo "Text 5";
                                                                        } ?> <span class="text-danger required"></span> </label>

                          <input type="text" name="text_5" id="text_5" placeholder="Write Somthing Here.." value="@if($flag){{$array_data->text_5}}@endif" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="control-label" for="first-name"><?php if ($array_data->id == 30) {
                                                                          echo "Address 2";
                                                                        } else {
                                                                          echo "Text 6";
                                                                        } ?> <span class="text-danger required"></span> </label>

                          <input type="text" name="text_6" id="text_6" placeholder="Write Somthing Here.." value="@if($flag){{$array_data->text_6}}@endif" class="form-control">
                        </div>
                      </div>



                    <?php } ?>


                    <?php if ($array_data->id != 30) : ?>


                      <div class="form-group">



                        <div class="col-md-12 col-sm-9 col-xs-12">

                          <label class="control-label" for="first-name">Description </label>



                          <textarea name="description" id="description" placeholder="Write Something Here...">@if($flag){{$array_data->description}}@endif</textarea>





                        </div>



                      </div>

                    <?php endif; ?>

                    <?php if ($array_data->id == 24) { ?>



                      <div class="form-group">



                        <div class="col-md-12 col-sm-9 col-xs-12">

                          <label class="control-label" for="first-name">Home Page Description: </label>



                          <textarea name="short_description" id="short_description" placeholder="Write Something Here...">@if($flag){{$array_data->short_description}}@endif</textarea>





                        </div>



                      </div>





                    <?php } ?>





                    @if($array_data->id!=20 && $array_data->id!=21 && $array_data->id!=22 && $array_data->id!=30 && $array_data->id!=28 && $array_data->id!=25 && $array_data->id!=33 && $array_data->id!=36 && $array_data->id!=39 && $array_data->id!=40 && $array_data->id!=45 && $array_data->id!=46 && $array_data->id!=48 && $array_data->id!=49 && $array_data->id!=50 && $array_data->id!=51 && $array_data->id!=52 && $array_data->id!=54)



                    <div class="form-group">



                      <div class="col-md-12">

                        <label class="control-label" for="first-name"><?php if ($array_data->id == 24) {
                                                                        echo "Youtube URL";
                                                                      } else {
                                                                        echo "Image Alt";
                                                                      } ?> <span class="text-danger required">*</span> </label>



                        <input type="text" name="image_alt" id="image_alt" placeholder="Write Somthing Here.." value="@if($flag){{$array_data->image_alt}}@endif" class="form-control">

                        @if($array_data->id==24)

                        <br><br>

                        {!! preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe class=\"w-100\" height=\"200\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$array_data->image_alt) !!}

                        @endif

                        <!-- <span class="text-danger required">Best Image Size 1920 * 300</span> -->



                      </div>







                    </div>



                    @if($array_data->id!=24)

                    <div class="form-group">



                      <div class="col-md-4">

                        <label class="control-label" for="first-name">Image



                          @if($array_data->id==19) <span class="text-danger required"> ( Best Image Size 585 * 390 ) </span> @endif

                          @if($array_data->id==37 || $array_data->id==34) <span class="text-danger required"> ( Best Image Size 600 * 450 ) </span> @endif

                          @if($array_data->id==30) <span class="text-danger required"> ( Best Image Size 860 * 650 ) </span> @endif

                          @if($array_data->id==20 || $array_data->id==21 || $array_data->id==22) <span class="text-danger required"> ( Best Image Size 580 * 450 ) </span> @endif

                          @if($array_data->id==56 || $array_data->id==57 || $array_data->id==58) <span class="text-danger required"> ( Best Image Size 100 * 100 ) </span> @endif


                          @if($array_data->id==24) <span class="text-danger required"> ( Best Image Size 450 * 390 ) </span> @endif





                        </label>

                        <input type="file" name="image" onchange="readURL(this);" id="image" class="form-control">

                        <input type="hidden" name="preimage" id="PreImage" class="form-control" value="@if($flag){{$array_data->image}}@endif">







                      </div>



                      <div class="col-md-2">



                        @if($flag)



                        @if(!empty($array_data->image))



                        <img src="{{asset('resources/assets/uploads/cms/'.$array_data->image)}}" id="blah" width="100%">



                        @else





                        <img src="{{asset('resources/assets/img/NoImage.png')}}" id="blah" width="100%">



                        @endif





                        @else



                        <img src="{{asset('resources/assets/img/NoImage.png')}}" id="blah" width="100%">



                        @endif



                      </div>


                    </div>

                    @endif

                    @endif



                    <div class="form-group">

                      <div class="col-md-12">



                        <button type="submit" id="svbtn" onclick="return team_validation();" class="btn btn-success pull-right"><i class="fa fa-save"></i> Save</button>



                        <button type="button" id="prcbtn" style="display:none" class="btn btn-warning pull-right"><i class="fa fa-spinner"></i> Processing...</button>



                      </div>

                    </div>







                  </form>





                </div>



              </div>

            </div>

          </div>

          <!--------------------table data end-------------------------->

        </div>

      </div>

    </div>



    <footer> @include('control-panel.inc.footer') </footer>



</body>





<script>
  <?php if ($array_data->id == 24) { ?>



    CKEDITOR.replace('short_description');





  <?php } ?>



  function team_validation()

  {



    var image = $('#image').val();

    var ext = image.split('.').pop().toLowerCase();


    if (image != '' && $.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1)

    {

      toastr.error('invalid extension! Please choose only jpg, png, jpeg.');

      return false;

    } else

    {

      $('#svbtn').hide();

      $('#prcbtn').show();

      return true;

    }









  }











  $(document).ready(function() {

    $(".chosen-select").chosen();

    CKEDITOR.replace('description');



    $('#datepicker').datepicker();



    $('.chosen-container').css('width', '100%');









  });











  function get_update_country_state(country, state)

  {

    var URL = "{{url('get-update-country-state')}}";

    $.get(URL,

      {

        country: country,

        state: state,

      },
      function(data) {



        $('#statebox').html(data);

        $('.chzn-select').chosen();

        $('.chosen-container').css('width', '100%');



      });

  }





  function get_update_state_city(state, city)

  {

    var URL = "{{url('get-update-state-city')}}";

    $.get(URL,

      {

        city: city,

        state: state,

      },
      function(data) {



        $('#citybox').html(data);

        $('.chzn-select').chosen();

        $('.chosen-container').css('width', '100%');



      });

  }
</script>





<?php if ($array_data->id != 13 && $array_data->id != 14 && $array_data->id != 15 && $array_data->id != 16 && $array_data->id != 17) : ?>



  <script>
    function readURL(input) {



      if (input.files && input.files[0]) {

        var reader = new FileReader();



        reader.onload = function(e) {

          $('#blah').attr('src', e.target.result);

        }



        reader.readAsDataURL(input.files[0]);

      }

    }







    function readURL1(input, ID) {



      if (input.files && input.files[0]) {

        var reader = new FileReader();



        reader.onload = function(e) {

          $('#blah' + ID).attr('src', e.target.result);

        }



        reader.readAsDataURL(input.files[0]);

      }

    }









    function ShowChooseImage(ID)

    {



      $("#MYimage").change(function() {



        readURL(this);

      });



    }
  </script>



<?php endif; ?>