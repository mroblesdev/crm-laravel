<div class="modal fade" id="deleteContactModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" id="deleteContactForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Eliminar contacto</h5>
                </div>

                <div class="modal-body">
                    <p>¿Estas seguro de eliminar este registro?</p>
                </div>

                <div class="modal-footer">
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                    <button class="btn btn-danger" type="submit">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>