@extends('layout.admin')

@section('content')

<div class="row mt-2">
    <div class="col-12 mb-4">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Datos del Cliente</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Nombre:</dt>
                            <dd class="col-sm-8">{{ $client->name }}</dd>

                            <dt class="col-sm-4">Email:</dt>
                            <dd class="col-sm-8">{{ $client->email }}</dd>

                            <dt class="col-sm-4">Último contacto:</dt>
                            <dd class="col-sm-8">{{ $client->last_contact_date ? $client->last_contact_date->format('d M Y') : 'N/A' }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Empresa:</dt>
                            <dd class="col-sm-8">{{ $client->company }}</dd>

                            <dt class="col-sm-4">Teléfono:</dt>
                            <dd class="col-sm-8">{{ $client->phone }}</dd>

                            <dt class="col-sm-4"><a href="{{ route('clients.pdf', $client->id) }}" class="btn btn-secondary">Exportar PDF</a></dt>

                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card border-info h-100">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Contactos</h5>
                <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#createContactModal">+ Nuevo Contacto</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($client->contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->position }}</td>
                                <td>{{ $contact->phone }}</td>
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
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-success h-100">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Seguimientos</h5>
                <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#createFollowUpModal">+ Nuevo Seguimiento</button>
            </div>
            <div class="card-body">

                @foreach($client->followUps as $followUp)
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="bg-light border rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <span class="fw-bold">{{ substr($followUp->user->name, 0, 2) }}</span>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3 border-bottom pb-2">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">{{ $followUp->user->name }}</h6>
                            <small class="text-muted">{{ $followUp->follow_up_date }}</small>
                        </div>

                        <span class="badge bg-primary mt-1">{{ $followUp->typeFollowUp?->name ?? 'Sin tipo' }}</span>

                        <p class="mt-1 mb-0">{{ $followUp->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('clients.contacts.create')
@include('clients.contacts.edit')
@include('clients.contacts.delete')

@include('clients.followups.create')
@include('clients.followups.edit')

<script>
    document.getElementById('createFollowUpForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        // Limpiar errores previos
        form.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
            el.nextElementSibling.textContent = '';
        });

        fetch("{{ route('clients.followups.store', $client) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(async response => {
                if (!response.ok) {
                    const data = await response.json();
                    throw data;
                }
                return response.json();
            })
            .then(data => {
                // Éxito
                const modal = bootstrap.Modal.getInstance(document.getElementById('createFollowUpModal'));
                modal.hide();

                form.reset();
                alert(data.message); // o toast, sweetalert, etc
            })
            .catch(error => {
                if (error.errors) {
                    Object.keys(error.errors).forEach(field => {
                        const input = form.querySelector(`[name="${field}"]`);
                        input.classList.add('is-invalid');
                        input.nextElementSibling.textContent = error.errors[field][0];
                    });
                }
            });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        // createContactModal
        const createContactModal = document.getElementById('createContactModal')
        createContactModal.addEventListener('shown.bs.modal', function(event) {
            // focus name input
            document.getElementById('name').focus();
        })


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