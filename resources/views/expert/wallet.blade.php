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
                            <li class="breadcrumb-item"><a href="{{ route('expert.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a aria-current="page">Wallet</a></li>
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
                        <div class="card UserBox">
                            <div class="card-body d-block">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="WalletMain grey d-flex align-items-center flex-wrap justify-content-between">
                                            <div>
                                                <div class="text-black-50"><strong>Current Wallet Balance</strong></div>
                                                <h2 class="m-0 h4">{{defaultcurrency()}} {{expertinfo()->wallet ?? 0}}</h2>
                                            </div>
                                            <div>
                                                <button data-bs-toggle="modal" data-bs-target="#WithdrawalModal" class="btn btn-thm2 m-0 ms-2">Withdraw</button>
                                                <div class="MissingD d-flex justify-content-between">Missing Withdraw<a data-bs-toggle="modal" href="#ClaimModal"><strong>Claim Now ?</strong></a></div>
                                            </div>                                            
                                        </div>
                                        <small><b>NOTE:</b> You can withdraw minimum <b>{{defaultcurrency()}} {{settingdata()->minimum_withdraw}}</b>.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($lists->count() > 0)
                        <h6 class="text-black border-bottom mt-4 pb-2">WALLET TRANSACTIONS</h6>
                        <div class="transactions mt-3">
                            @foreach ($lists as $item)
                            @php 
                                $Type = ucwords(substr($item->type,0,1));
                                $class="bg-secondary";
                                if($Type=='R'){$class="bg-primary";}
                                if($Type=='P'){$class="bg-warning";}
                                if($Type=='D'){
                                    if($item->payment==1){ $class="bg-success"; }
                                    if($item->payment==2){ $class="bg-danger"; }
                                }
                                if($Type=='W'){
                                    if($item->is_publish==1){ $class="bg-danger"; }
                                    if($item->is_publish==2){ $class="bg-success"; }
                                }
                            @endphp
                            <div class="item">
                                <div class="detail">
                                    <div class="image-block text-white {{$class}} imaged w48"> {{$Type}} </div>
                                    <div>
                                        <strong>{{ucwords($item->type)}}</strong>
                                        @if($item->type=='purchase') <p class="mb-0">We has received your payment for booking <a href="{{route('user.scheduleinfo',['booking'=>$item->booking->booking_id ?? 0])}}" target="_blank">#{{$item->booking->booking_id ?? 0}}</a>.</p> @endif
                                        @if($item->type=='withdrawal') 
                                            @if($item->is_publish==0) <p class="mb-0"> Your withdrawal request under processing....</p>  @endif
                                            @if($item->is_publish==1) <p class="mb-0"> Your withdrawal request has been accepted & your wallet updated.</p>  @endif
                                            @if($item->is_publish==2) <p class="mb-0"> Your withdrawal request has been rejected by the administrator.</p>  @endif
                                        @endif
                                        <small class="text-secondary"><b>Date: </b>{{datetimeformat($item->created_at)}}</small>
                                        @if(!empty($item->transationno)) <small class="text-secondary ms-3"><b>Transation No :</b> {{$item->transationno}}</small>  @endif 
                                    </div>
                                </div>
                                <div class="right">
                                    @if($item->type=='purchase') <div class="price text-success"> + {{defaultcurrency()}} {{$item->amount}}</div> @endif
                                    @if($item->type=='withdrawal') <div class="price text-{{$item->is_publish==0?'secondary':'danger'}}"> - {{defaultcurrency()}} {{$item->amount}}</div> @endif    
                                                                  
                                </div>
                            </div>
                            @endforeach  
                            {{$lists->links()}}                                                     
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('css')
    <title>Wallet : {{ project() }}</title>
    <meta name="description" content="Welcome to Expert Bells">
    <meta name="keywords" content="Welcome to Expert Bells">
    <link rel="stylesheet" href="{{ asset('frontend/css/account.css') }}">
    <link rel="preload" as="style" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css"
        onload="this.rel='stylesheet'"
        integrity="sha512-160haaGB7fVnCfk/LJAEsACLe6gMQMNCM3Le1vF867rwJa2hcIOgx34Q1ah10RWeLVzpVFokcSmcint/lFUZlg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css">
        .Wallet h2,
        .Wallet h3,
        #AddWallet h5 {
            font-family: 'Montserrat', sans-serif !important;
            font-weight: 600;
            color: var(--black)
        }

        .WalletMain {
            padding: 20px;
            border-radius: 9px;
        }

        .WalletMain .btn {
            line-height: 35px
        }

        .Wallet .card-body {
            z-index: 1
        }

        .Wallet .card-body:after {
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 695.51 466.62"><path fill="%23372e2c" d="M10,215.17c1.83-3,4.56-3.75,7.94-3.74q157.47.07,314.94,0c6.35,0,8,1.61,8,7.93,0,5.37.07,10.73,0,16.09-.07,3.83-2,5.92-5.21,6-3.38.09-5.46-2.08-5.56-6s0-8.19,0-12.6H21.26V365H229.13a27.33,27.33,0,0,1,5.19.41,4.79,4.79,0,0,1,4.06,5.08,5.09,5.09,0,0,1-4.32,5.32,14.47,14.47,0,0,1-3.35.18q-106.41,0-212.83.06c-3.4,0-6.11-.75-7.88-3.8Z" transform="translate(302.35 6.48)"/><path fill="%23372e2c" d="M252.31,358.1c0-24.55.23-49.11-.13-73.65-.12-8.53,3.66-13.93,10.61-17.74,8.5-4.66,17.76-7.13,27.26-8.62,26.12-4.1,52.15-4,77.81,2.91a78.19,78.19,0,0,1,17.34,7.56c5.59,3.13,7.93,8.38,7.91,15q-.19,73.65.05,147.3c0,8.47-3.51,14-10.49,17.83-10,5.49-20.89,8-32,9.45-24.66,3.14-49.25,3.05-73.37-3.74a80,80,0,0,1-17.61-7.82c-5.17-2.93-7.46-7.89-7.42-14.13C252.4,407.7,252.31,382.9,252.31,358.1Zm11.88-77.58c5.88,5.41,11.9,7.15,17.91,8.6A174.92,174.92,0,0,0,357,290.49c7.21-1.39,14.08-4.67,21-7.39,2.58-1,2.5-3,0-4.29a61.55,61.55,0,0,0-8.4-4c-15.14-5.26-30.87-6.6-46.75-6.58-16.12,0-32.12,1.23-47.45,6.75C271.73,276.32,268.39,278.41,264.19,280.52Zm116.09,68c-38.51,12.46-76.74,12.44-115.19.05a34.18,34.18,0,0,1,0,5.16c-.64,4,1.3,6.42,4.78,7.77,4.28,1.66,8.53,3.56,13,4.61,24.46,5.78,49.11,5.87,73.73,1.31,6.64-1.23,13.07-3.88,19.42-6.33a8,8,0,0,0,4.15-4.64c.64-2.54.11-5.4.11-8ZM265.09,399.78a38.74,38.74,0,0,1,0,5.7c-.52,3.62,1.26,5.73,4.27,7a92.44,92.44,0,0,0,12.58,4.62c23.93,5.92,48.11,6.21,72.28,2,7.39-1.29,14.55-4.1,21.66-6.65a7.82,7.82,0,0,0,4.26-4.58c.73-2.59.18-5.53.18-8.05C341.64,412.13,303.54,412.13,265.09,399.78Zm0-103a45.52,45.52,0,0,1,0,6.29c-.52,3.59,1.18,5.75,4.21,7a93.85,93.85,0,0,0,12.58,4.63c24.32,6,48.88,6.21,73.42,1.78,7-1.26,13.83-4,20.58-6.44a7.88,7.88,0,0,0,4.26-4.58c.73-2.6.18-5.55.18-8.76-18.68,8.11-38,9.78-57.48,9.82s-39-1.86-57.7-9.82Zm0,128.61a35.39,35.39,0,0,1,0,5.35c-.57,3.89,1.26,6.18,4.61,7.51,3.92,1.55,7.81,3.34,11.89,4.35,24.56,6.11,49.36,6.28,74.15,1.78,6.78-1.23,13.36-3.82,19.85-6.27a8.41,8.41,0,0,0,4.54-4.75c.78-2.55.2-5.52.2-8-38.53,12.32-76.59,12.42-115.19-.05Zm0-51.13a28.78,28.78,0,0,1,0,5c-.72,4.28,1.48,6.61,5.07,8a106.47,106.47,0,0,0,12.65,4.43c23.22,5.62,46.68,5.93,70.13,2,7.65-1.29,15.09-4.06,22.45-6.66a9,9,0,0,0,4.75-5c.82-2.41.19-5.31.19-7.82-38.5,12.32-76.56,12.27-115.19,0Zm0-51.24a33.87,33.87,0,0,1,0,5.33c-.59,3.9,1.29,6.17,4.62,7.5a94.46,94.46,0,0,0,11.88,4.27c24.68,6.16,49.58,6.25,74.48,1.74,6.77-1.23,13.33-3.89,19.82-6.33A7.93,7.93,0,0,0,380.1,331c.73-2.6.19-5.55.19-8.07-38.51,12.42-76.55,12.41-115.2,0Z" transform="translate(302.35 6.48)"/><path fill="%23372e2c" d="M45.24,140.48c-2,9.08-4,18-6,27-1.76,7.9-3.48,15.8-5.26,23.69-1,4.32-3.55,6.23-7,5.37-3.23-.8-4.55-3.52-3.61-7.77q6-27.35,12.12-54.68c1.1-5,3.47-6.42,8.38-5.32L296,185.47c1.2.27,2.85.36,3.45,1.17,1.3,1.73,2.79,3.85,2.82,5.84,0,2.52-2.17,4.14-4.87,4.18A19.33,19.33,0,0,1,293,196L47,140.78C46.54,140.66,46,140.61,45.24,140.48Z" transform="translate(302.35 6.48)"/><path fill="%23372e2c" d="M112.73,293.78A56.34,56.34,0,1,1,169.16,350,56.33,56.33,0,0,1,112.73,293.78Zm56.81-46c-24.76-.54-46,20-46.5,45-.55,25.63,19.47,46.41,45.44,47.17,24.7.73,46-19.8,46.59-44.8C215.61,269.06,195.65,248.32,169.54,247.78Z" transform="translate(302.35 6.48)"/><path fill="%23372e2c" d="M92.29,350.5c-7.6,0-15.2-.08-22.8,0a9.62,9.62,0,0,1-7.9-3.37c-7.74-8.61-15.71-17-23.33-25.76a11.22,11.22,0,0,1-2.6-6.65c-.23-14-.29-27.91,0-41.86A12.85,12.85,0,0,1,39,265q12.33-12.76,25.4-24.81a12.46,12.46,0,0,1,7.55-3.06c14.57-.29,29.15-.15,43.73-.14a14.24,14.24,0,0,1,2.61.15c3.07.56,5,2.31,4.89,5.57s-2.13,5-5.25,5.24c-2.85.21-5.73.08-8.59.08-11.47,0-22.93-.09-34.39.09a8.32,8.32,0,0,0-5.15,2.07q-10.64,10-20.85,20.37a8.17,8.17,0,0,0-2.23,5.07c-.19,12-.17,23.92,0,35.88a8.21,8.21,0,0,0,1.89,4.9c6.16,7,12.46,13.93,18.92,20.68a7.82,7.82,0,0,0,5,2.19c14.08.17,28.16.09,42.24.1a21,21,0,0,1,3.72.18c2.91.57,4.73,2.33,4.71,5.38s-1.84,4.8-4.76,5.34a18.76,18.76,0,0,1-3.35.16Z" transform="translate(302.35 6.48)"/><path fill="%23372e2c" d="M114.09,102.53c-3.37,6.72-6.48,13.35-10,19.73a8.84,8.84,0,0,1-5.17,4.09c-4.1.81-6.93-3.71-5-7.86,3.14-6.77,6.59-13.39,9.92-20.07,4.95-9.9,5.31-10,15.61-5.73L264,153l1.38.57c4.44,1.92,6,4.67,4.62,7.94s-4.5,4-8.95,2.13q-71.47-29.75-142.94-59.53C116.9,103.61,115.64,103.14,114.09,102.53Z" transform="translate(302.35 6.48)"/><path fill="%23372e2c" d="M162.4,316.16c-2.05,0-3.79.07-5.53,0-4.12-.19-6.92-2.77-6.94-6.34s2.77-6.27,6.87-6.36c4.73-.11,9.47,0,14.2-.09a20.78,20.78,0,0,0,4.26-1l-.07-1.4c-1.47-.26-2.93-.62-4.41-.74-3-.24-6-.06-8.92-.57A15,15,0,0,1,150,286.44c-.42-5.56,3.58-11.66,9.49-13.81a6.89,6.89,0,0,0,4.09-3.65,7.64,7.64,0,0,1,5.37-3.59c1.89-.06,3.94,1.88,5.72,3.2.67.49.78,1.71,1.22,2.79,2,0,4-.15,6,0,3.94.36,6.38,3,6.3,6.51s-2.57,6-6.6,6.15c-4.73.14-9.47,0-14.2.1A24.77,24.77,0,0,0,163,285v1.3a22.78,22.78,0,0,0,3.9,1c2.6.21,5.24,0,7.83.28a15,15,0,0,1,13.35,12.62c.82,6.36-3.35,12.56-9.84,15.09a6.56,6.56,0,0,0-3.07,2.93c-1.31,2.6-3.29,4.61-6,4.05-2.12-.44-4-2.39-5.8-3.83C162.79,318.07,162.74,317.1,162.4,316.16Z" transform="translate(302.35 6.48)"/><path fill="%23372e2c" d="M-141.18,290.33l-1.39-1a5.47,5.47,0,0,1-2.42-6.3,5.47,5.47,0,0,1,5.52-4.29c5.41-.07,10.82,0,16.23,0h64.05c11.74,0,18.89-7.21,18.9-19V213.83h-3.47c-22,0-44.06.07-66.08,0a38.24,38.24,0,0,1-38.29-38.19c0-.15,0-.31,0-.46a38.19,38.19,0,0,1,37.63-37.83c22.12-.13,44.24,0,66.37,0h3.69c0-1.09.13-2,.13-2.95V91.22c0-11.6-7.22-18.8-18.81-18.8H-271.84c-11.76,0-18.92,7.17-18.92,19V259.71c0,11.91,7.16,19,19.17,19h79.13c3.43,0,5.64,1.55,6.43,4.3.73,2.59-.39,4.93-3.21,6.74a5.62,5.62,0,0,0-.64.55h-87.54c-.06-.07-.13-.19-.2-.21q-20.22-4.31-24.53-24.52c0-.08-.13-.13-.2-.2V85.67a11.92,11.92,0,0,0,.56-1.55c2.51-12,11.64-21.23,23.9-22.79,7.23-.92,14.63-.5,21.95-.51a6.77,6.77,0,0,0,5.3-2.14C-231.87,39.79-213,21-194.21,2.12c3.79-3.83,7.74-7.22,13.05-8.6h6.37c9.14,2.38,13.76,10.66,20.47,16,6.87-5.65,11.41-13.92,20.7-16h6.37c5.58,1.6,9.56,5.41,13.53,9.4q27.82,28,55.9,55.89A7.79,7.79,0,0,0-53.95,61c15.63,2.83,25.26,14.18,25.27,30.11V137.3H-23c5.88.09,10.76,2.36,14.09,7.23,1.49,2.18,2.32,4.82,3.42,7.26V199.3A12.83,12.83,0,0,0-6,200.63c-2.52,8.39-8.79,13.14-17.56,13.14h-5.09v3.42c0,14.77.09,29.54,0,44.31a28.84,28.84,0,0,1-20,27.34c-1.62.53-3.27,1-4.91,1.46Zm73.8-88.13h43.46c4.33,0,6.77-2.15,6.79-6.18q.09-20.58,0-41.15c0-3.65-2.38-5.89-6-6-2-.07-4.05,0-6.09,0-26.75,0-53.51-.05-80.26,0-14.93,0-26.8,11.59-27,26.12a26.59,26.59,0,0,0,26,27.14h.25c14.26.19,28.56.06,42.86.06ZM-72.7,60.58c-.83-.89-1.37-1.54-2-2.11Q-99.83,33.27-125,8.09c-4.1-4.1-7.21-4.07-11.38.1q-25.2,25.19-50.37,50.38c-.57.57-1.06,1.22-1.74,2Zm-163.57.17c10,0,19.23.08,28.5-.08a6.71,6.71,0,0,0,4.19-1.79c9-8.79,17.78-17.71,26.71-26.59l14.08-14a2.9,2.9,0,0,0-.3-.7q-4.47-4.54-9-9.06c-4.57-4.58-7.49-4.59-12-.08l-50,50c-.59.58-1.15,1.21-2.18,2.32Z" transform="translate(302.35 6.48)"/><path fill="%23372e2c" d="M-167.27,290.33l-1.6-1.13a5.74,5.74,0,0,1-1.33-8,5.74,5.74,0,0,1,8-1.33,5.75,5.75,0,0,1,1.33,8,6,6,0,0,1-1.33,1.33c-.52.4-1.07.77-1.61,1.14Z" transform="translate(302.35 6.48)"/><path fill="%23372e2c" d="M-110,169.76a5.78,5.78,0,0,1,5.87,5.68,5.78,5.78,0,0,1-5.69,5.87,5.78,5.78,0,0,1-5.86-5.69v-.15A5.82,5.82,0,0,1-110,169.76Z" transform="translate(302.35 6.48)"/></svg>') no-repeat right center;
            opacity: .5;
            background-size: contain;
            height: 100%;
            width: 100%;
            position: absolute;
            right: 0;
            top: 0;
            content: '';
            z-index: -1
        }

        .transactions .item {
            background: #ffffff;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 9%);
            border-radius: 10px;
            padding: 20px 24px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .transactions .item .detail {
            display: flex;
            /* align-items: center; */
            justify-content: flex-start;
            line-height: 1.2em;
        }
        .transactions .item .right {
            padding-left: 10px;
        }
        .transactions .item .detail .image-block {
            margin-right: 16px;
            display:grid;
            place-items:center;
        }
        .imaged.w48 {
            width: 59px !important;
        }
        .imaged {
            height: auto;
            border-radius: 10px;
        }
        .MissingD {
            font-size: 13px;
            border-radius: 20px;
            background: rgb(var(--thmrgb)/.2);
            border: 1px solid rgb(var(--thmrgb)/.3);
            padding: 5px 20px;
            margin: 9px 0 0;
            width: 240px;
        }
        /* .ListBox{font-size:20px; min-width:180px;display:inline-block;} */
        .ListBox .btn{width:100%;text-align:left;padding:.2rem .75rem;font-size:17px;border:1px solid rgb(var(--thmrgb)/.5);background-color:rgb(var(--thmrgb)/.1);color:var(--thm);}
        .ListBox .btn:hover,.ListBox .btn-check:checked+.btn{border-color:rgb(var(--thmrgb)/.8);background-color:rgb(var(--thmrgb)/.2);}
        .ListBox .btn-check:checked+.btn{background:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.42 12.12"><path d="M14,0l1.42,1.42L4.71,12.12,0,7.42,1.42,6,4.71,9.3Z"/></svg>') rgb(var(--thmrgb)/.2) right 1rem center/18px auto no-repeat; padding-right:3rem}
        .ListBox .btn-check:checked+.btn:focus{box-shadow:0 0 0 .25rem rgb(var(--thmrgb)/.4)}
    </style>
@endpush
@push('js')
    
    <div class="modal fade" id="WithdrawalModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <form method="POST" action=""  class="modal-content withdrawalfrm">
                @csrf      
                @php 
                    $request = \App\Models\WithdrawalRequest::where(['expert_id'=>expertinfo()->id,'is_publish'=>0])->count();
                @endphp      
                <div class="modal-header justify-content-center">
                    <div class="text-center">
                        <h6 class="modal-title" id="exampleModalLabel">WITHDRAWAL MONEY</h6>
                        @if($request==0)
                        <small>You can withdrawal minimum {{settingdata()->minimum_withdraw}} {{defaultcurrency()}}.</small>     
                        @endif
                    </div>                   
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($request > 0)
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6 class="title">Sorry! {{experinfo()->name}}</h6>
                            <small>
                                You cannot make a new request as long as your last withdrawal request is in processing.
                            </small>
                        </div>
                    </div>
                    @endif
                    @if($request==0)
                    <div class="row">
                        <div class="col-12 mb-1">
                            <div class="form-group">
                                <small for="accountholdername">Account Holder Name</small>
                                <input type="text" class="form-control inputTextBox" name="account_holder_name" id="accountholdername" placeholder="account holder name">
                                <small class="text-danger error holder-er"></small>
                            </div>
                        </div>
                        <div class="col-12 mb-1">
                            <div class="form-group">
                                <small for="accountholdername">Bank Name</small>
                                <input type="text" class="form-control inputTextBox" name="bank_name" id="bankname" placeholder="bank name">
                                <small class="text-danger error bank-er"></small>
                            </div>
                        </div>
                        <div class="col-12 mb-1">
                            <div class="form-group">
                                <small for="accountholdername">IFSC Code</small>
                                <input type="text" class="form-control" name="ifsc_code" id="ifsccode" placeholder="ifsc code">
                                <small class="text-danger error ifsc-er"></small>
                            </div>
                        </div>
                        <div class="col-12 mb-1">
                            <div class="form-group">
                                <small for="accountholdername">Account Number</small>
                                <input type="number" class="form-control" name="account_number" id="accountnumber" placeholder="account number">
                                <small class="text-danger error account-er"></small>
                            </div>
                        </div>
                        <div class="col-12 mb-1">
                            <div class="form-group">
                                <small for="accountholdername">Re-Enter Account Number</small>
                                <input type="number" class="form-control" name="re_enter_account_number" id="caccountnumber" placeholder="re-enter account number">
                                <small class="text-danger error re-account-er"></small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <small for="accountholdername">Withdrawal Amount ({{defaultcurrency()}})</small>
                                <input type="number" class="form-control" name="amount" id="depositamount" placeholder="withdraw amount">
                                <small class="text-danger error amount-er"></small>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @if($request==0)
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-thm2 wsbtn w-100 m-0">Comfirm & Proceed</button>
                    <button class="btn btn-thm2 m-0 w-100 wpbtn" disabled style="display: none"><i class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                </div>
                @endif
            </form>
        </div>
    </div>
    <div class="modal fade" id="ClaimModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content claimfrm">
                @csrf
                <div class="modal-header justify-content-center">
                    <div class="text-center">
                        <h6 class="modal-title" id="exampleModalLabel">CLAIM REQUEST</h6>
                        <small>You can raise a request for problems related to withdrawals here.</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row ListBox">
                        <div class="col-lg-12">
                            <input type="text" name="transaction_id" id="transaction_id" class="form-control" placeholder="transaction no here">                        
                            <small class="error text-danger transaction-er"></small>
                        </div>
                        <div class="col-12 mt-2">
                            <textarea name="message" class="form-control" id="message" placeholder="Write something here..."></textarea>
                            <small class="error text-danger message-er"></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-thm2 csbtn m-0">Confirm & Proceed</button>
                    <button class="btn btn-thm2 m-0 cpbtn" disabled style="display: none"><i class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                </div>
            </form>
        </div>
    </div>
    <script>        
        $('.withdrawalfrm').on('submit',function(e){
            e.preventDefault();
            let sbtn = $('.wsbtn');
            let pbtn = $('.wpbtn');
            $('.error').html('');
            sbtn.hide();
            pbtn.show(); 
            $.ajax({
                data:new FormData(this),
                url:@json(route('expert.withdrawalrequest')),
                dataType:"Json",
                method:"Post",
                cache:false,
                contentType:false,
                processData:false,
                success:function(success){
                    $('.withdrawalfrm').trigger('reset');
                    toastr.success(success.message);
                    sbtn.show();
                    pbtn.hide(); 
                    $('#WithdrawalModal').modal('hide');
                },
                error:function(response){
                    if(response.responseJSON.errors.account_holder_name!== undefined){
                        $('.holder-er').text(response.responseJSON.errors.account_holder_name);
                    }  
                    if(response.responseJSON.errors.bank_name!== undefined){
                        $('.bank-er').text(response.responseJSON.errors.bank_name);
                    } 
                    if(response.responseJSON.errors.ifsc_code!== undefined){
                        $('.ifsc-er').text(response.responseJSON.errors.ifsc_code);
                    } 
                    if(response.responseJSON.errors.account_number!== undefined){
                        $('.account-er').text(response.responseJSON.errors.account_number);
                    } 
                    if(response.responseJSON.errors.re_enter_account_number!== undefined){
                        $('.re-account-er').text(response.responseJSON.errors.re_enter_account_number);
                    }
                    if(response.responseJSON.errors.amount!== undefined){
                        $('.amount-er').text(response.responseJSON.errors.amount);
                    } 
                    sbtn.show();
                    pbtn.hide(); 
                }
            });          
        });
        $('.claimfrm').on('submit',function(e){
            e.preventDefault();
            let sbtn = $('.csbtn');
            let pbtn = $('.cpbtn');
            $('.error').html('');
            sbtn.hide();
            pbtn.show(); 
            $.ajax({
                data:new FormData(this),
                url:@json(route('expert.claimrequest')),
                dataType:"Json",
                method:"Post",
                cache:false,
                contentType:false,
                processData:false,
                success:function(success){
                    $('.claimfrm').trigger('reset');
                    toastr.success(success.message);
                    sbtn.show();
                    pbtn.hide(); 
                    $('#ClaimModal').modal('hide');
                },
                error:function(response){
                    if(response.responseJSON.errors.request_for!== undefined){
                        $('.request-er').text(response.responseJSON.errors.request_for);
                    }  
                    if(response.responseJSON.errors.message!== undefined){
                        $('.message-er').text(response.responseJSON.errors.message);
                    } 
                    
                    
                    sbtn.show();
                    pbtn.hide(); 
                }
            });          
        });
    </script>
@endpush
