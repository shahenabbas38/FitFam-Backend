<?php
// database/migrations/xxxx_xx_xx_create_challenges_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id(); // ID عادي Auto Increment
            $table->string('name');
            $table->dateTime('start_date');
            $table->dateTime('end_date');

            // أولاً تعرّف العمود، ثم المفتاح الأجنبي
            $table->unsignedBigInteger('created_by_id');
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('is_public');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('challenges');
    }
};
