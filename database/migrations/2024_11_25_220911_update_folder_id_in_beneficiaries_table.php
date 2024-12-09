<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFolderIdInBeneficiariesTable extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('beneficiaries', 'folder_id')) {
            Schema::table('beneficiaries', function (Blueprint $table) {
                $table->unsignedBigInteger('folder_id')->nullable()->default(null)->change();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('beneficiaries', 'folder_id')) {
            Schema::table('beneficiaries', function (Blueprint $table) {
                $table->unsignedBigInteger('folder_id')->nullable(false)->default(1)->change();
            });
        }
    }
}
