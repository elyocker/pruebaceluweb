<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdCategoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_catego', function (Blueprint $table) {
            $table->id("prod_codigo")->index();
            
            $table->bigInteger("prod_producto")->uni();
            $table->bigInteger("prod_categoria")->uni();
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
        Schema::dropIfExists('prod_catego');
    }
}
