@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="breadcrumb-item" href="{{ route('admin.faqscategory',['id'=>$parent]) }}">FAQs Category</a>
                <span class="breadcrumb-item active">Add FAQs Category</span>
            </nav>
        </div>
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <form method="post" action="{{ route('admin.savefaqscategory') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="parent" value="{{$parent ?? 0}}">
                    <div class="form-layout form-layout-1">
                        <div class="row mg-b-25">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Title: <span class="error">*</span></label>
                                    <input class="form-control" type="text" name="title" value="{{ old('title') }}"
                                        placeholder="Title Here...">
                                    @error('title')
                                        <span class="error">{{ $message }}<span>
                                    @enderror
                                </div>
                            </div>
                            @if ($parent==0)
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="p-0">IMAGE Size is 60px * 60px</label>
                                        <label class="custom-file">
                                            <input type="file" id="imgInp" name="image" class="custom-file-input">
                                            <span class="custom-file-control"></span>
                                        </label>
                                        @error('image')
                                            <span class="error">{{ $message }}<span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <img src="{{ asset('admin/img/img12.jpg') }}" id="defaultimg" class="w-100 defaultimgcss">
                                </div>
                            @endif                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Title:</label>
                                    <input class="form-control" type="text" name="meta_title"
                                        value="{{ old('meta_title') }}" placeholder="Meta Title Here...">
                                    @error('meta_title')
                                        <span class="error">{{ $message }}<span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Keywords: </label>
                                    <textarea class="form-control" placeholder="Meta Keywords Here..." name="meta_keywords">{{ old('meta_keywords') }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Meta Description: </label>
                                    <textarea class="form-control" placeholder="Meta Description Here..." name="meta_description">{{ old('meta_description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-layout-footer text-right">
                            <button type="submit" id="svbtn" onclick="$('#svbtn').hide();$('#prcbtn').show();"
                                class="btn btn-success">Confirm & Proceed</button>
                            <button type="button" id="prcbtn" style="display:none;" disabled
                                class="btn btn-success">Processing...</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('css')
<title>New FAQs Category : {{project()}}</title>
@endpush
@push('js')
<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
        defaultimg.src = URL.createObjectURL(file)
        }
    }
</script>
@endpush
