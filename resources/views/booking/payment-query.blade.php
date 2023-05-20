@extends('layouts.app')
@section('content')
    <main>
        <section class="inner-banner">
            <div class="section">
                <div class="bg-white"></div>
            </div>
        </section>
        <section class="grey pt-3 pb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fal fa-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a aria-current="page">Thank you!</a></li>
                </ol>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <!-- <h1 class="mt-2 h6 text-secondary text-center mb-3">Post Query</h1> -->
                        <!-- <h2 class="mt-2 h3 thm mb-3 text-center">Conversation for Experts</h2> -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="TopJob mb-4">
                                    <h3 class="mt-2 h3 mb-3 text-center text-success"><strong><i class="fal fa-check-circle"></i> Thank you for Booking!</strong></h3>
                                    <p class="text-center">Thank you so much for booking from <b>{{ project() }}</b>. I really appreciate it!</p>
                                    <div class="card PInfo  mb-4 p-4 mt-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h3 class="mb-1 h4 fw-bold text-black">{{ $lists->expert->name ?? '' }}</h3>
                                                <span class="text-secondary d-block">{{ $sessioncategory->title }}
                                                    ({{ $sessioncategory->minute }} minutes session) </span>
                                            </div>
                                            <div class="col-lg-6 text-md-end text-center">
                                                <span class="text-secondary"><strong class="text-black">Session ID:</strong>
                                                    #{{ $lists->booking_id ?? '' }}</span>
                                                <ul class="m-0 p-0 justify-content-md-end justify-content-center mt-2">

                                                    @if (!empty($lists->expert->states) || !empty($lists->expert->countires))
                                                        <li><i class="fal fa-map-marker-alt me-1"></i>
                                                            @if (!empty($lists->expert->states))
                                                                {{ $lists->expert->states->name ?? '' }}
                                                            @endif
                                                            @if (!empty($lists->expert->countires))
                                                                , {{ $lists->expert->countires->name ?? '' }}
                                                            @endif
                                                        </li>
                                                    @endif

                                                    @if (!empty($lists->expert->languages))
                                                        <li>
                                                            <i class="fal fa-globe-americas me-1"></i>
                                                            @foreach ($lists->expert->languages as $language)
                                                                @php $language = \App\Models\Language::find($language->language_id); @endphp
                                                                {{ $language->title ?? '' }}{{ !$loop->last ? ', ' : '' }}
                                                            @endforeach
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 text-center text-md-start">
                                                <strong class="h5 font text-secondary fw-semibold d-block">Conversation for
                                                    Mentor</strong>
                                                <div class="mb-1"><i class="far fa-calendar-alt text-black"></i>
                                                    {{ date('l, d M', strtotime($lists->booking_date)) }} (<i
                                                        class="far fa-clock text-black"></i>
                                                    {{ substr($lists->booking_start_time, 0, -3) }} to
                                                    {{ substr($lists->booking_end_time, 0, -3) }})</div>
                                            </div>
                                            <div class="col-md-6 text-center text-md-end">
                                                <span class="d-block text-secondary fw-semibold h5">Paid Amount:</span>
                                                <div class="price text-black fw-bold font h4"><i class="Ricon">&#8377;</i>
                                                    {{ $lists->paid_amount ?? '' }}/-</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card PInfo UserBox TopJob mb-4 p-4 mt-4">
                                    <h3 class="h5 d-flex fw-semibold">Post Query
                                        <!--<span class="AddQ h4 m-0 ms-2 sws-right sws-bounce d-none" data-title="Add Now" id="AddQ"><i class="fal fa-plus-circle"></i></span>-->
                                    </h3>
                                    <form method="post" action="{{route('bookingquery')}}" class="d-block mt-3" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="booking" value="{{$lists->id}}">
                                        <div class="mb-4">
                                            <h4 class="thm h5 fw-semibold">1. Tell us about your Startup ?<span
                                                    class="text-danger">*</span></h4>
                                            <textarea class="form-control grey" name="startup" placeholder="Write your answer here">{{ old('startup') }}</textarea>
                                            @error('startup')<span class="error">{{$message}}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <h4 class="thm h5 fw-semibold">2. What are the major challenges you are facing
                                                ?<span class="text-danger">*</span></h4>
                                            <textarea class="form-control grey" name="facing_challenges" placeholder="Write your answer here">{{ old('facing_challenges') }}</textarea>
                                            @error('facing_challenges')<span class="error">{{$message}}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <h4 class="thm h5 fw-semibold">3. What questions do you want to ask to the
                                                mentor ?<span class="text-danger">*</span></h4>
                                            <textarea class="form-control grey" name="ask_question" placeholder="Write your answer here">{{ old('ask_question') }}</textarea>
                                            @error('ask_question')<span class="error">{{$message}}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <h4 class="thm h5 fw-semibold">4. Have you previously worked with any mentors or
                                                coaches, and if so, what was the experience like ?<span
                                                    class="text-danger">*</span>
                                            </h4>
                                            <textarea class="form-control grey" name="experience" placeholder="Write your answer here">{{ old('experience') }}</textarea>
                                            @error('experience')<span class="error">{{$message}}</span>@enderror
                                        </div>
                                        <div class="mb-4">
                                            <h4 class="thm h5 fw-semibold">5. Any Attachment:</h4>
                                            <div class="ms-2 d-flex align-items-center">
                                                <label class="d-flex align-items-center text-primary AddFile"
                                                    for="addfile">Add
                                                    File <i class="fal fa-arrow-to-bottom ms-4"></i></label>
                                                <input type="file" id="addfile" name="attachment">
                                            </div>
                                            @error('attachment')<span class="error">{{$message}}</span>@enderror
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-thm4 mt-2 mb-2 btn-lg sbtn" onclick="$('.sbtn').hide(); $('.pbtn').show();">Submit</button>
                                            <button class="btn btn-thm4 mt-2 mb-2 btn-lg pbtn" style="display:none;" disabled><i class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="text-center mb-5">
                            <a href="{{ route('user.schedules') }}"><u>Skip and Continue</u></a>
                        </div>
                    </div>
                </div>
            </div>
            <img src="{{ asset('frontend/img/bg-img1.svg') }}" width="900" height="500" class="bg-img">
        </section>
    </main>
@endsection
@push('css')
    <title>Payment Query : {{ project() }}</title>
    <meta name="description" content="Welcome to Expert Bells">
    <meta name="keywords" content="Welcome to Expert Bells">
    <style type="text/css">
        .PInfo {
            border-radius: 9px;
            border: none;
            box-shadow: 0 0 9px rgb(var(--blackrgb)/.2);
            overflow: hidden;
        }

        body>main,
        body section {
            overflow: inherit !important
        }

        .TopJob {
            position: sticky;
            top: 90px
        }

        .TopJob ul {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            column-gap: 30px;
            flex-wrap: wrap;
            font-size: 15px
        }

        .TopJob p {
            font-size: 15px
        }

        .formbtn {
            height: 50px;
            min-width: 50px !important;
            width: auto !important;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 35px !important;
            border: 1px solid var(--thm) !important;
            font-size: 22px !important;
            color: var(--thm) !important;
            background: var(--white) !important
        }

        .formbtn:hover {
            background: var(--thm) !important;
            color: var(--white) !important
        }

        .AddFile {
            margin-right: -150px;
            position: relative;
            background: #e7e8eb;
            height: 100%;
            border-radius: 25px !important;
            padding: 13px 25px;
            font-size: 16px;
            white-space: nowrap
        }

        [type=file]#addfile {
            padding-left: 160px;
            border-radius: 25px !important;
            line-height: calc(3rem + 0px)
        }

        [type=file]::file-selector-button {
            margin: 0 20px 0 0 !important;
            display: none;
        }

        .grey .bg-img {
            z-index: 0 !important;
        }

        .UserBox textarea {
            height: 80px;
            resize: none
        }
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
        $("#AddQ").click(function() {
            var faqadd =
                '<div class="d-flex mt-3 AddQus"><input type="text" class="form-control" name="location" placeholder="Add Questionnaire"><button class="btn DeleteQ formbtn ms-2" type="button" data-title="Delete"><i class="fal fa-trash-alt"></i></button></div>';
            $('.PQuery').append(faqadd);
        });
        $(document).on('click', '.DeleteQ', function() {
            $(this).closest('.AddQus').remove();
        });
    </script>
@endpush
