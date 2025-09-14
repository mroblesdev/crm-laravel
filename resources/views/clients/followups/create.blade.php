<div class="modal fade" id="createFollowUpModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('clients.followups.store', $client) }}" method="post" autocomplete="off">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Agregar seguimiento</h5>
                </div>

                <div class="modal-body">
                    @include('clients.followups.form')
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>