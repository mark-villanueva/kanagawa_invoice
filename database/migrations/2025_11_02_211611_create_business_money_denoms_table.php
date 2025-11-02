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
        Schema::create('business_money_denoms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->comment('事業所ID')
                ->constrained('businesses');
            $table->string('money_denomination_name')->nullable()->comment('金種名');
            $table->unsignedBigInteger('ten_thousand_yen')->nullable()->comment('一万円');
            $table->unsignedBigInteger('five_thousand_yen')->nullable()->comment('五千円');
            $table->unsignedBigInteger('thousand_yen')->nullable()->comment('千円');
            $table->unsignedBigInteger('five_hundred_yen')->nullable()->comment('五百円');
            $table->unsignedBigInteger('hundred_yen')->nullable()->comment('百円');
            $table->unsignedBigInteger('fifty_yen')->nullable()->comment('五十円');
            $table->unsignedBigInteger('ten_yen')->nullable()->comment('十円');
            $table->unsignedBigInteger('five_yen')->nullable()->comment('五円');
            $table->unsignedBigInteger('one_yen')->nullable()->comment('一円');
            $table->unsignedBigInteger('total')->nullable()->comment('合計');
            $table->timestamps();
            $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_money_denoms');
    }
};
