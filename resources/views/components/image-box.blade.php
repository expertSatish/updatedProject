@if (in_array(checkimagetype($image), ['SVG','AVIF']) && file_exists(public_path($path . $image)))
    <img loading="lazy" src="{{ asset($path . $image) }}" class="{{$class ?? ''}}" id="{{ $id ?? '' }}" alt="{{ $alt }}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
    <div loading="lazy" style="background:url('{{ asset($path . $image) }}')"></div>
@elseif (in_array(checkimagetype($image), ['WEBP']) && file_exists(public_path($path . $image)))
    <picture class="{{$pictureclass ?? ''}}">
        <img loading="lazy" src="{{ asset($path . $image) }}" class="{{$class ?? ''}}" id="{{ $id ?? '' }}" alt="{{ $alt }}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
    </picture>
    <div loading="lazy" style="background:url('{{ asset($path . $image) }}')"></div>
@elseif(file_exists(public_path($path . $image . '.webp')))
    <picture class="{{$pictureclass ?? ''}}">
        <source srcset="{{ asset($path . $image . '.webp') }}" type="image/webp">
        <img loading="lazy" src="{{ asset($path . 'jpg/'. $image . '.jpg') }}" id="{{ $id ?? '' }}" class="{{$class ?? ''}}" alt="{{$alt ?? ''}}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
    </picture>
    <div loading="lazy" style="background:url('{{ asset($path . $image . '.webp') }}')"></div>
@elseif(file_exists(public_path($path . 'jpg/' . $image . '.jpg')))
    <picture class="{{$pictureclass ?? ''}}">
        <source srcset="{{ asset($path . $image . '.webp') }}" type="image/webp">
        <img loading="lazy" src="{{ asset($path . 'jpg/'. $image . '.jpg') }}" id="{{ $id ?? '' }}" class="{{$class ?? ''}}" alt="{{$alt ?? ''}}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
    </picture>
    <div loading="lazy" style="background:url('{{ asset($path . $image . '.webp') }}')"></div>
@else
    <picture>
        <source srcset="{{ asset('frontend/image/no-img.webp') }}" type="image/webp">
        <img loading="lazy" src="{{ asset('frontend/image/no-img.jpg') }}" id="{{ $id ?? '' }}" class="{{$class ?? ''}}" alt="{{$alt ?? ''}}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
    </picture>
    <div loading="lazy" style="background:url('{{ asset('frontend/image/no-img.webp') }}')"></div>
@endif