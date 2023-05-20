@include('control-panel.inc.header')
<style>
  .dropdown-menu.statustab {
    background: #6f3377 !important;
  }
</style>
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Service Management </h2>
                        @if(!empty($serviceId))
                            @php
                                $getCatdtl = DB::table('nav_category')->where('id', $serviceId)->first();
                                if ($getCatdtl->parent == 0) {
                                  $Parent = '';
                                } else {
                                  $Parent = $getCatdtl->parent;
                                }
                            @endphp
                            <a href="{{url('control-panel/service-management/'.$Parent)}}" class="btn btn-danger pull-right"><i class="fa fa-arrow-left"></i> Back</a>
                            <a href="#AddModal" data-toggle="modal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New</a>
                        @endif
                        @if($arr_data[0]->level==1)
                        <a href="{{url('control-panel/heading-edit/1')}}" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> Home Page Heading Section </a>
                        @endif
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="post" action="{{url('control-panel/deal-sort')}}">
                        @csrf
                        <table id="datatable" class="table table-striped table-bordered bulk_action">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Title</th>
                                    <th>Alias</th>
                                    <th>Home Status</th>
                                    <th>Footer Status</th>
                                    <th>Menu Status</th>
                                    <th>Status</th>
                                    <th>Category Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                    <tbody>

                      @foreach($arr_data as $data)

                      <!-- @php $categories = DB::table('nav_category')->where('parent', $data->id)->orderBy('id', 'ASC')->count(); @endphp -->
                      <!-- @php $categories = DB::table('nav_category')->where('parent', $data->id)->orderBy('id', 'ASC')->count(); @endphp -->
                      <tr>



                        <td> {{$loop->iteration}} </td>

                        <td> {{ $data->title }}</td>

                        <td> {{ $data->alias }}</td>

                        <td>
                          @if($data->category_type==1)
                          @if($data->home_status==1)
                          <a href="{{url('/control-panel/home-status/'.$data->id)}}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Activated</a>
                          @else
                          <a href="{{url('/control-panel/home-status/'.$data->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactivated</a>
                          @endif
                          @else
                          @if($data->home_status==1)
                          <a href="#" disabled="disabled" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Activated</a>
                          @else
                          <a href="#" disabled="disabled" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactivated</a>
                          @endif
                          @endif
                        </td>

                        <td>
                          @if($data->category_type==1)
                          @if($data->footer_status==1)
                          <a href="{{url('/control-panel/footer-status/'.$data->id)}}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Activated</a>
                          @else
                          <a href="{{url('/control-panel/footer-status/'.$data->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactivated</a>
                          @endif
                          @else
                          @if($data->footer_status==1)
                          <a href="#" disabled="disabled" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Activated</a>
                          @else
                          <a href="#" disabled="disabled" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactivated</a>
                          @endif
                          @endif
                        </td>
                        
                        <td>
                          @if($data->category_type==1)
                          @if($data->menu_status==1)
                          <a href="{{url('/control-panel/menu-status/'.$data->id)}}" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Activated</a>
                          @else
                          <a href="{{url('/control-panel/menu-status/'.$data->id)}}" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactivated</a>
                          @endif
                          @else
                          @if($data->menu_status==1)
                          <a href="#" disabled="disabled" class="btn btn-success btn-xs"><i class="fa fa-thumbs-o-up"></i> Activated</a>
                          @else
                          <a href="#" disabled="disabled" class="btn btn-danger btn-xs"><i class="fa fa-thumbs-o-down"></i> Deactivated</a>
                          @endif
                          @endif
                        </td>

                        <td> {!! $Btn = Helper::CheckDataStatus( url('/control-panel/service-status/') , $data->id , $data->status ); !!} </td>
                        <td>
                          <!-- <select style="background: #6f3377;" class="btn btn-primary btn-sm" name="forma" onchange="call_category(this.value);">
                            @if($data->category_type==0)
                            <option value="0" selected>Category</option>
                            <option value="1">Service</option>
                            @endif
                            @if($data->category_type==1)
                            <option value="0">Category</option>
                            <option value="1" selected>Service</option>
                            @endif
                          </select> -->


                          <div class="dropdown">
                            <button type="button" id="action_btn1" class="btn btn-primary btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">@if($data->category_type==0) Set As Category @else Set As Service @endif<i class="fa fa-angle-down" aria-hidden="true"></i></button>
                            <div class="dropdown-menu" aria-labelledby="action_btn1">
                              @if($data->category_type==1)<a href="{{url('control-panel/service-category-change/0/'.$data->id)}}" class="dropdown-item">Category</a>@endif
                              @if($data->category_type==0)<a href="{{url('control-panel/service-category-change/1/'.$data->id)}}" class="dropdown-item">Service</a>@endif
                            </div>
                          </div>
                        </td>
                        <td>


                          <div class="dropdown">
                            <button type="button" id="action_btn1" class="btn btn-primary btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-archive"></i> Action <i class="fa fa-angle-down" aria-hidden="true"></i></button>

                            <div class="dropdown-menu" aria-labelledby="action_btn1">


                              <a href="{{url('control-panel/update-service/'.$data->id)}}" class="dropdown-item"><i class="fa fa-pencil"></i> Edit</a>

                              <a href="{{url('/control-panel/service-remove/'.$data->id)}}" onclick="return deleletconfig();" class="dropdown-item"><i class="fa fa-trash"></i> Remove</a>


                              @if($data->category_type==0)
                              <a href="{{url('control-panel/service-management/'.$data->id)}}" class="dropdown-item"><i class="fa fa-cubes"></i> Sub Category</a>
                              @endif

                              @if($data->category_type==1)
                              <a href="{{url('control-panel/category-banner/'.$data->id)}}" class="dropdown-item"><i class="fa fa-file-image-o"></i> Banner </a>

                              <a href="{{url('control-panel/process/'.$data->id)}}" class="dropdown-item"><i class="fa fa-tasks"></i> Process </a>

                              <a href="{{url('control-panel/advantages/'.$data->id)}}" class="dropdown-item"><i class="fa fa-cube"></i> Advantages </a>

                              <a href="{{url('control-panel/documents/'.$data->id)}}" class="dropdown-item"><i class="fa fa-file-text"></i> Documents </a>

                              <a href="{{url('control-panel/pre-requirements/'.$data->id)}}" class="dropdown-item"><i class="fa fa-cubes"></i> Pre requirements </a>

                              <a href="{{url('control-panel/annual-roc/'.$data->id)}}" class="dropdown-item"><i class="fa fa-briefcase"></i> Annual ROC Compliance </a>

                              <a href="{{url('control-panel/pricing/'.$data->id)}}" class="dropdown-item"><i class="fa fa-sitemap"></i> Pricing </a>

                              <a href="{{url('control-panel/faq-management/'.$data->id)}}" class="dropdown-item"><i class="fa fa-archive"></i> FAQs </a>

                              @endif

                            </div>
                          </div>

                        </td>



                      </tr>



                      @endforeach



                    </tbody>



                  </table>



                </form>



              </div>



            </div>



          </div>



        </div>



      </div>

    </div>



    <footer> @include('control-panel.inc.footer') </footer>



</body>





<script>
  function AddMoreBox()

  {



    var BoxNum = $('#boxnum').val();



    var NewNum = parseInt(BoxNum) + parseInt(1);



    $('#boxnum').val(NewNum);





    $('.morebox').append('<div class="row" id="box' + NewNum + '" style="margin-top:5px;"><div class="col-md-5"><span>Title</span><input type = "text"class = "form-control"name = "alt[]"id = "alt" ></div> <div class = "col-md-5"><span> Meta Title</span><input type ="text" class = "form-control" name = "title[]" id = "title"></div><div class ="col-md-5" ><span> Meta Keywords</span><input type ="text" class ="form-control" name ="keywords[]" id="keywords" ></div><div class ="col-md-5"><span> Meta Description</span><input type ="text" class ="form-control" name = "description[]" id ="description"></div><div class="col-md-1"></span> <input type ="hidden" name ="boxnum" id ="boxnum" value ="1"><button onclick="RemoveMoreBox(' + NewNum + ');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> </button></div ></div>');



  }







  function getTypeData(data, Id)

  {

    if (data == 'youtube')

    {

      $('#videobox' + Id).show();

      $('#imagebox' + Id).hide();

    } else

    {

      $('#imagebox' + Id).show();

      $('#videobox' + Id).hide();

    }

  }



  function RemoveMoreBox(Id)

  {

    // var BoxNum = $('#boxnum').val();



    //  var NewNum = parseInt(BoxNum) - parseInt(1); 



    //    $('#boxnum').val(NewNum); 



    $('#box' + Id).remove();

  }





  function EditModalWindow(Id, Name)

  {

    $('#EditId').val(Id);

    $('#Editservice').val(Name);

  }
</script>



<!-- Modal -->

<div id="AddModal" class="modal fade" role="dialog">

  <div class="modal-dialog modal-md">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Add Category</h4>

      </div>



      <form method="post" action="{{url('control-panel/save-service')}}" enctype="multipart/form-data">


        @csrf

        <input type="hidden" name="parentId" value="{{Request::segment(3)}}">

        <div class="modal-body" style="max-height:338px;overflow:auto;">



          <div class="row">


            <div id="imagebox1">

              <div class="col-md-5">
                <span>Title</span>
                <input type="text" class="form-control" name="alt[]" id="alt">
              </div>
              <div class="col-md-5">
                <span>Meta Title</span>
                <input type="text" class="form-control" name="title[]" id="title">
              </div>
              <div class="col-md-5">
                <span>Meta Keywords</span>
                <input type="text" class="form-control" name="keywords[]" id="keywords">
              </div>
              <div class="col-md-5">
                <span>Meta Description</span>
                <input type="text" class="form-control" name="description[]" id="description">
              </div>

            </div>


            <div class="col-md-1">

              <span>&nbsp;&nbsp;&nbsp;</span>

              <input type="hidden" name="boxnum" id="boxnum" value="1">

              <button onclick="AddMoreBox();" class="btn btn-primary" type="button"><i class="fa fa-plus"></i></button>

            </div>



          </div>



          <div class="morebox"></div>



        </div>

        <div class="modal-footer">

          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>

          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>

        </div>



      </form>





    </div>



  </div>

</div>