
<h6 class="card-title tx-uppercase tx-12 my-3">BOOKING INFORMATION</h6>
<table class="table table-bordered table-secondary">
    <tbody>
        <tr>
            <th>Request On :</th>
            <td>{{datetimeformat($lists->created_at)}}</td>
        </tr>
        <tr>
            <th>Booking No :</th>
            <td>#{{$lists->booking_id}}</td>
        </tr>
        <tr>
            <th>Booking Date :</th>
            <td>{{dateformat($lists->booking_date)}}</td>
        </tr>
        <tr>
            <th>Booking Slot :</th>
            <td>{{ substr($lists->booking_start_time,0,-3) }} - {{ substr($lists->booking_end_time,0,-3) }}</td>
        </tr>
        <tr>
            <th>Booking Amount :</th>
            <td>{{defaultcurrency()}} {{$lists->booking_amount}}</td>
        </tr>
        <tr>
            <th>Booking Discount :</th>
            <td>{{defaultcurrency()}} {{$lists->coupon_discount ?? 0}}</td>
        </tr>
        <tr>
            <th>Paid Amount :</th>
            <td>{{defaultcurrency()}} {{$lists->paid_amount}}</td>
        </tr>
        @if(!empty($lists->payment_date))
        <tr>
            <th>Payment Date :</th>
            <td>{{datetimeformat($lists->payment_date)}}</td>
        </tr>
        @endif
        <tr>
            <th>Payment Status :</th>
            <td>
                @if($lists->payment==0)<small class="text-secondary"><i class="fad fa-circle" style="font-size: 10px;"></i> Incomplete Process</small> @endif
                @if($lists->payment==1)<small class="text-success"><i class="fad fa-circle" style="font-size: 10px;"></i> Paid</small>@endif
                @if($lists->payment==2)<small class="text-danger"><i class="fad fa-circle" style="font-size: 10px;"></i> Failed</small>@endif
                @if($lists->payment==3)<small class="text-primary"><i class="fad fa-circle" style="font-size: 10px;"></i> Wallet</small>@endif
            </td>
        </tr>
        <tr>
            <th>Booking Status :</th>
            <td>
                @if($lists->reschedule_slot>0)
                <small class="text-primary">Reschedule</small>
                @elseif($lists->reschedule_slot==0)
                    <small class="text-secondary">{{$lists->status==0?'New':''}}</small>
                    <small class="text-success">{{$lists->status==1?'Confirmed':''}}</small>
                    <small class="text-danger">{{$lists->status==2?'Rejected':''}}</small>
                @else
                <small class="text-danger">Expired</small>
                @endif
            </td>
        </tr>
        @if($lists->status==2)
        <tr>
            <th>Reject Date :</th>
            <td>{{datetimeformat($lists->reject_date)}}</td>
        </tr>
        <tr>
            <th>Reject Reason :</th>
            <td width="67%">{!! $lists->reject_reason !!}</td>
        </tr>
        @endif
        @if(!empty($lists->query))
        {{-- <tr>
            <th>User Query :</th>
            <td width="67%">{!! $lists->query !!}</td>
        </tr> --}}
        @endif
    </tbody>
</table>
<h6 class="card-title tx-uppercase tx-12 my-3">QUESTIONNAIRE</h6>
<table class="table table-bordered table-secondary">
    <tr>
        <td>
            <b>1. Tell us about your Startup ?</b> <br>
            {!! $lists->query !!}
        </td>
    </tr>
    <tr>
        <td>
            <b>2. What are the major challenges you are facing ?</b> <br>
            {!! $lists->facing_challenges_query !!}
        </td>
    </tr>
    <tr>
        <td>
            <b>3. What questions do you want to ask to the mentor ?</b> <br>
            {!! $lists->ask_question_query !!}
        </td>
    </tr>
    <tr>
        <td>
            <b>4. Have you previously worked with any mentors or coaches, and if so, what was the experience like ?</b> <br>
            {!! $lists->experience_query !!}
        </td>
    </tr>
    <tr>
        <td>
            <b>5. Attachment</b> <br>
            @if (!empty($lists->query_attachment))
                <a href="{{asset('uploads/booking-attachment/'.$lists->query_attachment)}}" download="download"><i class="fad fa-download"></i> Download Attachment</a>
            @endif
        </td>
    </tr>
</table>

<h6 class="card-title tx-uppercase tx-12 my-3">USER INFORMATION</h6>
<table class="table table-bordered table-secondary">
    <tr>
        <th>User No :</th>
        <td>#{{$lists->user->user_id ?? '--------'}}</td>
    </tr>
    <tr>
        <th>User Name :</th>
        <td>{{$lists->user_name ?? '--------'}}</td>
    </tr>
    <tr>
        <th>Contact No :</th>
        <td>{{$lists->user_number ?? '--------'}}</td>
    </tr>
    <tr>
        <th>User Email :</th>
        <td>{{$lists->user_email ?? '--------'}}</td>
    </tr>
</table>
<h6 class="card-title tx-uppercase tx-12 my-3">EXPERT INFORMATION</h6>
<table class="table table-bordered table-secondary">
    <tr>
        <th>Expert No :</th>
        <td>#{{$lists->expert->user_id ?? '--------'}}</td>
    </tr>
    <tr>
        <th>Expert Name :</th>
        <td>{{$lists->expert->name ?? '--------'}}</td>
    </tr>
    <tr>
        <th>Contact No :</th>
        <td>{{$lists->expert->mobile ?? '--------'}}</td>
    </tr>
    <tr>
        <th>Expert Email :</th>
        <td>{{$lists->expert->email ?? '--------'}}</td>
    </tr>
</table>