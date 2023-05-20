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
        
        
     <div class="mother-grid-inner">
               
                <div class="inner-block">

                    <div class="market-updates">
                        
                        <div class="col-md-4 market-update-gd" style="cursor: pointer;" onclick="window.location.href='{{url('control-panel/contact-enquiry')}}' ">
                            <div class="market-update-block clr-block-1">
                             <div class="col-md-8 market-update-left">
                                <h3>{{$Contact}}</h3>
                                <h4>Contact Enquiry </h4>
                                <p>Total Enquiry Of {{date('F')}}</p>
                              </div>
                                <div class="col-md-4 market-update-right">
                                    <i class="fa fa-file-text"> </i>
                                </div>
                              <div class="clearfix"> </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 market-update-gd" style="cursor: pointer;" onclick="window.location.href='{{url('control-panel/tax-enquiry-list')}}' ">
                            <div class="market-update-block clr-block-2">
                                <div class="col-md-8 market-update-left">
                                    <h3>{{$TaxEnquiry}}</h3>
                                    <h4>Tax Enquiry </h4>
                                    <p>Total Enquiry Of {{date('F')}}</p>
                                </div>
                                <div class="col-md-4 market-update-right">
                                    <i class="fa fa-comment"> </i>
                                </div>
                              <div class="clearfix"> </div>
                            </div>
                 </div>
                        
                        <div class="col-md-4 market-update-gd" style="cursor: pointer;" onclick="window.location.href='{{url('control-panel/order-management')}}' " >
                            <div class="market-update-block clr-block-3">
                                <div class="col-md-8 market-update-left">
                                    <h3>{{$Oredrs}}</h3>
                                    <h4>Order</h4>
                                    <p>Total Enquiry Of {{date('F')}}</p>
                                </div>
                                <div class="col-md-4 market-update-right">
                                    <i class="fa fa-comments"> </i>
                                </div>
                              <div class="clearfix"> </div>
                            </div>
                 </div>
                        
      
       <div class="clearfix"> </div>
    </div>

                    <div class="chit-chat-layer1">
  <div class="col-md-6 chit-chat-layer1-left">
               <div class="work-progres">
                            <div class="chit-chat-heading">
                                 Today Instant Enquiry
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead>
                                    <tr>
                                      
                                      <th>Name</th>
                                      <th>Mobile</th>
                                      <th>Email</th>
                                      <th>Agains of</th>
                                      <th>Action</th>
                                    </tr>
                              </thead>
                              <tbody>
                              
                              @foreach($OredrsData as $Rows)

                                    <tr>
                                        
                                      <td>{{$Rows->name}}</td>
                                      <td>{{$Rows->phone}}</td>
                                      <td>{{$Rows->email}}</td>
                                      <td><span class="label label-success">Order</span></td>
                                      <td>
                                        <a href="{{url('control-panel/order-details/'.$Rows->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Detail</a>
                                      </td>
                                    </tr>

                              @endforeach



                              @foreach($TaxEnquiryData as $Rows)

                                    <tr>
                                        
                                      <td>{{$Rows->name}}</td>
                                      <td>{{$Rows->phone}}</td>
                                      <td>{{$Rows->email}}</td>
                                      <td><span class="label label-primary">Tax</span></td>
                                      <td>
                                        <a href="{{url('control-panel/tax-enquiry-list')}}" class="btn btn-primary  btn-xs"><i class="fa fa-eye"></i> Detail</a>
                                      </td>
                                    </tr>

                              @endforeach


                              @foreach($ContactData as $Rows)

                                    <tr>
                                        
                                      <td>{{$Rows->name}}</td>
                                      <td>{{$Rows->phone}}</td>
                                      <td>{{$Rows->email}}</td>
                                      <td><span class="label label-warning">Contact Us</span></td>
                                      <td>
                                        <a href="{{url('control-panel/contact-enquiry')}}" class="btn btn-primary  btn-xs"><i class="fa fa-eye"></i> Detail</a>
                                      </td>
                                    </tr>

                              @endforeach
                              
                          </tbody>
                      </table>
                  </div>
             </div>
      </div>
        <div class="col-md-6 chart-layer1-left"> 
                                        <div class="glocy-chart">
                                        <div class="span-2c">  
                                        <h3 class="tlt row">
                                            <span class="col-xs-9">  Instant Enquiry Analytics </span>
                                            <span class="col-xs-3">
                                                <select class="form-control" onchange="getGraphData(this.value);" style="margin-top: -10px;">
                                                    @for($a=2021;$a<=date('Y');$a++)
                                                    <option value="{{$a}}" <?php if($a==date('Y')){echo "selected"; }?>>{{$a}}</option>
                                                    @endfor
                                                </select>
                                             
                                            </span>    
                                                
                                        </h3>
                                        
                                        
                                        <canvas id="bar" height="250" width="400" style="width: 400px; height: 250px;"></canvas>
                                        <div style="    text-align: center;">
                                            <span style=" margin: 2px; padding: 2px 5px; background-color: #7c7c7c;color: white;">Contact Enquiry </span>
                                            <span style=" margin: 2px; padding: 2px 5px; background-color: #63226b;color: white;">Tax Enquiry</span>
                                            <span style=" margin: 2px; padding: 2px 5px; background-color: #de9c12;color: white;">Order Enquiry</span>
                                            
                                        </div>
                                    </div>                    
                                        </div>
                                </div>
     <div class="clearfix"> </div>
</div>


                    


                    

                </div>

            </div>

        
        
    </div>
      
</div>
  
</div>    
    <footer> @include('control-panel.inc.footer') </footer>
   
    
    <script>
    $(document).ready(function() {
       
                     getGraphData('<?php echo date('Y');?>');    
       
    });
                
                
                function getGraphData(Date)
                {
                    var URL = "{{url('control-panel/get-graphdata')}}";
                    $.get(URL,
                    {
                        Year:Date
                    },function(data){
                        var Ret = data.split('^');
                        
 
                        
                         var barChartData = {
                                            labels : [Ret[1],Ret[2],Ret[3],Ret[4],Ret[5],Ret[6],Ret[7],Ret[8],Ret[9],Ret[10],Ret[11],Ret[12]],
                                            datasets : [
                                                {
                                                    
                                                    fillColor : "#7c7c7c",
                                                    data : [Ret[13],Ret[14],Ret[15],Ret[16],Ret[17],Ret[18],Ret[19],Ret[20],Ret[21],Ret[22],Ret[23],Ret[24]]
                                                },
                                                {
                                                    
                                                    fillColor : "#63226b",
                                                    data : [Ret[25],Ret[26],Ret[27],Ret[28],Ret[29],Ret[30],Ret[31],Ret[32],Ret[33],Ret[34],Ret[35],Ret[36]]
                                                },
                                                {
                                                    
                                                    fillColor : "#de9c12",
                                                    data : [Ret[37],Ret[38],Ret[39],Ret[40],Ret[41],Ret[42],Ret[43],Ret[44],Ret[45],Ret[46],Ret[48],Ret[48]]
                                                }
                                                
                                            ]
                                             
                                           

                                        };
                        new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);

                    });
                }
                
    </script>
                

</body>


