<?php

namespace App\Http\Controllers\Api;

use App\Models\Film;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilmController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Initialize the query builder
		$query = Film::query();

		// Count relationships
		$query->withCount('characters', 'planets', 'starships', 'vehicles', 'species');

		// Search for films by title based on request query parameters
		if (request()->has('search')) {
			$query->where('title', 'like', '%' . request('search') . '%');
		}

		// Return paginated response as json with 10 items per page
		return $query->paginate(10)->appends(request()->query());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		abort(405, 'Method Not Allowed');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Film  $film
	 * @return \Illuminate\Http\Response
	 */
	public function show(Film $film)
	{
		// Load relationships
		$film->load('characters:id,name', 'planets:id,name', 'starships:id,name', 'vehicles:id,name', 'species:id,name');

		// Return response as json
		return $film;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Film  $film
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Film $film)
	{
		abort(405, 'Method Not Allowed');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Film  $film
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Film $film)
	{
		abort(405, 'Method Not Allowed');
	}
}
