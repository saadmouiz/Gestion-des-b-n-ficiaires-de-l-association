<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeneficiaryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $folders = Folder::with('beneficiaries')
            ->when($search, function ($query, $search) {
                $query->whereHas('beneficiaries', function ($query) use ($search) {
                    $query->where('nom', 'LIKE', "%$search%")
                          ->orWhere('prenom', 'LIKE', "%$search%")
                          ->orWhere('cin', 'LIKE', "%$search%");
                });
            })
            ->get();

        return view('beneficiaries.index', compact('folders', 'search'));
    }

    public function create()
    {
        $folders = Folder::all();
        return view('beneficiaries.create', compact('folders'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'cin' => 'required|string|max:255|unique:beneficiaries,cin',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'baccalaureat' => 'required|string|max:255',
            'diplome_obtenu' => 'required|string|max:255',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'folder_id' => 'nullable|exists:folders,id',
            'new_folder' => 'nullable|string|max:255',
        ]);

        // Création d'un nouveau dossier si le champ "new_folder" est renseigné
        if ($request->filled('new_folder')) {
            $folder = Folder::create(['name' => $request->input('new_folder')]);
            $validated['folder_id'] = $folder->id;
        }

        // Upload des fichiers PDF et image
        if ($request->hasFile('pdf')) {
            $validated['pdf_path'] = $request->file('pdf')->store('pdfs', 'public');
        }

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('images', 'public');
        }

        // Création du bénéficiaire
        Beneficiary::create($validated);

        return redirect()->route('folders.index')->with('success', 'Bénéficiaire ajouté avec succès.');
    }

    public function show(Beneficiary $beneficiary)
    {
        return view('beneficiaries.show', compact('beneficiary'));
    }

    public function edit(Beneficiary $beneficiary)
    {
        $folders = Folder::all();
        return view('beneficiaries.edit', compact('beneficiary', 'folders'));
    }

    public function update(Request $request, Beneficiary $beneficiary)
    {
        $validated = $request->validate([
            'cin' => 'required|unique:beneficiaries,cin,' . $beneficiary->id,
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'baccalaureat' => 'required|string|max:255',
            'diplome_obtenu' => 'required|string|max:255',
            'folder_id' => 'nullable|exists:folders,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:5120',
        ]); 
  
        // Mise à jour de l'image si une nouvelle est uploadée
        if ($request->hasFile('image')) {
            if ($beneficiary->image_path && Storage::exists('public/' . $beneficiary->image_path)) {
                Storage::delete('public/' . $beneficiary->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('images', 'public');
        }

        // Mise à jour du fichier PDF si un nouveau est uploadé
        if ($request->hasFile('pdf')) {
            if ($beneficiary->pdf_path && Storage::exists('public/' . $beneficiary->pdf_path)) {
                Storage::delete('public/' . $beneficiary->pdf_path);
            }
            $validated['pdf_path'] = $request->file('pdf')->store('pdfs', 'public');
        }

        // Mise à jour des autres champs
        $validated['folder_id'] = $validated['folder_id'] ?? $beneficiary->folder_id;

        $beneficiary->update($validated);

        return redirect()->route('beneficiaries.show', $beneficiary)->with('success', 'Bénéficiaire mis à jour avec succès.');
    }

    public function destroy(Beneficiary $beneficiary)
    {
        // Suppression des fichiers associés
        if ($beneficiary->image_path && Storage::exists('public/' . $beneficiary->image_path)) {
            Storage::delete('public/' . $beneficiary->image_path);
        }

        if ($beneficiary->pdf_path && Storage::exists('public/' . $beneficiary->pdf_path)) {
            Storage::delete('public/' . $beneficiary->pdf_path);
        }

        // Suppression du bénéficiaire
        $beneficiary->delete();

        return redirect()->route('folders.index')->with('success', 'Bénéficiaire supprimé avec succès.');
    }
}
