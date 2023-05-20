<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
<!-- Global site tag (gtag.js) - Google Ads: 648055073 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-648055073"></script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11161335248"></script>



@if(Request::segment(1)=='thank-you')
<script>
  gtag('event', 'conversion', {'send_to': 'AW-648055073/XWBZCI3K5fQBEKGSgrUC'});
</script>
@endif
@php
$setting=DB::table('setting')->where('id',1)->first();
@endphp
@include('inc.meta.top-head-meta')
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1, minimum-scale=.5, maximum-scale=5">
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
@if(Request::segment(1)!='signup' && Request::segment(1)!='login' && Request::segment(1)!='blog-detail')
@include('inc.meta.common-meta')
@endif
<link rel="icon" href="{{asset('resources/assets/frontend/images/favicon.png')}}" type="image/x-icon">
<link rel="apple-touch-icon" href="{{asset('resources/assets/frontend/images/favicon.png')}}">
<meta name="theme-color" content="#f3a430">
<!-- Materialize CSS -->
<link rel="stylesheet" href="{{asset('resources/assets/frontend/css/materialize.css')}}">
<!-- Main CSS -->
<link rel="stylesheet" href="{{asset('resources/assets/frontend/css/style.css')}}">
<meta name="google-site-verification" content="zj0HyuRNaYuzji2GPAjDJdz0EcIKu8T0VlQk_2bJBZc" />


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="//www.expertbells.com">
<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="//code.jquery.com">
<link rel="dns-prefetch" href="//www.googletagmanager.com">
<link rel="dns-prefetch" href="//cdn.ampproject.org">
<link rel="dns-prefetch" href="//www.google-analytics.com">
<link rel="dns-prefetch" href="//stats.g.doubleclick.net">
<link rel="dns-prefetch" href="//www.google.com">
<link rel="dns-prefetch" href="//googleads.g.doubleclick.net">
<style type="text/css">.CartCount{position:absolute;border-radius:50%;height:16px;width:16px;display:flex;justify-content:center;align-items:center;background:#611f69;top:24%;font-size:9px;right:-2px;color:#fff;transition:all .5s}</style>
<script>function goBack() {window.history.back();}</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11161335248"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11161335248');
</script>

<!-- Event snippet for Click on Phone Number Button on Website conversion page
In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
<script>
function gtag_report_conversion(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = 'https://www.expertbells.com/service/';
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-11161335248/e5TBCIzbi_4DENDrkcop',
      'event_callback': callback
  });
  return false;
}
</script>

</head>

<body class="scrollspy" id="top" oncontextmenu="return false">
@include('inc.meta.top-body-meta')
    <main>
        <!-- Header -->
        <header>
            <div class="HeadTop">
                <div class="container">
                    <div class="row">
                        <div class="col s12 l2">&nbsp;</div>
                        <div class="col s12 l8">
                            <ul class="m0">
                                <li><i class="icofont-phone"></i> <a href="tel:+917438-99-7438">(+91) 7438-99-7438</a>
                                </li>
                                <li><i class="icofont-email"></i> <a href="mailto:info@expertbells.com">info@expertbells.com</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col s12 l2">
                            <ul class="m0">
                                @if(empty(Auth::user()->email))
                                <li><a title="Home" <?php if ($active == 'Sign Up') echo "class='hover'"; ?> href="{!! url('signup') !!}">Sign Up</a></li>
                                <li><a title="About Us" <?php if ($active == 'login') echo "class='hover'"; ?> href="{!! url('login') !!}">Login</a></li>
                                @else


                                <li class="dropdown cusdd d-flex align-items-center">
                                    <a href="{{url('my-account')}}" class="signup" style="margin-right:5px;">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>
                                    <div class="dropdown-menu">
                                        <div>
                                            <a class="hidemob" href="{{ url('/logout') }}" onClick="event.preventDefault();  document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Logout </a>
                                        </div>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu-main">
                <nav role="navigation" class="pushpin-demo-nav pin-top" data-target="menu">
                    <div class="MobileTop">
                        <div class="container">
                            <div class="row">
                                <div class="col m1 s2"><a href="#" data-target="nav-mobile" title="Expert Bells Mobile Menu" class="sidenav-trigger m-menu"><i class="fa fa-bars"></i></a></div>
                                <div class="col m7 s6"><a href="{{url('/')}}" class="brand-logo"><img class="sticky-logo" loading="lazy" src="{{asset('resources/assets/frontend/images/logo-w-mobile.svg .png')}}" alt="{{$setting->site_name}}" width="180" height="100%"></a></div>
                                <div class="col s4 right-align">
                                    <!-- <a href="#" data-target="contact-no" class="sidenav-trigger"><i class="fa fa-phone"></i></a> -->
                                    @if(empty(Auth::user()->email))
                                    <!-- <a title="Sign Up'" class="sidenav-trigger" <?php if ($active == 'Sign Up') echo "class='hover'"; ?> href="{!! url('signup') !!}">Sign Up</a> -->
                                    <a title="Login" class="sidenav-trigger mcolor1" <?php if ($active == 'login') echo "class='hover'"; ?> href="{!! url('login') !!}">Login</a>
                                    @else
                                    <a href="{{url('my-account')}}" class="sidenav-trigger"><i class="icofont-business-man"></i></a>
                                    <a class="sidenav-trigger" href="{{ url('/logout') }}" onClick="event.preventDefault();  document.getElementById('logout-form').submit();"><i class="icofont-power"></i></a>
                                    @endif
                                    <a href="{{ url('cart-detail') }}" class="sidenav-trigger"><i class="icofont-cart-alt"></i><span class="CartCount">{!! Cart::count() !!}</span></a>
                                </div>
                            </div>
                        </div>
                        <div id="nav-mobile" class="sidenav">
                            <div class="sidenavTop">
                                <div class="row valign-wrapper">
                                    <div class="col s8"><a href="{{url('/')}}" class="brand-logo">
                                        <!-- <img class="sticky-logo" loading="lazy" src="{{asset('/resources/assets/uploads/logo/'.$setting->site_logo)}}" width="180" height="47" alt="{{$setting->site_name}}"> -->
                                        <img class="sticky-logo" loading="lazy" src="{{asset('resources/assets/frontend/images/logo-w-mobile.svg .png')}}" alt="{{$setting->site_name}}" width="180" height="100%">
                                    </a></div>
                                    <div class="col s4 right-align lh0"><a class="CMenu"><i class="icofont-arrow-right white-text"></i></a></div>
                                </div>
                            </div>
                            <ul class="m0">
                                <!-- <li><a title="Start Business" <?php if ($active == 'Start Business') echo "class='hover'"; ?> href=" service.php">Start Business</a></li>
                                <li><a title="Registration & License" <?php if ($active == 'Registration & License') echo "class='hover'"; ?> href=" service.php">Registration & License</a></li>
                                <li><a title="Tax & Compliance" <?php if ($active == 'Tax & Compliance') echo "class='hover'"; ?> href=" service.php">Tax & Compliance</a></li>
                                <li><a title="Trademark & Copyright" <?php if ($active == 'Trademark & Copyright') echo "class='hover'"; ?> href=" service.php">Trademark & Copyright</a></li>
                                <li><a title="E-Commerce" <?php if ($active == 'E-Commerce') echo "class='hover'"; ?> href="service.php">E-Commerce</a></li>
                                <li><a title="Contact Us" <?php if ($active == 'Contact Us') echo "class='hover'"; ?> href="contact-us.php">Contact Us</a></li> -->
                                @php
                                $Level1 = DB::table('nav_category')->where(['parent'=>0,'level'=>1,'status'=>1])->get();
                                @endphp
                                @foreach($Level1 as $i)
                                @php
                                $asd = DB::table('nav_category')->where(['parent'=>$i->id,'status'=>1,'menu_status'=>1])->count();
                                @endphp
                                @if($asd!=0)
                                <li><a title="{{$i->title}}" class="dropdown-trigger" href="#" data-target="m{{$i->id}}">{{$i->title}} <i class="icofont-thin-down right"></i></a>
                                    <div id="m{{$i->id}}" class="dropdown-content full-width">
                                        <div class="row">
                                            @php
                                            $Level2 = DB::table('nav_category')->where(['parent'=>$i->id,'status'=>1,'level'=>2,'menu_status'=>1])->get();
                                            @endphp
                                            @foreach($Level2 as $j)
                                            <div class="col m12 l6">
                                                <h6>{{$j->title}}</h6>
                                                <ul class="float-none w100">
                                                    @php
                                                    $Level3 = DB::table('nav_category')->where(['parent'=>$j->id,'status'=>1,'level'=>3,'menu_status'=>1])->get();
                                                    @endphp
                                                    @foreach($Level3 as $k)
                                                    <li><a href="{{route('service',$k->alias)}}" title="{{$k->title}}">{{$k->title}}</a></li>
                                                    @endforeach

                                                </ul>

                                            </div>
                                            @endforeach

                                        </div>
                                    </div>

                                </li>
                                @else
                                <li><a title="{{$i->title}}" href="{{route('service',$i->alias)}}">{{$i->title}}</a></li>
                                @endif
                                @endforeach

                                <!-- <li><a title="Tax &amp; Compliance" href=" service.php">Tax &amp; Compliance</a></li>
                                    <li><a title="Trademark &amp; Copyright" href=" service.php">Trademark &amp; Copyright</a></li>
                                    <li><a title="E-Commerce" href=" service.php">E-Commerce</a></li> -->
                                <li><a title="Contact Us" href="{{url('/contact-us')}}">Contact Us</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="container hide-on-med-and-down">
                        <div class="nav-wrapper row valign-wrapper">
                            <div class="col s12 l2">
                                <div class="brand-logo logo t-hidd m-hidd">
                                    <!-- <a href="{{url('/')}}"><img loading="lazy" src="{{asset('/resources/assets/uploads/logo/'.$setting->site_logo)}}" width="180" height="47" alt="{{$setting->site_name}}"></a> -->
                                    <a href="{{url('/')}}"><img loading="lazy" src="{{asset('resources/assets/frontend/images/Frame 1.png')}}" width="180" height="47" alt="{{$setting->site_name}}"></a>
                                </div>
                            </div>
                            <div class="col s12 l9">
                                <ul class="hide-on-med-and-down">
                                    <!-- <li><a title="Home" class='hover' href="index.php">Home</a></li> -->

                                    @php
                                    $Level1 = DB::table('nav_category')->where(['parent'=>0,'level'=>1,'status'=>1,'menu_status'=>1])->get();
                                    @endphp
                                    @foreach($Level1 as $i)
                                    @php
                                    $asd = DB::table('nav_category')->where(['parent'=>$i->id,'status'=>1])->count();
                                    @endphp
                                    @if($asd!=0)


                                    <li><a title="{{$i->title}}" class="menu-dropdown " href="#" data-target="{{$i->id}}">{{$i->title}} <i class="icofont-thin-down right"></i></a>
                                        <div id="{{$i->id}}" class="dropdown-content full-width">
                                            <div class="row">
                                                @php
                                                $Level2 = DB::table('nav_category')->where(['parent'=>$i->id,'status'=>1,'level'=>2,'menu_status'=>1])->get();
                                                @endphp
                                                @foreach($Level2 as $j)
                                                <div class="col s6 m6">
                                                    <h6>{{$j->title}}</h6>
                                                    <ul class="float-none w100">
                                                        @php
                                                        $Level3 = DB::table('nav_category')->where(['parent'=>$j->id,'status'=>1,'level'=>3,'menu_status'=>1])->get();
                                                        @endphp
                                                        @foreach($Level3 as $k)
                                                        <li><a href="{{route('service',$k->alias)}}" title="{{$k->title}}">{{$k->title}}</a></li>
                                                        @endforeach

                                                    </ul>

                                                </div>
                                                @endforeach

                                            </div>
                                        </div>

                                    </li>
                                    @else
                                    <li><a title="{{$i->title}}" href="{{route('service',$i->alias)}}">{{$i->title}}</a></li>
                                    @endif
                                    @endforeach

                                    <!-- <li><a title="Tax &amp; Compliance" href=" service.php">Tax &amp; Compliance</a></li>
                                    <li><a title="Trademark &amp; Copyright" href=" service.php">Trademark &amp; Copyright</a></li>
                                    <li><a title="E-Commerce" href=" service.php">E-Commerce</a></li> -->
                                    <li><a title="Contact Us" href="{{url('/contact-us')}}">Contact Us</a></li>
                                </ul>
                            </div>
                            <div class="col s12 l1">
                                <ul class="cart">
                                    <li><a href="{{ url('cart-detail') }}"><img loading="lazy" src="{{asset('resources/assets/frontend/images/top-icon5.webp')}}" alt="Cart" width="25" height="25"><span class="CartCount">{!! Cart::count() !!}</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <div id="menu" class="block sticky">
        <!-- Banner Section -->