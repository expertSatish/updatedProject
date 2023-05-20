@extends('admin.layouts.app')
@section('content')
<div class="br-mainpanel br-profile-page">

    <div class="card shadow-base bd-0 rounded-0 widget-4">
        <div class="card-header ht-75">
            <div class="hidden-xs-down">
                <a href="" class="mg-r-10"><span class="tx-medium">{{count($data->slots)}}</span> Session</a>
            </div>
            <div class="tx-24 hidden-xs-down">
                <a href="{{ route('admin.users') }}" class="mg-r-10"><small style="font-size: 14px;">BACK</small></a>
            </div>
        </div>
        <div class="card-body">
            <div class="card-profile-img">
                <x-image-box>
                    <x-slot:image>{{$data->profile}}</x-slot>
                        <x-slot:path>/uploads/user/</x-slot>
                            <x-slot:alt>{{$data->name ?? ''}}</x-slot>
                </x-image-box>
            </div>
            <h4 class="tx-normal tx-roboto tx-white">{{$data->name}}</h4>
        </div>
    </div>

    <div class="ht-50 bg-gray-100 pd-x-20 d-flex align-items-center justify-content-center shadow-base">
        <ul class="nav nav-outline active-info align-items-center flex-row" role="tablist">
            <li class="nav-item hidden-xs-down"><a class="nav-link active" data-toggle="tab" href="#basic" role="tab"
                    aria-expanded="false">Basic Information</a></li>
            <li class="nav-item"><a class="nav-link"
                    href="{{route('admin.users.information', ['page'=>'slot','id' => $data->id])}}">Booking Slot</a>
            </li>
        </ul>
    </div>

    <div class="tab-content br-profile-body">
        <div class="tab-pane fade active show" id="basic" aria-expanded="true">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                        <h5>User Information</h5>
                        <table class="table">
                            <tr>
                                <td>
                                    <label
                                        class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Gender</label>
                                    <p class="tx-inverse mg-b-15">
                                        {{$data->gender==0?'Other':''}}
                                        {{$data->gender==1?'Male':''}}
                                        {{$data->gender==2?'Female':''}}
                                    </p>
                                </td>
                                <td><label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">DOB</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->dob))
                                        {{dateformat($data->dob)}}
                                        @else
                                        -------
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <label>Company Name</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->company_name))
                                        {{$data->company_name ?? ''}}
                                        @else
                                        -------
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Designation</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->designation))
                                        {{$data->designation ?? ''}}
                                        @else
                                        -------
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <label>GST Number</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->gst_number))
                                        {{$data->gst_number ?? ''}}
                                        @else
                                        -------
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <label>Country</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->country))
                                        {{bladeCountryGetNameById($data->country ?? '')}}
                                        @else
                                        -------
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>State</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->state))
                                        {{bladeStateGetNameById($data->state ?? '')}}
                                        @else
                                        -------
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <label>City</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->city))
                                        {{bladeCityGetNameById($data->city ?? '')}}
                                        @else
                                        -------
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <label>Stage Of Startup</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->stage_of_startup))
                                        {{$data->stage_of_startup ?? ''}}
                                        @else
                                        -------
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Objectives</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->objectives))
                                        {{bladeObjectiveGetNameById($data->objectives ?? '')}}
                                        @else
                                        -------
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <label>StartUp Industry</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if(!empty($data->industry))
                                        {{bladeIndustryGetNameById($data->industry ?? '')}}
                                        @else
                                        -------
                                        @endif
                                    </p>
                                </td>
                            
                            </tr>
                            <tr>
                                <td>
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Mobile
                                        Notification</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if($data->mobile_notification==1)
                                        <small class="text-success">ON (<i class="fa fa-check"></i>)</small>
                                        @endif
                                        @if($data->mobile_notification==0)
                                        <small class="text-danger">OFF (<i class="fa fa-times"></i>)</small>
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email
                                        Notification</label>
                                    <p class="tx-inverse mg-b-15">
                                        @if($data->email_notification==1)
                                        <small class="text-success">ON (<i class="fa fa-check"></i>)</small>
                                        @endif
                                        @if($data->email_notification==0)
                                        <small class="text-danger">OFF (<i class="fa fa-times"></i>)</small>
                                        @endif
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-lg-3 mg-t-30 mg-lg-t-0">
                    <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                        <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Contact Information</h6>

                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Phone Number</label>
                        <p class="tx-info mg-b-15">+{{$data->ccode}}{{$data->mobile}}</p>

                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email Address</label>
                        <p class="tx-inverse mg-b-15">{{$data->email}}</p>

                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">User Id</label>
                        <p class="tx-info mg-b-15"><small>{{$data->user_id}}</small></p>

                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Wallet</label>
                        <p class="tx-info mg-b-15"><small>₹ {{$data->wallet}}</small></p>

                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Location</label>
                        <p class="tx-inverse mg-b-15">
                            <small>
                                @if(!empty($data->cities)) {{$data->cities->name ?? ''}}, @endif
                                @if(!empty($data->states)) {{$data->states->name ?? ''}}, @endif
                                @if(!empty($data->countires)) {{$data->countires->name ?? ''}} @endif
                            </small>
                        </p>
                    </div>

                    <div class="card pd-20 mt-4 pd-xs-30 shadow-base bd-0">
                        <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Other Information</h6>

                        <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Last Login</label>
                        <p class="tx-inverse mg-b-5"><small>{{datetimeformat($data->last_login)}}</small></p>

                        @if($data->is_publish==1)
                        <p class="tx-inverse mg-b-5"><small class="text-success">1. Profile Approved : Yes (<i
                                    class="fa fa-check"></i> )</small></p>
                        @endif

                        @if($data->is_publish==0)
                        <p class="tx-inverse mg-b-5"><small class="text-danger">1. Profile Approved : NO (<i
                                    class="fa fa-times"></i>)</small></p>
                        @endif

                        {{-- @if($data->mobile_verify==1)
                                <p class="tx-inverse mg-b-5"><small class="text-success">2. Mobile Verify : Yes (<i class="fa fa-check"></i>)</small></p>
                            @endif

                            @if($data->mobile_verify==0)
                                <p class="tx-inverse mg-b-5"><small class="text-danger">2. Mobile Verify : No (<i class="fa fa-times"></i>)</small></p>
                            @endif --}}

                        @if($data->email_verify==1)
                        <p class="tx-inverse mg-b-5"><small class="text-success">3. Email Verify : Yes (<i
                                    class="fa fa-check"></i>)</small></p>
                        @endif

                        @if($data->email_verify==0)
                        <p class="tx-inverse mg-b-5"><small class="text-danger">3. Email Verify : No (<i
                                    class="fa fa-times"></i>)</small></p>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('css')
<title>User Information : {{ project() }}</title>
<link href="{{ asset('admin/lib/SpinKit/spinkit.css') }}" rel="stylesheet">
<style>
.youtube-player {
    position: relative;
    height: 200px;
    overflow: hidden;
    max-width: 100%;
    background: #000
}

.youtube-player iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 100;
    background: transparent
}

.youtube-player img {
    object-fit: cover;
    display: block;
    left: 0;
    bottom: 0;
    margin: auto;
    max-width: 100%;
    width: 100%;
    position: absolute;
    right: 0;
    top: 0;
    border: none;
    height: auto;
    cursor: pointer;
    -webkit-filter: brightness(75%);
    -webkit-transition: 0.4s all;
    -moz-transition: 0.4s all;
    transition: 0.4s all
}

.youtube-player .play {
    height: 72px;
    width: 72px;
    left: 50%;
    top: 50%;
    transform: translateX(-50%) translatey(-50%);
    position: absolute;
    background: url('../../../frontend/img/play.svg') no-repeat;
    cursor: pointer;
    z-index: 2;
    filter: drop-shadow(2px 3px 0 rgb(var(--blackrgb)/.2))
}
</style>
@endpush
@push('js')

@endpush