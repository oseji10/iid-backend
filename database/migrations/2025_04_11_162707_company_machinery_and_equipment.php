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
        Schema::create('company_machinery_and_equipment', function (Blueprint $table){
            $table->id('machineryAndEquipmentId');
            $table->unsignedBigInteger('companyId')->nullable();
            $table->string('equipmentName')->nullable();
            $table->string('sourceOfMachinery')->nullable();
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
