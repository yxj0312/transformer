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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // The name of the brand
            $table->string('slug')->unique(); // The slug of the brand (for SEO-friendly URLs)
            $table->text('description')->nullable(); // The description of the brand (optional)
            $table->string('logo')->nullable(); // The logo of the brand (optional)
            $table->boolean('is_active')->default(true); // Whether the brand is active or not
            $table->string('country')->nullable(); // The country of the brand (optional)
            $table->unsignedSmallInteger('founded_year')->nullable(); // The year the brand was founded (optional)
            $table->string('email')->nullable(); // The email address of the brand (optional)
            $table->string('phone')->nullable(); // The phone number of the brand (optional)
            $table->string('website')->nullable(); // The website of the brand (optional)
            $table->timestamps();
            $table->softDeletes(); // Enables soft deletion for the brand
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
};
