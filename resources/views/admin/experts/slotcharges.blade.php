<form class="editslotcharges" method="post" action="{{route('admin.experts.saveslotcharges')}}">
    @csrf
    <input type="hidden" name="expert_id" value="{{$expert->id}}">
    <div class="modal-header pd-x-20">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold title">
            Expert Slot Charges
        </h6>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body pd-20 ">
        <div class="row mg-b-25">
            @if (count($charges) == 0)
                @foreach ($times as $time)
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>{{ $time->title }} {{ $time->minute }} Minutes </label>
                            <input type="text" min="0" class="form-control" value="{{ old('title') }}"
                                name="charges[{{ $time->id }}]"
                                placeholder="{{ $time->title }} {{ $time->minute }} Minutes">
                            <span class="error title-error"><span>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($charges as $item)
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>{{ $item->time->title ?? '' }} {{ $item->time->minute ?? '' }} Minutes </label>
                            <input type="text" min="0" class="form-control"
                                value="{{ old('charges', $item->charges) }}" name="charges[{{ $item->slot_time_id }}]"
                                placeholder="{{ $item->time->title }} {{ $item->time->minute }} Minutes">
                            <span class="error title-error"><span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="modal-footer justify-content-center">
        <button id="Msvbtn" class="btn btn-dark tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Update & Proceed</button>
        <button type="button" disabled id="Mprcbtn" style="display:none;"
            class="btn btn-dark tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i
                class="fad fa-spinner-third fa-spin"></i> Loading...</button>
    </div>
</form>
