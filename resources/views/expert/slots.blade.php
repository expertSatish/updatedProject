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
                    <li class="breadcrumb-item"><a aria-current="page">Availability Slots</a></li>
                </ol>
                <div class="row MainBoxAc">
                    <div class="col-md-3">
                        <div class="position-sticky top-0">
                            <x-expert.left-bar />
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="pb-2 d-block d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h3 class="m-0 h4">Availability Slots</h3>
                            </div>
                        </div>
                        <div class="card UserBox p-0 EditSlots ">
                            @php
                                $Year = request('year');
                                $Month = request('month');
                                if (empty($Year) && empty($Month)) {
                                    $startMonth = \Carbon\Carbon::now()
                                        ->startOfMonth()
                                        ->format('Y-m-d');
                                    $endMonth = \Carbon\Carbon::now()
                                        ->endOfMonth()
                                        ->format('Y-m-d');
                                }
                                if (!empty($Year) && empty($Month)) {
                                    $startMonth = \Carbon\Carbon::createFromFormat('Y-m-d', $Year . '-m-01')
                                        ->startOfMonth()
                                        ->format('Y-m-d');
                                    $endMonth = \Carbon\Carbon::createFromFormat('Y-m-d', $Year . '-m-01')
                                        ->endOfMonth()
                                        ->format('Y-m-d');
                                }
                                if (!empty($Year) && !empty($Month)) {
                                    $startMonth = \Carbon\Carbon::createFromFormat('Y-m-d', $Year . '-' . $Month . '-01')
                                        ->startOfMonth()
                                        ->format('Y-m-d');
                                    $endMonth = \Carbon\Carbon::createFromFormat('Y-m-d', $Year . '-' . $Month . '-01')
                                        ->endOfMonth()
                                        ->format('Y-m-d');
                                }
                            @endphp
                            <form class="card-body fltform px-sm-3 px-2 py-3 d-flex justify-content-between align-items-start">
                                @csrf
                                <div>
                                    <select class="form-control form-select" name="year"
                                        onchange="$('.fltform').submit();">
                                        @for ($A = 2023; $A <= date('Y', strtotime('+1 year' . date('Y-m-d'))); $A++)
                                            <option value="{{ $A }}" @selected($A == request('year', date('Y')))>
                                                {{ $A }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div><a href="{{ route('expert.copyslotfornextweek', ['start' => $startMonth, 'end' => $endMonth]) }}"
                                        class="btn btn-thm3 btn-sm m-0">Copy Next Week</a></div>
                                <div>
                                    <select class="form-control form-select" name="month"
                                        onchange="$('.fltform').submit();">
                                        <option value="1" @selected(1 == request('month', date('m')))>January</option>
                                        <option value="2" @selected(2 == request('month', date('m')))>February</option>
                                        <option value="3" @selected(3 == request('month', date('m')))>March</option>
                                        <option value="4" @selected(4 == request('month', date('m')))>April</option>
                                        <option value="5" @selected(5 == request('month', date('m')))>May</option>
                                        <option value="6" @selected(6 == request('month', date('m')))>June</option>
                                        <option value="7" @selected(7 == request('month', date('m')))>July</option>
                                        <option value="8" @selected(8 == request('month', date('m')))>August</option>
                                        <option value="9" @selected(9 == request('month', date('m')))>September</option>
                                        <option value="10" @selected(10 == request('month', date('m')))>October</option>
                                        <option value="11" @selected(11 == request('month', date('m')))>November</option>
                                        <option value="12" @selected(12 == request('month', date('m')))>December</option>
                                    </select>
                                </div>
                            </form>
                            <div class="w-100 d-block">
                                <div class="SlotingDate text-center">
                                    @for ($i = $startMonth; $i <= $endMonth; $i++)
                                        @php $checkav = \App\Models\SlotAvailability::where(['date'=>$i,'expert_id'=>expertinfo()->id])->get(); @endphp
                                        <div class="sitem {{ date('Y-m-d') > date('Y-m-d', strtotime($i)) ? 'no-drop' : '' }}">
                                            <div class="DateS" style="color: #000;">
                                                {{ date('D', strtotime($i)) }} <br>
                                                <h6>{{ date('d-M', strtotime($i)) }}</h6>
                                            </div>
                                            <ul>
                                                @foreach ($checkav as $avai)
                                                <li>
                                                    <span>{{ date('H:i', strtotime($avai->from_time)) }}-{{ date('H:i', strtotime($avai->to_time)) }}
                                                        <a href="#AddTime" data-bs-modaltype="editavailability"
                                                            data-bs-from="{{ $avai->from_time }}"
                                                            data-bs-to="{{ $avai->to_time }}"
                                                            data-bs-id="{{ $avai->id }}"
                                                            data-bs-date="{{ date('Y-m-d', strtotime($i)) }}"
                                                            data-bs-datetype="{{ date('D (d-M)', strtotime($i)) }}"
                                                            data-bs-type="{{ date('D', strtotime($i)) }}"
                                                            data-bs-toggle="modal" class="Edit"></a>
                                                        <span><i class="far fa-clock"></i>
                                                            @foreach ($booktimes as $booktime)
                                                                {{ $booktime->time->minute }}{{ !$loop->last ? ', ' : 'min' }}
                                                            @endforeach
                                                        </span>
                                                    </span>
                                                    <a href="#DeleteModal" data-bs-toggle="modal"
                                                        onclick="$('.removerecord').attr('href','{{ route('expert.removeavailability', ['id' => $avai->id]) }}');"></a>
                                                </li>
                                                @endforeach
                                                <li><a href="#AddTime" data-bs-date="{{ date('Y-m-d', strtotime($i)) }}"
                                                        data-bs-datetype="{{ date('D (d-M)', strtotime($i)) }}"
                                                        data-bs-type="{{ date('D', strtotime($i)) }}" class="sws-top sws-bounce"
                                                        data-bs-toggle="modal" data-title="Add Availability"><i
                                                            class="fal fa-plus-circle"></i></a></li>
                                            </ul>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('css')
<title>Manage Slots : {{ project() }}</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<link rel="stylesheet" href="{{ asset('frontend/css/account.css') }}">
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" onload="this.rel='stylesheet'" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer">
<style>
.slick-track{display:flex!important}
.owl-nav{top:20px;bottom:auto!important}
.owl-nav button.owl-prev{left:0!important}
.owl-nav button.owl-next{right:0!important}
.owl-nav button.owl-next,.owl-nav button.owl-prev{width:24px!important;height:36px!important;margin:0!important}
.DateS{border-bottom:1px solid rgb(var(--blackrgb)/.1);border-top:1px solid rgb(var(--blackrgb)/.1);border-left:1px solid rgb(var(--blackrgb)/.1);margin-bottom:9px;padding-bottom:6px;/*margin-top:9px;*/padding-top:6px;font-size:13px;color:rgb(var(--blackrgb)/.5);background:rgb(var(--blackrgb)/.05)}
.DateS>span{margin:0;color:var(--black)}
.UserBox>div{align-items:start}
.SlotingDate{align-items:flex-start!important;overflow:hidden;display:flex}
.SlotingDate div.sitem{min-width:14.285%}
.SlotingDate div.sitem.no-drop{opacity:.6}
.SlotingDate div.sitem.no-drop ul li a,.SlotingDate div.sitem.no-drop ul li>span{cursor:not-allowed;pointer-events:none}
.SlotingDate ul{margin:0 auto;padding:0;width:calc(100% - 30px)}
.SlotingDate ul li{margin-bottom:6px;position:relative}
.SlotingDate ul li>a,.SlotingDate ul li>span{background:rgb(var(--thmrgb3)/.05);border:1px solid rgb(var(--thmrgb3)/.1);padding:2px 6px;border-radius:3px;display:inline-block;font-size:13px;cursor:pointer;width:100%;line-height:150%;font-weight:600}
.SlotingDate ul li>a>span,.SlotingDate ul li>span>span{display:block;color:rgb(var(--blackrgb)/.6);font-weight:400;font-size:11px}
.SlotingDate ul li.book>a,.SlotingDate ul li.book>span{background:none;border-color:#ffc107!important;cursor:inherit}
.SlotingDate ul li button{background:var(--thm) url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") no-repeat 4px center/7px auto;border:none;height:15px;width:15px;border-radius:50%;position:absolute;top:-4px;right:-4px;opacity:0;transition:all .5s}
.SlotingDate ul li:hover button{opacity:1}
.EditSlots .SlotingDate ul li:last-child>a,.EditSlots .SlotingDate ul li:last-child>span{background:var(--thm);color:var(--white)}
.SlotingDate>button.slick-arrow{border:none;border-radius:0 5px 5px 0;cursor:pointer;width:24px!important;height:36px!important;margin:0!important;opacity:.6;display:flex;align-items:center;justify-content:center;position:absolute;color:var(--black)!important;background:var(--white)!important;top:20px;left:0;box-shadow:3px 0 5px rgb(var(--blackrgb)/.2);z-index:1;transition:all .5s}
.SlotingDate>button.slick-arrow.owl-next{right:0;left:auto;border-radius:5px 0 0 5px;box-shadow:-3px 0 5px rgb(var(--blackrgb)/.2)}
.SlotingDate>button.slick-arrow:hover{background:var(--thm)!important;color:var(--white)!important;opacity:1}
.SlotingDate ul li button,.SlotingDate ul li>span+a{background:var(--thm) url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") no-repeat 4px center/7px auto;border:none;height:15px;width:15px;border-radius:50%;position:absolute;top:-4px;right:-4px;opacity:0;z-index:9;transition:all .5s}
.SlotingDate ul li:hover button,.SlotingDate ul li:hover>span+a{opacity:1}
.Edit{position:absolute;height:100%;width:100%;left:0;top:0;z-index:2;background:rgb(var(--thmrgb)/.5);opacity:0}
.SlotingDate ul li:hover>span .Edit{opacity:1}
#AddTime .form-select,.TimeBoxIn input{border-radius:1.5rem;padding:.6rem .75rem;font-size:15px}
.TimeBoxIn{flex-wrap:nowrap!important}
.TimeBoxIn>*{width:50%}
.TimeBoxIn>span:first-child input{border-right:none!important;border-radius:1.5rem 0 0 1.5rem}
.TimeBoxIn>span:last-child input{border-radius:0 1.5rem 1.5rem 0}
.slick-track{margin-left:0!important}
.no-drop{cursor:not-allowed}
@media (max-width:450px){.form-select{background-position:right .3rem center;padding:.25rem 1.1rem .25rem .4rem;background-size:10px;font-size:14px}}
@media (max-width:350px){.form-select{font-size:13px}}
</style>
@endpush
@push('js')
    <div class="modal fade" id="AddTime" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="AddTimeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <form class="modal-content availabilityform">
                @csrf
                <input type="hidden" name="Available_for">
                <input type="hidden" name="Available_date">
                <input type="hidden" name="preid">
                <div class="modal-header">
                    <h2 class="h5 modal-title" id="Availabilitybox">Set Availability Slot</h2>
                    <button type="button" class="btn-close" onclick="window.location.reload()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body py-3 p-4">
                    <div class="input-group TimeBoxIn">
                        <span>
                            <label class="ms-2"><small>From</small></label>
                            <input type="time" class="form-control" name="from_time" placeholder="Time">
                        </span>
                        <span>
                            <label class="ms-2"><small>To</small></label>
                            <input type="time" class="form-control" name="to_time" placeholder="Time">
                        </span>
                    </div>
                    <span class="error fromavailability-error mb-3"></span><br>
                    <span class="error toavailability-error mb-3"></span>
                    <p class="mt-2"><small><b>NOTE:</b>
                            @foreach ($booktimes as $booktime)
                                {{ $booktime->time->minute }} minutes{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                            slots will be booked by the user.
                        </small></p>
                    <div class="text-center mt-3">
                        <button class="btn btn-thm2 asbtn">Set Availability</button>
                        <button class="btn btn-thm2 apbtn" style="display:none" disabled><i
                                class="fad fa-spinner-third me-2 fa-spin"></i> Loading...</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="slotpricing" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddTimeLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <form class="modal-content saveslottime">
                @csrf
                <div class="modal-header">
                    <h2 class="h5 modal-title" id="AddTimeLabel">Slot Pricing</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3 p-4">
                    @foreach ($times as $item)
                        @php
                            $price = \App\Models\SlotCharge::where(['expert_id' => expertinfo()->id, 'slot_time_id' => $item->id])->first();
                        @endphp
                        <div class="from-group mb-2">
                            <label><small>{{ $item->minute }} Minutes Charges ({{ defaultcurrency() }})</small></label>
                            <input type="text" class="form-control" name="charges[{{ $item->id }}]"
                                value="{{ $price->charges ?? expertinfo()->charge }}" placeholder="Eg: $240">
                        </div>
                    @endforeach
                    <span class="error charges-error mb-3"></span>
                    <div class="text-center">
                        <button class="btn btn-thm2 sbtn">Confirm & Proceed</button>
                        <button class="btn btn-thm2 pbtn" style="display: none" disabled><i
                                class="fad fa-spinner-third me-2 fa-spin"></i> Loading...</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let initialSlide = @json(date('d'));
        let Month = {{ $Month ?? date('m')}};
        if(Month=="{{date('m')}}"){ initialSlide = @json(date('d'));}
        if(Month!="{{date('m')}}"){ initialSlide = 0;}
        if(initialSlide < 7){ initialSlide = 0; }
        if(initialSlide > 7 && initialSlide < 15){ initialSlide = 7; }
        if(initialSlide > 14 && initialSlide < 22){ initialSlide = 14; }
        if(initialSlide > 21 && initialSlide < 29){ initialSlide = 21; }
        $(document).ready(function() {
            $('.SlotingDate').slick({
                infinite: false,
                slidesToShow: 7,
                slidesToScroll: 7,
                initialSlide:initialSlide,
                nextArrow: '<button class="owl-next"><i class="fal fa-chevron-right"></i></button>',
                prevArrow: '<button class="owl-prev"><i class="fal fa-chevron-left"></i></button>',
                responsive:[{breakpoint:280,settings:{slidesToShow:2,slidesToScroll:2,}},{breakpoint:380,settings:{slidesToShow:3,slidesToScroll:3,}},{breakpoint:575,settings:{slidesToShow:4,slidesToScroll:4,}},{breakpoint:768,settings:{slidesToShow:5,slidesToScroll:5,}},{breakpoint:992,settings:{slidesToShow:5,slidesToScroll:5,}},{breakpoint:1200,settings:{slidesToShow:6,slidesToScroll:6,}},{breakpoint:1600,settings:{slidesToShow:7,slidesToScroll:7,}},{breakpoint:1920,settings:{slidesToShow:7,slidesToScroll:7,}}]
            });
        });
        $('.saveslottime').on('submit', function(e) {
            e.preventDefault();
            $('.sbtn').hide();
            $('.pbtn').show();
            $('.error').html('');
            $.ajax({
                data: new FormData(this),
                url: @json(route('expert.addexpertslotprice')),
                method: 'POST',
                dataType: 'Json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    toastr.success(data.success);
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                    $('.sbtn').show();
                    $('.pbtn').hide();
                },
                error: function(response) {
                    if (response.responseJSON.errors.charges !== undefined) {
                        $('.charges-error').text(response.responseJSON.errors.charges);
                    }
                    $('.sbtn').show();
                    $('.pbtn').hide();
                }
            });
        });

       setInterval(() => {
            $('[data-bs-type]').on('click', function() {
                let day = $(this).attr('data-bs-type');
                let date = $(this).attr('data-bs-date');
                let type = $(this).attr('data-bs-modaltype');
                let datetype = $(this).attr('data-bs-datetype');
                if (type == 'editavailability') {
                    $('input[name=preid]').val($(this).attr('data-bs-id'));
                    $('input[name=from_time]').val($(this).attr('data-bs-from'));
                    $('input[name=to_time]').val($(this).attr('data-bs-to'));
                } else {
                    $('.availabilityform').trigger('reset');
                }
                
                $('#Availabilitybox').html(datetype + ' Availability');
                $('input[name=Available_for]').val(day);
                $('input[name=Available_date]').val(date);
            });
       }, 1000);

        $('.availabilityform').on('submit', function(e) {
            e.preventDefault();
            $('.asbtn').hide();
            $('.apbtn').show();
            $('.error').html('');
            $.ajax({
                data: new FormData(this),
                url: @json(route('expert.expertslotavailability')),
                method: 'POST',
                dataType: 'Json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    toastr.success(data.success);
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                    $('.asbtn').show();
                    $('.apbtn').hide();
                },
                error: function(response) {
                    if (response.responseJSON.errors.from_time !== undefined) {
                        $('.fromavailability-error').text(response.responseJSON.errors.from_time);
                    }
                    if (response.responseJSON.errors.to_time !== undefined) {
                        $('.toavailability-error').text(response.responseJSON.errors.to_time);
                    }
                    $('.asbtn').show();
                    $('.apbtn').hide();
                }
            });
        });
    </script>
@endpush
