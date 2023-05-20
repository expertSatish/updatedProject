@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="grey pt-3 pb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a aria-current="page">Expert Sign Up</a></li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <!-- <label for="lemail" class="form-label mb-0 ms-3"><small>Phone No.</small></label> -->
                    <div class="row align-items-end">
                        <div class="col-12 text-center">
                            <h2 class="mt-2 h4">Expert Sign Up</h2>
                            <p class="text-secondary">Create your ExpertBall account</p>
                        </div>
                    </div><hr class="border-bottom border-secondary m-0 mb-4">
                    <form action="expert-account" method="post" class="card card-body formbox mt-3">
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <div class="AllStep">
                                    <div class="CustomerInfo" id="s1">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">1 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 ms-3 thm">What is your full Name? <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="fname" placeholder="Type your answer here...">
                                            <a href="#s2" class="btn ms-2 formbtn Next sws-bottom" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s2">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">2 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 ms-3 thm">What is your Email id & Contact No.? <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="fname" placeholder="name@example.com">
                                        </div>
                                        <div class="input-group CountryCode mt-3">
                                            <span>
                                            <a class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span id="CountryName">+91</span></a>
                                            <ul class="dropdown-menu countrylist">
                                                <!----->
                                            </ul>
                                            </span>
                                            <input type="number" class="form-control" maxlength="10" oninput="maxLengthCheck(this)" name="mobile" placeholder="Enter Phone No.">
                                        </div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3 ms-3">
                                            <a href="#s1" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="#s3" class="btn ms-2 px-4 bg-thm formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s3">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">3 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 ms-3 thm">What is your LinkedIn profile? <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="fname" placeholder="https://">
                                            <a href="#s4" class="btn ms-2 formbtn Next sws-bottom" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a>
                                        </div>
                                        <div class="text-center"><a href="#s2" class="btn btn-sm formbtn BackToStep mt-3 sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a></div>
                                    </div>

                                    <div class="CustomerInfo" id="s4">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">4 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 ms-3 thm">What is your Highest Qualification? <span class="text-danger">*</span></h3>
                                        <div class="ListBox mt-2 ps-3 w-100">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="Qual" id="Qual1" autocomplete="off">
                                                        <label class="btn" for="Qual1">BCom</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="Qual" id="Qual2" autocomplete="off">
                                                        <label class="btn" for="Qual2">BSc</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="Qual" id="Qual3" autocomplete="off">
                                                        <label class="btn" for="Qual3">BA</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="Qual" id="Qual4" autocomplete="off">
                                                        <label class="btn" for="Qual4">MSc</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="Qual" id="Qual5" autocomplete="off">
                                                        <label class="btn" for="Qual5">MBA</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="Qual" id="Qual6" autocomplete="off">
                                                        <label class="btn" for="Qual6">BSc</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="Qual" id="Qual7" autocomplete="off">
                                                        <label class="btn" for="Qual7">MEd</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="Qual" id="Qual8" autocomplete="off">
                                                        <label class="btn" for="Qual8">PhD</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="Qual" id="Qual9" autocomplete="off">
                                                        <label class="btn" for="Qual9">MTeach</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3 ms-3">
                                            <a href="#s3" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="#s5" class="btn ms-2 px-4 bg-thm formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s5">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">5 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 ms-3 thm">What is your Domain/Area of Expertise? <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <select class="form-control form-select">
                                                <option disabled selected>Select your answer</option>
                                                <option>Marketing Strategy</option>
                                                <option>Business Strategy</option>
                                                <option>Social Media Marketing</option>
                                                <option>Digital Marketing</option>
                                                <option>Business Development</option>
                                                <option>Start-ups</option>
                                                <option>Online Marketing</option>
                                                <option>Strategic Planning</option>
                                                <option>New Business Development</option>
                                            </select>
                                            <a href="#s6" class="btn ms-2 formbtn Next sws-bottom" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a>
                                        </div>
                                        <div class="text-center"><a href="#s4" class="btn btn-sm formbtn BackToStep mt-3 sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a></div>
                                    </div>

                                    <!-- <div class="CustomerInfo" id="s6">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">6 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 ms-3 thm">Do you have Good Communication skills? <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <input type="url" class="form-control" name="skill" placeholder="Type your answer here...">
                                            <a href="#s6" class="btn ms-2 formbtn Next sws-bottom" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a>
                                        </div>
                                        <div class="text-center"><a href="#s5" class="btn btn-sm formbtn BackToStep mt-3 sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a></div>
                                    </div> -->

                                    <div class="CustomerInfo" id="s6">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">6 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 ms-3 thm">In which language you are most Fluent? <span class="text-danger">*</span></h3>
                                        <div class="ListBox mt-2 ps-3 w-100">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="lang" id="lang1" autocomplete="off">
                                                        <label class="btn" for="lang1">English</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="lang" id="lang2" autocomplete="off">
                                                        <label class="btn" for="lang2">Spanish</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="lang" id="lang3" autocomplete="off">
                                                        <label class="btn" for="lang3">French</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="lang" id="lang4" autocomplete="off">
                                                        <label class="btn" for="lang4">Hindi</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="lang" id="lang5" autocomplete="off">
                                                        <label class="btn" for="lang5">Punjabi</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="lang" id="lang6" autocomplete="off">
                                                        <label class="btn" for="lang6">German</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="lang" id="lang7" autocomplete="off">
                                                        <label class="btn" for="lang7">Gujarati</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="lang" id="lang8" autocomplete="off">
                                                        <label class="btn" for="lang8">Greek</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="lang" id="lang9" autocomplete="off">
                                                        <label class="btn" for="lang9">Oromo</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3 ms-3">
                                            <a href="#s5" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="#s7" class="btn ms-2 px-4 bg-thm formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s7">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">7 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 ms-3 thm">8. Please choose which Industry is most suitable for you? <span class="text-danger">*</span></h3>
                                        <!-- <div class="input-group">
                                            <select class="form-control form-select">
                                                <option disabled selected>Select your answer</option>
                                                <option>Textile Industry</option>
                                                <option>Food Processing Industry</option>
                                                <option>Chemical Industry</option>
                                                <option>Cement Industry</option>
                                                <option>Steel Industry</option>
                                                <option>Software Industry</option>
                                                <option>Mining Industry</option>
                                                <option>Petroleum industry</option>
                                                <option>Autombile Industry</option>
                                                <option>Retail industry</option>
                                                <option>Handicrafts Industry</option>
                                                <option>Business Strategy</option>
                                            </select>
                                            <a href="#s9" class="btn ms-2 formbtn Next sws-bottom" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a>
                                        </div>
                                        <div class="text-center"><a href="#s7" class="btn btn-sm formbtn BackToStep mt-3 sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a></div> -->
                                        <div class="ListBox mt-2 ps-3 w-100">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="ind" id="ind1" autocomplete="off">
                                                        <label class="btn" for="ind1">Textile Industry</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="ind" id="ind2" autocomplete="off">
                                                        <label class="btn" for="ind2">Food Processing Industry</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="ind" id="ind3" autocomplete="off">
                                                        <label class="btn" for="ind3">Chemical Industry</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="ind" id="ind4" autocomplete="off">
                                                        <label class="btn" for="ind4">Cement Industry</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="ind" id="ind5" autocomplete="off">
                                                        <label class="btn" for="ind5">Steel Industry</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="ind" id="ind6" autocomplete="off">
                                                        <label class="btn" for="ind6">Software Industry</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="ind" id="ind7" autocomplete="off">
                                                        <label class="btn" for="ind7">Mining Industry</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="ind" id="ind8" autocomplete="off">
                                                        <label class="btn" for="ind8">Petroleum industry</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="ind" id="ind9" autocomplete="off">
                                                        <label class="btn" for="ind9">Autombile Industry</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="ind" id="ind10" autocomplete="off">
                                                        <label class="btn" for="ind10">Retail industry</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="ind" id="ind11" autocomplete="off">
                                                        <label class="btn" for="ind11">Handicrafts Industry</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check" name="ind" id="ind12" autocomplete="off">
                                                        <label class="btn" for="ind12">Business Strategy</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3 ms-3">
                                            <a href="#s6" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="#s8" class="btn ms-2 px-4 bg-thm formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s8">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">8 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <div class="row">
                                            <div class="col-md-10"><h3 class="h5 ms-3 thm">What are your Strengths? <span class="text-danger">*</span></h3></div>
                                            <div class="col-md-2 text-end"><small class="text-secondary">Max Word : 300</small></div>
                                        </div>
                                        <div class="input-group"><textarea class="form-control" placeholder="Type your answer here..."></textarea></div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3 ms-3">
                                            <a href="#s7" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="#s9" class="btn ms-2 px-4 bg-thm formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s9">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">9 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <div class="row">
                                            <div class="col-md-10"><h3 class="h5 ms-3 thm">Share a summary of Bio with us <span class="text-danger">*</span></h3></div>
                                            <div class="col-md-2 text-end"><small class="text-secondary">Max Word : 300</small></div>
                                        </div>
                                        <div class="input-group"><textarea class="form-control" placeholder="Type your answer here..."></textarea></div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3 ms-3">
                                            <a href="#s8" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="#s10" class="btn ms-2 px-4 bg-thm formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s10">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">10 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 ms-3 thm">Are you currently working as *</h3>
                                        <div class="ListBox mt-2 ps-3 w-100">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="curr" id="curr1" autocomplete="off">
                                                        <label class="btn" for="curr1">Full time employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="curr" id="curr2" autocomplete="off">
                                                        <label class="btn" for="curr2">Part time employee</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="curr" id="curr3" autocomplete="off">
                                                        <label class="btn" for="curr3">Self employed</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="curr" id="curr4" autocomplete="off">
                                                        <label class="btn" for="curr4">Freelancer</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3 ms-3">
                                            <a href="#s9" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <button type="submit" class="btn ms-2 px-4 bg-thm formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                    <!-- <div class="CustomerInfo">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">7 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 ms-3 thm">First name: *</h3>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="fname" placeholder="Type your answer here...">
                                            <button class="btn ms-2 formbtn sws-bottom" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </form>
                    <p class="text-secondary w-100 m-0 mt-5 text-center mb-3">Already have an account? <a class="thm" href="{{route('login')}}"><strong>Login</strong></a></p>
                    <!-- <div class="form-check mt-3"><input class="form-check-input" type="checkbox" value="" id="lstay"><label class="form-check-label thm" for="lstay">By continuing you agree to our <a href="#"><u>Terms</u></a> and <a href="#"><u>Privacy Policy</u></a></label></div> -->
                </div>
            </div>
        </div>
        <div class="bg-img">
            <img src="{{asset('frontend/img/bg-img-l.svg')}}" width="450" height="500">
            <img src="{{asset('frontend/img/bg-img-r1.svg')}}" width="450" height="500">
        </div>
    </section>
</main>
@endsection
@push('css')
<title>Expert Sign Up : Expert Bells</title>
<meta name="description" content="Welcome to Expert Bells">
<meta name="keywords" content="Welcome to Expert Bells">
<style type="text/css">
section.grey>div{z-index:2;position:relative}
.formbox{border-radius:9px!important;border:none!important;/*box-shadow:0 5px 12px rgb(var(--blackrgb)/.1);*/background:none!important;padding:0!important}
.formbox .row>div{position:relative}
.CountryCode a{border:1px solid #e1e1e1;display:flex;align-items:center;line-height:normal!important;background:var(--white)!important;padding:9px 18px;border-radius:30px 0 0 30px;height:100%}
.CountryCode a:after{font-size:16px}
.CountryCode a span{max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;font-size:16px!important;text-transform:uppercase}
.CountryCode a span:after{display:none}
.CountryCode span+.form-control{border-radius:0 30px 30px 0!important;}
.CountryCode .CountryCode{max-width:66px;text-align:center;padding:0!important}
.CountryCode .form-control,.CustomerInfo .form-control,.CountryBox .form-control,.formbox>.row>div>.form-control{height:calc(2.5rem + 2px);border-radius:0 30px 30px 0!important;font-size:16px;padding:0 20px}
.CountryCode .form-control:first-child,.CountryCode>span.d-none~.form-control,.CountryCode>span[style="display:none"]~.form-control,.CountryCode>span[style="display: none"]~.form-control,.CountryCode>span[style="display: none;"]~.form-control,.CountryCode>span[style="display:none;"]~.form-control{border-radius:30px!important}
.CustomerInfo .form-control,.CountryBox>.form-control,.formbox>.row>div>.form-control{border-radius:30px!important}
.CountryCode .countrylist{padding:0;max-height:200px;overflow:auto;background:var(--white);right:auto!important;left:0!important}
.CustomerInfo textarea.form-control{height:200px;resize:none;}
.formbtn{height:50px;min-width:50px!important;width:auto!important;display:flex;align-items:center;border-radius:35px!important;border:1px solid var(--thm)!important;font-size:22px!important;color:var(--thm)!important;background:var(--white)!important}
.formbtn.bg-thm{background:var(--thm)!important;color:var(--white)!important}
.formbtn.bg-thm:hover{background:var(--thm1)!important;border-color:var(--thm)!important}
.formbtn.btn-sm{font-size:16px!important;padding:0 15px;height:32px}
.otpn{height:40px;max-width:40px!important;border-radius:9px!important;padding:0!important;font-size:18px!important}
.formbtn:hover{background:var(--thm)!important;color:var(--white)!important}
.countrylist li{padding:5px 12px;cursor:pointer;font-size:14px;padding-right:70px;white-space:nowrap}
.countrylist li i{margin-right:5px}
.countrylist li span{font-size:12px;color:rgb(var(--blackrgb)/.5);position:absolute;right:12px}
.countrylist li:hover{background:rgb(var(--blackrgb)/.08)}
img.bg-img{position:relative;bottom:0;opacity:.6;margin-top:-90px;width:100%;height:auto;z-index:1}
.lpass~i,.cpass~i,.npass~i{position:absolute;right:24px;bottom:13px;opacity:0; z-index:3; transition:all .5s}
.lpass:hover~i,.lpass:active~i,.lpass:focus~i,.lpass~i:hover,.lpass~i:active,.lpass~i:focus,.cpass:hover~i,.cpass:active~i,.cpass:focus~i,.cpass~i:hover,.cpass~i:active,.cpass~i:focus,.npass~i:hover~i,.npass:active~i,.npass:focus~i,.npass:hover,.npass~i:active,.npass~i:focus{opacity:1}
.ListBox{font-size:20px; min-width:180px;display:inline-block;}
.ListBox .btn{width:100%;text-align:left;padding:.2rem .75rem;font-size:17px;border:1px solid rgb(var(--thmrgb)/.5);background-color:rgb(var(--thmrgb)/.1);color:var(--thm);}
.ListBox .btn:hover,.ListBox .btn-check:checked+.btn{border-color:rgb(var(--thmrgb)/.8);background-color:rgb(var(--thmrgb)/.2);}
.ListBox .btn-check:checked+.btn{background:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.42 12.12"><path d="M14,0l1.42,1.42L4.71,12.12,0,7.42,1.42,6,4.71,9.3Z"/></svg>') rgb(var(--thmrgb)/.2) right 1rem center/18px auto no-repeat; padding-right:3rem}
.ListBox .btn-check:checked+.btn:focus{box-shadow:0 0 0 .25rem rgb(var(--thmrgb)/.4)}

.AllStep{overflow:auto}
.AllStep::-webkit-scrollbar{width:0;height:0;background-color:rgb(var(--blackrgb)/0)}
.AllStep::-webkit-scrollbar-thumb{background-color:rgb(var(--blackrgb)/.4);border-radius:2px}
.AllStep::-moz-scrollbar{width:0;height:0;background-color:rgb(var(--blackrgb)/0)}
.AllStep::-moz-scrollbar-thumb{background-color:rgb(var(--blackrgb)/.4);border-radius:2px}
.AllStep::-o-scrollbar{width:0;height:0;background-color:rgb(var(--blackrgb)/0)}
.AllStep::-o-scrollbar-thumb{background-color:rgb(var(--blackrgb)/.4);border-radius:2px}
.AllStep>div{display:none;}
.AllStep>div:target{display:block;}
</style>
@endpush
@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('html, body').animate({scrollTop: '0'}, 800);
    });
    $(".Next").click(function(event){
        $('.AllStep').animate({scrollTop: '+0'}, 800);
    });
    $(".BackToStep").click(function(event){
        $('.AllStep').animate({scrollTop: '-0'}, 800);
    });
    </script>
@endpush