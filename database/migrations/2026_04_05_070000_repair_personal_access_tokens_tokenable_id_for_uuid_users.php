<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('personal_access_tokens') || ! Schema::hasColumn('personal_access_tokens', 'tokenable_id')) {
            return;
        }

        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            $column = DB::selectOne(
                "SELECT DATA_TYPE AS data_type, COLUMN_TYPE AS column_type
                 FROM INFORMATION_SCHEMA.COLUMNS
                 WHERE TABLE_SCHEMA = DATABASE()
                   AND TABLE_NAME = 'personal_access_tokens'
                   AND COLUMN_NAME = 'tokenable_id'"
            );

            if ($column !== null && strtolower((string) $column->data_type) !== 'char') {
                DB::statement('ALTER TABLE personal_access_tokens MODIFY tokenable_id CHAR(36) NOT NULL');
            }
        }
    }

    public function down(): void
    {
        // Intentionally no-op. This migration repairs production schema drift.
    }
};
