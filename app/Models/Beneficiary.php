<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'cin',
        'nom',
        'prenom',
        'baccalaureat',
        'diplome_obtenu',
        'pdf_path' // Ajout du champ PDF
    ];
}
