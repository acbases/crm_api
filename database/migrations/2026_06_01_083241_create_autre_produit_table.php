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
        Schema::create('autre_produit', function (Blueprint $table) {
            $table->id();

            $table->foreignId('idvisite')
                ->constrained('visite')
                ->cascadeOnDelete();

            $table->string('nom', 100);

            $table->decimal('prix_achat', 15, 2)->nullable();
            $table->decimal('prix_vente_gros', 15, 2)->nullable();
            $table->decimal('prix_vente_details', 15, 2)->nullable();
            $table->decimal('cout_transport', 15, 2)->nullable();
            $table->decimal('marge', 15, 2)->nullable();
            $table->decimal('volume', 15, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autre_produit');
    }
};