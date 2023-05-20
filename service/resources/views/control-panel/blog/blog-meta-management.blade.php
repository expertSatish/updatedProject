<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@include('admin.inc.title')
    
 

  @include('admin.inc.header')
<script type='text/javascript'>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
</head>

<body class="nav-md">
<div class="container body">
<div class="main_container">
  <div class="col-md-3 left_col">
    <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;"> @include('admin.inc.site-admin-title') </div>
      <div class="clearfix"></div>
      
      <!-- menu profile quick info -->
      <div class="profile">
        <div class="profile_pic"> <img src="{{ asset('resources/assets/admin/images/img.png') }}" class="img-circle profile_img" /> </div>
        <div class="profile_info"> <span>Welcome,</span>
         <h2>{{ Auth::guard('admins')->user()->name }}</h2>
        </div>
      </div>
      <!-- /menu profile quick info --> 
      
      <br />
      
      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>General</h3>
          @include('admin.inc.side-menu') </div>
      </div>
      <!-- /sidebar menu --> 
      
      <!-- /menu footer buttons --> 
      
      <!-- /menu footer buttons --> 
    </div>
  </div>
  
  <!-- top navigation -->
  <div class="top_nav">
    <div class="nav_menu"> @include('admin.inc.admin-profile') </div>
  </div>
  <!-- /top navigation --> 
  
  <!-- page content start -->
  <div class="right_col" role="main">
    <div class="row"> 
      <!----------success msg-------------> 
      <br>
      <br>
      <br>
      @if(session()->has('success_msg'))
      <div class="alert alert-success"> {{ session()->get('success_msg') }} </div>
      @endif 
      
      <!----------success msg end------------->
      
      <div class="row"> 
        <!--------------------table data start-------------------------->
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Blog Meta Management</small></h2>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{url('/admin/blog-management')}}" class="btn btn-primary">Back</a>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div>
                <h4 class="modal-title" id="myModalLabel">Update Blog</h4>
              </div>
              <div class="modal-body">
                <form action="{!! url('admin/update-meta-blog') !!}" enctype="multipart/form-data" id="demo-form2" method="post"  class="form-horizontal form-label-left" onSubmit="return validation()">
                
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   
                 <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Title </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="meta_title" class="form-control col-md-7 col-xs-12" value="{!! $data->meta_title !!}" placeholder="Meta Title">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Description </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="meta_description" class="form-control col-md-9 col-xs-12" placeholder="Meta Description">{!! $data->meta_description !!}</textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Keywords </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="meta_keywords" class="form-control col-md-9 col-xs-12" placeholder="Meta Keywords">{!! $data->meta_keywords !!}</textarea>
                    </div>
                  </div>
                   
                   
                
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button type="submit" class="btn btn-success">Submit</button>
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
    <!-- /page content end --> 
    
  </div>
  <!-- footer content -->
  <footer> @include('admin.inc.footer') </footer>
  <!-- /footer content --> 
</div>
<script>
function validation(){
	$('.form-control').css('border-color', ''); 
		var category = $('#category').val();
		var title = $('#title').val();
		var editor = CKEDITOR.instances.editor1.getData();//$('#editor1').val();
		var editor2 = CKEDITOR.instances.editor2.getData();//$('#editor1').val();
		var image = $('#image').val();
		var slugExp = /^[a-zA-Z0-9-]*$/;///^\S*$/;// a string consisting only of non-whitespaces
		var nameExp =/^[a-zA-Z](.*[a-zA-Z]){2,}?$/;
		var author = $('#author').val();
		if(category==""){
          toastr.error("Please Choose Category");
          $('#category').css('border-color', 'red'); $( "#category" ).focus(); return false;
      }
      if(title=="" || title.trim()==""){
          toastr.error("Please Enter Post Name");
          $('#title').css('border-color', 'red'); $( "#title" ).focus(); return false;
      }
      if(!nameExp.test(title)){
		  toastr.error('No Blank Space Before and After Name or Do not use Special character Accepted');
		  $('#title').css('border-color', 'red'); $( "#title" ).focus();return false;
      }
      /*if(slug=="" || slug.trim()==""){
          toastr.error("Please Enter slug");
          $('#slug').css('border-color', 'red'); $( "#slug" ).focus(); return false;
      }
      if(!slugExp.test(slug)){
              toastr.error('No Blank Space Before and After slug or Do not use Special character Accepted');
              $('#slug').css('border-color', 'red'); $( "#slug" ).focus();return false;
      }
      if(short_desc=="" || short_desc.trim()==""){
          toastr.error("Please Enter Short Description");
          $('#short_desc').css('border-color', 'red'); $( "#short_desc" ).focus(); return false;
      }*/
      if(editor=="" || editor.trim()==""){
          toastr.error("Please Enter Short  Description");//return false;
          $('#short_label').css('color', 'red');
           window.location.hash = '#short_div';return false;
      }
	  if(editor2=="" || editor2.trim()==""){
			toastr.error("Please Enter Post  Description");//return false;
			$('#desc_label').css('color', 'red');
			 window.location.hash = '#desc_div';return false;
		}
      if(image==""){
          toastr.error("Please Choose Post Image");
          $('#image').css('border-color', 'red'); $( "#image" ).focus(); return false;
      }
	   if(author==""){
          toastr.error("Please Select Author");
          $('#author').css('border-color', 'red'); $( "#author" ).focus(); return false;
      }
      /*if(image_bg==""){
          toastr.error("Please Choose Background Image");
          $('#image_bg').css('border-color', 'red'); $( "#image_bg" ).focus(); return false;
      }
      if(image_content==""){
          toastr.error("Please Choose Content Image");
          $('#image_content').css('border-color', 'red'); $( "#image_content" ).focus(); return false;
      }*/
      else{
          return true;
          }
      return false;
  
	}
function deleletconfig(){

    var del=confirm("Are you sure you want to delete this record?");
    if (del==true){
           }
		   else
		   {
        
    }
    return del;
    }
	</script> 
<!-- jQuery --> 
{{---- jQuery ----}} 
<script src="{{ asset('resources/assets/admin/vendors/jquery/dist/jquery.min.js') }}"></script> 
{{---- Bootstrap ----}} 
<script src="{{ asset('resources/assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script> 
{{---- FastClick ----}} 
<script src="{{ asset('resources/assets/admin/vendors/fastclick/lib/fastclick.js') }}"></script> 
{{---- NProgress ----}} 
<script src="{{ asset('resources/assets/admin/vendors/nprogress/nprogress.js') }}"></script> 
{{---- bootstrap-progressbar ----}} 
<script src="{{ asset('resources/assets/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script> 
{{---- iCheck ----}} 
<script src="{{ asset('resources/assets/admin/vendors/iCheck/icheck.min.js') }}"></script> 
{{---- Skycons ----}} 
<script src="{{ asset('resources/assets/admin/vendors/skycons/skycons.js') }}"></script> 
{{---- DateJS ----}} 
<script src="{{ asset('resources/assets/admin/vendors/DateJS/build/date.js') }}"></script> 
{{---- Custom Theme Scripts ----}} 
<script src="{{ asset('resources/assets/admin/build/js/custom.min.js') }}"></script> 

<!-- Datatables --> 
<script src="{{ asset('resources/assets/admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}>"></script> 
<script src="{{ asset('resources/assets/admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/datatables.net-scroller/js/datatables.scroller.min.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/jszip/dist/jszip.min.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/pdfmake/build/pdfmake.min.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/vendors/pdfmake/build/vfs_fonts.js') }}"></script> 
<script src="{{ asset('resources/assets/admin/datepicker/bootstrap-datepicker.js') }}"></script> 
<!-- Datatables --> 
<!-- Datatables --> 
<script>
 $(function () {
 
    $('#datepicker').datepicker({
      autoclose: true
    });
	

 
  });
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script> 
<!-- /Datatables --> 

<!-- Editor --> 
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'editor1' );
	CKEDITOR.replace( 'editor2' );
	
	
	
   </script>
</body>
</html>
