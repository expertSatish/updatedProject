@if (count($errors) > 0)

@foreach ($errors->all() as $error)
{!! Helper::ErrorAlert($error) !!}
@endforeach
@endif