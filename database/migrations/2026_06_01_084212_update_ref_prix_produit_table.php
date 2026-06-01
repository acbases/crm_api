<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         // Rename column
        Schema::table('ref_prix_produit', function (Blueprint $table) {
            $table->renameColumn('prix_vetne_details', 'prix_vente_details');
        });

        // Add volume column
        Schema::table('ref_prix_produit', function (Blueprint $table) {
            $table->decimal('volume')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ref_prix_produit', function (Blueprint $table) {
            $table->dropColumn('volume');
        });

        Schema::table('ref_prix_produit', function (Blueprint $table) {
            $table->renameColumn('prix_vente_details', 'prix_vetne_details');
        });
    }
};
