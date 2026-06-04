<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement(<<<SQL
            CREATE OR REPLACE VIEW vue_rapport_produits AS
            SELECT r.idvisite, r.description, r.autre_plv,
                   p.intitule, rpp.prix_achat, rpp.prix_vente_gros,
                   rpp.prix_vente_details, rpp.cout_transport, rpp.marge, rpp.volume
            FROM rapport r
            LEFT JOIN ref_prix_produit rpp ON rpp.idvisite = r.idvisite
            LEFT JOIN produit_client pc    ON pc.id = rpp.idproduit
            LEFT JOIN produits p           ON p.id = pc.idproduit
        SQL);

        // CORRECTION : Sélection explicite des colonnes de autre_produit sans dupliquer idvisite
        DB::statement(<<<SQL
            CREATE OR REPLACE VIEW vue_rapport_autres_produits AS
            SELECT 
                r.idvisite, 
                ap.id AS autre_produit_id,
                ap.nom,
                ap.prix_achat,
                ap.prix_vente_gros,
                ap.prix_vente_details,
                ap.cout_transport,
                ap.marge,
                ap.volume
            FROM rapport r
            LEFT JOIN autre_produit ap ON ap.idvisite = r.idvisite
        SQL);

        DB::statement(<<<SQL
            CREATE OR REPLACE VIEW vue_rapport_plv AS
            SELECT r.idvisite, plv.id AS plv_id, plv.nom AS plv_nom
            FROM rapport r
            LEFT JOIN recensement_plv rplv ON rplv.idvisite = r.idvisite
            LEFT JOIN plv                  ON plv.id = rplv.idplv
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vue_rapport_plv');
        DB::statement('DROP VIEW IF EXISTS vue_rapport_autres_produits');
        DB::statement('DROP VIEW IF EXISTS vue_rapport_produits');
    }
};