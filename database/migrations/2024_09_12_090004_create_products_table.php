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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->unsignedBigInteger('catalog_id');
            $table->unsignedBigInteger('flavor_id')->nullable();
            $table->unsignedBigInteger('grade_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->text('image')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('catalog_id','product_catalog_idx');

            $table->foreign('catalog_id')->references('id')->on('catalogs')->onDelete('cascade');
            $table->foreign('flavor_id')->references('id')->on('flavors')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
