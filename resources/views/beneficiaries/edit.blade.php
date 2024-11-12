@extends('layouts.app')

@section('title', 'Modifier un Bénéficiaire')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Modifier un Bénéficiaire</h1>
    
    <form action="{{ route('beneficiaries.update', $beneficiary->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" id="image" name="image" accept=".jpeg,.png,.jpg,.gif">
</div>

@if ($beneficiary->image_path)
    <div class="mb-3">
        <img src="{{ asset('storage/' . $beneficiary->image_path) }}" alt="Image" width="200px">
    </div>
@endif



        
        <div class="mb-3">
            <label for="cin" class="form-label">CIN</label>
            <input type="text" class="form-control" id="cin" name="cin" value="{{ old('cin', $beneficiary->cin) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $beneficiary->nom) }}" required>
        </div>
        

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $beneficiary->prenom) }}" required>
        </div>
        

        <div class="mb-3">
            <label for="baccalaureat" class="form-label">Baccalauréat</label>
            <input type="text" class="form-control" id="baccalaureat" name="baccalaureat" value="{{ old('baccalaureat', $beneficiary->baccalaureat) }}" required>
        </div>
        

        <div class="mb-3">
            <label for="diplome_obtenu" class="form-label">Diplôme Obtenu</label>
            <input type="text" class="form-control" id="diplome_obtenu" name="diplome_obtenu" value="{{ old('diplome_obtenu', $beneficiary->diplome_obtenu) }}" required>
        </div>
        
        
        <div class="mb-3">
            <label for="pdf" class="form-label">Document PDF (optionnel)</label>
            <input type="file" class="form-control" id="pdf" name="pdf" accept=".pdf">
        </div>

        @if($beneficiary->pdf_path)
            <div class="mb-3">
                <label for="pdf_preview" class="form-label">Fichier PDF Actuel</label>
                <a href="{{ asset('storage/' . $beneficiary->pdf_path) }}" target="_blank" class="form-control">{{ $beneficiary->pdf_path }}</a>
            </div>
        @endif
        
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection

