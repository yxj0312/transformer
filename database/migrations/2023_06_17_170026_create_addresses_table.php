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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // The user ID associated with the address
            $table->string('address'); // The street address
            $table->string('city'); // The city
            $table->string('state'); // The state
            $table->string('country'); // The country
            $table->string('postal_code'); // The postal code
            $table->string('phone_number'); // The phone number
            $table->string('company_name')->nullable(); // The company name (optional)
            $table->string('apartment_number')->nullable(); // The apartment number (optional)
            $table->boolean('is_default')->default(false); // Whether the address is the default address
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
