@extends('layout.admin')

@section('content')

<h3 class="mt-3">Editar Permiso</h3>

<form action="{{ route('permissions.update', $permission) }}" method="POST" autocomplete="off">
    @csrf
    @method('PUT')
    @include('permissions.form', ['buttonText' => 'Actualizar'])
</form>
@endsection