<div class="br-sideleft overflow-y-auto">
  <label class="sidebar-label pd-x-15 mg-t-20">Navigation</label>  
  <div class="br-sideleft-menu">  
    <a href="{{route('admin.index')}}" class="br-menu-link {{Request::segment(2)=='dashboard'?'active':''}}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-android-desktop tx-22"></i>
        <span class="menu-item-label">Dashboard</span>
      </div>
    </a>
    <a href="{{route('admin.experts')}}" class="br-menu-link {{in_array(Request::segment(2),['experts','experts-information'])?'active':''}}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-person tx-22"></i>
        <span class="menu-item-label">Experts</span>
      </div>
    </a>
    <a href="{{route('admin.users')}}" class="br-menu-link {{in_array(Request::segment(2),['users','users-information'])?'active':''}}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-person-stalker tx-22"></i>
        <span class="menu-item-label">Users</span>
      </div>
    </a>
    <a href="javascript:void(0)" class="br-menu-link {{in_array(Request::segment(2),$home) ? 'active' : '' }}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-24"></i>
        <span class="menu-item-label">Home Management </span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a> 
    
    <ul class="br-menu-sub nav flex-column" style="display:{{in_array(Request::segment(2),$home) ? 'block' : 'none' }}">
      <li class="nav-item"><a href="{{route('admin.banner')}}" class="nav-link {{in_array(Request::segment(2),['banner','bannercms'])?'active':''}}">Banner</a></li>
      <li class="nav-item"><a href="{{route('admin.findexpertstep')}}" class="nav-link {{in_array(Request::segment(2),['find-expert-step','findexpertstepcms'])?'active':''}}">Find Expert Steps</a></li>
      <li class="nav-item"><a href="{{route('admin.homeexpertcms')}}" class="nav-link {{in_array(Request::segment(2),['homeexpertcms'])?'active':''}}">Your Expert (CMS)</a></li>
      {{-- <li class="nav-item"><a href="{{route('admin.featured')}}" class="nav-link {{in_array(Request::segment(2),['featured','featuredcms'])?'active':''}}">Featured in</a></li> --}}
      <li class="nav-item"><a href="{{route('admin.findexpertcategorycms')}}" class="nav-link {{in_array(Request::segment(2),['home-expert-category','homeexpertcategorycms'])?'active':''}}">Find a mentor category</a></li>
      <li class="nav-item"><a href="{{route('admin.homeexpertcategory')}}" class="nav-link {{in_array(Request::segment(2),['home-expert-category','homeexpertcategorycms'])?'active':''}}">Are you a Mentor ?</a></li>
      <li class="nav-item"><a href="{{route('admin.homeexpertvidoes')}}" class="nav-link {{in_array(Request::segment(2),['home-expert-vidoes'])?'active':''}}">Experts Video Gallery</a></li>
      <li class="nav-item"><a href="{{route('admin.hometestimonialcms')}}" class="nav-link {{in_array(Request::segment(2),['hometestimonialcms'])?'active':''}}">Customer Testimonials (CMS)</a></li>
      <li class="nav-item"><a href="{{route('admin.youanexpert')}}" class="nav-link {{in_array(Request::segment(2),['feqshomecms'])?'active':''}}">FAQs (CMS)?</a></li>
      {{-- <li class="nav-item"><a href="{{route('admin.homenewscms')}}" class="nav-link {{in_array(Request::segment(2),['homenewscms'])?'active':''}}">We are in the News (CMS)</a></li> --}}
    </ul>

    <a href="javascript:void(0)" class="br-menu-link {{in_array(Request::segment(2),$schedules) ? 'active' : '' }}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-24"></i>
        <span class="menu-item-label">Schedules </span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>  
    <ul class="br-menu-sub nav flex-column" style="display:{{in_array(Request::segment(3),$schedules) ? 'block' : 'none' }}">
      <li class="nav-item"><a href="{{route('admin.schedules.booked',['booked'=>'booked'])}}" class="nav-link {{Request::segment(3)=='booked'?'active':''}}">Booked</a></li>
      <li class="nav-item"><a href="{{route('admin.schedules.booked',['booked'=>'closed'])}}" class="nav-link {{Request::segment(3)=='closed'?'active':''}}">Closed</a></li>
      <li class="nav-item"><a href="{{route('admin.schedules.booked',['booked'=>'reschedule'])}}" class="nav-link {{Request::segment(3)=='reschedule'?'active':''}}">Reschedule</a></li>
      <li class="nav-item"><a href="{{route('admin.schedules.booked',['booked'=>'rejected'])}}" class="nav-link {{Request::segment(3)=='rejected'?'active':''}}">Rejected</a></li>
      <li class="nav-item"><a href="{{route('admin.schedules.booked',['booked'=>'expired'])}}" class="nav-link {{Request::segment(3)=='expired'?'active':''}}">Expired</a></li>
    </ul>

    <a href="javascript:void(0)" class="br-menu-link {{in_array(Request::segment(2),$wallet) ? 'active' : '' }}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-24"></i>
        <span class="menu-item-label">Wallet Request </span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>  
    <ul class="br-menu-sub nav flex-column" style="display:{{in_array(Request::segment(3),$wallet) ? 'block' : 'none' }}">
      <li class="nav-item"><a href="{{route('admin.wallet',['request'=>'deposit'])}}" class="nav-link {{Request::segment(3)=='deposit'?'active':''}}">Deposit Request</a></li>
      <li class="nav-item"><a href="{{route('admin.wallet',['request'=>'withdrawal'])}}" class="nav-link {{Request::segment(3)=='withdrawal'?'active':''}}">Withdrawal Request</a></li>
      <li class="nav-item"><a href="{{route('admin.wallet',['request'=>'claim'])}}" class="nav-link {{Request::segment(3)=='claim'?'active':''}}">Claim Request</a></li>
    </ul>

    <a href="javascript:void(0)" class="br-menu-link {{in_array(Request::segment(2),$becomeanexpert) ? 'active' : '' }}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-24"></i>
        <span class="menu-item-label">Become An Expert </span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>  
    <ul class="br-menu-sub nav flex-column" style="display:{{in_array(Request::segment(2),$becomeanexpert) ? 'block' : 'none' }}">
      <li class="nav-item"><a href="{{route('admin.becomeanexpertbanner')}}" class="nav-link {{in_array(Request::segment(2),['become-an-expert-banner'])?'active':''}}">Banner</a></li>
      <li class="nav-item"><a href="{{route('admin.becomeanexpertcontent')}}" class="nav-link {{in_array(Request::segment(2),['become-an-expert-content'])?'active':''}}">Content Section</a></li>
      <li class="nav-item"><a href="{{route('admin.threeicons')}}" class="nav-link {{in_array(Request::segment(2),['three-icons'])?'active':''}}">3 Icons</a></li>
      <li class="nav-item"><a href="{{route('admin.mentor')}}" class="nav-link {{in_array(Request::segment(2),['mentor','memtorcms'])?'active':''}}">Why should you mentor</a></li>
      <li class="nav-item"><a href="{{route('admin.becomeanexpertabout')}}" class="nav-link {{in_array(Request::segment(2),['become-an-expert-about'])?'active':''}}">About Section</a></li>
      <li class="nav-item"><a href="{{route('admin.callingprocess')}}" class="nav-link {{in_array(Request::segment(2),['calling-process','callingprocesscms'])?'active':''}}">Calling process</a></li>
      <li class="nav-item"><a href="{{route('admin.testimonials')}}" class="nav-link {{in_array(Request::segment(2),['testimonials','addtestimonial','edittestimonial','testimonialcms'])?'active':''}}">Testimonials</a></li>
    </ul>

    <a href="javascript:void(0)" class="br-menu-link {{in_array(Request::segment(2),$aboutus) ? 'active' : '' }}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-24"></i>
        <span class="menu-item-label">About Us </span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>  
    <ul class="br-menu-sub nav flex-column" style="display:{{in_array(Request::segment(2),$aboutus) ? 'block' : 'none' }}">
      <li class="nav-item"><a href="{{route('admin.about')}}" class="nav-link {{in_array(Request::segment(2),['about'])?'active':''}}">About Us</a></li>
      <li class="nav-item"><a href="{{route('admin.mission')}}" class="nav-link {{in_array(Request::segment(2),['mission','help-center','edit-help-center'])?'active':''}}">Mission</a></li>
      <li class="nav-item"><a href="{{route('admin.vission')}}" class="nav-link {{in_array(Request::segment(2),['vission'])?'active':''}}">Vission</a></li>
      <li class="nav-item"><a href="{{route('admin.contact')}}" class="nav-link {{in_array(Request::segment(2),['contact','contactcms'])?'active':''}}">Contact Us</a></li>
      <li class="nav-item"><a href="{{route('admin.teams')}}" class="nav-link {{in_array(Request::segment(2),['teams','teamcms','addteams','editteams'])?'active':''}}">Team</a></li>
      <li class="nav-item"><a href="{{route('admin.privacypolicy')}}" class="nav-link {{in_array(Request::segment(2),['privacy-policy'])?'active':''}}">Privacy Policy</a></li>
      <li class="nav-item"><a href="{{route('admin.termscondition')}}" class="nav-link {{in_array(Request::segment(2),['terms-condition'])?'active':''}}">Terms and Conditions</a></li>
    </ul>

    <a href="javascript:void(0)" class="br-menu-link {{in_array(Request::segment(2),$faqs) ? 'active' : '' }}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-24"></i>
        <span class="menu-item-label">FAQs Management</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>  
    <ul class="br-menu-sub nav flex-column" style="display:{{in_array(Request::segment(2),$faqs) ? 'block' : 'none' }}">
      <li class="nav-item"><a href="{{route('admin.faqscategory')}}" class="nav-link {{in_array(Request::segment(2),['faqs-category','new-faqs-category','edit-faqs-category'])?'active':''}}">FAQs Category</a></li>
      <li class="nav-item"><a href="{{route('admin.faqs')}}" class="nav-link {{in_array(Request::segment(2),['faqcms','faqs','new-faqs','edit-faqs'])?'active':''}}">FAQs</a></li>
    </ul>

    <a href="{{route('admin.career')}}" class="br-menu-link {{in_array(Request::segment(2),['career','careercms','addcareer','editcareer'])?'active':''}}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
        <span class="menu-item-label">Career</span>
      </div>
    </a>

    <a href="{{route('admin.blogs')}}" class="br-menu-link {{in_array(Request::segment(2),['blogcms','blog-category','blog-management','new-blog','edit-blog','blog-category','new-blog-category','edit-blog-category','blog-comments'])?'active':''}}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
        <span class="menu-item-label">Blog Management</span>
      </div>
    </a>

    <a href="javascript:void(0)" class="br-menu-link {{in_array(Request::segment(2),$helpcenter) ? 'active' : '' }}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-24"></i>
        <span class="menu-item-label">Help Center </span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>  
    <ul class="br-menu-sub nav flex-column" style="display:{{in_array(Request::segment(2),$helpcenter) ? 'block' : 'none' }}">
      <li class="nav-item"><a href="{{route('admin.helpcenter.list')}}" class="nav-link {{in_array(Request::segment(2),['add-help-center','help-center','edit-help-center'])?'active':''}}">Help Center</a></li>
      <li class="nav-item"><a href="{{route('admin.helpcenterquery.list')}}" class="nav-link {{in_array(Request::segment(2),['help-center-query'])?'active':''}}">Queries</a></li>
    </ul> 
    <a href="javascript:void(0)" class="br-menu-link {{in_array(Request::segment(2),$others) ? 'active' : '' }}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-24"></i>
        <span class="menu-item-label">Other Management </span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>  
    <ul class="br-menu-sub nav flex-column" style="display:{{in_array(Request::segment(2),$others) ? 'block' : 'none' }}">
      {{-- <li class="nav-item"><a href="{{route('admin.qualifications')}}" class="nav-link {{Request::segment(2)=='qualifications'?'active':''}}">Qualifications</a></li> --}}
      <li class="nav-item"><a href="{{route('admin.expertcategory')}}" class="nav-link {{Request::segment(2)=='expert-category'?'active':''}}">Expert Category</a></li>
      <li class="nav-item"><a href="{{route('admin.expertise')}}" class="nav-link {{Request::segment(2)=='expertise'?'active':''}}">Expertise</a></li>
      <li class="nav-item"><a href="{{route('admin.language')}}" class="nav-link {{Request::segment(2)=='language'?'active':''}}">Language</a></li>
      <li class="nav-item"><a href="{{route('admin.industry')}}" class="nav-link {{Request::segment(2)=='industry'?'active':''}}">Industry</a></li>
      <li class="nav-item"><a href="{{route('admin.role')}}" class="nav-link {{Request::segment(2)=='role'?'active':''}}">Role</a></li>
      {{-- <li class="nav-item"><a href="{{route('admin.getbetter')}}" class="nav-link {{Request::segment(2)=='getbetter'?'active':''}}">Get Better</a></li>
      <li class="nav-item"><a href="{{route('admin.hearabout')}}" class="nav-link {{Request::segment(2)=='hearabout'?'active':''}}">Hear About us</a></li> --}}
      <li class="nav-item"><a href="{{route('admin.working')}}" class="nav-link {{Request::segment(2)=='working'?'active':''}}">Working As</a></li>
    </ul> 
    
    <a href="javascript:void(0)" class="br-menu-link {{Request::segment(2)=='enquiry' && in_array(Request::segment(3),$enquiry) ? 'active' : '' }}">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-24"></i>
        <span class="menu-item-label">Enquiry Management </span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div>
    </a>  
    <ul class="br-menu-sub nav flex-column" style="display:{{Request::segment(2)=='enquiry' && in_array(Request::segment(3),$enquiry) ? 'block' : 'none' }}">
      <li class="nav-item"><a href="{{route('admin.enquiry',['type'=>'comments'])}}" class="nav-link {{Request::segment(3)=='comments'?'active':''}}">Blog Comments</a></li>
      <li class="nav-item"><a href="{{route('admin.enquiry',['type'=>'jobs'])}}" class="nav-link {{Request::segment(3)=='jobs'?'active':''}}">Job</a></li>
      <li class="nav-item"><a href="{{route('admin.enquiry',['type'=>'contact'])}}" class="nav-link {{Request::segment(3)=='contact'?'active':''}}">Contact</a></li>
      <li class="nav-item"><a href="{{route('admin.enquiry',['type'=>'newsletter'])}}" class="nav-link {{Request::segment(3)=='newsletter'?'active':''}}">Newsletter</a></li>
    </ul> 

  </div>  
</div>