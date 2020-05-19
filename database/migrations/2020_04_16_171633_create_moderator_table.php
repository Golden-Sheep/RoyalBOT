<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModeratorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('moderator', function(Blueprint $table)
		{
			$table->integer('idUserBoss')->nullable()->index('idUserBoss');
			$table->integer('idUserModerator')->nullable()->index('idUserModerator');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('moderator');
	}

}
