<div class="modal fade" id="editContactModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" id="editFormContact" autocomplete="off">
            @csrf @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Editar contacto</h5>
                </div>

                <div class="modal-body">
                    @include('clients.contacts.form')
                </div>

                <div class="modal-footer">
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>