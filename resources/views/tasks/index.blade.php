@extends('layout.admin')
@include('sweetalert2::index')
@section('content')

<h3 class="mt-3">Tareas</h3>

<a class="btn btn-primary" href="{{ route('tasks.create') }}">Nueva tarea</a>

@if($tasks->isEmpty())
<p>No hay registro</p>
@else
<table class="table">
    <thead>
        <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Estatus</th>
            <th>Fecha vencimiento</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->status }}</td>
            <td>{{ $task->due_date }}</td>
            <td>
                <a class="btn btn-warning btn-sm" href="{{ route('tasks.edit', $task) }}">Editar</a>
            </td>
            <td>
                <form id="delete-task-{{ $task->id }}" action="{{ route('tasks.destroy', $task) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $task->id }})">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<script>
    function confirmDelete(taskId) {
        Swal.fire({
            title: 'Eliminar tarea',
            text: '¿Estás seguro de que deseas eliminar esta tarea?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-task-' + taskId).submit();
            }
        });
    }
</script>

@endsection