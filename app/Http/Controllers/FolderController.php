<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        // Récupérer les dossiers en fonction de la recherche
        $folders = Folder::with('beneficiaries')
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->get();
    
        return view('folders.index', compact('folders', 'search'));
    }

    public function beneficiaries(Request $request, Folder $folder)
    {
        $search = $request->input('search');

        // Récupérer les bénéficiaires du dossier et appliquer la recherche
        $beneficiaries = $folder->beneficiaries()
            ->when($search, function ($query, $search) {
                $query->where('nom', 'LIKE', "%$search%")
                      ->orWhere('prenom', 'LIKE', "%$search%")
                      ->orWhere('cin', 'LIKE', "%$search%");
            })
            ->get();

        return view('folders.beneficiaries', compact('folder', 'beneficiaries', 'search'));
    }

    public function create()
    {
        return view('folders.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Création du dossier
        $folder = new Folder();
        $folder->name = $request->name;
    
        // Gestion de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('folder_images', 'public');
            $folder->image_path = $imagePath;
        }
    
        // Sauvegarde du dossier
        $folder->save();
    
        return redirect()->route('folders.index')->with('success', 'Dossier créé avec succès.');
    }

    public function showBeneficiaries($id)
    {
        $folder = Folder::findOrFail($id);
        $beneficiaries = $folder->beneficiaries;
        return view('folders.beneficiaries', compact('folder', 'beneficiaries'));
    }

    public function edit(Folder $folder)
    {
        return view('folders.edit', compact('folder'));
    }

    public function update(Request $request, Folder $folder)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $folder->name = $request->name;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('folder_images', 'public');
        $folder->image_path = $imagePath;
    }

    $folder->save();

    return redirect()->route('folders.index')->with('success', 'Dossier mis à jour avec succès.');
}


    public function destroy(Folder $folder)
    {
        // Supprimer l'image si elle existe
        if ($folder->image_path && Storage::exists('public/' . $folder->image_path)) {
            Storage::delete('public/' . $folder->image_path);
        }
    
        // Supprimer le dossier
        $folder->delete();
    
        return redirect()->route('folders.index')->with('success', 'Dossier supprimé avec succès.');
    }
}
