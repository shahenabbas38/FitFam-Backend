<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offline_challenges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->integer('duration');
            $table->string('reward');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offline_challenges');
    }
};
