<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToModeratorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('moderator', function(Blueprint $table)
		{
			$table->foreign('idUserBoss', 'moderator_ibfk_1')->references('id')->on('user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUserModerator', 'moderator_ibfk_2')->references('id')->on('user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('moderator', function(Blueprint $table)
		{
			$table->dropForeign('moderator_ibfk_1');
			$table->dropForeign('moderator_ibfk_2');
		});
	}

}
