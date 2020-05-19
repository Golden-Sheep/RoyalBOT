<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWordsBlackListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('words_black_list', function(Blueprint $table)
		{
			$table->foreign('idUser', 'words_black_list_ibfk_1')->references('id')->on('user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('words_black_list', function(Blueprint $table)
		{
			$table->dropForeign('words_black_list_ibfk_1');
		});
	}

}
