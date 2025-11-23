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
        Schema::create('family_period_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_guardian_id')->comment('家族・後見人ID')
                ->references('id')->on('family_guardians');
            $table->date('start_date')->nullable()->comment('開始日');
            $table->date('end_date')->nullable()->comment('終了日');
            $table->unsignedBigInteger('one_month_amount')->nullable()->comment('1ヶ月分');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_period_expenses');
    }
};
