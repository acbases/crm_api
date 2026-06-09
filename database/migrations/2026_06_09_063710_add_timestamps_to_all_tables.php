<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected array $tables = [
        'agence',
        'autre_produit',
        'categorie_client',
        'categorie_visite',
        'client',
        'correspondant',
        'correspondant_client',
        'fournisseur',
        'fournisseur_client',
        'objectif_visite',
        'plv',
        'produit_client',
        'produits',
        'quartier',
        'rapport',
        'rapportb2b',
        'recensement_plv',
        'ref_prix_produit',
        'type_visite',
        'users',
    ];
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'created_at')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->timestamps();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'created_at')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropTimestamps();
                });
            }
        }
    }
};
