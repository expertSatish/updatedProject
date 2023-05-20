<x-mail::message>

<h5>Hi` {{$body['slot']['expert']['name'] ?? 'Expert'}},</h5>
<p>You have received a new booking #{{$body['slot']['booking_id']}}</p>



<p>For any query please contact <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a></p>
Sincerely<br>
The {!! config('app.name') !!} Team,<br>
Need Help ?<br>
Please feel free to contact us at <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a>
</x-mail::message>
