<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFkNameOnFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeign("favorites_pointid_foreign");
            $table->dropForeign("favorites_userid_foreign");
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->renameColumn("userID", "user_id");
            $table->renameColumn("pointID", "point_id");
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("point_id")->references("id")->on("points")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeign("favorites_pointid_foreign");
            $table->dropForeign("favorites_userid_foreign");
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->renameColumn("userID", "user_id");
            $table->renameColumn("pointID", "point_id");
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("point_id")->references("id")->on("points")->onDelete("cascade");
        });
    }
}
