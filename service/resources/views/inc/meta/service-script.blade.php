<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "AccountingService",
        "name": "{{$meta->title}}",
        "image": "{{asset('resources/assets/uploads/banner/'.$meta->banner_image)}}",
        "@id": "https://www.expertbells.com/#logo",
        "url": "https://www.expertbells.com",
        "telephone": "(+91) 7438-99-7438",
        "priceRange": "$$$",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "369 Model Town, Vinoba Bihar, Jaipur, Rajasthan",
            "addressLocality": "Rajasthan",
            "postalCode": "302017",
            "addressCountry": "IN"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "26.843040316346208° N",
            "longitude": "75.82657705850237° E"
        },
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
                "Sunday"
            ],
            "opens": "00:00",
            "closes": "23:59"
        },
        "sameAs": [
            "https://www.facebook.com/expertbells/",
            "https://twitter.com/expertbells",
            "https://www.instagram.com/expertbells/",
            "https://www.linkedin.com/company/expertbells/",
            "https://in.pinterest.com/expertbells/",
            "https://www.expertbells.com"
        ]
    }
</script>


@if(count($faqs)>0)
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            <?php
            $sequence = count($faqs) - 2;
            ?>
            @foreach($faqs as $key => $i) {
                "@type": "Question",
                "name": "{{$i->title}}",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "{{ $i->text }}"
                }
            }@if($key <= $sequence), @endif
            
            @endforeach
        ]
    }
</script>
@endif