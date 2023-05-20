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
                <h2>Blog Management</small></h2>
                <a href="{{url('control-panel/heading-edit/4')}}" class="btn btn-primary pull-right"><i class="fa fa-file-text"></i> Heading Section </a>
                <a href="{{url('control-panel/update-page-section/49')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Meta Management</a>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <table id="datatable" class="table table-striped table-bordered bulk_action">
                  <thead>
                    <tr>
                      <th>Sr.No.</th>
                      <th>Section</th>
                      <th>Actions</th>
                    </tr>
                  </thead>


                  <tbody>
                    <tr>
                      <td> 1 </td>
                      <td> Categories </td>
                      <td> <a href="{!! url('control-panel/blog-category') !!}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a> </td>
                    </tr>

                    <tr>
                      <td> 2 </td>
                      <td> Posts </td>
                      <td><a href="{!! url('control-panel/blog-post') !!}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a></td>
                    </tr>

                  </tbody>

                </table>
              </div>
            </div>
          </div>
          <!--------------------table data end-------------------------->
        </div>
      </div>


      <footer> @include('control-panel.inc.footer') </footer>