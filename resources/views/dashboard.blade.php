@extends('layout.admin')

@section('content')

<h2 class="my-4">Dashboard</h2>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <h5>Total de clientes</h5>
                {{ $clients->count() }}
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('clients.index') }}">Ver detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <h5>Tareas pendientes</h5>
                {{ $tasksPendings->count() }}
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('tasks.index') }}">Ver detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white mb-4">
            <div class="card-body">
                <h5>Seguimientos (hoy)</h5>
                {{ $follows->count() }}
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ route('clients.index') }}">Ver detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <h5>Tareas</h5>
                <canvas id="myBarChart" width="100%" height="35px"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js" type="text/javascript"></script>

<script>
    // Ejemplo de gráfico de barras
    const ctx = document.getElementById('myBarChart').getContext('2d');
    const myBarChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pendientes', 'Completadas', 'En proceso'],
            datasets: [{
                label: 'Tareas',
                data: ['{{ $tasksPendings->count() }}', '{{ $tasksCompleted->count() }}', '{{ $tasksInProgress->count() }}'],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 5
            }]
        }
    });
</script>

@endpush