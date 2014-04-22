<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReportTypesRelation extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'reports',
            function ($table) {
                $table->integer('report_type_id')->unsigned();
                $table->foreign('report_type_id')->references('id')->on('report_types');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'reports',
            function ($table) {
                $table->dropForeign('reports_report_type_id_foreign');
                $table->dropColumn('report_type_id');
            }
        );
    }
}
