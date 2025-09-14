@extends('layout.admin')

@section('content')
<h3 class="my-3">Editar Perfil</h3>

<form method="POST" action="{{ route('profile.update') }}" autocomplete="off">
    @csrf
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('name',$user->email) }}" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Guardar cambios</button>
</form>

@endsection