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



                <h2>Update Advantages </h2>



                {!! Helper::BackBtn(url('control-panel/advantages/'.$data->service_id)) !!}



                <div class="clearfix"></div>



              </div>



              <div class="x_content">





                <form method="post" action="{{url('control-panel/edit-advantages')}}" enctype="multipart/form-data">



                  @csrf

                  <input type="hidden" name="Id" id="EditId" value="{{$data->id}}">



                  <div class="modal-body" style="max-height:338px;overflow:auto;">



                    <div class="row">


                      <div id="imagebox">



                        <div class="col-md-12">

                          <span>Best Image Size 60 * 60 px</span>

                          <input type="hidden" class="form-control" name="preimage" id="Editservice" value="{{$data->title}}">

                          <input type="file" class="form-control" name="eimage">

                        </div>





                        <div class="col-md-12">

                          <span>Title</span>

                          <input type="text" class="form-control" name="alt" id="alt" value="{{$data->alt}}">

                        </div>


                        <div class="col-md-12">

                          <span>Description</span>

                          <textarea class="form-control" name="detail">{{$data->type}}</textarea>

                        </div>

                        <br>



                        <img style="margin-top: 5px;" src="{{asset('resources/assets/uploads/service-gallery/'.$data->title)}}" width="10%">

                      </div>






                    </div>



                  </div>

                  <div class="modal-footer">

                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>

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
</script>