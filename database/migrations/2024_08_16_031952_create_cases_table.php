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
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_judgeID')->nullable();
            $table->tinyInteger('division')->nullable(); // Adjust the position as needed
            // $table->string('case_number'); // Storing as a string
            $table->unsignedBigInteger('case_number')->unique(); // Storing as an integer
            $table->enum('case_type', ['civil', 'criminal', 'special']);
            $table->string('case_court');
            $table->string('case_judge');
            $table->string('judgeHead')->nullable();
            // $table->json('case_requirement'); // Store requirements as a JSON array
            // $table->enum('adminStatus', ['Affirmed', 'Acquitted', 'Sent to Supreme Court', 'Pending'])->default('Pending');
            $table->string('adminStatus')->default('Pending: 0/3');
            $table->enum('status', ['pending', 'sent', 'received'])->default('pending');
            $table->enum('approvalStatus', ['approved', 'denied'])->nullable();
            $table->enum('statusRandom', ['assigned', 'unassigned'])->default('unassigned');
            $table->enum('verdictStatus', ['Affirmed', 'Acquitted', 'Pending'])->default('Pending');
            $table->string('remarks')->nullable();

            $table->string('litigant_name')->nullable();
            $table->string('email_address')->nullable();
            $table->string('contact_number', 11)->nullable();
            $table->unsignedBigInteger('license_number')->nullable();
            $table->string('case_title')->nullable();
            $table->string('name_of_filing_party')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};
