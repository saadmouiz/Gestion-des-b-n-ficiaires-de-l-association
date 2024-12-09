@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Liste des Dossiers</h1>
        <a href="{{ route('folders.create') }}" class="btn btn-success">Créer un Dossier</a>
    </div>

    <!-- Barre de recherche -->
    <form action="{{ route('folders.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher un dossier..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>

    @if($folders->isEmpty())
        <div class="alert alert-info text-center">
            Aucun dossier disponible pour le moment.
        </div>
    @else
        <div class="row">
            @foreach($folders as $folder)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <!-- Image du dossier -->
                        <img src="{{ $folder->image_path ? asset('storage/' . $folder->image_path) : asset('images/default-folder.png') }}" 
                             class="card-img-top" 
                             alt="{{ $folder->name }}" 
                             style="height: 100px; object-fit: cover;">

                        <!-- Contenu du dossier -->
                        <div class="card-body text-center">
                            <h5 class="card-title mb-2">{{ $folder->name }}</h5>
                            <p class="card-text text-muted">Total des bénéficiaires : <strong>{{ $folder->beneficiaries->count() }}</strong></p>

                            <div class="d-grid gap-2">
                                <a href="{{ route('folders.beneficiaries', $folder->id) }}" class="btn btn-primary btn-sm">Gérer les Bénéficiaires</a>
                                <a href="{{ route('folders.edit', $folder->id) }}" class="btn btn-warning btn-sm text-white">Modifier</a>
                                <form action="{{ route('folders.destroy', $folder->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce dossier ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div> 
@endsection
