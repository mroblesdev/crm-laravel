<div class="modal fade" id="createContactModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('clients.contacts.store', $client) }}" method="post" autocomplete="off">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Agregar contacto</h5>
                </div>

                <div class="modal-body">
                    @include('clients.contacts.form')
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>