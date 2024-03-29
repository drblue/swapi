<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index()
	{
		// Initialize the query builder
		$query = Vehicle::query();

		// Count relationships
		$query->withCount('pilots', 'films');

		// Search for people by name based on request query parameters
		if (request()->has('search')) {
			$query->where('name', 'like', '%' . request('search') . '%');
		}

		// Get paginated results
		$vehicles = $query->paginate(
			request()->has('per_page') ? intval(request('per_page')) : 10
		)->appends(
			request()->query()
		);

		// Return JSON response
		return response()->json($vehicles);
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
	 * @param  \App\Models\Vehicle  $vehicle
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Vehicle $vehicle)
	{
		// Load relationships
		$vehicle->load('pilots:id,name', 'films:id,title');

		// Return response as json
		return response()->json($vehicle);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Vehicle  $vehicle
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, Vehicle $vehicle)
	{
		abort(405, 'Method Not Allowed');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Vehicle  $vehicle
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Vehicle $vehicle)
	{
		abort(405, 'Method Not Allowed');
	}
}
