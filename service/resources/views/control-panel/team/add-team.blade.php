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



                @if($flag)



                <h2>Update Testimonial Management</h2>



                @else



                <h2>New Testimonial Management</h2>



                @endif





                {!! Helper::BackBtn(url('control-panel/testimonial-management')) !!}



                <div class="clearfix"></div>

              </div>

              <div class="x_content">



                <div class="modal-body">



                  @if(!$flag)



                  <form action="{{url('control-panel/save-testimonial')}}" id="demo-form2" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">



                    @else



                    <form action="{{url('control-panel/edit-testimonial/'.$array_data->Id)}}" id="demo-form2" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">



                      @endif





                      <input type="hidden" name="_token" value="{{ csrf_token() }}">





                      <div class="form-group">



                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <label class="control-label" for="first-name">Name <span class="text-danger required">*</span> </label>

                          <input type="text" name="Title" id="Title" placeholder="Enter Name." value="@if($flag){{$array_data->title}}@endif" class="form-control">

                        </div>



                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <label class="control-label" for="first-name">Designation / Country </label>

                          <input type="text" name="Designation" id="Designation" placeholder="Enter Designation." value="@if($flag){{$array_data->designation}}@endif" class="form-control">

                        </div>





                      </div>





                      <!-- <div class="form-group">

                    

                    <div class="col-md-12">

                        <label class="control-label" for="first-name">Rating </label>

                       

                        <select class="form-control" name="company" id="company">



                          <option value="">Choose Rating</option>

                          <option value="1" <?php if ($flag) {
                                              if ($array_data->company_name == '1') : echo "selected";
                                              endif;
                                            } ?> >1</option>

                          <option value="2" <?php if ($flag) {
                                              if ($array_data->company_name == '2') : echo "selected";
                                              endif;
                                            } ?> >2</option>

                          <option value="3" <?php if ($flag) {
                                              if ($array_data->company_name == '3') : echo "selected";
                                              endif;
                                            } ?> >3</option>

                          <option value="4" <?php if ($flag) {
                                              if ($array_data->company_name == '4') : echo "selected";
                                              endif;
                                            } ?> >4</option>

                          <option value="5" <?php if ($flag) {
                                              if ($array_data->company_name == '5') : echo "selected";
                                              endif;
                                            } ?> >5</option>

                          

                        </select>



                    </div>

                   

                  </div>   -->





                      <div class="form-group">



                        <div class="col-md-12 col-sm-9 col-xs-12">

                          <label class="control-label" for="first-name">Description <span class="text-danger required">*</span> </label>



                          <textarea name="Description" id="Description" placeholder="Write Something Here...">@if($flag){{$array_data->content}}@endif</textarea>





                        </div>







                      </div>





                      <div class="form-group">



                        <div class="col-md-4">

                          <label class="control-label" for="first-name">Image <span class="text-danger required">* (Best Image Size 100 X 100 px)</span> </label>

                          <input type="file" name="Image" onchange="readURL(this);" id="image" class="form-control">

                          <input type="hidden" name="PreImage" id="PreImage" class="form-control" value="@if($flag){{$array_data->image}}@endif">

                        </div>



                        <div class="col-md-2">



                          @if($flag)



                          @if(!empty($array_data->image))



                          <img src="{{asset('resources/assets/uploads/testimonials/'.$array_data->image)}}" width="100%" id="blah">



                          @else





                          <img src="{{asset('resources/assets/img/NoImage.png')}}" id="blah" width="100%">



                          @endif





                          @else



                          <img src="{{asset('resources/assets/img/Noimage.png')}}" id="blah" width="100%">



                          @endif



                        </div>



                      </div>







                      <div class="form-group">

                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">



                          <span id="formsavebtnbox"></span>

                          <span id="formsavebtnbox2"> <?php echo Helper::SaveBTN(); ?> </span>



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
  $(document).ready(function() {

    $(".chosen-select").chosen();

    CKEDITOR.replace('Description');

  });















  function validation() {

    $('.form-control').css('border-color', '');

    var Title = $('#Title').val();

    var Description = CKEDITOR.instances.Description.getData();





    if (Title == "") {

      toastr.error("Please enter title");

      $('#Title').css('border-color', 'red');

      $("#Title").focus();



      return false;

    } else if (Description == "") {

      toastr.error("Please enter description");

      $('#Description').css('border-color', 'red');

      $("#Description").focus();

      return false;

    } else

    {

      $('#formsavebtnbox').html('<?php echo Helper::ProcessingBTN(); ?>');

      $('#formsavebtnbox2').hide();

      return true;





    }



    return false;

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



  function ShowChooseImage(ID)

  {



    $("#MYimage").change(function() {



      readURL(this);

    });



  }
</script>