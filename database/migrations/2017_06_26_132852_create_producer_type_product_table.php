<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducerTypeProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producer_type_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_line');
            $table->integer('type_product_id')->length(11)->unsigned();
            $table->integer('producer_id')->length(11)->unsigned();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->foreign('type_product_id')->references('id')->on('type_products')->onDelete('cascade');
            $table->foreign('producer_id')->references('id')->on('producers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producer_type_product', function (Blueprint $table) {
            $table->dropForeign('producer_type_product_type_product_id_foreign');
            $table->dropForeign('producer_type_product_producer_id_foreign');
        });
        Schema::dropIfExists('producer_type_product');
    }
}
