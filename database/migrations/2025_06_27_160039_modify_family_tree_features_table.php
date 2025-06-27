<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('family_tree_features', function (Blueprint $table) {
            // ➊ احذف الـ Foreign Key Constraint أولاً
            $table->dropForeign(['user_id']);

            // ➋ احذف الـ Primary Key
            $table->dropPrimary();

            // ➌ أضف عمود id كبريماري جديد
            $table->bigIncrements('id')->first();

            // ➍ أرجع اعمل الـ Foreign Key مرة ثانية
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('family_tree_features', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('id');
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
