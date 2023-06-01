<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RootController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return [
			'films' => route('films.index'),
			'people' => route('people.index'),
			'planets' => route('planets.index'),
			'species' => route('species.index'),
			'starships' => route('starships.index'),
			'vehicles' => route('vehicles.index'),
		];
	}
}
