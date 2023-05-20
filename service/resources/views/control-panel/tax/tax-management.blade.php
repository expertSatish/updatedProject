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



                <h2>Tax Management </h2>

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

                        <th>Title</th>

                        <th>Heading</th>

                        <th>Amount</th>

                        <th>Top Status</th>

                        <th>Home Status</th>

                        <th>Status</th>

                        <th>Actions</th>

                      </tr>

                    </thead>



                    <tbody>



                      @foreach($arr_data as $data)

                      <tr>



                        <td> {{$loop->iteration}} </td>

                        <td> {{ $data->title }}</td>

                        <td> {{ $data->heading }}</td>

                        <td> {{ $data->currency }} {{ $data->price }}</td>

                        <td>
                          @if($data->top_status==1)
                          <a href="{{url('/control-panel/tax-top-status/'.$data->id)}}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Active</a>
                          @else
                          <a href="{{url('/control-panel/tax-top-status/'.$data->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactive</a>
                          @endif
                        </td>
                        <td>
                          @if($data->home_status==1)
                          <a href="{{url('/control-panel/tax-home-status/'.$data->id)}}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Active</a>
                          @else
                          <a href="{{url('/control-panel/tax-home-status/'.$data->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactive</a>
                          @endif
                        </td>

                        <td> {!! $Btn = Helper::CheckDataStatus( url('/control-panel/tax-return-status/') , $data->id , $data->status ); !!} </td>

                        <td>


                          <div class="dropdown">
                            <button type="button" id="action_btn1" class="btn btn-primary btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-archive"></i> Action <i class="fa fa-angle-down" aria-hidden="true"></i></button>

                            <div class="dropdown-menu" aria-labelledby="action_btn1">


                              <a href="{{url('control-panel/update-tax-return/'.$data->id)}}" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>

                              <a href="{{url('/control-panel/tax-return-remove/'.$data->id)}}" onclick="return deleletconfig();" class="dropdown-item"><i class="fa fa-trash"></i> Remove</a>

                              <a href="{{url('control-panel/tax-banner/'.$data->id)}}" class="dropdown-item"><i class="fa fa-file-image-o"></i> Banner & Detail </a>


                            </div>
                          </div>

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
    $('.morebox').append('<div class="row" id="box' + NewNum + '"style="margin-top:5px;"><div class="col-md-4"><span>Title</span><input type="text" class="form-control"  name="alt[]" id="alt"></div><div class="col-md-4"><span>Heading</span><input type="text" class="form-control"  name="Heading[]" id="alt"></div><div class="col-md-1"><span>Currency</span><input type="text" class="form-control"  name="Currency[]" id="Currency"></div><div class="col-md-2"><span>Amount</span><input type="text" class="form-control"  name="Amount[]" id="Amount"></div><div class="col-md-4"> <span> Meta Title </span> <input type = "text" class = "form-control" name = "title[]" id = "title" ></div><div class="col-md-4"><span> Meta Keywords</span><input type = "text" class = "form-control"name = "keywords[]" id ="keywords"></div><div class="col-md-4"><span> Meta Description </span><input type = "text" class = "form-control" name = "description[]" id = "description" ></div><div class="col-md-1"><span>&nbsp;&nbsp;&nbsp;</span><input type = "hidden" name = "boxnum" id ="boxnum" value ="1" ><span>&nbsp; &nbsp; &nbsp; </span><button onclick="RemoveMoreBox(' + NewNum + ');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></div></div>');
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

        <h4 class="modal-title">Add Category</h4>

      </div>



      <form method="post" action="{{url('control-panel/save-tax-return')}}" enctype="multipart/form-data">


        @csrf

        <input type="hidden" name="parentId" value="{{Request::segment(3)}}">

        <div class="modal-body" style="max-height:338px;overflow:auto;">



          <div class="row">


            <div id="imagebox1">

              <div class="col-md-4">

                <span>Title</span>

                <input type="text" class="form-control" name="alt[]" id="alt">

              </div>

              <div class="col-md-4">

                <span>Heading</span>

                <input type="text" class="form-control" name="Heading[]" id="Heading">

              </div>

              <div class="col-md-1">

                <span>Currency</span>

                <input type="text" class="form-control" name="Currency[]" id="Currency">

              </div>

              <div class="col-md-2">

                <span>Amount</span>

                <input type="text" class="form-control" name="Amount[]" id="Amount">

              </div>

              <div class="col-md-4">
                <span>Meta Title</span>
                <input type="text" class="form-control" name="title[]" id="title">
              </div>
              <div class="col-md-4">
                <span>Meta Keywords</span>
                <input type="text" class="form-control" name="keywords[]" id="keywords">
              </div>
              <div class="col-md-4">
                <span>Meta Description</span>
                <input type="text" class="form-control" name="description[]" id="description">
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