<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $utilisateurs = DB::table('utilisateur')->get();

        foreach ($utilisateurs as $u) {
            DB::table('users')->insert([
                'name' => $u->nom,
                'firstname' => $u->prenom,
                'email' => $u->mail,
                'password' => Hash::make($u->password),
                'matricule' => $u->matricule,
                'statut' => $u->statut,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
