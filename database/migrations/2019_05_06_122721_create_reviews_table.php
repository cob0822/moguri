<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("userID")->unsigned()->index();
            $table->integer("pointID")->unsigned()->index();
            $table->string("category1");
            $table->string("category2")->nullable();
            $table->string("category3")->nullable();
            $table->integer("month");
            $table->integer("review");
            $table->string("comment");
            $table->string("image1")->nullable();
            $table->string("image2")->nullable();
            $table->string("image3")->nullable();
            $table->dateTime("reviewDate");
            $table->timestamps();
            
            //外部キー設定
            $table->foreign("userID")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("pointID")->references("id")->on("points")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
