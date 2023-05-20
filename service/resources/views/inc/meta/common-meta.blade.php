<!-- Canonical Tag-->
<link rel='canonical' href='{{url()->current()}}'>
<!-- Pinterest Verification -->
<meta name="p:domain_verify" content="0ce43e209853135ecea7648042e076fe" />

<meta id="subject" name="subject" content="@if(!empty($meta->meta_title)) {!! $meta->meta_title !!} @endif">


<meta id="language" name="language" content="en">
<meta id="document-type" name="document-type" content="public">
<meta id="Copyright" name="Copyright" content="Copyright 2021 ExpertBells">
<meta id="distribution" name="distribution" content="Global">
<meta id="robots" name="robots" content="INDEX,FOLLOW">
<meta id="audience" name="audience" content="All, Business">
<meta id="googlebot" name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
<meta id="bingbot" name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
<meta id="dc.language" name="dc.language" content="IN" />
<meta id="country" name="country" content="India" />
<meta id="city" name="city" content="Delhi, India">
<meta id="email" name="reply-to" content="expertbellsconsulting@gmail.com" />
<meta name="allow-search" content="yes" />
<meta name="revisit-after" content="daily" />
<meta name="distribution" content="global" />
<meta name="Rating" content="General" />
<meta name="coverage" content="Worldwide">
<meta name="expires" content="never" />
<meta name="dc.source" CONTENT="https://www.facebook.com/expertbells/" />
<meta name="dcterms.rightsHolder" content="ExpertBells">

<meta property="article:author" content="https://www.facebook.com/expertbells/" />
<meta property="article:publisher" content="https://www.facebook.com/expertbells/" />



@if(Request::segment(1)!='blog')

<!-- Twitter Summary Card -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@expertbells" />
<meta name="twitter:creator" content="@expertbells" />
<meta name="twitter:title" content="@if(!empty($meta->meta_title)) {!! $meta->meta_title !!} @endif" />
<meta name="twitter:description" content="@if(!empty($meta->meta_description)) {!! $meta->meta_description !!} @endif" />
<!-- <meta name="twitter:image" content="{{asset('resources/assets/uploads/logo/'.$setting->site_logo)}}" /> -->
<meta name="twitter:image" content="{{asset('resources/assets/frontend/images/og-logo.png')}}">
<meta property="twitter:image:alt" content="ExpertBells">

<!----------Og graph-------------->
<meta property="og:locale" content="en_US">
<meta property="og:locale" content="en_US" />
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:type" content="website">
<meta property="og:title" content="@if(!empty($meta->meta_title)) {!! $meta->meta_title !!} @endif">
<meta property="og:description" content="@if(!empty($meta->meta_description)) {!! $meta->meta_description !!} @endif">
<!-- <meta property="og:image" content="{{asset('resources/assets/uploads/logo/'.$setting->site_logo)}}"> -->
<meta property="og:image" content="{{asset('resources/assets/frontend/images/og-logo.png')}}">
<meta property="og:image:alt" content="@if(!empty($meta->meta_title)) {!! $meta->meta_title !!} @endif" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="400" />
<meta property="og:image:height" content="300" />
<meta property="og:site_name" content="ExpertBells">

@endif