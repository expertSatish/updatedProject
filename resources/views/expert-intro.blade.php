@extends('layouts.app')
@section('content')
    <main>
        <section class="inner-banner">
            <div class="section">
                
                <div class="bg-white"></div>
            </div>
        </section>
        <section class="Sec2 pt-3 bg-white">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fal fa-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('experts') }}">Find All Experts</a></li>
                    <li class="breadcrumb-item"><a aria-current="page">Expert introduction</a></li>
                </ol>
                <div class="row ExpDetail mt-4">
                    <div class="col-lg-3">
                            <div class="card ProBlock mt-0">
                                <a href="#" class="card-header">
                                    @if ($experts->top_expert == 1)
                                        <span class="StarBox">Top Expert</span>
                                    @endif
                                    <x-image-box>
                                        <x-slot:image>{{ $experts->profile }}</x-slot>
                                            <x-slot:path>/uploads/expert/</x-slot>
                                                <x-slot:alt>{{ $experts->name ?? '' }}
                                                    {{ !empty($experts->expertise->title) ? '(' . $experts->expertise->title . ')' : '' }}
                                                    </x-slot>
                                                    <x-slot:width>380</x-slot>
                                                        <x-slot:height>480</x-slot>
                                    </x-image-box>
                                </a>
                            </div>
                            <h3 class="h5 text-black verify mb-1">{{ $experts->name }}</h3>
                            <small class="lh-n d-block mb-3">
                                @if (count($experts->roles) > 0)
                                    <span>
                                        @foreach ($experts->roles as $roles)
                                            @if (!empty($roles->roleinfo) && $loop->iteration < 3)
                                                {{ $roles->roleinfo->title }}
                                                {{ $loop->iteration < 1 ? ', ' : '' }}
                                            @endif
                                        @endforeach
                                    </span>,
                                @endif
                                @if(!empty($experts->compnay_name)) 
                                    <span>{{$experts->compnay_name}}</span>
                                @endif
                            </small>
                             <h5>Expertise</h5>
                            @if (count($experts->expertise) > 0)
                            <div class="card-border">
                                <span class="ComRole small fw-semibold text-center text-black">
                                    @foreach ($experts->expertise as $expertise)
                                        @if (!empty($expertise->expertiseinfo) && $loop->iteration < 3)
                                            <span>{{ $expertise->expertiseinfo->title }}</span>
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                            @endif
                            <h5>Industries</h5>
                            @if (!empty($experts->industries))
                                <div class="card-border">
                                <span class="ComRole small fw-semibold text-center text-black">
                                    @foreach ($experts->industries as $industry)
                                        @php $industry = \App\Models\Industry::find($industry->industry_id); @endphp
                                        @if(!empty($industry))
                                            <span>{{ $industry->title ?? '' }}</span>
                                        @endif
                                    @endforeach
                                </span>
                                </div>
                                <!-- <span class="d-block mb-2">
                                        <div><strong>Company :</strong> Sam Web Studio</div>
                                        <div><strong>Role :</strong> Marketing Head</div>
                                    </span> -->
                            @endif
                           
                            <div class="mb-2 text-secondary">
                                @if (!empty($experts->states) || !empty($experts->countires))
                                    <small><i class="fal fa-map-marker-alt"></i>
                                        @if (!empty($experts->states))
                                            {{ $experts->states->name ?? '' }}
                                        @endif
                                        @if (!empty($experts->countires))
                                            , {{ $experts->countires->name ?? '' }}
                                        @endif
                                    </small> &nbsp;
                                @endif
                                @if (!empty($experts->languages))
                                    <small><i class="fal fa-globe-americas"></i>
                                        @foreach ($experts->languages as $language)
                                            @php $language = \App\Models\Language::find($language->language_id); @endphp
                                            {{ $language->title ?? '' }}{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                    </small>
                                @endif
                            </div>
                            <div class="thm ExpStar"><span class="star"
                                    data-title="{{ floatval($experts->publishreviews()->avg('rating')) }}"></span>
                                {{ floatval($experts->publishreviews()->avg('rating')) }} </div>
                            <p class="lh-n"><a href=""
                                    class="text-secondary"><small>{{ count($experts->publishreviews) }} reviews /
                                        {{ count($experts->slots) }} sessions</small></a></p>
                            <div class="text-center d-flex justify-content-between mb-2">
                                @if (Auth::user())
                                    @php
                                        $slots = \App\Models\SlotBook::where(['expert_id' => $experts->id, 'user_id' => Auth::user()->id])->count();
                                    @endphp
                                    @if ($slots > 0)
                                        <a href="javascript:void(0)" class="btn btn-thm3 px-3 SendMessage">
                                            <i class="fal fa-comment-alt-lines m-0 me-1"></i> Message me
                                        </a>
                                    @endif
                                @endif
                            </div>
                            @if (!empty($notesection->description))
                                <div class="Proceed d-none">{{ $notesection->description ?? '' }}</div>
                            @endif
                    </div>
                    <div
                        class="col-lg-{{ empty(\Auth::guard('expert')->user()) && empty(\Auth::guard('admin')->user()) && count($experts->slotcharges) > 0 && count($experts->availabilities) > 0 ? '6' : '6' }} ">
                        <div
                            class="{{ empty(\Auth::guard('expert')->user()) && empty(\Auth::guard('admin')->user()) && count($experts->slotcharges) > 0 && count($experts->availabilities) > 0 ? 'mx-lg-3' : 'ms-lg-3' }}">
                            <h1 class="h3 text-black m-0">Expert Introduction</h1>
                            <h3 class="h5 thm mt-4">About me</h3>
                            <div class="CmsPage">
                                <!-- @if(!empty($experts->compnay_name)) 
                                    <small><b>Company:</b> {{$experts->compnay_name}}</small><br>
                                @endif
                                @if (count($experts->roles) > 0)
                                <small>
                                    <b>Role:</b>                                   
                                        @foreach ($experts->roles as $roles)
                                            @if (!empty($roles->roleinfo) && $loop->iteration < 3)
                                                {{ $roles->roleinfo->title }}
                                                {{ $loop->iteration < 1 ? ', ' : '' }}
                                            @endif
                                        @endforeach                                    
                                </small>
                                <br>
                                @endif
                                @if (count($experts->expertise) > 0)
                                <small>
                                    <b>Expertise:</b>                                    
                                        @foreach ($experts->expertise as $expertise)
                                            @if (!empty($expertise->expertiseinfo) && $loop->iteration < 3)
                                                {{ $expertise->expertiseinfo->title }}
                                                {{ $loop->iteration < 2 ? ', ' : '' }}
                                            @endif
                                        @endforeach                                    
                                </small>
                                <br>
                                @endif -->
                                {!! $experts->bio !!}
                            </div>
                            @if (!empty($experts->your_strength))
                                <h3 class="h5 thm mt-4">Strength</h3>
                                <div class="CmsPage">
                                    {!! $experts->your_strength !!}
                                </div>
                            @endif

                            @if (count($experts->expects) > 0)
                                <h3 class="h5 thm mt-5 mb-3">What to expect</h3>
                                <div class="rounded-3 bg-light p-3 border">
                                    <div class="CmsPage">
                                        <ul>
                                            @foreach ($experts->expects as $expects)
                                                <li>{{ $expects->description }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @if (count($experts->publishreviews) > 0)
                                <h3 class="h5 thm mt-5 mb-3">Why it's valuable</h3>
                                <div class="card ReviewBlock">
                                    @foreach ($experts->publishreviews as $item)
                                        <div class="card-body">
                                            <div class="img">
                                                <x-image-box>
                                                    <x-slot:image>{{ $item->user->profile ?? '' }}</x-slot>
                                                        <x-slot:path>/uploads/user/</x-slot>
                                                            <x-slot:alt>{{ $item->user->name ?? '' }}</x-slot>
                                                                <x-slot:width>50</x-slot>
                                                                    <x-slot:height>50</x-slot>
                                                </x-image-box>
                                            </div>
                                            <div>
                                                <h4 class="thm m-0">{{ $item->user->name ?? '' }}</h4>
                                                <p class="mt0">{{ $item->description ?? '' }}</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="star" title="star"
                                                        data-title="{{ $item->rating ?? '0' }}"></span>
                                                    <small
                                                        class="text-secondary">{{ date('l d M, Y', strtotime($item->created_at)) }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="FirstScreen">
                            <h2 class="h3 text-black mb-3">Book a video call</h2>
                            <p><small class=" text-secondary">Powered by</small> <img
                                    src="{{ asset('frontend/img/logo.svg') }}" height="18" width="99"></p>
                            <div class="card ExpInfo text-center mb-4">
                                <div class="card-body">
                                    @if (!empty($requestsection->title) || !empty($requestsection->description))
                                        <i>Introducing</i>
                                    @endif
                                    <h3 class="my-2">{{ $requestsection->title }}</h3>
                                    <p>{{ $requestsection->description }}</p>
                                    <a href="#BookExpert" data-bs-toggle="modal" class="btn btn-thm4 btn-lg">Select
                                        times <img src="{{ asset('frontend/img/arrow.svg') }}" class="ms-3"
                                            width="30" height="30"></a>
                                    <div class="price"><i class="Ricon">&#8377;</i> <span class="mprice"></span>/-
                                        (Per Session)
                                        <!-- <del><i class="Ricon">&#8377;</i> 999/-</del> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card ExpInfo text-center d-none">
                                <div class="card-body">
                                    <h3 class="my-2">{{ $giftsection->title }}</h3>
                                    <p>{{ $giftsection->description }}</p>
                                    <a href="#" class="btn btn-thm4 btn-lg px-5 BtnContinue">Continue</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class=" col-sm-3">
                    @if (count($experts->videos) > 0)
                                    <div class="card">
                                            <video  height="240" controls>
                                                <source src="{{asset('uploads/expert/video/'.$video->video)}}"
                                                    type="video/mp4" />
                                                Your browser does not support the video tag.
                                        <a style="text-align: center;" href="{{route('experts',['alias'=>$video->expert->user_id,'type'=>'videos','v'=>$video->video_id,'check'=>Request::segment(2)])}}"
                                            class="card-body">
                                            <h3 style="text-align: center;">{{$video->title ?? ''}}</h3>
                                            <p class="text-secondary me-3"><i class="far fa-user thm"></i>
                                                {{$video->expert->name ?? ''}}</p>
                                            @if(!empty($video->industries))
                                            <small style="text-align: center;" class="text-secondary"><i class="far fa-tag thm"></i>
                                                @foreach(json_decode($video->industries) as $industry)
                                                @php $industry = \App\Models\Industry::find($industry); @endphp
                                                {{$industry->title ?? ''}} {{!$loop->last?'+':''}}
                                                @endforeach
                                            </small>
                                            @endif
                                        </a>
                                        </video>

                                    </div>
                                @endif

                    </div>

                </div>
            </div>
        </section>
    </main>

    <div class="modal fade RighSide BookS AddPro" id="BookExpert" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="BookExpertLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form class="modal-content bookingmodalform">
                @csrf
                <input type="hidden" name="expert" value="{{ $experts->id }}">
                <div class="modal-header p-0 border-0">
                    <!-- <h2 class="h5 modal-title" id="BookExpertLabel">Select times</h2> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body PopupDetail py-3 p-4 pb-0">
                    <div class="sTimeScreen">
                        <div class="ContainBOx">
                            <h3 class="h4 thm fw-bold mb-3 d-flex justify-content-between align-items-center">Select
                                Duration</h3>
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <div class="pb-2 mb-2">
                                        <ul class="p-0 mb-0 TimeBox TopTimeBox">
                                            @foreach ($experts->slotcharges as $charges)
                                                <li>
                                                    <div class="form-check">
                                                        <label style="cursor:pointer" class="form-check-label d-flex" for="s{{ $loop->iteration }}">
                                                            <input type="radio" onchange="gettimeslots()" class="form-check-input me-3" value="{{ $charges->time->minute }}" name="Sizes" id="s{{ $loop->iteration }}" autocomplete="off" @checked($loop->iteration == 1)>
                                                            <span>{{ $charges->time->title }}
                                                                <small class="d-block fw-normal" style="font-size:12px">per sessions will be of {{ $charges->time->minute }} minutes</small>
                                                            </span>
                                                            <span class="fw-normal ms-3">Rs.{{ $charges->charges + ($charges->charges * 0 / 100) }}</span>
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-5 Pcalendar">
                                    <h3 class="h4 thm fw-bold mb-3 d-flex justify-content-between align-items-center">Pick
                                        the Date</h3>
                                    <input type="hidden" onchange="gettimeslots()" class="form-control inlinecal d-none"
                                        id="dob" onchange="gettimeslots()" value="{{date('Y-m-d')}}" name="booking_date"
                                        placeholder="Date of Birth">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3
                                        class="h4 thm fw-bold timeheadingbox mb-3 justify-content-between align-items-center">
                                        Select the Time slot</h3>
                                    <div class="SetTimeBox"></div>
                                </div>
                            </div>
                        </div>
                        <div class="position-sticky footerbox border-top">
                            <div class="price m-0 h4">
                                <strong>Price:</strong>
                                <i class="Ricon">&#8377;</i>
                                <span class="mprice">0</span>/-
                                <span class="h6 small d-block d-block d-sm-inline-block">(Per Session)</span>
                            </div>
                            <input type="hidden" name="booking_price" value="0">
                            <span>
                                <button class="btn btn-thm4 bsbtn m-0">Book Now <i
                                        class="fal fa-chevron-right ms-2"></i></button>
                                <button type="button" class="btn btn-thm4 m-0 bpbtn" style="display: none" disabled><i
                                        class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                                <button class="btn btn-thm3 bsbtn m-0" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel
                                    <i class="fal fa-chevron-right ms-2"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
@push('css')
    <title>Expert introduction : {{ project() }}</title>
    <meta name="description" content="Welcome to expert Bells">
    <meta name="keywords" content="Welcome to expert Bells">
    <style>
        body>main,
        body section {
            overflow: inherit !important
        }

        .Sec2 .card.ProBlock {
            border-radius: 9px !important;
            overflow: hidden !important
        }

        .ProBlock>.card-header {
            height: 350px !important
        }

        .star {
            font-size: 20px !important
        }

        .Proceed {
            border-radius: 15px;
            padding: 12px 20px;
            background: rgb(var(--thmrgb3)/.1);
            color: var(--thm3);
            text-align: center;
            margin-top: 15px
        }

        .ExpDetail .position-sticky {
            top: 70px
        }

        .Sec2 .ExpInfo.card {
            border: 1px solid rgb(var(--thmrgb3)/.15) !important;
            border-radius: var(--bs-border-radius-lg) !important
        }

        .Sec2 .ExpInfo.card .price {
            font-size: 15px
        }

        @media (min-width:992px) {}

        @media (min-width:1200px) {
            .ExpDetail>div.col-lg-6 {
                width: calc(100% - 660px)
            }

            .ExpDetail>div.col-lg-9 {
                width: calc(100% - 330px)
            }

            .ExpDetail>div.col-lg-3:first-child,
            .ExpDetail>div.col-lg-3:nth-child(2) {
                width: 330px
            }
        }

        @media (min-width:1600px) {
            .ExpDetail>div.col-lg-6 {
                width: calc(100% - 680px)
            }

            .ExpDetail>div.col-lg-9 {
                width: calc(100% - 340px)
            }

            .ExpDetail>div.col-lg-3:first-child,
            .ExpDetail>div.col-lg-3:nth-child(2) {
                width: 340px
            }
        }

        .ReviewBlock {
            border: none !important;
            background: none !important
        }

        .ReviewBlock>div {
            border-top: 1px solid rgb(var(--blackrgb)/.1) !important;
            padding: 15px 0 0;
            margin-top: 15px;
            display: flex;
            justify-content: space-between
        }

        .ReviewBlock>div:first-child {
            border: none !important;
            margin-top: 0
        }

        .ReviewBlock>div .img {
            width: 75px
        }

        .ReviewBlock>div .img img {
            height: 60px;
            width: 60px;
            border-radius: 50%;
            box-shadow: 0 2px 3px rgb(var(--blackrgb)/.3)
        }

        .ReviewBlock>div>div {
            width: calc(100% - 60px)
        }

        .ReviewBlock>div .star {
            margin-left: 0
        }

        .ReviewBlock>div h4 {
            font-size: 16px;
            margin-top: 0;
            font-weight: 600
        }

        .ReviewBlock>div>div>span:last-child {
            font-size: 12px !important
        }

        .ComRole {
            column-gap: 9px;
            display: flex;
            flex-wrap: wrap
        }

        .ComRole span {
            display: flex;
            width: calc(50% - 5px);
            padding: 4px 9px;
            background: rgb(var(--blackrgb)/.1);
            margin: 0 0 9px;
            border-radius: 3px;
            background-color: #0c233b;
            color: #fff;
            align-items: center;
            justify-content: center;
        }
         .card-border{
            margin: 10px 0;
            border: 1px solid #d3cdd3;
            padding: 10px;
            border-radius: 7px;
         }
        .flatpickr-day.flatpickr-disabled,
        .flatpickr-day.flatpickr-disabled:hover {
            color: rgb(var(--blackrgb)/.4) !important
        }
        .sTimeScreen .position-sticky{padding-bottom:20px!important;}
        @media (max-width:992px){.PopupDetail{max-height:90vh;overflow:auto}
        .sTimeScreen .position-sticky .btn.btn-thm3.bsbtn{display:none}}
        @media (max-width:767px){.BookS .sTimeScreen .position-sticky .price{font-size:18px!important}}
    </style>
@endpush
@push('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function() {
            gettimeslots();
        });

        function gettimeslots() {
            $('.SetTimeBox').html(
                '<center class="loaderbox my-5"><i class="fad fa-spinner-third fa-spin" style="font-size: 40px;"></i></center>'
            );
            $.ajax({
                data: {
                    _token: $('meta[name=csrf-token]').attr('content'),
                    slot: $('input[name=Sizes]:checked').val(),
                    date: $('input[name=booking_date]').val(),
                    expert: @json($experts->id ?? 0)
                },
                url: @json(route('expertslottimes')),
                method: "Post",
                dataType: "Json",
                success: function(success) {
                    $('.SetTimeBox').html(success.html);
                    $('.mprice').html(success.charges);
                    $('input[name=booking_price]').val(success.charges);
                    if (success.records == 0) {
                        $('.footerbox').hide();
                        $('.timeheadingbox').hide();
                    }
                    if (success.records > 0) {
                        $('.footerbox').show();
                        $('.timeheadingbox').show();
                    }
                    flatpickr(".inlinecal", {
                        inline: true,
                        minDate: "today",
                        dateFormat: "Y-m-d",
                        "enable": success.availabile
                        // "disable": [
                        //     function(date) {
                        //         return (
                        //             // date.getDay() == success.notavailabile[0] ||
                        //             // date.getDay() == success.notavailabile[1] ||
                        //             // date.getDay() == success.notavailabile[2] ||
                        //             // date.getDay() == success.notavailabile[3] ||
                        //             // date.getDay() == success.notavailabile[4] ||
                        //             // date.getDay() == success.notavailabile[5] ||
                        //             // date.getDay() == success.notavailabile[6]
                        //         );
                        //     }
                        // ]
                    });
                }
            });
        }
        $('.bookingmodalform').on('submit', function(e) {
            if ($('input[name=timing]').is(':checked') == false) {
                toastr.error('Please select appointment time slot.');
                return false;
            }
            e.preventDefault();
            $('.bsbtn').hide();
            $('.bpbtn').show();
            $.ajax({
                data: new FormData(this),
                url: @json(route('bookingprocess')),
                method: "Post",
                dataType: "Json",
                contentType: false,
                processData: false,
                success: function(success) {
                    window.location.href = success.redirect;
                }
            });
        });

        $('.SendMessage').on('click', function() {
            $('input[name=to_recipient_email]').val("{{ $experts->email }}");
            $('input[name=to_recipient_email]').attr('readonly', true);
            $('.ToBox').hide();
        });
    </script>
    <x-user.message-popup />
@endpush
