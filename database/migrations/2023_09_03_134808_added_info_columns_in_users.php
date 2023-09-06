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
            $table->string('tg_link')->nullable();
            $table->string('vk_link')->nullable();
            $table->string('self_photo')->nullable();
            $table->string('qr_photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tg_link');
            $table->dropColumn('vk_link');
            $table->dropColumn('self_photo');
            $table->dropColumn('qr_photo');
        });
    }
};
