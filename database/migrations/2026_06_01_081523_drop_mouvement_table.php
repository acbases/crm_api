<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_visite_complet');
        DB::statement('DROP VIEW IF EXISTS v_mouvement_details');

        Schema::dropIfExists('mouvement');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate mouvement table here if rollback is needed
        Schema::create('mouvement', function (Blueprint $table) {
            $table->id();

            $table->integer('idvisite')->nullable();
            $table->integer('statut')->nullable();
            $table->integer('idproduit')->nullable();
            $table->decimal('volume')->nullable();
            $table->string('frequence', 100)->nullable();
            $table->string('autre_produit', 100)->nullable();
            $table->decimal('prix')->nullable();

            $table->foreign('idvisite')
                ->references('id')
                ->on('visite');

            $table->foreign('idproduit')
                ->references('id')
                ->on('produit_client');
        });
        // Recreate v_mouvement_details
        DB::statement("
            CREATE OR REPLACE VIEW v_mouvement_details AS
            SELECT
                m.id AS id_mouvement,
                m.idvisite,
                m.statut,
                pc.id AS id_produit_client,
                p.id AS id_produit,
                p.intitule AS nom_produit,
                m.autre_produit,
                m.prix,
                m.volume,
                m.frequence
            FROM mouvement m
            LEFT JOIN produit_client pc ON m.idproduit = pc.id
            LEFT JOIN produits p ON pc.idproduit = p.id
        ");

        // Recreate v_visite_complet
        DB::statement("
            CREATE OR REPLACE VIEW v_visite_complet AS
            SELECT
                v.id AS id_visite,
                v.date::date AS date_visite,
                v.statut AS statut_visite,
                c.id AS id_client,
                c.nom AS nom_client,
                c.zone,
                c.quartier,
                c.latitude,
                c.longitude,
                pc.id AS id_produit_client,
                p.id AS id_produit,
                p.intitule AS nom_produit,
                m.autre_produit,
                m.prix,
                m.volume,
                m.frequence,
                r.description,
                r.autre_plv
            FROM visite v
            JOIN client c ON v.idclient = c.id
            LEFT JOIN mouvement m ON m.idvisite = v.id
            LEFT JOIN produit_client pc ON m.idproduit = pc.id
            LEFT JOIN produits p ON pc.idproduit = p.id
            LEFT JOIN rapport r ON r.idvisite = v.id
        ");
    }
};