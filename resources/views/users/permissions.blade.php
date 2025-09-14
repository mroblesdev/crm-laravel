@extends('layout.admin')

@section('content')

<h3 class="mt-3">Asignar Permisos a {{ $user->name }}</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('users.permissions.update', $user) }}" method="POST" autocomplete="off">
    @csrf
    <div class="row">
        @foreach($permissions as $permission)
        <div class="col-md-4 mb-2">
            <div class="form-check">
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                    id="perm_{{ $permission->id }}"
                    class="form-check-input"
                    {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }}>
                <label class="form-check-label" for="perm_{{ $permission->id }}">
                    {{ $permission->name }} ({{ $permission->slug }})
                </label>
            </div>
        </div>
        @endforeach
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    <button type="submit" class="btn btn-success mt-3">Guardar Cambios</button>
</form>
@endsection