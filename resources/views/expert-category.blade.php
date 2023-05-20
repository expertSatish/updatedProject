@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner">
        <div class="section">
            <div class="bg-white"></div>
        </div>
    </section>
    <section class="pt-3 bg-white">
        <form class="container filterform">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">{{$category->title ?? ''}} Experts</a></li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-7">
                    <h2 class="Heading h2">Choose an expert. <span>Book a meeting on video call.</span></h2>
                </div>
                <div class="col-lg-4 col-md-5 text-end">
                    {{-- <input type="text" class="form-control SearchBox" name="search"
                        placeholder="Search by name or keyword"> --}}
                </div>
            </div>
            <div class="row Filter">
                <div class="col-12">
                    <ul class="m-0 p-0 Cats">
                        @foreach ($category->expertise as $exp)
                        <li><a href="{{route('expertcategory',$category->alias)}}/{{$exp->alias??''}}" class="rounded-3 d-block p-2 px-4 {{$exp->alias==Request::segment(2)?'active':''}}">{{ $exp->title ?? '' }}</a></li>
                        @endforeach
                </div>
                <div class="col-12">
                    <div class="row databox my-5">
                        @if ($experts->count() == 0)
                            <x-data-not-found data="Experts" />
                        @endif
                        @foreach ($experts as $expert)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="card ExpBlock verify">
                                    @if ($expert->top_expert == 1)
                                        <small class="TopExp"><span class="text-warning">&#9733;</span> Top
                                            Expert</small>
                                    @endif
                                    @if(!$expert->defaultcharges) 
                                    <small class="NotAvl text-danger">Not Available</small>
                                    @endif
                                    <a href="{{ route('experts', ['alias' => $expert->user_id]) }}"
                                        class="card-header">
                                        <x-image-box>
                                            <x-slot:image>{{ $expert->profile }}</x-slot>
                                                <x-slot:path>/uploads/expert/</x-slot>
                                                    <x-slot:alt>{{ $expert->name ?? '' }}
                                                        {{ !empty($expert->expertise->title) ? $expert->expertise->title : '' }}
                                                        </x-slot>
                                                        <x-slot:width>380</x-slot>
                                                            <x-slot:height>480</x-slot>
                                        </x-image-box>
                                    </a>
                                    <a href="{{ route('experts', ['alias' => $expert->user_id]) }}" class="card-body">
                                        <div>
                                            @if (!empty($expert->expertise))
                                                @foreach ($expert->expertise as $expertise)
                                                    @if (!empty($expertise->expertiseinfo) && $loop->iteration < 3)
                                                        <small class="bg-warning rounded-1 d-inline-block text-black mb-2">

                                                            {{ $expertise->expertiseinfo->title }}

                                                        </small>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="ExpCon">
                                            <h3>{{ $expert->name ?? '' }}</h3>
                                            <small class="text-white fw-lighter">
                                                @if (!empty($expert->roles))
                                                    @foreach ($expert->roles as $roles)
                                                        @if (!empty($roles->roleinfo) && $loop->iteration < 3)
                                                            {{ $roles->roleinfo->title }}
                                                            {{ $loop->iteration < 1 ? ', ' : '' }}
                                                        @endif
                                                    @endforeach
                                                @endif
                                                {{ $expert->compnay_name && count($expert->expertise) > 0 ? ', ' . $expert->compnay_name : $expert->compnay_name }}
                                            </small>
                                        </div>
                                        <div class="h5 text-white price m-0 fw-normal">
                                            @if($expert->defaultcharges)
                                            <i class="fal fa-rupee-sign fw-normal h6 m-0"></i>
                                                @if($expert->defaultcharges->charges > 0 )
                                                        {{ round(($expert->defaultcharges->charges) + ($expert->defaultcharges->charges * 0) / 100) }}/-
                                                @else
                                                    {{ round(($expert->charge) + ($expert->charge * 0) / 100) }}/-
                                                @endif    
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        {{ $experts->links() }}
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>
@endsection
@push('css')
<title>Find All Experts : Expert Bells</title>
<meta name="description" content="Welcome to expert Bells">
<meta name="keywords" content="Welcome to expert Bells">
<style>.Cats{display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;gap:20px;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:flex-start}
.Cats li{text-align:center}
.Cats li a{width:100%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;-webkit-box-shadow:-2px 2px 4px rgb(var(--blackrgb)/0.5);box-shadow:-2px 2px 4px rgb(var(--blackrgb)/0.5)}
.Cats li a.active{background:var(--thm);color:var(--white)}
@media(max-width: 767px){.Cats{font-size:14px;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}}
@media(max-width: 575px){.Cats{gap:10px}}</style>
@endpush
@push('js')

@endpush