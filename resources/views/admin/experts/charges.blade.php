@extends('admin.layouts.app')
@section('content')
    <div class="br-mainpanel br-profile-page">

        <div class="card shadow-base bd-0 rounded-0 widget-4">
            <div class="card-header ht-75">
                <div class="hidden-xs-down">
                    <a href="" class="mg-r-10"><span class="tx-medium">{{ count($data->slots) }}</span> Session</a>
                </div>
                <div class="tx-24 hidden-xs-down">
                    <a href="{{ route('admin.experts') }}" class="mg-r-10"><small style="font-size: 14px;">BACK</small></a>
                </div>
            </div>
            <div class="card-body">
                <div class="card-profile-img">
                    <x-image-box>
                        <x-slot:image>{{ $data->profile }}</x-slot>
                            <x-slot:path>/uploads/expert/</x-slot>
                                <x-slot:alt>{{ $data->name ?? '' }}</x-slot>
                    </x-image-box>
                </div>
                <h4 class="tx-normal tx-roboto tx-white">{{ $data->name }}</h4>
            </div>
        </div>

        <div class="ht-50 bg-gray-100 pd-x-20 d-flex align-items-center justify-content-center shadow-base">
            <ul class="nav nav-outline active-info align-items-center flex-row" role="tablist">
                <li class="nav-item hidden-xs-down"><a class="nav-link"
                        href="{{ route('admin.experts.information', ['page' => 'info', 'id' => $data->id]) }}">Basic
                        Information</a></li>
                <li class="nav-item"><a class="nav-link"
                        href="{{ route('admin.experts.information', ['page' => 'slot', 'id' => $data->id]) }}">Booking Slot</a>
                </li>
                <li class="nav-item"><a class="nav-link active" href="#charges">Slot Charges & Availability</a></li>
            </ul>
        </div>

        <div class="tab-content br-profile-body">
            <div class="tab-pane fade active show" id="charges" aria-expanded="true">
                <div class="row">
                    <div class="col-8">
                        @php
                            $Year = request('year') ?? date('Y');
                            $Month = request('month') ?? date('m');
                            if (empty($Year) && empty($Month)) {
                                $startMonth = \Carbon\Carbon::now()
                                    ->format('Y-m-01');
                                $endMonth = \Carbon\Carbon::now()
                                    ->endOfMonth()
                                    ->format('Y-m-d');
                            }
                            if (!empty($Year) && empty($Month)) {
                                $startMonth = \Carbon\Carbon::createFromFormat('Y-m-d', $Year . '-m-01')
                                    ->startOfMonth()
                                    ->format('Y-m-d');
                                $endMonth = \Carbon\Carbon::createFromFormat('Y-m-d', $Year . '-m-01')
                                    ->endOfMonth()
                                    ->format('Y-m-d');
                            }
                            if (!empty($Year) && !empty($Month)) {
                                $startMonth = \Carbon\Carbon::createFromFormat('Y-m-d', $Year . '-' . $Month . '-01')
                                    ->startOfMonth()
                                    ->format('Y-m-d');
                                $endMonth = \Carbon\Carbon::createFromFormat('Y-m-d', $Year . '-' . $Month . '-01')
                                    ->endOfMonth()
                                    ->format('Y-m-d');
                            }
                        @endphp
                        <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Slot Availability</h6>
                                </div>
                                <form class="col-md-6 d-flex filtfrm" action="{{url()->current()}}">
                                    @csrf
                                    <select name="year" class="form-select me-2" onchange="$('.filtfrm').submit();">
                                        @for ($i = 2023; $i <= date('Y',strtotime('+1 year')); $i++)
                                            <option value="{{ $i }}" {{ $Year == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    <select name="month" class="form-select" onchange="$('.filtfrm').submit();">
                                        @for ($m = 1; $m <= 12; $m++)
                                            <option value="{{ $m }}" {{ $Month == $m ? 'selected' : '' }}>
                                                {{ date('F', strtotime(date('01-' . $m . '-Y'))) }}
                                            </option>
                                        @endfor
                                    </select>
                                </form>
                            </div>
                            <hr>                            
                            <div class="row">
                                <table class="table table-bordered">
                                    <tr>
                                        <td style="width: 10%;"> <small>{{$Year}}</small> Days </td>
                                        <td>Availability</td>
                                    </tr>
                                    @for ($i = $startMonth; $i <= $endMonth; $i++)
                                    @php $checkav = \App\Models\SlotAvailability::where(['date'=>$i,'expert_id'=>$data->id])->get(); @endphp
                                        <tr>
                                            <td>
                                                {{ date('l', strtotime($i)) }} <br>
                                                <small>{{ date('d F', strtotime($i)) }}</small>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    @foreach($checkav as $avai)
                                                    <div class="card p-2 col-3 ms-3" style="background: #dcdcdc;">{{ date('H:i', strtotime($avai->from_time)) }} - {{ date('H:i', strtotime($avai->to_time)) }}
                                                        <small><i class="far fa-clock"></i>
                                                            @foreach ($booktimes as $booktime)
                                                                {{ $booktime->time->minute }}{{ !$loop->last ? ', ' : 'min' }}
                                                            @endforeach
                                                        </small>
                                                    </div>
                                                    @endforeach    
                                                </div>                                                
                                            </td>
                                        </tr>
                                    @endfor
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                            @foreach ($times as $item)
                                @php
                                    $price = \App\Models\SlotCharge::where(['expert_id' => $data->id, 'slot_time_id' => $item->id])->first();
                                @endphp
                                <div class="from-group mb-2">
                                    <label><small>{{ $item->minute }} Minutes Charges
                                            ({{ defaultcurrency() }})</small></label>
                                    <input type="text" class="form-control" readonly name="charges[{{ $item->id }}]"
                                        value="{{ $price->charges ?? '' }}" placeholder="Eg: $240">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('css')
    <title>Experts Information : {{ project() }}</title>
    <link href="{{ asset('admin/lib/SpinKit/spinkit.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script></script>
@endpush
