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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->date('start_date')->nullable()->comment('開始日');
            $table->date('end_date')->nullable()->comment('終了日');
            $table->string('fee_name')->nullable()->comment('名目');
            $table->unsignedBigInteger('scheduled_amount')->nullable()->comment('予定額');
            $table->unsignedBigInteger('actual_amount')->nullable()->comment('実績額');
            $table->tinyInteger('welfare_hospital')->nullable()->comment("対象福祉・病院");
            $table->json('welfare_hospital_id')->nullable()->comment('対象福祉・病院ID');
            $table->BigInteger('difference')->nullable()->comment('差額');
            $table->string('billing_status', 255)->nullable()->comment('請求ステータス');
            $table->date('billing_date')->nullable()->comment('請求日');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
