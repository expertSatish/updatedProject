<template>
    <main>
        <section class="HearderSec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="MBox mt-5 pt-5 text-center">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <span class="h5 fw-normal">Startup Advice from</span>
                                    <h1 class="mb-4">World Class Experts</h1>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                                    <a href="experts.php" class="btn btn-thm btn-lg">Find an Expert <img src="frontend/img/arrow.svg" class="ms-3" width="30" height="30"></a>
                                    <!-- <div><a href="experts.php" class="btn btn-thm1 btn-sm">Home Decor</a> <a href="experts.php" class="btn btn-thm1 btn-sm">Career & Business</a> <a href="experts.php" class="btn btn-thm1 btn-sm">Wellness</a> <a href="experts.php" class="btn btn-thm1 btn-sm">Style & Beauty</a> <a href="experts.php" class="btn btn-thm1 btn-sm">Astrology & more</a></div> -->
                                </div>
                            </div>
                            <div class="VideoBox wow zoomIn">
                                <button class="playbtn play"><span></span></button>
                                <video poster="/frontend/img/video-img.svg" id="PVideo" muted loop playsinline preload="metadata"><source src="frontend/img/video/video.mp4" type="video/mp4"></video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>    
        <section class="TabSec">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="Heading h2">Find an Expert in easy steps</h2>
                    </div>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-12 col-md-6 order-md-last">
                        <ul class="SerMenu ms-md-5" id="top-menu">
                            <li class="active">
                                <a href="#step1">
                                    <div class="w-100"><span class="TitleS">Find an Expert</span>
                                    <span class="Scon">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></div>
                                </a>
                                <picture>
                                    <source srcset="frontend/img/step1.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/step1.svg" alt="steps" width="380" height="480" class="d-md-none">
                                </picture>
                            </li>
                            <li>
                                <a href="#step2">
                                    <div class="w-100"><span class="TitleS">Book a Video Call</span>
                                    <span class="Scon">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></div>
                                </a>
                                <picture>
                                    <source srcset="frontend/img/step2.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/step2.svg" alt="steps" width="380" height="480" class="d-md-none">
                                </picture>
                            </li>
                            <li>
                                <a href="#step3">
                                    <div class="w-100"><span class="TitleS">Connect Directly</span>
                                    <span class="Scon">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></div>
                                </a>
                                <picture>
                                    <source srcset="frontend/img/step3.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/step3.svg" alt="steps" width="380" height="480" class="d-md-none">
                                </picture>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-6 d-none d-md-block">
                        <section id="step1" class="ConS">
                            <picture>
                                <source srcset="frontend/img/step1.webp" type="image/webp">
                                <img loading="lazy" src="frontend/img/step1.svg" alt="steps" width="380" height="480">
                            </picture>
                        </section>
                        <section id="step2" class="ConS">
                            <picture>
                                <source srcset="frontend/img/step2.webp" type="image/webp">
                                <img loading="lazy" src="frontend/img/step2.svg" alt="steps" width="380" height="480">
                            </picture>
                        </section>
                        <section id="step3" class="ConS">
                            <picture>
                                <source srcset="frontend/img/step3.webp" type="image/webp">
                                <img loading="lazy" src="frontend/img/step3.svg" alt="steps" width="380" height="480">
                            </picture>
                        </section>
                    </div>
                </div>
            </div>
        </section>
        <section class="Sec2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 200" fill="#fff"><polygon points="1600 200 1600 0 0 0 0 200 799.7 0.07 1600 200"/></svg>
            <div class="container">
                <div class="row justify-content-center wow slideInDown">
                    <div class="col-lg-9 col-md-10 text-center">
                        <h2 class="Heading h2">Choose Your Expert</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="owl-carousel ExpertsC">
                            <div class="item">
                                <div class="card ExpBlock verify">
                                    <a href="experts-intro.php" class="card-header">
                                        <picture>
                                            <source srcset="frontend/img/exp-img1.webp" type="image/webp">
                                            <img loading="lazy" src="frontend/img/exp-img1.svg" alt="Product" width="380" height="480">
                                        </picture>
                                        <div loading="lazy" style="background:url('frontend/img/exp-img1.webp')"></div>
                                    </a>
                                    <a href="experts-intro.php" class="card-body text-center">
                                        <h3>Expert Name</h3>
                                        <small class="text-black"><strong class="d-block">Tech Entrepreneur + Investor</strong> (Business advisor)</small>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card ExpBlock">
                                    <a href="experts-intro.php" class="card-header">
                                        <picture>
                                            <source srcset="frontend/img/exp-img2.webp" type="image/webp">
                                            <img loading="lazy" src="frontend/img/exp-img2.svg" alt="Product" width="380" height="480">
                                        </picture>
                                        <div loading="lazy" style="background:url('frontend/img/exp-img2.webp')"></div>
                                    </a>
                                    <a href="experts-intro.php" class="card-body text-center">
                                        <h3>Expert Name</h3>
                                        <small class="text-black"><strong class="d-block">Tech Entrepreneur + Investor</strong> (Business advisor)</small>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card ExpBlock">
                                    <a href="experts-intro.php" class="card-header">
                                        <picture>
                                            <source srcset="frontend/img/exp-img3.webp" type="image/webp">
                                            <img loading="lazy" src="frontend/img/exp-img3.svg" alt="Product" width="380" height="480">
                                        </picture>
                                        <div loading="lazy" style="background:url('frontend/img/exp-img3.webp')"></div>
                                    </a>
                                    <a href="experts-intro.php" class="card-body text-center">
                                        <h3>Expert Name</h3>
                                        <small class="text-black"><strong class="d-block">Tech Entrepreneur + Investor</strong> (Business advisor)</small>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card ExpBlock">
                                    <a href="experts-intro.php" class="card-header">
                                        <picture>
                                            <source srcset="frontend/img/exp-img4.webp" type="image/webp">
                                            <img loading="lazy" src="frontend/img/exp-img4.svg" alt="Product" width="380" height="480">
                                        </picture>
                                        <div loading="lazy" style="background:url('frontend/img/exp-img4.webp')"></div>
                                    </a>
                                    <a href="experts-intro.php" class="card-body text-center">
                                        <h3>Expert Name</h3>
                                        <small class="text-black"><strong class="d-block">Tech Entrepreneur + Investor</strong> (Business advisor)</small>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card ExpBlock">
                                    <a href="experts-intro.php" class="card-header">
                                        <picture>
                                            <source srcset="frontend/img/exp-img5.webp" type="image/webp">
                                            <img loading="lazy" src="frontend/img/exp-img5.svg" alt="Product" width="380" height="480">
                                        </picture>
                                        <div loading="lazy" style="background:url('frontend/img/exp-img5.webp')"></div>
                                    </a>
                                    <a href="experts-intro.php" class="card-body text-center">
                                        <h3>Expert Name</h3>
                                        <small class="text-black"><strong class="d-block">Tech Entrepreneur + Investor</strong> (Business advisor)</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="text-center"><a href="experts.php" class="btn btn-thm2">View More <i class="fal fa-arrow-right"></i></a></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="Sec6">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="Heading h2">Featured in</h2>
                    </div>
                    <div class="col-12">
                        <div class="owl-carousel">
                            <picture>
                                <source srcset="frontend/img/fe-img1.webp" type="image/webp">
                                <img loading="lazy" src="frontend/img/fe-img1.svg" alt="Product" width="220" height="90">
                            </picture>
                            <picture>
                                <source srcset="frontend/img/fe-img2.webp" type="image/webp">
                                <img loading="lazy" src="frontend/img/fe-img2.svg" alt="Product" width="220" height="90">
                            </picture>
                            <picture>
                                <source srcset="frontend/img/fe-img3.webp" type="image/webp">
                                <img loading="lazy" src="frontend/img/fe-img3.svg" alt="Product" width="220" height="90">
                            </picture>
                            <picture>
                                <source srcset="frontend/img/fe-img4.webp" type="image/webp">
                                <img loading="lazy" src="frontend/img/fe-img4.svg" alt="Product" width="220" height="90">
                            </picture>
                            <picture>
                                <source srcset="frontend/img/fe-img5.webp" type="image/webp">
                                <img loading="lazy" src="frontend/img/fe-img5.svg" alt="Product" width="220" height="90">
                            </picture>
                            <picture>
                                <source srcset="frontend/img/fe-img6.webp" type="image/webp">
                                <img loading="lazy" src="frontend/img/fe-img6.svg" alt="Product" width="220" height="90">
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="Sec7 bgthm">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <h2 class="Heading h2">Find an Expert Category</h2>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <picture>
                                    <source srcset="frontend/img/exp-cat1.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/exp-cat1.svg" alt="Business" width="90" height="90">
                                </picture>
                            </div>
                            <div class="card-body">
                                <h3 class="h4">Business</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <picture>
                                    <source srcset="frontend/img/exp-cat2.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/exp-cat2.svg" alt="Sales & Marketing" width="90" height="90">
                                </picture>
                            </div>
                            <div class="card-body">
                                <h3 class="h4">Sales & Marketing</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <picture>
                                    <source srcset="frontend/img/exp-cat3.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/exp-cat3.svg" alt="Funding" width="90" height="90">
                                </picture>
                            </div>
                            <div class="card-body">
                                <h3 class="h4">Funding</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <picture>
                                    <source srcset="frontend/img/exp-cat4.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/exp-cat4.svg" alt="Product & Design" width="90" height="90">
                                </picture>
                            </div>
                            <div class="card-body">
                                <h3 class="h4">Product & Design</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <picture>
                                    <source srcset="frontend/img/exp-cat5.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/exp-cat5.svg" alt="Technology" width="90" height="90">
                                </picture>
                            </div>
                            <div class="card-body">
                                <h3 class="h4">Technology</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <picture>
                                    <source srcset="frontend/img/exp-cat6.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/exp-cat6.svg" alt="Skills & Management" width="90" height="90">
                                </picture>
                            </div>
                            <div class="card-body">
                                <h3 class="h4">Skills & Management</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <picture>
                                    <source srcset="frontend/img/exp-cat7.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/exp-cat7.svg" alt="Industries" width="90" height="90">
                                </picture>
                            </div>
                            <div class="card-body">
                                <h3 class="h4">Industries</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <picture>
                                    <source srcset="frontend/img/exp-cat8.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/exp-cat8.svg" alt="Other" width="90" height="90">
                                </picture>
                            </div>
                            <div class="card-body">
                                <h3 class="h4">Other</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="Sec3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 783.89" fill="#fff"><path d="M0,783.89S26.21,629,236,673.89c316.5,67.61,242.5-92,468-180.07,235.51-92,311.49,38,449.22-6.8C1251.61,455,1231,287.83,1412,303.83c67.48,6,188-80,188-80V0H0Z"/></svg>
            <div class="container">
                <div class="row justify-content-center wow slideInDown">
                    <div class="col-lg-9 col-md-10 text-center">
                        <h2 class="Heading h2">Experts Video Gallery</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="owl-carousel VideoSec wow slideInUp">
                            <div class="item">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="youtube-player" data-id="rsUfwRwSj5s"></div>
                                        <!-- <a data-fancybox="" class="playVideo" href="https://www.youtube.com/watch?v=6m2EiDaKsUM" title="Video Gallery"></a> -->
                                        <a href="video-detail.php" class="playVideo"></a>
                                    </div>
                                    <a href="video-detail.php" class="card-body">
                                        <h3>Video Title</h3>
                                        <small class="text-secondary me-3"><i class="far fa-user thm"></i> Expert Name</small>
                                        <small class="text-secondary"><i class="far fa-tag thm"></i> Tech Entrepreneur + Investor </small>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="youtube-player" data-id="eylsgNZXo4Q"></div>
                                        <!-- <a data-fancybox="" class="playVideo" href="https://www.youtube.com/watch?v=6m2EiDaKsUM" title="Video Gallery"></a> -->
                                        <a href="video-detail.php" class="playVideo"></a>
                                    </div>
                                    <a href="video-detail.php" class="card-body">
                                        <h3>Video Title</h3>
                                        <small class="text-secondary me-3"><i class="far fa-user thm"></i> Expert Name</small>
                                        <small class="text-secondary"><i class="far fa-tag thm"></i> Tech Entrepreneur + Investor </small>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="youtube-player" data-id="2VzsIMB0jZw"></div>
                                        <!-- <a data-fancybox="" class="playVideo" href="https://www.youtube.com/watch?v=6m2EiDaKsUM" title="Video Gallery"></a> -->
                                        <a href="video-detail.php" class="playVideo"></a>
                                    </div>
                                    <a href="video-detail.php" class="card-body">
                                        <h3>Video Title</h3>
                                        <small class="text-secondary me-3"><i class="far fa-user thm"></i> Expert Name</small>
                                        <small class="text-secondary"><i class="far fa-tag thm"></i> Tech Entrepreneur + Investor </small>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="youtube-player" data-id="rsUfwRwSj5s"></div>
                                        <!-- <a data-fancybox="" class="playVideo" href="https://www.youtube.com/watch?v=6m2EiDaKsUM" title="Video Gallery"></a> -->
                                        <a href="video-detail.php" class="playVideo"></a>
                                    </div>
                                    <a href="video-detail.php" class="card-body">
                                        <h3>Video Title</h3>
                                        <small class="text-secondary me-3"><i class="far fa-user thm"></i> Expert Name</small>
                                        <small class="text-secondary"><i class="far fa-tag thm"></i> Tech Entrepreneur + Investor </small>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="youtube-player" data-id="eylsgNZXo4Q"></div>
                                        <!-- <a data-fancybox="" class="playVideo" href="https://www.youtube.com/watch?v=6m2EiDaKsUM" title="Video Gallery"></a> -->
                                        <a href="video-detail.php" class="playVideo"></a>
                                    </div>
                                    <a href="video-detail.php" class="card-body">
                                        <h3>Video Title</h3>
                                        <small class="text-secondary me-3"><i class="far fa-user thm"></i> Expert Name</small>
                                        <small class="text-secondary"><i class="far fa-tag thm"></i> Tech Entrepreneur + Investor </small>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="youtube-player" data-id="2VzsIMB0jZw"></div>
                                        <!-- <a data-fancybox="" class="playVideo" href="https://www.youtube.com/watch?v=6m2EiDaKsUM" title="Video Gallery"></a> -->
                                        <a href="video-detail.php" class="playVideo"></a>
                                    </div>
                                    <a href="video-detail.php" class="card-body">
                                        <h3>Video Title</h3>
                                        <small class="text-secondary me-3"><i class="far fa-user thm"></i> Expert Name</small>
                                        <small class="text-secondary"><i class="far fa-tag thm"></i> Tech Entrepreneur + Investor </small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center"><a href="video.php" class="btn btn-thm2">View All Videos <i class="fal fa-arrow-right"></i></a></div>
            </div>
            <div class="Test">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-9 col-md-10 text-center">
                            <h2 class="Heading h2">Customer Testimonials</h2>
                            <div class="owl-carousel Testi wow slideInUp">
                                <div class="item">
                                    <div class="card">
                                        <div class="card-body">
                                            <span class="img"><img src="frontend/img/man.svg"></span>
                                            <h3 class="h4 mt-3">Customers Name</h3>
                                            <div class="text mb-3"><p class="mt">“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.”</p></div>
                                            <span class="star" title="star" data-title="4"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="card">
                                        <div class="card-body">
                                            <span class="img"><img src="frontend/img/man.svg"></span>
                                            <h3 class="h4 mt-3">Customers Name</h3>
                                            <div class="text mb-3"><p class="mt">“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.”</p></div>
                                            <span class="star" title="star" data-title="4"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="card">
                                        <div class="card-body">
                                            <span class="img"><img src="frontend/img/man.svg"></span>
                                            <h3 class="h4 mt-3">Customers Name</h3>
                                            <div class="text mb-3"><p class="mt">“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.”</p></div>
                                            <span class="star" title="star" data-title="4"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="Sec4 bgthm">
            <div class="container">
                <div class="row justify-content-center wow zoomIn">
                    <div class="col-lg-9 col-md-10 text-center">
                        <h2 class="Heading h2 mb-4">Are you an Expert?</h2>
                        <h3 class="text-white mb-4">Join a community of passionate experts</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        <a href="become-an-expert.php" class="btn btn-thm btn-lg">Become an Expert <img src="frontend/img/arrow.svg" class="ms-3" width="30" height="30"></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="Sec5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 678.11" fill="#f9f5ef"><path d="M0,310.08s136.21-124.85,346-80c316.49,67.63,334-128,568-190,206.83-54.82,371.57,40,488,40,67.74,0,198-80,198-80V678.19H0Z"/></svg>
            <div class="container">
                <div class="row justify-content-center wow slideInDown">
                    <div class="col-lg-9 col-md-10 text-center">
                        <h2 class="Heading h2">We are in the News</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </div>
                </div>
                <div class="row mt-4 wow slideInUp">
                    <div class="col-md-6">
                        <div class="card Blog">
                            <a href="blog-detail.php" class="card-header">
                                <picture>
                                    <source srcset="frontend/img/blog-img1.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/blog-img1.svg" alt="Product" width="380" height="480">
                                </picture>
                                <span>may<span>13</span></span>
                            </a>
                            <a href="blog-detail.php" class="card-body">
                                <h3 class="h5">What is Lorem Ipsum?</h3>
                                <div class="admin"><span class="me-4"><img src="frontend/img/admin.svg" class="me-1"> Admin</span> <span><img src="frontend/img/comment.svg"> Comments (2)</span></div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card Blog">
                            <a href="blog-detail.php" class="card-header">
                                <picture>
                                    <source srcset="frontend/img/blog-img4.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/blog-img4.svg" alt="Product" width="380" height="480">
                                </picture>
                                <span>may<span>13</span></span>
                            </a>
                            <a href="blog-detail.php" class="card-body">
                                <h3 class="h5">What is Lorem Ipsum?</h3>
                                <div class="admin"><span class="me-4"><img src="frontend/img/admin.svg" class="me-1"> Admin</span> <span><img src="frontend/img/comment.svg"> Comments (2)</span></div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card Blog">
                            <a href="blog-detail.php" class="card-header">
                                <picture>
                                    <source srcset="frontend/img/blog-img2.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/blog-img2.svg" alt="Product" width="380" height="480">
                                </picture>
                                <span>may<span>13</span></span>
                            </a>
                            <a href="blog-detail.php" class="card-body">
                                <h3 class="h5">What is Lorem Ipsum?</h3>
                                <div class="admin"><span class="me-4"><img src="frontend/img/admin.svg" class="me-1"> Admin</span> <span><img src="frontend/img/comment.svg"> Comments (2)</span></div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card Blog">
                            <a href="blog-detail.php" class="card-header">
                                <picture>
                                    <source srcset="frontend/img/blog-img3.webp" type="image/webp">
                                    <img loading="lazy" src="frontend/img/blog-img3.svg" alt="Product" width="380" height="480">
                                </picture>
                                <span>may<span>13</span></span>
                            </a>
                            <a href="blog-detail.php" class="card-body">
                                <h3 class="h5">What is Lorem Ipsum?</h3>
                                <div class="admin"><span class="me-4"><img src="frontend/img/admin.svg" class="me-1"> Admin</span> <span><img src="frontend/img/comment.svg"> Comments (2)</span></div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 text-center"><a href="blog.php" class="btn btn-thm2">View All Blog <i class="fal fa-arrow-right"></i></a></div>
                </div>
            </div>
            <div class="SubScri wow slideInUp">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8 text-center">
                            <h2 class="Heading h2">Subscribe to our Newletter</h2>
                            <p class="h5 text-secondary">Receive updates instanly</p>
                            <div class="input-group mb-3 mt-5">
                                <img src="frontend/img/mail.svg" height="40" width="60">
                                <input type="text" class="form-control" name="subscribe_email" placeholder="Enter your email" aria-label="Enter your email" aria-describedby="searchbox">
                                <button class="input-group-text btn btn-thm2" id="searchbox">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
// import 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js';
// import 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js';
// import 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js';
export default {
   
}
</script>
<style scoped>
@import "https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css";
@import "https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css";
@import "https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.compat.min.css";
body>main,.TabSec,.TabSec section{overflow:inherit!important}
.TabSec section{padding:0}
.SerMenu{position:sticky;top:66px;padding:0;/*max-width:500px*/}
.SerMenu li{counter-increment:slides-num;padding:25px;border-radius:20px;margin-bottom:9px}
.SerMenu li>a:before{content:" "counter(slides-num);height:40px;min-width:40px;font-size:26px;font-weight:600;margin-right:25px;background:var(--thm);border-radius:50%;color:var(--white);display:grid;place-content:center;line-height:24px}
.SerMenu li a{display:flex}
.SerMenu li img{height:auto;width:300px;display:flex;margin:20px auto 0;}
.SerMenu li .TitleS{font-size:26px;font-weight:800;display:flex;margin-top:7px;color:var(--thm);justify-content:space-between}
.SerMenu li .TitleS:after{content:'';border:none;border-bottom:2px solid;border-left:2px solid;height:9px;width:9px;transform:rotate(-45deg);display:block;transition:all .5s}
.SerMenu li .Scon{opacity:0;visibility:hidden;margin-top:12px;font-size:14px;line-height:140%!important;font-weight:300;display:none;transition:all .5s}
.SerMenu li.active{background:var(--thm)}
.SerMenu li.active .TitleS{color:var(--white)}
.SerMenu li.active>a:before{background:var(--white);color:var(--thm)}
.SerMenu li.active .TitleS:after{transform:rotate(135deg)}
.SerMenu li.active .Scon{opacity:1;visibility:visible;color:var(--white);display:block}
.TabSec section img{height:450px;max-width:500px;width:100%;object-fit:contain;padding:0}
.TabSec section>picture{position:relative;display:block}
.TabSec section>picture:after,.TabSec section>picture:before{position:absolute;top:-30px;right:25%;height:130px;width:130px;background:var(--thm3);opacity:.1;border-radius:50%;content:'';z-index:-1}
.TabSec section>picture:after{height:240px;width:240px;right:auto;left:0;top:auto;bottom:0;transform:translate(-40%, 30%);background:var(--thm);opacity:.1}
.Sec6 img{height:auto;max-width:220px;width:100%}
.Sec7 *,.Sec7 .Heading{color:var(--white)!important}
.Sec7 .card{border-radius:0!important;background:transparent!important;border:none;flex-direction:row;margin-bottom:15px!important}
.Sec7 .card>*{background:transparent!important;border:none;padding:0}
.Sec7 .card .card-body{padding-left:15px}
.Sec7 .card p{font-size:14px;display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:3;font-weight:300;color:rgb(var(--whitergb)/.7)!important;line-height:140%!important}
.Sec7 .card h3{font-weight:400;margin-bottom:3px;font-size:22px}
@media (min-width:992px){.TabSec section{min-height:90vh}}
@media (max-width:767px){.owl-nav{position:static!important;width:85px!important;display:flex;justify-content:space-between;margin-top:9px!important}
.owl-nav button.owl-next, .owl-nav button.owl-prev{margin:0!important;position:static!important}
.ExpertsC .owl-nav button.owl-next, .ExpertsC .owl-nav button.owl-prev{width:36px!important;height:36px!important}
.SerMenu li .TitleS{font-size:22px}
.SerMenu li>a:before{margin-right:15px;}
}
</style>