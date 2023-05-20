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
                <div class="row">
                    <div class="col-md-8">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fal fa-home-alt"></i></a></li>
                            <li class="breadcrumb-item"><a aria-current="page">Dashboard</a></li>
                        </ol>
                    </div>
                    <x-expert.wallet-show />
                </div>
                <div class="row MainBoxAc">
                    <div class="col-md-3">
                        <div class="position-sticky top-0">
                            <x-expert.left-bar />
                        </div>
                    </div>
                    <div class="col-md-9">
                        @if (expertinfo()->profile_complete > 0)
                            <div class="card UserBox TopExpert mb-4">
                                <div class="card-body">
                                    <div class="uimg">
                                        <label>
                                            <span>
                                                <x-image-box>
                                                    <x-slot:image>{{ expertinfo()->profile }}</x-slot:image>
                                                    <x-slot:path>/uploads/expert/</x-slot:image>
                                                        <x-slot:alt>{{ expertinfo()->name ?? '' }}</x-slot:image>
                                                </x-image-box>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="utext">
                                        <div class="row align-items-center">
                                            <div class="col-md-5 Uinfo">
                                                <small class="text-secondary">Hello,</small>
                                                <h3 class="h5 mb-1">{{ expertinfo()->name ?? '' }}</h3>
                                                <a href="{{ route('expert.account') }}"><i class="fal fa-edit"></i> Edit
                                                    Account</a>
                                                <a href="{{ route('expert.videos') }}"
                                                    class="btn btn-sm btn-thm2 m-0 ms-2"><i
                                                        class="fal fa-photo-video m-0 me-1"></i> All Video</a>
                                            </div>
                                            <div class="col-md-7 text-end">
                                                <h1 class="h5 thm mb-0">Welcome to your Dashboard</h1>
                                                <p class="text-secondary mb-2"><small>You have a full access to ExpertBells
                                                        features.</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-6">
                                    <a href="{{route('expert.schedules')}}" class="card UserBox TopBoxs mb-4">
                                        <div class="card-body">
                                            <i class="fal fa-phone-plus thm2 h1"></i>
                                            <h3 class="h2 m-0 thm">
                                                @php 
                                                    $bookings = \App\Models\SlotBook::where(['expert_id'=>expertinfo()->id]);
                                                    $bookings = $bookings->whereIn('status',[1]);
                                                    if(empty(request('type'))){
                                                        $bookings = $bookings->whereIn('reschedule_slot',[0]);
                                                        $bookings = $bookings->where('booking_time','>=',date('Y-m-d H:i:s'));  
                                                    }  
                                                    $bookings = $bookings->orderBy('id','DESC');
                                                    $bookings = $bookings->count();
                                                @endphp
                                                {{ $bookings }}
                                            </h3>
                                            <p class="m-0 text-secondary"><small>New Call Requests</small></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <a href="{{route('expert.schedules')}}?type=callhistory" class="card UserBox TopBoxs mb-4">
                                        <div class="card-body">
                                            <i class="fal fa-phone-alt thm2 h1"></i>
                                            <h3 class="h2 m-0 thm">
                                                {{ \App\Models\SlotBook::where(['expert_id' => expertinfo()->id])->whereIn('status', [1,2,3])->count() }}
                                            </h3>
                                            <p class="m-0 text-secondary"><small>Call History</small></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <a href="{{route('expert.message')}}" class="card UserBox TopBoxs mb-4">
                                        <div class="card-body">
                                            <i class="fal fa-comment-alt-lines thm2 h1"></i>
                                            <h3 class="h2 m-0 thm">
                                                {{ \App\Models\ComposeMessage::where(function ($q) {
                                                    $q->where('read_to', 0);
                                                    $q->where('expert_id', expertinfo()->id);
                                                    $q->where('archive_expert', 0);
                                                    $q->where('delete_expert', 0);
                                                    $q->where('send_by', 2);
                                                })->count() }}
                                            </h3>
                                            <p class="m-0 text-secondary"><small>Unread Message</small></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <a href="{{url('experts/'.expertinfo()->user_id)}}" target="_blank" class="card UserBox TopBoxs mb-4">
                                        <div class="card-body">
                                            <i class="fal fa-star thm2 h1"></i>
                                            <h3 class="h2 m-0 thm">
                                                {{ \App\Models\ExpertReview::where(['expert_id' => expertinfo()->id])->count() }}
                                            </h3>
                                            <p class="m-0 text-secondary"><small>Reviews</small></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card UserBox Boxs">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h3 class="h6 m-0">All Report Section</h3>
                                                <a><small>
                                                    <select class="form-select" name="grafyear" id="grafyear" onchange="getgraf()">
                                                        @for($A=2023;$A<=date('Y');$A++)
                                                        <option value="{{$A}}" {{$A==date('Y')?'selected':''}}>{{$A}}</option>  
                                                        @endfor  
                                                    </select>    
                                                </small></a>
                                            </div>
                                            <div id="multi" class="w-100" style="height:400px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 text-center mt-5">
                                <h6>HI` {{expertinfo()->name}}.</h6>
                                <p><small>Your profile is not complete yet. click on the button below to complete the profile</small></p>
                                <a href="{{route('expert.register',['type'=>'s3'])}}" class="btn btn-thm2">Complete Profile</a>
                                {{-- <a href="{{route('expert.register',['type'=>'s'.(expertinfo()->registration_step + 1)])}}" class="btn btn-thm2">Complete Profile</a> --}}
                                <a href="{{route('expert.expertlogout')}}" class="btn btn-thm2">Login with other account</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('css')
    <title>Dashboard : Expert Bells</title>
    <meta name="description" content="Welcome to Expert Bells">
    <meta name="keywords" content="Welcome to Expert Bells">
    <link rel="stylesheet" href="{{ asset('frontend/css/account.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/message.css') }}">
    <link rel="preload" as="style"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        onload="this.rel='stylesheet'"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
    <style type="text/css">
        .TopBoxs {
            min-height: 150px !important
        }

        .TopBoxs>div {
            display: grid;
            place-content: center;
            text-align: center
        }

        .TopBoxs>div h3 {
            line-height: 100% !important
        }

        .Boxs>div {
            display: block
        }

        .Boxs.p-0 {
            padding: 0 !important
        }

        .Boxs>div p {
            line-height: 120% !important
        }

        .DataTable {
            font-size: 15px
        }

        .DataTable>:not(caption)>*>* {
            padding: .5rem !important;
            font-size: 13px
        }

        .DataTable>thead>tr>th:not(.sorting_disabled),
        .DataTable>thead>tr>td:not(.sorting_disabled) {
            padding-right: .5rem !important
        }

        .DataTable>thead>tr>th:first-child {
            padding-right: 1rem !important
        }

        .DataTable>thead>tr>th:first-child:after,
        .DataTable>thead>tr>th:first-child:before {
            display: none
        }

        .DataTable>thead .sorting:before,
        .DataTable>thead .sorting:after {
            bottom: .7em !important
        }

        .DataTable thead {
            background: var(--thm);
            color: var(--white)
        }

        .DataTable thead th {
            font-weight: 500 !important;
            font-size: 13px
        }

        .DataTable thead .form-check-input[type=checkbox]:after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 9l4 4l11-12'/%3e%3c/svg%3e")
        }

        .DataTable thead .form-check {
            align-items: center
        }

        .DataTable .form-check input {
            margin: 0 !important
        }

        .badge {
            font-weight: 400 !important;
            font-size: 12px !important;
            line-height: 14px !important
        }

        .btni {
            height: 32px;
            width: 32px;
            padding: 0 !important;
            display: inline-grid !important;
            place-items: center
        }

        .ProTable {
            display: flex;
            justify-content: space-between
        }

        .ProTable .img {
            max-width: 50px;
            height: 50px
        }

        .ProTable .img img {
            height: 100%;
            width: 100%;
            object-fit: cover
        }

        .ProTable>div:last-child {
            width: calc(100% - 60px)
        }

        .ProTable h3 {
            font-size: 14px;
            display: -webkit-box;
            overflow: hidden;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            margin-bottom: 2px;
            line-height: 120% !important;
            font-weight: 600 !important
        }

        .ProTable p {
            font-size: 13px !important;
            margin: 0;
            line-height: normal !important;
            color: rgb(var(--blackrgb)/.6) !important
        }

        .TableBox,
        .MailBoxR {
            max-height: 300px;
            min-height: 300px;
            overflow: auto
        }

        .TableBox .table>thead {
            position: sticky;
            top: 0
        }

        .star {
            margin: 0 !important;
            font-size: 16px !important
        }

        .MailBoxR .MBmails ul li .name {
            width: 120px
        }

        .MailBoxR .MBmails ul li .mail {
            width: calc(100% - 230px)
        }

        .MailBoxR .MBmails ul li .date {
            width: 80
        }

        .MailBoxR .MBmails ul li .attachment {
            width: 20px
        }

        #piechart [dir="ltr"],
        #piechart svg,
        #piechart rect {
            width: auto !important
        }

        .TopExpert {
            padding-right: 120px
        }

        .TopExpert:after {
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 386.93 409.77"><path fill="%23fdd8a7" d="M188.35,249.83c7,17.81,23.78,60.6,27.13,63.16,22.57,17.29,98.22,75.4,113.47,87.17,4.45,3.42,4.51,6,.51,9.61H247c-.46-.62-54.59-56.27-59-61.06a8.48,8.48,0,0,0-5.92-2.89c-44,3.88-62-18.41-64.63-22.12,8.4-11.65,34.31-46.55,38.83-52.28,5.46-6.91-.54-17.81-11.72-11.14-6.4,4-19.37,21.84-30,24.57,12-17.45-27.46-42.45-31.46-41.45,1.63-2.94,9.25-10.69,20.74-4.82,2.32,2.18,4.68,4.31,6.92,6.57,1.28,1.27,2.48,1.69,3.56,0,2.11-3.3,5.12-5.76,7.84-8.47,1.57-1.55,1.68-2.55.07-4.22-5-5.2-20.22-2.38-21.43-1.86-2-11.13,10.1-20.36,20.39-16.53,4.1,1.56,7.15,4.46,10.15,7.56,1.25,1.31,2.43,2.49,4.3.69,4.39-4.23,9.8-5.63,15.75-5.38C161.22,217.66,186.55,245.26,188.35,249.83Z"/><path fill="%23f3c18c" d="M197.45,409.75l-35.78-36.9a4,4,0,0,0-2.7-1.51c-17.19.12-58.57-13.92-63-18.32,4.77-6.95,19.54-26.72,21.54-29.34,2.63,3.71,20.41,25.71,64.63,22.12a8.48,8.48,0,0,1,5.92,2.89c4.38,4.79,58.51,60.44,59,61.06Z"/><path fill="%23fdd030" d="M200.09,107.56c9.83-12.35,35-40.56,36.75-42.69,18.34,14.77,81.94,69.25,102.4,85.84-1.39,1.74-25.76,29.67-27.25,31.54-13.69,17.28-30.5,30.94-50.61,39.53s-55.89,13.37-76.7,10.37C160.31,175.82,182.28,130,200.09,107.56Zm-3.4,15.22s.91,17.31,1.77,24.83c.33,2.74-.57,4.41-2.67,6.09-5.61,4.5-18.17,16.4-18.17,16.4s16.69,4.59,23.75,5.9a6.62,6.62,0,0,1,5.58,4.82c2.61,6.71,9.61,22.17,9.61,22.17s9.85-14.74,13.47-21.26a5.62,5.62,0,0,1,5.31-3.28c7.45-.33,24.81-2.44,24.81-2.44s-11.1-13.87-16.18-19.33a5.62,5.62,0,0,1-1.45-5.79c1.87-7.21,5.32-24.67,5.32-24.67s-16.67,6.35-23.42,9.49a5.35,5.35,0,0,1-5.85-.45c-6.27-4-20.75-13.26-21.89-12.5Z"/><path fill="%23f6bb15" d="M179.83,239.1c-4.22-5.53-22.11-21.6-28.41-22.24,5.68-4,4.49-8.93,2.68-14.58-9.54-31.07-5.91-60.92-3-72.37,5.06-22.13,27.11-55.87,56.91-89,6.86,5.62,27.26,20.8,28.86,24-1.75,2.16-26.94,30.34-36.75,42.69-17.81,22.42-39.77,67.55-15.44,124.55C183.36,234.06,181.15,237.28,179.83,239.1Z"/><path fill="%23feb126" d="M243.26,39.84c.55.38,98.18,82.31,113.73,95.47,4.08,3.45,4.19,5.67.79,9.76q-3.06,3.68-6.14,7.34c-3.3,3.91-5.53,4.14-9.45,1-1.27-1-111.4-93-113.53-95.68Z"/><path fill="%23feb126" d="M111.84,365.83c4.42,5.82,4.55,8.28.74,14.52S105,392.84,101.1,399s-8.62,7-14.22,2.35L23.76,348.22c2.49-.19,31.61-27.32,32-27.86C60.86,324.92,111.69,365.6,111.84,365.83Z"/><path fill="%23fe9120" d="M347.06,171.72c10.28-4.42,23-.76,32.81,6.8,7.78,6,9.45,16,3.36,23.71-8.31,10.54-16.63,21.21-26.77,30.15-15.54,13.68-33.16,20.11-54.16,15.83-11.54-2.35-22.35-6.84-33.47-10.44-8.59-2.78-17.23-5.87-26.47-2.62-5.06,1.78-7.42,4.82-7.34,9.67a10,10,0,0,0,7.41,9.74c4.53,1.29,7,.06,10.42-4.94,2.19-3.28,5.57-4.29,8.55-2.49s3.66,5.09,1.81,8.7c-5.67,11-18.08,14.55-28.91,8.47-10.21-5.74-15.74-20.8-7.43-33.88,5.19-1,33.64-7.85,33.64-7.85,11.53,2.78,22.49,7.31,33.67,11.15,23.66,8.14,43.44,2.2,59.93-16,6.34-7,12.4-14.28,18.48-21.53,3.08-3.68,2.51-6.11-1.49-8.88-7-4.78-14.45-5.6-22.45-3.32-6.85,2-13.66,3.45-20.66.57-4.05-1.71-11.55-7.5-11.55-7.5l8.15-9.4S336.78,176.14,347.06,171.72Z"/><path fill="%23fe9120" d="M173.84,37.22c1.42-8.84-1.23-16.54-7.58-22.93-2.36-2.38-5.07-3-7.29-.38-10,11.74-21,22.83-27.76,36.85s-6.5,28.17.16,41.94c6.11,12.63,13.09,24.83,19.69,37.23-2.91,11.45-3.56,23.11-3.22,34.86-.58.29-20.08,15.47-34.46-2.9-12-15.39,4.38-29.22,4.38-29.22,3.1-2.19,6.37-1.95,8.62.58s2,5.8-.75,8.53c-.46.47-6.42,5.9-3,12.12a10.08,10.08,0,0,0,10.93,4.82c4.35-.76,7.13-3.66,7.83-8.4a31.08,31.08,0,0,0-2.68-17.13c-5-11.5-12.12-21.87-17.48-33.19-9.31-19.73-9.56-39.2,1.15-58.52,7.63-13.76,18.17-25.3,28.69-36.76,5.86-6.37,15.76-6.13,22.46-.24C183.6,13.34,187.87,24.75,186,37.82c-1.92,11.27,8.13,19.27,8.13,19.27l-7.68,9.71S170.92,57.73,173.84,37.22Z"/><path fill="%23fe9120" d="M3.79,331.62c-5.15-4.47-5-9.3.12-13.89q8.79-7.86,17.66-15.63c4.57-4,8.47-4,13.17-.21,3.31,2.69,17.5,14.82,21,18.47-.41.53-29.49,27.67-32,27.86C17.08,342.7,10.32,337.3,3.79,331.62Z"/><path fill="%23fe9120" d="M205.06,38.31c-4.05-3.45-4.3-5.68-.93-9.76,2.45-3,5-5.9,7.51-8.79,2.24-2.53,4.87-2.74,7.39-.61,8.13,6.84,16.16,13.78,24.23,20.69l-14.6,17.89C221.77,52.15,206.06,39.15,205.06,38.31Z"/><path fill="%23fdd8a7" d="M86.66,307.34c12.8,13.23,3.2,23.81,1.2,24.81.24-6.65-16.75-19.94-23-25.79s-13.72-6.29-21.07-1.42c-1.64-5.33,1.57-12.24,6.93-15.45,4.59-2.75,9.36-2.43,14.26-1.34C66.77,288.36,80,302.62,86.66,307.34Z"/><path fill="%23fdd8a7" d="M107,284.15h0c3.89,7.71-2.47,19.94-3.93,20.22-.11-7.59-16.39-20.48-21.44-24.59C72.9,272.64,69.11,272,59.06,277c-.23-.45,2.09-20,20.17-16.69C86.38,261.05,106.72,283.86,107,284.15Z"/><path fill="%23f3c18c" d="M86.65,307.33c-6.67-4.72-19.88-19-21.67-19.15-2.92-3.23-5.76-6.53-5.92-11.23,10-5,13.84-4.31,22.6,2.83,5,4.11,21.44,16.36,21.44,24.59C99.42,308.49,87.65,307.51,86.65,307.33Z"/><path fill="%23f3c18c" d="M75.47,336.41c-5-1.52-25.84-22-31-26.27-.29-1.64-.39-3.52-.68-5.16,7.35-4.87,15-4.33,21.07,1.42s23,18.51,23,25.75C84.54,335.51,79.92,336.41,75.47,336.41Z"/><path fill="%23f3c18c" d="M81.72,261.11c-7.71-4-2.66-12.06,1.45-17.73,5.25-.74,43.42,25.12,31.42,41.47a10.59,10.59,0,0,1-7.52-.7h0C106.76,283.89,90,265.39,81.72,261.11Z"/><path fill="%23f3c18c" d="M100.82,230.58c1.21-.52,16.43-3.34,21.43,1.86,1.61,1.67,1.5,2.67-.07,4.22-2.72,2.71-5.73,5.17-7.84,8.47-1.08,1.71-2.28,1.29-3.56,0-2.24-2.26-4.6-4.39-6.92-6.57A15,15,0,0,1,100.82,230.58Z"/><path fill="%23f6bb15" d="M144.57,260.24c11.72-6.71,17.29,4,11.72,11.14s-5.54,7.07-60.37,81.62c0,0-16.49-12-20.44-16.59,15.66.5,24.2-16.59,11.2-29.08,23.44,3.06,22.35-17.18,20.35-23.18C120.35,290.63,136.63,264.64,144.57,260.24Z"/></svg>') no-repeat right center;
            opacity: .5;
            background-size: contain;
            height: 90%;
            width: 100%;
            position: absolute;
            right: 9px;
            bottom: 0;
            content: '';
            z-index: -1
        }

        .VideoBox .card {
            padding: 0;
            overflow: hidden;
            box-shadow: 0 0 16px rgb(var(--blackrgb)/.1) !important;
            border: none !important;
            border-radius: 5px;
            margin: 9px 0 20px
        }

        .VideoBox .card>* {
            border-radius: 0 !important;
            border: none
        }

        .VideoBox .card .card-header {
            position: relative;
            height: 185px;
            line-height: 0;
            padding: 0;
            transition: all .5s
        }

        .VideoBox .card .card-header .playVideo {
            position: absolute;
            height: 100%;
            width: 100%;
            left: 0;
            top: 0;
            z-index: 9;
        }

        .VideoBox .card .card-body {
            text-align: center
        }

        .VideoBox .card .card-body h3 {
            font-size: 18px !important;
            margin: 0 0 5px;
            color: var(--thm3) !important;
            font-weight: 500;
            display: -webkit-box;
            overflow: hidden;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1
        }

        .VideoBox .card img {
            width: 100%;
            height: auto;
            border-radius: 5px
        }

        .VideoBox .card .video {
            position: relative;
            display: block;
            width: 100%
        }

        .VideoBox .card .video::after {
            position: absolute;
            content: '';
            z-index: 9;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgb(0 0 0/0)
        }

        .VideoBox .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 16px rgb(var(--blackrgb)/.2) !important
        }

        .VideoBox .card:hover .card-body {
            background: rgb(var(--thmrgb)/.06)
        }
@media (max-width:767px){.TopBoxs>div{display:block}
.TopBoxs{min-height:136px!important}
.TopBoxs p{line-height:normal!important}}
    </style>
@endpush
@push('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {
            'packages': ['bar']
        });

        function getgraf(){
            $.ajax({
                data:{_token:$('meta[name=csrf-token]').attr('content'),year:$('#grafyear').val()},
                method:"Post",
                dataType:'Json',
                url:@json(route('expert.dashboardgraf')),
                success:function(response){
                    drawChart(response.data)
                }
            });
        }
        
        google.charts.setOnLoadCallback(getgraf);

        function drawChart(dynamicresponse) {
            var data = google.visualization.arrayToDataTable(dynamicresponse);
            var options = {
                chart: {
                    // title: 'Company Performance',
                    subtitle: 'Year '+$('#grafyear').val(),
                }
            };
            var chart = new google.charts.Bar(document.getElementById('multi'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
@endpush
