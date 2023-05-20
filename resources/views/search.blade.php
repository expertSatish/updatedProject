@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="pt-3 bg-white">
        <form class="container filterform">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">Search</a></li>
                <li class="breadcrumb-item"><a aria-current="page">{{request('searchlist')}}</a></li>
            </ol>
            <div class="row Filter">
                <div class="col-12">
                    <div class="row databox my-5">
                        @if($experts->count()==0)
                        <x-data-not-found data="Experts"/>
                        @endif
                        @foreach($experts as $expert)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card ExpBlock verify">
                                @if ($expert->top_expert == 1)
                                    <small class="TopExp"><span class="text-warning">&#9733;</span> Top
                                        Expert</small>
                                @endif
                                <a href="{{route('experts',['alias'=>$expert->user_id])}}" class="card-header">
                                    <x-image-box>
                                        <x-slot:image>{{$expert->profile}}</x-slot>
                                        <x-slot:path>/uploads/expert/</x-slot>
                                        <x-slot:alt>{{$expert->name ?? ''}} {{!empty($expert->expertise->title) ? '('.$expert->expertise->title.')' : ''}} </x-slot>
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
                                    <div class="h5 text-white price m-0 fw-normal"><i
                                            class="fal fa-rupee-sign fw-normal h6 m-0"></i>
                                        {{ round(($expert->charge / 2) + ($expert->charge * 0) / 100) }}/-
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach 
                        {{$experts->links()}}                       
                    </div>
                </div>
            </div>
        </form>
    </section>
    <x-footer-find-expert/>
</main>
@endsection
@push('css')
<title>Search Experts : {{project()}}</title>
<meta name="description" content="Welcome to expert Bells">
<meta name="keywords" content="Welcome to expert Bells">
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" onload="this.rel='stylesheet'" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
<style type="text/css">
.SelectExperts a,.FilterDrop a{border-radius:30px!important;margin:0 0 0 auto;border:1px solid rgb(var(--blackrgb)/.2);padding:8px 20px;position:relative;min-width:50px;display:inline-flex;align-items:center}
.FilterDrop a{padding:5px 20px}
.SelectExperts a span,.FilterDrop a span{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:inline-flex; align-items:center; max-width:150px}
.SelectExperts a span:after,.FilterDrop a span:after{display:none}
.SelectExperts a.show,.FilterDrop a.show{box-shadow:0 0 0 .25rem rgb(var(--thmrgb)/.25)!important;border:1px solid var(--thm)}
.SelectExperts a.show:before,.FilterDrop a.show:before{position:absolute;content:'';right:0;left:0;margin:0 auto;bottom:-17px;z-index:9999;width:9px;height:9px;transform:rotate(45deg);background:var(--white)}
.SelectExperts .dropdown-menu,.FilterDrop .dropdown-menu{box-shadow:0 0 25px rgb(var(--blackrgb)/.2);border-color:rgb(var(--blackrgb)/.05);border-radius:15px;margin-top:9px!important}
.FilterDrop{margin:0 9px 9px 0}
.FilterDrop .dropdown-menu{min-width:350px}
.FilterDrop .dropdown-menu input.SearchBox{height:40px;font-size:16px;max-width:400px;background-color:rgb(var(--thmrgb)/.05)}
.FilterDrop .dropdown-menu ul{-webkit-column-count:2;-moz-column-count:2;column-count:2;grid-column-gap:20px;-webkit-column-gap:20px;-moz-column-gap:20px;column-gap:20px;padding:0;margin:15px 0 0;}
/*.FilterDrop .dropdown-menu ul:first-child{margin-top:6rem!important}*/
.Exptext{display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:1}
@media only screen and (max-width:767px){.FilterDrop .dropdown-menu ul{-webkit-column-count:1;-moz-column-count:1;column-count:1;grid-column-gap:0;-webkit-column-gap:1;-moz-column-gap:1;column-gap:1;display:flex;flex-wrap:wrap;justify-content:space-between}}
.SelectExperts .dropdown-menu li,.FilterDrop .dropdown-menu li{padding:3px 20px; margin-bottom:1px; cursor:pointer;white-space:nowrap}
.FilterDrop .dropdown-menu li{padding:3px 0}
.FilterDrop .dropdown-toggle.selected{background:rgb(var(--thmrgb)/.1);border:1px solid rgb(var(--thmrgb)/.25)}
.FilterDrop .dropdown-toggle span:before{content:'\2022';padding:0 6px;font-size:9px}
.FilterDrop .dropdown-toggle span:empty:before{display:none}
.Steps .row>div{counter-increment:slides-num}
.Steps .card{background:none;border-radius:0}
.Steps .card>*{border-radius:0;border:none;background:none}
.Steps .card img{height:70px; width:auto;object-fit:contain;margin-bottom:20px}
.Steps .card h3{color:var(--thm3);position:relative}
.Steps .card h3:after{content:"0"counter(slides-num)".";position:absolute;top:0;bottom:0;left:0;right:0;margin:auto;font-weight:600;font-size:72px;color:rgb(var(--blackrgb)/.05); transform:translateY(-100%); transition:all .5s;z-index:-1}
.Steps .card p{font-size:15px;display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:2;margin-top:9px}
input.SearchBox{padding-left:40px;height:48px;font-size:18px;margin:0;width:100%;background-image:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%23666" viewBox="0 0 409.73 409.77"><path d="M878.4,589.6c-2.31-1.75-4.87-3.26-6.9-5.29q-59.18-59-118.22-118.18a33.48,33.48,0,0,1-2.94-4c-42.53,36-90.26,49.69-144,38.17-41.8-9-75-31.94-99.05-67.21-45.75-67.18-35.88-158.84,29.41-214.44,60.7-51.71,148.18-51.6,208.86-.32,34.69,29.32,54.24,67.13,57.35,112.54,3.1,45.21-11.15,85-41.18,119.46,1.18,1.23,2.22,2.38,3.32,3.48Q824.3,513,883.51,572.29c2,2,3.54,4.6,5.29,6.91v4l-6.4,6.4Zm-92-247.24c.37-79.5-64.38-145-144.82-145.17A144.41,144.41,0,0,0,496.4,341.9c-.26,79.83,63.72,144.69,144.69,145.25C720.59,487.7,786,422.34,786.39,342.36Z" transform="translate(-479.07 -179.83)"/></svg>');background-repeat:no-repeat;background-size:20px;background-position:9px;margin-bottom:9px}
</style>
@endpush
@push('js')

@endpush