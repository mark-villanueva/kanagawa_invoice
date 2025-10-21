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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fujimien_id')->constrained('fujimiens');
            $table->foreignId('hospital_id')->constrained('hospitals');
            $table->string('status')->nullable()->comment('ステータス');
            $table->date('admission_date')->nullable()->comment('入所日');
            $table->date('leaving_date')->nullable()->comment('退所日');
            $table->date('hospitalization_date')->nullable()->comment('入院日');
            $table->date('discharge_date')->nullable()->comment('退院日');
            $table->date('hospitalization_recognition_date')->nullable()->comment('入院認識日');
            $table->date('discharge_recognition_date')->nullable()->comment('退院認識日');
            $table->date('day_care_start_date')->nullable()->comment('通所開始日');
            $table->date('day_care_end_date')->nullable()->comment('通所終了日');
            $table->date('home_training_start_date')->nullable()->comment('居宅訓練開始日');
            $table->date('home_training_end_date')->nullable()->comment('居宅訓練終了日');
            $table->date('welfare_benefits_suspension_start_date')->nullable()->comment('保護費停止開始日');
            $table->date('welfare_benefits_resumption_date')->nullable()->comment('保護費再開日');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
