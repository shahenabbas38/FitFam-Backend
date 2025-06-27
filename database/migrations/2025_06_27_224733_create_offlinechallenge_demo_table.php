<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offlinechallenge_demo', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->nullable();
            $table->integer('duration')->nullable();
            $table->string('reward')->nullable();
            $table->text('description')->nullable();
            $table->integer('points')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offlinechallenge_demo');
    }
};
