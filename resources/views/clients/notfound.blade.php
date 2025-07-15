@extends('layout.admin')

@section('content')
<h4 class="mt-3">Cliente no encontrado</h4>
<a href="{{ route('clients.index') }}" class="btn btn-primary">Volver al listado</a>
@endsection