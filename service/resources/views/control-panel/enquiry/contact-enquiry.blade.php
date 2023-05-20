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
                    <h2>{!! ucwords(str_replace("-"," ", Request::segment(2))) !!} Management</h2>
                      
                      
                    <div class="clearfix"></div>
                  </div> 
                    
                    
                  <div class="x_content">
                    
                    
                     
                     <div class="col-md-12">
                         
                      
                        <table id="datatable1" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Date</th>    
                          <th>Name</th>     
                          <th>Email</th>
                          <th>Phone</th>
                          @if(Request::segment('2')!='footer-enquiry') <th>Subject</th> @endif    
                          <th>Comment</th>    
                          <th>Action</th>
                      
                            
                        </tr>
                      </thead>

                       
                      
                       
                        @foreach($arr_data as $Rows)
                           
                            
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{date('d M Y, H:i A',strtotime($Rows->created_at))}}</td>
                                <td>{{$Rows->name}}</td>
                                <td>{{$Rows->email}}</td>
                                <td>{{$Rows->phone}}</td>
                               @if(Request::segment('2')!='footer-enquiry') <td>{{$Rows->subject}}</td> @endif
                                <td>{{$Rows->message}}</td>
                                
                                <td>                                
<a href="{{url('control-panel/contact-enquiry-remove/'.$Rows->id)}}" onclick="return deleletconfig();" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</a>
                                </td>
                                
                            </tr>
                       
                        @endforeach
                       
                       
                      <tbody>
                          
                      </tbody>
                    </table>
                        
                        
                      
                     </div>     
                        
                  </div>
                  
                    
                </div>
            
            
                
            
              </div>
<!--------------------table data end-------------------------->         
         </div>
        </div>
        
           <footer>  @include('control-panel.inc.footer')  </footer>
           
          <script>
                 $(document).ready(function(){
    
               $("#datatable1").dataTable();
            }); 
              
              
              function addmore()
              {
                  var box = $("#adboxinpt").val();
                  var NewNum = parseInt(box) + parseInt(1);
                  $("#adboxinpt").val(NewNum);
                  
                  
                  $('#galbox').append('<div class="row" id="boxnum'+NewNum+'"><div class="col-md-5"><input type="text" name="alt[]" id="alt" class="form-control" placeholder="Enter Image Alt"></div><div class="col-md-5"><input type="file" name="images[]" id="images" class="form-control" placeholder="Enter Image Alt"></div><div class="col-md-2"><button type="button" onclick="removemore('+NewNum+');" class="btn btn-danger"><i class="fa fa-trash"></i></button></div></div>');
                  
              }
              
              
              
              function removemore(ID)
              {
                  
                   var box = $("#adboxinpt").val();
                   var NewNum = parseInt(box) - parseInt(1);
                   $("#adboxinpt").val(NewNum);
                  
                   $("#boxnum"+ID).remove();
              }
              
          </script>
          
          <!-- The Modal -->
            <div class="modal" id="gallery">
              <div class="modal-dialog">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">New Gallery</h4>
                   
                  </div>

                <form method="post" action="{{url('admin/save-gallery')}}" enctype="multipart/form-data">    
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <!-- Modal body -->
                  <div class="modal-body" style="overflow-y: auto;max-height: 460px;" id="galbox">
                      
                    <div class="row">
                        
                      <div class="col-md-5"><input type="text" name="alt[]" id="alt" required class="form-control" placeholder="Enter Image Alt"></div> 
                        
                      <div class="col-md-5"><input type="file" name="images[]" id="images" required class="form-control" placeholder="Enter Image Alt"></div>
                      <input type="hidden" id="adboxinpt" name="adboxinpt" value="1">    
                      <div class="col-md-2"><button type="button" onclick="addmore();" class="btn btn-primary"><i class="fa fa-plus"></i></button></div>
                        
                    </div>
                      
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                  </div>
                    
                </form>    
                    
                    
                </div>
              </div>
            </div>
          
        
  </body>

