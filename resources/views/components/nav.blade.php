<nav class="navbar navbar-expand-lg menu">
    <div class="st">
        <div class="container">
            @if(Request::segment(2)!=='videocall')
            <div>
                <div class="col logom">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('frontend/img/logo-w.svg') }}" alt="{{project()}}" width="300"
                            height="68">
                    </a>
                </div>
                <div class="col LastH">
                    <ul>
                        <li class="d-none d-lg-block"><a href="{{ route('experts') }}">Browse Mentor</a></li>
                        <!-- <li class="d-none d-lg-block"><a href="https://www.expertbells.com/" target="_blank">Expert Services</a></li> -->
                        <li class="dropdown MenuAll">
                            <a title="Products" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-lg-inline-block">More</span>
                                <svg viewBox="0 0 30 22" fill="var(--white)" class="d-lg-none"><path class="bar1" d="M1,0H30a1,1,0,0,1,0,2H1A1,1,0,0,1,1,0Z"></path><path class="bar2" d="M1,20H30a1,1,0,0,1,0,2H1a1,1,0,1,1,0-2Z"></path><path d="M10.93,10H30a1,1,0,0,1,0,2H10.93a1,1,0,0,1,0-2Z"></path></svg>
                            </a>
                            <div class="dropdown-menu Megamenu Mmenu p-0" aria-labelledby="ProductsDropdown">
                                <ul>
                                    <li class="d-lg-none"><a href="{{ route('experts') }}">Browse Mentor</a></li>
                                    <li><a href="{{ route('becomeanexpert') }}">Become Mentor</a></li>
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('careers') }}">Career</a></li>
                                    <li><a href="{{route('contact')}}">Help Center</a></li>
                                </ul>
                                <div>
                                    <div>
                                        <h3>Resources</h3>
                                        <ul>
                                            <li><a href="{{ route('blog') }}">Blog</a></li>
                                            <li><a href="{{route('videos')}}">Videos</a></li>
                                            <!-- <li><a href="#">Podcast</a></li>
                                            <li><a href="#">E books</a></li> -->
                                        </ul>
                                    </div>
                                    @if(count($services) > 0)
                                    <div>
                                        <h3>StartUp Compliance</h3>
                                        <ul>
                                            @foreach($services as $i)
                                            <li><a href="{{url('service/'.$i->alias)}}" target="_blank">{{$i->title}}</a></li>
                                            @endforeach
                                            <li><a href="{{url('service')}}" target="_blank" class="more small text-primary">View more <i
                                                        class="fal fa-long-arrow-right"></i></a></li>
                                        </ul>
                                    </div>
                                    @else
                                    <div>
                                        <ul>
                                            <li><a href="{{url('service')}}" target="_blank" class="more small text-primary">StartUp Compliance<i
                                                        class="fal fa-long-arrow-right"></i></a></li>
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @if (!\Auth::check() && !\Auth::guard('expert')->check())
                            <li><a href="{{ route('login') }}" class="btn btn-thm m-0"><img src="{{ asset('frontend/img/login.svg') }}" alt="login" class="me-2" width="25" height="25"> Login</a></li>
                        @endif
                        <li class="d-none">
                            <button class="navbar-toggler collapsed menubar" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navigatin" aria-controls="navbar" aria-expanded="false"
                                aria-label="Toggle navigation"><span><span class="bar"></span><span
                                        class="bar"></span><span class="bar"></span></span></button>
                            <div class="menu-bg"></div>
                            <div class="collapse navbar-collapse justify-content-between" id="navigatin">
                                <ul class="navbar-nav">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('experts') }}">Find an
                                            Expert</a></li>
                                    <li class="nav-item"><a class="nav-link" target="_blank"
                                            href="https://www.expertbells.com/">Expert Services</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}"><span>About
                                                Us</span></a></li>
                                    <li class="nav-item "><a class="nav-link"
                                            href="{{ route('becomeanexpert') }}"><span>Become An Expert</span></a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('blog') }}"><span>Blog</span></a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('careers') }}"><span>Career</span></a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('contact') }}"><span>Contact Us</span></a></li>
                                </ul>
                            </div>
                        </li>
                        @if (\Auth::guard('expert')->check())
                            <li class="dropdown MenuAll">
                                <a class="dropdown-toggle d-none d-lg-block" href="{{ route('expert.dashboard') }}" title="{{ expertinfo()->name ?? '' }}">
                                    <span class="userimg">
                                        <x-image-box>
                                            <x-slot:image>{{ expertinfo()->profile }}</x-slot:image>
                                            <x-slot:path>/uploads/expert/</x-slot:path>
                                            <x-slot:alt>{{ expertinfo()->name ?? '' }}</x-slot:alt>
                                            <x-slot:height>36</x-slot:alt>
                                                <x-slot:width>36</x-slot:alt>
                                        </x-image-box>
                                    </span>
                                </a>
                                <a class="dropdown-toggle d-lg-none p-0" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" href="{{ route('expert.dashboard') }}"
                                    title="{{ expertinfo()->name ?? '' }}">
                                    <span class="userimg">
                                        <x-image-box>
                                            <x-slot:image>{{ expertinfo()->profile }}</x-slot:image>
                                            <x-slot:path>/uploads/expert/</x-slot:path>
                                            <x-slot:alt>{{ expertinfo()->name ?? '' }}</x-slot:alt>
                                            <x-slot:height>36</x-slot:alt>
                                                <x-slot:width>36</x-slot:alt>
                                        </x-image-box>
                                    </span>
                                    <small class="d-block d-lg-none UName">{{ expertinfo()->name ?? '' }}</small>
                                </a>
                                <div class="dropdown-menu NotiDrop Mmenu">
                                    <ul>
                                        <x-expert.menu/>
                                        <!-- <li class="{{ Request::segment(2) == 'dashboard' ? 'active' : '' }}"><a href="{{ route('expert.dashboard') }}"><span><i class="fal fa-tachometer-alt me-1"></i> Dashboard</a></a></li>
                                        @if (expertinfo()->profile_complete > 0)
                                        <li class="{{ Request::segment(2) == 'account' ? 'active' : '' }}"><a href="{{ route('expert.account') }}"><span><i class="fal fa-user-edit me-1"></i> My Account</a></a></li>
                                        <li><a href="#menumycalls" class="collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="false" aria-controls="menumycalls"><span><i class="fal fa-phone-rotary me-1"></i> My Calls</span> <i class="fal fa-chevron-down arrow"></i></a>
                                            <ul class="collapse" id="menumycalls">
                                                <li><a href="{{ route('expert.schedules') }}"><span><i class="fal fa-phone-alt me-1"></i> Scheduled Call</span></a></li>
                                                <li><a href="{{ route('expert.closeschedules') }}"><span><i class="fal fa-phone-slash me-1"></i> Closed Call</span></a></li>
                                                <li><a href="{{ route('expert.reschedules') }}"><span><i class="fal fa-phone-plus me-1"></i> Rescheduled Call</span></a></li>
                                            </ul>
                                        </li>
                                        <li class="{{ Request::segment(2) == 'slots' ? 'active' : '' }}"><a href="{{ route('expert.slots') }}"><span><i class="fal fa-tasks me-1"></i> Manage Slots</span></a></li>
                                        <li class="{{ Request::segment(2) == 'wallet' ? 'active' : '' }}"><a href="{{ route('expert.wallet') }}"><span><i class="fal fa-wallet me-1"></i> Wallet</span></a></li>
                                        <li class="{{ Request::segment(2) == 'message' ? 'active' : '' }}"><a href="{{ route('expert.message') }}"><span><i class="fal fa-comment-alt-lines me-1"></i> Message</span></a></li>
                                        <li class="{{ Request::segment(2) == 'videos' ? 'active' : '' }}"><a href="{{ route('expert.videos') }}"><span><i class="fal fa-photo-video me-1"></i> My Video</span></a></li>
                                        <li class="{{ Request::segment(2) == 'report' ? 'active' : '' }}"><a href="{{ route('expert.reports') }}"><span><i class="fal fa-file-contract me-1"></i> Reports</span></a></li>
                                        <li class="{{ Request::segment(2) == 'help' ? 'active' : '' }}"><a href="{{ route('expert.help') }}"><span><i class="fal fa-user-headset me-1"></i> Help Center</span></a></li>
                                        <li class="{{ Request::segment(2) == 'message' ? 'active' : '' }}"><a href="{{ route('expert.expertlogout') }}"><span><i class="fal fa-power-off me-1"></i> Logout</span></a></li>
                                        @endif -->
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if (\Auth::check())
                            <li class="dropdown MenuAll">
                                <a class="dropdown-toggle d-none d-lg-block" href="{{ route('user.dashboard') }}" title="{{ userinfo()->name ?? '' }}">
                                    <span class="userimg">
                                        <x-image-box>
                                            <x-slot:image>{{ userinfo()->profile }}</x-slot:image>
                                            <x-slot:path>/uploads/user/</x-slot:path>
                                            <x-slot:alt>{{ userinfo()->name ?? '' }}</x-slot:alt>
                                            <x-slot:height>36</x-slot:alt>
                                                <x-slot:width>36</x-slot:alt>
                                        </x-image-box>
                                    </span>
                                </a>
                                <a class="dropdown-toggle d-lg-none p-0" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" href="{{ route('user.dashboard') }}"
                                    title="{{ userinfo()->name ?? '' }}">
                                    <span class="userimg">
                                        <x-image-box>
                                            <x-slot:image>{{ userinfo()->profile }}</x-slot:image>
                                            <x-slot:path>/uploads/user/</x-slot:path>
                                            <x-slot:alt>{{ userinfo()->name ?? '' }}</x-slot:alt>
                                            <x-slot:height>36</x-slot:alt>
                                                <x-slot:width>36</x-slot:alt>
                                        </x-image-box>
                                    </span>
                                    <small class="d-block d-lg-none UName">{{ userinfo()->name ?? '' }}</small>
                                </a>
                                <div class="dropdown-menu NotiDrop Mmenu">
                                    <ul>
                                        <x-user.menu/>
                                        <!-- <li><a href="{{ route('user.dashboard') }}"><span><i class="fal fa-tachometer-alt me-1"></i> Dashboard</a></li>
                                        <li><a href="{{ route('user.account') }}"><span><i class="fal fa-user-edit me-1"></i> My Account</a></li>
                                        <li><a href="#Usermycalls" class="collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="false" aria-controls="Usermycalls"><span><i class="fal fa-phone-rotary me-1"></i> My Calls</span> <i class="fal fa-chevron-down arrow"></i></a>
                                            <ul class="collapse" id="Usermycalls">
                                                <li><a href="{{ route('user.schedules') }}"><span><i class="fal fa-phone-alt me-1"></i> Scheduled Call</span></a></li>
                                                <li><a href="{{ route('user.closeschedules') }}"><span><i class="fal fa-phone-slash me-1"></i> Closed Call</span></a></li>
                                                <li><a href="{{ route('user.reschedules') }}"><span><i class="fal fa-phone-plus me-1"></i> Rescheduled Call</span></a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('user.message') }}"><span><i class="fal fa-comment-alt-lines me-1"></i> Message</span></a></li>
                                        <li><a href="{{ route('user.wallet') }}"><span><i class="fal fa-wallet me-1"></i> Wallet</span></a></li>
                                        <li><a href="{{ route('user.reviews') }}"><span><i class="fal fa-star me-1"></i> My Reviews</span></a></li>
                                        <li><a href="{{ route('user.help') }}"><span><i class="fal fa-user-headset me-1"></i> Help Center</a></li>
                                        <li><a href="{{ route('user.userlogout') }}"><span><i class="fal fa-power-off me-1"></i> Logout</a></li> -->
                                    </ul>
                                </div>
                            </li>
                        @endif
                        <li class="SearchBoxs">
                            <a data-bs-toggle="collapse" href="#Hsearch" role="button" aria-expanded="false"
                                aria-controls="Search" title="Search"><span><img
                                        src="{{ asset('frontend/img/search1.svg') }}" alt="search" width="36" height="36">
                                    <!-- <i class="fal h5 fa-search m-0"></i> --></span></a>
                            <div id="Hsearch" class="collapse">
                                @csrf
                                <form action="{{ url('search') }}" class="input-group mb-0">
                                    <input type="text" name="searchlist" placeholder="Search..." required
                                        aria-label="Search..." aria-describedby="searchbox" class="form-control">
                                    <button id="searchbox1" class="input-group-text"><i
                                            class="fal fa-search"></i></button>
                                </form>
                                <div class="searchboxdata"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @else
            <div>
                <div class="col logom">
                    <a class="navbar-brand" href="javascript:void(0)">
                        <img src="{{ asset('frontend/img/logo-w.svg') }}" alt="{{project()}}" width="300"
                            height="68">
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</nav>
