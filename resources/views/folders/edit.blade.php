@extends('layouts.app')

@section('title', 'Modifier le dossier')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Modifier le Dossier</h1>

    <form action="{{ route('folders.update', $folder->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nom du dossier</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $folder->name }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Changer l'image (optionnel)</label>
            <input type="file" class="form-control" id="image" name="image" accept=".jpeg,.png,.jpg,.gif">
        </div>

        <button type="submit" class="btn btn-success w-100">Mettre à jour</button>
    </form>
</div>
@endsection
