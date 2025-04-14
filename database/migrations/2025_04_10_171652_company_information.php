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
        Schema::create('company', function (Blueprint $table) {
        $table->id('companyId');
        $table->string('companyName')->nullable();
        $table->string('natureOfBusiness')->nullable();
        $table->string('companyAddress')->nullable();
        $table->string('companyCity')->nullable();
        $table->string('LGA')->nullable();
        $table->string('state')->nullable();
        $table->string('companyPhone')->nullable();
        // $table->unsignedBigInteger('socialMedia')->nullable();
        // $table->string('companyWebsite')->nullable();

        $table->string('TIN')->nullable();
        $table->string('onStockExchange')->nullable();
        $table->date('dateListedOnSE')->nullable();
        $table->date('dateOfIncorporation')->nullable();
        $table->string('status')->nullable();
        $table->timestamps();
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
