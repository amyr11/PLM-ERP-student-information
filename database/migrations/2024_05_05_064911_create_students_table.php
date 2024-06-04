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
            $table->string('student_no', length: 9)->unique()->nullable();
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
            $table->string('password')->nullable();
            $table->boolean('paying')->default(false);
            $table->string('f_last_name')->nullable();
            $table->string('f_first_name')->nullable();
            $table->string('f_middle_name')->nullable();
            $table->string('f_suffix')->nullable();
            $table->string('f_contact_no')->nullable();
            $table->string('f_address')->nullable();
            $table->string('f_occupation')->nullable();
            $table->string('f_office')->nullable();
            $table->string('f_ofaddress')->nullable();
            $table->string('f_ofnumber')->nullable();
            $table->string('m_last_name')->nullable();
            $table->string('m_first_name')->nullable();
            $table->string('m_middle_name')->nullable();
            $table->string('m_suffix')->nullable();
            $table->string('m_contact_no')->nullable();
            $table->string('m_address')->nullable();
            $table->string('m_occupation')->nullable();
            $table->string('m_office')->nullable();
            $table->string('m_ofaddress')->nullable();
            $table->string('m_ofnumber')->nullable();
            $table->string('g_last_name')->nullable();
            $table->string('g_first_name')->nullable();
            $table->string('g_middle_name')->nullable();
            $table->string('g_suffix')->nullable();
            $table->string('g_relationship')->nullable();
            $table->string('g_contact_no')->nullable();
            $table->string('g_address')->nullable();
            $table->string('g_occupation')->nullable();
            $table->string('g_office')->nullable();
            $table->string('g_ofaddress')->nullable();
            $table->string('g_ofnumber')->nullable();
            $table->integer('annual_family_income')->nullable();
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
