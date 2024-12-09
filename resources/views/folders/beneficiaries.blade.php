@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Bénéficiaires du Dossier : {{ $folder->name }}</h1>

    <!-- Formulaire de recherche -->
    <form action="{{ route('folders.beneficiaries', $folder->id) }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher un bénéficiaire..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>

    <div class="mb-4">
        <!-- Lien pour ajouter un bénéficiaire -->
        <a href="{{ route('beneficiaries.create') }}" class="btn btn-primary">Ajouter un bénéficiaire</a>
    </div>

    @if ($beneficiaries->isEmpty())
        <p>Aucun bénéficiaire associé à ce dossier.</p>
    @else
        <div class="row">
            @foreach ($beneficiaries as $beneficiary)
                <div class="col-md-4 mb-4">
                    <div class="card" style="height: 350px;"> <!-- Fixer une hauteur pour la carte -->
                        <!-- Vérification de l'existence d'une image pour le bénéficiaire -->
                        @if ($beneficiary->image_path)
                            <img src="{{ asset('storage/' . $beneficiary->image_path) }}" class="card-img-top" alt="Image du bénéficiaire" style="width: 100%; height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-profile.png') }}" class="card-img-top" alt="Image par défaut" style="width: 100%; height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $beneficiary->nom }} {{ $beneficiary->prenom }}</h5>
                            <p class="card-text"><strong>CIN :</strong> {{ $beneficiary->cin }}</p>
                            <a href="{{ route('beneficiaries.show', $beneficiary->id) }}" class="btn btn-primary btn-sm">Voir</a>
                            <a href="{{ route('beneficiaries.edit', $beneficiary->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('beneficiaries.destroy', $beneficiary->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('folders.index') }}" class="btn btn-secondary mt-3">Retour</a>
</div>
@endsection
