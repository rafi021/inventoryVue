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
            $table->string('product_root');
            $table->unsignedInteger('buying_price');
            $table->unsignedInteger('selling_price');
            $table->unsignedInteger('product_quantity');
            $table->unsignedInteger('alert_quantity');
            $table->string('buying_date');
            $table->string('product_image');
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
