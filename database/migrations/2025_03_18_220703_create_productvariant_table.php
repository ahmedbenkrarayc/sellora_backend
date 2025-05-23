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
        Schema::create('productvariant', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('stock');
            $table->float('price');
            $table->boolean('available')->default(true);
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('color')->onDelete('cascade');
            $table->foreign('size_id')->references('id')->on('size')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productvariant');
    }
};
