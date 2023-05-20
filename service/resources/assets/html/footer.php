<section class="Subscribe">
        <div class="container">
            <div class="row">
                <div class="col s12 m6 l5">
                    <p class="SubTitle">JOIN OUR NEWSLETTER</p>
                    <h3 class="h5 Heading">Subscribe <span class="fw-900">Newsletter</span></h3>
                </div>
                <div class="col s12 m6 l7">
                    <form action="" method="post">
                        <div class="input-field"><input type="text" name="name" id="name" placeholder="Enter your email address" required=""><label for="name" class="active">Name*</label><button type="submit" class="btn btn-main waves-effect waves-light">Subscribe</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
	</div>
	<footer>
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col s12 m6 l3">
						<h4 class="h6">Services</h4>
						<ul>
							<li><a href="service.php" title="Start Business">Start Business</a></li>
	                        <li><a href="service.php" title="Registration & License">Registration & License</a></li>
	                        <li><a href="service.php" title="Tax & Compliance">Tax & Compliance</a></li>
	                        <li><a href="service.php" title="Trademark & Copyright">Trademark & Copyright</a></li>
	                        <li><a href="service.php" title="E-Commerce">E-Commerce</a></li>
						</ul>
					</div>
					<div class="col s12 m6 l3">
						<h4 class="h6">ExpertBells</h4>
						<ul>
	                        <li><a href="about-us.php" title="About Us">About us</a></li>
	                        <li><a href="career.php" title="Career">Career</a></li>
	                        <li><a href="blog.php" title="Blog">Blog</a></li>
	                        <li><a href="online-payment.php" title="Online Payment">Online Payment</a></li>
	                        <li><a href="contact-us.php" title="Contact us">Contact us</a></li>
						</ul>
					</div>
					<div class="col s12 m6 l3">
						<h4 class="h6 text-u">Terms & Reviews</h4>
						<ul>
	                        <li><a href="terms-and-conditions.php" title="Terms & Conditions">Terms & Conditions</a></li>
	                        <li><a href="privacy-policy.php" title="Privacy Policy">Privacy Policy</a></li>
	                        <li><a href="refund-policy.php" title="Refund Policy">Refund Policy</a></li>
	                        <li><a href="user-reviews.php" title="User Reviews">User Reviews</a></li>
						</ul>
					</div>
					<div class="col s12 l3">
						<h4 class="h6">Support Details</h4>
						<ul class="con-info">
                            <!-- <li><i class="icofont-map-pins"></i> 6b Chanakya Puri, MG Road-2,<br>Shahganj, Agra Uttar Pradesh, 282010.</li> -->
                            <li><i class="icofont-phone"></i> <a href="tel:+917706818571">(+91) 914 917 5204</a></li>
                            <li><i class="icofont-envelope"></i> <a href="mailto:expertbellsconsulting@gmail.com">expertbellsconsulting@gmail.com</a></li>
						</ul>
                        <img src="images/iso.png">
                        <ul class="icons">
				            <li><a href="https://twitter.com/" target="_blank"><i class="icofont-twitter"></i></a></li>
				            <li><a href="https://www.facebook.com/" target="_blank"><i class="icofont-facebook"></i></a></li>
				            <li><a href="#" target="_blank"><i class="icofont-youtube"></i></a></li>                   
				        </ul>
                    </div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col s12">
						<p class="center-align">© 2020 ExpertBells. All Rights Reserved <!-- Developed by <a href="https://www.samwebstudio.com/" target="_blank" class="mcolor fw-900 text-u">Sam Web Studio</a> --></p>
					</div>
				</div>
			</div>
		</div>
	</footer>
</main>
<!-- <div class="backtotop tooltipped" data-position="left" data-tooltip="Back to Top"><a href="#top"><i class="fa fa-rocket fa-3x"></i></a></div> -->
<!-- jquery V 3.5.0 "jquery.min.js" -->
<div id="qcontact"><span>Get Free Consultancy</span></div>
    <div class="qform">
        <h4 class="h5">Public Limited Company</h4>
        <div class="input-field">
            <input id="name" type="text" class="validate">
            <label for="name">Name</label>
        </div>
        <div class="input-field ">
            <input id="Phone" type="text" class="validate">
            <label for="Phone">Phone No.</label>
        </div>
        <div class="input-field">
            <input id="email" type="email" class="validate">
            <label for="email">Email</label>
        </div>
        <div class="input-field">
            <div class="input-field"><textarea name="message" id="message" class="materialize-textarea" maxlength="300" data-length="300"></textarea><label for="message" class="active">Message</label></div>
        </div>
        <div class="center-align pt10px">
            <a href="#" class="btn btn-main btn-block mt10px">Get Free Consultancy</a>
            <a href="#" class="qformhide pt10px d-block">Cancel</a>
        </div>
    </div>
<script type="text/javascript" passive src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<!-- <script type="text/javascript" passive src="js/jquery.min.js"></script> -->
<!-- materialize V 1.0.0 "materialize.js" -->
<script type="text/javascript" passive src="js/materialize.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script type="text/javascript">AOS.init({ easing: 'ease-in-out-sine' });</script>
<script type="text/javascript">
	$(document).ready(function(){
 
	$('#qcontact').click(function () {
	 
		$(".qform").addClass("pull")
	});

	$('.qformhide').click(function () {
		$(".qform").removeClass("pull")
	});	

	  	if ($(window).width() > 600){
			$(window).scroll(function(){
				if ($(this).scrollTop() > 180){
					$('.backtotop').fadeIn();
				} else {
					$('.backtotop').fadeOut();
				}
			});
		};
	});
	$(document).ready(function(){
    	$('.scrollspy').scrollSpy();
  	});
</script>
<script>
$('.BBotoom>div>.row>.col>ul>li').hover(
    function(){ $(this).addClass('active') },
    function(){ $(this).removeClass('active') }
)
</script>
</body>
</html>