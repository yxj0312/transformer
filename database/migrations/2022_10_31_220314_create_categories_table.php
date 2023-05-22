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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // The name of the category
            $table->string('slug')->unique(); // The unique slug for the category
            $table->text('description')->nullable(); // The description of the category
            $table->string('image')->nullable(); // The image URL of the category
            $table->boolean('is_active')->default(true); // The status of the category (active/inactive)
            $table->string('meta_title')->nullable(); // The meta title for SEO
            $table->text('meta_description')->nullable(); // The meta description for SEO
            $table->integer('order')->default(0); // The sorting order of the category
            $table->unsignedBigInteger('parent_id')->nullable(); // The ID of the parent category
            $table->timestamps(); // The timestamps for created and updated dates
            $table->softDeletes(); // The soft delete column for deleted categories

            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
