<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiRoutesSmokeTest extends TestCase
{
	private $resources = [
		'films' => [1, 'title'],
		'people' => [5, 'name'],
		'planets' => [1, 'name'],
		'species' => [1, 'name'],
		'starships' => [10, 'name'],
		'vehicles' => [4, 'name'],
	];

	/** @test */
	public function api_root_returns_resource_links()
	{
		$response = $this->getJson('/api/');

		$response->assertOk();
		$response->assertJsonStructure([
			'films',
			'people',
			'planets',
			'species',
			'starships',
			'vehicles',
		]);
	}

	/** @test */
	public function api_index_routes_return_paginated_data()
	{
		foreach (array_keys($this->resources) as $resource) {
			$response = $this->getJson("/api/{$resource}");

			$response->assertOk();
			$response->assertJsonStructure([
				'current_page',
				'data',
				'first_page_url',
				'last_page_url',
				'links',
				'path',
				'per_page',
				'total',
			]);
			$this->assertNotEmpty($response->json('data'), "{$resource} index returned no data");
		}
	}

	/** @test */
	public function api_detail_routes_return_resource_data()
	{
		foreach ($this->resources as $resource => $expectation) {
			list($id, $labelColumn) = $expectation;
			$response = $this->getJson("/api/{$resource}/{$id}");

			$response->assertOk();
			$response->assertJsonStructure(['id', $labelColumn]);
			$this->assertSame($id, $response->json('id'), "{$resource} detail returned the wrong id");
			$this->assertNotEmpty($response->json($labelColumn), "{$resource} detail returned no label");
		}
	}

	/** @test */
	public function planet_detail_residents_only_include_id_and_name()
	{
		$response = $this->getJson('/api/planets/1');

		$response->assertOk();
		$residents = $response->json('residents');

		$this->assertIsArray($residents);
		$this->assertNotEmpty($residents, 'planet detail returned no residents');
		$this->assertSame([
			'id',
			'name',
		], array_keys($residents[0]));
	}

	/** @test */
	public function people_and_species_homeworlds_only_include_id_and_name()
	{
		foreach (['/api/people/5', '/api/species/1', '/api/people', '/api/species'] as $route) {
			$response = $this->getJson($route);

			$response->assertOk();
			$resource = str_contains($route, '/api/people')
				? (str_ends_with($route, '/people') ? $response->json('data.0') : $response->json())
				: (str_ends_with($route, '/species') ? $response->json('data.0') : $response->json());

			$this->assertIsArray($resource['homeworld']);
			$this->assertSame([
				'id',
				'name',
			], array_keys($resource['homeworld']));
			$this->assertArrayNotHasKey('homeworld_count', $resource);
		}
	}

	/** @test */
	public function api_search_routes_return_valid_paginated_data()
	{
		foreach (array_keys($this->resources) as $resource) {
			$response = $this->getJson("/api/{$resource}?search=b&page=2");

			$response->assertOk();
			$response->assertJsonStructure([
				'current_page',
				'data',
				'links',
				'path',
			]);
			$this->assertSame(2, $response->json('current_page'), "{$resource} search did not keep page=2");
			$this->assertIsArray($response->json('data'), "{$resource} search data is not an array");
		}
	}
}
