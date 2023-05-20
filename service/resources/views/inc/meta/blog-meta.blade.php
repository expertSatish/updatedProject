<!-- Only Blog Page -->

<!-- Twitter card -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@expertbells" />
<meta name="twitter:creator" content="@expertbells" />
<meta name="twitter:label1" content="Written by">
<meta name="twitter:data1" content="ExpertBells">
<meta name="twitter:title" content="@if($meta->meta_title) {!! $meta->meta_title !!} @endif" />
<meta name="twitter:description" content="@if($meta->meta_description) {!! $meta->meta_description !!} @endif" />
<meta name="twitter:image" content="{{asset('resources/assets/uploads/cms/'.$meta->text_4)}}" />
<meta property="twitter:image:alt" content="{{$meta->text_4}}">
<meta name="twitter:label2" content="Est. reading time">
<meta name="twitter:data2" content="11 minutes">


<!-- OG (Open Graph)-->


<meta property="og:locale" content="en_US" />
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:type" content="website">
<meta property="og:title" content="@if($meta->meta_title) {!! $meta->meta_title !!} @endif">
<meta property="og:description" content="@if($meta->meta_description) {!! $meta->meta_description !!} @endif">
<meta property="og:image" content="{{asset('resources/assets/uploads/cms/'.$meta->text_4)}}">
<meta property="og:image:alt" content="{{$meta->text_4}}" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="400" />
<meta property="og:image:height" content="300" />
<meta property="og:site_name" content="ExpertBells">