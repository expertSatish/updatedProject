<section class="Subscribe">
		<div class="container">
			<div class="row">
				<div class="col s12 m6 l5">
					<p class="SubTitle">JOIN OUR NEWSLETTER</p>
					<h3 class="h5 Heading">Subscribe <span class="fw-900">Newsletter</span></h3>
				</div>
				<div class="col s12 m6 l7">
					<form action="{{url('/newsletter-save')}}" method="post">
						@csrf
						<div class="input-field"><input type="text" name="email" id="Newsletter" placeholder="Enter your email address" required><label for="Newsletter" class="active">Name*</label><button type="submit" class="btn btn-main waves-effect waves-light">Subscribe</button></div>
					</form>
				</div>
			</div>
		</div>
	</section>
	</div>
    <!-- Footer -->
	<footer>
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col s12 m6 l3">
						<h4 class="h6">Services</h4>
						@php
						$services = DB::table('nav_category')->where('footer_status', 1)->get();
						@endphp
						<ul>
							@foreach($services as $i)
							<li><a href="{{route('service',$i->alias)}}" title="Start Business">{{$i->title}}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="col s12 m6 l3">
						<h4 class="h6">ExpertBells</h4>
						<ul>
							<li><a href="{!! url('about-us') !!}" title="About Us">About us</a></li>
							<!--<li><a href="{!! url('service') !!}" title="Service">Service</a></li>-->
							<li><a href="{!! url('career') !!}" title="Career">Career</a></li>
							<li><a href="{!! url('online-payment') !!}" title="Online Payment">Online Payment</a></li>
							<li><a href="{!! url('contact-us') !!}" title="Contact us">Contact us</a></li>
							<li><a href="{!! url('blog') !!}" title="Blog">Blog</a></li>
							
						</ul>
					</div>
					<div class="col s12 m6 l3">
						<h4 class="h6 text-u">Terms & Reviews</h4>
						<ul>
							<li><a href="{{ url('/terms-and-conditions') }}" title="Terms & Conditions">Terms & Conditions</a></li>
							<li><a href="{!! url('/privacy-policy') !!}" title="Privacy Policy">Privacy Policy</a></li>
							<li><a href="{!! url('/refund-policy') !!}" title="Refund Policy">Refund Policy</a></li>
							<li><a href="{!! url('/testimonial-list') !!}" title="User Reviews"> Testimonial</a></li>
						</ul>
					</div>
					<div class="col s12 m6 l3">
						<h4 class="h6">Support Details</h4>
						<ul class="con-info">
							<!-- <li><i class="icofont-map-pins"></i> 6b Chanakya Puri, MG Road-2,<br>Shahganj, Agra Uttar Pradesh, 282010.</li> -->
							<li><i class="icofont-phone"></i> <a href="tel:+917438-99-7438">(+91) 7438-99-7438</a></li>
							<li><i class="icofont-envelope"></i> <a href="mailto:info@expertbells.com">info@expertbells.com</a></li>
						</ul>
						<!-- <div class="row">
							<div class="col m6"><img class="w100" loading="lazy" src="{{asset('resources/assets/frontend/images/iso.png')}}" height="70" width="70"></div>
							<div class="col m6"><img class="w100" loading="lazy" src="{{asset('resources/assets/frontend/images/startup-india.png')}}" height="70" width="70"></div>
						</div> -->
						<div class="fimg"><img loading="lazy" src="{{asset('resources/assets/frontend/images/iso.png')}}" alt="ISO-9001:2015" height="66" width="135"><img loading="lazy" src="{{asset('resources/assets/frontend/images/startup-india.png')}}" alt="start-up-india" height="30" width="135"></div>
						<div class="center mb10px"><a href="https://www.trustpilot.com/review/expertbells.com" target="_blank" rel="nofollow"><img loading="lazy" src="{{asset('resources/assets/frontend/images/Trustpilot_logo1.png')}}" alt="start-up-india" width="320" height="79" style="height:auto;"></a></div>
						<ul class="icons">
							@php
							$icons=DB::table('social_media')->where('status',1)->get();
							@endphp
							@foreach($icons as $i)
							<li><a href="{{$i->link}}" target="_blank" title="{{$i->link}}" rel="noopener">{!! $i->icon !!}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col s12">
						<p class="center-align">© 2020 ExpertBells. All Rights Reserved
							<!-- Developed by <a href="https://www.samwebstudio.com/" target="_blank" class="mcolor fw-900 text-u">Sam Web Studio</a> -->
						</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
	</main>

	<div id="qcontact"><span>Get Free Consultancy</span></div>
	<form action="{{url('/consultancy-form-save')}}" method="post">
		@csrf
		<div class="qform @if (count($errors) > 0) pull @endif">
			<h4 class="h5">Get Free Consultancy</h4>
			<div class="input-field">
				<input id="name" type="text" name="enquiry_name" class="validate" required>
				<label for="name">Name</label>
			</div>
			<div class="input-field ">
				<input id="Phone" type="text" name="phone" class="validate" required>
				<label for="Phone">Phone No.</label>
			</div>
			<div class="input-field">
				<input id="remail" type="email" name="email" class="validate" required>
				<label for="remail">Email</label>
			</div>
			<div class="input-field">
				<div class="input-field"><textarea name="message" id="message" style="max-height:120px!important; height:auto; overflow-y: auto;" class="materialize-textarea" required maxlength="300" data-length="300"></textarea><label for="message">Message</label></div>
			</div>
			<div class="center-align pt10px">
				<button type="submit" class="btn btn-main mt10px">Submit</button>
				<span class="qformhide cur pt10px d-block">Cancel</span>
			</div>
		</div>
	</form>
	<style type="text/css">
	.whatsappblock{bottom:21px; left:23px; opacity:1; transition:opacity .5s; box-sizing:border-box; direction:ltr; position:fixed!important; z-index:99!important}
	.whatsappblock a{width:50px; height:50px; order:1; padding:5px; box-sizing:border-box; border-radius:50%; cursor:pointer; overflow:hidden; box-shadow:rgb(0 0 0/.4) 2px 2px 6px; transition:all .5s; position:relative; z-index:9; display:block; border:0px; background:rgb(77 194 71)!important}
	.whatsappblock a svg{width:100%; height:100%; fill:rgb(255 255 255); stroke:none}
	.OnPopup{width:96%;max-width:580px;background:linear-gradient(45deg, #eee, #fff);z-index:9999;top:15%!important;}
	.OnPopup .input-field input{border-radius:5px}
	.OnPopup+.modal-overlay{opacity:;transition:all .5s}
	.RightBottom{max-width:250px;width:100%;border-radius:12px 0 0;overflow:hidden;background:#eee;position:fixed;right:0;bottom:0;z-index:9}
	.RightBottom ul{display:flex;padding:0;margin:0}
	.RightBottom ul li{width:100%}
	.RightBottom ul li.mob,.mob{display:none}
	.RightBottom ul li a{color:#fff}
	.RightBottom ul li a i{padding:12px 30px 20px;display:inline-flex;width:100%;align-content:center;justify-content:center;font-size:24px;position:relative}
	.RightBottom ul li a i:after{position:absolute;content:'Call Now';left:0;right:0;bottom:8px;font-size:11px;color:#fff;text-align:center;font-family:"Open Sans", Arial, sans-serif}
	.RightBottom ul li a i.fa-envelope-o:after{content:'Email'}
	.RightBottom ul li a i.fa-whatsapp:after{content:'WhatsApp'}
	.RightBottom ul li a i.fa-phone{background:#007bff!important}
	.RightBottom ul li a i.fa-envelope-o{background:#17a2b8!important}
	.RightBottom ul li a i.fa-whatsapp{background:#4dc247!important}
	@media (max-width:767px){.RightBottom{max-width:100%;border-radius:0}
	.RightBottom ul li.mob,.mob{display:block}
	.RightBottom ul li.des,.des{display:none}}
	</style>
	<div class="RightBottom">
		<ul>
			<li><a href="tel:+917438997438"><i class="fa fa-phone"></i></a></li>
			<li><a href="mailto:expertbellsconsulting@gmail.com"><i class="fa fa-envelope-o"></i></a></li>
			<li class="des"><a href="https://api.whatsapp.com/send?phone=+917438997438&amp;text=Hi, I would like to get more information.." target="_blank" rel="noreferrer" title="Support On WhatsApp"><i class="fa fa-whatsapp"></i></a></li>
			<li class="mob"><a href="whatsapp://send?text=Hi, I would like to get more information..!&amp;phone=+917438997438" rel="noreferrer" target="_blank" title="Support On WhatsApp"><i class="fa fa-whatsapp"></i></a></li>
		</ul>
	</div>
	<!-- <div class="whatsappblock" title="Contact Us On WhatsApp">
		<a href="https://api.whatsapp.com/send?phone=+917438997438" data-position="right" data-tooltip="Contact Us On WhatsApp" title="Whatsapp" target="_blank" rel="noopener">
			<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z"></path></svg>
		</a>
	</div> -->
	
    <div id="OnPopup" class="modal customize OnPopup">
        <div class="modal-content">
            <div class="center">
                <h4 class="h5 Heading mb10px">Enquire Now</h4>
            </div>
            <form method="POST" action="{{url('/consultancy-form-save')}}" enctype="multipart/form-data" id="contactform" class="ConForm" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col s12">
                        <div class="input-field">
                            <input id="pfirst_name" name="enquiry_name" type="text" class="validate" required="">
                            <label for="pfirst_name">Full Name</label>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field">
                            <input id="pemail" type="email" name="email" class="validate" required="">
                            <label for="pemail">Email</label>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field">
                            <input id="pcontactno" type="text" name="phone" class="validate" required="">
                            <label for="pcontactno">Phone No.</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col s12 center">
                        <button type="submit" class="btn btn-main">Submit</button> &nbsp; <button type="reset" class="btn btn-main1">Reset</button>
                    </div>
                </div>
            </form>
        </div>
        <a href="javascript:void(0);" class="modal-action modal-close h5">&#10005;</a>
    </div>
    @php 
    $modal = DB::table('popup')->where(['id'=>1,'status'=>1])->first();
    @endphp
    @if(!empty($modal))
    <style>
    .DOnPopup{max-width:700px;}
    .DOnPopup p{font-size:14px!important;}
    </style>
    <div id="dynamic-popup{{empty($modal)?'22':''}}" class="modal customize DOnPopup">
        <div class="modal-content center">
            <h5 class="mcolor1">{{$modal->title}}</h5>
            {!! $modal->description !!}
            @if(!empty($modal->image))
                <img src="{{asset('resources/assets/uploads/cms/'.$modal->image)}}" class="w100">
            @endif
        </div>
        <a href="javascript:void(0);" class="modal-action modal-close h5">&#10005;</a>
    </div>
    @endif
    
    <div class="modal-overlay"></div>
	<div class="backtotop tooltipped" data-position="left" data-tooltip="Back to Top"><a href="#top"><i class="fa fa-angle-up"></i></a></div>
	<!-- Icon Fonts CSS -->
	<link rel="preload" href="{{asset('resources/assets/frontend/css/icofont.css')}}" as="style" onload="this.rel='stylesheet'">
	<link rel="preload" href="{{asset('resources/assets/frontend/fonts/icofont.woff2')}}" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="{{asset('resources/assets/frontend/css/font-awesome.min.css')}}" as="style" onload="this.rel='stylesheet'">
	<link rel="preload" href="{{asset('resources/assets/frontend/fonts/fontawesome-webfont.woff2?v=4.6.3')}}" as="font" type="font/woff2" crossorigin>
	<!-- <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" as="style" onload="this.rel='stylesheet'" /> -->
	<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" as="style" onload="this.rel='stylesheet'" />
	<link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" as="style" onload="this.rel='stylesheet'">
	
    <!-- Optional JavaScript; choose one of the two! -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" referrerpolicy="no-referrer"></script>
	<script async src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" referrerpolicy="no-referrer" crossorigin="anonymous"></script>
    <!-- Option 1: Materialize with Popper -->
	<script defer src="{{asset('resources/assets/frontend/js/materialize.js')}}"></script>
	<script src="{{asset('resources/assets/frontend/js/init.js')}}"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" referrerpolicy="no-referrer" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js"></script> 
	<script type="text/javascript">
		$(document).ready(function() {
			// setTimeout(function(){
			// 	var id = '#OnPopup';
			// 	$('.modal-overlay').show();
			// 	$('.modal-overlay').fadeTo("slow",.7);
			// 	$('body').css({'overflow':'hidden'});
			// 	$(id).fadeIn(800).css({"transform":"translateY(0)"});
			// }, 7000);
			// alert($.cookie('pop'));
		    if ($.cookie('pop') == null) {
		        setTimeout(function() {
		        	var id = '#OnPopup';
				// 	$('.modal-overlay').show();
				// 	$('.modal-overlay').fadeTo("slow",.7);
				// 	$('body').css({'overflow':'hidden'});
				// 	$(id).fadeIn(800).css({"transform":"translateY(0)"});
		        	$('#dynamic-popup').modal('open');
		        }, 1000);
		        $.cookie('pop', '1');
		    }
			$('.modal .modal-close').click(function (e) {
                e.preventDefault();
                $('.modal-overlay').hide();
                $('.modal').hide();
                $('body').css({'overflow':'auto'});
            });
            $('.modal-overlay').click(function () {
                $(this).hide();
                $('.modal').hide();
                $('body').css({'overflow':'auto'});
            });
		});
	</script>
	<script>
		$(document).ready(function(){
			$(".sidenav .dropdown-trigger").dropdown({
				coverTrigger: false,
				closeOnClick: false,
				hover: false
			});
			$(".menu-dropdown").dropdown({
				coverTrigger: false,
				closeOnClick: false,
				hover: true
			});
		});
	</script>
	<script type="text/javascript">
		window.addEventListener('touchmove', event =>{
			console.log(event);}, {passive: true});
		// AOS.init({ easing: 'ease-in-out-sine' });
		$(document).ready(function() {
			$('#qcontact').click(function() {

				$(".qform").addClass("pull")
			});

			$('.qformhide').click(function() {
				$(".qform").removeClass("pull")
			});

			if ($(window).width() > 600) {
				$(window).scroll(function() {
					if ($(this).scrollTop() > 180) {
						$('.backtotop').fadeIn();
					} else {
						$('.backtotop').fadeOut();
					}
				});
			};
		});
		$(document).ready(function() {
			$('.scrollspy').scrollSpy();
		});
		$('.BBotoom>div>.row>.col>ul>li').hover(
			function() {
				$(this).addClass('active')
			},
			function() {
				$(this).removeClass('active')
			}
		)
	</script>


	<script type="text/javascript">
		function isStringKey(evt) {
			var charCode = (evt.which) ? evt.which : evt.keyCode
			if (!(charCode >= 65 && inputValue <= 122) && (charCode != 32 && charCode != 0))
				return false;
			return true;
		}

		function isNumberKey(evt) {
			var charCode = (evt.which) ? evt.which : evt.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
		}
	</script>

	<script>
		$('#alert_close_errer').click(function() {
			$("#alert_box_errer").fadeOut("slow", function() {});
		});
		$('#alert_close').click(function() {
			$("#alert_box").fadeOut("slow", function() {});
		});
	</script>


	@if(session()->has('success_msg')) <script>
		toastr.success("{{ session()->get('success_msg') }}");
	</script> @endif

	@if(session()->has('error_msg')) <script>
		toastr.error("{{ session()->get('error_msg') }}");
	</script> @endif
	@if(Request::segment(1)!='signup' && Request::segment(1)!='login')

	@include('inc.meta.common-script')

	@if(Request::segment(1)=='blog')
	@include('inc.meta.blog-script')
	@endif
	@endif

	@include('inc.alerts')
	</body>

	</html>