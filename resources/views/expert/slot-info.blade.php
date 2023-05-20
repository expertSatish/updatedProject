@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('expert.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a aria-current="page">Slot Info</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-expert.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <h3 class="text-center mb-4">Slot information</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <form action="" method="post" class="card UserBox p-0 mb-4">
                                <div class="card-header text-u fw-bold p-2 px-3">Booking Information</div>
                                <div class="card-body d-block p-2 px-3">
                                    <ul class="list-group border-0 rounded-0 small">
                                        <li class="list-group-item border-0 border-bottom px-0"><i class="fal fa-clipboard-list-check h6 m-0 me-2"></i> Booking No: <strong>#000035</strong></li>
                                        <li class="list-group-item border-0 border-bottom px-0"><i class="fal fa-calendar-alt h6 m-0 me-2"></i> Booking Date: 22 Feb, 2023</li>
                                        <li class="list-group-item border-0 border-bottom px-0"><i class="fal fa-user-clock h6 m-0 me-2"></i> Duretion: 45 minutes</li>
                                        <li class="list-group-item border-0 border-bottom px-0"><i class="fal fa-alarm-clock h6 m-0 me-2"></i> Time: 10:30 AM - 11:15 AM</li>
                                    </ul>
                                </div>
                                <div class="card-footer p-2 px-3 border-0 justify-content-center text-primary text-u fw-bold">Confirm</div>
                            </form>
                            <form action="" method="post" class="card UserBox p-0">
                                <div class="card-header text-u fw-bold p-2 px-3">Amount & Diduction</div>
                                <div class="card-body d-block p-2 px-3">
                                    <ul class="list-group border-0 rounded-0 small">
                                        <li class="list-group-item border-0 border-bottom px-0">Booking Amount: <strong>INR 2000</strong></li>
                                        <li class="list-group-item border-0 border-bottom px-0">Booking Discount: <strong>INR 0</strong></li>
                                        <li class="list-group-item border-0 border-bottom px-0">Paid Amount: <strong>INR 2360</strong></li>
                                    </ul>
                                </div>
                                <div class="card-footer p-2 px-3 border-0 justify-content-center text-success text-u fw-bold">Payment Received</div>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div class="ms-md-4">
                                <div class="card-header text-u fw-bold p-2 px-0 border-bottom mb-3">User Information</div>
                                <div class="row m-md-0">
                                    <div class="col-md-6 p-md-0">
                                        <ul class="list-group border-0 bg-0 rounded-0 small">
                                            <li class="list-group-item border-0 border-bottom bg-transparent"><strong>User:</strong> Aditya Agarwal</li>
                                            <li class="list-group-item border-0 border-bottom bg-transparent"><strong>Email:</strong> addyaditya745@gmail.com</li>
                                            <li class="list-group-item border-0 border-bottom bg-transparent"><strong>DOB:</strong> 23 Jun, 2002</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 p-md-0">
                                        <ul class="list-group border-0 bg-0 rounded-0 small">
                                            <li class="list-group-item border-0 border-bottom bg-transparent"><strong>Contact:</strong> Aditya Agarwal</li>
                                            <li class="list-group-item border-0 border-bottom bg-transparent"><strong>Gender:</strong> addyaditya745@gmail.com</li>
                                            <li class="list-group-item border-0 border-bottom bg-transparent"><strong>Location:</strong> 23 Jun, 2002</li>
                                        </ul>
                                    </div>
                                    <div class="col-12 p-md-0">
                                        <ul class="list-group border-0 bg-0 rounded-0 small">
                                            <li class="list-group-item border-0 border-bottom bg-transparent pb-3"><strong class="d-block">Query:</strong> Test Test </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="card-header text-u fw-bold p-2 px-0 mt-4">attachments:</div>
                                <div><small class="text-primary"><img src="{{asset('frontend/img/pdf.svg')}}" height="24" width="24" alt="PDF Icon" class="me-2 shadow-md">File Name.pdf <i class="fal fa-arrow-to-bottom h5 ms-3"></i></small></div>
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
<title>Scheduled Calls : {{project()}}</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<link rel="stylesheet" href="{{asset('frontend/css/account.css')}}">
<style>
</style>
@endpush
@push('js')
<script>
$(document).ready(function(){
    if ($(window).width() < 991){
        $("#AccMenuBar").removeClass('d-none');
        $("#AccountMenu").addClass('collapse');
    };    
    setTimeout(() => {
        $('.summernote').summernote({
            height: 100,
            toolbar: []
        });
        $('.summernote').summernote('code','')
    }, 1000);
    gettimeslots(); 
});
</script>
<x-message-popup/> 
@endpush