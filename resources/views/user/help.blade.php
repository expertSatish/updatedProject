@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">Help Center</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-user.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <h3 class="text-center mb-4">How can we help you?</h3>
                    <div class="row pb-1">
                        <form action="" class="col-lg-7 col-md-8 d-flex">@csrf
                            <input type="search" class="form-control SearchBox" value="{{old('search',$_GET['search'] ?? '')}}" name="search" placeholder="Search Your Questions">
                            <button class="btn btn-thm2 m-0 ms-1"><i class="fas fa-search m-0"></i></button>
                            <a href="{{url()->current()}}" class="btn btn-thm2 m-0 ms-1"><i class="fas fa-sync-alt m-0"></i></a>
                        </form>
                        <div class="col-lg-5 col-md-4 mt-3 m-md-0 text-md-end text-center"><a href="#PostQuery" data-bs-toggle="modal" class="btn btn-thm2 m-0 h-100"><i class="fal fa-user-headset m-0 me-2"></i> Post Query</a></div>
                    </div>
                    <div class="accordion accordion-flush Faqs mt-4 border" id="Faqs">
                        @if($lists->count()==0) 
                        <x-data-not-found data="Questions"/> 
                        <p class="text-center"><small>{{strtoupper('if you have a any query then you post your query and we contact you soon as soon.')}}</small></p>
                        
                        @endif
                        @foreach ($lists as $item)
                        <div class="accordion-item">
                            <div class="accordion-header" id="Pay1">
                                <button class="accordion-button {{$loop->iteration>1?'collapsed':''}}" type="button" data-bs-toggle="collapse" data-bs-target="#Faqs{{$loop->iteration}}" aria-expanded="{{$loop->iteration==1?true:false}}" aria-controls="Faqs1">{{$item->title ?? ''}}</button>
                            </div>
                            <div id="Faqs{{$loop->iteration}}" class="accordion-collapse collapse {{$loop->iteration==1?'show':''}}" aria-labelledby="Pay1" data-bs-parent="#Faqs">
                                <div class="accordion-body">{!! $item->description !!}</div>
                            </div>
                        </div>
                        @endforeach                         
                    </div>
                    {{$lists->links()}}
                </div>
            </div>
        </div>
    </section>
</main>  
<div class="modal fade" id="PostQuery" data-bs-keyboard="false" tabindex="-1" aria-labelledby="PostQueryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form class="modal-content helpqueryform">
            @csrf
            <input type="hidden" name="type" value="user">
            <input type="hidden" name="type_id" value="{{userinfo()->id}}">
            <div class="modal-header">
                <h2 class="h5 modal-title" id="PostQueryLabel">Post Your Query</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-3 p-4">
                <div class="mb-3">
                    <label class="ms-2"><small>Your Query</small></label>
                    <textarea class="form-control summernote" name="description"></textarea>
                    <span class="error query-error"></span>
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-thm2 sbtn">Send Query</button>
                    <button type="button" disabled class="btn btn-thm2 pbtn" style="display: none"><i class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('css')
<title>Help Center : {{project()}}</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<link rel="stylesheet" href="{{asset('frontend/css/account.css')}}">
<style type="text/css">
input.SearchBox{padding-left:44px;height:48px;font-size:18px;background:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 429.69 395.22" opacity=".5"><path d="M425.49,377.67,294.3,257.76a162.73,162.73,0,1,0-12,14.72S402,381.82,412.7,391.66,435.76,387,425.49,377.67ZM162.55,305A142.41,142.41,0,1,1,305,162.55,142.41,142.41,0,0,1,162.55,305Z"/></svg>') no-repeat 15px center/20px auto var(--white);margin-bottom:9px;border-radius:30px;border:none;box-shadow:0 9px 20px -8px rgb(var(--blackrgb)/.3)!important;max-width:600px;width:100%;margin:0;transition:all .5s}
input.SearchBox:focus{box-shadow:0 9px 20px -8px rgb(var(--blackrgb)/.6)!important}
#PostQuery .form-control{border-radius:1.5rem;padding:.6rem .75rem;font-size:15px}
#PostQuery textarea.form-control{height:99px;resize:none}
@media (max-width:575px){.btn-thm2{padding:0 15px!important}
input.SearchBox{font-size:16px;height:42px}}
</style>
@endpush
@push('js')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        setTimeout(() => {
            $('.summernote').summernote({
                height: 100,
                toolbar: []
            });
        }, 1000);
        $('.helpqueryform').on('submit',function(e){
            e.preventDefault();
            $('.sbtn').hide();
            $('.pbtn').show();
            $('.error').html('');
            $.ajax({
                data:new FormData(this),
                url:@json(route('posthelpquery')),
                method:'POST',
                dataType:'Json',
                cache:false,
                contentType:false,
                processData:false,
                success:function(data){
                    $('#PostQuery').modal('hide');
                    toastr.success(data.success);
                    $('.helpqueryform').trigger('reset');
                    $('.summernote').summernote('reset');
                },
                error:function(response){            
                    if(response.responseJSON.errors.description!== undefined){
                        $('.query-error').text(response.responseJSON.errors.description);
                    } 
                    $('.sbtn').show();
                    $('.pbtn').hide(); 
                }
            });
        });
    </script>
@endpush