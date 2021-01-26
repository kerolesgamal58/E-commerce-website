<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->bigInteger('customer_product_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('shipping_company_id')->unsigned();
            $table->string('address');
            $table->string('postcode');
            $table->string('email');
            $table->string('mobile');
            $table->foreign('customer_product_id')->references('id')->on('customer_products')->cascadeOnDelete();
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete();
            $table->foreign('city_id')->references('id')->on('cities')->cascadeOnDelete();
            $table->foreign('shipping_company_id')->references('id')->on('shippings')->cascadeOnDelete();
            $table->timestamps();
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
}
