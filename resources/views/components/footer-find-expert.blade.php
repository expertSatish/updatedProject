<section class="Sec2 py-5 Steps">
    <div class="container">
        <div class="row">
            @foreach ($lists as $item)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <x-image-box>
                            <x-slot:image>{{$item->image}}</x-slot>
                            <x-slot:path>/uploads/callingprocess/</x-slot>
                            <x-slot:alt>{{$item->title ?? ''}}</x-slot>
                        </x-image-box>
                        <h3 class="h4 mb-4">{{$item->title}}</h3>
                        {!! $item->description !!}
                    </div>
                </div>
            </div> 
            @endforeach           
        </div>
    </div>
</section>