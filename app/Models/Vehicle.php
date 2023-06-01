<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
	/**
	 * The attributes that are mass assignable.
	 */
	protected $fillable = [
		'id',
		'name',
		'model',
		'manufacturer',
		'cost_in_credits',
		'length',
		'max_atmosphering_speed',
		'crew',
		'passengers',
		'cargo_capacity',
		'consumables',
		'vehicle_class',
		'created',
		'edited',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 */
	protected $hidden = [
		'pivot',
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var boolean
	 */
	public $timestamps = false;

	/**
	 * Get the films that this vehicle has appeared in.
	 */
	public function films()
	{
		return $this->belongsToMany(Film::class);
	}

	/**
	 * Get the pilots that this vehicle has been piloted by.
	 */
	public function pilots()
	{
		return $this->belongsToMany(Person::class);
	}
}
