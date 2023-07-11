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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // The name of the role (e.g., "Admin", "Customer", "Vendor")
            $table->string('slug')->unique(); // A unique slug identifier for the role (e.g., "admin", "customer", "vendor")
            $table->text('description')->nullable(); // A brief description of the role
            $table->boolean('is_default')->default(false); // Whether this role is the default role assigned to new users
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
