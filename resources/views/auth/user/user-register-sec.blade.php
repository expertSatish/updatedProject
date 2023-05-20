@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner">
        <div class="section">
            <div class="bg-white"></div>
        </div>
    </section>
    <section class="grey pt-3 pb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">User Sign Up</a></li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-10">
                    <!-- <label for="lemail" class="form-label mb-0 ms-3"><small>Phone No.</small></label> -->
                    <div class="row align-items-end">
                        <div class="col-12 text-center">
                            <h1 class="mt-2 h6 text-secondary mb-3">Steps 2 out of 4</h1>
                        </div>
                    </div>
                    <form action="{{route('user.savesecSave')}}" method="post" class="card card-body formbox">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <label class="ms-2"><small>Company Name</small></label>
                                <input type="text" class="form-control inputTextBox" name="company_name"
                                    placeholder="Company Name" value="{{ old('company_name') }}">
                                @if($errors->has('company_name'))
                                <div style="color:red">
                                    {{ $errors->first('company_name') }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="ms-2"><small>Designation</small></label>
                                <input type="text" class="form-control inputTextBox" name="designation"
                                    placeholder="Designation" value="{{ old('designation') }}">
                                @if($errors->has('designation'))
                                <div style="color:red">
                                    {{ $errors->first('designation') }}
                                </div>
                                @enderror
                            </div>
                            <input type="hidden" name="user_id" value="{{$userId}}">

                            <div class="col-lg-6 mb-2">
                                <label class="ms-2"><small>Country</small></label>
                                <select id="country-dd" name="country" class="form-control">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $data)
                                    <option value="{{$data->id}}">
                                        {{$data->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mb-2">
                                <label class="ms-2"><small>State</small></label>
                                <select id="state-dd" name="state" class="form-control">
                                </select>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="ms-2"><small>City</small></label>
                                <select id="city-dd" name="city" class="form-control">
                                </select>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="ms-2"><small>GST Number</small></label>
                                <input type="text" class="form-control" name="gst_number" placeholder="GST Number"
                                    value="{{ old('gst_number') }}">
                                @if($errors->has('gst_number'))
                                <div style="color:red">
                                    {{ $errors->first('gst_number') }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-2">
                                <button class="btn formbtn px-4 btn-thm2 sbtn">Next</button>
                                <button type="button" class="btn formbtn px-4 btn-thm2 disabled pbtn"
                                    style="display: none"><i class="fad fa-spinner-third fa-spin me-1"></i>
                                    Loading...</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
        <div class="bg-img">
            <img src="{{asset('frontend/img/bg-img-l.svg')}}" width="450" height="500">
            <img src="{{asset('frontend/img/bg-img-r1.svg')}}" width="450" height="500">
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Step 1 for User Sign Up : {{project()}}</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<style type="text/css">
section.grey>div {
    z-index: 2;
    position: relative
}

img.bg-img {
    position: relative;
    bottom: 0;
    opacity: .6;
    margin-top: -90px;
    width: 100%;
    height: auto;
    z-index: 1
}

.formbox {
    border-radius: 9px !important;
    border: none !important;
    box-shadow: 0 5px 12px rgb(var(--blackrgb)/.1);
    padding: var(--bs-card-spacer-y) 1.5rem !important
}

.formbox .row>div {
    position: relative
}

.ListBox {
    margin: 0;
    padding: 0;
    display: flex;
    flex-wrap: wrap
}

.ListBox>li {
    margin-bottom: 8px;
    padding-bottom: 8px;
    border-bottom: 1px solid rgb(var(--blackrgb)/.1);
    width: 50%
}

/*.ListBox>li:last-child{border:none}*/
</style>
@endpush
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#country-dd').on('change', function() {
        var idCountry = this.value;
        $("#state-dd").html('');
        $.ajax({
            url: "{{url('api/fetch-states')}}",
            type: "POST",
            data: {
                country_id: idCountry,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(result) {
                $('#state-dd').html('<option value="">Select State</option>');
                $.each(result.states, function(key, value) {
                    $("#state-dd").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
                $('#city-dd').html('<option value="">Select City</option>');
            }
        });
    });
    $('#state-dd').on('change', function() {
        var idState = this.value;
        $("#city-dd").html('');
        $.ajax({
            url: "{{url('api/fetch-cities')}}",
            type: "POST",
            data: {
                state_id: idState,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(res) {
                $('#city-dd').html('<option value="">Select City</option>');
                $.each(res.cities, function(key, value) {
                    $("#city-dd").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });
});
</script>
@push('js')

@endpush