<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("products", function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->double("price");
            $table->string("image");
            $table->integer("retailerId", false, true);
            $table->text("description");
            $table->timestamps();

            $table->foreign("retailerId")->references("id")->on("retailers");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
