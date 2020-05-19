<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserStarListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_star_list', function(Blueprint $table)
		{
			$table->foreign('idUser', 'user_star_list_ibfk_1')->references('id')->on('user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_star_list', function(Blueprint $table)
		{
			$table->dropForeign('user_star_list_ibfk_1');
		});
	}

}
