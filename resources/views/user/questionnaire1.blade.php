@extends('layouts.app')
@section('content')
    <main>
        <section class="inner-banner">
            <div class="section">
                <div class="bg-white"></div>
            </div>
        </section>
        <section class="grey pt-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fal fa-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.schedules') }}">Schedules</a></li>
                    <li class="breadcrumb-item"><a aria-current="page">Questionnaire</a></li>
                </ol>
                <div class="row MainBoxAc">
                    <div class="col-md-3">
                        <div class="position-sticky top-0">
                            <x-user.left-bar />
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h3 class="text-center mb-2">Questionnaire</h3>
                        <form action="{{route('user.schedulequeries')}}" enctype="multipart/form-data" method="post" class="card UserBox p-4" style="max-width:820px;margin:0 auto">
                            @csrf
                            <input type="hidden" name="booking" value="{{$bookings->id}}">
                            <div class="card-body d-block">
                                <div class="mb-4">
                                    <h4 class="thm h5 fw-semibold">1. Tell us about your Startup ?<span
                                            class="text-danger">*</span></h4>
                                    <textarea class="form-control grey" name="startup" placeholder="Write your answer here">{{ old('startup', $bookings->query) }}</textarea>
                                    @error('startup') <span class="error">{{$message}}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <h4 class="thm h5 fw-semibold">2. What are the major challenges you are facing ?<span
                                            class="text-danger">*</span></h4>
                                    <textarea class="form-control grey" name="facing_challenges" placeholder="Write your answer here">{{ old('facing_challenges', $bookings->facing_challenges_query) }}</textarea>
                                    @error('facing_challenges') <span class="error">{{$message}}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <h4 class="thm h5 fw-semibold">3. What questions do you want to ask to the mentor ?<span
                                            class="text-danger">*</span></h4>
                                    <textarea class="form-control grey" name="ask_questions" placeholder="Write your answer here">{{ old('ask_questions', $bookings->ask_question_query) }}</textarea>
                                    @error('ask_questions') <span class="error">{{$message}}</span> @enderror
                                </div>
                                <div class="mb-4">
                                    <h4 class="thm h5 fw-semibold">4. Have you previously worked with any mentors or
                                        coaches, and if so, what was the experience like ?<span class="text-danger">*</span>
                                    </h4>
                                    <textarea class="form-control grey" name="experience" placeholder="Write your answer here">{{ old('experience', $bookings->experience_query) }}</textarea>
                                    @error('experience') <span class="error">{{$message}}</span> @enderror
                                </div>
                                <div class="d-md-flex">
                                    <h4 class="thm h5 fw-semibold">5. Any Attachment:</h4>
                                    <div class="ms-2 d-flex align-items-center">
                                        <label class="d-flex align-items-center text-primary AddFile" for="addfile">Add
                                            File <i class="fal fa-arrow-to-bottom ms-4"></i></label>
                                        <input type="file" id="addfile" name="attachment">
                                    </div>
                                    @if (!empty($bookings->query_attachment))
                                        <a href="{{asset('uploads/booking-attachment/'.$bookings->query_attachment)}}" download="download"><i class="fad fa-download"></i> Download Attachment</a>
                                    @endif
                                    @error('attachment') <span class="error">{{$message}}</span> @enderror
                                </div>
                                <div class="text-end mt-4">
                                    <button class="btn btn-thm4">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
@endsection
@push('css')
    <title>Scheduled Calls : {{ project() }}</title>
    <meta name="description" content="Welcome to Expert Bells">
    <meta name="keywords" content="Welcome to Expert Bells">
    <link rel="stylesheet" href="{{ asset('frontend/css/account.css') }}">
    <style>
        .UserBox textarea {
            height: 140px;
            resize: none
        }

        .AddFile {
            margin-right: -102px;
            position: relative;
            background: #e7e8eb;
            height: 100%;
            padding: 5px 15px;
            border-radius: 5px;
            font-size: 15px
        }

        [type=file]::file-selector-button {
            margin: 0 20px 0 0 !important
        }

        .ConHR {
            background: rgb(var(--thmrgb)/.15) !important;
            border: 1px solid rgb(var(--thmrgb)/.1) !important;
            max-width: 450px;
            width: 100%;
            margin: 30px auto 0
        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            if ($(window).width() < 991) {
                $("#AccMenuBar").removeClass('d-none');
                $("#AccountMenu").addClass('collapse');
            };
            setTimeout(() => {
                $('.summernote').summernote({
                    height: 100,
                    toolbar: []
                });
                $('.summernote').summernote('code', '')
            }, 1000);
            gettimeslots();
        });
    </script>
    <x-message-popup />
@endpush
