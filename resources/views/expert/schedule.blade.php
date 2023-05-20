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
                    <li class="breadcrumb-item"><a href="{{ route('expert.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a
                            aria-current="page">{{ ucwords(str_replace('-', ' ', request()->segment(2))) }} Calls</a></li>
                </ol>
                <div class="row MainBoxAc">
                    <div class="col-md-3">
                        <div class="position-sticky top-0">
                            <x-expert.left-bar />
                        </div>
                    </div>
                    <div class="col-md-9">
                        <form action="" method="post" class="card UserBox">
                            <div class="card-body d-block">
                                @if ($bookings->count() == 0)
                                    <div class="mt-0 mb-4 text-center w-100">
                                        <x-data-not-found data="Schedules" />
                                    </div>
                                @endif

                                @if ($bookings->count() > 0)
                                    <div class="Dtable text-center">
                                        <div class="Thead">
                                            <div>#</div>
                                            <div class="text-start">User Information</div>
                                            <div>Schedule</div>
                                            <div>Link</div>
                                            <div>Other</div>
                                        </div>
                                        @foreach ($bookings as $booking)
                                        @php
                                            $Start = date('Y-m-d H:i', strtotime('-60 minutes' . $booking->booking_date . ' ' . $booking->booking_start_time));
                                            $End = $booking->booking_date . ' ' . $booking->booking_end_time;
                                        @endphp
                                        
                                            <div class="Tbody">
                                                <div class="cell num"></div>
                                                <div class="cell text-start" data-label="User Information">
                                                    <h3 class="h5 thm fw-bold mb-1">{{ $booking->user_name ?? '' }}</h3>
                                                    <p class="fw-lighter m-0 thm">Booking ID : #{{ $booking->booking_id }}
                                                    </p>
                                                    @if ($booking->payment == 1 || $booking->payment == 3)
                                                        @if ($booking->reschedule_slot == 0)
                                                            @if ($booking->status == 0)
                                                                <small class="text-secondary fw-semibold PaymentS"><i
                                                                        class="fad fa-circle"></i> New Booking</small><br>
                                                            @endif
                                                            @if ($booking->status == 1)
                                                                <small class="text-success fw-semibold PaymentS"><i
                                                                        class="fad fa-circle"></i> Booking
                                                                    Confirm</small><br>
                                                            @endif
                                                            @if ($booking->status == 2)
                                                                <small class="text-danger fw-semibold PaymentS"><i
                                                                        class="fad fa-circle"></i> Booking
                                                                    Rejected</small><br>
                                                            @endif
                                                            @if ($booking->status == 3)
                                                                <small class="text-success fw-semibold PaymentS"><i
                                                                        class="fad fa-circle"></i> Booking Done &
                                                                    Closed</small><br>
                                                            @endif
                                                        @endif
                                                    @endif
                                                    @if ($booking->payment == 0)
                                                        <small class="text-secondary fw-semibold PaymentS"><i
                                                                class="fad fa-circle"></i> Payment Pending</small>
                                                    @endif
                                                    @if ($booking->payment == 1)
                                                        <small class="text-success fw-semibold PaymentS"><i
                                                                class="fad fa-circle"></i> Paid By Online</small>
                                                    @endif
                                                    @if ($booking->payment == 2)
                                                        <small class="text-danger fw-semibold PaymentS"><i
                                                                class="fad fa-circle"></i> Payment Failed</small>
                                                    @endif
                                                    @if ($booking->payment == 3)
                                                        <small class="text-primary fw-semibold PaymentS"><i
                                                                class="fad fa-circle"></i> Paid By Wallet</small>
                                                    @endif
                                                </div>
                                                <div class="cell" data-label="Schedule">
                                                    <p class="m-0 fw-semibold thm">
                                                        {{ date('D, d M Y', strtotime($booking->booking_date)) }}
                                                    </p>
                                                    <small
                                                        class="text-primary">{{ date('H:i A',strtotime($booking->booking_start_time)) }}
                                                         to {{ date('H:i A',strtotime($booking->booking_end_time)) }} </small>
                                                    @if ($booking->call_end_by == 0)
                                                        @if ($booking->call_invitation == 1)
                                                            <br><small class="text-success"><i class="fad fa-circle"
                                                                    style="font-size: 8px;"></i>
                                                                Invitation Sent</small>
                                                        @endif
                                                        @if ($booking->call_invitation == 2)
                                                            <br><small class="text-success"><i class="fad fa-circle"
                                                                    style="font-size: 8px;"></i> Invitation
                                                                Accept & Join</small>
                                                        @endif
                                                    @else
                                                        <br><small class="text-danger">
                                                            This call closed by
                                                            {{ $booking->call_end_by_type == 1 ? 'You' : 'Customer' }}
                                                        </small>
                                                    @endif                                                    
                                                    @if ($booking->payment == 1 || $booking->payment == 3)
                                                        @php
                                                            $DSechStart = date('Y-m-d H:i', strtotime('-8 hours' . $booking->booking_date . ' ' . $booking->booking_start_time));
                                                        @endphp
                                                        @if ($booking->reschedule_slot == 0 && $booking->call_invitation == 0 && date('Y-m-d H:i') < $DSechStart)
                                                            <a href="#ChangeSchedulCall"
                                                                onclick="$('input[name=bookingid]').val({{ $booking->id }});"
                                                                class="btn btni btn-thm3 btn-sm mt-2"
                                                                data-bs-toggle="modal">Reschedule</a>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="cell" data-label="Link">
                                                    @if(date('Y-m-d H:i') > date('Y-m-d H:i', strtotime($End)))
                                                    <br><small class="text-danger"><i class="fad fa-circle"
                                                        style="font-size: 8px;"></i> This schedule is out of date </small>
                                                    @endif

                                                    @if ($booking->reschedule_slot == 0 && $booking->status == 1 && date('Y-m-d H:i') <= date('Y-m-d H:i', strtotime($End)))
                                                        @if (date('Y-m-d H:i') >= $Start && date('Y-m-d H:i') <= date('Y-m-d H:i', strtotime('+10 minutes' . $End)))
                                                            <a href="{{ route('expert.videocall', ['schedule' => $booking->booking_id]) }}"
                                                                class="h5 text-primary"><button type="button" class="btn btn-success"> <i class="fal fa-video me-1"></i> Join Now</button></a>
                                                        @else
                                                        <span class="SessionLink"><a href="{{ route('expert.videocall', ['schedule' => $booking->booking_id]) }}" class="h5 text-primary disabled"><button type="button" class="btn btn-success"> <i class="fal fa-video me-1"></i> Join Now</button></a></span>
                                                        @endif                                                       
                                                    @endif
                                                    @if ($booking->reschedule_slot > 0)
                                                        <small class="text-primary"><i class="fad fa-circle"
                                                                style="font-size: 8px;"></i> Reschedule Slot & New Booking
                                                            Id #{{ $booking->reschedule->booking_id ?? 0 }}</small>
                                                    @endif
                                                    @if ($booking->refund > 0)
                                                        <small class="text-success">Refunded &#8377;
                                                            {{ $booking->refund ?? 0 }}</small>
                                                    @endif
                                                </div>
                                                <div class="cell text-end">
                                                    @if ($booking->reschedule_slot == 0 && in_array($booking->payment,[1,3]) && date('Y-m-d H:i') >= $Start && date('Y-m-d H:i') <= date('Y-m-d H:i', strtotime($End)))
                                                        <button class="SendMessage small sbtn" type="button"
                                                            onclick="$('input[name=to_recipient_email]').val('{{ $booking->user->email ?? $booking->user_email }}')"
                                                            data-title="Message"><i class="far fa-comment-alt-lines"></i>
                                                            Message</button>
                                                    @endif
                                                    <a href="{{ route('expert.scheduleinfo', ['booking' => $booking->booking_id]) }}"
                                                        class="small sbtn"><i class="far fa-info-circle"></i> Slot
                                                        Information</a>
                                                    <a href="{{ route('expert.questionnaire', ['booking' => $booking->booking_id]) }}"
                                                        class="small sbtn"><i class="far fa-question-circle"></i>
                                                        Questionnaire
                                                        @if (empty($booking->query) ||
                                                                empty($booking->experience_query) ||
                                                                empty($booking->facing_challenges_query) ||
                                                                empty($booking->ask_question_query))
                                                            <i class="fas fa-exclamation-circle text-warning"></i>
                                                        @endif
                                                        @if (
                                                            !empty($booking->query) &&
                                                                !empty($booking->experience_query) &&
                                                                !empty($booking->facing_challenges_query) &&
                                                                !empty($booking->ask_question_query))
                                                            <i class="fas fa-check-circle text-success"></i>
                                                        @endif
                                                    </a>

                                                    @if (!empty($booking->call_recording_id))
                                                        <a href="#DownloadRecording"
                                                            data-bs-recording="{{ $booking->call_recording_id }}"
                                                            data-bs-meeting="{{ $booking->call_meeting_code }}"
                                                            class="small sbtn text-primary" data-bs-toggle="modal">
                                                            <i class="fal fa-download"></i> Download Recording</a>
                                                    @endif

                                                    @if ($booking->call_invitation == 0 && $booking->reschedule_slot == 0 && $booking->status != 2 && in_array($booking->payment,[1,3]) && date('Y-m-d H:i') >= $Start && date('Y-m-d H:i') <= date('Y-m-d H:i', strtotime($End)))
                                                        <a href="#rejected" data-bs-toggle="modal"
                                                            data-bs-url="{{ route('expert.scheduleconfirm', ['confirm' => 2, 'schedule' => $booking->id]) }}"
                                                            class="small sbtn text-danger"><i
                                                                class="fas fa-times-circle"></i> Cancel the session</a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small><b>NOTE:</b> You can make video call 1 hour before slot time</small>
                                @endif
                            </div>
                        </form>
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
    <link rel="preload" as="style" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css"
        onload="this.rel='stylesheet'"
        integrity="sha512-160haaGB7fVnCfk/LJAEsACLe6gMQMNCM3Le1vF867rwJa2hcIOgx34Q1ah10RWeLVzpVFokcSmcint/lFUZlg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .SessionLink{cursor:not-allowed}
        .SessionLink a.disabled{pointer-events:none;opacity:.5}
        .Dtable {
            border: 1px solid rgb(var(--blackrgb)/.1);
            display: table;
            width: 100%;
        }

        .Dtable>div {
            display: table-row
        }

        .Dtable .Thead {
            background: var(--thm);
            color: var(--white)
        }

        .Dtable .Tbody {
            counter-increment: slides-num;
        }

        .Dtable .Thead>div,
        .Dtable .Tbody>div {
            padding: 15px;
            ;
            display: table-cell;
            width: 24%;
            vertical-align: middle;
        }

        .Dtable .Thead>div {
            padding: 9px 15px;
        }

        .Dtable .Tbody>div {
            border-top: 1px solid rgb(var(--blackrgb)/.1)
        }

        .Dtable .Thead>div:first-child,
        .Dtable .Tbody>div:first-child {
            width: 4%;
            /*vertical-align:top*/
        }

        .Dtable .Tbody>div:first-child:after {
            content: " "counter(slides-num)"."
        }

        .PaymentS {
            font-size: 11px
        }

        .PaymentS.text-success i {
            font-weight: 600 !important
        }

        .sbtn {
            display: inline-block;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            white-space: nowrap;
            margin-left: auto !important;
            width: 172px;
            border-radius: 5px;
            padding: 7px 12px;
            box-shadow: 0 4px 4px rgb(var(--blackrgb)/.2);
            margin-bottom: 5px;
            text-align: left
        }

        .sbtn:last-child,
        .sbtn i {
            margin: 0
        }

        .sbtn i {
            font-size: 17px
        }

        .sbtn i:last-child {
            margin-left: 6px;
        }

        .sbtn i:first-child {
            margin: 0;
            margin-right: 6px;
        }

        .btn-thm3.btn-sm {
            font-size: 12px !important;
            line-height: 23px
        }

        .DataTable {
            font-size: 15px
        }

        table.dataTable {
            margin: 0 !important
        }

        .dataTables_wrapper>.row:first-child {
            margin-bottom: 9px !important
        }

        .DataTable>:not(caption)>*>* {
            padding: .6rem 1rem !important;
            vertical-align: middle
        }

        .DataTable>thead>tr>th:not(.sorting_disabled),
        .DataTable>thead>tr>td:not(.sorting_disabled) {
            padding-right: 25px !important
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
            font-weight: 500 !important
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

        .DataTable tbody tr {
            counter-increment: slides-num
        }

        .DataTable tbody tr td:first-child:after,
        .DataTable tbody tr th:first-child:after {
            content: " "counter(slides-num)"."
        }

        .badge {
            font-weight: 400 !important;
            font-size: 12px !important;
            line-height: 14px !important;
            border-radius: 15px !important
        }

        .btni {
            height: 32px;
            min-width: 32px;
            padding: 0 12px !important;
            margin: 0 0 5px;
            display: inline-flex !important;
            justify-content: center;
            align-items: center;
            border-radius: 20px !important;
            background: none !important;
            border-color: transparent !important;
            color: rgb(var(--blackrgb)/.7) !important;
        }

        .btni:hover,
        .btni.btn-success {
            border-color: var(--bs-btn-border-color) !important;
            background: var(--bs-btn-bg) !important;
            color: var(--bs-btn-color) !important;
        }

        .btni i {
            font-size: 18px
        }

        .btni span {
            font-weight: 300;
            font-size: 13px
        }

        .btni.disable {
            opacity: .6;
            cursor: no-drop
        }

        .btni.disable.btn-success {
            border-color: #6c757d !important;
            background-color: #6c757d !important
        }

        .ProTable {
            display: flex;
            justify-content: space-between
        }

        .ProTable .img {
            max-width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden
        }

        .ProTable .img img {
            height: 100%;
            width: 100%;
            object-fit: cover
        }

        /* .ProTable>div:last-child{width:calc(100% - 60px)} */
        .ProTable h3 {
            font-size: 14px;
            display: -webkit-box;
            overflow: hidden;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            margin-bottom: 3px;
            line-height: 150% !important;
            font-weight: 600 !important
        }

        .ProTable p {
            font-size: 13px !important;
            margin: 0;
            line-height: normal !important;
            color: rgb(var(--blackrgb)/.6) !important
        }

        .star {
            margin: 0 !important;
            font-size: 16px !important
        }

        .TimeBox {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap
        }

        .TimeBox .btn {
            border-radius: 5px;
            margin-bottom: 8px;
            margin-right: 8px;
            font-weight: 500;
            min-width: 35px;
            padding: 5px;
            color: var(--thm3);
            background: rgb(var(--thmrgb)/.15)
        }

        .TimeBox>li>:checked[type=radio]+.btn,
        .TimeBox>li>:checked[type=checkbox]+.btn {
            background: var(--thm3);
            color: var(--white);
            border-color: var(--thm3)
        }

        .btn-check:disabled+.btn,
        .btn-check[disabled]+.btn {
            opacity: .5 !important
        }

        .btn-back {
            border: none;
            border-radius: 4px;
            background: rgb(var(--thmrgb)/.1);
            padding: 3px 9px;
            font-size: 14px
        }

        .modal-dialog.modal-sm {
            max-width: 355px
        }

        @media (max-width:767px) {
            .btni span {
                display: none
            }

            .UserBox {
                padding: 0 !important
            }

            .table-responsive table {
                white-space: nowrap
            }

            .dataTables_wrapper>.row:first-child>div:first-child {
                display: none
            }

            .table-responsive .dataTables_wrapper>.row:first-child+.row>div {
                overflow: auto
            }

            .table-responsive .dataTables_wrapper>.row:first-child+.row>div::-webkit-scrollbar {
                width: 3px;
                height: 3px;
                background-color: rgb(var(--blackrgb)/0)
            }

            .table-responsive .dataTables_wrapper>.row:first-child+.row>div::-webkit-scrollbar-thumb {
                background-color: rgb(var(--blackrgb)/.4);
                border-radius: 2px
            }

            .table-responsive .dataTables_wrapper>.row:first-child+.row>div::-moz-scrollbar {
                width: 3px;
                height: 3px;
                background-color: rgb(var(--blackrgb)/0)
            }

            .table-responsive .dataTables_wrapper>.row:first-child+.row>div::-moz-scrollbar-thumb {
                background-color: rgb(var(--blackrgb)/.4);
                border-radius: 2px
            }

            .table-responsive .dataTables_wrapper>.row:first-child+.row>div::-o-scrollbar {
                width: 3px;
                height: 3px;
                background-color: rgb(var(--blackrgb)/0)
            }

            .table-responsive .dataTables_wrapper>.row:first-child+.row>div::-o-scrollbar-thumb {
                background-color: rgb(var(--blackrgb)/.4);
                border-radius: 2px
            }
        }
    </style>
@endpush
@push('js')
    <div class="Delete modal fade" id="Delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="DeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <i class="fal fa-times fa-3x text-danger"></i>
                    <h3 class="mb-4">Please confirm to continue</h3>
                    <a href="#" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</a>
                    <a href="#" class="btn btn-danger">Continue</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade RighSide AddPro" id="ChangeSchedulCall" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="ChangeSchedulCallLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <form class="modal-content rescheduleform">
                @csrf
                <input type="hidden" name="bookingid">
                <div class="modal-header">
                    <h2 class="h5 modal-title" id="ChangeSchedulCallLabel">ReSchedule Call</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body PopupDetail py-3 p-4">
                    <div class="sTimeScreen">
                        <div class="ContainBOx">
                            <div class="row justify-content-between">
                                <div class="col-md-4 border-end">
                                    <h3 class="h4 thm fw-bold mb-3 d-flex justify-content-between align-items-center">Pick
                                        the Date</h3>
                                    <input type="hidden" onchange="gettimeslots()" class="form-control inlinecal d-none"
                                        id="dob" onchange="gettimeslots()" name="booking_date"
                                        placeholder="Date of Birth" value="{{date('Y-m-d')}}">
                                </div>
                                <div class="col-md-8">
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
                                <span class="h6">(Per Session)</span>
                            </div>
                            <input type="hidden" name="booking_price" value="0">
                            <button class="btn btn-thm4 bsbtn m-0">Confirm & Procced <i
                                    class="fal fa-chevron-right ms-2"></i></button>
                            <button type="button" class="btn btn-thm4 m-0 bpbtn" style="display: none" disabled><i
                                    class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade RighSide" id="rejected" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="ChangeSchedulCallLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <form class="modal-content rejectsche">
                @csrf
                <div class="modal-header">
                    <h2 class="h5 modal-title">Schedule Rejected</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body PopupDetail py-3 p-4">
                    <div class="col-12">
                        <small for="exampleFormControlTextarea1" class="form-label">Please enter the reason of reject this
                            schedule.</small>
                        <textarea class="form-control summernote" name="reason" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <small class="error bio-error"></small>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-thm4 bsbtn m-0">Confirm & Reject</button>
                    <button type="button" class="btn btn-thm4 m-0 bpbtn" style="display: none" disabled><i
                            class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade RighSide" id="bookinginfo" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="ChangeSchedulCallLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                @csrf
                <div class="modal-header">
                    <h2 class="h5 modal-title">Schedule Information</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bookinginfobox py-3 p-4">
                    <center><i class="fad fa-spinner-third fa-spin" style="font-size: 45px;"></i></center>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade RighSide" id="DownloadRecording" data-bs-keyboard="false" data-bs-backdrop="static"
        tabindex="-1" aria-labelledby="ChangeSchedulCallLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header p-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body recordingbox py-3 p-4">
                    <center>
                        <i class="fad fa-spinner-third fa-spin" style="font-size: 45px;"></i>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .flatpickr-calendar.inline {
            margin: 0 auto;
            box-shadow: none
        }
    </style>
    <script defer type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.11.4/dataTables.bootstrap5.min.js"
        integrity="sha512-nfoMMJ2SPcUdaoGdaRVA1XZpBVyDGhKQ/DCedW2k93MTRphPVXgaDoYV1M/AJQLCiw/cl2Nbf9pbISGqIEQRmQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
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

        $('[data-bs-url]').on('click', function() {
            let url = $(this).attr('data-bs-url');
            $('.rejectsche').attr('action', url);
        });
        $('[data-bs-type]').on('click', function() {
            let id = $(this).attr('data-bs-id');
            $('.bookinginfobox').html(
                '<center><i class="fad fa-spinner-third fa-spin" style="font-size: 45px;"></i></center>');
            if ($(this).attr('data-bs-type') == 'bookinginfo') {
                $('.bookinginfobox').load(@json(url('expert/bookinginformation')) + '/' + id);
            }
        });
        $('.rejectsche').on('submit', function() {
            $('.bsbtn').hide();
            $('.bpbtn').show();
            if ($('.summernote').summernote('code') == '') {
                $('.bio-error').html('reason filed is required.');
                $('.bsbtn').show();
                $('.bpbtn').hide();
                return false;
            } else {
                $('.rejectsche').submit();

            }
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
                        "enable": success.availabile
                        // "disable": [
                        //     function(date) {
                        //         return (
                        //             date.getDay() == success.notavailabile[0] ||
                        //             date.getDay() == success.notavailabile[1] ||
                        //             date.getDay() == success.notavailabile[2] ||
                        //             date.getDay() == success.notavailabile[3] ||
                        //             date.getDay() == success.notavailabile[4] ||
                        //             date.getDay() == success.notavailabile[5] ||
                        //             date.getDay() == success.notavailabile[6]
                        //         );
                        //     }
                        // ]
                    });
                }
            });
        }
        $('[data-bs-recording]').on('click', function() {
            const RecordingId = $(this).attr('data-bs-recording');
            const Meething = $(this).attr('data-bs-meeting');
            $('.recordingbox').html(
                '<center><i class="fad fa-spinner-third fa-spin" style="font-size: 45px;"></i></center>');
            $('.recordingbox').load(@json(url('downloadrecordingapi')) + '/' + RecordingId + '?Meething=' + Meething);
        });
        $('.rescheduleform').on('submit', function(e) {
            if ($('input[name=timing]').is(':checked') == false) {
                toastr.error('Please select appointment time slot.');
                return false;
            }
            e.preventDefault();
            $('.bsbtn').hide();
            $('.bpbtn').show();
            $.ajax({
                data: new FormData(this),
                url: @json(route('expert.bookingrescheduleprocess')),
                method: "Post",
                dataType: "Json",
                contentType: false,
                processData: false,
                success: function(success) {
                    toastr.success(success.success);
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            });
        });
    </script>

    <x-message-popup />
@endpush
