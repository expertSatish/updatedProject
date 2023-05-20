@extends('layouts.app')
@section('content')
<main>
    <section class="inner-banner"><div class="section"><div class="bg-white"></div></div></section>
    <section class="BlogDetail BlogCategory pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fal fa-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{url('/blog')}}">Blog</a></li>
                <li class="breadcrumb-item"><a aria-current="page">Blog Detail</a></li>
            </ol>
            <div class="row">
                <div class="col-lg-9 col-md-8 BlogList">
                    <div class="DetailTop">
                        <h1 class="mb-3 h3">{{$list->title}}</h1>
                        <div class="d-flex mb-3">
                            <!-- <a href="#"><i class="fal fa-user-circle thm"></i> Admin</a> |  -->
                            <span><i class="far fa-calendar-alt thm"></i> {{dateformat($list->post_date)}}</span> 
                            {{-- <a href="#"><i class="fal fa-comment thm"></i> No Comments</a> --}}
                        </div>
                        <x-image-box>
                            <x-slot:image>{{$list->banner}}</x-slot>
                            <x-slot:path>/uploads/blog/banner/</x-slot>
                            <x-slot:alt>{{$list->title ?? ''}}</x-slot>
                            <x-slot:height>200</x-slot>
                            <x-slot:width>200</x-slot>
                        </x-image-box>
                    </div>
                    <div class="CmsPage mt-3">{!!$list->description!!}</div>
                    <div class="sharebox mt-4">
                        <div class="row justify-content-between">
                            <div class="col">
                                <strong>Share Now</strong>
                                {!! \Share::currentPage()->facebook()->twitter()->linkedin()->telegram()->whatsapp()->reddit()!!}
                            </div>
                            {{-- <div class="col"><span class="Comments"><i class="flaticon-chat-1"></i> 0 No Comments</span></div> --}}
                        </div>
                    </div>
                    @if (isset($previous_record) || isset($next_record))
                    <div class="border-top border-bottom py-3 mt-4 PreNext">
                        <div class="row justify-content-between">
                            @if (isset($previous_record))
                            <div class="col"><a href="{{route('blog',['alias'=>$previous_record->alias])}}"><i class="fal fa-angle-double-left"></i> Previous</a><a href="{{route('blog',['alias'=>$previous_record->alias])}}">{{$previous_record->title}}</a></div>
                            @endif
                            @if (isset($next_record))
                            <div class="col"><a href="{{route('blog',['alias'=>$next_record->alias])}}"><i class="fal fa-angle-double-right"></i> Next</a><a href="{{route('blog',['alias'=>$next_record->alias])}}">{{$next_record->title}}</a></div>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if($relateds->count() > 0)
                    <div class="Sec5 mt-4 listing">
                        <h3 class="mb-4 h4">Related Articles</h3>
                        <div id="Blog" class="owl-carousel">
                            @foreach($relateds as $item)
                            <div class="item">
                                <div class="card Blog">
                                    <a href="{{route('blog',['alias'=>$item->alias])}}" class="card-header">
                                        <x-image-box>
                                            <x-slot:image>{{$item->image}}</x-slot>
                                            <x-slot:path>/uploads/blog/</x-slot>
                                            <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                                            <x-slot:height>480</x-slot>
                                            <x-slot:width>380</x-slot>
                                        </x-image-box>
                                    </a>
                                    <a href="{{route('blog',['alias'=>$item->alias])}}" class="card-body">
                                        <h3 class="h5">{{$item->title}}</h3>
                                        <div class="admin">
                                            <span class="me-4"><img src="{{asset('frontend/img/admin.svg')}}" class="me-1"> Admin</span> 
                                            {{-- <span><img src="{{asset('frontend/img/comment.svg')}}"> Comments (2)</span> --}}
                                            <span><i class="far fa-calendar-alt thm"></i> {{dateformat($item->post_date)}}</span>
                                            
                                        </div>
                                        <p>{{$item->short_description}}</p>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="CommentsSec d-none mt-4">
                        <h3 class="mb-4 h4">5 Comments</h3>
                        <div class="row">
                            <div class="col-12">
                                <ul>
                                    <li>
                                        <div class="Uimg"><img src="img/man.svg"></div>
                                        <div class="Ctext">
                                            <div class="card">
                                                <div class="card-body">
                                                    <strong>Poonam Sharma</strong>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                                    <div class="d-flex justify-content-end"><a href="#Reply" data-bs-toggle="modal" data-bs-target="#Reply" class="Reply"><i class="flaticon-reply-message"></i>Reply</a></div>
                                                </div>
                                            </div>
                                            <ul>
                                                <li>
                                                    <div class="Uimg"><img src="img/man.svg"></div>
                                                    <div class="Ctext">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <strong>Poonam Sharma</strong>
                                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                                                <div class="d-flex justify-content-end"><a href="#Reply" data-bs-toggle="modal" data-bs-target="#Reply" class="Reply"><i class="flaticon-reply-message"></i>Reply</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="Uimg"><img src="img/man.svg"></div>
                                        <div class="Ctext">
                                            <div class="card">
                                                <div class="card-body">
                                                    <strong>Poonam Sharma</strong>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                                    <div class="d-flex justify-content-end"><a href="#Reply" data-bs-toggle="modal" data-bs-target="#Reply" class="Reply"><i class="flaticon-reply-message"></i>Reply</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="LeaveReply d-none mt-4">
                        <h3 class="mb-4 h4">Leave A Reply</h3>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <p>Your email address will not be published. Required fields are marked *</p>
                                        <form action="" class="comtform" method="post">
                                            @csrf
                                            <input type="hidden" name="blog_id" value="{{$list->id}}">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" placeholder="Leave a comment here" name="message" id="Comments"></textarea>
                                                <label for="Comments">Comments</label>
                                                <small class="error cmerr"></small>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control inputTextBox" id="name" name="name" placeholder="Name">
                                                        <label for="name" class="form-label">Name</label>
                                                        <small class="error nmerr"></small>
                                                    </div>                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" id="Email" name="email" placeholder="Email ID">
                                                        <label for="Email" class="form-label">Email</label>
                                                        <small class="error emerr"></small>
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <button type="submit" class="btn btn-thm4 bcsbtn">Post Comment</button>
                                            <button type="button" style="display:none;" class="btn btn-thm4 bcpbtn" disabled><i class="fad fa-spinner-third me-1 fa-spin"></i> Loading...</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 rightp">
                    <div>
                        @if($populars->count() > 0)
                        <h3>Most Popular Blogs</h3>
                        <div class="card MostBlogs">
                            <div class="card-body">
                                @foreach ($populars as $item)
                                <div>
                                    <div class="img">
                                        <x-image-box>
                                            <x-slot:image>{{$item->image}}</x-slot>
                                            <x-slot:path>/uploads/blog/</x-slot>
                                            <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                                            <x-slot:height>200</x-slot>
                                            <x-slot:width>200</x-slot>
                                        </x-image-box>
                                    </div>
                                    <div class="text">
                                        <h3><a href="{{route('blog',['alias'=>$item->alias])}}">{{$item->title}}</a></h3>
                                        <div class="d-flex"><a href="{{route('blog',['alias'=>$item->alias])}}"><i class="fal fa-user-circle"></i> Admin</a> | <span><i class="far fa-calendar-alt"></i> {{dateformat($item->post_date)}}</span></div>
                                    </div>
                                </div> 
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <h3>Newsletter</h3>
                        <div class="card Newsletter">
                            <form class="card-body newsletterform">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-label">Email Address*</label>
                                    <input type="text" class="form-control" id="subscribe_email" name="subscribe_email" placeholder="Email ">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-thm btn-sm mt-3 ncsbtn">Subscribe</button>
                                    <button type="button" class="btn btn-thm btn-sm mt-3 nspbtn" style="display:none" disabled><i class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
                                </div>
                            </form>
                        </div>
                        <h3>Archives</h3>
                        <div class="card MostBlogs">
                            <div class="card-body Archives">
                                <ul class="list-group list-group-flush">
                                    @foreach ($archives as $archive)
                                    <li class="list-group-item"><a href="{{route('blogarchive',['alias'=>$archive->year.'-'.$archive->month])}}"><i class="fas fa-calendar-alt"></i> {{date('M',strtotime('1-'.$archive->month.'-'.$archive->year))}} {{$archive->year}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if($categories->count() > 0)
                        <h3>Categories</h3>
                        <div class="card MostBlogs">
                            <div class="card-body Archives">
                                <ul class="list-group list-group-flush">
                                    @foreach ($categories as $category)
                                    <li class="list-group-item"><a href="{{route('blogcategory',['alias'=>$category->alias])}}"><i class="fas fa-folder-open"></i> {{$category->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<div class="modal fade" id="Reply" tabindex="-1" aria-labelledby="ReplyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bgthm text-white py-2">Leave A Reply <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <div class="modal-body">
                <div>
                    <p>Your email address will not be published. Required fields are marked *</p>
                    <form action="" method="post">
                        <input type="hidden" name="contact" value="yes">
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" name="Message" id="Comments"></textarea>
                                    <label for="Comments">Comments</label>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="Name" placeholder="Name">
                                    <label for="name" class="form-label">Name</label>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="Email" name="Email" placeholder="Email ID">
                                    <label for="Email" class="form-label">Email</label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rlstay">
                                    <label class="form-check-label" for="rlstay">Save my name, email, and website in this browser for the next time I comment.</label>
                                </div>
                                <button type="submit" class="btn btn-thm4">Post Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<title>Blog : Expert Bells</title>
<meta name="description" content="Welcome to expert Bells">
<meta name="keywords" content="Welcome to expert Bells">
<link rel="stylesheet" href="{{asset('frontend/css/blog.css')}}">
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" onload="this.rel='stylesheet'" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
<style>body>main{overflow:inherit!important}
.CmsPage a{text-decoration:underline!important;color:var(--thm)!important}
.CmsPage p{word-wrap:break-word}</style>
@endpush
@push('js')
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" onload="this.rel='stylesheet'" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#Blog").owlCarousel({items:2,margin:15,loop:false,dots:false,nav:true,navText:['<span class="icon fal fa-chevron-left"></span>','<span class="fal fa-chevron-right"></span>'],autoplay:false,autoplayTimeout:3000,autoplayHoverPause:true,responsiveClass:true,responsive:{250:{items:1},350:{items:1},460:{items:1},600:{items:2},768:{items:2},992:{items:2},1200:{items:2},1600:{items:2}}});
    });
    const newsletterform = @json(route('savenewsletter'));
    const commentform = @json(route('saveblogcomment'));
</script>
@endpush