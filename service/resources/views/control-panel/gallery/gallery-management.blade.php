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



                <h2>Our Clients Management </h2>

                <a href="{{url('control-panel/heading-edit/5')}}" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> Heading Section </a>


                <a href="#AddModal" data-toggle="modal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New</a>



                <div class="clearfix"></div>



              </div>



              <div class="x_content">



                <form method="post" action="{{url('control-panel/deal-sort')}}">



                  @csrf





                  <table id="datatable" class="table table-striped table-bordered bulk_action">



                    <thead>



                      <tr>

                        <th>Sr.No.</th>

                        <th>Image</th>

                        <th>Status</th>

                        <th>Actions</th>

                      </tr>

                    </thead>



                    <tbody>



                      @foreach($arr_data as $data)



                      <tr>



                        <td> {{$loop->iteration}} </td>

                        @if($data->type=='image')

                        <td> <img src="{{asset('resources/assets/uploads/gallery/'.$data->title)}}" width="30%"> </td>

                        @else

                        <td> {!! preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe class=\"w-100\" height=\"300\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$data->title) !!}</td>

                        @endif

                        <td> {!! $Btn = Helper::CheckDataStatus( url('/control-panel/our-clients-status/') , $data->id , $data->status ); !!} </td>

                        <td>

                          <a href="{{url('control-panel/update-our-clients/'.$data->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>



                          {!! $Btn = Helper::HRFRemoveBTN( url('/control-panel/our-clients-remove/'.$data->id)); !!}

                        </td>



                      </tr>



                      @endforeach



                    </tbody>



                  </table>



                </form>



              </div>



            </div>



          </div>



        </div>



      </div>

    </div>



    <footer> @include('control-panel.inc.footer') </footer>



</body>





<script>
  function AddMoreBox()

  {



    var BoxNum = $('#boxnum').val();



    var NewNum = parseInt(BoxNum) + parseInt(1);



    $('#boxnum').val(NewNum);





    $('.morebox').append('<div class="row" id="box' + NewNum + '" style="margin-top:5px;"><div class="col-md-2" style="display:none;"><span>Gallery Type</span><select class="form-control" onchange="getTypeData(this.value,' + NewNum + ')" name="type[]" required><option value="image">Image</option><option value="youtube">Youtube</option></select></div><div id="imagebox' + NewNum + '"><div class="col-md-4"><span>Best Image Size 500 * 500 px</span><input type="file" class="form-control" name="image[]" onchange="getImage(this,' + NewNum + ')" id="image"></div> <div class="col-md-2"><img src="{{asset('
      resources / assets / img / NoImage.png ')}}" width="100%" id="blash' + NewNum + '"></div><div class="col-md-5"><span>Image Alt</span><input type="text" class="form-control"  name="alt[]" id="alt"></div></div><div id="videobox' + NewNum + '" style="display:none;"><div class="col-md-9"><span>Youtube Embed</span><input type="text" class="form-control"  name="youtube[]" id="youtube"></div></div><div class="col-md-1"><span>&nbsp;&nbsp;&nbsp;</span><input type="hidden" name="boxnum" id="boxnum" value="1"><span>&nbsp;&nbsp;&nbsp;</span><button onclick="RemoveMoreBox(' + NewNum + ');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></div></div>');



  }







  function getTypeData(data, Id)

  {

    if (data == 'youtube')

    {

      $('#videobox' + Id).show();

      $('#imagebox' + Id).hide();

    } else

    {

      $('#imagebox' + Id).show();

      $('#videobox' + Id).hide();

    }

  }



  function RemoveMoreBox(Id)

  {

    // var BoxNum = $('#boxnum').val();



    //  var NewNum = parseInt(BoxNum) - parseInt(1); 



    //    $('#boxnum').val(NewNum); 



    $('#box' + Id).remove();

  }





  function EditModalWindow(Id, Name)

  {

    $('#EditId').val(Id);

    $('#Editservice').val(Name);

  }


  function getImage(input, Id) {
    if (input.files && input.files[0]) {

      var reader = new FileReader();



      reader.onload = function(e) {

        $('#blash' + Id).attr('src', e.target.result);

      }



      reader.readAsDataURL(input.files[0]);

    }
  }
</script>





<!-- Modal -->

<div id="AddModal" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Add Gallery</h4>

      </div>



      <form method="post" action="{{url('control-panel/save-our-clients')}}" enctype="multipart/form-data">



        @csrf



        <div class="modal-body" style="max-height:338px;overflow:auto;">



          <div class="row">



            <div class="col-md-2" style="display: none;">

              <span>Gallery Type</span>



              <select class="form-control" name="type[]" onchange="getTypeData(this.value,'1')" required>

                <option value="image">Image</option>

                <option value="youtube">Youtube</option>



              </select>



            </div>



            <div id="imagebox1">



              <div class="col-md-4">

                <span>Best Image Size 500 * 500 px</span>

                <input type="file" class="form-control" name="image[]" id="image" onchange="getImage(this,1)">

              </div>

              <div class="col-md-2">

                <img src="{{asset('resources/assets/img/NoImage.png')}}" width="100%" id="blash1">

              </div>



              <div class="col-md-5">

                <span>Image Alt</span>

                <input type="text" class="form-control" name="alt[]" id="alt">

              </div>



            </div>



            <div id="videobox1" style="display:none;">



              <div class="col-md-9">

                <span>Youtube URL</span>

                <input type="text" class="form-control" name="youtube[]" id="youtube">

              </div>



            </div>







            <div class="col-md-1">

              <span>&nbsp;&nbsp;&nbsp;</span>

              <input type="hidden" name="boxnum" id="boxnum" value="1">

              <button onclick="AddMoreBox();" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></button>

            </div>



          </div>



          <div class="morebox"></div>



        </div>

        <div class="modal-footer">

          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>

          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>

        </div>



      </form>





    </div>



  </div>

</div>











<!-- Modal -->

<div id="EditModal" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Edit Service</h4>

      </div>



      <form method="post" action="{{url('control-panel/edit-wellness-gallery')}}" enctype="multipart/form-data">



        @csrf

        <input type="hidden" name="Id" id="EditId">



        <div class="modal-body" style="max-height:338px;overflow:auto;">



          <div class="row">



            <div class="col-md-12">

              <span>Best Image Size 500 * 500 px</span>

              <input type="hidden" class="form-control" required name="preimage" id="Editservice">

              <input type="file" class="form-control" required name="eimage">

            </div>







          </div>



        </div>

        <div class="modal-footer">

          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>

          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>

        </div>



      </form>





    </div>



  </div>

</div>