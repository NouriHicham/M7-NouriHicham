<div class="mb-3">
    <label for="title" class="form-label">Títol</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $pelicula->title ?? '') }}">
    @error('title')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="year" class="form-label">Any</label>
    <input type="number" name="year" class="form-control" value="{{ old('year', $pelicula->year ?? '') }}">
    @error('year')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="duration" class="form-label">Duració (minuts)</label>
    <input type="number" name="duration" class="form-control" value="{{ old('duration', $pelicula->duration ?? '') }}">
    @error('duration')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Descripció</label>
    <textarea name="description" class="form-control">{{ old('description', $pelicula->description ?? '') }}</textarea>
</div>
