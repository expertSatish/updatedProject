@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3 pb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">Expert Sign Up</a></li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <div class="row align-items-end">
                        <div class="col-12 text-center">
                            <h2 class="mt-2 h4">Expert Sign Up</h2>
                            <p class="text-secondary">Create your ExpertBells account</p>
                        </div>
                    </div>
                    <hr class="border-bottom border-secondary m-0 mb-4">
                    <form action="{{route('expert.saveregisteration',['step'=>'s13'])}}" method="post" class="card card-body formbox mt-3">
                        @csrf
                        <input type="hidden" name="agree">
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <div class="CustomerInfo" id="s13">
                                    <small class="num text-secondary d-block mb-3 text-center"><span class="thm">13 <i class="fal fa-long-arrow-right"></i></span> Step</small>
                                    <div class="card">
                                        <div class="card-body" style="overflow: auto;max-height: 600px;">
                                            <h5 class="text-center mb-3">Terms & Conditions</h5>
                                            @foreach ($terms as $term)                                              
                                            <div class="d-flex mb-2 border-bottom">
                                                <div class="form-check">
                                                    <input type="checkbox" name="terms[]" value="{{$term->title}}" class="form-check-input" id="tersm{{$loop->iteration}}">                                                        
                                                </div>
                                                <div class="ms-2">
                                                    <label for="tersm{{$loop->iteration}}">
                                                        <span style="font-weight: 500;">{{$loop->iteration}}. {{$term->title}}</span>
                                                    </label>
                                                    <div class="text-secondary para"> {!! $term->description !!} </div>      
                                                </div>                                              
                                            </div>
                                            @endforeach
                                        
                                        </div>
                                        <div class="card-body text-end ">
                                            <button type="button" class="btn btn-danger dsbtn btn-sm">Don`t Agree</button>
                                            <span class="disabledbox btndisabled">
                                                <button type="button" style="display: none" class="btn btn-danger dpbtn btn-sm disabled"> <i class="fad fa-spinner-third fa-spin"></i> Please wait...</button>
                                                <button type="button" class="btn btn-success sbtn btn-sm disabled">Agree</button>
                                                <button type="button" style="display: none" class="btn btn-success pbtn btn-sm disabled"> <i class="fad fa-spinner-third fa-spin"></i> Please wait...</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="{{route('expert.register',['type'=>'s12'])}}" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <p class="text-secondary w-100 m-0 mt-5 text-center mb-3">Already have an account? <a class="thm" href="{{route('login')}}"><strong>Login</strong></a></p>
                
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@push('css')
    <title>Expert Sign Up : Expert Bells</title>
    <meta name="description" content="Welcome to Expert Bells">
    <meta name="keywords" content="Welcome to Expert Bells">
    <style>
        .inner-banner+section {
            min-height: 90vh !important
        }
        .para p{
            margin-bottom: 9px;
            font-size:14px!important;
        }
        .btndisabled{
            cursor: not-allowed!important;
        }
        section.grey>div {
            z-index: 2;
            position: relative
        }

        .formbox {
            border-radius: 9px !important;
            border: none !important;
            /*box-shadow:0 5px 12px rgb(var(--blackrgb)/.1);*/
            background: none !important;
            padding: 0 !important
        }

        .formbox .row>div {
            position: relative
        }

        .CountryCode a {
            border: 1px solid #e1e1e1;
            display: flex;
            align-items: center;
            line-height: normal !important;
            background: var(--white) !important;
            padding: 9px 18px;
            border-radius: 30px 0 0 30px;
            height: 100%
        }

        .CountryCode a:after {
            font-size: 16px
        }

        .CountryCode a span {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: block;
            font-size: 16px !important;
            text-transform: uppercase
        }

        .CountryCode a span:after {
            display: none
        }

        .CountryCode span+.form-control {
            border-radius: 0 30px 30px 0 !important;
        }

        .CountryCode .CountryCode {
            max-width: 66px;
            text-align: center;
            padding: 0 !important
        }

        .CountryCode .form-control,
        .CustomerInfo .form-control,
        .CountryBox .form-control,
        .formbox>.row>div>.form-control {
            height: calc(2.5rem + 2px);
            border-radius: 0 30px 30px 0 !important;
            font-size: 16px;
            padding: 0 20px
        }

        .CountryCode .form-control:first-child,
        .CountryCode>span.d-none~.form-control,
        .CountryCode>span[style="display:none"]~.form-control,
        .CountryCode>span[style="display: none"]~.form-control,
        .CountryCode>span[style="display: none;"]~.form-control,
        .CountryCode>span[style="display:none;"]~.form-control {
            border-radius: 30px !important
        }

        .CustomerInfo .form-control,
        .CountryBox>.form-control,
        .formbox>.row>div>.form-control {
            border-radius: 30px !important
        }

        .CustomerInfo .form-control[type="file"] {
            border: none;
            background: none;
            padding: 0 !important;
            border-radius: 3px !important;
            height: calc(2.4rem + 2px);
        }

        .CustomerInfo .form-control[type="file"]::file-selector-button {
            display: none;
        }

        .CustomerInfo .VideoL {
            border-radius: 9px !important;
            cursor: pointer;
            border: none !important;
            margin: 0 9px 0 0 !important;
            font-size: 14px;
            line-height: 100%;
            height: 100%;
            padding: 8px 20px;
            background: var(--white);
            color: var(--thm4)
        }

        .CustomerInfo .form-control[type="file"]:hover::file-selector-button {
            background: rgb(var(--thmrgb)/.8)
        }

        .CountryCode .countrylist {
            padding: 0;
            max-height: 200px;
            overflow: auto;
            background: var(--white);
            right: auto !important;
            left: 0 !important
        }

        .CustomerInfo textarea.form-control {
            height: 200px;
            resize: none;
        }

        .formbtn {
            height: 50px;
            min-width: 50px !important;
            width: auto !important;
            display: flex;
            align-items: center;
            border-radius: 35px !important;
            border: 1px solid var(--thm) !important;
            font-size: 22px !important;
            color: var(--thm) !important;
            background: var(--white) !important
        }

        .formbtn.bg-thm {
            background: var(--thm) !important;
            color: var(--white) !important
        }

        .formbtn.bg-thm:hover {
            background: var(--thm1) !important;
            border-color: var(--thm) !important
        }

        .formbtn.btn-sm {
            font-size: 16px !important;
            padding: 0 15px;
            height: 32px
        }

        .otpn {
            height: 40px;
            max-width: 40px !important;
            border-radius: 9px !important;
            padding: 0 !important;
            font-size: 18px !important
        }

        .formbtn:hover {
            background: var(--thm) !important;
            color: var(--white) !important
        }

        .countrylist li {
            padding: 5px 12px;
            cursor: pointer;
            font-size: 14px;
            padding-right: 70px;
            white-space: nowrap
        }

        .countrylist li i {
            margin-right: 5px
        }

        .countrylist li span {
            font-size: 12px;
            color: rgb(var(--blackrgb)/.5);
            position: absolute;
            right: 12px
        }

        .countrylist li:hover {
            background: rgb(var(--blackrgb)/.08)
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

        .lpass~i,
        .cpass~i,
        .npass~i {
            position: absolute;
            right: 24px;
            bottom: 13px;
            opacity: 0;
            z-index: 3;
            transition: all .5s
        }

        .lpass:hover~i,
        .lpass:active~i,
        .lpass:focus~i,
        .lpass~i:hover,
        .lpass~i:active,
        .lpass~i:focus,
        .cpass:hover~i,
        .cpass:active~i,
        .cpass:focus~i,
        .cpass~i:hover,
        .cpass~i:active,
        .cpass~i:focus,
        .npass~i:hover~i,
        .npass:active~i,
        .npass:focus~i,
        .npass:hover,
        .npass~i:active,
        .npass~i:focus {
            opacity: 1
        }

        .ListBox {
            font-size: 20px;
            min-width: 180px;
            display: inline-block;
        }

        .ListBox.LBorder {
            max-height: 310px;
            overflow: auto;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid rgb(var(--blackrgb)/.2)
        }

        .ListBox .btn {
            width: 100%;
            text-align: left;
            padding: .2rem .75rem;
            font-size: 17px;
            border: 1px solid rgb(var(--thmrgb)/.5);
            background-color: rgb(var(--thmrgb)/.1);
            color: var(--thm);
        }

        .ListBox .btn:hover,
        .ListBox .btn-check:checked+.btn {
            border-color: rgb(var(--thmrgb)/.8);
            background-color: rgb(var(--thmrgb)/.2);
        }

        .ListBox .btn-check:checked+.btn {
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.42 12.12"><path d="M14,0l1.42,1.42L4.71,12.12,0,7.42,1.42,6,4.71,9.3Z"/></svg>') rgb(var(--thmrgb)/.2) right 1rem center/18px auto no-repeat;
            padding-right: 3rem
        }

        .ListBox .btn-check:checked+.btn:focus {
            box-shadow: 0 0 0 .25rem rgb(var(--thmrgb)/.4)
        }

        .AllStep {
            overflow: hidden;
            display: block
        }

        /* .AllStep{overflow:auto} */
        .AllStep::-webkit-scrollbar {
            width: 0;
            height: 0;
            background-color: rgb(var(--blackrgb)/0)
        }

        .AllStep::-webkit-scrollbar-thumb {
            background-color: rgb(var(--blackrgb)/.4);
            border-radius: 2px
        }

        .AllStep::-moz-scrollbar {
            width: 0;
            height: 0;
            background-color: rgb(var(--blackrgb)/0)
        }

        .AllStep::-moz-scrollbar-thumb {
            background-color: rgb(var(--blackrgb)/.4);
            border-radius: 2px
        }

        .AllStep::-o-scrollbar {
            width: 0;
            height: 0;
            background-color: rgb(var(--blackrgb)/0)
        }

        .AllStep::-o-scrollbar-thumb {
            background-color: rgb(var(--blackrgb)/.4);
            border-radius: 2px
        }

        .AllStep>div {
            display: none;
        }

        /* .AllStep>div:target{display:block;} */
        .AllStep>div:target {
            display: block !important
        }

        .bg-img {
            margin-top: 0 !important
        }


        .FilterDrop {
            flex: 1 1 auto;
            width: 1%;
        }

        .FilterDrop a {
            border-radius: 30px !important;
            background: var(--white);
            margin: 0 0 0 auto;
            justify-content: space-between;
            height: calc(3rem + 2px);
            border: 1px solid rgb(var(--blackrgb)/.2);
            padding: 8px 20px;
            position: relative;
            min-width: 50px;
            display: flex;
            align-items: center
        }

        .FilterDrop a {
            padding: 5px 20px
        }

        .FilterDrop a span {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            max-width: 150px
        }

        .FilterDrop a span:after {
            display: none
        }

        .FilterDrop a.show {
            box-shadow: 0 0 0 .25rem rgb(var(--thmrgb)/.25) !important;
            border: 1px solid var(--thm)
        }

        .FilterDrop a.show:before {
            position: absolute;
            content: '';
            right: 0;
            left: 0;
            margin: 0 auto;
            bottom: -17px;
            z-index: 9999;
            width: 9px;
            height: 9px;
            transform: rotate(45deg);
            background: var(--white)
        }

        .FilterDrop .dropdown-menu {
            box-shadow: 0 0 25px rgb(var(--blackrgb)/.2);
            border-color: rgb(var(--blackrgb)/.05);
            border-radius: 15px;
            margin-top: 9px !important;
            min-width: 350px;
            max-height: 300px;
            overflow: auto
        }

        .FilterDrop {
            margin: 0 9px 9px 0
        }

        .FilterDrop .dropdown-menu input.SearchBox {
            height: 40px;
            font-size: 16px;
            max-width: 400px;
            background-color: rgb(var(--thmrgb)/.05)
        }

        .FilterDrop .dropdown-menu>ul {
            -webkit-column-count: 2;
            -moz-column-count: 2;
            column-count: 2;
            grid-column-gap: 20px;
            -webkit-column-gap: 20px;
            -moz-column-gap: 20px;
            column-gap: 20px;
            padding: 0;
            margin: 0;
        }

        .FilterDrop .dropdown-menu>ul.AllCat {
            -webkit-column-count: 3;
            -moz-column-count: 3;
            column-count: 3;
        }

        .FilterDrop .dropdown-menu>ul.AllCat>li {
            display: inline-block;
            margin: 0 0 20px;
        }

        .FilterDrop .dropdown-menu>ul.AllCat ul {
            margin: 0;
            padding: 0;
        }

        .FilterDrop .dropdown-menu>ul.AllCat h3 {
            font-size: 18px !important;
            font-weight: 600
        }

        /*.FilterDrop .dropdown-menu ul:first-child{margin-top:6rem!important}*/
        .Exptext {
            display: -webkit-box;
            overflow: hidden;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1
        }

        @media only screen and (max-width:767px) {
            .FilterDrop .dropdown-menu ul {
                -webkit-column-count: 1;
                -moz-column-count: 1;
                column-count: 1;
                grid-column-gap: 0;
                -webkit-column-gap: 1;
                -moz-column-gap: 1;
                column-gap: 1;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between
            }
        }

        .SelectExperts .dropdown-menu li,
        .FilterDrop .dropdown-menu li {
            padding: 3px 20px;
            margin-bottom: 1px;
            cursor: pointer;
            white-space: nowrap
        }

        .FilterDrop .dropdown-menu li {
            padding: 3px 0
        }

        .FilterDrop .dropdown-toggle.selected {
            background: rgb(var(--thmrgb)/.1);
            border: 1px solid rgb(var(--thmrgb)/.25)
        }

        .FilterDrop .dropdown-toggle span:before {
            content: '\2022';
            padding: 0 6px;
            font-size: 9px
        }

        .FilterDrop .dropdown-toggle span:empty:before {
            display: none
        }
    </style>
@endpush
@push('js')
    <script>
        $(".form-check-input").click(function(){
            var arr = [];
            $.each($(".form-check-input:checked"), function(){
                  arr.push($(this).val());
            });
            if(arr.length==$(".form-check-input").length){ 
                $('.sbtn').removeClass('disabled');                 
                $('.disabledbox').removeClass('btndisabled');
            }else{ 
                $('.sbtn').addClass('disabled'); 
                $('.disabledbox').addClass('btndisabled');
            }
        });
        // formbox
        $('.sbtn').on('click',function(){ 
            $('input[name=agree]').val(1); 
            $('.pbtn').show();
            $('.sbtn').hide();
            $('.formbox').submit(); 
        });
        $('.dsbtn').on('click',function(){ 
            $('input[name=agree]').val(0); 
            $('.dpbtn').show();
            $('.dsbtn').hide();
            $('.formbox').submit(); 
        });
    </script>
@endpush