<li><input type="text" class="form-control SearchConCode" placeholder="Search Country Code"></li>
@foreach($countries as $country)
<li data-code="{{strtolower($country->sortname)}}" data-name="{{$country->name}}" data-text="+{{$country->phonecode}}"><i class="flagicon fi-{{strtolower($country->sortname)}}"></i>{{$country->name}} <span>(+{{$country->phonecode}})</span></li>
@endforeach