@extends('layout.admin')

@section('content')

<h3 class="mt-3">Modificar contraseña</h3>

<form action="{{ route('users.password.update', $user) }}" method="POST" autocomplete="off">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="password" class="form-label">Nueva Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
</form>

@endsection