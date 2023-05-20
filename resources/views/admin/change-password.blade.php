@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
            <span class="breadcrumb-item active">Change Password</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="br-section-wrapper">

          <form method="post" action="{{route('admin.update-password')}}" enctype="multipart/form-data">

            @csrf

            <div class="form-layout form-layout-1">

                <div class="row mg-b-25">

                    <div class="col-lg-6">

                        <div class="form-group">

                            <label class="form-control-label">Your Name: <span class="error">*</span></label>

                            <input class="form-control" type="text" name="name" value="{{admininfo()->name}}" placeholder="Your Name Here...">

                            @error('name')<span class="error">{{$message}}<span> @enderror

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="form-group">

                            <label class="form-control-label">Email Address: <span class="error">*</span></label>

                            <input class="form-control" type="text" name="email_address" value="{{admininfo()->email}}" placeholder="Email Address Here...">

                            @error('email_address')<span class="error">{{$message}}<span> @enderror

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="form-group">

                            <label class="form-control-label">Password: </label>

                            <input type="text" name="password" id="password" class="form-control" placeholder="Password Here...">
                            
                            @error('password')<span class="error">{{$message}}<span> @enderror

                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="form-group">

                            <label class="form-control-label">Confirm Password: </label>
                            <input type="text" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password Here...">
                            @error('confirm_password')<span class="error">{{$message}}<span> @enderror

                        </div>

                    </div>

                </div>

                <div class="form-layout-footer text-right">

                    <button type="submit" id="svbtn" onclick="$('#svbtn').hide();$('#prcbtn').show();" class="btn btn-info">Confirm & Proceed</button>

                    <button type="button" id="prcbtn" style="display:none;" disabled class="btn btn-info">Processing...</button>

                </div>

            </div>

        </form>

    </div>

</div>

</div>  
@endsection


@push('css')

    <title>Change Password : {{project()}}</title>

@endpush

@push('js')

@endpush    

