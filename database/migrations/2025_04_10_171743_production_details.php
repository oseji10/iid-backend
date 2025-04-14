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
        Schema::create('company_production_details', function (Blueprint $table){
            $table->id('productionDetailsId');
            $table->unsignedBigInteger('companyId')->nullable();
            $table->date('dateProductionStarted')->nullable();
            $table->string('prductsAndServices')->nullable();
            $table->string('designedInstalledCapacity')->nullable();
            $table->string('operatingCapacity')->nullable();
            $table->string('percentageForExport')->nullable();
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
