<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
	/**
	 * The attributes that are mass assignable.
	 */
	protected $fillable = [
		'id',
		'name',
		'rotation_period',
		'orbital_period',
		'diameter',
		'climate',
		'gravity',
		'terrain',
		'surface_water',
		'population',
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
	 * Get the films that this planet has appeared in.
	 */
	public function films()
	{
		return $this->belongsToMany(Film::class);
	}

	/**
	 * Get the people that live on this planet.
	 */
	public function residents()
	{
		return $this->hasMany(Person::class, 'homeworld_id');
	}

	/**
	 * Get the species that live on this planet.
	 */
	public function species()
	{
		return $this->belongsToMany(Species::class);
	}
}
