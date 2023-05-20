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
                    <h2>Banner Management</h2>
                      
                    
                     <a href="{{url('control-panel/new-banner')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New </a> 
                      
                      
                    <div class="clearfix"></div>
                  </div> 
                  <div class="x_content">
                    
                    <form action="{{url('control-panel/remove-banner')}}" method="post">  
                       {{csrf_field()}}
                      
                   <table id="datatable1" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th width="5%"> {!! Helper::RemoveBTN() !!} <input type="checkbox" id="checkAll" name="checkAll" > </th>
                          <th width="30%">Main Title</th>
                          <th width="30%">Title</th>
                          <th width="10%">Status</th>
                          <th width="10%">Main Heading</th>
                          <th width="15%">Actions</th>
                        </tr>
                      </thead>

                       
                      
                       
                        @foreach($getBanner as $Rows)
                            
                            <tr>
                                <td><input type="checkbox" id="check" name="check[]" value="{{$Rows->id}}"></td>
                                <td>{{$Rows->img_alt}}</td>
                                <td>{{$Rows->image}}</td>
                                <td>{!! Helper::CheckDataStatus(url('control-panel/banner-status'),$Rows->id,$Rows->status) !!}</td>
                                <td>{!! Helper::CheckDataStatus(url('control-panel/banner-main-heading'),$Rows->id,$Rows->main_heading) !!}</td>
                                <td> 
                                    
                                    {!! Helper::EditBTN(url('control-panel/update-banner/'.$Rows->id)) !!}
                                    
                                </td>
                                
                            </tr>
                       
                        @endforeach
                       
                       
                      <tbody>
                          
                      </tbody>
                    </table>
                        
                        
                      </form>    
                        
                        
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
          </script>
          
          
          
          
        
          
    
  </body>

