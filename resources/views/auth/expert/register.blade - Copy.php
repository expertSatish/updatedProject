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
                    <div class="row align-items-end">
                        <div class="col-12 text-center">
                            <h2 class="mt-2 h4">Expert Sign Up</h2>
                            <p class="text-secondary">Create your ExpertBells account</p>
                        </div>
                    </div><hr class="border-bottom border-secondary m-0 mb-4">
                    <form action="{{route('register')}}"  method="get" class="card card-body formbox mt-3">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <div class="AllStep">                                    
                                    <div class="CustomerInfo">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">1 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">What is your full Name? <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <input type="text" class="form-control inputTextBox" value="{{old('name')}}" name="name" placeholder="Type your answer here...">
                                            {{-- <a href="javascript:void(0)" class="btn ms-2 formbtn Next checkstep1 sws-top" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a> --}}
                                            <button class="btn ms-2 formbtn Next checkstep1 sws-top" data-title="Next"><i class="fal fa-arrow-right"></i></button>
                                        </div>
                                        <small class="error name-error"></small>
                                        @error('name')<small class="error">{{$message}}</small>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                    <form action="{{route('saveexpertregister')}}"  method="post" class="card  d-nonecard-body formbox mt-3">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 mb-2">
                                <div class="AllStep">                                    
                                    <div class="CustomerInfo" id="s1">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">1 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">What is your full Name? <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <input type="text" class="form-control inputTextBox" value="{{old('name')}}" name="name" placeholder="Type your answer here...">
                                            <a href="javascript:void(0)" class="btn ms-2 formbtn Next checkstep1 sws-top" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a>
                                        </div>
                                        <small class="error name-error"></small>
                                        @error('name')<small class="error">{{$message}}</small>@enderror
                                    </div>

                                    <div class="CustomerInfo" id="s2">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">2 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">What is your Email id & Contact No.? <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="name@example.com">
                                        </div>
                                        <small class="error email-error"></small>
                                        @error('email')<small class="error">{{$message}}</small>@enderror
                                        <div class="input-group CountryCode mt-3">
                                            <span>
                                            <a class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span id="CountryName">+{{$ccode->phonecode ?? 0}}</span></a>
                                            <ul class="dropdown-menu countrylist">
                                                <x-country-list/>
                                            </ul>
                                            </span>
                                            <input type="number" class="form-control" maxlength="10" value="{{old('mobile')}}" onkeypress="return isNumber(event)" name="mobile" placeholder="Enter Phone No.">
                                            <input type="hidden" name="ccode" value="{{$ccode->phonecode ?? 0}}">
                                            
                                        </div>
                                        <small class="error mobile-error"></small>
                                        @error('mobile')<small class="error">{{$message}}</small>@enderror
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3">
                                            <a href="#s1" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="javascript:void(0)" class="btn ms-2 px-4 bg-thm checkstep2 formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s3">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">3 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">Are you currently working as *</h3>
                                        <div class="ListBox mt-2 w-100">
                                            <div class="row">
                                                @foreach($workings as $working)
                                                <div class="col-md-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="working" @checked(old('working')==$working->id) value="{{$working->id ?? 0}}" id="curr{{$working->id ?? 0}}" autocomplete="off">
                                                        <label class="btn" for="curr{{$working->id ?? 0}}">{{$working->title ?? ''}}</label>
                                                    </div>
                                                </div>
                                                @endforeach                                                
                                            </div>
                                            <small class="error working-error"></small>
                                        </div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3">
                                            <a href="#s2" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="javascript:void(0)" class="btn ms-2 px-4 bg-thm checkstep3 formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                            <!-- <button type="button" class="btn ms-2 px-4 bg-thm checkstep10 formbtn sbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></button> -->
                                            <!-- <button type="button" class="btn px-4 bg-thm formbtn Next sws-bottom pbtn disabled" style="display:none;" data-title="Next"> <i class="fad fa-spinner-third fa-spin"></i> Loading... </button> -->
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s4">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">4 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">What is the name of your Company? <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="name@example.com">
                                        </div>
                                        
                                        <h3 class="h5 thm mt-4">What is your role in Company? <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <div class="dropdown FilterDrop m-0">
                                                <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Role<span></span></a>
                                                <div class="dropdown-menu p-3">
                                                    <ul>
                                                        @foreach ($roles as $role)
                                                        <li class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="{{$role->id}}" data-bs-type="Role" name="role[]" id="role{{$role->id}}">
                                                            <label class="form-check-label" for="role{{$role->id}}">{{$role->title}}</label>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="javascript:void(0)" class="btn ms-2 checkstep4 formbtn Next sws-bottom" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a>
                                        </div>
                                        <div class="text-center mt-3">
                                            <a href="#s3" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <!-- <a href="javascript:void(0)" class="btn ms-2 px-4 bg-thm checkstep4 formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a> -->
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s5">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">5 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">What is your Expertise?</h3>
                                        <div class="ListBox LBorder mt-2 w-100">
                                            <div class="row">
                                                @foreach($expertises as $expertise)
                                                <div class="col-md-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="wexpertise" value="" id="wexp" autocomplete="off">
                                                        <label class="btn" for="wexp">{{$expertise->title}}</label>
                                                    </div>
                                                </div>
                                                @endforeach                                          
                                            </div>
                                        </div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3">
                                            <a href="#s4" class="btn btn-sm formbtn BackToStepO sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="javascript:void(0)" class="btn ms-2 px-4 bg-thm checkstep5 formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s6">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">6 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">What is your current Industry? <!--8. Please choose which Industry is most suitable for you?--> <span class="text-danger">*</span></h3>
                                        <!-- <div class="input-group">
                                            <select class="form-control form-select" name="sIndustry">
                                                <option value="" selected>Select your Industry</option>
                                            </select>
                                        </div> -->
                                       <div class="ListBox LBorder mt-2 w-100">
                                            <div class="row">
                                                @foreach($Industries as $Industry)
                                                <div class="col-lg-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check industry" @selected(in_array($Industry->id ?? 0,old('industry',[]))) name="industry[]" value="{{$Industry->id ?? 0}}" id="ind{{$Industry->id ?? 0}}" autocomplete="off">
                                                        <label class="btn" for="ind{{$Industry->id ?? 0}}">{{$Industry->title ?? ''}}</label>
                                                    </div>
                                                </div>
                                                @endforeach                                                
                                            </div>
                                            <small class="error industry-error"></small>
                                        </div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3">
                                            <a href="#s5" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="javascript:void(0)" class="btn ms-2 px-4 checkstep6 bg-thm formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s7">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">7 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">In which language you are most Fluent? <span class="text-danger">*</span></h3>
                                        <div class="ListBox mt-2 w-100">
                                            <div class="row">
                                                @foreach($languages as $language)
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="checkbox" class="btn-check language" @selected(in_array($language->id,old('language',[]))) name="language[]" value="{{$language->id ?? 0}}" id="lang{{$language->id ?? 0}}" autocomplete="off">
                                                        <label class="btn" for="lang{{$language->id ?? 0}}">{{$language->title ?? ''}}</label>
                                                    </div>
                                                </div>
                                                @endforeach                                                
                                            </div>
                                            <small class="error language-error"></small>
                                        </div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3">
                                            <a href="#s6" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="javascript:void(0)" class="btn ms-2 px-4 bg-thm checkstep7 formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s8">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">8 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">How much do you intend to charge par hour for the session? (INR) <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <input type="text" class="form-control inputTextBox" value="" name="name" placeholder="Type your answer here...">
                                            <a href="javascript:void(0)" class="btn ms-2 formbtn Next checkstep8 sws-top" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a>
                                        </div>
                                        <small class="error name-error"></small>
                                        @error('name')<small class="error">{{$message}}</small>@enderror
                                        <div class="text-center mt-3">
                                            <a href="#s7" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                        </div>
                                    </div>
                                    <div class="CustomerInfo" id="s9">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">9 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">How many session of 30-min, you can take in a week? <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <input type="text" class="form-control inputTextBox" value="" name="name" placeholder="Type your answer here...">
                                            <a href="javascript:void(0)" class="btn ms-2 formbtn Next checkstep9 sws-top" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a>
                                        </div>
                                        <small class="error name-error"></small>
                                        @error('name')<small class="error">{{$message}}</small>@enderror
                                        <div class="text-center mt-3">
                                            <a href="#s8" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s10">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">10 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <div class="row">
                                            <div class="col-md-10"><h3 class="h5 thm">Share a summary of Bio with us <span class="text-danger">*</span></h3></div>
                                            <div class="col-md-2 text-end"><small class="text-secondary">Max Word : 300</small></div>
                                        </div>
                                        <div class="input-group"><textarea class="form-control" name="bio" placeholder="Type your answer here...">{{old('bio')}}</textarea></div>
                                        <small class="error bio-error"></small>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3">
                                            <a href="#s9" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="javascript:void(0)" class="btn ms-2 px-4 bg-thm checkstep10 formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s11">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">11 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">LinkedIn profile</h3>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{old('linkedin')}}" name="linkedin" placeholder="https://">
                                        </div>
                                        <h3 class="h5 thm mt-4">Instagram profile</h3>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{old('linkedin')}}" name="linkedin" placeholder="https://">
                                        </div>
                                        <h3 class="h5 thm mt-4">Youtube channel link</h3>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{old('linkedin')}}" name="linkedin" placeholder="https://">
                                        </div>
                                        <h3 class="h5 thm mt-4">Share your introductory video (if any)</h3>
                                        <div class="input-group align-items-center">
                                            <label for="video" class="small me-3 VideoL d-flex align-items-center">Add file here <i class="fal fa-arrow-to-bottom h5 m-0 ms-3"></i></label>
                                            <input type="file" class="form-control inputTextBox" value="" name="name" id="video" placeholder="Type your answer here...">
                                            <a href="javascript:void(0)" class="btn ms-2 formbtn Next checkstep11 sws-top" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a>
                                        </div>
                                        <div class="text-center mt-3">
                                            <a href="#s10" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <!-- <a href="javascript:void(0)" class="btn ms-2 px-4 bg-thm checkstep4 formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a> -->
                                        </div>
                                    </div>
                                                                      
                                    <div class="CustomerInfo" id="s12">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">12 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">Have you mentored before ? if so, please provide details about your experience. <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <input type="text" class="form-control inputTextBox" value="" name="name" placeholder="Type your answer here...">
                                            <a href="javascript:void(0)" class="btn ms-2 formbtn Next checkstep12 sws-top" type="button" data-title="Submit"><i class="fal fa-arrow-right"></i></a>
                                        </div>
                                        <small class="error name-error"></small>
                                        @error('name')<small class="error">{{$message}}</small>@enderror
                                        <div class="text-center mt-3">
                                            <a href="#s11" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <!-- <button type="button" class="btn ms-2 px-4 bg-thm checkstep10 formbtn sbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></button>
                                            <button type="button" class="btn px-4 bg-thm formbtn Next sws-bottom pbtn disabled" style="display:none;" data-title="Next"> <i class="fad fa-spinner-third fa-spin"></i> Loading... </button> -->
                                        </div>
                                    </div>










                                    <!-- <div class="CustomerInfo" id="s3">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">3 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">What is your LinkedIn profile? </h3>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{old('linkedin')}}" name="linkedin" placeholder="https://">
                                            <a href="javascript:void(0)" class="btn ms-2 checkstep3 formbtn Next sws-bottom" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a>
                                        </div>
                                        <div class="text-center"><a href="#s2" class="btn btn-sm formbtn BackToStep mt-3 sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a></div>
                                    </div>

                                    <div class="CustomerInfo" id="s4">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">4 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">What is your Highest Qualification? <span class="text-danger">*</span></h3>
                                        <div class="ListBox mt-2 w-100">
                                            <div class="row">
                                                @foreach($qualifications as $qualification)
                                                <div class="col-lg-3 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" @checked(old('qualification')==$qualification->id) name="qualification" value="{{$qualification->id}}" id="Qual{{$qualification->id}}" autocomplete="off">
                                                        <label class="btn" for="Qual{{$qualification->id}}">{{$qualification->title}}</label>
                                                    </div>
                                                </div>      
                                                @endforeach                                          
                                            </div>
                                            <small class="error qualification-error"></small>
                                            @error('qualification')<small class="error">{{$message}}</small>@enderror
                                        </div>
                                        <h3 class="h5 ms-3 mt-3 thm">In which category are you expert? <span class="text-danger">*</span></h3>
                                        <div class="ListBox mt-2 w-100">
                                            <div class="row">
                                                @foreach($categories as $categorie)
                                                <div class="col-lg-4 col-md-4 col-ms-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" @checked(old('categories')==$categorie->id) name="categories" value="{{$categorie->id}}" id="cate{{$categorie->id}}" autocomplete="off">
                                                        <label class="btn" for="cate{{$categorie->id}}">{{$categorie->title}}</label>
                                                    </div>
                                                </div>      
                                                @endforeach                                          
                                            </div>
                                            <small class="error categories-error"></small>
                                            @error('categories')<small class="error">{{$message}}</small>@enderror
                                        </div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3">
                                            <a href="#s3" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="javascript:void(0)" class="btn ms-2 px-4 bg-thm checkstep4 formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s5">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">5 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">What is your Domain/Area of Expertise? <span class="text-danger">*</span></h3>
                                        <div class="input-group">
                                            <select class="form-control form-select" name="expertise">
                                                <option value="" selected>Select your answer</option>
                                                @foreach($expertises as $expertise)
                                                <option value="{{$expertise->id ?? 0}}" @selected(old('expertise')==$expertise->id)>{{$expertise->title}}</option>
                                                @endforeach
                                            </select>
                                            <a href="javascript:void(0)" class="btn ms-2 checkstep5 formbtn Next sws-bottom" type="button" data-title="Next"><i class="fal fa-arrow-right"></i></a>
                                        </div><small class="error expertise-error"></small>
                                        <div class="text-center"><a href="#s4" class="btn btn-sm formbtn BackToStepO mt-3 sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a></div>
                                    </div>

                                    <div class="CustomerInfo" id="s8">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">8 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <div class="row">
                                            <div class="col-md-10"><h3 class="h5 thm">What are your Strengths? <span class="text-danger">*</span></h3></div>
                                            <div class="col-md-2 text-end"><small class="text-secondary">Max Word : 300</small></div>
                                        </div>
                                        <div class="input-group">
                                            <textarea class="form-control" name="strength" placeholder="Type your answer here...">{{old('strength')}}</textarea>
                                        </div><small class="error strength-error"></small>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3">
                                            <a href="#s7" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <a href="javascript:void(0)" class="btn ms-2 px-4 checkstep8 bg-thm formbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="CustomerInfo" id="s10">
                                        <samll class="num text-secondary d-block mb-3 text-center"><span class="thm">10 <i class="fal fa-long-arrow-right"></i></span> Step</samll>
                                        <h3 class="h5 thm">Are you currently working as *</h3>
                                        <div class="ListBox mt-2 w-100">
                                            <div class="row">
                                                @foreach($workings as $working)
                                                <div class="col-md-6">
                                                    <div class="RadioBox mb-2">
                                                        <input type="radio" class="btn-check" name="working" @checked(old('working')==$working->id) value="{{$working->id ?? 0}}" id="curr{{$working->id ?? 0}}" autocomplete="off">
                                                        <label class="btn" for="curr{{$working->id ?? 0}}">{{$working->title ?? ''}}</label>
                                                    </div>
                                                </div>
                                                @endforeach                                                
                                            </div>
                                            <small class="error working-error"></small>
                                        </div>
                                        <div class="text-center d-flex justify-content-between align-items-center mt-3">
                                            <a href="#s9" class="btn btn-sm formbtn BackToStep sws-top sws-bounce" data-title=""><i class="fal fa-arrow-left me-2"></i> Back</a>
                                            <button type="button" class="btn ms-2 px-4 bg-thm checkstep10 formbtn sbtn Next sws-bottom" data-title="Next"> Next <i class="fal fa-arrow-right"></i></button>
                                            <button type="button" class="btn px-4 bg-thm formbtn Next sws-bottom pbtn disabled" style="display:none;" data-title="Next"> <i class="fad fa-spinner-third fa-spin"></i> Loading... </button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </form>
                    <p class="text-secondary w-100 m-0 mt-5 text-center mb-3">Already have an account? <a class="thm" href="{{route('login')}}"><strong>Login</strong></a></p>
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
<style>
    .inner-banner+section{min-height:90vh!important}
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
    .CustomerInfo .form-control[type="file"]{border:none;background:none;padding:0!important;border-radius:3px!important;height:calc(2.4rem + 2px);}
    .CustomerInfo .form-control[type="file"]::file-selector-button{display:none;}
    .CustomerInfo .VideoL{border-radius:9px!important;cursor:pointer;border:none!important;margin:0 9px 0 0!important;font-size:14px;line-height:100%;height:100%;padding:8px 20px;background:var(--white);color:var(--thm4)}
    .CustomerInfo .form-control[type="file"]:hover::file-selector-button{background:rgb(var(--thmrgb)/.8)}
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
    .ListBox.LBorder{max-height:310px;overflow:auto;padding:10px;border-radius:5px;border:1px solid rgb(var(--blackrgb)/.2)}
    .ListBox .btn{width:100%;text-align:left;padding:.2rem .75rem;font-size:17px;border:1px solid rgb(var(--thmrgb)/.5);background-color:rgb(var(--thmrgb)/.1);color:var(--thm);}
    .ListBox .btn:hover,.ListBox .btn-check:checked+.btn{border-color:rgb(var(--thmrgb)/.8);background-color:rgb(var(--thmrgb)/.2);}
    .ListBox .btn-check:checked+.btn{background:url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.42 12.12"><path d="M14,0l1.42,1.42L4.71,12.12,0,7.42,1.42,6,4.71,9.3Z"/></svg>') rgb(var(--thmrgb)/.2) right 1rem center/18px auto no-repeat; padding-right:3rem}
    .ListBox .btn-check:checked+.btn:focus{box-shadow:0 0 0 .25rem rgb(var(--thmrgb)/.4)}
    .AllStep{overflow:hidden;display:block}
    /* .AllStep{overflow:auto} */
    .AllStep::-webkit-scrollbar{width:0;height:0;background-color:rgb(var(--blackrgb)/0)}
    .AllStep::-webkit-scrollbar-thumb{background-color:rgb(var(--blackrgb)/.4);border-radius:2px}
    .AllStep::-moz-scrollbar{width:0;height:0;background-color:rgb(var(--blackrgb)/0)}
    .AllStep::-moz-scrollbar-thumb{background-color:rgb(var(--blackrgb)/.4);border-radius:2px}
    .AllStep::-o-scrollbar{width:0;height:0;background-color:rgb(var(--blackrgb)/0)}
    .AllStep::-o-scrollbar-thumb{background-color:rgb(var(--blackrgb)/.4);border-radius:2px}
    .AllStep>div{display:none;}
    /* .AllStep>div:target{display:block;} */
    .AllStep>div:target{display:block!important}
    .bg-img{margin-top:0!important}


    .FilterDrop{flex:1 1 auto;width:1%;}
    .FilterDrop a{border-radius:30px!important; background:var(--white); margin:0 0 0 auto;justify-content: space-between;height:calc(3rem + 2px);border:1px solid rgb(var(--blackrgb)/.2);padding:8px 20px;position:relative;min-width:50px;display:flex;align-items:center}
    .FilterDrop a{padding:5px 20px}
    .FilterDrop a span{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:inline-flex; align-items:center; max-width:150px}
    .FilterDrop a span:after{display:none}
    .FilterDrop a.show{box-shadow:0 0 0 .25rem rgb(var(--thmrgb)/.25)!important;border:1px solid var(--thm)}
    .FilterDrop a.show:before{position:absolute;content:'';right:0;left:0;margin:0 auto;bottom:-17px;z-index:9999;width:9px;height:9px;transform:rotate(45deg);background:var(--white)}
    .FilterDrop .dropdown-menu{box-shadow:0 0 25px rgb(var(--blackrgb)/.2);border-color:rgb(var(--blackrgb)/.05);border-radius:15px;margin-top:9px!important;min-width:350px;max-height:300px;overflow:auto}
    .FilterDrop{margin:0 9px 9px 0}
    .FilterDrop .dropdown-menu input.SearchBox{height:40px;font-size:16px;max-width:400px;background-color:rgb(var(--thmrgb)/.05)}
    .FilterDrop .dropdown-menu>ul{-webkit-column-count:2;-moz-column-count:2;column-count:2;grid-column-gap:20px;-webkit-column-gap:20px;-moz-column-gap:20px;column-gap:20px;padding:0;margin:0;}
    .FilterDrop .dropdown-menu>ul.AllCat{-webkit-column-count:3;-moz-column-count:3;column-count:3;}
    .FilterDrop .dropdown-menu>ul.AllCat>li{display:inline-block;margin:0 0 20px;}
    .FilterDrop .dropdown-menu>ul.AllCat ul{margin:0;padding:0;}
    .FilterDrop .dropdown-menu>ul.AllCat h3{font-size:18px!important;font-weight:600}
    /*.FilterDrop .dropdown-menu ul:first-child{margin-top:6rem!important}*/
    .Exptext{display:-webkit-box;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:1}
    @media only screen and (max-width:767px){.FilterDrop .dropdown-menu ul{-webkit-column-count:1;-moz-column-count:1;column-count:1;grid-column-gap:0;-webkit-column-gap:1;-moz-column-gap:1;column-gap:1;display:flex;flex-wrap:wrap;justify-content:space-between}}
    .SelectExperts .dropdown-menu li,.FilterDrop .dropdown-menu li{padding:3px 20px; margin-bottom:1px; cursor:pointer;white-space:nowrap}
    .FilterDrop .dropdown-menu li{padding:3px 0}
    .FilterDrop .dropdown-toggle.selected{background:rgb(var(--thmrgb)/.1);border:1px solid rgb(var(--thmrgb)/.25)}
    .FilterDrop .dropdown-toggle span:before{content:'\2022';padding:0 6px;font-size:9px}
    .FilterDrop .dropdown-toggle span:empty:before{display:none}
</style>
@endpush
@push('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('html, body').animate({scrollTop: '0'}, 800);
        $('.CountryCode .dropdown-menu').find('li').click(function(e) {
            e.preventDefault();
            var spa = $(this).data('text');
            $('.CountryCode #CountryName').text(spa);
            $('input[name=ccode]').val(spa.substr(1));
        });
    });
    $(".Next").click(function(event){
        $('.AllStep').removeClass('overflow-visible');
        $('.AllStep').animate({scrollTop: '+0'}, 800);
    });
    $(".BackToStepO").click(function(event){
        $('.AllStep').addClass('overflow-visible');
        $('.AllStep').animate({scrollTop: '-0'}, 800);
    });
    $(".BackToStep").click(function(event){
        $('.AllStep').animate({scrollTop: '-0'}, 800);
    });
    $('.checkstep1').on('click',function(){
        $('.error').html('');
        if($('input[name=name]').val()==''){
            $('.name-error').html('Name field is required.');
        }else{            
            let btn = $('.checkstep1').attr('href','#s2');
            btn.click();
        }
    });
    $('.checkstep2').on('click',function(){
        $('.mobile-error').html('');
        $('.email-error').html('');
        if($('input[name=email]').val()==''){
            $('.email-error').html('Email field is required.');
        }
        else if($('input[name=mobile]').val()==''){
            $('.mobile-error').html('Mobile field is required.');
        }else{
            let btn = $('.checkstep2').attr('href','#s3');      
            btn.click();
            // $.ajax({
            //     data:{_token:$('meta[name=csrf-token]').attr('content'),email:$('input[name=email]').val(),mobile:$('input[name=mobile]').val()},
            //     url:@json('checkexpertexist'),
            //     method:'POST',
            //     dataType:'Json',
            //     success:function(data){
            //         let btn = $('.checkstep2').attr('href','#s3');      
            //         btn.click();
            //     },
            //     error:function(response){
            //         if(response.responseJSON.errors.email!==undefined){
            //             $('.email-error').text(response.responseJSON.errors.email);
            //         }
            //         if(response.responseJSON.errors.mobile!==undefined){
            //             $('.mobile-error').text(response.responseJSON.errors.mobile);
            //         }
            //     }
            // });
            
        }
    });
    $('.checkstep3').on('click',function(){
        $('.AllStep').addClass('overflow-visible');
        linkedin_url = $('input[name=linkedin]').val();
        if( /(ftp|http|https):\/\/?(?:www\.)?linkedin.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/.test(linkedin_url)) {
            let btn = $('.checkstep3').attr('href','#s4');
            btn.click();
        }else{
            if(!linkedin_url){
                let btn = $('.checkstep3').attr('href','#s4');
                btn.click();
            }else{
                toastr.error('Linkedin url is incorrect!');
                return false;
            }            
        }
    });
    $('.checkstep4').on('click',function(){
        let btn = $('.checkstep4').attr('href','#s5');
        btn.click();
    });
    $('.checkstep5').on('click',function(){
        let btn = $('.checkstep5').attr('href','#s6');
        btn.click();
    });
    $('.checkstep6').on('click',function(){
        if($('.industry').is(':checked')==false){
            $('.industry-error').html('Industry field is required.');
        }else{
            $('.industry-error').html('');
            let btn = $('.checkstep6').attr('href','#s7');
            btn.click();
        }
    });
    $('.checkstep7').on('click',function(){
        if($('.language').is(':checked')==false){
            $('.language-error').html('Language field is required.');
        }else{
            $('.language-error').html('');
            let btn = $('.checkstep7').attr('href','#s8');
            btn.click();
        }
    });
    $('.checkstep8').on('click',function(){
        let btn = $('.checkstep8').attr('href','#s9');
        btn.click();
    });
    $('.checkstep9').on('click',function(){
        let btn = $('.checkstep9').attr('href','#s10');
        btn.click();
    });
    $('.checkstep10').on('click',function(){
        let btn = $('.checkstep10').attr('href','#s11');
        btn.click();
    });
    $('.checkstep11').on('click',function(){
        let btn = $('.checkstep11').attr('href','#s12');
        btn.click();
    });




    $('.checkstep5').on('click',function(){
        if($('input[name=qualification]').is(':checked')==false){
            $('.qualification-error').html('Qualification field is required.');
        }else if($('input[name=categories]').is(':checked')==false){
            $('.categories-error').html('Category field is required.');
        }else{
            $('.qualification-error').html('');
            let btn = $('.checkstep5').attr('href','#s6');
            btn.click();
        }
    });
    $('.checkstep5').on('click',function(){
        $('.error').html('');
            
        if($('select[name=expertise]').val()==''){
            $('.expertise-error').html('Expertise field is required.');
        }else{
            let btn = $('.checkstep5').attr('href','#s6');
            btn.click();
        }
    });
    $('.checkstep8').on('click',function(){
        if($('textarea[name=strength]').val()==''){
            $('.strength-error').html('Strength field is required.');
        }else{
            $('.strength-error').html('');
            let btn = $('.checkstep8').attr('href','#s9');
            btn.click();
        }
    });
    $('.checkstep9').on('click',function(){
        if($('textarea[name=bio]').val()==''){
            $('.bio-error').html('Bio field is required.');
        }else{
            $('.bio-error').html('');
            let btn = $('.checkstep9').attr('href','#s10');
            btn.click();
        }
    });
    $('.checkstep10').on('click',function(){
        $('.sbtn').hide();
        $('.pbtn').show();
        if($('input[name=working]').is(':checked')==false){
            $('.working-error').html('Working field is required.');
            $('.sbtn').show();
            $('.pbtn').hide();
        }else{
            $('.working-error').html('');
            let btn = $('.formbox').submit();
        }
    });
    </script>
@endpush