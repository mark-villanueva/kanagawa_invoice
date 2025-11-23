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
        Schema::create('guardian_period_incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_guardian_id')->comment('家族・後見人ID')
                ->references('id')->on('family_guardians');
            $table->string('income_name')->nullable()->comment('代わりに受給している名称');
            $table->date('start_date')->nullable()->comment('開始日');
            $table->date('end_date')->nullable()->comment('終了日');
            $table->unsignedBigInteger('yearly_amount')->nullable()->comment('年額');
            $table->unsignedBigInteger('two_months_amount')->nullable()->comment('2ヶ月分');
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
        Schema::dropIfExists('guardian_period_incomes');
    }
};
