@include('control-panel.inc.header')

<style>
  .my-font {
    font-size: 10px !important;
    font-weight: bold;
  }
</style>

<body class="nav-md">

  <div class="container body">

    <div class="main_container">
      @include('control-panel.inc.side-menu')
      <div class="right_col" role="main">
        <div class="row">
          @if(session()->has('success_msg')) <?php echo Helper::SuccessAlert(session()->get('success_msg')); ?> @endif
          @if(session()->has('error_msg')) <?php echo Helper::ErrorAlert(session()->get('error_msg')); ?> @endif
          @if ($errors->any())
          @foreach ($errors->all() as $error)
          {!! Helper::ErrorAlert($error) !!}
          @endforeach
          @endif
        </div>
        <div class="row">
          <!--------------------table data start-------------------------->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">



              <div class="x_title">



                <h2>Process Management </h2>

                <?php
                $getCatdtl = DB::table('nav_category')->where('id', Request::segment(3))->first();
                if ($getCatdtl->parent == 0) {
                  $Parent = '';
                } else {
                  $Parent = $getCatdtl->parent;
                }
                ?>

                {!! Helper::BackBtn(url('control-panel/service-management/'.$Parent)) !!}
                <a href="#AddModal1" data-toggle="modal" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> Heading Section</a>
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

                        <th>Titles</th>

                        <th>Status</th>

                        <th>Actions</th>

                      </tr>

                    </thead>



                    <tbody>



                      @foreach($arr_data as $data)



                      <tr>



                        <td> {{$loop->iteration}} </td>

                        <td> <img src="{{asset('resources/assets/uploads/process/'.$data->title)}}" alt="" width="70" height="70"></td>

                        <td> {{$data->alt}} </td>

                        <td> {!! $Btn = Helper::CheckDataStatus( url('/control-panel/process-status/') , $data->id , $data->status ); !!} </td>

                        <td>

                          <a href="{{url('control-panel/update-process/'.$data->id)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>



                          {!! $Btn = Helper::HRFRemoveBTN( url('/control-panel/process-remove/'.$data->id)); !!}

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





    $('.morebox').append('<div class="row" id="box' + NewNum + '" style="margin-top:5px;"><div id="imagebox' + NewNum + '"><div class="col-md-3"><span>Image</span><span class="text-danger my-font ml-4">(Best Image Size 60 X 60px)</span><input type="file" class="form-control" name="image[]" id="image"></div><div class="col-md-4"><span>Title</span><input type="text" class="form-control"  name="alt[]" id="alt"></div><div class="col-md-4"><span>Description</span><textarea class="form-control" name="detail[]"></textarea></div></div><div id="videobox' + NewNum + '" style="display:none;"><div class="col-md-9"><span>Youtube Embed</span><input type="text" class="form-control"  name="youtube[]" id="youtube"></div></div><div class="col-md-1"><span>&nbsp;&nbsp;&nbsp;</span><input type="hidden" name="boxnum" id="boxnum" value="1"><span>&nbsp;&nbsp;&nbsp;</span><button onclick="RemoveMoreBox(' + NewNum + ');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></div></div>');



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
</script>





<!-- Modal -->

<div id="AddModal" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Add Process</h4>

      </div>



      <form method="post" action="{{url('control-panel/save-process')}}" enctype="multipart/form-data">

        <input type="hidden" name="ServiceId" value="{!! $serviceId !!}">

        @csrf



        <div class="modal-body" style="max-height:338px;overflow:auto;">



          <div class="row">

            <div id="imagebox1">



              <div class="col-md-3">

                <span>Image</span><span class="text-danger my-font ml-4">(Best Image Size 60 X 60px)</span>

                <input type="file" class="form-control" name="image[]" id="image" required>

              </div>



              <div class="col-md-4">

                <span>Title</span>

                <input type="text" class="form-control" name="alt[]" id="alt" required>

              </div>


              <div class="col-md-4">

                <span>Description</span>

                <textarea class="form-control" name="detail[]" required></textarea>

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




<div id="AddModal1" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Process</h4>
      </div>
      <form method="post" action="{{url('control-panel/nav-heading-save')}}" enctype="multipart/form-data">
        @csrf

        <div class="modal-body" style="max-height:338px;overflow:auto;">
          <div class="row">
            <div id="imagebox1">
              <div class="col-md-6">
                <span>Title</span>
                <input type="hidden" name="role" value="1">
                <input type="hidden" name="nav_heading_id" value="@if(!empty($nav_heading->nav_heading_id)){{$nav_heading->nav_heading_id}}@endif">
                <input type="hidden" name="category_id" value="{{$category_id}}">
                <input type="text" class="form-control" name="title" value="@if(!empty($nav_heading->title)){{$nav_heading->title}}@endif">
              </div>
              <div class="col-md-6">
                <span>Tab heading</span>
                <input type="text" class="form-control" name="tab" value="@if(!empty($nav_heading->tab)){{$nav_heading->tab}}@endif">
              </div>
              <div class="col-md-12">
                <span>Description</span>
                <textarea class="form-control" name="description">@if(!empty($nav_heading->description)){{$nav_heading->description}}@endif</textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="text-align:center;">
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