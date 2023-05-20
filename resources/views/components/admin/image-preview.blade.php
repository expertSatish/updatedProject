@if (in_array(checkimagetype($image), ['SVG','AVIF']) && file_exists(public_path($path . $image)))
    <img loading="lazy" src="{{ asset($path . $image) }}" class="{{$class ?? ''}}" id="{{ $id ?? '' }}" alt="{{ $alt }}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
@elseif (in_array(checkimagetype($image), ['WEBP']) && file_exists(public_path($path . $image)))
    <picture class="{{$pictureclass ?? ''}}">
        <img loading="lazy" src="{{ asset($path . $image) }}" class="{{$class ?? ''}}" id="{{ $id ?? '' }}" alt="{{ $alt }}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
    </picture>
@elseif(file_exists(public_path($path . $image . '.webp')))
    <picture class="{{$pictureclass ?? ''}}">
        <source srcset="{{ asset($path . $image . '.webp') }}" type="image/webp">
        <img loading="lazy" src="{{ asset($path . 'jpg/'. $image . '.jpg') }}" id="{{ $id ?? '' }}" class="{{$class ?? ''}}" alt="{{$alt ?? ''}}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
    </picture>
@elseif(file_exists(public_path($path . 'jpg/' . $image . '.jpg')))
    <picture class="{{$pictureclass ?? ''}}">
        <source srcset="{{ asset($path . $image . '.webp') }}" type="image/webp">
        <img loading="lazy" src="{{ asset($path . 'jpg/'. $image . '.jpg') }}" id="{{ $id ?? '' }}" class="{{$class ?? ''}}" alt="{{$alt ?? ''}}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
    </picture>
@else
    <img loading="lazy" src="{{ asset('admin/img/img12.jpg') }}" id="{{ $id ?? '' }}" class="{{$class ?? ''}}" alt="{{$alt ?? ''}}" width="{{$width ?? ''}}" height="{{$height ?? ''}}">
@endif