<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFkNameOnCategoryMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categorymonths', function (Blueprint $table) {
            $table->dropForeign("categorymonths_pointid_foreign");
        });
        Schema::table('categorymonths', function (Blueprint $table) {
            $table->renameColumn("pointid", "point_id");
        });
        Schema::table('categorymonths', function (Blueprint $table) {
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
        Schema::table('categorymonths', function (Blueprint $table) {
            $table->dropForeign("categorymonths_pointid_foreign");
        });
        Schema::table('categorymonths', function (Blueprint $table) {
            $table->renameColumn("pointid", "point_id");
        });
        Schema::table('categorymonths', function (Blueprint $table) {
            $table->foreign("point_id")->references("id")->on("points")->onDelete("cascade");
        });
    }
}
