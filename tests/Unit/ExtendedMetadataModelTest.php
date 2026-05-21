<?php

namespace Tests\Unit;

use App\Models\Film;
use App\Models\Person;
use Tests\TestCase;

class ExtendedMetadataModelTest extends TestCase
{
	/** @test */
	public function long_descriptions_are_hidden_by_default()
	{
		$person = new Person([
			'name' => 'Luke Skywalker',
			'short_description' => 'Short text',
			'long_description' => 'Long text',
		]);

		$this->assertArrayHasKey('short_description', $person->toArray());
		$this->assertArrayNotHasKey('long_description', $person->toArray());
	}

	/** @test */
	public function long_descriptions_can_be_made_visible_for_detail_responses()
	{
		$film = new Film([
			'title' => 'A New Hope',
			'short_description' => 'Short text',
			'long_description' => 'Long text',
		]);

		$film->makeVisible('long_description');

		$this->assertArrayHasKey('long_description', $film->toArray());
	}

	/** @test */
	public function local_image_urls_are_prefixed_with_app_url()
	{
		config(['app.url' => 'https://swapi.example.com']);

		$person = new Person([
			'name' => 'Luke Skywalker',
			'image_url' => '/images/people/1-luke-skywalker.jpg',
		]);

		$this->assertSame('https://swapi.example.com/images/people/1-luke-skywalker.jpg', $person->image_url);
	}

	/** @test */
	public function remote_image_urls_are_not_changed()
	{
		$person = new Person([
			'name' => 'Luke Skywalker',
			'image_url' => 'https://static.wikia.nocookie.net/starwars/images/2/20/LukeTLJ.jpg',
		]);

		$this->assertSame('https://static.wikia.nocookie.net/starwars/images/2/20/LukeTLJ.jpg', $person->image_url);
	}
}
