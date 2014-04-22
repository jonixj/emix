<?php

use Illuminate\Database\Migrations\Migration;

class AddServerCredentials extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table(
            'servers',
            function ($table) {
                $table->string('host')->unique();
                $table->string('username');
                $table->string('password');
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
            'servers',
            function ($table) {
                $table->dropColumn('host');
                $table->dropColumn('username');
                $table->dropColumn('password');
            }
        );
	}

}