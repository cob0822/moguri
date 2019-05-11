<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMonthsColumnAndDeleteEachMonthColumnCategoryMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categoryMonths', function (Blueprint $table) {
            $table->dropColumn("Jan");
            $table->dropColumn("Feb");
            $table->dropColumn("Mar");
            $table->dropColumn("Apl");
            $table->dropColumn("May");
            $table->dropColumn("Jun");
            $table->dropColumn("Jul");
            $table->dropColumn("Aug");
            $table->dropColumn("Sep");
            $table->dropColumn("Oct");
            $table->dropColumn("Nov");
            $table->dropColumn("Dec");
            $table->integer("months")->default(0)->after("category");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categoryMonths', function (Blueprint $table) {
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
            $table->dropColumn("months");
        });
    }
}
