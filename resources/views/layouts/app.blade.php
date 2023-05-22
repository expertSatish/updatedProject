<!DOCTYPE html>
<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1">
<link rel="icon" href="{{asset('frontend/img/favicon.ico')}}" type="image/x-icon">
<link rel="apple-touch-icon" href="{{asset('frontend/img/favicon.ico')}}">
<!-- <link rel="manifest" href="manifest.json"> -->
<meta name="theme-color" content="#0c233b">
<!-- Bootstrap CSS -->
<!-- <link rel="preload" as="style" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" onload="this.rel='stylesheet'" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
<link rel="preload" as="style" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" onload="this.rel='stylesheet'" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- Main CSS -->
@stack('css')
<x-seo-common/>
<link rel="stylesheet" href="{{asset('frontend/css/main-style.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
<link rel="dns-prefetch" href="https://fonts.googleapis.com">
<link rel="dns-prefetch" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="//www.expertbells.com">
<link rel="dns-prefetch" href="//cdn.jsdelivr.net">
<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="//pro.fontawesome.com">
<link rel="dns-prefetch" href="//code.jquery.com">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>.error{font-size:13px;color:#ea6b6b}
.searchboxdata{background:var(--white)}
.searchboxdata li{border-top:1px solid rgb(var(--blackrgb)/.1)!important;list-style:none;margin:0;padding:4px 9px;display:block}
.searchboxdata li img{height:36px!important;width:36px!important;border-radius:50%!important;filter:inherit!important;object-fit:contain}
.searchboxdata li:first-child{border:none}
.searchboxdata li:hover{background:rgb(var(--blackrgb)/.08)}
.searchboxdata li:hover a{background:none!important}
.searchboxdata li a{padding:0!important;color:var(--black)!important;display:block;font-size:13px!important}
.searchboxdata li a.img div{width:calc(100% - 45px)}
.searchboxdata li a span,.searchboxdata li a small{display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:1;line-height:150%}
.searchboxdata li a small{color:rgb(var(--blackrgb)/.7)}
</style>
<!-- Google Tag Manager -->

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    
    })(window,document,'script','dataLayer','GTM-P4XMV6K');</script>
    
    <!-- End Google Tag Manager -->
</head>
<body id="app">
    <!-- Google Tag Manager (noscript) -->

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P4XMV6K"

    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    
    <!-- End Google Tag Manager (noscript) -->
    <x-nav/> 
    @yield('content')    
    <x-footer/>
    <script>
        $('input[name=searchlist]').on('keyup',function(e){
            let search = e.target.value;
            $('.searchboxdata').html('');
            if(search!=''){
                $('.searchboxdata').html('<ul><li class="text-center"><i class="fad fa-spinner-third fa-spin" style="font-size: 25px;"></i></li></ul>'); 
                $.ajax({
                    url:@json(route('autosearch')),
                    data:{search:search},
                    method:'GET',
                    dataType:'Json',
                    success:function(success){
                        $('.searchboxdata').html(success.html);
                    }
                });
            }            
        });
    </script>
</body>
</html>