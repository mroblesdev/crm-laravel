@extends('layout.admin')

@section('content')

<h3 class="mt-3">Permisos</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">Crear Permiso</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Slug</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($permissions as $permission)
        <tr>
            <td>{{ $permission->id }}</td>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->slug }}</td>
            <td>
                <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-sm btn-warning">Editar</a>
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $permission->id }}">Eliminar</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No hay permisos.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $permissions->links() }}

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este permiso?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var permissionId = button.getAttribute('data-id');
            var form = document.getElementById('deleteForm');
            form.action = "{{ url('/permissions') }}/" + permissionId;
        });
    });
</script>
@endsection