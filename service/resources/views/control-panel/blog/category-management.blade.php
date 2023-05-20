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
         
         <div class="modal fade bs-example-modal-lg">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> </button>
                <h4 class="modal-title" id="myModalLabel">Add Category</h4>
              </div>
              <div class="modal-body">
                <form action="{!! url('control-panel/blog-add-category') !!}" enctype="multipart/form-data" id="demo-form2" method="post"  class="form-horizontal form-label-left" onSubmit="return validation()">
                  
                 
                
                 <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="text-danger required">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="name" id="name" class="form-control col-md-7 col-xs-12" placeholder="Category Name">
                    </div>
                  </div>    
                    
                
                 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                         
                         <textarea name="description" id="editor1" class="form-control col-md-7 col-xs-12" rows="5" placeholder="Meta Description"></textarea> 
                          
                        </div>
                      </div>    
                    
                    
                  
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Title </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" name="meta_title" id="slider_name" class="form-control col-md-7 col-xs-12" Placeholder="Meta Title" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Description </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="meta_description" class="form-control col-md-9 col-xs-12" Placeholder="Meta Description"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Keywords </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="meta_keywords" class="form-control col-md-9 col-xs-12" Placeholder="Meta Keywords"></textarea>
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
       
      
      
      <div class="row"> 
        <!--------------------table data start-------------------------->
        <form action="{!! url('control-panel/cat-change-sequence') !!}" enctype="multipart/form-data" id="demo-form2" method="post"  class="form-horizontal form-label-left" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Blog Category Management</small></h2>
              <a href="{!! url('control-panel/blog-management') !!}" class="btn btn-danger pull-right"><i class="fa fa-backward"></i> Back</a>
              <button type="submit" class="btn btn-success pull-right"><i class="fa fa-pencil-square-o"></i> Change Sequence</button>
               
              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> Add News Category </button>
              
               
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table id="datatable" class="table table-striped table-bordered bulk_action">
                <thead>
                  <tr>
                    <th>Sr.No. </th>
                    <th>Name</th>
                    <th>Category Status</th>
                    <th>Sequence</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                
                @foreach ($categories as $data)
                
                 
                <tr>
                  <td> {{ $loop->iteration }} </td>
                  <td> {{ $data->cate_name }} </td>
                  <td><?php $category_status=$data->cate_status; ?>
                    @if($category_status==1) 
                    <a href="{!! route('change-category-status', ['status'=>0,'id'=>$data->cate_id]) !!}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Active</a>
                    @else 
                    <a href="{!! route('change-category-status', ['status'=>1,'id'=>$data->cate_id]) !!}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactive</a> 
                    @endif </td>
                   
                    
                     
                    
                    
                   
                    
                    <td>
                    <input type="text" name="sequence[{!! $data->cate_id !!}]" style="width:40px" value="{!! $data->cate_sort !!}" class="form-control">
                    </td>
                    
                  <td>
                       {!! Helper::EditBTN(route('blog-edit-category', ['id'=>$data->cate_id]))!!}
                      
                      <a href="{{url('control-panel/blog-delete-category/'.$data->cate_id)}}" onclick="return deleletconfig()" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a>
                      
                      
                 </td>
                </tr>
                @endforeach
                  </tbody>
                
              </table>
            </div>
          </div>
        </div>
        </form>
        <!--------------------table data end--------------------------> 
      </div>
    </div>

     
<footer>  @include('control-panel.inc.footer')  </footer>

<script>
    
    CKEDITOR.replace( 'editor1' );
    
 function validation(){
	var name = $('#name').val();
	var nameExp =/^[a-zA-Z](.*[a-zA-Z]){2,}?$/;
     
	if($('#type').val()==""){
	toastr.error("Please choose category type");
	$('#type').css('border-color', 'red'); $( "#type" ).focus(); return false;
	} 
    else if(name=="" || name.trim()==""){
	toastr.error("Please Fill Name");
	$('#name').css('border-color', 'red'); $( "#name" ).focus(); return false;
	}
	else if(!nameExp.test(name)){
		toastr.error("Minimum 3 Character Accepted. Don't Use Special character and Space");
		 $('#name').css('border-color', 'red'); $( "#name" ).focus(); return false;
	}
    else{
                $('#formsavebtnbox2').hide(); 
                $('#formsavebtnbox').html('<?php echo Helper::ProcessingBTN(); ?>');
		return true;
		}
	return false;
	}
	</script> 

