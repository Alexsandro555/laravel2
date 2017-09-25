<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeProducerTypeProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('attribute_producer_type_product', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->integer('producer_type_product_id')->length(11)->unsigned();
        $table->integer('attribute_id')->length(11)->unsigned();
        $table->string('default_value', 255)->nullable();
        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        $table->foreign('producer_type_product_id')->references('id')->on('producer_type_product')->onDelete('cascade');
        $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('attribute_producer_type_product', function (Blueprint $table) {
        $table->dropForeign('attribute_producer_type_product_producer_type_product_id_foreign');
        $table->dropForeign('attribute_producer_type_product_attribute_id_foreign');
      });
      Schema::dropIfExists('attribute_producer_type_product');
    }
}
