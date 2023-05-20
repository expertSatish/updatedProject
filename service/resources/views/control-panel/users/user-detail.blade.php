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
                <h2 class="pull-left">User Details</h2>
                <a href="{!! url('control-panel/user-list') !!}" class="btn btn-info pull-right"><i class="fa fa-reply"></i> Back </a>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div>
                  <center>
                    <h4><u><strong>User Personal Detail</strong></u></h4>
                  </center>
                </div>
                <table class="table table-striped table-bordered bulk_action">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <td> {{ $user->first_name }} {{ $user->last_name }} </td>
                      <th>Email</th>
                      <td> {{ $user->email }} </td>
                    </tr>
                    <tr>
                      <th>Phone</th>
                      <td> {{ $user->phone }} </td>
                      <th>Status</th>
                      @if($user->status==1)
                      <td class="bg-success">
                        Active
                      </td>
                      @else
                      <td class="bg-danger">
                        De-Active
                      </td>
                      @endif
                    </tr>
                  </thead>

                </table>
                <hr />
                <div>
                  <center>
                    <h4><u><strong>User Address</strong></u></h4>
                  </center>
                </div>
                @if(count($address)>0)
                <table class="table table-striped table-bordered bulk_action">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Business</th>
                      <th>GST NUmber</th>
                      <th>Address</th>
                      <th>City</th>
                      <th>State</th>
                    </tr>
                    @foreach($address as $i)
                    <tr>
                      <td> {{ $i->name }} </td>
                      <td> {{ $i->business }} </td>
                      <td> {{ $i->gst }} </td>
                      <td> {{ $i->address }} </td>
                      <td> {{ $i->city }} </td>
                      <td> {{ $i->state }} </td>
                    </tr>
                    @endforeach
                  </thead>
                </table>
                @endif

                <!----------User-Documents-------->

                <hr />
                <div>
                  <center>
                    <h4><u><strong>User Documents</strong></u></h4>
                  </center>
                </div>
                @if(count($documents)>0)
                <table class="table table-striped table-bordered bulk_action">
                  <thead>
                    <div class="row">
                      <div class="col-lg-12 h4">Uploaded Documents</div>
                      @foreach($documents as $i)
                      @if(pathinfo($i->document, PATHINFO_EXTENSION)=='jpg' || pathinfo($i->document, PATHINFO_EXTENSION)=='png' || pathinfo($i->document, PATHINFO_EXTENSION)=='jpeg')
                      <div class="col-lg-3"><img src="{{asset('/resources/assets/uploads/user-documents/'.$i->document)}}" width="100px" height="100px" alt="">
                        @if($i->status==0)
                        <span class="badge badge-warning">Under Verification</span>
                        <span><a href="{{url('/document-verify/'.$i->id)}}" class="btn btn-success">Verify @if($i->document_name==null) Document @else {{$i->document_name}} @endif</a></span>
                        @endif
                        @if($i->status==1)
                        <span class="badge badge-success">Document Verified</span>
                        <span><a href="{{url('/document-reject/'.$i->id)}}" class="btn btn-danger">Reject @if($i->document_name==null) Document @else {{$i->document_name}} @endif</a></span>
                        @endif
                        @if($i->status==2)
                        <span class="badge badge-danger">Document Rejected</span>
                        <span><a href="{{url('/document-verify/'.$i->id)}}" class="btn btn-success">Verify @if($i->document_name==null) Document @else {{$i->document_name}} @endif</a></span>
                        @endif
                        <span><a href="{{url('/document-delete/'.$i->id)}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></span>
                      </div>
                      @else
                      <div class="col-lg-3">
                        <a href="{{asset('/resources/assets/uploads/user-documents/'.$i->document)}}" target="_blank"><img src="{{asset('resources/assets/frontend/images/unnamed.png')}}" width="100px" height="100px" alt=""></a>
                        @if($i->status==0)
                        <span class="badge badge-warning">Under Verification</span>
                        <span><a href="{{url('/document-verify/'.$i->id)}}" class="btn btn-success">Verify @if($i->document_name==null) Document @else {{$i->document_name}} @endif</a></span>
                        @endif
                        @if($i->status==1)
                        <span class="badge badge-success">Document Verified</span>
                        <span><a href="{{url('/document-reject/'.$i->id)}}" class="btn btn-danger">Reject @if($i->document_name==null) Document @else {{$i->document_name}} @endif</a></span>
                        @endif
                        @if($i->status==2)
                        <span class="badge badge-danger">Document Rejected</span>
                        <span><a href="{{url('/document-verify/'.$i->id)}}" class="btn btn-success">Verify @if($i->document_name==null) Document @else {{$i->document_name}} @endif</a></span>
                        @endif

                        <span><a href="{{url('/document-delete/'.$i->id)}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></span>
                      </div>
                      @endif
                      @endforeach
                  </thead>
                </table>
                @else
                <div class="text-center" style="padding-top:3%">
                  <h4>No Document Uploaded</h4>
                </div>
                @endif
              </div>
            </div>
          </div>
          <!--------------------table data end-------------------------->
        </div>
      </div>



      <footer> @include('control-panel.inc.footer') </footer>