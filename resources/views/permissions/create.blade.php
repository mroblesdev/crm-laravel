@extends('layout.admin')

@section('content')

<h3 class="mt-3">Crear Permiso</h3>

<form action="{{ route('permissions.store') }}" method="POST" autocomplete="off">
    @csrf
    @include('permissions.form', ['buttonText' => 'Crear'])
</form>
@endsection