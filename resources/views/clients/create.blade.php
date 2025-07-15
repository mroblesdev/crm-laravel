@extends('layout.admin')

@section('content')

<h3 class="mt-3">Nuevo cliente</h3>

@if($errors->any())
<div class="alert alert-warning" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-12">
        <form class="row g-3" action="{{ route('clients.store') }}" method="post" autocomplete="off">
            @csrf
            <div class="col-md-6">
                <label class="form-label" for="name">Nombre</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label" for="email">Correo electrónico</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label" for="phone">Teléfono</label>
                <input class="form-control" type="text" name="phone" id="phone" value="{{ old('phone') }}">
            </div>

            <div class="col-md-6">
                <label class="form-label" for="company">Empresa</label>
                <input class="form-control" type="text" name="company" id="company" value="{{ old('company') }}">
            </div>

            <div class="col-md-12">
                <label class="form-label" for="notes">Notas</label>
                <textarea class="form-control" name="notes" id="notes">{{ old('notes') }}</textarea>
            </div>

            <div class="col-12">
                <a class="btn btn-secondary" href="{{ route('clients.index') }}">Regresar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>
    </div>
</div>

@endsection