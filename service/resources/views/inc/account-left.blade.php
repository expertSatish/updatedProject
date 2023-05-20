<div class="col s12 l3">
    <div class="MyAccountMenu">
        <span class='dropdown-trigger' data-target='dropdown1'><i class="material-icons menu-ico">menu</i> My Account Menu</span>
        <ul class="LeftPanel dropdown-content" id="dropdown1">
            <li><a href="{{url('my-account')}}" <?php if ($active == 'My Account') echo "class='active'"; ?>><i class="icofont-dashboard"></i> Dashboard</a></li>
            <li><a href="{{url('order')}}" <?php if ($active == 'Orders') echo "class='active'"; ?>><i class="icofont-inbox"></i> My Orders</a></li>
            <li><a href="{{url('account-setting')}}" <?php if ($active == 'Account Setting') echo "class='active'"; ?>><i class="icofont-business-man"></i> Account Settings</a></li>
            @php
            $user_documents = DB::table('user_document')->where('user_id', Auth::user()->id)->get();
            @endphp
            <li><a style="position:relative;" href="{{url('/upload-documents')}}" <?php if ($active == 'Upload Documents') echo "class='active'"; ?>><i class="icofont-upload-alt"></i> Upload Documents @if(count($user_documents)==0)<span style="position: absolute; top: 3px; right: 3px; font-size: 9px; height: 20px; padding: 2px 9px; border-radius: 16px; background: #fdab00; color: #fff; line-height: 15px;">No Documents</span>@endif</a></li>
            <li><a href="{{url('review-and-ratings')}}" <?php if ($active == 'Review & Ratings') echo "class='active'"; ?>><i class="icofont-ui-rate-add"></i> Review & Ratings</a></li>

            <li><a href="javascript:void(0);" onClick="event.preventDefault();  document.getElementById('logout-form').submit();"><i class="icofont-power"></i> Logout</a></li>
            
        </ul>
    </div>
</div>