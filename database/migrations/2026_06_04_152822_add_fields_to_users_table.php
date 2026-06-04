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
        Schema::table('users', function (Blueprint $table) {
            $table->string('matricule', 50)->nullable()->after('email');
            $table->string('firstname', 100)->nullable()->after('matricule');
            $table->boolean('statut')->nullable()->after('firstname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'matricule',
                'firstname',
                'statut',
            ]);
        });
    }
};
