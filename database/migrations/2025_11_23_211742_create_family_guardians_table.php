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
        Schema::create('family_guardians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fujimien_id')->comment('ふじみ園利用者ID')
                ->references('id')->on('fujimiens');
            $table->string('family_guardian_category')->nullable()->comment('家族・後見人区分');
            $table->string('name')->nullable()->comment('氏名');
            $table->string('phone')->nullable()->comment('電話番号');
            $table->string('relationship')->nullable()->comment('続柄');
            $table->string('office_name')->nullable()->comment('事務所名');
            $table->unsignedBigInteger('fiscal_year')->nullable()->comment('年度');
            $table->unsignedBigInteger('april_amount')->nullable()->comment('4月負担額');
            $table->unsignedBigInteger('may_amount')->nullable()->comment('5月負担額');
            $table->unsignedBigInteger('june_amount')->nullable()->comment('6月負担額');
            $table->unsignedBigInteger('july_amount')->nullable()->comment('7月負担額');
            $table->unsignedBigInteger('august_amount')->nullable()->comment('8月負担額');
            $table->unsignedBigInteger('september_amount')->nullable()->comment('9月負担額');
            $table->unsignedBigInteger('october_amount')->nullable()->comment('10月負担額');
            $table->unsignedBigInteger('november_amount')->nullable()->comment('11月負担額');
            $table->unsignedBigInteger('december_amount')->nullable()->comment('12月負担額');
            $table->unsignedBigInteger('january_amount')->nullable()->comment('1月負担額');
            $table->unsignedBigInteger('february_amount')->nullable()->comment('2月負担額');
            $table->unsignedBigInteger('march_amount')->nullable()->comment('3月負担額');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_guardians');
    }
};
