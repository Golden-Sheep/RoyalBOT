<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogIpTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('log_ip', function(Blueprint $table)
		{
			$table->date('date')->nullable();
			$table->string('ip', 15)->nullable();
			$table->integer('idUser')->nullable()->index('idUser');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('log_ip');
	}

}
