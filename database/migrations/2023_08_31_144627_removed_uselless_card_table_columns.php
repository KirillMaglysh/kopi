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
        Schema::table('card', function (Blueprint $table) {
            $table->dropColumn('skills');
            $table->dropColumn('gratitude');
            $table->dropColumn('aim');
            $table->dropColumn('link_tg');
            $table->dropColumn('link_vk');
            $table->dropColumn('photo_qr');
            $table->dropColumn('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('card', function (Blueprint $table) {
            Schema::dropIfExists('card');
        });
    }
};
