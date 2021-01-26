<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('title');
            $table->longText('description');
            $table->string('main_image')->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('price', 8, 2)->default(0);
            $table->enum('status', ['pending', 'refused', 'active'])->default('pending');
            $table->longText('reason')->nullable();
            $table->date('start_at')->default(now())->nullable();
            $table->date('end_at')->nullable();
            $table->date('start_offer_at')->nullable();
            $table->date('end_offer_at')->nullable();
            $table->decimal('price_offer', 5, 2)->default(0)->nullable();

            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->cascadeOnDelete();

            $table->bigInteger('trademark_id')->unsigned()->nullable();
            $table->foreign('trademark_id')->references('id')->on('trade_marks')->cascadeOnDelete();

            $table->bigInteger('manufacture_id')->unsigned()->nullable();
            $table->foreign('manufacture_id')->references('id')->on('manufacts')->cascadeOnDelete();

            $table->bigInteger('color_id')->unsigned()->nullable();
            $table->foreign('color_id')->references('id')->on('colors')->cascadeOnDelete();

            $table->string('size')->nullable();
            $table->bigInteger('size_id')->unsigned()->nullable();
            $table->foreign('size_id')->references('id')->on('sizes')->cascadeOnDelete();

            $table->string('weight')->nullable();
            $table->bigInteger('weight_id')->unsigned()->nullable();
            $table->foreign('weight_id')->references('id')->on('weights')->cascadeOnDelete();

            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->foreign('currency_id')->references('id')->on('countries')->cascadeOnDelete();

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
        Schema::dropIfExists('products');
    }
}
