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
        Schema::create('company_major_raw_materials', function (Blueprint $table){
            $table->id('rawMaterialsId');
            $table->unsignedBigInteger('companyId')->nullable();
            $table->string('foreignItem')->nullable();
            $table->string('foreignItemQuantity')->nullable();
            $table->string('localItem')->nullable();
            $table->string('localItemQuantity')->nullable();
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
