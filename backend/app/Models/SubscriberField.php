<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Subscriber;
use App\Models\Field;

class SubscriberField extends Pivot
{
	use HasFactory;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'subscriber_fields';

	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = true;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'text_value',
		'number_value',
		'date_value',
		'boolean_value',
	];

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id', 'subscriber_id', 'field_id', 'created_at', 'updated_at'];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'text_value' => 'string',
		'number_value' => 'integer',
		'date_value' => 'date',
		'boolean_value' => 'boolean',
	];

	/**
	 * Get the Subscriber that owns this mapping.
	 * 
	 */
	public function subscriber()
	{
		return $this->belongsTo(Subscriber::class);
	}

	/**
	 * Get the Field that owns this mapping.
	 * 
	 */
	public function field()
	{
		return $this->belongsTo(Field::class);
	}
}
