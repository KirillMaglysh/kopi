<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('card', function (Blueprint $table) {
            DB::statement('ALTER TABLE card ADD COLUMN collected integer default 0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('card', function (Blueprint $table) {
            $table->dropColumn('collected');
        });
    }
};
