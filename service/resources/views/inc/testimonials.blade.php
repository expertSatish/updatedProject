@php $ArrData3 = DB::table('testimonial')->where(['status'=>1])->where(['slider_status'=>1])->orderby('id','DESC')->get(); @endphp

@if($ArrData3->count() > 0)

@php
$customer_heading = DB::table('heading')->where('heading_id', 6)->where('page', 'homepage')->first();
@endphp
<section class="Home TestSec pt0">
    <div class="container">
        <div class="row">
            <div class="col s12">
                @php
                $str = $customer_heading->title;
                $data = Helper::TwoColor($str);
                $customer_heading1 = $data[0];
                $customer_heading2 = $data[1];
                @endphp
                <h3 class="h1 Heading1">{{$customer_heading1}} <span class="mcolor">{{$customer_heading2}}</span></h3>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div id="TestSec" class="owl-carousel">
                    @foreach($ArrData3 as $Rows)
                    <div class="item">
                        <div class="card">
                            <div class="d-flex">
                                <div class="img">@if(!empty($Rows->image))
                                <img class="lazyload" data-src="{{asset('resources/assets/uploads/testimonials/'.$Rows->image)}}" alt="{{$Rows->title}}" height="70" width="70">
                                @else
                                <img class="lazyload" data-src="{{asset('resources/assets/img/NoImage.png')}}" alt="{{$Rows->title}}" height="70" width="70">
                                @endif</div>
                                <div class="nametext">
                                    <h4 class="h6 fw-600 m0 lh-n mcolor1">{{$Rows->title}}</h4>
                                    <p class="m0 fs12 lh-n grey-text"><small>{{$Rows->designation}}</small></p>
                                </div>
                            </div>
                            <div class="text">
                                <p class="fs13 mt0">{!! $Rows->content !!}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif