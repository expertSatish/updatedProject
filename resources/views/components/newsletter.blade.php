<div class="SubScri">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 text-center">
                <h2 class="h1 thm">Subscribe to our Newsletter</h2>
                <p class="h5 text-secondary">Receive updates instanly</p>
                <form class="input-group newsletterform mb-3 mt-5" method="POST">
                    @csrf
                    <img src="{{asset('frontend/img/mail.svg')}}" alt="mail" height="40" width="60">
                    <input type="text" class="form-control" name="subscribe_email" placeholder="Enter your email" aria-label="Enter your email" aria-describedby="searchbox">
                    <button class="input-group-text btn btn-thm2 ncsbtn" id="searchbox">Subscribe</button>
                    <button type="button" class="input-group-text nspbtn btn btn-thm2" style="display:none" disabled><i class="fad fa-spinner-third fa-spin ms-0" style="font-size: 30px;"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const newsletterform = @json(route('savenewsletter'));
</script>