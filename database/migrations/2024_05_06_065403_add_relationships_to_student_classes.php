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
        Schema::table('student_classes', function (Blueprint $table) {
            $table->foreignId('professor_id')->constrained();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('building_id')->constrained();
            $table->foreignId('day_id')->constrained();
            $table->foreignId('class_mode_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_classes', function (Blueprint $table) {
            $table->dropForeign(['professor_id']);
            $table->dropForeign(['subject_id']);
            $table->dropForeign(['building_id']);
            $table->dropForeign(['day_id']);
            $table->dropForeign(['class_mode_id']);
        });
    }
};
