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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('hospital_name')->nullable()->comment('病院名');
            $table->string('abbreviation')->nullable()->comment('略称');
            $table->string('phone')->nullable()->comment('電話番号');
            $table->string('fax')->nullable()->comment('FAX番号');
            $table->string('postal_code')->nullable()->comment('郵便番号');
            $table->string('address')->nullable()->comment('住所');
            $table->text('special_notes')->nullable()->comment('備忘記録');
            $table->string('hospital_category')->nullable()->comment('病院区分');
            $table->json('supporting_medical_departments')->nullable()->comment('対応診療科目');
            $table->string('medical_institution_code')->nullable()->comment('医療機関コード');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
