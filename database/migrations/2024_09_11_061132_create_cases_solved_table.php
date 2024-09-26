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
        Schema::create('cases_solved', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('division_id');
            $table->unsignedBigInteger('case_id'); // Link to the cases table

            $table->integer('criminal_cases_solved')->default(0);
            $table->integer('civil_cases_solved')->default(0);
            $table->integer('special_cases_solved')->default(0);
            $table->timestamps();

            $table->foreign('division_id')->references('division')->on('users')->onDelete('cascade');
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases_solved');
    }
};
