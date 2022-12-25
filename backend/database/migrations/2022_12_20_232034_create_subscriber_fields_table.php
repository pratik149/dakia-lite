<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscriber_fields', function (Blueprint $table) {
			$table->id();
			$table->unsignedInteger('subscriber_id');
			$table->unsignedInteger('field_id');
			$table->string('text_value')->nullable();
			$table->integer('number_value')->nullable();
			$table->date('date_value')->nullable();
			$table->boolean('boolean_value')->nullable();
			$table->timestamps();

			$table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('cascade');
			$table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('subscriber_fields');
	}
};
