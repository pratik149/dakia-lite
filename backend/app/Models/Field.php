<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

use App\Models\SubscriberField;
use App\Models\Subscriber;
use App\Enums\FieldType;

class Field extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'title',
		'type',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'title' => 'string',
		'type' => FieldType::class,
	];

	/**
	 * The Subscribers that belong to this Field
	 * 
	 */
	public function subscribers()
	{
		return $this->belongsToMany(Subscriber::class, 'subscriber_fields')
			->using(SubscriberField::class)
			->withPivot(['text_value', 'number_value', 'date_value', 'boolean_value'])
			->withTimestamps();
	}
}
