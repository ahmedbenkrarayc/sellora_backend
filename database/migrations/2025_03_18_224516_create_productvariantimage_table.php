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
        Schema::create('productvariantimage', function (Blueprint $table) {
            $table->id();
            $table->text('path');
            $table->unsignedBigInteger('productvariant_id');
            $table->foreign('productvariant_id')->references('id')->on('productvariant')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productvariantimage');
    }
};
