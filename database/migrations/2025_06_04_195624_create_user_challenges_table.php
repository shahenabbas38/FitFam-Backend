<?php
// database/migrations/xxxx_xx_xx_create_user_challenges_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_challenges', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('challenge_id');
            $table->dateTime('join_date');
            $table->timestamps();

            // العلاقات
            $table->foreign('challenge_id')->references('id')->on('challenges')->onDelete('cascade');
            // ملاحظة: يمكن ربط user_id بجداول المستخدمين عند الحاجة
        });
    }

    public function down(): void {
        Schema::dropIfExists('user_challenges');
    }
};
