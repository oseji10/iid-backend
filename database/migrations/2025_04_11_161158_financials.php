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
        Schema::create('company_financials', function (Blueprint $table){
            $table->id('financialId');
            $table->unsignedBigInteger('companyId')->nullable();
            $table->string('shareholders')->nullable();
            $table->string('foreignEquity')->nullable();
            $table->string('nigerianEquity')->nullable();
            $table->string('financialPeriod')->nullable();
            $table->string('turnOverPreviousYear')->nullable();
            $table->string('operatingProfitBeforeTax')->nullable();
            $table->string('operatingProfitAfterTax')->nullable();
            $table->string('VAT')->nullable();
            $table->string('companyTax')->nullable();
            $table->string('exciseDuty')->nullable();
            $table->string('initialInvestment')->nullable();
            $table->string('totalFAIFinancialStatement')->nullable();
            $table->string('totalFAIAcceptanceCertificate')->nullable();
            

            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('companyId')->references('companyId')->on('company')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
