@extends('layout.admin')

@section('content')

<h3 class="mt-3">Nueva tarea</h3>

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
        <form class="row g-3 mb-4" action="{{ route('tasks.store') }}" method="post" autocomplete="off">
            @csrf
            <div class="col-md-12">
                <label class="form-label" for="title">Título</label>
                <input class="form-control" type="text" name="title" id="title" value="{{ old('title') }}" required>
            </div>

            <div class="col-md-12">
                <label class="form-label" for="description">Descripción</label>
                <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label for="status" class="form-label">Estado</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="pendiente">Pendiente</option>
                    <option value="completado">Completado</option>
                    <option value="en_proceso">En proceso</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label for="due_date" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="due_date" name="due_date" required>
            </div>

            <div class="col-md-12 mb-3">
                <label for="client_id" class="form-label">Cliente</label>
                <select class="form-select" id="client_id" name="client_id">
                    <option value="">No asignado</option>
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Regresar</a>
                <button class="btn btn-primary" type="submit">Guardar</button>
            </div>
        </form>

    </div>
</div>

@endsection