<?php

namespace App\Http\Controllers\Api;

use App\Models\Person;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index()
	{
		// Initialize the query builder
		$query = Person::query();

		// Count relationships
		$query->withCount('films', 'species', 'starships', 'vehicles');

		// Load relationships
		$query->with('homeworld:id,name');

		// Search for people by name based on request query parameters
		if (request()->has('search')) {
			$query->where('name', 'like', '%' . request('search') . '%');
		}

		// Get paginated results
		$people = $query->paginate(10)->appends(request()->query());

		// Return JSON response
		return response()->json($people);
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
	 * @param  \App\Models\Person  $person
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Person $person)
	{
		$person->load('homeworld:id,name', 'films:id,title', 'species:id,name', 'starships:id,name', 'vehicles:id,name');

		// Return response as json
		return response()->json($person);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Person  $person
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, Person $person)
	{
		abort(405, 'Method Not Allowed');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Person  $person
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(Person $person)
	{
		abort(405, 'Method Not Allowed');
	}
}
