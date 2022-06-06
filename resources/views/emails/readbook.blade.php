@component('mail::message')

Hello  {{$user->name}}, <br><br>
Your request to read book has been {{($permission==1)?'granted':'rejected'}}.
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
Asmita Publication
@endcomponent
