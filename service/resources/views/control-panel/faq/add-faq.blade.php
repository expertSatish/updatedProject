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



                <h2>Update Faq Management</h2>

                {!! Helper::BackBtn(url('control-panel/faq-management/'.$array_data->category_id)) !!}

                @else



                <h2>New Faq Management</h2>

                {!! Helper::BackBtn(url('control-panel/faq-management/'.Request::segment(3))) !!}

                @endif









                <div class="clearfix"></div>

              </div>

              <div class="x_content">



                <div class="modal-body">



                  @if(!$flag)



                  <form action="{{url('control-panel/save-faq')}}" id="demo-form2" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">



                    @else



                    <form action="{{url('control-panel/edit-faq/'.$array_data->id)}}" id="demo-form2" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">



                      @endif



                      <input type="hidden" name="_token" value="{{ csrf_token() }}">

                      <input type="hidden" name="categoryId" value="{{ Request::segment(3) }}">





                      <div class="form-group">



                        <div class="col-md-5">

                          <label class="control-label" for="first-name">Title </label>

                          <input type="text" name="Currency[]" id="Title1" placeholder="Enter Title." value="@if($flag){{$array_data->title}}@endif" class="form-control">

                        </div>



                        <div class="col-md-6">

                          <label class="control-label" for="first-name">Description <span class="text-danger required">*</span> </label>



                          <textarea name="Details[]" id="Description1" class="form-control">@if($flag){{$array_data->text}}@endif</textarea>





                        </div>



                        @if(!$flag)



                        <div class="col-md-1" style="margin-top: 26px;">



                          <input type="hidden" name="boxnum" id="boxnum" value="1">

                          <button onclick="AddMoreBox();" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></button>

                        </div>



                        @endif



                      </div>







                      <div class="morebox"></div>





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

    CKEDITOR.replace('Description1');

  });







  function AddMoreBox()

  {



    var BoxNum = $('#boxnum').val();



    var NewNum = parseInt(BoxNum) + parseInt(1);



    $('#boxnum').val(NewNum);





    $('.morebox').append('<div class="form-group" id="box' + NewNum + '" style="margin-top:5px;"><div class="col-md-5"><label class="control-label" for="first-name">Title </label><input type="text" name="Currency[]" id="Title' + NewNum + '" placeholder="Enter Title." class="form-control string"></div><div class="col-md-6"><label class="control-label" for="first-name">Description <span class="text-danger required">*</span> </label><textarea class="form-control" name="Details[]" id="Description' + NewNum + '"></textarea></div><div class="col-md-1" style="margin-top: 26px;"><button onclick="RemoveMoreBox(' + NewNum + ');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></div></div>');



    CKEDITOR.replace('Description' + NewNum);



  }







  function RemoveMoreBox(Id)

  {

    $('#box' + Id).remove();

  }







  function validation() {

    $('.form-control').css('border-color', '');

    var Title = 0;

    var Description = 0;

    var Amount = 0;





    var BoxCo = $('#boxnum').val();



    for (var A = 1; A <= BoxCo; A++)

    {

      if ($('#Title' + A).val() == '') {
        Title = 1;
      }



      if ($('#Description' + A).val() == '') {
        Description = 1;
      }







    }



    if (Title == "1")

    {

      toastr.error("All title field are required.");

      return false;

    }

    //    else if(Description=="1")

    //     {

    //        toastr.error("All description field are required.");

    //        return false;

    //      }  
    else

    {

      $('#formsavebtnbox').html('<?php echo Helper::ProcessingBTN(); ?>');

      $('#formsavebtnbox2').hide();

      return true;





    }



    return false;

  }
</script>