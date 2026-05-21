<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() !== 'pgsql' || ! Schema::hasTable('client')) {
            return;
        }

        DB::statement("
            SELECT setval(
                pg_get_serial_sequence('client', 'id'),
                COALESCE((SELECT MAX(id) FROM client), 1),
                true
            )
        ");
    }

    public function down(): void
    {
        // No rollback needed for sequence synchronization.
    }
};
