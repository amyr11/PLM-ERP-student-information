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
        Schema::table('curriculum_programs', function (Blueprint $table) {
            $table->foreignId('curriculum_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('program_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curriculum_programs', function (Blueprint $table) {
            $table->dropForeign(['curriculum_id']);
            $table->dropForeign(['program_id']);
        });
    }
};