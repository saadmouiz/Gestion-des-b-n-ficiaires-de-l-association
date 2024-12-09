@extends('layouts.app')

@section('title', 'Ajouter un Bénéficiaire')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Ajouter un Nouveau Bénéficiaire</h1>

    <!-- Affichage des messages d'erreur -->
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Une erreur s'est produite :</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{ route('beneficiaries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="cin" class="form-label">CIN</label>
            <input type="text" class="form-control @error('cin') is-invalid @enderror" id="cin" name="cin" value="{{ old('cin') }}" required>
            @error('cin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
            @error('prenom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="baccalaureat" class="form-label">Baccalauréat</label>
            <input type="text" class="form-control @error('baccalaureat') is-invalid @enderror" id="baccalaureat" name="baccalaureat" value="{{ old('baccalaureat') }}" required>
            @error('baccalaureat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="diplome_obtenu" class="form-label">Diplôme Obtenu</label>
            <input type="text" class="form-control @error('diplome_obtenu') is-invalid @enderror" id="diplome_obtenu" name="diplome_obtenu" value="{{ old('diplome_obtenu') }}" required>
            @error('diplome_obtenu')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="situation" class="form-label">Situation </label>
            <select name="situation" id="" class="form-control">
                <option value="">Mariée</option>
                <option value=""></option>
            </select>

        </div>

        <div class="mb-3">
            <label for="pdf" class="form-label">Document PDF (optionnel)</label>
            <input type="file" class="form-control @error('pdf') is-invalid @enderror" id="pdf" name="pdf" accept=".pdf">
            @error('pdf')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optionnelle)</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept=".jpeg,.png,.jpg,.gif">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="folder_id" class="form-label">Dossier</label>
            <select name="folder_id" id="folder_id" class="form-control" onchange="toggleOtherInput(this)" required>
                <option value="" disabled selected>Choisir un dossier</option>
                @foreach ($folders as $folder)
                    <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                @endforeach
                
            </select>
        </div>

     

        <button type="submit" class="btn btn-success w-100">Ajouter</button>
    </form>
</div>

<script>
    function toggleOtherInput(select) {
        const otherInput = document.getElementById('other_folder');
        otherInput.style.display = select.value === 'other' ? 'block' : 'none';
    }
</script>
@endsection
