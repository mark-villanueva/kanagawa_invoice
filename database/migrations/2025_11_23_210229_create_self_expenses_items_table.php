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
        Schema::create('self_expenses_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fujimien_id')
                ->comment('ふじみ園利用者ID')
                ->references('id')->on('fujimiens');
            $table->foreignId('self_expense_id')
                ->comment('自己負担金ID')
                ->references('id')->on('self_expenses');
            $table->string('type')->nullable()->comment('種別');
            $table->string('self_expenses_name')->nullable()->comment('自己負担金名');
            $table->date('start_date')->nullable()->comment('開始日');
            $table->date('end_date')->nullable()->comment('終了日');
            $table->bigInteger('yearly_amount')->nullable()->comment('年額');
            $table->bigInteger('two_months_amount')->nullable()->comment('2ヶ月分');
            $table->bigInteger('one_month_amount')->nullable()->comment('1ヶ月分');
            $table->string('pension_number')->nullable()->comment('年金番号');
            $table->string('payment_method')->nullable()->comment('支払方法');
            $table->text('special_notes')->nullable()->comment('備忘記録');
            $table->softDeletes();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('self_expenses_items');
    }

};
