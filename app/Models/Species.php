<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
	/**
	 * The attributes that are mass assignable.
	 */
	protected $fillable = [
		'id',
		'name',
		'classification',
		'designation',
		'average_height',
		'average_lifespan',
		'eye_colors',
		'hair_colors',
		'skin_colors',
		'language',
		'created',
		'edited',
		'homeworld_id',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 */
	protected $hidden = [
		'homeworld_id',
		'pivot',
	];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var boolean
	 */
	public $timestamps = false;

	/**
	 * Get the homeworld that this species originates from.
	 */
	public function homeworld()
	{
		return $this->belongsTo(Planet::class, 'homeworld_id');
	}

	/**
	 * Get the films that this species has appeared in.
	 */
	public function films()
	{
		return $this->belongsToMany(Film::class);
	}

	/**
	 * Get the people that are a part of this species.
	 */
	public function people()
	{
		return $this->belongsToMany(Person::class);
	}
}
