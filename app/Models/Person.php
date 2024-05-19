<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'affiliations' => 'array',
	];

	/**
	 * The attributes that are mass assignable.
	 */
	protected $fillable = [
		'id',
		'name',
		'birth_year',
		'eye_color',
		'hair_color',
		'height',
		'mass',
		'skin_color',
		'wiki_link',
		'image_url',
		'affiliations',
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
	 * Get the homeworld that this person was born on or inhabits.
	 */
	public function homeworld()
	{
		return $this->belongsTo(Planet::class);
	}

	/**
	 * Get the films that this person has been in.
	 */
	public function films()
	{
		return $this->belongsToMany(Film::class);
	}

	/**
	 * Get the species that this person belongs to.
	 */
	public function species()
	{
		return $this->belongsToMany(Species::class);
	}

	/**
	 * Get the starships that this person has piloted.
	 */
	public function starships()
	{
		return $this->belongsToMany(Starship::class);
	}

	/**
	 * Get the vehicles that this person has piloted.
	 */
	public function vehicles()
	{
		return $this->belongsToMany(Vehicle::class);
	}
}
