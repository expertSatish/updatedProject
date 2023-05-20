@include('control-panel.inc.header')



<body class="nav-md">

<div class="container body">

<div class="main_container">

  

      @include('control-panel.inc.side-menu')

    

    

  <div class="right_col" role="main">

    <div class="row"> 

  

        @if(session()->has('success_msg'))  <?php echo Helper::SuccessAlert(session()->get('success_msg')); ?>  @endif



        @if(session()->has('error_msg'))  <?php echo Helper::ErrorAlert(session()->get('error_msg')); ?>  @endif

      

    </div>

      

      <div class="row"> 

        <!--------------------table data start-------------------------->

        <div class="col-md-12 col-sm-12 col-xs-12">

          <div class="x_panel">

            <div class="x_title">

                

             @if($flag)   

                

                <h2>Update Banner Management</h2>

                

             @else

                

                <h2>New Banner Management</h2>

                

             @endif    

                

              

                

                {!! Helper::BackBtn(url('control-panel/banner-management')) !!}

                

              <div class="clearfix"></div>

            </div>

            <div class="x_content">

              

              <div class="modal-body">

                  

                 @if(!$flag)    

                  

                <form action="{{url('control-panel/save-banner')}}" id="demo-form2" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" >

               

                @else    

                    

                   <form action="{{url('control-panel/edit-banner/'.$array_data->id)}}" id="demo-form2" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" > 

                    

                @endif   

                    

                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  

                  

                  <div class="form-group">

                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Main Title<span class="text-danger required">* </span> </label>

                    <div class="col-md-10 col-sm-9 col-xs-12">

                        <input type="text" name="image_alt" id="alt" placeholder="Enter Main Title" value="@if($flag){{$array_data->img_alt}}@endif" class="form-control">

                    </div>

                  </div>

                  

                    

                     <div class="form-group">

                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name"> Title <span class="text-danger required">*</span> </label>

                        <div class="col-md-10 col-sm-5 col-xs-9">

                            
                            <input type="text" name="PreImage" id="Preimage" placeholder="Enter Title"  value="@if($flag){{$array_data->image}}@endif" class="form-control col-md-7 col-xs-12" >

                            
                        </div>

                     </div>   


                  <div class="form-group">

                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">

                           

                           <span  id="formsavebtnbox"></span>

                           <span  id="formsavebtnbox2"> <?php echo Helper::SaveBTN(); ?> </span> 

                          

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

    

    $(document).ready(function(){

        $(".chosen-select").chosen();

        CKEDITOR.replace( 'Description' );

    });

    

    

    

     

     

    

    

  function validation(){

        $('.form-control').css('border-color', ''); 

        var alt = $('#alt').val();

       

        var image = $('#MYimage').val();

        var Preimage = $('#Preimage').val();

                  

               

                  

    if(alt==""){

              toastr.error("Please enter image alt");

              $('#Country').css('border-color', 'red');

              $( "#Country" ).focus();

              

              return false;

      }

  else if(image=="" && Preimage==''){

              toastr.error("Please Choose Image");

              $('#image').css('border-color', 'red');

              $( "#image" ).focus();

              return false;

      }

      else

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



                reader.onload = function (e) {

                    $('#blah').attr('src', e.target.result);

                }



                reader.readAsDataURL(input.files[0]);

            }

        }



        function ShowChooseImage(ID)

        {

          

             $("#MYimage").change(function(){

               

                readURL(this);

            });  

            

        }

  

</script>



