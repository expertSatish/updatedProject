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

              <h2>Update Page Section Management</h2>

                



                @if($arr_data->id==52)



                    <a href="{{url('control-panel/page-section')}}" class="btn btn-danger pull-right"><i class="fa fa-arrow-left"></i> Back </a>


                    <a href="{{url('control-panel/update-cms/20')}}" class="btn btn-warning pull-right"><i class="fa fa-file-text"></i> Terms & Conditions </a>

                @endif

              
                

                

            <?php if($arr_data->id==46){ ?>



              <a href="{{url('control-panel/update-cms/30')}}" class="btn btn-warning pull-right"><i class="fa fa-file-text"></i> Contact Details </a>





            <?php } ?> 

                

                

            <?php if($arr_data->id==47){ ?>



              <a href="{{url('control-panel/update-cms/24')}}" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> About Management </a>



            <?php } ?> 

                

                

            <?php if($arr_data->id==54){ ?>



              <a href="{{url('control-panel/update-cms/21')}}" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> Privacy Policy </a>



            <?php } ?>  

                

                

             <?php if($arr_data->id==55){ ?>



              <a href="{{url('control-panel/update-cms/22')}}" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> Refund Policy</a>

                

            <?php } ?>      

                

                

            <?php if($arr_data->id==49){ ?>



              <a href="{{url('control-panel/blog-management')}}" class="btn btn-primary pull-right"><i class="fa fa-file-image-o"></i> Blog Management </a>



            <?php } ?>  

                

             <?php if($arr_data->id==50){ ?>



              <a href="{{url('control-panel/testimonial-management')}}" class="btn btn-warning pull-right"><i class="fa fa-users"></i> Testimonial Management</a>

                



            <?php } ?> 

                

                

            

                

             <?php if($arr_data->id==53){ ?>



              <a href="{{url('control-panel/news-management')}}" class="btn btn-warning pull-right"><i class="fa fa-newspaper-o"></i> News Management</a>

                



            <?php } ?>     

                

          

            <?php if($arr_data->id==48){ ?>



             

              <a href="{{url('control-panel/update-cms/19')}}" class="btn btn-warning pull-right"><i class="fa fa-file-text"></i> Careers</a>





            <?php } ?>     

                

            

            <?php if($arr_data->id==51){ ?>



              <a href="{{url('control-panel/page-section')}}" class="btn btn-danger pull-right"><i class="fa fa-backward"></i> Back</a>



           


            <?php } ?> 

                

                

           
                

              <div class="clearfix"></div>

            </div>

            <div class="x_content">

              

              <div class="modal-body">

                  

                <form action="{{url('control-panel/edit-page-section')}}" id="demo-form2" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" >

                  @csrf

                  <input type="hidden" name="ID" value="<?php echo $arr_data->id; ?>">

                  

                  <div class="form-group">

                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Page Name<span class="text-danger required">*</span> </label>

                    <div class="col-md-10 col-sm-9 col-xs-12">

                        <input type="text" name="Pagename" id="Pagename" readonly value="<?php echo $arr_data->page_name;?>" class="form-control col-md-7 col-xs-12" required>

                    </div>

                  

                   

                  

                  </div>

                  

                  <div class="form-group">

                    

                  

                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Alias <span class="text-danger required">*</span> </label>

                    <div class="col-md-10 col-sm-9 col-xs-12">

                        <input type="text" name="Alias" id="Alias" readonly  value="<?php echo $arr_data->slug;?>" class="form-control col-md-7 col-xs-12" required>

                    </div>

                  

                  </div>

               

                    

            @if($arr_data->id!=45 && $arr_data->id!=57)        

                    

                    

                 <div class="form-group">

                    

                  

                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Text 1 <span class="text-danger required">*</span> </label>

                    <div class="col-md-10 col-sm-9 col-xs-12">

                        <input type="text" name="text_1" id="text_1" placeholder="" value="<?php echo $arr_data->text_1;?>" class="form-control col-md-7 col-xs-12" required>

                    </div>

                  

                  </div>    

                    

                    

                    

                @if($arr_data->id!=46 && $arr_data->id!=47  && $arr_data->id!=52 && $arr_data->id!=48 && $arr_data->id!=49 && $arr_data->id!=50 && $arr_data->id!=51 && $arr_data->id!=54 && $arr_data->id!=55 && $arr_data->id!=56 && $arr_data->id!=59 && $arr_data->id!=60)

                

                <div class="form-group">

                    

                  

                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Text 2 <span class="text-danger required">*</span> </label>

                    <div class="col-md-10 col-sm-9 col-xs-12">

                        <input type="text" name="text_2" id="text_2" placeholder="" value="<?php echo $arr_data->text_2;?>" class="form-control col-md-7 col-xs-12" required>

                    </div>

                  

                  </div>    

                

                @endif

                    

                    

              @if($arr_data->id!=45 && $arr_data->id!=46 && $arr_data->id!=47 && $arr_data->id!=48 && $arr_data->id!=49 && $arr_data->id!=50 && $arr_data->id!=51 && $arr_data->id!=52 && $arr_data->id!=53 && $arr_data->id!=54 && $arr_data->id!=55 && $arr_data->id!=56  && $arr_data->id!=59 && $arr_data->id!=60)       

                    

                <div class="form-group">

                    

                  

                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Text 3 <span class="text-danger required">*</span> </label>

                    <div class="col-md-10 col-sm-9 col-xs-12">

                        <input type="text" name="text_3" id="text_3" placeholder="" value="<?php echo $arr_data->text_3;?>" class="form-control col-md-7 col-xs-12" required>

                    </div>

                  

                  </div> 

                    

              @endif      

                    

           @endif         

                    

            @if($arr_data->id!=45)



                <div class="form-group">

                    

                  

                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Banner Image <span class="text-danger required">*</span> </label>

                    <div class="col-md-4">

                        <input type="hidden" name="prebanner" id="prebanner" value="<?php echo $arr_data->text_4;?>" class="form-control col-md-7 col-xs-12">

                        <input type="file" name="banner" onchange=readURL(this,1) id="prebanner" class="form-control col-md-7 col-xs-12">



                        <span class="text-danger required">(Best Image Size 1600 * 500 px)</span>



                    </div>

                    <div class='col-md-2'>

                        

                      @if(!empty($arr_data->text_4))

                      

                        <img src="{{asset('resources/assets/uploads/cms/'.$arr_data->text_4)}}" id="blah1" width="100%">

                      

                      @else

                      

                        <img src="{{asset('resources/assets/img/NoImage.png')}}" id="blah1" width="100%">

                      

                      @endif

                        

                        

                        

                    </div>

                  

                  </div>    

                    

            @endif        

                    

                 <div class="form-group">

                    

                  

                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Meta Title <span class="text-danger required">*</span> </label>

                    <div class="col-md-10 col-sm-9 col-xs-12">

                        <input type="text" name="meta_title" id="meta_title" placeholder="Meta Title" value="<?php echo $arr_data->meta_title;?>" class="form-control col-md-7 col-xs-12" required>

                    </div>

                  

                  </div>    

                   

                  

                  <div class="form-group">

                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Meta Keywords <span class="text-danger required">*</span> </label>

                    <div class="col-md-10 col-sm-9 col-xs-12">

                        <textarea class="form-control" name="meta_keywords" rows="3" placeholder="Meta Keywords"><?php echo $arr_data->meta_keywords;?></textarea>

                    </div>

                  

                  </div>

                    

                    

                 <div class="form-group">

                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Meta Description <span class="text-danger required">*</span> </label>

                    <div class="col-md-10 col-sm-9 col-xs-12">

                        <textarea class="form-control" name="meta_description" rows="3" placeholder="Meta Description "><?php echo $arr_data->meta_description;?></textarea>

                    </div>

                  

                  </div>    

                  

                  

                  <div class="form-group">

                      <div class="col-md-12">

                           

                          <button type="submit" id="svbtn" onclick="return validation();" class="btn btn-success pull-right"><i class="fa fa-save"></i> Save</button>

                          

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

    

    $(document).ready(function(){

        $(".chosen-select").chosen();

        CKEDITOR.replace( 'Description' );

    });

    

    

    

     

     

    

    

  function validation(){

        $('.form-control').css('border-color', ''); 

        var Project = $('#Project').val();

        var Currency = $('#Currency').val();

        var Mobile = $('#Mobile').val();

        var Email = $('#Email').val();

        var Address = $('#Address').val();

        

        var image = $('#image').val();

        var Preimage = $('#Preimage').val();

                  

               

                  

    if(Project==""){

              toastr.error("Please enter project name");

              $('#Country').css('border-color', 'red');

              $( "#Country" ).focus();

              

              return false;

      }

     

    else if(Mobile==""){

              toastr.error("Please enter mobile");

              $('#City').css('border-color', 'red'); 

              $( "#City" ).focus();

              return false;

      }  

    else if(Email==""){

              toastr.error("Please enter email address");

              $('#City').css('border-color', 'red'); 

              $( "#City" ).focus();

              return false;

      }    

    else if(Address==""){

              toastr.error("Please enter address");

              $('#City').css('border-color', 'red'); 

              $( "#City" ).focus();

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

            $('#prcbtn').show(); 

            $('#svbtn').hide(); 

             return true;

             

              

      }

                                                                

     return false;

  }



    function readURL(input,ID) {

           

            if (input.files && input.files[0]) {

                var reader = new FileReader();



                reader.onload = function (e) {

                    $('#blah'+ID).attr('src', e.target.result);

                }



                reader.readAsDataURL(input.files[0]);

            }

        }



        function ShowChooseImage(ID)

        {

          

             $("#MYimage"+ID).change(function(){

               

                readURL(this,ID);

            });  

            

        }

  

</script>



