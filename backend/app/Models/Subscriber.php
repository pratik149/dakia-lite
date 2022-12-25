<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use App\Enums\SubscriberState;
use App\Models\Field;

class Subscriber extends Model
{
	use HasFactory, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'state',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'name' => 'string',
		'email' => 'string',
		'state' => SubscriberState::class,
	];

	/**
	 * The Fields that belong to this Subscriber
	 * 
	 */
	public function fields()
	{
		return $this->belongsToMany(Field::class, 'subscriber_fields')
			->using(SubscriberField::class)
			->withPivot(['text_value', 'number_value', 'date_value', 'boolean_value'])
			->withTimestamps();
	}
}
