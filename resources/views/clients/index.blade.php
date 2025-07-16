@extends('layout.admin')

@section('content')

<h3 class="mt-3">Clientes</h3>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row mb-3">
    <div class="col-xl-3 col-md-6">
        <a href="{{ route('clients.create') }}" class="btn btn-primary">Nuevo</a>
        <a class="btn btn-warning" href="{{ route('clients.deleted') }}">Historial</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->user->name }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('clients.show', $client->id) }}">Detalles</a>
                        <a class="btn btn-warning btn-sm" href="{{ route('clients.edit', $client->id) }}">Editar</a>

                        <form action="{{ route('clients.destroy', $client->id) }}" method="post" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        {!! $clients->links() !!}
    </div>

</div>

@endsection