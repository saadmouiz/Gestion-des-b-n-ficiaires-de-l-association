@extends('layouts.app')

@section('title', 'Ajouter un Bénéficiaire')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Ajouter un Nouveau Bénéficiaire</h1>
    
    <!-- Affichage des messages d'erreur -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('beneficiaries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        

        <div class="mb-3">
            <label for="cin" class="form-label">CIN</label>
            <input type="text" class="form-control" id="cin" name="cin" value="{{ old('cin') }}" required>
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
        </div>

        <div class="mb-3">
            <label for="baccalaureat" class="form-label">Baccalauréat</label>
            <input type="text" class="form-control" id="baccalaureat" name="baccalaureat" value="{{ old('baccalaureat') }}" required>
        </div>

        <div class="mb-3">
            <label for="diplome_obtenu" class="form-label">Diplôme Obtenu</label>
            <input type="text" class="form-control" id="diplome_obtenu" name="diplome_obtenu" value="{{ old('diplome_obtenu') }}" required>
        </div>

        <div class="mb-3">
            <label for="pdf" class="form-label">Document PDF (optionnel)</label>
            <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optionnelle)</label>
            <input type="file" class="form-control" id="image" name="image" accept=".jpeg,.png,.jpg,.gif">
            </div>
        
        <button type="submit" class="btn btn-success w-100">Ajouter</button>
    </form>
</div>
@endsection
