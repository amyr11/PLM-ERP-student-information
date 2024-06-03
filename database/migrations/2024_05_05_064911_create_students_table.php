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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('student_no', length: 9)->unique();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('maiden_name')->nullable();
            $table->string('suffix')->nullable();
            $table->date('birthdate');
            $table->string('pedigree')->nullable();
            $table->date('graduation_date')->nullable();
            $table->string('plm_email')->unique()->nullable();
            $table->string('personal_email')->unique();
            $table->string('religion');
            $table->date('entry_date');
            $table->string('permanent_address');
            $table->string('mobile_no', length: 11)->unique();
            $table->string('telephone_no')->nullable();
            $table->string('photo_link')->nullable();
            $table->string('password');
            $table->boolean('paying')->default(false);
            $table->integer('year_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
