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
        Schema::create('company_energy_requirement', function (Blueprint $table){
            $table->id('energyRequirementId');
            $table->unsignedBigInteger('companyId')->nullable();
            $table->string('averageEnergyConsumptionPerDay')->nullable();
            $table->string('percentageContributionByDisco')->nullable();
            $table->string('percentageContributionByGenerator')->nullable();
            $table->string('percentageContributionByOthers')->nullable();
            $table->string('quantityOfDieselUtilized')->nullable();
            $table->string('quantityOfGasUtilized')->nullable();
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
