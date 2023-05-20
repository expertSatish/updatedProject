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



                <h2>Update Tax Management </h2>


                {!! Helper::BackBtn(url('control-panel/tax-return/')) !!}




                <div class="clearfix"></div>



              </div>



              <div class="x_content">





                <form method="post" action="{{url('control-panel/edit-tax-return')}}" enctype="multipart/form-data">



                  @csrf

                  <input type="hidden" name="EditId" id="EditId" value="{{$data->id}}">
                  <input type="hidden" name="PageLocation" id="PageLocation" value="{{Request::segment(2)}}">


                  <div class="modal-body">



                    <div class="row">







                      <div id="imagebox">

                        @if(Request::segment(2)=='update-tax-return')


                        <div class="col-md-12" style="margin-top: 20px;">

                          <span>Title</span>

                          <input type="text" class="form-control" name="Title" id="Title" value="{{$data->title}}">

                        </div>


                        <div class="col-md-12" style="margin-top: 20px;">

                          <span>Alias</span>

                          <input type="text" class="form-control" name="Alias" id="Alias" value="{{$data->alias}}">

                        </div>


                        <div class="col-md-12" style="margin-top: 20px;">

                          <span>Heading</span>

                          <input type="text" class="form-control" name="Heading" id="Heading" value="{{$data->heading}}">

                        </div>

                        <div class="col-md-4" style="margin-top: 20px;">

                          <span>Currency</span>

                          <input type="text" class="form-control" name="Currency" id="Currency" value="{{$data->currency}}">

                        </div>


                        <div class="col-md-4" style="margin-top: 20px;">
                          <span>Amount</span>
                          <input type="text" class="form-control" name="Amount" id="Amount" value="{{$data->price}}">
                        </div>

                        <div class="col-md-12" style="margin-top: 20px;">
                          <span>Meta Title</span>
                          <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{$data->meta_title}}">
                        </div>
                        <div class="col-md-12" style="margin-top: 20px;">
                          <span>Meta Keywords</span>
                          <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{$data->meta_keywords}}">
                        </div>
                        <div class="col-md-12" style="margin-top: 20px;">
                          <span>Meta Description</span>
                          <input type="text" class="form-control" name="meta_description" id="meta_description" value="{{$data->meta_description}}">
                        </div>



                        @else

                        <center><strong><u>Banner Management</u></strong></center>

                        <div class="col-md-12" style="margin-top: 20px;">

                          <span>Banner Title</span>

                          <input type="text" class="form-control" name="BannerTitle" id="BannerTitle" value="{{$data->banner_title}}">

                        </div>


                        <div class="col-md-12" style="margin-top: 20px;">

                          <span>Banner Description</span>

                          <textarea class="form-control" name="BannerDescription" id="Description1">{{$data->banner_text}}</textarea>

                        </div>


                        <div class="col-md-10" style="margin-top: 20px;">

                          <span>Banner Image</span>

                          <input type="file" class="form-control" name="banner" id="banner" onchange="readURL(this)">
                          <input type="hidden" name="prebanner" value="{{$data->banner_image}}">
                          <label style="font-size: 11px;color: #d65959;">Best Image Size 1600*700 px</label>
                        </div>


                        <div class="col-md-2" style="margin-top: 20px;">

                          @if(!empty($data->banner_image) && file_exists(resource_path('/assets/uploads/banner/'.$data->banner_image)))

                          <img src="{{asset('resources/assets/uploads/banner/'.$data->banner_image)}}" id="blah" width="100%">

                          @else

                          <img src="{{asset('resources/assets/img/NoImage.png')}}" id="blah" width="100%">

                          @endif

                        </div>


                        <div class="col-md-12" style="margin-top: 20px;">

                          <center><strong><u>Detail Management</u></strong></center>

                        </div>

                        <div class="col-md-12" style="margin-top: 20px;">

                          <span>List Title</span>

                          <input type="text" class="form-control" name="ListTitle" id="ListTitle" value="{{$data->list_title}}">

                        </div>

                        <div class="col-md-12" style="margin-top: 20px;margin-bottom: 30px;">

                          <span>About Description</span>

                          <textarea class="form-control" name="AboutDescription" id="Description2">{{$data->about}}</textarea>

                        </div>

                        <br>
                        <div class="col-md-12" style="margin-top: 20px;margin-bottom: 30px;">

                          <span>Home Description</span>

                          <textarea class="form-control" name="home_description" id="Description3">{{$data->home_description}}</textarea>

                        </div>
                        <br>

                        <center>
                          <p><strong><u>List Section Management</u></strong></p>
                        </center>


                        <?php $List = DB::table('tax_list')->where('tax_id', $data->id)->get(); ?>


                        @foreach($List as $Rot)

                        <div class="col-md-3" style="margin-top: 20px;">

                          <span>List Type</span>
                          <select class="form-control" name="type[]">
                            <option value="">Choose List Type</option>
                            <option value="1" <?php if ($Rot->list_for == 1) {
                                                echo "selected";
                                              } ?>>List For Banner</option>
                            <option value="2" <?php if ($Rot->list_for == 2) {
                                                echo "selected";
                                              } ?>>List For Page</option>
                          </select>

                        </div>

                        <div class="col-md-8" style="margin-top: 20px;">

                          <span>Text</span>
                          <input type="hidden" name="listId[]" value="{{$Rot->id}}">
                          <input type="text" name="list[]" class="form-control" value="{{$Rot->title}}">

                        </div>


                        <div class="col-md-1" style="margin-top: 20px;">
                          <input type="hidden" id="BoxNum" value="1">
                          <a href="{{url('control-panel/remove-banner-list/'.$Rot->id)}}" class="btn btn-danger" style="margin-top: 20px;"><i class="fa fa-trash"></i></a>

                        </div>


                        @endforeach

                        <div class="col-md-3" style="margin-top: 20px;">

                          <span>List Type</span>
                          <select class="form-control" name="type[]">
                            <option value="">Choose List Type</option>
                            <option value="1">List For Banner</option>
                            <option value="2">List For Page</option>
                          </select>

                        </div>

                        <div class="col-md-8" style="margin-top: 20px;">

                          <span>Text</span>

                          <input type="text" name="list[]" class="form-control">

                        </div>


                        <div class="col-md-1" style="margin-top: 20px;">
                          <input type="hidden" id="BoxNum" value="1">
                          <button class="btn btn-primary" type="button" style="margin-top: 20px;" onclick="AddMoreBox()"><i class="fa fa-plus"></i></button>

                        </div>



                        <div id="boxCT"></div>

                        @endif

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
    CKEDITOR.replace('Description3');

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

    $('#boxCT').append('<span id="BoxSe' + NewBox + '"><div class="col-md-3" style="margin-top: 10px;"><span>List Type</span><select class="form-control" name="type[]"><option value="">Choose List Type</option><option value="1">List For Banner</option><option value="2">List For Page</option></select></div><div class="col-md-8" style="margin-top: 10px;"><span>Text</span><input type="text" name="list[]" class="form-control"></div><div class="col-md-1" style="margin-top: 10px;"><input type="hidden" id="BoxNum" value="1"><button class="btn btn-danger" type="button" style="margin-top: 20px;" onclick="RemoveMoreBox(' + NewBox + ')"><i class="fa fa-trash"></i></button></div></span>');

  }


  function RemoveMoreBox(NewBox) {
    $('#BoxSe' + NewBox).remove();
  }
</script>