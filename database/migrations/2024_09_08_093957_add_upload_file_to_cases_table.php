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
        Schema::table('cases', function (Blueprint $table) {
            $table->after('remarks', function ($table) {
                $table->json('pleading')->nullable();
                $table->json('evidences')->nullable();
                $table->json('verification')->nullable();
                $table->json('certificate')->nullable();
                $table->json('judicial_affidavit')->nullable();

                $table->json('notice_of_appeal')->nullable();
                $table->json('documents')->nullable();
                $table->json('memoranda')->nullable();
                $table->json('other_files')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            //
            $table->dropColumn([
                'pleading',
                'evidences',
                'verification',
                'certificate',
                'judicial_affidavit',
                'notice_of_appeal',
                'documents',
                'memoranda',
            ]);
        });
    }
};
