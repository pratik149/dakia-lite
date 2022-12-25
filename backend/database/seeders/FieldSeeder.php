<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

use App\Enums\FieldType;

class FieldSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$currentDateTime = Carbon::now()->format('Y-m-d H:i:s');

		DB::table('fields')->upsert([
			['id' => 1, 'title' => 'phone', 'type' => FieldType::Text, 'created_at' => $currentDateTime, 'updated_at' => $currentDateTime],
			['id' => 2, 'title' => 'company', 'type' => FieldType::Text, 'created_at' => $currentDateTime, 'updated_at' => $currentDateTime],
			['id' => 3, 'title' => 'country', 'type' => FieldType::Text, 'created_at' => $currentDateTime, 'updated_at' => $currentDateTime],
			['id' => 4, 'title' => 'zip', 'type' => FieldType::Number, 'created_at' => $currentDateTime, 'updated_at' => $currentDateTime],
			['id' => 5, 'title' => 'birthdate', 'type' => FieldType::Date, 'created_at' => $currentDateTime, 'updated_at' => $currentDateTime],
		], 'id');
	}
}
