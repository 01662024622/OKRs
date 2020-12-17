<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHt10ReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ht10_reviews', function (Blueprint $table) {
            $table->id();
            $table->string("type")->default("attitude");
            $table->string("name")->nullable();
            $table->bigInteger("apartment_id");
            $table->bigInteger("user_id")->default(0);
            $table->bigInteger("create_by");
            $table->string("content")->nullable();
            $table->string("image")->nullable();
            $table->string("option")->nullable();
            $table->integer("status")->nullable();
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
        Schema::dropIfExists('ht10-reviews');
    }
}
