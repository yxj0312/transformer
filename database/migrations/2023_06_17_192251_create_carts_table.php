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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shipping_address_id')->nullable(); // Shipping address for the cart
            $table->unsignedBigInteger('billing_address_id')->nullable(); // Billing address for the cart
            $table->string('session_id')->nullable(); // Stores the session ID associated with the cart
            $table->integer('total_items')->default(0); // Total number of items in the cart
            $table->decimal('total_price', 10, 2)->default(0.00); // Total price of items in the cart
            $table->decimal('discount', 10, 2)->default(0.00); // Discount amount applied to the cart
            $table->string('coupon_code')->nullable(); // Coupon code applied to the cart
            $table->text('notes')->nullable(); // Additional notes or comments for the cart
            $table->boolean('is_checked_out')->default(false); // Flag indicating if the cart has been checked out
            $table->timestamp('checked_out_at')->nullable(); // Timestamp of when the cart was checked out
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shipping_address_id')->references('id')->on('addresses')->onDelete('set null');
            $table->foreign('billing_address_id')->references('id')->on('addresses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
