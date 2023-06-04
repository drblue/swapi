<?php

namespace App\Http\Controllers\Api;

use App\Models\Planet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanetController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index()
	{
		// Initialize the query builder
		$query = Planet::query();

		// Count relationships
		$query->withCount('residents', 'films');

		// Search for people by name based on request query parameters
		if (request()->has('search')) {
			$query->where('name', 'like', '%' . request('search') . '%');
		}

		// Get paginated results
		$planets = $query->paginate(10)->appends(request()->query());

		// Return JSON response
		return response()->json($planets);
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
	 * @param  \App\Models\Planet  $planet
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Planet $planet)
	{
		// Load relationships
		$planet->load('residents', 'films:id,title');	// For some reason this doesn't work: 'residents:id,name'

		// Return response as json
		return response()->json($planet);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Planet  $planet
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, Planet $planet)
	{
		abort(405, 'Method Not Allowed');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Planet  $planet
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Planet $planet)
	{
		abort(405, 'Method Not Allowed');
	}
}
