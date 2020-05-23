@foreach ($users as $user)
    <a href="/user/{{ $user->id }}">{{ $user->username }}</a>
@endforeach
