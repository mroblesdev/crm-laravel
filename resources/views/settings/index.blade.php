@extends('layout.admin')

@section('content')

<h3 class="my-3">Configuración del Sistema</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('settings.store') }}" enctype="multipart/form-data" autocomplete="off">
    @csrf
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button">General</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" type="button">Correo</button>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="general" role="tabpanel">
            <div class="row g-3">
                <div class="col-12 col-sm-6 mb-3">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $settings['name'] ?? '' }}">
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <label for="phone">Teléfono</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $settings['phone'] ?? '' }}">
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <label for="logo">Logotipo</label>
                    <input type="file" class="form-control" id="logo" name="logo">
                    @if(!empty($settings['logo']))
                    <img src="{{ asset('storage/'.$settings['logo']) }}" alt="Logotipo" class="img-thumbnail mt-2" style="max-height: 150px;">
                    @endif
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="email" role="tabpanel">
            <div class="row g-3">
                <div class="col-12 col-sm-6 mb-3">
                    <label for="mail_host">Host</label>
                    <input type="text" class="form-control" id="mail_host" name="mail_host" value="{{ $settings['mail_host'] ?? '' }}">
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <label for="mail_port">Puerto</label>
                    <input type="text" class="form-control" id="mail_port" name="mail_port" value="{{ $settings['mail_port'] ?? '' }}">
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <label for="mail_username">Usuario</label>
                    <input type="text" class="form-control" id="mail_username" name="mail_username" value="{{ $settings['mail_username'] ?? '' }}">
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <label for="mail_password">Contraseña</label>
                    <input type="password" class="form-control" id="mail_password" name="mail_password" value="">
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <label for="mail_encryption">Protocolo de Encriptación</label>
                    <select class="form-select" id="mail_encryption" name="mail_encryption">
                        <option value="tls" {{ (isset($settings['mail_encryption']) && $settings['mail_encryption'] === 'tls') ? 'selected' : ''}}>TLS</option>
                        <option value="ssl" {{ (isset($settings['mail_encryption']) && $settings['mail_encryption'] === 'ssl') ? 'selected' : ''}}>SSL</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Guardar configuración</button>
</form>

@endsection