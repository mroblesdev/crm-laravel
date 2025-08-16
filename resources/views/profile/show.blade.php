@extends('layout.admin')

@section('content')

<h3 class="my-3">Perfil de {{ $user->name}}</h3>

@if(session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<p><strong>Nombre: </strong>{{ $user->name }}</p>
<p><strong>Correo electrónico: </strong>{{ $user->email }}</p>

<a class="btn btn-primary" href="{{ route('profile.edit') }}">Editar perfil</a>
<a class="btn btn-secondary" href="{{ route('profile.password') }}">Cambiar contraseña</a>

@endsection