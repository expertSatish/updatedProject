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
                <h2>Update Service Management </h2>
                <a href="{{url('control-panel/service-management/'.($data->parent>0?$data->parent:''))}}" class="btn btn-danger pull-right"><i class="fa fa-arrow-left"></i> Back</a>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <form method="post" action="{{url('control-panel/edit-service')}}" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="Id" id="EditId" value="{{$data->id}}">
                  <div class="modal-body" style="max-height:450px;overflow:auto;">
                    <div class="row">
                      <div id="imagebox">
                        <div class="col-md-12">
                          <span>Title</span>
                          <input type="hidden" class="form-control" name="old_alias" id="alt" value="{{$data->alias}}">
                          <input type="text" class="form-control" name="title" id="alt" value="{{$data->title}}">
                        </div>
                        <div class="col-md-12" style="margin-top: 2%;">
                          <span>Alias</span>
                          <input type="text" class="form-control" name="alias" id="alt" value="{{$data->alias}}">
                        </div>
                        <div class="col-md-12" style="margin-top: 2%;">
                          <span>Meta Title</span>
                          <input type="text" class="form-control" name="meta_title" id="alt" value="{{$data->meta_title}}">
                        </div>
                        <div class="col-md-12" style="margin-top: 2%;">
                          <span>Meta Keywords</span>
                          <textarea class="form-control" name="meta_keywords" id="alt">{{$data->meta_keywords}}</textarea>
                        </div>
                        <div class="col-md-12" style="margin-top: 2%;">
                          <span>Meta description</span>
                          <textarea class="form-control" name="meta_description" id="alt">{{$data->meta_description}}</textarea>
                        </div>
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