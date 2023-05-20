@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3 pb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">Payment</a></li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <h1 class="mt-2 h6 text-secondary text-center mb-3">Post Query</h1>
                    <h2 class="mt-2 h3 thm mb-3 text-center">Conversation for Experts</h2>
                    <form action="{{route('bookingquery')}}" method="post" class="card card-body formbox">
                        @csrf
                        <input type="hidden" name="booking" value="{{$lists->id}}">
                        <textarea class="form-control summernote" name="conversation"></textarea>
                        @error('conversation') <span class="error">{{$message}}</span> @enderror
                        <div class="text-center">
                            <button type="submit" onclick="$('.lbtn').show(); $('.sbtn').hide();" class="btn formbtn sbtn btn-thm2 mx-auto">Post Query <i class="fal fa-arrow-right ms-2"></i></button>
                            <button type="button" class="btn formbtn lbtn btn-thm2 mx-auto" style="display: none" disabled> <i class="fal fa-spinner-third fa-spin me-1"></i>Loading...</button>
                        </div>
                    </form>
                    <!-- <h2 class="h5 text-center">Digitally Transform your business</h2> -->
                    <div class="card ExpertBOx rounded-3 bg-light border">
                        <div class="card-body">
                            <div class="img rounded-circle border">
                                <x-image-box>
                                    <x-slot:image>{{$lists->expert->profile}}</x-slot:image>
                                    <x-slot:path>/uploads/expert/</x-slot:image>
                                    <x-slot:alt>{{$lists->expert->name ?? ''}} {{!empty($lists->expert->expertise->title) ? '('.$lists->expert->expertise->title.')' : ''}} </x-slot:image>
                                    <x-slot:width>380</x-slot:image>
                                    <x-slot:height>480</x-slot:image>
                                </x-image-box>
                            </div>
                            <div class="text">
                                <h3 class="h5 text-black verify">{{$lists->expert->name ?? ''}}</h3>
                                @if(!empty($lists->expert->suitable_industry))
                                <span class="text-secondary">
                                    @foreach(json_decode($lists->expert->suitable_industry) as $industry)
                                        @php $industry = \App\Models\Industry::find($industry); @endphp
                                        {{$industry->title ?? ''}} {{!$loop->last?'+':''}}
                                    @endforeach     
                                </span>
                                @endif
                                <div class="thm ExpStar"><span class="star" data-title="{{floatval($lists->expert->publishreviews()->avg('rating'))}}"></span> {{floatval($lists->expert->publishreviews()->avg('rating'))}} </div>
                            </div>
                        </div>
                    </div>
                    <div class="CustomerInfo text-center">
                        <div class="d-flex justify-content-between">
                            <div class="SetTime text-secondary text-start">
                                <div class="mb-1"><small><i class="far fa-calendar-alt text-black"></i> {{date('l, d M',strtotime($lists->booking_date))}}</small></div>
                                <div><small><i class="far fa-clock text-black"></i> {{substr($lists->booking_start_time,0,-3)}} to {{substr($lists->booking_end_time,0,-3)}}</small></div>
                                @if($lists->coupon_discount > 0)
                                <div><small><i class="far fa-check text-black"></i> Coupon Applied</small></div>
                                @endif
                            </div>
                            <div class="text-end">
                                <small>
                                    <span>Booking No: </span>
                                    <span class="text-black fw-bold">#{{$lists->booking_id}}</span>
                                </small><br>                        
                                <small>
                                    <span>Booking Amount: </span>
                                    <span class="text-black fw-bold"> <i class="Ricon">&#8377;</i> {{$lists->booking_amount}}/-</span>
                                </small>
                                @if($lists->coupon_discount > 0)
                                <br><small>
                                    <span>Discount Amount: </span>
                                    <span class="text-black fw-bold"> <i class="Ricon">&#8377;</i> {{$lists->coupon_discount}}/-</span>
                                    <a href="{{route('couponcancel',['booking'=>$lists->booking_id])}}" class="text-danger sws-top sws-bounce" data-title="Cancel Applied Coupon"><i class="fas fa-trash"></i></a>
                                </small>
                                @endif                                
                            </div>   
                        </div>                     
                    </div><hr>
                    <div class="price text-black text-center fw-bold">Paid Amount : <i class="Ricon">&#8377;</i> {{$lists->paid_amount}}/-</div>
                        
                </div>
            </div>
        </div>
        <img src="{{asset('frontend/img/bg-img1.svg')}}" width="900" height="500" class="bg-img">
    </section>
</main>
@endsection
@push('css')
<title>Payment Query : {{project()}}</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<style type="text/css">
.ExpertBOx,.CustomerInfo{width:450px;margin:20px auto 0}
.ExpertBOx>div{display:flex;justify-content:center}
.ExpertBOx .img{height:90px; min-width:90px;overflow:hidden}
.ExpertBOx .img img{height:100%;width:100%;object-fit:contain}
.ExpertBOx .text{width:calc(100% - 90px);margin-left:20px}
.ExpertBOx .text .star{font-size:18px!important}
.CountryCode a{border:1px solid #e1e1e1;display:flex;align-items:center;line-height:normal!important;background:var(--white)!important;padding:9px 25px;border-radius:30px}
.CountryCode a:after{font-size:18px}
.CountryCode a span{max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;font-size:18px!important;text-transform:uppercase}
.CountryCode a span:after{display:none}
.CountryCode .CountryCode{max-width:66px;text-align:center;padding:0!important}
.CountryCode>.form-control,.CustomerInfo .form-control{height:calc(3rem + 2px);border-radius:0 30px 30px 0!important;font-size:18px;padding:0 20px}
.CustomerInfo .form-control{border-radius:30px!important}
.CountryCode>.countrylist{padding:0;max-height:200px;overflow:auto;background:var(--white);right:auto!important;left:0!important}
.formbtn{height:50px;min-width:50px!important;width:auto!important;display:flex;align-items:center; justify-content:center; border-radius:35px!important;border:1px solid var(--thm)!important;font-size:22px!important;color:var(--thm)!important}
.formbtn.btn-sm{font-size:16px!important;padding:0 15px;height:36px}
.otpn{height:50px;max-width:50px!important;border-radius:9px!important;padding:0!important;font-size:18px!important}
.formbtn:hover{background:var(--thm)!important;color:var(--white)!important}
/* .SetTime{border:1px dashed rgb(var(--blackrgb)/.1);padding:9px 15px;border-radius:9px;display:inline-block;margin:0 auto} */
.price{font-size:22px!important}
section.grey>div{z-index:2;position:relative}
img.bg-img{position:relative;bottom:0;opacity:.6;margin-top:-9%;width:100%;height:auto;z-index:1}
.formbox{border-radius:9px!important;border:none!important;box-shadow:0 5px 12px rgb(var(--blackrgb)/.1); padding:var(--bs-card-spacer-y) 1.5rem!important}
.formbox .row>div{position:relative}
/* textarea.form-control{height:180px} */
</style>
@endpush
@push('js')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    setTimeout(() => {
        $('.summernote').summernote({
            height: 100,
            toolbar: []
        });
    },1000);
</script>
@endpush