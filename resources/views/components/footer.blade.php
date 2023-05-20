<footer>
    <div class="FooterMid">
        <div class="container">
            @if(Request::segment(2)!=='videocall')
            <div class="row">
                <div class="col-12 col-lg-3">
                    <a href="" class="flogo"><img src="{{asset('frontend/img/logo-w.svg')}}" alt="Expert Bells" width="150" height="120"></a>
                    <p>{{$footer->footer_about}}</p>
                </div>
                <div class="col-12 col-lg-9 ps-lg-5">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <h3 class="h5">Important Links</h3>
                            <ul class="links">
                                <li><a href="{{route('experts')}}">Find a Mentor</a></li>
                                <li><a href="{{route('becomeanexpert')}}">Become as a Mentor</a></li>
                                <li><a href="{{route('about')}}">About Us</a></li>
                                <li><a href="{{route('blog')}}">Blog</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-4">
                            <h3 class="h5">Informations</h3>
                            <ul class="links">
                                <li><a href="{{route('contact')}}">Contact us</a></li>
                                <li><a href="{{route('faq')}}">FAQ</a></li>
                                <li><a href="{{route('privacypolicy')}}">Privacy Policy</a></li>
                                <li><a href="{{route('termsandconditions')}}">Terms of Conditions</a></li>
                                <li><a href="{{route('careers')}}">Career</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-4">
                            <h3 class="h5">Support</h3>
                            <p>{{$footer->footer_support}}</p>
                            <a href="{{route('becomeanexpert')}}" class="btn btn-thm btn-lg">Become a Mentor <img src="{{asset('frontend/img/arrow.svg')}}" alt="arrow" class="ms-2" width="30" height="30"></a>
                            <ul class="icons mt-3">
                                @foreach ($icons as $icon)
                                    <li>
                                        <a href="{{$icon->link}}" target="_blank" title="{{ucwords($icon->title)}}">
                                            @if($icon->title=='facebook') <i class="fab fa-facebook-f"></i> @endif
                                            @if($icon->title=='twitter') <i class="fab fa-twitter"></i> @endif
                                            @if($icon->title=='linkedin') <i class="fab fa-linkedin-in"></i> @endif
                                            @if($icon->title=='pinterest') <i class="fab fa-pinterest-p"></i> @endif
                                            @if($icon->title=='instagram') <i class="fab fa-instagram"></i> @endif
                                            @if($icon->title=='youtube') <i class="fab fa-youtube"></i> @endif
                                        </a>
                                    </li>
                                @endforeach                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fbottom">
                <div class="row align-items-center">
                    <div class="col-12 text-center"><p class="mb-1 text-center">&copy; Copyright {{ now()->year }} <strong>Expert Bells</strong> All Rights Reserved.</p></div>
                    <!--<div class="col-md-4 text-center"></div>-->
                    <!--<div class="col-md-4 text-end"><p>Made with &nbsp;<strong><i class="fa fa-heart text-danger"></i></strong>&nbsp; by <strong><a href="https://www.samwebstudio.com/" target="_blank">SAM Web Studio</a></strong></p></div>-->
                </div>
            </div>
            @else
            <div class="fbottom">
                <div class="row align-items-center">
                    <div class="col-12 text-center"><p class="mb-1 text-center">&copy; Copyright {{ now()->year }} <strong>Expert Bells</strong> All Rights Reserved.</p></div>
                    <!--<div class="col-md-4 text-center"></div>-->
                    <!--<div class="col-md-4 text-end"><p>Made with &nbsp;<strong><i class="fa fa-heart text-danger"></i></strong>&nbsp; by <strong><a href="https://www.samwebstudio.com/" target="_blank">SAM Web Studio</a></strong></p></div>-->
                </div>
            </div>
            @endif
        </div>
    </div>
</footer>

<!-- Optional CSS; -->


<link rel="preload" as="style" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" onload="this.rel='stylesheet'" crossorigin="anonymous"/>
<!-- <link rel="preload" as="style" href="css/font-awesome-5-15-4.min.css" onload="this.rel='stylesheet'" crossorigin="anonymous"/> -->

<div id="scroll-top"><i class="far fa-chevron-up"></i></div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="{{asset('frontend/js/custom-min.js')}}"></script>
@stack('js')
{{-- <script>flatpickr(".inlinecal",{
        inline:true,
        minDate: "today",        
        defaultDate: ["{{date('Y-m-d')}}"]
    });</script> --}}
<script type="text/javascript">
$(document).ready(function() {
    toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true,
        "positionClass" : "toast-top-center"
        }
    @if(session()->has('success'))
        toastr.success("{{ session('success') }}");
    @endif
    @if(session()->has('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif        
    @if(session()->has('error'))
        toastr.error("{{ session('error') }}");
    @endif
}); 


setTimeout(function(){
    $('.alert').fadeOut();
},5000);
$('.TimeBox.Date .btn-check').click(function() {
    $('.SetTimeBox').fadeIn();
    $('.Request').fadeIn();
    $('.DateBox').hide();
});
$('.SetTimeBox .btn-back').click(function() {
    $('.SetTimeBox').hide();
    $('.DateBox').fadeIn();
});
$('.TopTimeBox li').find('label').click(function() {
    var price = $(this).data('price');
    var cprice = $(this).data('cprice');
    $('.price del').fadeIn();
    $('.mprice').text(price);
    $('.bprice').text(cprice);
});
function RemoveConfirmation(){
    if(confirm('Are you sure! you want to remove this record.')){
        return true;
    }
    return false;
}
$('.social-button').attr('target','_blank');
</script>
<div id="DeleteModal" class="modal fade">
	<div class="modal-dialog modal-sm  modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body text-center removemodalbox">
                <h6>ARE YOU SURE?</h6>
				<small>Do you really want to delete these records?</small>
                <small> This process will not be undone.</small><br>
                <input type="hidden" id="removeurl">              
                <a href="javascript:void(0);" onclick="$('.removerecord').hide(); $('.proremoverecord').show();" class="btn btn-danger mt-3 removerecord"><i class="fas fa-check"></i></a>
                <a href="javascript:void(0);" class="btn btn-danger mt-3 proremoverecord disabled" style="display: none"><i class="fad fa-spinner-third fa-spin"></i></a>
                <button type="button" class="btn btn-secondary mt-3" onclick="$('.removerecord').attr('href','javascript:void(0);');" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>			
		</div>
	</div>
</div>  