<x-mail::message>
<h5>Hi` {{$body['slot']['user']['name'] ?? $body['slot']['user_name']}},</h5>
<p>I just wanted to drop you a quick note to let you know that we have received your recent payment & your booked schedule #{{$body['slot']['booking_id']}} has been confirmed by the {{project()}}</p>
<p>Thank you very much. We really appreciate it.</p>

<p>if you any query please contact us on <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a></p>
Sincerely<br>
The {!! config('app.name') !!} Team,<br>
Need Help ?<br>
Please feel free to contact us at <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a>
</x-mail::message>
