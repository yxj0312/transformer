<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands'); // Foreign key for brand, referencing the brands table
            $table->foreignId('category_id')->constrained('categories'); // Foreign key for category, referencing the categories table with cascade deletion enabled
            $table->string('name'); // Product name
            $table->string('description'); // Description
            $table->decimal('price', 8, 2); // Price with 2 decimal places
            $table->integer('quantity'); // Quantity
            $table->string('image'); // Image
            $table->boolean('is_featured'); // Is the product featured?
            $table->boolean('is_active'); // Is the product active?
            $table->string('meta_title')->nullable(); // Meta title (optional)
            $table->string('meta_description')->nullable(); // Meta description (optional)
            $table->string('slug'); // URL slug
            $table->string('featured_image')->nullable(); // Featured image (optional)
            $table->timestamps(); // Created at and updated at timestamps
            $table->softDeletes(); // Soft delete flag
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
