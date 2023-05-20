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
                    <h2>Category Management</small></h2>
                    
                     {!! Helper::BackBtn(url('control-panel/news-category')) !!}
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                       <div>
            

            
          
 
                          <h4 class="modal-title" id="myModalLabel">Update Category</h4>
                        </div>
                        <div class="modal-body">
                        @foreach($categories as $row)
                          <form action="{!! url('control-panel/update-blog-category/'.$row->cate_id) !!}" id="demo-form2" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left" onSubmit="return validation()">
                          
                          
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">   
                       
                       
                              
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category Name <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="name" value="{{ $row->cate_name }}" id="name" class="form-control col-md-7 col-xs-12" >
                        
                        </div>
                      </div>          
                      
                      
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">URL Slug <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" name="alias" value="{{ $row->cate_alias }}"   id="slug" class="form-control col-md-7 col-xs-12" >
                          <p class="text-danger">Please don't change this field if not required.</p> 
                          <input type="hidden" name="old_alias" value="{{ $row->cate_alias }}"  >
                         
                        </div>
                      </div>
                      
                              
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                         
                         <textarea name="description" id="editor1" class="form-control col-md-7 col-xs-12" rows="5" placeholder="Meta Description">{{ $row->description }}</textarea> 
                          
                        </div>
                      </div>          
                              
                              
                              
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Title
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control col-md-7 col-xs-12" value="{{ $row->meta_title }}" placeholder="Meta Title" name="meta_title" >
                          
                          
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Description
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                         
                         <textarea name="meta_description" class="form-control col-md-7 col-xs-12" rows="5" placeholder="Meta Description">{{ $row->meta_description }}</textarea> 
                          
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Keywords
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea name="meta_keywords" class="form-control col-md-7 col-xs-12" rows="5" placeholder="Meta Keywords">{{ $row->meta_keywords }}</textarea> 
                          
                        </div>
                      </div>
                     
                      
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                         
                            <span  id="formsavebtnbox"></span>
                            <span  id="formsavebtnbox2"> <?php echo Helper::SaveBTN(); ?> </span> 
                        </div>
                      </div>

                    </form>
                     @endforeach
					</div>
                  
                  </div>
                </div>
              </div>
<!--------------------table data end-------------------------->         
         </div>
        </div>
       

  <footer>  @include('control-panel.inc.footer')  </footer>

 <script>
     
     CKEDITOR.replace( 'editor1' );
     
 function validation(){
	var name = $('#name').val();
	var nameExp =/^[a-zA-Z](.*[a-zA-Z]){2,}?$/;
	var slug = $('#slug').val();
	var slugExp = /^[a-zA-Z0-9-]*$/;///^\S*$/;// a string consisting only of non-whitespaces
	if(name=="" || name.trim()==""){
	toastr.error("Please Fill Name");
	$('#name').css('border-color', 'red'); $( "#name" ).focus(); return false;
	}
	if(!nameExp.test(name)){
		toastr.error("Minimum 3 Character Accepted. Don't Use Special character and Space");
		 $('#name').css('border-color', 'red'); $( "#name" ).focus(); return false;
	}
	if(slug=="" || slug.trim()==""){
	toastr.error("Slug is Not Empty");
	$('#slug').css('border-color', 'red'); $( "#slug" ).focus(); return false;
	}
	if(!nameExp.test(name)){
		toastr.error("Don't Use Special character and Space");
		 $('#slug').css('border-color', 'red'); $( "#slug" ).focus(); return false;
	}
	else{
                $('#formsavebtnbox2').hide(); 
                $('#formsavebtnbox').html('<?php echo Helper::ProcessingBTN(); ?>');
		return true;
		}
	return false;
	}
	</script>
   

