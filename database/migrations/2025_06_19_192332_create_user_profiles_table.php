<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->integer('age')->nullable();
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->string('fitness_level')->nullable();
            $table->integer('family_members')->nullable();          
            $table->string('preferred_activity')->nullable();           
            $table->integer('points')->default(0); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
