@extends('layouts.app')
@section('content')
<main>
    <section class="HearderSec">
        <div class="container">
            <div class="row align-items-end mt-md-5 pt-md-5 mt-4 pt-4">
                <div class="col-lg-7">
                    <span class="h5 fw-normal">{{$cms->heading}}</span>
                    <h1 class="mb-3">{{$cms->title}}</h1>
                    {!! $cms->description !!}
                </div>
                <div class="col-lg-5 text-lg-center">
                    {{-- <h4 class="h5 mb-3 mt-4">Also you can mail us to <a href="mailto:hello@expertbells.com">hello@expertbells.com</a></h3> --}}
                </div>
            </div>
        </div>
    </section>
    <section class="Sec5 Contact pt-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 678.11" fill="#f9f5ef"><path d="M0,310.08s136.21-124.85,346-80c316.49,67.63,334-128,568-190,206.83-54.82,371.57,40,488,40,67.74,0,198-80,198-80V678.19H0Z"></path></svg>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 order-lg-last">
                    <form action="{{route('contactus')}}" method="POST" class="ConForm card">
                        @csrf
                        <div class="card-header">
                            <h3 class="h4 m-0 d-flex justify-content-between w-100">Contact Us <i class="fal fa-envelope-open"></i></h3>
                        </div>
                        <div class="card-body">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control inputTextBox" id="name" value="{{old('name')}}" name="name" placeholder="Name">
                                <label for="name" class="form-label">Name</label>
                                @error('name') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Email ID">
                                <label for="Email" class="form-label">Email</label>
                                @error('email') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="number" class="form-control" id="phone" name="mobile" value="{{old('mobile')}}" placeholder="Mobile No.">
                                <label for="Phone" class="form-label">Mobile No.</label>
                                @error('mobile') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <select class="form-control form-select" name="reason">
                                    <option selected disabled>Select Reason</option>
                                    <option value="general" @selected(old('reason')=='general') >General</option>
                                    <option value="payment-related" @selected(old('reason')=='payment-related') >Payment Related</option>
                                    <option value="spam-emails" @selected(old('reason')=='spam-emails') >Spam Emails</option>
                                    <option value="error-issue" @selected(old('reason')=='error-issue') >Error Issue</option>
                                    <option value="other" @selected(old('reason')=='other') >Other</option>
                                </select>
                                <label for="Subject" class="form-label">Select Reason</label>
                                @error('reason') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            {{-- <div class="form-floating mb-4">
                                <select class="form-control form-select" name="business_sector">
                                    <option selected disabled>Select Business Sector</option>
                                    @foreach ($businesssectors as $item)
                                    <option value="{{$item->id}}" @selected(old('business_sector')==$item->id)>{{$item->title}}</option>
                                    @endforeach                                    
                                </select>
                                <label for="Subject" class="form-label">Select Business Sector</label>
                            </div> --}}
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a Message here" name="message" id="Message">{{old('message')}}</textarea>
                                <label for="Message">Message</label>
                                @error('message') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" onclick="$('.csbtn').hide(); $('.cpbtn').show();" class="btn btn-thm4 csbtn">Submit</button>
                                <button type="button" style="display:none;" class="btn btn-thm4 cpbtn" disabled><i class="fad fa-spinner-third me-1 fa-spin"></i> Loading...</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-lg-7 mt-lg-5">
                    <h2 class="Heading h3 mt-lg-5 mt-4">{{$contact->title}}</h2>
                    {!! $contact->description !!}
                </div>
            </div>
        </div>
        <x-newsletter/>
    </section>
</main>
@endsection
@push('css')
<title>Contact Us : Expert Bells</title>
<meta name="description" content="Welcome to expert Bells">
<meta name="keywords" content="Welcome to expert Bells">
<style type="text/css">
.HearderSec span,.HearderSec p,.HearderSec p a,.HearderSec h4{color:rgb(var(--whitergb)/.7)!important;font-weight:normal;}
.HearderSec h4 a{color:var(--white);}
.Contact{overflow:inherit!important;margin-top:-60px;}
.Contact .ConForm{border-radius:0!important;background:#e7e8eb;border:none!important;}
.Contact .ConForm>*{padding:25px!important;border-radius:0!important;}
.Contact .ConForm .card-header{background:var(--thm1);color:var(--white);padding:15px 25px!important}
@media (max-width:992px){.Contact{margin-top:20px}}
</style>
@endpush
@push('js')
    
@endpush