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
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index()
	{
		// Initialize the query builder
		$query = Species::query();

		// Count relationships
		$query->withCount('people', 'films');

		// Search for people by name based on request query parameters
		if (request()->has('search')) {
			$query->where('name', 'like', '%' . request('search') . '%');
		}

		// Get paginated results
		$species = $query->paginate(10)->appends(request()->query());

		// Return JSON response
		return response()->json($species);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request)
	{
		abort(405, 'Method Not Allowed');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Species  $species
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Species $species)
	{
		// Load relationships
		$species->load('people:id,name', 'homeworld:id,name', 'films:id,title');

		// Return response as json
		return response()->json($species);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Species  $species
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, Species $species)
	{
		abort(405, 'Method Not Allowed');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Species  $species
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Species $species)
	{
		abort(405, 'Method Not Allowed');
	}
}
