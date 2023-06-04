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
	 * @return \Illuminate\Http\JsonResponse
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

		// Get paginated results
		$starships = $query->paginate(10)->appends(request()->query());

		// Return JSON response
		return response()->json($starships);
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
	 * @param  \App\Models\Starship  $starship
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Starship $starship)
	{
		// Load relationships
		$starship->load('pilots:id,name', 'films:id,title');

		// Return response as json
		return response()->json($starship);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Starship  $starship
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, Starship $starship)
	{
		abort(405, 'Method Not Allowed');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Starship  $starship
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Starship $starship)
	{
		abort(405, 'Method Not Allowed');
	}
}
