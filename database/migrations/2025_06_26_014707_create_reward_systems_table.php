<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reward_systems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('points')->default(0);
            $table->string('badge')->nullable();
            $table->string('virtual_reward')->nullable();
            $table->integer('steps')->default(0); 
            $table->boolean('completed_challenge')->default(false); 
            $table->boolean('invited_family')->default(false); 
            $table->boolean('active_day')->default(false); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reward_systems');
    }
};
