@extends('layout.admin')

@push('style')
<style>
    #calendar {
        width: 800px;
        height: 500px;
    }
</style>
@endpush

@section('content')

<div class="row my-3">
    <div class="col-8">
        <div id="calendar"></div>
    </div>
</div>

<!-- Modal: Tarea -->
<div class="modal fade" id="taskModal" tabindex="-1">
    <div class="modal-dialog">
        <form  autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="task_title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="task_title" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="task_description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="task_description" readonly></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="task_status" class="form-label">Estado</label>
                        <select class="form-select" id="task_status">
                            <option value="pendiente">Pendiente</option>
                            <option value="completado">Completado</option>
                            <option value="en_proceso">En proceso</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="task_due_date" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="task_due_date" readonly>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="task_client_id" class="form-label">Cliente</label>
                        <input type="text" class="form-control" id="task_client_id" readonly>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('script')
<script src="{{ asset('js/index.global.min.js') }}"></script>
<script src="{{ asset('js/es.global.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next,today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: {
                url: "{{ route('tasks.events') }}",
                method: 'GET',
                failure: function() {
                    alert("No se cargaron las tareas");
                }
            },
            eventClick: function(info) {
                const taskId = info.event.extendedProps.id || info.event.id;
                const url = `tasks/${taskId}`;
                fetch(url, {
                    headers: {
                        'Accept': 'application/json'
                    }
                }).then(res => {
                    if (!res.ok) throw new Error("No se puedo obtener la tarea")
                    return res.json();
                }).then(data => {
                    document.getElementById('task_title').value = data.title || '';
                    document.getElementById('task_description').value = data.description || '';
                    document.getElementById('task_status').value = data.status || '';
                    document.getElementById('task_due_date').value = data.due_date || '';
                    document.getElementById('task_client_id').value = data.client ? data.client.name : '';

                    const modal = new bootstrap.Modal(document.getElementById('taskModal'));
                    modal.show();
                }).catch(err => {
                    console.log(err)
                    alert("Error al obtener los detalles de la tarea")
                })
            }

        });
        calendar.render();
    });
</script>
@endpush