@extends('layout.admin')

@section('content')


<h3 class="my-3">Carga masiva de clientes</h3>

<form action="{{ route('clients.import') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="file">Importar clientes desde excel</label>
        <input type="file" name="file" id="file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Cargar</button>
</form>


@endsection