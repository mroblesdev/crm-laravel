@extends('layout.admin')

@push('style')
<link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<h3 class="mt-3">Clientes</h3>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row mb-3">
    <div class="col-xl-6 col-md-6">
        <a href="{{ route('clients.create') }}" class="btn btn-primary">Nuevo</a>
        <a class="btn btn-warning" href="{{ route('clients.deleted') }}">Historial</a>
        <a class="btn btn-success" href="{{ route('clients.export') }}">Exporta Excel</a>
        <a class="btn btn-secondary" href="{{ route('clients.form-import') }}">Importar Clientes</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table id="myTable" class="table table-hover table-striped table-bordered table-sm">
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

                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-action="{{ route('clients.destroy', $client->id) }}">
                            Eliminar
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
        {!! $clients->links() !!}
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este cliente?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" action="" method="post">
                     @csrf
                     @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/dataTables.min.js') }}"></script>

<script>
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var action = button.getAttribute('data-action');
        var form = document.getElementById('deleteForm');
        form.action = action;
    });

    $(document).ready(function() {
        $('#myTable').DataTable({
            "language": {
                url: "{{ asset('js/dataTables.spanish.json') }}"
            }
        });
    });
</script>
@endpush
