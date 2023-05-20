<x-mail::message>
<h5>Hi`,</h5>
<p>I just wanted to drop you a quick note to let you know that we have received a new payment {{defaultcurrency()}} {{$body['transation']['amount'] ?? ''}} and transation no is #{{$body['transation']['transationno']}}.</p>
<p>You have received this payment by {{$body['transation']['user']['name']}} (#{{$body['transation']['user']['user_id']}}) for depositing money in his wallet.</p>

<p>if you any query please contact us on <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a></p>
Sincerely<br>
The {!! config('app.name') !!} Team,<br>
Need Help ?<br>
Please feel free to contact us at <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a>
</x-mail::message>
