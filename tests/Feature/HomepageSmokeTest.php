<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageSmokeTest extends TestCase
{
	/** @test */
	public function root_route_returns_the_html_landing_page()
	{
		$response = $this->get('/');

		$response->assertOk();
		$response->assertHeader('content-type', 'text/html; charset=UTF-8');
		$response->assertSee('<!DOCTYPE html>', false);
		$response->assertSee('<title>SWAPI</title>', false);
		$response->assertDontSee('Deprecated');
		$response->assertDontSee('Warning');
	}
}
