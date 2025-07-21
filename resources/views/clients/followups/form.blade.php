<div class="mb-3">
    <label for="subject" class="form-label">Asunto</label>
    <input type="text" class="form-control" id="subject" name="subject" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Descripción</label>
    <textarea class="form-control" id="description" name="description"></textarea>
</div>

<div class="mb-3">
    <label for="follow_up_date" class="form-label">Fecha</label>
    <input type="date" class="form-control" id="follow_up_date" name="follow_up_date">
</div>

<div class="mb-3">
    <label for="status" class="form-label">Estado</label>
    <select class="form-select" id="status" name="status">
        <option value="pendiente">Pendiente</option>
        <option value="completado">Completado</option>
        <option value="cancelado">Cancelado</option>
    </select>
</div>