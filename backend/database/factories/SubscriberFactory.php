<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\SubscriberState;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriber>
 */
class SubscriberFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		$subscriberStates = SubscriberState::cases();

		return [
			'name' => fake()->name(),
			'email' => fake()->unique()->safeEmail(),
			'state' => $subscriberStates[array_rand($subscriberStates)],
		];
	}
}
