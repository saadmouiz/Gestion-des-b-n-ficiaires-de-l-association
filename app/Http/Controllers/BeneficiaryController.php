<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeneficiaryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $beneficiaries = Beneficiary::when($search, function ($query, $search) {
            $query->where('nom', 'like', "%$search%")
                  ->orWhere('prenom', 'like', "%$search%")
                  ->orWhere('cin', 'like', "%$search%");
        })->get();
    
        return view('beneficiaries.index', compact('beneficiaries'));
    }
    

    public function create()
    {
        return view('beneficiaries.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'cin' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'baccalaureat' => 'required|string|max:255',
            'diplome_obtenu' => 'required|string|max:255',
            'pdf' => 'nullable|mimes:pdf|max:2048', // Validation du fichier PDF
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
        ]);

        $pdfPath = null;
        $imagePath = null;

        // Sauvegarde du fichier PDF, s'il existe
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdfs', 'public');
        }

        // Sauvegarde de l'image, s'il existe
        if ($request->hasFile('image')) {
            // Validation du fichier image
            $image = $request->file('image');
            if ($image->isValid()) {
                $imagePath = $image->store('images', 'public'); // Sauvegarde dans 'storage/app/public/images'
            } else {
                return redirect()->back()->withErrors('Le fichier image n\'est pas valide.');
            }
        }

        // Création du bénéficiaire avec l'image et PDF si présents
        Beneficiary::create([
            'cin' => $request->cin,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'baccalaureat' => $request->baccalaureat,
            'diplome_obtenu' => $request->diplome_obtenu,
            'pdf_path' => $pdfPath,
            'image_path' => $imagePath, // Enregistrement du chemin de l'image
        ]);

        return redirect()->route('beneficiaries.index')->with('success', 'Bénéficiaire ajouté avec succès !');
    }

    public function show($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        return view('beneficiaries.show', compact('beneficiary'));
    }

    public function edit($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        return view('beneficiaries.edit', compact('beneficiary'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cin' => 'required|max:255',
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'baccalaureat' => 'required|max:255',
            'diplome_obtenu' => 'required|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048', // Validation pour l'image
        ]);

        $beneficiary = Beneficiary::findOrFail($id);

        // Mise à jour des données
        $beneficiary->cin = $request->cin;
        $beneficiary->nom = $request->nom;
        $beneficiary->prenom = $request->prenom;
        $beneficiary->baccalaureat = $request->baccalaureat;
        $beneficiary->diplome_obtenu = $request->diplome_obtenu;

        // Gestion du fichier image
        if ($request->hasFile('image')) {
            // Supprimer l'ancien fichier si existe
            if ($beneficiary->image_path) {
                Storage::disk('public')->delete($beneficiary->image_path);
            }

            // Sauvegarder le nouveau fichier
            $image = $request->file('image');
            if ($image->isValid()) {
                $imagePath = $image->store('images', 'public');
                $beneficiary->image_path = $imagePath;  // Mettre à jour l'image
            } else {
                return redirect()->back()->withErrors('Le fichier image n\'est pas valide.');
            }
        }

        $beneficiary->save();

        return redirect()->route('beneficiaries.index')->with('success', 'Bénéficiaire modifié avec succès.');
    }

    public function destroy(Beneficiary $beneficiary)
    {
        // Suppression des fichiers associés
        if ($beneficiary->pdf_path) {
            Storage::disk('public')->delete($beneficiary->pdf_path);
        }
        if ($beneficiary->image_path) {
            Storage::disk('public')->delete($beneficiary->image_path);
        }

        $beneficiary->delete();

        return redirect()->route('beneficiaries.index')->with('success', 'Bénéficiaire supprimé avec succès!');
    }
}
?>
