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
                                <h2>Setting Management</small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="modal-body">
                                    <form action="{{url('control-panel/edit-setting')}}" id="demo-form2" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="SetingID" value="<?php echo Helper::SettingID(); ?>">
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Project Name<span class="text-danger required">*</span> </label>
                                            <div class="col-md-10 col-sm-9 col-xs-12">
                                                <input type="text" name="Project" id="Project" placeholder="e.g Toyota Crysta" value="<?php echo Helper::ProjectName(); ?>" class="form-control col-md-7 col-xs-12" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Email <span class="text-danger required">*</span> </label>
                                            <div class="col-md-4 col-sm-9 col-xs-12">
                                                <input type="text" name="Email" id="Email" placeholder="e.g Email@gmail.com" value="<?php echo Helper::ProjectMailEmail(); ?>" class="form-control col-md-7 col-xs-12" required>
                                            </div>
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Mobile <span class="text-danger required">*</span> </label>
                                            <div class="col-md-4 col-sm-9 col-xs-12">
                                                <input type="text" name="Mobile" id="Mobile" maxlength="14" placeholder="e.g 12345678910" value="<?php echo Helper::ProjectMailMobile(); ?>" class="form-control col-md-7 col-xs-12" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Address <span class="text-danger required">*</span> </label>
                                          <div class="col-md-10 col-sm-9 col-xs-12">
                                            <textarea class="form-control" name="Address" rows="3" placeholder="Enter Address" id="Description">{!! $setting->address !!}</textarea>
                                          </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label" for="first-name">Email Mail To(Sent) <span class="text-danger required">*</span></label>
                                                <input type="text" name="EmailTo" id="EmailTo" placeholder="e.g Email@gmail.com" value="<?php echo Helper::ProjectMailToEmail(); ?>" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label" for="first-name">Gst <span class="text-danger required">*</span> </label>
                                                <input type="text" name="gst" id="EmailTo" placeholder="gst" value="{{$setting->gst}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label" for="first-name"> Project Logo <span class="text-danger required">*</span> </label>
                                            <div class="form-group">
                                                <input type="file" name="Image" id="image" onchange="readURL(this,'');" placeholder="e.g Logo" value="" class="form-control">
                                                <input type="hidden" name="PreImage" id="Preimage" value="<?php echo Helper::ProjectLOGO(); ?>" class="form-control">
                                            </div>
                                            @error('Image') <span class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                        <div class="col-md-2" style="margin-top: 20px;">
                                            <?php if (Helper::ProjectLOGO() != '') {
                                              echo '<img id="blah" src="' . Helper::LOGOIMGURl(Helper::ProjectLOGO()) . '" class="img-mg" alt="' . Helper::ProjectName() . '" />';
                                            } else {
                                              echo '<img id="blah" src="' . Helper::imgurl('NoImage.png') . '" class="img-mg" alt="No Image Available" />';
                                            } ?>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="control-label" for="first-name">Gst Number <span class="text-danger required">*</span> </label>
                                            <div class="form-group">
                                                <input type="text" name="gstn" id="gstn" placeholder="Gst Number Here" value="{{$setting->gstn}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="control-label" for="first-name">Note:<span class="text-danger required">*</span> </label>
                                              <div class="form-group">
                                                <input type="text" name="note" id="note" placeholder="Write Something Here..." value="{{$setting->note}}" class="form-control" required>
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
  $(document).ready(function() {
    $(".chosen-select").chosen();
    CKEDITOR.replace('Description');
  });
  function validation() {
    $('.form-control').css('border-color', '');
    var Project = $('#Project').val();
    var Currency = $('#Currency').val();
    var Mobile = $('#Mobile').val();
    var Email = $('#Email').val();
    var EmailTo = $('#EmailTo').val();
    var Address = $('#Address').val();
    var image = $('#image').val();
    var Preimage = $('#Preimage').val();
    if (Project == "") {
      toastr.error("Please enter project name");
      $('#Country').css('border-color', 'red');
      $("#Country").focus();
      return false;
    } else if (Mobile == "") {
      toastr.error("Please enter mobile");
      $('#City').css('border-color', 'red');
      $("#City").focus();
      return false;
    } else if (Email == "") {
      toastr.error("Please enter email address");
      $('#Email').css('border-color', 'red');
      $("#Email").focus();
      return false;
    } else if (EmailTo == "") {
      toastr.error("Please enter mail email address");
      $('#EmailTo').css('border-color', 'red');
      $("#EmailTo").focus();
      return false;
    } else if (Address == "") {
      toastr.error("Please enter address");
      $('#City').css('border-color', 'red');
      $("#City").focus();
      return false;
    } else if (image == "" && Preimage == '') {
      toastr.error("Please Choose Image");
      $('#image').css('border-color', 'red');
      $("#image").focus();
      return false;
    } else {
      $('#prcbtn').show();
      $('#svbtn').hide();
      return true;
    }
    return false;
  }
  function readURL(input, ID) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#blah' + ID).attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  function ShowChooseImage(ID){
    $("#MYimage" + ID).change(function() {
      readURL(this, ID);
    });
  }
</script>