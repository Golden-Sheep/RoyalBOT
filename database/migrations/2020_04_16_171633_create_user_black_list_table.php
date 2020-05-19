<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserBlackListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_black_list', function(Blueprint $table)
		{
			$table->string('idFacebook', 100)->nullable();
			$table->integer('idUser')->nullable()->index('idUser');
			$table->integer('idUserExecute')->nullable()->index('idUserExecute');
			$table->string('comment', 1000)->nullable();
			$table->string('motivo', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_black_list');
	}

}
