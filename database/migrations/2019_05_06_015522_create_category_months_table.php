<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoryMonths', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("pointid")->unsigned()->index();
            $table->string("category");
            $table->boolean("Jan")->default(false);
            $table->boolean("Feb")->default(false);
            $table->boolean("Mar")->default(false);
            $table->boolean("Apl")->default(false);
            $table->boolean("May")->default(false);
            $table->boolean("Jun")->default(false);
            $table->boolean("Jul")->default(false);
            $table->boolean("Aug")->default(false);
            $table->boolean("Sep")->default(false);
            $table->boolean("Oct")->default(false);
            $table->boolean("Nov")->default(false);
            $table->boolean("Dec")->default(false);
            $table->timestamps();
            
            //外部キー設定
            $table->foreign("pointid")->references("id")->on("points")->onDelete("cascade");
            
            //pointidとcategoryの重複を許さない
            $table->unique(["pointid", "category"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoryMonths');
    }
}
