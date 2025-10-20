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
        Schema::create('jurisdictionals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses');
            $table->string('jurisdictional_office_code')->nullable()->comment('管轄事務所コード');
            $table->string('jurisdictional_office_name')->nullable()->comment('管轄事務所名');
            $table->string('abbreviation')->nullable()->comment('略称');
            $table->string('prefecture_city')->nullable()->comment('県市部');
            $table->string('postal_code')->nullable()->comment('郵便番号');
            $table->string('address')->nullable()->comment('住所');
            $table->string('phone')->nullable()->comment('電話番号');
            $table->string('fax')->nullable()->comment('FAX番号');
            $table->text('special_notes')->nullable()->comment('備忘記録');
            $table->string('bill_to')->nullable()->comment('宛先名');
            $table->boolean('administrative_costs_invoice')->comment('事務費請求書')->default(false);
            $table->string('term_end_temporary_assistance')->nullable()->comment('期末一時扶助');
            $table->string('first_decimal_place')->nullable()->comment('小数第一位');
            $table->string('second_decimal_place')->nullable()->comment('小数第二位');
            $table->boolean('one_yen_adjustment')->comment('一円調整')->default(false);
            $table->boolean('date_print_on_invoice')->comment('請求書日付の印字')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurisdictionals');
    }
};
