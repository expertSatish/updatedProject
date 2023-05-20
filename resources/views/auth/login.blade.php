@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3 pb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">Login</a></li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7">
                    <ul class="LoginBox mt-5">
                        <li class="card Expert">
                            <div class="card-body">
                                <span class="img"><img src="{{asset('frontend/img/expert.svg')}}" height="80" width="80"></span>
                                <h3 class="d-block h5 thm m-0 mt-2">Expert Login</h3>
                            </div>
                        </li>
                        <li class="card User">
                            <div class="card-body">
                                <span class="img"><img src="{{asset('frontend/img/admin.svg')}}" height="80" width="80"></span>
                                <h3 class="d-block h5 thm m-0 mt-2">User Login</h3>
                            </div>
                        </li>
                    </ul>
                    <x-auth.expert-login/>
                    <x-auth.user-login/>
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
<title>Login : {{project()}}</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<style type="text/css">
section.grey>div{z-index:2;position:relative}
.ExpertBOx{width:450px;margin:20px auto 0}
.ExpertBOx>div{display:flex;justify-content:center}
.ExpertBOx .img{height:90px;min-width:90px;overflow:hidden}
.ExpertBOx .img img{height:100%;width:100%;object-fit:contain}
.ExpertBOx .text{width:calc(100% - 90px);margin-left:20px}
.ExpertBOx .text .star{font-size:18px!important}
.InputBOx .form-control~i{position:absolute;right:24px;top:18px;opacity:0;z-index:3;transition:all .5s}
.InputBOx .form-control:hover~i,.InputBOx .form-control:active~i,.InputBOx .form-control:focus~i,.InputBOx .form-control~i:hover,.InputBOx .form-control~i:active,.InputBOx .form-control~i:focus{opacity:1}
.formbtn{height:50px;min-width:50px!important;max-width:130px;width:auto!important;display:flex;align-items:center;border-radius:35px!important;border:1px solid var(--thm)!important;font-size:22px!important;color:var(--thm)!important}
.formbtn.btn-sm{font-size:16px!important;min-width:32px!important;padding:0 15px;height:32px}
.otpn{height:38px;max-width:38px!important;border-radius:9px!important;padding:0!important;font-size:18px!important}
.formbtn:hover{background:var(--thm)!important;color:var(--white)!important}
img.bg-img{position:relative;bottom:0;opacity:.6;margin-top:-20px;width:100%;height:auto;z-index:1}
.LoginBox{margin:0;padding:0;display:flex;flex-wrap:wrap;justify-content:center}
.LoginBox li{max-width:180px;width:100%;margin:0 15px;cursor:pointer;text-align:center}
.LoginBox li.card{border-color:transparent!important;background:transparent!important;transition:all .5s}
.LoginBox li.card>div{padding:1.5rem 1rem;}
.LoginBox li .img{height:110px;width:110px;border-radius:50%;background:var(--white);padding:15px;display:inline-block;border:1px solid rgb(var(--blackrgb)/.1);box-shadow:0 9px 9px rgb(var(--blackrgb)/.05);transition:all .5s}
.LoginBox li .img img{height:100%;width:100%;object-fit:contain}
.LoginBox li:hover{border:1px solid rgb(var(--blackrgb)/.1)!important;box-shadow:0 9px 9px rgb(var(--blackrgb)/.05);background:var(--thm)!important;}
.LoginBox li:hover h3{color:var(--white)!important}
.LoginBox li:hover .img{box-shadow:none;border-color:transparent}
@media (max-width:575px){.LoginBox li{max-width:155px;margin:0 9px;}
.LoginBox li h3{font-size:16px!important}
.LoginBox li.card>div{padding:1rem .5rem;}
.LoginBox li .img{height:90px;width:90px}}
@media (max-width:450px){.LoginBox li{max-width:125px}}
</style>
@endpush

@push('js')
<link rel="preload" as="style" href="css/flag-icons.min.css" onload="this.rel='stylesheet'">
<script type="text/javascript">
const UserLoginUrl = @json(route('userlogin'));
const UserLoginCheckOtp = @json(route('userloginotpcheck'));
const ExpertLoginUrl = @json(route('expertlogin'));
const ExpertLoginCheckOtp = @json(route('expertloginotpcheck'));
$(document).ready(function(){
    $('.CountryCode .dropdown-menu').find('li').click(function(e) {
        e.preventDefault();
        var spa = $(this).data('text');
        $('.CountryCode #CountryName').text(spa);
    });
    setTimeout(()=>{
        $(".emailnmobile").val('');
    },500);
});

setTimeout(()=>{
    $('input[name=email_mobile]').on("keyup", function(e){
        // alert();
        if (!$(this).val().length == 0){
            if ($.isNumeric($(this).val())) {
                // $('.OTPbox').fadeIn();
                $('.CountryCodeBox').fadeIn();
                $('.CountryCode .otpbtn').fadeIn();
                $('.InputBOx').hide();
            }
            else {
                $('.InputBOx').fadeIn();
                // $('.OTPbox').hide();
                $('.CountryCodeBox').hide();
                // $('.CountryCode .otpbtn').hide();
            }
        } 
        else {
            $('.InputBOx').hide();
            // $('.CountryCode .otpbtn').hide();
            $('.CountryCodeBox').hide();
            $('.OTPbox').hide();
        }
    });
},500);
$('.Expert').click(function() {
    $('.LoginBox').hide();
    $('.ExpertLogin').fadeIn();
});
$('.User').click(function() {
    $('.LoginBox').hide();
    $('.UserLogin').fadeIn();
});
$('.BackToLogin').click(function() {
    $('.UserLogin').hide();
    $('.ExpertLogin').hide();
    $('.LoginBox').fadeIn();
});
$('.CountryBox .formbtn').click(function() {
    // $('.CountryBox').hide();
    // $('.OTPbox').fadeIn();
});
$(".otpn").bind("input", function() {
    var $this = $(this);
    setTimeout(function() {
        if ( $this.val().length >= parseInt($this.attr("maxlength"),6))
            $this.next("input").focus();
    },0);
});
</script>
@endpush