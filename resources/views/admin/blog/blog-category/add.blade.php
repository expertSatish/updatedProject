@extends('admin.layouts.app')
@section('content')
    
  <div class="br-mainpanel">

    <div class="br-pageheader pd-y-15 pd-l-20">

      <nav class="breadcrumb pd-0 mg-0 tx-12">

        <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>

        <a class="breadcrumb-item" href="{{route('admin.blogcategory')}}">Blog Category</a>

        <span class="breadcrumb-item active">Add Category</span>

      </nav>

    </div><!-- br-pageheader -->

    <div class="br-pagebody">

      <div class="br-section-wrapper">

        <form method="post" action="{{route('admin.saveblogcategory')}}" enctype="multipart/form-data">

          @csrf

        <div class="form-layout form-layout-1">

          <div class="row mg-b-25">

            <div class="col-lg-12">

              <div class="form-group">

                <label class="form-control-label">Category Name: <span class="error">*</span></label>

                <input class="form-control" type="text" name="category_name" value="{{old('category_name')}}" placeholder="Category Name Here...">

                @error('category_name')<span class="error">{{$message}}<span> @enderror

              </div>

            </div>

            <div class="col-lg-12">

              <div class="form-group">

                <label class="form-control-label">Meta Title: </label>

                <input class="form-control" type="text" name="meta_title" value="{{old('meta_title')}}" placeholder="Meta Title Here...">

                @error('meta_title')<span class="error">{{$message}}<span> @enderror

              </div>

            </div>



            <div class="col-lg-12">

              <div class="form-group">

                <label class="form-control-label">Meta Keywords: </label>

                <textarea class="form-control" placeholder="Meta Keywords Here..." name="meta_keywords" >{{old('meta_keywords')}}</textarea>

              </div>

            </div>



            <div class="col-lg-12">

              <div class="form-group">

                <label class="form-control-label">Meta Description: </label>

                <textarea class="form-control" placeholder="Meta Description Here..." name="meta_description" >{{old('meta_description')}}</textarea>

              </div>

            </div>    

            

          </div><!-- row -->



          <div class="form-layout-footer text-right">

            <button type="submit" id="svbtn" onclick="$('#svbtn').hide();$('#prcbtn').show();" class="btn btn-success">Confirm & Proceed</button>

            <button type="button" id="prcbtn" style="display:none;" disabled class="btn btn-success">Processing...</button>

          </div><!-- form-layout-footer -->

        </div><!-- form-layout -->

        </form>

      </div>

    </div>


  </div>

@endsection
@push('css')
   <link href="{{asset('admin/lib/select2/css/select2.min.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('frontend/fonts/flaticon/flaticon.css')}}" />

  <title>New Category : {{project()}}</title> 
@endpush
@push('js')
    
@endpush