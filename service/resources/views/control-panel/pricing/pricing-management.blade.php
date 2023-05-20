@include('control-panel.inc.header')

<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      @include('control-panel.inc.side-menu')

      <div class="right_col" role="main">
        <div class="row">
          @if(session()->has('success_msg')) <?php echo Helper::SuccessAlert(session()->get('success_msg')); ?> @endif
          @if(session()->has('error_msg')) <?php echo Helper::ErrorAlert(session()->get('error_msg')); ?> @endif

          @if ($errors->any())
          @foreach ($errors->all() as $error)
          {!! Helper::ErrorAlert($error) !!}
          @endforeach
          @endif
        </div>

        <div class="row">
          <!--------------------table data start-------------------------->
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Pricing Management</h2>

                <?php
                $getCatdtl = DB::table('nav_category')->where('id', Request::segment(3))->first();
                if ($getCatdtl->parent == 0) {
                  $Parent = '';
                } else {
                  $Parent = $getCatdtl->parent;
                }
                ?>

                {!! Helper::BackBtn(url('control-panel/service-management/'.$Parent)) !!}

                <a href="#AddModal1" data-toggle="modal" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> Heading Section</a>
                <a href="{{url('control-panel/new-pricing/'.Request::segment(3))}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New </a>


                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <form action="{{url('control-panel/remove-pricing')}}" method="post">
                  {{csrf_field()}}

                  <table id="datatable1" class="table table-striped table-bordered bulk_action">
                    <thead>
                      <tr>
                        <th width="5%"> {!! Helper::RemoveBTN() !!} <input type="checkbox" id="checkAll" name="checkAll"> </th>
                        <th>Title</th>
                        <th>Currency</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Top-Selling</th>
                        <th width="10%">Actions</th>
                      </tr>
                    </thead>




                    @foreach($getData as $Rows)



                    <tr>
                      <td><input type="checkbox" id="check" name="check[]" value="{{$Rows->id}}"></td>
                      <td>{{$Rows->title}}</td>
                      <td>{{$Rows->currency}}</td>
                      <td>{{$Rows->amount}}</td>
                      <td>{!! Helper::CheckDataStatus(url('control-panel/pricing-status'),$Rows->id,$Rows->status) !!}</td>
                      <td>
                        @if($Rows->top_selling==1)
                        <a href="{{url('/control-panel/top-selling/'.$Rows->id)}}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Active</a>
                        @else
                        <a href="{{url('/control-panel/top-selling/'.$Rows->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactive</a>
                        @endif
                      </td>
                      <td>

                        {!! Helper::EditBTN(url('control-panel/update-pricing/'.$Rows->id)) !!}

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

      <div id="AddModal1" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add Process</h4>
            </div>
            <form method="post" action="{{url('control-panel/nav-heading-save')}}" enctype="multipart/form-data">
              @csrf

              <div class="modal-body" style="max-height:338px;overflow:auto;">
                <div class="row">
                  <div id="imagebox1">
                    <div class="col-md-6">
                      <span>Title</span>
                      <input type="hidden" name="role" value="6">
                      <input type="hidden" name="nav_heading_id" value="@if(!empty($nav_heading->nav_heading_id)){{$nav_heading->nav_heading_id}}@endif">
                      <input type="hidden" name="category_id" value="{{$category_id}}">
                      <input type="text" class="form-control" name="title" value="@if(!empty($nav_heading->title)){{$nav_heading->title}}@endif">
                    </div>
                    <div class="col-md-6">
                      <span>Tab heading</span>
                      <input type="text" class="form-control" name="tab" value="@if(!empty($nav_heading->tab)){{$nav_heading->tab}}@endif">
                    </div>
                    <div class="col-md-12">
                      <span>Description</span>
                      <textarea class="form-control" name="description">@if(!empty($nav_heading->description)){{$nav_heading->description}}@endif</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer" style="text-align:center;">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <footer> @include('control-panel.inc.footer') </footer>

      <script>
        $(document).ready(function() {

          $("#datatable1").dataTable();
        });
      </script>




</body>