<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $permission->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $permission->slug ?? '') }}" required>
</div>


<a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancelar</a>
<button type="submit" class="btn btn-success">{{ $buttonText }}</button>