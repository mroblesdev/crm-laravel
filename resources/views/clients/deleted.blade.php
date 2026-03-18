@extends('layout.admin')

@push('style')
<link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<h3 class="mt-3">Clientes eliminados</h3>

<div class="row mb-3">
    <div class="col-xl-3 col-md-6">
        <a class="btn btn-warning" href="{{ route('clients.index') }}">Clientes</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table id="myTable" class="table table-hover table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="{{ route('clients.activate', $client->id) }}">
                            Reingresar
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="confirmModalLabel">Confirmar Eliminación</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este cliente?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="confirmForm" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Reingresar</button>
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
    var confirmModal = document.getElementById('confirmModal');
    confirmModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var action = button.getAttribute('data-action');
        var form = document.getElementById('confirmForm');
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
