<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
	/**
	 * The attributes that are mass assignable.
	 */
	protected $fillable = [
		'id',
		'title',
		'episode_id',
		'opening_crawl',
		'director',
		'producer',
		'release_date',
		'image_url',
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
	 * Get the people that are in this film.
	 */
	public function characters()
	{
		return $this->belongsToMany(Person::class);
	}

	/**
	 * Get the planets that are in this film.
	 */
	public function planets()
	{
		return $this->belongsToMany(Planet::class);
	}

	/**
	 * Get the species that are in this film.
	 */
	public function species()
	{
		return $this->belongsToMany(Species::class);
	}

	/**
	 * Get the starships that are in this film.
	 */
	public function starships()
	{
		return $this->belongsToMany(Starship::class);
	}

	/**
	 * Get the vehicles that are in this film.
	 */
	public function vehicles()
	{
		return $this->belongsToMany(Vehicle::class);
	}
}
