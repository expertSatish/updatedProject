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
                <h4 class="modal-title" id="myModalLabel">Update Post</h4>
              </div>
              <div class="modal-body">
                <form action="{!! url('control-panel/post-update/'.$post->post_id) !!}" enctype="multipart/form-data" id="demo-form2" method="post"  class="form-horizontal form-label-left" onSubmit="return validation()">
                @php $categories = DB::table('blog_category')->where('cate_status', 1)->orderBy('cate_sort', 'ASC')->get(); @endphp
                    
                    
                 <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Post Date <span class="required text-danger">*</span> </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="post_date" id="datepicker" value="{!! date('d-m-Y',strtotime($post->post_date))!!}" readonly style="cursor:pointer;" class="form-control col-md-7 col-xs-12 datepicker">
                    </div>
                  </div>    
                    
                    
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category <span class="required text-danger">*</span> </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <select class="form-control col-md-7 col-xs-12" name="map_id" id="category">
                      	<option value="">Select Category</option>
                        @foreach($categories as $category)
                        	<option <?php if($post->post_mapped_id==$category->cate_id){echo 'selected';} ?>  value="{!! $category->cate_id !!}">{!! $category->cate_name !!}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title <span class="required text-danger">*</span> </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="name" id="title" class="form-control col-md-7 col-xs-12" placeholder="Post Title" value="{!! $post->post_name  !!}">
                    </div>
                  </div>
                 <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Post Url <span class="required text-danger">*</span> </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="post_alias"class="form-control col-md-7 col-xs-12" placeholder="Post Url" id="slug" value="{!! $post->post_alias  !!}">
                      <input type="hidden" name="old_alias" value="{!! $post->post_alias  !!}">
                    </div>
                  </div>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group" id="short_div">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" id="short_label" for="first-name">Short Description <span class="required text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12" >
                      <textarea name="short_description" id="editor1" class="form-control col-md-9 col-xs-12">{!! $post->post_short_desc  !!}</textarea>
                    </div>
                  </div>
                  <div class="form-group" id="desc_div">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" id="desc_label" for="first-name">Description <span class="required text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="description" id="editor2" class="form-control col-md-9 col-xs-12" >{!! $post->post_desc  !!}</textarea>
                    </div>
                  </div>
                  
                  <div class="form-group" style="display: none;" >
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Post Tags  </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="tags" class="form-control col-md-9 col-xs-12" >{!! $post->tags  !!}</textarea>
                      <p class="text-danger">Using comma (,) Between two Tags</p>
                    </div>
                  </div>
                  <div class="well">
                  
                  
                   <div class="col-sm-offset-3" style="display: none;">
    <input type="radio" value="1" onClick="image_btn()" name="type" <?php if($post->type==1){ echo 'checked'; } ?>> Image &nbsp;&nbsp;
                  <input  type="radio" value="2" onClick="youtubevideo_btn()" name="type" <?php if($post->type==2){ echo 'checked'; } ?>> Youtube Video &nbsp;&nbsp;
                   <input  type="radio" value="3" onClick="vimeovideo_btn()" name="type" <?php if($post->type==3){ echo 'checked'; } ?>> Vimeo Video &nbsp;&nbsp;
                  </div><br>
                  
                  
                  @if($post->type==1)
                  
                  <div id="image_div">


                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banner Image <span class="required text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="file" name="Bannerimage" class="form-control" id="Bannerimage" accept="image/*"/>
                      <input type="hidden" name="old_Bannerimage" value="{!! $post->banner_image !!}" id="old_image">
                      <p class="text-danger">Best Size 890 x 500px</p>
                     
                      <p><img src="{{ asset('resources/assets/uploads/post/banner/'.$post->banner_image) }}" style="width:200px"></p>
                     
                      
                    </div>
                  </div>  


                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Post Display Image <span class="required text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="file" name="brochure" class="form-control" id="image" accept="image/*"/>
                      <input type="hidden" name="old_image" value="{!! $post->post_image !!}" id="old_image">
                      <p class="text-danger">Best Size 500 x 350px</p>
                     
                      <p><img src="{{ asset('resources/assets/uploads/post/thumb/'.$post->post_image) }}" style="width:200px"></p>
                     
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Image Alt </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text"  name="img_alt"  class="form-control col-md-7 col-xs-12" placeholder="Image Alt" value="{!! $post->post_image_alt  !!}">
                    </div>
                  </div>
                  </div>
                  
                  
                  
                  <div id="youtubevideo_div" style="display:none;">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Youtube URL</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="youtubevideo"  class="form-control col-md-7 col-xs-12"  id="youtubevideo" placeholder="Youtube URL"></textarea>
                     <p>Ex. https://www.youtube.com/watch?v=PVxc5mIHVuQ</p>
                    </div>
                  </div>
                  </div>
                  
                  
                  
                  <div id="vimeovideo_div" style="display:none;">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vimeo URL</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="vimeovideo"  class="form-control col-md-7 col-xs-12"  id="vimeovideo" placeholder="Vimeo URL"></textarea>
                     <p>Ex. 54596361</p>
                    </div>
                  </div>
                  </div>
                  
                  
                  
                  @endif
                  
                  
                  @if($post->type==2)
                  
                  <div id="image_div" style="display:none;">
                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Post Display Image <span class="required text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="file" name="brochure" class="form-control" id="image" accept="image/*"/>
                      <input type="hidden" name="old_image" value="{!! $post->post_image !!}" id="old_image">
                      <p class="text-danger">Best Size Width 1200px x Height 675px</p>
                     
                      
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Image Alt </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text"  name="img_alt"  class="form-control col-md-7 col-xs-12" placeholder="Image Alt" value="{!! $post->post_image_alt  !!}">
                    </div>
                  </div>
                  </div>
                  
                  
                  
                  <div id="youtubevideo_div">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Youtube URL</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="youtubevideo"  class="form-control col-md-7 col-xs-12"  id="youtubevideo" placeholder="Youtube URL"><?php echo $post->post_image; ?></textarea>
                     <p>Ex. https://www.youtube.com/watch?v=PVxc5mIHVuQ</p>
                    </div>
                  </div>
                  </div>
                  
                  
                  
                  <div id="vimeovideo_div" style="display:none;">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vimeo URL</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="vimeovideo"  class="form-control col-md-7 col-xs-12"  id="vimeovideo" placeholder="Vimeo URL"></textarea>
                     <p>Ex. 54596361</p>
                    </div>
                  </div>
                  </div>
                  
                  
                  
                  @endif
                  
                  @if($post->type==3)
                  
                  <div id="image_div" style="display:none;">
                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Post Display Image <span class="required text-danger">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="file" name="brochure" class="form-control" id="image" accept="image/*"/>
                      <input type="hidden" name="old_image" value="{!! $post->post_image !!}" id="old_image">
                      <p class="text-danger">Best Size Width 1200px x Height 675px</p>
                     
                     
                     
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Image Alt </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text"  name="img_alt"  class="form-control col-md-7 col-xs-12" placeholder="Image Alt" value="{!! $post->post_image_alt  !!}">
                    </div>
                  </div>
                  </div>
                  
                  
                  
                  <div id="youtubevideo_div" style="display:none;">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Youtube URL</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="youtubevideo"  class="form-control col-md-7 col-xs-12"  id="youtubevideo" placeholder="Youtube URL"></textarea>
                      <p>Ex. https://www.youtube.com/watch?v=PVxc5mIHVuQ</p>
                     
                    </div>
                  </div>
                  </div>
                  
                  
                  
                  <div id="vimeovideo_div">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vimeo URL</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="vimeovideo"  class="form-control col-md-7 col-xs-12"  id="vimeovideo" placeholder="Vimeo URL"><?php echo $post->post_image; ?></textarea>
                     <p>Ex. 54596361</p>
                    </div>
                  </div>
                  </div>
                  
                  
                  
                  @endif
                  
                  
                  
                  
                  
                  
                  
                  </div>
                  <div class="form-group"  style="display:none">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Banner Image  </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="file" name="slider[]" class="form-control" id="image" accept="image/*"/>
                      <p class="text-danger">Best Size Width 1920px and Height 450px</p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Title </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="meta_title" class="form-control col-md-7 col-xs-12" placeholder="Meta Title" value="{!! $post->meta_title  !!}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Description </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="meta_description" class="form-control col-md-9 col-xs-12" placeholder="Meta Description">{!! $post->meta_description  !!}</textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Keywords </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="meta_keywords" class="form-control col-md-9 col-xs-12" placeholder="Meta Keywords">{!! $post->meta_keywords  !!}</textarea>
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
		var editor = CKEDITOR.instances.editor1.getData();//$('#editor1').val();
		var editor2 = CKEDITOR.instances.editor2.getData();//$('#editor1').val();
		var radio = document.querySelector('input[name="type"]:checked').value;
		var image = $('#image').val();
		var old_image =$('#old_image').val();
		var slugExp = /^[a-zA-Z0-9-]*$/;///^\S*$/;// a string consisting only of non-whitespaces
		var nameExp =/^[a-zA-Z](.*[a-zA-Z]){2,}?$/;
		var author = $('#author').val();
		var slug = $('#slug').val();
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
      if(slug=="" || slug.trim()==""){
          toastr.error("Please Enter slug");
          $('#slug').css('border-color', 'red'); $( "#slug" ).focus(); return false;
      }
      if(!slugExp.test(slug)){
              toastr.error('No Blank Space Before and After slug or Do not use Special character Accepted');
              $('#slug').css('border-color', 'red'); $( "#slug" ).focus();return false;
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
		  if(old_image==""){
			   toastr.error("Please Choose Post Image");
			  $('#image').css('border-color', 'red'); $( "#image" ).focus(); return false;
			  }
		  else
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
        
        <script>

    CKEDITOR.replace( 'editor1' );
	CKEDITOR.replace( 'editor2' );
	
	
	
   </script>






