<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameUserIDPointIDToUserIdPointIdOnReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign("reviews_pointid_foreign");
            $table->dropForeign("reviews_userid_foreign");
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->renameColumn("userid", "user_id");
            $table->renameColumn("pointid", "point_id");
        });
        Schema::table('reviews', function (Blueprint $table) {
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
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign("reviews_point_id_foreign");
            $table->dropForeign("reviews_user_id_foreign");
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->renameColumn("user_id", "userid");
            $table->renameColumn("point_id", "pointID");
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign("userid")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("pointid")->references("id")->on("points")->onDelete("cascade");
        });
    }
}
