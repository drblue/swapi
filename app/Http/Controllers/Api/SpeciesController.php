<?php

namespace App\Http\Controllers\APi;

use App\Models\Species;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Initialize the query builder
		$query = Species::query();

		// Load relationships
		$query->with('people:id,name', 'homeworld:id,name', 'films:id,title');

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
	 * @param  \App\Models\Species  $species
	 * @return \Illuminate\Http\Response
	 */
	public function show(Species $species)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Species  $species
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Species $species)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Species  $species
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Species $species)
	{
		//
	}
}