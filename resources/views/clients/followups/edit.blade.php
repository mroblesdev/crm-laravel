<div class="modal fade" id="editFollowUpModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" id="editFormFollowUp" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Editar seguimiento</h5>
                </div>

                <div class="modal-body">
                    @include('clients.followups.form')
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let modal = new bootstrap.Modal(document.getElementById('editFollowUpModal'));
        //modal.show();
    });
</script>
@endif