<?php
ob_start();
$active = 'Home';
?>
@include('inc.html')
<head>
    <title>{!!$detail->meta_title!!}</title>
    <meta name="keywords" content="{!!$detail->meta_keywords!!}">
    <meta name="description" content="{!!$detail->meta_description!!}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/frontend/css/my-account.css')}}">
    <link rel='canonical' href='{{url()->current()}}'>
    <meta property="og:title" content="{!!$detail->meta_title!!}">
    <meta property="og:site_name" content="{{Helper::ProjectName()}}">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:description" content="{!!$detail->meta_description!!}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{asset('resources/assets/uploads/post/thumb/'.$detail->post_image)}}">

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="{!! '@'.Helper::ProjectName()!!}" />
    <meta name="twitter:creator" content="{!! '@'.Helper::ProjectName()!!}" />
    <meta name="twitter:image" content="{{asset('resources/assets/uploads/post/thumb/'.$detail->post_image)}}" />
    <meta name="twitter:label1" content="{!!$detail->meta_title!!}" />
    <meta name="twitter:data1" content="{!!$detail->meta_description!!}" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="500" />
    <style>.Blogs{display: flex; flex-wrap: wrap;}
    .BlogSticky{position:sticky; top:50px;}</style>
    @include('inc.header')
    <section class="blog pt20px">
        <div class="breadcrumb-main">
            <div class="breadcrumb-bg">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <a href="{{url('/')}}" class="breadcrumb">Home</a>
                            <a href="{{url('/blog')}}" class="breadcrumb">Blog</a>
                            <a href="{{url()->current()}}" class="breadcrumb">{{$detail->post_name}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Home Blog pt20px">
        <div class="container">
            <div class="row Blogs">
                <div class="col s12">
                    <h1 class="h3 Heading">{{$detail->post_name}}
                    </h1>
                </div>
                <div class="col s12 m8 l9">
                    <img src="{{asset('resources/assets/uploads/post/banner/'.$detail->banner_image)}}" alt="{{$detail->post_name}}">
                    <div class="BlogShare">
                        <div class="row">
                            <div class="col s4 l6"> {{date('d F,Y', strtotime($detail->created_at))}}</div>
                            <div class="col s8 l6 shareIcons samwebstudiosocials">
                                <div class="samwebstudiosocials-shares">
                                    <div class="samwebstudiosocials-share samwebstudiosocials-share-whatsapp"><a target="_self" href="#" class="samwebstudiosocials-share-link"><i class="fa fa-whatsapp samwebstudiosocials-share-logo"></i></a></div>
                                    <div class="samwebstudiosocials-share samwebstudiosocials-share-facebook"><a target="_blank" href="#" class="samwebstudiosocials-share-link"><i class="fa fa-facebook samwebstudiosocials-share-logo"></i></a></div>
                                    <div class="samwebstudiosocials-share samwebstudiosocials-share-linkedin"><a target="_blank" href="#" class="samwebstudiosocials-share-link"><i class="fa fa-linkedin samwebstudiosocials-share-logo"></i></a></div>
                                    <div class="samwebstudiosocials-share samwebstudiosocials-share-twitter"><a target="_blank" href="#" class="samwebstudiosocials-share-link"><i class="fa fa-twitter samwebstudiosocials-share-logo"></i></a></div>
                                    <div class="samwebstudiosocials-share samwebstudiosocials-share-pinterest"><a target="_blank" href="#" class="samwebstudiosocials-share-link"><i class="fa fa-pinterest samwebstudiosocials-share-logo"></i></a></div>
                                    <div class="samwebstudiosocials-share samwebstudiosocials-share-email"><a target="_self" href="#" class="samwebstudiosocials-share-link"><i class="fa fa-envelope-o samwebstudiosocials-share-logo"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        {!!$detail->post_desc!!}
                    </div>
                    <div class="BlogShare">
                        <div class="row">
                            <div class="col s12 l6">Update on {{date('d F,Y', strtotime($detail->updated_at))}} </div>
                            <div class="col s12 l6 shareIcons samwebstudiosocials">
                                <div class="samwebstudiosocials-shares">
                                    <div class="shareIcons"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Leave">
                        <h3 class="h4 mcolor1 mb0">Leave a comment</h3>
                        @include('inc.alerts')
                        <form method="post" action="{{url('/comment-save')}}" class="contact">
                            @csrf
                            <input type="hidden" name="blog_id" value="{!!$detail->post_id!!}">
                            <div class="row">
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input type="text" name="name" id="Name" required>
                                        <label for="Name" class="">Name</label>
                                    </div>
                                </div>
                                <div class="col s12 l6">
                                    <div class="input-field">
                                        <input type="text" name="email" id="Email" required>
                                        <label for="Email">Email</label>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <textarea rows="3" class="materialize-textarea" id="Comments" name="comment" required></textarea>
                                        <label for="Comments">Comment</label>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <button type="submit" id="svbtn" class="btn btn-main">Post Comment</button>
                                    <button type="button" id="prcbtn" style="display:none;" class="btn btn-main"><i class="icofont-spinner"></i> Processing...</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if(count($comments)>0)
                    <!-- <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $i)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$i->name}}</td>
                                <td>{{$i->email}}</td>
                                <td>{{$i->comment}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> -->
                    <div class="ViewBlock mt20px mb20px">
                        <div class=" b1px bc-eee grey lighten-4">
                            @foreach($comments as $i)
                            <div class="ViewContent ReviewBlock">
                                <p class="m0 mb5px fw-900">{{$i->name}}</p>
                                <p class="mt0 fs13">{{$i->comment}}</p>
                                <span class="grey-text fs12">{{$i->email}}</span>
                                <span class="grey-text fs12 right">{{date('d F Y',strtotime($i->created_at))}}</span>
                            </div>
                            @endforeach
                        </div>
                        <!-- <div class="ViewContent ReviewBlock">
                            <p class="m0 mb5px fw-900">Balloon Features</p>
                            <p class="mt0 fs13">very happy with the product, however it's very delicate.. if you could include usage instructions it would make it perfect.</p>
                            <span class="stars m0">&#9733;&#9733;&#9733;&#9733;<span>&#9733;</span></span>
                            <span class="grey-text fs12 right">Monday, Jul 26, 2019</span>
                        </div> -->
                    </div>
                    @endif

                </div>
                <div class="col s12 m4 l3">
                    <div class="BlogSticky">
                        <div class="RightPanel">
                            <h3 class="fw-600 h5 text-u mt0">Latest Blogs</h3>
                            <ul>
                                @foreach($latest_post as $i)
                                <li><a href="{{url('/blog-detail/'.$i->post_alias)}}">{{$i->post_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="RightPanel">
                            <h3 class="fw-600 h5 text-u mt0">ARCHIVES</h3>
                            <ul class="Date">
                                @foreach($month_year as $i)
                                <li><a href="{{url('/month-wise-post/'.$i->post_month)}}">{{$i->post_month}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="RightPanel">
                            <h3 class="fw-600 h5 text-u mt0">Category</h3>
                            <ul>
                                @foreach($category as $i)
                                <li><a href="{{url('/category-wise-blog-post/'.$i->cate_id)}}">{{$i->cate_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('inc.footer')
    <script type="text/javascript" src="{{asset('resources/assets/frontend/js/social-share.js')}}"></script>
    <script type="text/javascript">
        $(".shareIcons").jsSocials({
            showLabel: false,
            showCount: false,
            shares: ["whatsapp", "facebook", "linkedin", "twitter", "pinterest", "email"]
        });
    </script>