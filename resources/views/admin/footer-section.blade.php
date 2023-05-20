
@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel">
  <div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
        <span class="breadcrumb-item active">Edit Footer Section</span>
    </nav>
  </div>
  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <form method="post" action="{{route('admin.savefooter')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$lists->id}}">
        <div class="form-layout form-layout-1">
          <div class="row databox">          
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">About: </label>
                <textarea class="form-control" name="about" id="about" placeholder="Write Something Here...">{{old('about',$lists->footer_about)}}</textarea>
              </div>
              @error('about')<span class="error">{{$message}}<span> @enderror
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Support Section: </label>
                <textarea class="form-control" name="support" id="support" placeholder="Write Something Here...">{{old('about',$lists->footer_support)}}</textarea>
              </div>
              @error('support')<span class="error">{{$message}}<span> @enderror
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
    <link href="{{asset('admin/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/fonts/flaticon/flaticon.css')}}" />
    <title>Edit Footer Section Section : {{project()}}</title>
@endpush
@push('js')

@endpush    
