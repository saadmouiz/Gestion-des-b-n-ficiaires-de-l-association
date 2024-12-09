@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Dossiers</h1>

    @if ($folders->isEmpty())
        <p>Aucun dossier disponible.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom du Dossier</th>
                    <th>Nombre de Bénéficiaires</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($folders as $folder)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $folder->name }}</td>
                        <td>{{ $folder->beneficiaries->count() }}</td>
                        <td>
                            <!-- Bouton pour afficher les bénéficiaires du dossier -->
                            <a href="{{ route('folders.beneficiaries', $folder->id) }}" class="btn btn-info btn-sm">Afficher les bénéficiaires</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
