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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('facility')->nullable()->comment('施設名');
            $table->string('corporate')->nullable()->comment('法人名');
            $table->string('phone')->nullable()->comment('電話番号');
            $table->string('fax')->nullable()->comment('FAX番号');
            $table->string('representative')->nullable()->comment('代表名');
            $table->string('postal_code')->nullable()->comment('郵便番号');
            $table->string('address')->nullable()->comment('住所');
            $table->text('special_notes')->nullable()->comment('備忘記録');
            $table->string('financial_institution')->nullable()->comment('金融機関');
            $table->string('branch_name')->nullable()->comment('支店名');
            $table->string('deposit_type')->nullable()->comment('預金種別');
            $table->string('account_number')->nullable()->comment('口座番号');
            $table->string('payee_name')->nullable()->comment('支払人名');
            $table->string('payee_name_kana')->nullable()->comment('支払人名(カナ)');
            $table->string('registration_category')->nullable()->comment('登録区分');
            $table->string('code_type')->nullable()->comment('コード種別');
            $table->string('number_code')->nullable()->comment('番号コード');
            $table->string('registration_number')->nullable()->comment('登録番号');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
