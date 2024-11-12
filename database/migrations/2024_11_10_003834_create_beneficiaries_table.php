<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{
 // Migration pour la table beneficiaries
public function up()
{
    Schema::create('beneficiaries', function (Blueprint $table) {
        $table->id();
        $table->string('cin');
        $table->string('nom');
        $table->string('prenom');
        $table->string('baccalaureat');
        $table->string('diplome_obtenu');
        $table->string('pdf_path')->nullable();  // Colonne pour le PDF
        $table->string('image_path')->nullable();  // Colonne pour l'image
        $table->timestamps();
    });
    
}


    public function down()
    {
        Schema::dropIfExists('beneficiaries');
    }
}
