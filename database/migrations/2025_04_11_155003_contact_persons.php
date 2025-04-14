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
        Schema::create('company_contact_persons', function (Blueprint $table){
            $table->id('contactPersonId');
            $table->unsignedBigInteger('companyId')->nullable();
            $table->string('staffName')->nullable();
            $table->string('designation')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('email')->nullable();
            $table->string('signature')->nullable();
            $table->string('status')->nullable();
            $table->string('isContactPerson')->nullable();
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
