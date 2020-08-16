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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->longText('product_description')->nullable();
            $table->string('product_root')->nullable();
            $table->integer('buying_price')->nullable();
            $table->integer('selling_price');
            $table->integer('product_quantity');
            $table->integer('alert_quantity');
            $table->string('buying_date')->nullable();
            $table->string('product_image')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
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
