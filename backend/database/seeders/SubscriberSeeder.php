<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Enums\FieldType;
use App\Models\Subscriber;
use App\Models\Field;

class SubscriberSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Subscriber::factory()->count(100)
			->create()
			->each(function ($subscriber) {
				$fields = Field::all()->random(rand(2, 4));

				$fieldValuesToAttach = [];

				foreach ($fields as $field) {
					$fieldValues = [
						'text_value' => null,
						'number_value' => null,
						'date_value' => null,
						'boolean_value' => null,
					];

					if ($field->type === FieldType::Text) {
						$fieldValues['text_value'] = Str::random(10);
					} else if ($field->type === FieldType::Number) {
						$fieldValues['number_value'] = rand(9999, 99999999);
					} else if ($field->type === FieldType::Date) {
						$fieldValues['date_value'] = Carbon::createFromDate(2010, 12, 31)->subYear(rand(0, 30))->subDays(rand(0, 180))->format('Y-m-d');
					} else if ($field->type === FieldType::Boolean) {
						$fieldValues['boolean_value'] = rand(0, 1);
					}

					$fieldValuesToAttach[$field->id] =  $fieldValues;
				}

				$subscriber->fields()->attach($fieldValuesToAttach);
			});
	}
}
