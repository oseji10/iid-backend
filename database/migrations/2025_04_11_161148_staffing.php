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
        Schema::create('company_staffing', function (Blueprint $table){
            $table->id('staffingId');
            $table->unsignedBigInteger('companyId')->nullable();
            $table->string('staffStrength')->nullable();
            $table->integer('directorExpatriate')->nullable();
            $table->integer('directorNigerian')->nullable();
            $table->integer('managementExpatriate')->nullable();
            $table->integer('managementNigerian')->nullable();
            
            $table->integer('otherStaffSkilled')->nullable();
            $table->integer('otherStaffUnskilled')->nullable();
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
