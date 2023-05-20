@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a aria-current="page">My Account</a></li>
            </ol>
            <div class="row MainBoxAc">
                <div class="col-md-3">
                    <div class="position-sticky top-0">
                        <x-user.left-bar/>
                    </div>
                </div>
                <div class="col-md-9">
                    <form action="{{route('user.savereviews')}}" method="post" class="card UserBox">
                        @csrf
                        <div class="card-body">
                            <div class="ReviewForm w-100 mt-2 mb-1">
                                @if($bookings->count() > 0)
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="sticky-top">
                                            <p class="h6 m-0"><span class="thm1">Select Your Rating</span></p>
                                            <div class="rating m-0 mt-2">
                                                <input type="radio" name="rating" value="5" id="rating-5"><label for="rating-5"></label>
                                                <input type="radio" name="rating" value="4" id="rating-4"><label for="rating-4"></label>
                                                <input type="radio" name="rating" value="3" id="rating-3"><label for="rating-3"></label>
                                                <input type="radio" name="rating" value="2" id="rating-2"><label for="rating-2"></label>
                                                <input type="radio" name="rating" value="1" id="rating-1"><label for="rating-1"></label>
                                                <div class="emoji-wrapper">
                                                    <div class="emoji">
                                                        <img src="{{asset('frontend/img/rating.svg')}}" class="rating-0">
                                                        <img src="{{asset('frontend/img/rating1.svg')}}">
                                                        <img src="{{asset('frontend/img/rating2.svg')}}">
                                                        <img src="{{asset('frontend/img/rating3.svg')}}">
                                                        <img src="{{asset('frontend/img/rating4.svg')}}">
                                                        <img src="{{asset('frontend/img/rating5.svg')}}">
                                                    </div>
                                                </div>
                                                @error('rating') <span class="error">{{$message}}</span> @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9 col-lg-8">                                                    
                                                    <div class="form-floating mt-3" id="expert" name="expert">
                                                        <fieldset>
                                                            <select name="expert" id="people">
                                                                <option value="" disabled selected>Select a Expert:</option>
                                                                @foreach ($bookings as $item)
                                                                    @if(!empty($item->expert))
                                                                        <option value="{{$item->expert->id ?? ''}}" data-class="avatar" data-style="background-image: url(&apos;{{asset('uploads/expert/'.$item->expert->profile ?? '' )}}&apos;);">{{$item->expert->name ?? ''}}</option>
                                                                    @else
                                                                        <option value="{{$item->expert->id ?? ''}}" data-class="avatar" data-style="background-image: url(&apos;{{asset('frontend/image/no-img.webp')}}&apos;);">{{$item->expert->name ?? ''}}</option>
                                                                    @endif
                                                                @endforeach 
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    @error('expert') <span class="error">{{$message}}</span> @enderror
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mt-3">
                                                        <textarea name="message" class="form-control" placeholder="Message" maxlength="300" data-length="300" id="message"></textarea>
                                                        <label for="message">Message <span class="text-danger">*</span></label>
                                                    </div>
                                                    @error('message') <span class="error">{{$message}}</span> @enderror
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" onclick="$('.pbtn').show(); $('.sbtn').hide(); " class="btn btn-thm2 sbtn">Submit</button>
                                                    <button type="button" disabled class="btn btn-thm2 pbtn" style="display: none"><i class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 border-start">
                                        @foreach ($reviews as $item)
                                        <div class="pb-3 mb-3 mx-2 border-bottom">
                                            <div class="d-flex justify-content-between reviewimg">
                                                <div class="d-flex align-items-center">
                                                    @if(!empty($item->expert))
                                                    <a href="{{route('experts',['alias'=>$item->expert->user_id])}}" target="_blank">
                                                        <x-image-box>
                                                            <x-slot:image>{{$item->expert->profile}}</x-slot>
                                                            <x-slot:path>/uploads/expert/</x-slot>
                                                            <x-slot:alt>{{$item->expert->name ?? ''}}</x-slot>
                                                            <x-slot:width>50</x-slot>
                                                            <x-slot:height>50</x-slot>
                                                        </x-image-box>
                                                    </a>
                                                    <h4 class="thm h5 ms-2">{{$item->expert->name ?? ''}}</h4>
                                                    @endif
                                                </div>
                                                <div class="text-right">
                                                    <a href="#editmodal" data-bs-id="{{$item->id}}" class="sws-bounce sws-top" data-title="Edit"><i class="fas fa-pencil-alt me-1"></i></a>
                                                    <a href="{{route('user.removereviews',['id'=>$item->id])}}" class="text-danger sws-bounce sws-top"  data-title="Remove"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                            <p class="mt0">{{$item->description ?? ''}}</p>
                                            <div class="d-flex justify-content-between">
                                                <span class="star" title="star" data-title="{{$item->rating ?? '0'}}"></span>
                                                <small class="text-secondary">{{date('l d M, Y',strtotime($item->created_at))}}</small>
                                            </div>
                                        </div>  
                                        @endforeach                                                                              
                                    </div>
                                </div>
                                @else
                                <div class="row text-center">
                                    <h6>Sorry! {{userinfo()->name}}</h6>
                                    <small>You haven't left any review yet</small>
                                </div>
                                @endif
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main> 

<div class="modal fade" id="editmodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-center p-4">
                <i class="fad fa-spinner-third fa-spin" style="font-size: 35px;"></i>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<title>My Reviews : {{project()}}</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<link rel="stylesheet" href="{{asset('frontend/css/account.css')}}">
<style type="text/css">
body>main,body section{overflow:inherit!important}
.ReviewForm .form-control{background-color:#eee!important}
.ReviewForm textarea{height:99px!important}
.rating{justify-content:center;margin-bottom:9px;overflow:hidden;flex-direction:row-reverse;position:relative;width:160px}
.rating-0{filter:grayscale(100%)}
.rating>input{display:none}
.rating>label{cursor:pointer;width:25px;height:25px;float:right;padding:0!important;margin-top:auto;background-image:url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");background-repeat:no-repeat;background-position:center;background-size:76%;transition:.3s}
.rating>input:checked~label,.rating>input:checked~label~label{background-image:url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e")}
.rating>input:not(:checked)~label:hover,.rating>input:not(:checked)~label:hover~label{background-image:url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e")}
.emoji-wrapper{width:auto;text-align:center;height:25px;overflow:hidden;position:relative}
.emoji-wrapper:before,.emoji-wrapper:after{content:"";display:none;height:15px;width:100%;position:absolute;left:0;z-index:1}
.emoji-wrapper:before{top:0;background:linear-gradient(to bottom, rgb(var(--whitergb)) 0%,rgb(var(--whitergb)) 35%,rgb(var(--whitergb)/0) 100%)}
.emoji-wrapper:after{bottom:0;background:linear-gradient(to top, rgb(var(--whitergb)) 0%,rgb(var(--whitergb)) 35%,rgb(var(--whitergb)/0) 100%)}
.emoji{display:flex;margin-right:9px;flex-direction:column;align-items:center;transition:.3s}
.emoji>img{margin:0;width:25px;height:25px;flex-shrink:0}
#rating-1:checked~.emoji-wrapper>.emoji{transform:translateY(-25px)}
#rating-2:checked~.emoji-wrapper>.emoji{transform:translateY(-50px)}
#rating-3:checked~.emoji-wrapper>.emoji{transform:translateY(-75px)}
#rating-4:checked~.emoji-wrapper>.emoji{transform:translateY(-100px)}
#rating-5:checked~.emoji-wrapper>.emoji{transform:translateY(-125px)}
.ReviewBlock{border:none!important}
.ReviewBlock>div{border-top:1px solid rgb(var(--blackrgb)/.1);padding:15px 0 0;margin-top:15px}
.ReviewBlock>div:first-child{margin-top:0}
.ReviewBlock>div .star{margin-left:0}
.ReviewBlock>div h4{font-size:20px;margin-top:0;font-weight:600;font-family:'Montserrat', sans-serif!important}
.ReviewBlock>div>div>span:last-child{font-size:14px!important}
.sticky-top{top:80px!important;z-index:1!important}
.star{margin:0!important;font-size:16px!important}
@media (max-width:767px){.ReviewForm>.row>div.border-start{border:none!important;margin-top:20px}
.ReviewForm>.row>div.border-start .mx-2{margin-left:0!important;margin-right:0!important}}
.ui-menu .ui-icon{height:24px;width:24px;background-size:contain}
.ui-menu .ui-state-disabled{display:none;}
.reviewimg img{border-radius: 50%;width: 35px;height: 35px;}
</style>
@endpush
@push('js')
<link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet"/>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        if ($(window).width() < 991){
            $("#AccMenuBar").removeClass('d-none');
            $("#AccountMenu").addClass('collapse');
        };
    });
    $( function() {
        $.widget( "custom.iconselectmenu", $.ui.selectmenu, {
      _renderItem: function( ul, item ) {
        var li = $( "<li>" ),
          wrapper = $( "<div>", { text: item.label } );
 
        if ( item.disabled ) {
          li.addClass( "ui-state-disabled" );
        }
 
        $( "<span>", {
          style: item.element.attr( "data-style" ),
          "class": "ui-icon " + item.element.attr( "data-class" )
        })
          .appendTo( wrapper );
 
        return li.append( wrapper ).appendTo( ul );
      }
        }); 
    
        $( "#people" )
        .iconselectmenu()
        .iconselectmenu( "menuWidget")
            .addClass( "ui-menu-icons avatar" );
    } );

    $('[data-bs-id]').on('click',function(e){
        let id = $(this).attr('data-bs-id');
        $('.sticky-top').html('<div class="text-center p-4"><i class="fad fa-spinner-third fa-spin" style="font-size: 35px;"></i></div>');
        $('.sticky-top').load(@json(route('user.editreviews'))+'?editid='+id);        
    });
</script>
@endpush