<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255);
            $table->string('url_key', 255)->unique();
            $table->decimal('price',10,2);
            $table->text('description')->nullable();
            $table->integer('qty')->nullable();
            $table->boolean('active')->default(false)->nullable();
            $table->integer('sort')->nullable();
            $table->boolean('onsale')->nullable();
            $table->boolean('special')->nullable();
            $table->boolean('need_order')->nullable();
            $table->integer('category_id')->unsigned();
            $table->integer('type_product_id')->unsigned()->nullable();
            $table->integer('producer_type_product_id')->unsigned()->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('type_product_id')->references('id')->on('type_products')->onDelete('cascade');
            $table->foreign('producer_type_product_id')->references('id')->on('producer_type_product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_producer_type_product_id_foreign');
            $table->dropForeign('products_type_product_id_foreign');
            $table->dropForeign('products_category_id_foreign');
        });
        Schema::dropIfExists('products');
    }
}
