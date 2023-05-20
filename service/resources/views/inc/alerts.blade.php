@if (count($errors) > 0)

@foreach ($errors->all() as $error)
<!--<h1>{{$error}}</h1>-->
<script>
    toastr.error('{{ $error }}');
</script>
@endforeach
@endif