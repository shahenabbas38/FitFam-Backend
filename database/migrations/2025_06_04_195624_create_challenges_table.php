<?php
// database/migrations/xxxx_xx_xx_create_challenges_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('challenges', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->uuid('created_by_id');
            $table->boolean('is_public');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('challenges');
    }
};
