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
              <h2>Post Management</small></h2>
               <a href="{!! url('control-panel/blog-post') !!}" class="btn btn-danger pull-right"><i class="fa fa-backward"></i> Back</a>
              
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div>
                <h4 class="modal-title" id="myModalLabel">Add New Post</h4>
              </div>
              <div class="modal-body">
                <form action="{!! url('control-panel/post-add') !!}" enctype="multipart/form-data" id="demo-form2" method="post"  class="form-horizontal form-label-left" onSubmit="return validation()">
                    
                    
                    
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Post Date <span class="required text-danger">*</span> </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="post_date" id="datepicker" value="{{date('d-m-Y')}}" readonly style="cursor:pointer;" class="form-control col-md-7 col-xs-12 datepicker">
                    </div>
                  </div>
                    
                    
                @php $categories = DB::table('blog_category')->where('cate_status', 1)->orderBy('cate_sort', 'ASC')->get(); @endphp
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category <span class="required text-danger">*</span> </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <select class="form-control col-md-7 col-xs-12" name="map_id" id="category">
                      	<option value="">Select Category</option>
                        @foreach($categories as $category)
                        	<option value="{!! $category->cate_id !!}">{!! $category->cate_name !!}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title <span class="required text-danger">*</span> </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="name" id="title" class="form-control col-md-7 col-xs-12" placeholder="Post Title">
                    </div>
                  </div>
                  
                 
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group" id="short_div">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" id="short_label" for="first-name">Short Description <span class="required text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12" >
                      <textarea name="short_description" id="editor1" class="form-control col-md-9 col-xs-12"></textarea>
                    </div>
                  </div>
                  <div class="form-group" id="desc_div">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" id="desc_label" for="first-name">Description <span class="required text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="description" id="editor2" class="form-control col-md-9 col-xs-12" ></textarea>
                    </div>
                  </div>
                  
<!--
                  <div class="form-group" >
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Post Tags  </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="tags" class="form-control col-md-9 col-xs-12" ></textarea>
                      <p class="text-danger">Using comma (,) Between two Tags</p>
                    </div>
                  </div>
-->
                  <div class="well">
                  
                  <div class="col-sm-offset-3 " style="display: none;">
                   <input type="radio" value="1" onClick="image_btn()" name="type" checked> Image &nbsp;&nbsp;
                  <input  type="radio" value="2" onClick="youtubevideo_btn()" name="type"> Youtube Video &nbsp;&nbsp;
                   <input  type="radio" value="3" onClick="vimeovideo_btn()" name="type"> Vimeo Video &nbsp;&nbsp;
                  </div><br>
                  
                  
                  <div id="image_div">
                  <div class="form-group">
                   
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banner Image <span class="required text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="file" name="bannerimage" class="form-control" id="bannerimage" accept="image/*"/>
                      <p class="text-danger">Best Size 890 x 500px</p>
                    </div>
                  </div>

                  <div class="form-group">
                   
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Post Display Image <span class="required text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="file" name="brochure" class="form-control" id="image" accept="image/*"/>
                      <p class="text-danger">Best Size 500 x 350px</p>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Image Alt </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text"  name="img_alt"  class="form-control col-md-7 col-xs-12" placeholder="Image Alt">
                    </div>
                  </div>
                  </div>
                  
                  
                  
                  <div id="youtubevideo_div" style="display:none;">
                   
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Youtube URL</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="youtubevideo"  class="form-control col-md-7 col-xs-12" placeholder="Youtube URL" id="youtubevideo"></textarea>
                      <p>Ex. https://www.youtube.com/watch?v=PVxc5mIHVuQ</p>
                     
                    </div>
                  </div>
                  
                 </div> 
                 
                 
                 <div id="vimeovideo_div" style="display:none;">
                   
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vimeo URL</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="vimeovideo"  class="form-control col-md-7 col-xs-12" placeholder="Vimeo URL" id="vimeovideo"></textarea>
                     <p>Ex. 54596361</p>
                    </div>
                  </div>
                  
                 </div>
                 
                  
                  </div>
                  <div class="form-group" style="display:none">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banner Image  </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="file" name="slider[]" class="form-control"  accept="image/*"/>
                       <p class="text-danger">Best Size Width 1920px and Height 450px</p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Title </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="meta_title" class="form-control col-md-7 col-xs-12" placeholder="Meta Title">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Description </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="meta_description" class="form-control col-md-9 col-xs-12" placeholder="Meta Description"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Keywords </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="meta_keywords" class="form-control col-md-9 col-xs-12" placeholder="Meta Keywords"></textarea>
                    </div>
                  </div>
                   
                   
                
                  <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        
                        <span  id="formsavebtnbox"></span>
                        <span  id="formsavebtnbox2"> <?php echo Helper::SaveBTN(); ?> </span> 
                                            
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


  <footer>  @include('control-panel.inc.footer')  </footer>


<script>

function image_btn() {
    document.getElementById('image_div').style.display = "block";
	document.getElementById('youtubevideo_div').style.display = "none";
	document.getElementById('vimeovideo_div').style.display = "none";
}
function youtubevideo_btn() {
    document.getElementById('image_div').style.display = "none";
	document.getElementById('youtubevideo_div').style.display = "block";
	document.getElementById('vimeovideo_div').style.display = "none";
}

function vimeovideo_btn() {
    document.getElementById('image_div').style.display = "none";
	document.getElementById('youtubevideo_div').style.display = "none";
	document.getElementById('vimeovideo_div').style.display = "block";
}


</script>

<script>
function validation(){
	$('.form-control').css('border-color', ''); 
		var category = $('#category').val();
		var title = $('#title').val();
		var radio = document.querySelector('input[name="type"]:checked').value;
		var editor = CKEDITOR.instances.editor1.getData();//$('#editor1').val();
		var editor2 = CKEDITOR.instances.editor2.getData();//$('#editor1').val();
		var image = $('#image').val();
	
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
	  if(radio==1){
		  if(image==""){
			  toastr.error("Please Choose Post Image");
			  $('#image').css('border-color', 'red'); $( "#image" ).focus(); return false;
		  }
	  }
	  if(radio==2){
		  if($('#video').val()=="" || $('#video').val().trim()==""){
			  toastr.error("Enter Video Embed Code");
			  $('#video').css('border-color', 'red'); $( "#video" ).focus(); return false;
		  }
		  else{
                             $('#formsavebtnbox2').hide(); 
                             $('#formsavebtnbox').html('<?php echo Helper::ProcessingBTN(); ?>'); 
			     return true;
			  }
		  }
	
      else{
                  $('#formsavebtnbox2').hide(); 
                  $('#formsavebtnbox').html('<?php echo Helper::ProcessingBTN(); ?>'); 
                return true;
          }
      return false;
  
	}

	</script> 

<script type="text/javascript">
	$(".js-example-tags").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})
</script>
<!-- Editor --> 
 <script>

    CKEDITOR.replace( 'editor1' );
	CKEDITOR.replace( 'editor2' );
	
	
	
   </script>

