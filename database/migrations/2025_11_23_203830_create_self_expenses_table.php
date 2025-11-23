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
        Schema::create('self_expenses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fujimien_id')->comment('ふじみ園利用者ID')
                ->references('id')->on('fujimiens');
            $table->string('fiscal_year')->nullable()->comment('年度');
            $table->bigInteger('april_amount')->nullable()->comment('4月負担額');
            $table->bigInteger('may_amount')->nullable()->comment('5月負担額');
            $table->bigInteger('june_amount')->nullable()->comment('6月負担額');
            $table->bigInteger('july_amount')->nullable()->comment('7月負担額');
            $table->bigInteger('august_amount')->nullable()->comment('8月負担額');
            $table->bigInteger('september_amount')->nullable()->comment('9月負担額');
            $table->bigInteger('october_amount')->nullable()->comment('10月負担額');
            $table->bigInteger('november_amount')->nullable()->comment('11月負担額');
            $table->bigInteger('december_amount')->nullable()->comment('12月負担額');
            $table->bigInteger('january_amount')->nullable()->comment('1月負担額');
            $table->bigInteger('february_amount')->nullable()->comment('2月負担額');
            $table->bigInteger('march_amount')->nullable()->comment('3月負担額');
            $table->json('pension')->nullable()->comment('年金');
            $table->json('certificate_of_employment')->nullable()->comment('就労認定');
            $table->bigInteger('total_expenses')->nullable()->comment('負担金計');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('self_expenses');
    }
};
