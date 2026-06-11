<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categorie_visite', function (Blueprint $table) {
            $table->string('statut', 50)->nullable()->after('intitule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categorie_visite', function (Blueprint $table) {
            $table->dropColumn('statut');
        });
    }
};
