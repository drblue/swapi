<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class TrustProxiesTest extends TestCase
{
	/** @test */
	public function forwarded_proto_controls_generated_urls()
	{
		Route::get('/proxy-url-test', function (Request $request) {
			return [
				'url' => $request->fullUrl(),
				'secure' => $request->secure(),
			];
		});

		$response = $this->withHeaders([
			'X-Forwarded-Host' => 'swapi.thehiveresistance.com',
			'X-Forwarded-Proto' => 'https',
		])->get('/proxy-url-test?page=9');

		$response->assertOk();
		$response->assertJson([
			'url' => 'https://swapi.thehiveresistance.com/proxy-url-test?page=9',
			'secure' => true,
		]);
	}
}
