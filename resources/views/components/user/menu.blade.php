<li {{Request::segment(2)=='dashboard'?'class=active':''}}><a href="{{route('user.dashboard')}}"><span><i class="fal fa-tachometer-alt me-1"></i> Dashboard</a></li>
        <li {{Request::segment(2)=='account'?'class=active':''}}><a href="{{route('user.account')}}"><span><i class="fal fa-user-edit me-1"></i> My Account</a></li>
        <li {{in_array(Request::segment(2),['schedules','reschedules'])?'class=active':''}}><a href="#mycalls" class="collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="false" aria-controls="mycalls"><span><i class="fal fa-phone-rotary me-1"></i> My Calls</span> <i class="fal fa-chevron-down arrow"></i></a>
            <ul class="collapse" id="mycalls">
                <li><a href="{{route('user.schedules')}}"><span><i class="fal fa-phone-alt me-1"></i> Scheduled Call</span></a></li>
                <li><a href="{{route('user.closeschedules')}}"><span><i class="fal fa-phone-slash me-1"></i> Closed Call</span></a></li>
                <li><a href="{{route('user.rejectschedules')}}"><span><i class="fal fa-phone-slash me-1"></i> Rejected & Expired Call</span></a></li>
                <li><a href="{{route('user.reschedules')}}"><span><i class="fal fa-phone-plus me-1"></i> Rescheduled Call</span></a></li>
            </ul>
        </li>
        <li {{Request::segment(2)=='message'?'class=active':''}}><a href="{{route('user.message')}}"><span><i class="fal fa-comment-alt-lines me-1"></i> Message</span></a></li>
        <li {{Request::segment(2)=='wallet'?'class=active':''}}><a href="{{route('user.wallet')}}"><span><i class="fal fa-wallet me-1"></i> Wallet</span></a></li>
        <li {{Request::segment(2)=='reviews'?'class=active':''}}><a href="{{route('user.reviews')}}"><span><i class="fal fa-star me-1"></i> My Reviews</span></a></li>
        <li {{Request::segment(2)=='help'?'class=active':''}}><a href="{{route('user.help')}}"><span><i class="fal fa-user-headset me-1"></i> Help Center</a></li>
        <li><a href="{{route('user.userlogout')}}"><span><i class="fal fa-power-off me-1"></i> Logout</a></li>