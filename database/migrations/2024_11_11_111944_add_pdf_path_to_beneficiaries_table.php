<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('beneficiaries', function (Blueprint $table) {
        // Ajout des colonnes seulement si elles n'existent pas déjà
        if (!Schema::hasColumn('beneficiaries', 'pdf_path')) {
            $table->string('pdf_path')->nullable();
        }

        if (!Schema::hasColumn('beneficiaries', 'image_path')) {
            $table->string('image_path')->nullable();
        }
    });
}

public function down()
{
    Schema::table('beneficiaries', function (Blueprint $table) {
        if (Schema::hasColumn('beneficiaries', 'pdf_path')) {
            $table->dropColumn('pdf_path');
        }

        if (Schema::hasColumn('beneficiaries', 'image_path')) {
            $table->dropColumn('image_path');
        }
    });
}

    
};
