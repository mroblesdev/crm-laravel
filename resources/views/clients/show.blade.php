@extends('layout.admin')

@section('content')

<h3 class="mt-3">Cliente: {{ $client->name }}</h3>

<p><strong>Email:</strong> {{ $client->email }}</p>
<p><strong>Teléfono:</strong> {{ $client->phone }}</p>
<p><strong>Empresa:</strong> {{ $client->company }}</p>

<a href="{{ route('clients.pdf', $client->id) }}" class="btn btn-secondary">Exportar PDF</a>

<hr>

<div class="text-center">
    <div class="btn-group">
        <a href="" class="btn btn-primary active">Contactos</a>
        <a href="{{ route('clients.followups.index', $client) }}" class="btn btn-outline-primary">Seguimientos</a>
    </div>
</div>

<div class="p-3 m-4 bg-light">
    <h4>Contactos</h4>

    <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#createContactModal">Nuevo contacto</button>

    @if($client->contacts->isEmpty())
    <p>No hay contactos disponibles.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Cargo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($client->contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->position }}</td>
                <td>
                    <a class="btn btn-warning btn-sm edit-contact-btn"
                        data-id="{{ $contact->id }}"
                        data-url="{{ route('clients.contacts.edit', [$client, $contact]) }}"
                        data-bs-toggle="modal" data-bs-target="#editContactModal">Editar</a>

                    <a class="btn btn-danger btn-sm delete-contact-btn"
                        data-id="{{ $contact->id }}"
                        data-url="{{ route('clients.contacts.destroy', [$client, $contact]) }}"
                        data-bs-toggle="modal" data-bs-target="#deleteContactModal">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@include('clients.contacts.create')
@include('clients.contacts.edit')
@include('clients.contacts.delete')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editBtn = document.querySelectorAll('.edit-contact-btn')

        editBtn.forEach(btn => {
            btn.addEventListener('click', () => {
                const url = btn.dataset.url;

                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        const form = document.getElementById('editFormContact')
                        form.action = url.replace('/edit', '');
                        form.querySelector('[name=name]').value = data.name;
                        form.querySelector('[name=email]').value = data.email;
                        form.querySelector('[name=phone]').value = data.phone;
                        form.querySelector('[name=position]').value = data.position;
                        form.querySelector('[name=notes]').value = data.notes;
                    });
            });
        });

        const deleteForm = document.getElementById('deleteContactForm');

        const deleteModal = document.getElementById('deleteContactModal')
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const contactId = button.getAttribute('data-id');
            const deleteUrl = button.getAttribute('data-url');

            deleteForm.action = deleteUrl;
        })

    });
</script>

@endsection()