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
                            @if($flag) 
                                <h2>Update Pricing Management</h2>
                                {!! Helper::BackBtn(url('control-panel/pricing/'.$array_data->category_id)) !!}
                            @else
                                <h2>New pricing Management</h2>
                                {!! Helper::BackBtn(url('control-panel/pricing/'.Request::segment(3))) !!}
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="modal-body">
                                @if(!$flag) 
                                <form action="{{url('control-panel/save-pricing')}}" id="demo-form2" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" >
                                @else
                                <form action="{{url('control-panel/edit-pricing/'.$array_data->id)}}" id="demo-form2" method="post" enctype="multipart/form-data" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" >
                                @endif 
                                
                                @csrf
                                <input type="hidden" name="Category" value="{!! Request::segment(3) !!}">
                                <div class="form-group">
                                    <div class="col-md-12">
                                      <label class="control-label" for="first-name">Title <span class="text-danger required">*</span> </label>
                                      <input type="text" name="Title" id="Title" placeholder="Enter Title." value="@if($flag){{$array_data->title}}@endif" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                      <label class="control-label" for="first-name">Currency </label>
                                      <input type="text" name="Currency" id="Currency" placeholder="Enter Currency." value="@if($flag){{$array_data->currency}}@endif" class="form-control string">
                                    </div>
                                    <div class="col-md-2">
                                      <label class="control-label" for="first-name">Amount </label>
                                      <input type="text" name="Amount" onkeypress="return isNumberKey(event)" placeholder="Enter Amount." value="@if($flag){{$array_data->amount}}@endif" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                      <label class="control-label" for="first-name">Striked Price</label>
                                      <input type="text" name="striked_price" onkeypress="return isNumberKey(event)" id="Striked_Amount" placeholder="Enter Striked Price." value="@if($flag){{$array_data->striked_amount}}@endif" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="first-name">Description <span class="text-danger required">*</span> </label>
                                        
                                        <input type="text" name="Description" id="Detail" placeholder="Enter Description." value="@if($flag){{$array_data->text}}@endif" class="form-control">
                                    </div>
                                </div>
                                <hr>
                                <center><strong><u>PRICING LIST</u></strong></center>
                                @if($flag)
                                    <?php $List = DB::table('pricing_list')->where('pricing_id',$array_data->id)->get(); ?>
                                    @foreach($List as $Rot)
                                        <div class="form-group">
                                          <div class="col-md-11" style="margin-top: 20px;">
                                            <span>Text</span>
                                            <input type="hidden" name="listId[]" value="{{$Rot->id}}">
                                            <input type="text" name="list[]" class="form-control" value="{{$Rot->title}}">
                                          </div>
                                          <div class="col-md-1" style="margin-top: 20px;">
                                            <input type="hidden" id="BoxNum" value="1">
                                            <a href="{{url('control-panel/remove-pricing-list/'.$Rot->id)}}" class="btn btn-danger" style="margin-top: 20px;"><i class="fa fa-trash"></i></a>
                                          </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="form-group">
                                    <div class="col-md-11" style="margin-top: 20px;">
                                        <label class="control-label" for="first-name">Text</label>
                                        <input type="text" name="list[]" class="form-control">
                                    </div>
                                    <div class="col-md-1" style="margin-top: 20px;">
                                        <input type="hidden" id="BoxNum" value="1">
                                        <button class="btn btn-primary" type="button" style="margin-top: 20px;" onclick="AddMoreBox()"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div id="boxCT"></div>
                                </div>
                                <div class="morebox"></div>
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
</div>
<footer> @include('control-panel.inc.footer') </footer>
</body>
<script>
    $(document).ready(function(){
        $(".chosen-select").chosen();
        CKEDITOR.replace( 'Description' );
    });
    function AddMoreBox(){
        var BoxNum = $('#boxnum').val();
        var NewNum = parseInt(BoxNum) + parseInt(1); 
        $('#boxnum').val(NewNum); 
        $('.morebox').append('<div class="form-group" id="box'+NewNum+'" style="margin-top:5px;"><div class="col-md-11"><label class="control-label" for="first-name">Text </label><input type="text" name="list[]" id="Currency'+NewNum+'" class="form-control string"></div><div class="col-md-1" style="margin-top: 26px;"><button onclick="RemoveMoreBox('+NewNum+');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i></button></div></div>');
    }
    function RemoveMoreBox(Id){
        $('#box'+Id).remove();
    }    
    function validation(){
        $('.form-control').css('border-color', ''); 
        var Currency = $('#Currency').val();
        var Title = $('#Title').val();
        var Amount = $('#Amount').val();
        if(Title==''){
            toastr.error("Title field are required.");
            $('#Title').css('border-color', 'red');
            $( "#Title" ).focus();
        }else if(Currency==""){
            toastr.error("Currency field are required.");
            $('#Currency').css('border-color', 'red');
            $( "#Currency" ).focus();
            return false;
        }else if(Amount==''){
            toastr.error("Amount field are required.");
            $('#Amount').css('border-color', 'red');
            $( "#Amount" ).focus();
        }else{
            $('#formsavebtnbox').html('<?php echo Helper::ProcessingBTN(); ?>'); 
            $('#formsavebtnbox2').hide(); 
            return true;
        }
        return false;
    }
</script>