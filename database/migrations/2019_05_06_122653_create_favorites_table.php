<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("userid")->unsigned()->index();
            $table->integer("pointid")->unsigned()->index();
            $table->timestamps();
            
            //外部キー設定
            $table->foreign("userid")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("pointid")->references("id")->on("points")->onDelete("cascade");
            
            //useridとpointidの重複を許さない
            $table->unique(["userid", "pointid"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
