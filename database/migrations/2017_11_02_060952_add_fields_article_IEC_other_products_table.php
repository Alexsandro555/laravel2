<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsArticleIECOtherProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('products', function (Blueprint $table) {
        $table->integer('producer_id')->unsigned()->nullable();
        $table->string('article')->nullable();
        $table->string('IEC')->nullable();
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
      Schema::table('products', function (Blueprint $table) {
        $table->dropForeign('products_producer_id_foreign');
        $table->dropColumn('producer_id');
        $table->dropColumn('article');
        $table->dropColumn('IEC');
      });
    }
}
