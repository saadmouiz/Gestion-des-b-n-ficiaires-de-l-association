@extends('layouts.app')

@section('title', 'Détails du bénéficiaire')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Détails du Bénéficiaire</h1>
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3>Informations du Bénéficiaire</h3>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <!-- Image Section -->
                <div class="col-md-4 text-center">
                    @if ($beneficiary->image_path)
                        <img src="{{ asset('storage/' . $beneficiary->image_path) }}" alt="Image" class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
                    @else
                        <img src="https://via.placeholder.com/150" alt="Placeholder" class="img-fluid rounded shadow">
                    @endif
                </div>

                <!-- Info Section -->
                <div class="col-md-8">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row" class="bg-light">CIN</th>
                                <td>{{ $beneficiary->cin }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-light">Nom</th>
                                <td>{{ $beneficiary->nom }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-light">Prénom</th>
                                <td>{{ $beneficiary->prenom }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-light">Baccalauréat</th>
                                <td>{{ $beneficiary->baccalaureat }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-light">Diplôme Obtenu</th>
                                <td>{{ $beneficiary->diplome_obtenu }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="bg-light">Document PDF</th>
                                <td>
                                    @if ($beneficiary->pdf_path)
                                        <a href="{{ asset('storage/' . $beneficiary->pdf_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">Voir le PDF</a>
                                    @else
                                        Aucun document disponible
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card-footer text-center">
            <a href="{{ route('beneficiaries.index') }}" class="btn btn-secondary btn-sm mx-2">Retour à la liste</a>
            <a href="{{ route('beneficiaries.edit', $beneficiary) }}" class="btn btn-warning btn-sm mx-2">Modifier</a>
            <form action="{{ route('beneficiaries.destroy', $beneficiary) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm mx-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bénéficiaire ?')">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection
