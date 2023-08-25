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
        Schema::create('card', function (Blueprint $table) {
            $table->id();
            $table->string('skills');
            $table->string('gratitude');
            $table->string('for_what');
            $table->string('aim');
            $table->string('description');
            $table->string('photo_card');
            $table->string('link_tg');
            $table->string('link_vk')->nullable();
            $table->string('photo_qr');
            $table->string('phone_number');
            $table->integer('user_id');
            $table->integer('summa');
            $table->boolean('moderation')->default(false)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card');
    }
};
