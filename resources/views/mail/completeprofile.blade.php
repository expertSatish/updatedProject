<x-mail::message>
<h5>Hi` {{$body['user']['name']}}</h5>
<h5>Success! Your account has been created.</h5>
<p>Thank you for creating an account on {{project()}}.</p>
<p>Access your account with your email: {{$body['user']['email']}} & phone: {{$body['user']['mobile']}}</p>
<p>Visit <a href="{{url('/')}}">{{url('/')}}</a> to find your experts, view your slots, access your downloads and much more.</p>
<p>Make sure you take advantage of our facilities!</p>
<br>

<p>if you any query please contact us on <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a></p>
Sincerely<br>
The {!! config('app.name') !!} Team,<br>
Need Help ?<br>
Please feel free to contact us at <a href="mailto:{{mailsupportemail()}}">{{mailsupportemail()}}</a>
</x-mail::message>
