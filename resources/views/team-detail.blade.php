<div class="modal-header">
    <h5 class="modal-title" id="UserName">{{$teams->title}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <x-image-box>
        <x-slot:image>{{$teams->image}}</x-slot>
        <x-slot:path>/uploads/team/</x-slot>
        <x-slot:alt>{{$teams->title ?? ''}}</x-slot>
        <x-slot:height>480</x-slot>
        <x-slot:width>380</x-slot>
        <x-slot:class>col-12 h-auto col-md-4 mb-2 float-start</x-slot>
    </x-image-box>
    {!! $teams->description !!}
</div>
<div class="modal-footer justify-content-center">
    <ul class="icons iblack">
        @if(!empty($teams->twitter) && $teams->twitter!='#') <li><a href="{{$teams->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li> @endif
        @if(!empty($teams->linkedin) && $teams->linkedin!='#') <li><a href="{{$teams->linkedin}}" target="_blank"><i class="fab fa-linkedin"></i></a></li> @endif
        @if(!empty($teams->facebook) && $teams->facebook!='#') <li><a href="{{$teams->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li> @endif
        @if(!empty($teams->instagram) && $teams->instagram!='#') <li><a href="{{$teams->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a></li> @endif
        @if(!empty($teams->pinterest) && $teams->pinterest!='#') <li><a href="{{$teams->pinterest}}" target="_blank"><i class="fab fa-pinterest-p"></i></a></li> @endif
    </ul>
</div>