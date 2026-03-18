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
        Schema::table('follow_ups', function (Blueprint $table) {
            $table->after('user_id', function (Blueprint $table) {
                $table->foreignId('type_follow_up_id')->constrained('type_follow_ups')->onDelete('restrict');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('follow_ups', function (Blueprint $table) {
            $table->dropForeign(['type_follow_up_id']);
            $table->dropColumn('type_follow_up_id');
        });
    }
};
