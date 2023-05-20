<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel"></h5>
    <a href="" onclick="window.location.reload()" class="sws-bounce sws-top" data-title="Back & Reload"><i class="fas fa-sync"></i></a>
</div>
<div class="modal-body">
    <form action="{{route('user.savereviews')}}" method="post">
        @csrf
        <input type="hidden" name="preid" value="{{$reviews->id}}">
        <p class="h6 m-0"><span class="thm1">Edit Your Review</span></p>
        <div class="rating m-0 mt-2">
            <input type="radio" name="rating" required value="5" @checked($reviews->rating==5) id="rating-5"><label for="rating-5"></label>
            <input type="radio" name="rating" required value="4" @checked($reviews->rating==4) id="rating-4"><label for="rating-4"></label>
            <input type="radio" name="rating" required value="3" @checked($reviews->rating==3) id="rating-3"><label for="rating-3"></label>
            <input type="radio" name="rating" required value="2" @checked($reviews->rating==2) id="rating-2"><label for="rating-2"></label>
            <input type="radio" name="rating" required value="1" @checked($reviews->rating==1) id="rating-1"><label for="rating-1"></label>
            <div class="emoji-wrapper">
                <div class="emoji">
                    <img src="{{asset('frontend/img/rating.svg')}}" class="rating-0">
                    <img src="{{asset('frontend/img/rating1.svg')}}">
                    <img src="{{asset('frontend/img/rating2.svg')}}">
                    <img src="{{asset('frontend/img/rating3.svg')}}">
                    <img src="{{asset('frontend/img/rating4.svg')}}">
                    <img src="{{asset('frontend/img/rating5.svg')}}">
                </div>
            </div>
            @error('rating') <span class="error">{{$message}}</span> @enderror
        </div>
        <div class="row">
            <div class="col-md-9 col-lg-8">                                                    
                <div class="form-floating mt-3" id="expert" name="expert" required>
                    <fieldset>
                        <select name="expert" id="editpeople">
                            <option value="" disabled selected>Select a Expert:</option>
                            @foreach ($bookings as $item)
                            <option value="{{$item->expert->id ?? ''}}" @selected($reviews->expert_id==$item->expert->id) data-class="avatar" data-style="background-image: url(&apos;{{asset('uploads/expert/'.$item->expert->profile)}}&apos;);">{{$item->expert->name ?? ''}}</option>
                            @endforeach 
                        </select>
                    </fieldset>
                </div>
                @error('expert') <span class="error">{{$message}}</span> @enderror
            </div>
            <div class="col-12">
                <div class="form-floating mt-3">
                    <textarea name="message" class="form-control" placeholder="Message" required maxlength="300" data-length="300" id="message">{{$reviews->description}}</textarea>
                    <label for="message">Message <span class="text-danger">*</span></label>
                </div>
                @error('message') <span class="error">{{$message}}</span> @enderror
            </div>
            <div class="col-12">
                <button type="submit" onclick="checkvalid()" class="btn btn-thm2 sbtn">Confirm & Update</button>
                <button type="button" disabled class="btn btn-thm2 pbtn" style="display: none"><i class="fad fa-spinner-third fa-spin me-1"></i> Loading...</button>
            </div>
        </div>
    </form>
</div>
<script>
    $( function() {
        $.widget( "custom.iconselectmenu", $.ui.selectmenu, {
            _renderItem: function( ul, item ) {
                var li = $( "<li>" ),
                wrapper = $( "<div>", { text: item.label } );        
                if ( item.disabled ) {
                    li.addClass( "ui-state-disabled" );
                }        
                $( "<span>", {
                style: item.element.attr( "data-style" ),
                "class": "ui-icon " + item.element.attr( "data-class" )
                })
                .appendTo( wrapper );        
                return li.append( wrapper ).appendTo( ul );
            }
        }); 
    
        $( "#editpeople" )
            .iconselectmenu()
            .iconselectmenu( "menuWidget")
                .addClass( "ui-menu-icons avatar" );
    } );

    function checkvalid(){
        let Rating = 0;
        if($('input[name=rating]').is(':checked')==true){
            Rating = 1;
        }
        if(Rating==1 && $('textarea[name=message]').val()!='' && $('#editpeople').val()!=''){
            $('.pbtn').show(); 
            $('.sbtn').hide(); 
        }
    }
</script>