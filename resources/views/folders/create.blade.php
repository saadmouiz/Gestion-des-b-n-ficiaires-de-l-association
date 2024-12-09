@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un dossier</h1>

    <form action="{{ route('folders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Nom du dossier</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Image du dossier</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Créer le dossier</button>
    </form>
</div>
@endsection
