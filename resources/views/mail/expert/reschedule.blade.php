<x-mail::message>
<h5>Hi` {{$body['booking']['expert']['name']}}</h5>
<p>I just wanted to drop you a quick note to let you know that your booked schedule #{{$body['oldbooking']['booking_id']}} has been reschedule by the {{$body['schedule']}}.</p>
<p>your new reschedule booking is #{{$body['booking']['booking_id']}} on {{date('d M Y',strtotime($body['booking']['booking_date']))}} at {{date('H:i A',strtotime($body['booking']['booking_start_time']))}} To {{date('H:i A',strtotime($body['booking']['booking_end_time']))}}.</p><br>

<p>if you any query please contact us on <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a></p>
Sincerely<br>
The {!! config('app.name') !!} Team,<br>
Need Help ?<br>
Please feel free to contact us at <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a>
</x-mail::message>
