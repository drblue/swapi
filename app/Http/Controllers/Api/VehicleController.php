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
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Initialize the query builder
		$query = Vehicle::query();

		// Load relationships
		$query->with('pilots:id,name', 'films:id,title');

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
	 * @param  \App\Models\Vehicle  $vehicle
	 * @return \Illuminate\Http\Response
	 */
	public function show(Vehicle $vehicle)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Vehicle  $vehicle
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Vehicle $vehicle)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Vehicle  $vehicle
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Vehicle $vehicle)
	{
		//
	}
}
