@include('control-panel.inc.header')
<style>img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
}</style>
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
                    <h2>Popup Management</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="modal-body">
                        <form action="{{url('control-panel/edit-popup')}}" id="demo-form2" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                            @csrf
                            <div class="form-group">
                              <div class="col-md-12">
                                <label class="control-label" for="first-name">Title <span class="text-danger required">*</span> </label>
                                <input type="text" name="title" id="title" placeholder="Enter Page Name." value="{{$popup->title}}" class="form-control">
                              </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 col-sm-9 col-xs-12">
                                  <label class="control-label" for="first-name">Description </label>
                                  <textarea name="description" id="description" placeholder="Write Something Here...">{{$popup->description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label class="control-label" for="first-name">Status <span class="text-danger required">*</span> </label>
                                    <select class="form-control" name="status">
                                        <option value="1" {{$popup->status==1?'selected':''}}>Activate</option>
                                        <option value="0" {{$popup->status==0?'selected':''}}>De-Activate</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label class="control-label" for="first-name">Image
                                        <span class="text-danger required"> ( Best Image Size 600 * 450 ) </span>
                                    </label>
                                    <input type="file" name="image" onchange="readURL(this);" id="image" class="form-control">
                                    <input type="hidden" name="preimage" id="PreImage" class="form-control" value="{{$popup->image}}">
                                </div>
                                <div class="col-md-2">
                                    @if(!empty($popup->image) && file_exists(resource_path('assets/uploads/cms/'.$popup->image)))
                                        <img src="{{asset('resources/assets/uploads/cms/'.$popup->image)}}" id="blah" width="100%">
                                        <a href="{{url('control-panel/remove-popup-image')}}" class="error"><i class="fa fa-trash" style="font-size: 15px;"></i></a>
                                    @else
                                        <img src="{{asset('resources/assets/img/NoImage.png')}}" id="blah" width="100%">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" id="svbtn" class="btn btn-success pull-right"><i class="fa fa-save"></i> Save</button>
                                    <button type="button" id="prcbtn" style="display:none" class="btn btn-warning pull-right"><i class="fa fa-spinner"></i> Processing...</button>
                                </div>
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
</div>
</body>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('description');
    });
    $('#svbtn').on('click',function(){
        $('#prcbtn').show();
        $('#svbtn').hide();
    });
</script>