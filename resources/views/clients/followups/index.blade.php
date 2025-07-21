@extends('layout.admin')

@section('content')

<h3 class="mt-3">Cliente: {{ $client->name }}</h3>

<p><strong>Email:</strong> {{ $client->email }}</p>
<p><strong>Teléfono:</strong> {{ $client->phone }}</p>
<p><strong>Empresa:</strong> {{ $client->company }}</p>

<hr>

<div class="text-center">
    <div class="btn-group">
        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-outline-primary ">Contactos</a>
        <a href="{{ route('clients.followups.index', $client) }}" class="btn btn-primary active">Seguimientos</a>
    </div>
</div>

<div class="p-3 m-4 bg-light">
    <h4>Seguimientos</h4>

    <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createFollowUpModal">Nuevo seguimiento</button>

    @if($client->followUps->isEmpty())
    <p>No hay registros disponibles.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Asunto</th>
                <th>Fecha</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($client->followUps as $follow)
            <tr>
                <td>{{ $follow->subject }}</td>
                <td>{{ $follow->follow_up_date }}</td>
                <td>
                    @if($follow->status == 'pendiente')
                    <span class="badge text-bg-warning">{{ ucfirst($follow->status) }}</span>
                    @elseif($follow->status == 'completado')
                    <span class="badge text-bg-success">{{ ucfirst($follow->status) }}</span>
                    @elseif($follow->status == 'cancelado')
                    <span class="badge text-bg-secondary">{{ ucfirst($follow->status) }}</span>
                    @endif
                </td>
                <td>
                    <a class="btn btn-warning btn-sm edit-follow-btn"
                        data-id="{{ $follow->id }}"
                        data-url="{{ route('clients.followups.show', [$client, $follow]) }}"
                        data-bs-toggle="modal" data-bs-target="#editFollowUpModal">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@include('clients.followups.create')
@include('clients.followups.edit')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editBtn = document.querySelectorAll('.edit-follow-btn')

        editBtn.forEach(btn => {
            btn.addEventListener('click', () => {
                const url = btn.dataset.url;

                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        const form = document.getElementById('editFormFollowUp')
                        form.action = url;
                        form.querySelector('[name=subject]').value = data.subject;
                        form.querySelector('[name=description]').value = data.description;
                        form.querySelector('[name=follow_up_date]').value = data.follow_up_date;
                        form.querySelector('[name=status]').value = data.status;
                    });
            });
        });
    });

    const modalEdit = document.getElementById('editFollowUpModal')
    modalEdit.addEventListener('hidden.bs.modal', event => {

        const form = document.getElementById('editFormFollowUp')
        form.querySelector('[name=subject]').value = '';
        form.querySelector('[name=description]').value = '';
        form.querySelector('[name=follow_up_date]').value = '';
        form.querySelector('[name=status]').value = 'pendiente';
    })
</script>

@endsection()