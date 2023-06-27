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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('order_status_id');
            $table->decimal('total_amount', 10, 2)->comment('The total amount of the order');
            $table->string('currency')->comment('The currency of the order');
            $table->string('payment_status')->comment('The payment status of the order');
            $table->string('shipping_method')->comment('The shipping method of the order');
            $table->string('tracking_number')->nullable()->comment('The tracking number of the order');
            $table->text('shipping_address')->nullable()->comment('The shipping address of the order');
            $table->text('billing_address')->nullable()->comment('The billing address of the order');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
