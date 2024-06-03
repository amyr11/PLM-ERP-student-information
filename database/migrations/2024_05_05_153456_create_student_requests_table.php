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
        Schema::create('student_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date_requested');
            $table->date('date_of_payment');
            $table->float('amount_paid');
            $table->string('receipt_no');
            $table->string('purpose');
            $table->date('expected_release');
            $table->date('date_received')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_requests');
    }
};
