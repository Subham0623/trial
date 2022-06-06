Hello {{$user->name}},<br><br>

Welcome to Asmita Publication. <br><br>

@foreach($user->roles as $role)
    @if($role->id != 2)
        Thanks for your patience. Your account is being examined in order to grant you with the requested permission. 
    @endif
@endforeach

<br><br>

Thank You,<br>
Asmita Publication