<x-mail::message>
<h5>Hi` {{$body['transation']['user']['name'] ?? 'Dear'}},</h5>
<p>I just wanted to drop you a quick note to let you know that we have received your recent payment & your transation no is #{{$body['transation']['transationno']}}.</p>
<p>Thank you very much. your wallet updated soon.</p>
<p>If your wallet is not updated then you can also tell us through claim request.</p>

<p>if you any query please contact us on <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a></p>
Sincerely<br>
The {!! config('app.name') !!} Team,<br>
Need Help ?<br>
Please feel free to contact us at <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a>
</x-mail::message>
