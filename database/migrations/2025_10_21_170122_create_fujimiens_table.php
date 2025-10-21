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
        Schema::create('fujimiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurisdictional_id')->constrained('jurisdictionals');
            $table->string('name')->nullable()->comment('氏名');
            $table->string('gender')->nullable()->comment('性別');
            $table->string('name_kana')->nullable()->comment('氏名(カナ)');
            $table->date('date_of_birth')->nullable()->comment('生年月日');
            $table->string('town')->nullable()->comment('市町村');
            $table->unsignedBigInteger('current_age')->nullable()->comment('年齢');
            $table->date('specified_date')->nullable()->comment('指定日');
            $table->unsignedBigInteger('age_from_specified_date')->nullable()->comment('指定日からの年齢');
            $table->text('special_notes')->nullable()->comment('備忘記録');
            $table->string('payment_refund_method')->nullable()->comment('扶助金_支払方法');
            $table->string('bank_name')->nullable()->comment('銀行名');
            $table->string('bank_type')->nullable()->comment('銀行種別');
            $table->string('branch_name')->nullable()->comment('支店名');
            $table->string('account_type')->nullable()->comment('口座種別');
            $table->string('account_number')->nullable()->comment('口座番号');
            $table->string('account_name')->nullable()->comment('口座名義');
            $table->string('disability_allowances_grade')->nullable()->comment('障害加算金_区分');
            $table->string('disability_allowances_payment_method')->nullable()->comment('障害加算金_支払方法');
            $table->unsignedBigInteger('disability_allowances_amount')->nullable()->comment('障害加算金_額');
            $table->string('benefit_payment_method')->nullable()->comment('補助金_支払方法');
            $table->string('care_worker')->nullable()->comment('介護職員');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fujimiens');
    }
};
