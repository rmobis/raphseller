<?php

use App\Order;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->string('uuid', 36)
				->primary();

			$table->enum('status', [
				Order::STATUS_PENDING,
				Order::STATUS_APPROVED,
				Order::STATUS_DELIVERED,
			]);
			$table->unsignedInteger('license_days');
			$table->float('value');
			$table->string('email');
			$table->string('user');
			$table->string('ip');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
