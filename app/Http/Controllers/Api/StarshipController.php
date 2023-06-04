<?php

namespace App\Http\Controllers\Api;

use App\Models\Starship;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StarshipController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Initialize the query builder
		$query = Starship::query();

		// Count relationships
		$query->withCount('pilots', 'films');

		// Search for people by name based on request query parameters
		if (request()->has('search')) {
			$query->where('name', 'like', '%' . request('search') . '%');
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Starship  $starship
	 * @return \Illuminate\Http\Response
	 */
	public function show(Starship $starship)
	{
		// Load relationships
		$starship->load('pilots:id,name', 'films:id,title');

		// Return response as json
		return $starship;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Starship  $starship
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Starship $starship)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Starship  $starship
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Starship $starship)
	{
		//
	}
}
