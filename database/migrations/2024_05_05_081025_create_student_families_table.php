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
        Schema::create('student_families', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('f_last_name');
            $table->string('f_first_name');
            $table->string('f_middle_name');
            $table->string('f_suffix')->nullable();
            $table->string('f_contact_no');
            $table->string('f_address');
            $table->string('f_occupation');
            $table->string('f_office');
            $table->string('f_ofaddress');
            $table->string('f_ofnumber');
            $table->string('m_last_name');
            $table->string('m_first_name');
            $table->string('m_middle_name');
            $table->string('m_suffix')->nullable();
            $table->string('m_contact_no');
            $table->string('m_address');
            $table->string('m_occupation');
            $table->string('m_office');
            $table->string('m_ofaddress');
            $table->string('m_ofnumber');
            $table->string('g_last_name');
            $table->string('g_first_name');
            $table->string('g_middle_name');
            $table->string('g_suffix')->nullable();
            $table->string('g_relationship');
            $table->string('g_contact_no');
            $table->string('g_address');
            $table->string('g_occupation');
            $table->string('g_office');
            $table->string('g_ofaddress');
            $table->string('g_ofnumber');
            $table->integer('annual_family_income');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_families');
    }
};
