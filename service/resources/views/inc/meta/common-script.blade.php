@php
$title = '';
$description ='';
if(!empty($meta->meta_title)){ $title= $meta->meta_title; }
if(!empty($taxes->meta_title)){ $title= $taxes->meta_title; }
if(!empty($detail->meta_title)){ $title= $detail->meta_title; }

if(!empty($meta->meta_description)){ $description= $meta->meta_description; }
if(!empty($taxes->meta_description)){ $description= $taxes->meta_description; }
if(!empty($detail->meta_description)){ $description= $detail->meta_description; }

@endphp
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "{{$title}}",
        "url": " {{ url()->current()}}",
        "logo": "https://www.expertbells.com/resources/assets/uploads/logo/2021-04-293380404.png",
        "image": "https://www.expertbells.com/resources/assets/uploads/logo/2021-04-293380404.png",
        "description": "{{$description}}",
        "telephone": "(+91) 7438-99-7438",
        "pricerange": "$$$",
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "26.843040316346208째 N",
            "longitude": "75.82657705850237째 E"
        },
        "author": {
          "@type": "Person",
          "name": "Fred Benson"
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "5.0",
            "bestRating": "5",
            "ratingCount": "1200"
        },
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Rajasthan",
            "addressRegion": "RJ",
            "streetAddress": "369 Model Town, Vinoba Bihar, Jaipur, Rajasthan",
            "postalCode": "302017"
        },
        "openingHours": [
            "Mon-Sat 00:00AM - 23:59PM"
        ]
    }
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "url": "https://www.expertbells.com",
        "logo": "https://www.expertbells.com/resources/assets/frontend/images/logo.png",
        "contactPoint": [{
            "@type": "ContactPoint",
            "telephone": "+91 9968-353-570",
            "contactType": "customer service"
        }]
    }
</script>




<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "url": "https://www.expertbells.com",
        "logo": "https://www.expertbells.com/resources/assets/frontend/images/logo.png"
    }
</script>

@php
$first = Request::segment(1);
$second = Request::segment(2);
$third = Request::segment(3);
$current_url=url()->current();

@endphp

<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "BreadcrumbList",
        "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{url('/')}}"
            }
            @if($first !== null && $first!='service'),{
                "@type": "ListItem",
                "position": 2,
                "name": "{{$first}}",
                "item": "{{url($first)}}"
            }
            @endif
            @if($second !== null && $first!='service'),{
                "@type": "ListItem",
                "position": 3,
                "name": "{{$second}}",
                "item": "{{url($first.'/'.$second)}}"
            }
            @endif
             @if($second !== null && $first=='service'),{
                "@type": "ListItem",
                "position": 2,
                "name": "{{$second}}",
                "item": "{{url($first.'/'.$second)}}"
            }
            @endif
        ]
    }
</script>