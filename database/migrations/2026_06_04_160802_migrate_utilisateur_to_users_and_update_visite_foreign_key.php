<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add legacy mapping column
        Schema::table('users', function (Blueprint $table) {
            $table->integer('legacy_utilisateur_id')
                ->nullable()
                ->unique();
        });

        // 2. Populate legacy IDs
        DB::statement("
            UPDATE users
            SET legacy_utilisateur_id =
                CASE id
                    WHEN 1 THEN 0
                    WHEN 2 THEN 2
                    WHEN 3 THEN 3
                END
            WHERE id IN (1,2,3)
        ");

        // 3. Update visite records to use users.id
        // drop old FK first

        DB::statement("
    ALTER TABLE visite
    DROP CONSTRAINT IF EXISTS visite_idutilisateur_fkey
");

        // now update references

        DB::statement("
    UPDATE visite v
    SET idutilisateur = u.id
    FROM users u
    WHERE v.idutilisateur = u.legacy_utilisateur_id
");

        // create new FK

        DB::statement("
    ALTER TABLE visite
    ADD CONSTRAINT visite_idutilisateur_fkey
    FOREIGN KEY (idutilisateur)
    REFERENCES users(id)
");

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};