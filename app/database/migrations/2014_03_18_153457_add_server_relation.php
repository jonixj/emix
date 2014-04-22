<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServerRelation extends Migration {

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
                $table->integer('server_id')->unsigned();
                $table->foreign('server_id')->references('id')->on('servers');
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
                $table->dropForeign('posts_user_id_foreign');
                $table->dropColumn('server_id');
            }
        );
	}

}
