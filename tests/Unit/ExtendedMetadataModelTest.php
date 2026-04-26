<?php

namespace Tests\Unit;

use App\Models\Film;
use App\Models\Person;
use PHPUnit\Framework\TestCase;

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
}
