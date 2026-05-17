<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddSequelTrilogyFilms extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$this->upsertRows('planets', $this->planets());
		$this->upsertRows('species', $this->species());
		$this->upsertRows('people', $this->people());
		$this->upsertRows('starships', $this->starships());
		$this->upsertRows('vehicles', $this->vehicles());
		$this->upsertRows('films', $this->films());

		$this->linkRows('film_person', 'film_id', 'person_id', $this->filmPeople());
		$this->linkRows('film_planet', 'film_id', 'planet_id', $this->filmPlanets());
		$this->linkRows('film_species', 'film_id', 'species_id', $this->filmSpecies());
		$this->linkRows('film_starship', 'film_id', 'starship_id', $this->filmStarships());
		$this->linkRows('film_vehicle', 'film_id', 'vehicle_id', $this->filmVehicles());
		$this->linkRows('person_species', 'person_id', 'species_id', $this->personSpecies());
		$this->linkRows('person_starship', 'person_id', 'starship_id', $this->personStarships());
		$this->linkRows('person_vehicle', 'person_id', 'vehicle_id', $this->personVehicles());
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$filmIds = [7, 8, 9];
		$personIds = range(84, 108);
		$planetIds = range(61, 72);
		$speciesIds = range(38, 41);
		$starshipIds = range(76, 84);
		$vehicleIds = range(77, 80);

		DB::table('film_person')->whereIn('film_id', $filmIds)->delete();
		DB::table('film_planet')->whereIn('film_id', $filmIds)->delete();
		DB::table('film_species')->whereIn('film_id', $filmIds)->delete();
		DB::table('film_starship')->whereIn('film_id', $filmIds)->delete();
		DB::table('film_vehicle')->whereIn('film_id', $filmIds)->delete();
		DB::table('person_species')->whereIn('person_id', $personIds)->delete();
		DB::table('person_starship')->whereIn('person_id', $personIds)->delete();
		DB::table('person_vehicle')->whereIn('person_id', $personIds)->delete();

		DB::table('films')->whereIn('id', $filmIds)->delete();
		DB::table('people')->whereIn('id', $personIds)->delete();
		DB::table('species')->whereIn('id', $speciesIds)->delete();
		DB::table('starships')->whereIn('id', $starshipIds)->delete();
		DB::table('vehicles')->whereIn('id', $vehicleIds)->delete();
		DB::table('planets')->whereIn('id', $planetIds)->delete();
	}

	private function upsertRows($table, array $rows)
	{
		foreach ($rows as $row) {
			$id = $row['id'];
			unset($row['id']);

			DB::table($table)->updateOrInsert(['id' => $id], $row);
		}
	}

	private function linkRows($table, $leftColumn, $rightColumn, array $rows)
	{
		foreach ($rows as $row) {
			DB::table($table)->updateOrInsert([
				$leftColumn => $row[0],
				$rightColumn => $row[1],
			], []);
		}
	}

	private function timestamp()
	{
		return '2026-05-15T12:00:00.000000Z';
	}

	private function films()
	{
		$timestamp = $this->timestamp();

		return [
			[
				'id' => 7,
				'title' => 'The Force Awakens',
				'episode_id' => '7',
				'opening_crawl' => "Luke Skywalker has vanished.\r\nIn his absence, the sinister\r\nFIRST ORDER has risen from\r\nthe ashes of the Empire\r\nand will not rest until\r\nSkywalker, the last Jedi,\r\nhas been destroyed.\r\n\r\nWith the support of the\r\nREPUBLIC, General Leia Organa\r\nleads a brave RESISTANCE.\r\nShe is desperate to find her\r\nbrother Luke and gain his\r\nhelp in restoring peace\r\nand justice to the galaxy.\r\n\r\nLeia has sent her most daring\r\npilot on a secret mission\r\nto Jakku, where an old ally\r\nhas discovered a clue to\r\nLuke's whereabouts....",
				'director' => 'J. J. Abrams',
				'producer' => 'Kathleen Kennedy, J. J. Abrams, Bryan Burk',
				'release_date' => '2015-12-18',
				'image_url' => 'https://www.themoviedb.org/t/p/w1280/wqnLdwVXoBjKibFRR5U3y0aDUhs.jpg',
				'short_description' => 'A scavenger, a defecting stormtrooper, and the Resistance confront the rise of the First Order while searching for Luke Skywalker.',
				'long_description' => 'Thirty years after the fall of the Galactic Empire, the First Order searches for Luke Skywalker and threatens the New Republic. Rey, Finn, Han Solo, Chewbacca, and the Resistance race to deliver a map fragment while Starkiller Base becomes a new galactic threat.',
				'created' => $timestamp,
				'edited' => $timestamp,
			],
			[
				'id' => 8,
				'title' => 'The Last Jedi',
				'episode_id' => '8',
				'opening_crawl' => "The FIRST ORDER reigns.\r\nHaving decimated the peaceful\r\nRepublic, Supreme Leader Snoke\r\nnow deploys his merciless\r\nlegions to seize military\r\ncontrol of the galaxy.\r\n\r\nOnly General Leia Organa's\r\nband of RESISTANCE fighters\r\nstand against the rising\r\ntyranny, certain that Jedi\r\nMaster Luke Skywalker will\r\nreturn and restore a spark of\r\nhope to the fight.\r\n\r\nBut the Resistance has been\r\nexposed. As the First Order\r\nspeeds toward the rebel base,\r\nthe brave heroes mount a\r\ndesperate escape....",
				'director' => 'Rian Johnson',
				'producer' => 'Kathleen Kennedy, Ram Bergman',
				'release_date' => '2017-12-15',
				'image_url' => 'https://www.themoviedb.org/t/p/w1280/kOVEVeg59E0wsnXmF9nrh6OmWII.jpg',
				'short_description' => 'The Resistance flees the First Order while Rey seeks Luke Skywalker and Kylo Ren struggles with his allegiance.',
				'long_description' => 'After Starkiller Base is destroyed, the First Order pursues the surviving Resistance fleet. Rey trains with Luke Skywalker on Ahch-To, Kylo Ren challenges Supreme Leader Snoke, and the final survivors make a last stand on Crait.',
				'created' => $timestamp,
				'edited' => $timestamp,
			],
			[
				'id' => 9,
				'title' => 'The Rise of Skywalker',
				'episode_id' => '9',
				'opening_crawl' => "The dead speak!\r\nThe galaxy has heard a\r\nmysterious broadcast,\r\na threat of REVENGE in the\r\nsinister voice of the late\r\nEMPEROR PALPATINE.\r\n\r\nGENERAL LEIA ORGANA\r\ndispatches secret agents to\r\ngather intelligence, while Rey,\r\nthe last hope of the Jedi,\r\ntrains for battle against\r\nthe diabolical FIRST ORDER.\r\n\r\nMeanwhile, Supreme Leader\r\nKylo Ren rages in search\r\nof the phantom Emperor,\r\ndetermined to destroy any\r\nthreat to his power....",
				'director' => 'J. J. Abrams',
				'producer' => 'Kathleen Kennedy, J. J. Abrams, Michelle Rejwan',
				'release_date' => '2019-12-20',
				'image_url' => 'https://www.themoviedb.org/t/p/w1280/db32LaOibwEliAmSL2jjDF6oDdj.jpg',
				'short_description' => 'The Resistance faces the Final Order as Rey discovers her lineage and the conflict with Kylo Ren reaches its end.',
				'long_description' => 'With Emperor Palpatine revealed on Exegol, Rey, Finn, Poe Dameron, and their allies search for the Sith wayfinder that can lead the Resistance to the hidden Final Order fleet. The final battle brings together the Resistance, redeemed Ben Solo, and citizens from across the galaxy.',
				'created' => $timestamp,
				'edited' => $timestamp,
			],
		];
	}

	private function people()
	{
		$timestamp = $this->timestamp();

		return [
			$this->person(84, 'Rey', '15ABY', 'hazel', 'brown', '170', '54', 'light', 61, ['Resistance', 'Jedi Order'], 'https://starwars.fandom.com/wiki/Rey_Skywalker', 'https://static.wikia.nocookie.net/starwars/images/2/2b/Rey_TROS_Fathead.png'),
			$this->person(85, 'Finn', '11ABY', 'dark', 'black', '178', '73', 'dark', 28, ['First Order', 'Resistance'], 'https://starwars.fandom.com/wiki/Finn', 'https://static.wikia.nocookie.net/starwars/images/1/1a/Finn-TSWB.png'),
			$this->person(86, 'Poe Dameron', '2ABY', 'brown', 'brown', '172', '80', 'light', 72, ['New Republic', 'Resistance'], 'https://starwars.fandom.com/wiki/Poe_Dameron', 'https://static.wikia.nocookie.net/starwars/images/6/6b/PoeDameron-Heroes2023.png'),
			$this->person(87, 'BB-8', 'unknown', 'black', 'none', '67', '18', 'white, orange', 28, ['Resistance'], 'https://starwars.fandom.com/wiki/BB-8', 'https://static.wikia.nocookie.net/starwars/images/6/68/BB8-Fathead.png'),
			$this->person(88, 'Kylo Ren', '5ABY', 'brown', 'black', '189', '89', 'light', 2, ['New Jedi Order', 'Knights of Ren', 'First Order'], 'https://starwars.fandom.com/wiki/Ben_Solo', 'https://static.wikia.nocookie.net/starwars/images/b/bc/KyloRenVFcover-TROS.png'),
			$this->person(89, 'Snoke', 'unknown', 'blue', 'none', '218', 'unknown', 'pale', 67, ['First Order'], 'https://starwars.fandom.com/wiki/Snoke', 'https://static.wikia.nocookie.net/starwars/images/f/f0/Snoke-TLJOCE.png'),
			$this->person(90, 'Maz Kanata', '973BBY', 'yellow', 'white', '124', 'unknown', 'orange', 63, ['Maz Kanata\'s castle', 'Resistance'], 'https://starwars.fandom.com/wiki/Maz_Kanata', 'https://static.wikia.nocookie.net/starwars/images/5/53/MazKanata-TROSGG.png'),
			$this->person(91, 'General Hux', '0ABY', 'blue', 'red', '185', 'unknown', 'light', 28, ['First Order'], 'https://starwars.fandom.com/wiki/Armitage_Hux', 'https://static.wikia.nocookie.net/starwars/images/d/d0/HuxTLJPromo.png'),
			$this->person(92, 'Captain Phasma', 'unknown', 'blue', 'blonde', '200', 'unknown', 'light', 28, ['First Order'], 'https://starwars.fandom.com/wiki/Phasma', 'https://static.wikia.nocookie.net/starwars/images/0/02/Phasma.png'),
			$this->person(93, 'Rose Tico', 'unknown', 'brown', 'black', '160', 'unknown', 'light', 28, ['Resistance'], 'https://starwars.fandom.com/wiki/Rose_Tico', 'https://static.wikia.nocookie.net/starwars/images/a/a8/RoseTico-RotR.png'),
			$this->person(94, 'Vice Admiral Holdo', 'unknown', 'blue', 'purple', '170', 'unknown', 'light', 28, ['Resistance'], 'https://starwars.fandom.com/wiki/Amilyn_Holdo', 'https://static.wikia.nocookie.net/starwars/images/8/83/Holdo-Portfolio.png'),
			$this->person(95, 'DJ', 'unknown', 'brown', 'black', '180', 'unknown', 'light', 28, [], 'https://starwars.fandom.com/wiki/DJ', 'https://static.wikia.nocookie.net/starwars/images/d/d5/TLJ-DJ-Movie-no.jpg'),
			$this->person(96, 'Jannah', 'unknown', 'brown', 'black', '170', 'unknown', 'dark', 71, ['First Order', 'Company 77', 'Resistance'], 'https://starwars.fandom.com/wiki/Jannah', 'https://static.wikia.nocookie.net/starwars/images/7/78/Jannah-HeroesResistance.png'),
			$this->person(97, 'Zorii Bliss', 'unknown', 'unknown', 'unknown', '170', 'unknown', 'unknown', 69, ['Spice Runners of Kijimi'], 'https://starwars.fandom.com/wiki/Zorii_Bliss', 'https://static.wikia.nocookie.net/starwars/images/0/08/ZoriiBliss-TSWB.png'),
			$this->person(98, 'D-O', 'unknown', 'black', 'none', 'unknown', 'unknown', 'white, green', 28, ['Resistance'], 'https://starwars.fandom.com/wiki/D-O', 'https://static.wikia.nocookie.net/starwars/images/9/91/D-O_Fathead.png'),
			$this->person(99, 'Lor San Tekka', 'unknown', 'blue', 'white', 'unknown', 'unknown', 'light', 61, ['Church of the Force'], 'https://starwars.fandom.com/wiki/Lor_San_Tekka', 'https://static.wikia.nocookie.net/starwars/images/d/d8/LorSanTekka-SWTimelines.png'),
			$this->person(100, 'Unkar Plutt', 'unknown', 'black', 'none', 'unknown', 'unknown', 'green', 61, ['Niima Outpost'], 'https://starwars.fandom.com/wiki/Unkar_Plutt', 'https://static.wikia.nocookie.net/starwars/images/b/b7/Unkar_Plutt-RO_U_Visual_Guide.png'),
			$this->person(101, 'Teedo', 'unknown', 'black', 'none', 'unknown', 'unknown', 'unknown', 61, [], 'https://starwars.fandom.com/wiki/Teedo', 'https://static.wikia.nocookie.net/starwars/images/b/b8/Teedo-TFUVD.png'),
			$this->person(102, 'Snap Wexley', 'unknown', 'brown', 'brown', 'unknown', 'unknown', 'light', 28, ['New Republic', 'Resistance'], 'https://starwars.fandom.com/wiki/Temmin_Wexley', 'https://static.wikia.nocookie.net/starwars/images/2/22/SnapWexley-SWI198.png'),
			$this->person(103, 'Lieutenant Connix', 'unknown', 'blue', 'brown', 'unknown', 'unknown', 'light', 28, ['Resistance'], 'https://starwars.fandom.com/wiki/Kaydel_Ko_Connix', 'https://static.wikia.nocookie.net/starwars/images/c/c6/Kaydel_Ko_Connix_TROSOCE.png'),
			$this->person(104, 'Commander D\'Acy', 'unknown', 'brown', 'brown', 'unknown', 'unknown', 'light', 28, ['Resistance'], 'https://starwars.fandom.com/wiki/Larma_D\'Acy', 'https://static.wikia.nocookie.net/starwars/images/5/5a/CommanderDacy-ToppsFinest2023.png'),
			$this->person(105, 'Allegiant General Pryde', 'unknown', 'blue', 'grey', 'unknown', 'unknown', 'light', 28, ['First Order', 'Final Order'], 'https://starwars.fandom.com/wiki/Enric_Pryde', 'https://static.wikia.nocookie.net/starwars/images/0/07/General_Pryde_TROSOCE.png'),
			$this->person(106, 'Beaumont Kin', 'unknown', 'brown', 'brown', 'unknown', 'unknown', 'light', 28, ['Resistance'], 'https://starwars.fandom.com/wiki/Beaumont_Kin', 'https://static.wikia.nocookie.net/starwars/images/9/95/Beaumont_Kin.png'),
			$this->person(107, 'Babu Frik', 'unknown', 'black', 'white', 'unknown', 'unknown', 'tan', 69, ['Anzellan droidsmiths'], 'https://starwars.fandom.com/wiki/Babu_Frik', 'https://static.wikia.nocookie.net/starwars/images/4/40/BabuFrik-ToppsFinest2023.png'),
			$this->person(108, 'Klaud', 'unknown', 'black', 'none', 'unknown', 'unknown', 'green', 28, ['Resistance'], 'https://starwars.fandom.com/wiki/Klaud', 'https://static.wikia.nocookie.net/starwars/images/6/6e/Klaud-AdvancedGraphics.png'),
		];
	}

	private function person($id, $name, $birthYear, $eyeColor, $hairColor, $height, $mass, $skinColor, $homeworldId, array $affiliations, $wikiLink, $imageUrl = null)
	{
		$timestamp = $this->timestamp();

		return [
			'id' => $id,
			'name' => $name,
			'birth_year' => $birthYear,
			'eye_color' => $eyeColor,
			'hair_color' => $hairColor,
			'height' => $height,
			'mass' => $mass,
			'skin_color' => $skinColor,
			'wiki_link' => $wikiLink,
			'image_url' => $imageUrl,
			'affiliations' => json_encode($affiliations),
			'short_description' => $name . ' appears in the Star Wars sequel trilogy.',
			'long_description' => $name . ' is part of the sequel-era conflict between the Resistance, the First Order, and the restored Sith threat.',
			'force_alignment' => in_array($id, [84, 88, 89]) ? ($id === 84 ? 'light' : 'dark') : null,
			'lightsaber_color' => $id === 84 ? 'blue, yellow' : ($id === 88 ? 'red, blue' : null),
			'created' => $timestamp,
			'edited' => $timestamp,
			'homeworld_id' => $homeworldId ?: 28,
		];
	}

	private function planets()
	{
		return [
			$this->planet(61, 'Jakku', 'unknown', 'unknown', 'unknown', 'arid', 'standard', 'deserts', 'unknown', '25000'),
			$this->planet(62, 'Starkiller Base', 'unknown', 'unknown', 'unknown', 'frozen', 'standard', 'ice, forests, mountains', 'unknown', 'unknown'),
			$this->planet(63, 'Takodana', 'unknown', 'unknown', 'unknown', 'temperate', 'standard', 'forests, lakes', 'unknown', 'unknown'),
			$this->planet(64, 'D\'Qar', 'unknown', 'unknown', 'unknown', 'temperate', 'standard', 'forests, lakes', 'unknown', 'unknown'),
			$this->planet(65, 'Ahch-To', 'unknown', 'unknown', 'unknown', 'temperate', 'standard', 'islands, oceans', 'unknown', 'unknown'),
			$this->planet(66, 'Cantonica', 'unknown', 'unknown', 'unknown', 'arid', 'standard', 'deserts, oceans', 'unknown', 'unknown'),
			$this->planet(67, 'Crait', 'unknown', 'unknown', 'unknown', 'arid', 'standard', 'salt flats, mineral plains', 'unknown', 'unknown'),
			$this->planet(68, 'Exegol', 'unknown', 'unknown', 'unknown', 'stormy', 'standard', 'deserts, mountains, lightning fields', 'unknown', 'unknown'),
			$this->planet(69, 'Kijimi', 'unknown', 'unknown', 'unknown', 'frigid', 'standard', 'mountains, cities', 'unknown', 'unknown'),
			$this->planet(70, 'Pasaana', 'unknown', 'unknown', 'unknown', 'arid', 'standard', 'deserts, mesas', 'unknown', 'unknown'),
			$this->planet(71, 'Kef Bir', 'unknown', 'unknown', 'unknown', 'temperate', 'standard', 'oceans, grasslands', 'unknown', 'unknown'),
			$this->planet(72, 'Ajan Kloss', 'unknown', 'unknown', 'unknown', 'humid', 'standard', 'jungles', 'unknown', 'unknown'),
		];
	}

	private function planet($id, $name, $rotation, $orbital, $diameter, $climate, $gravity, $terrain, $surfaceWater, $population)
	{
		$timestamp = $this->timestamp();

		return [
			'id' => $id,
			'name' => $name,
			'rotation_period' => $rotation,
			'orbital_period' => $orbital,
			'diameter' => $diameter,
			'climate' => $climate,
			'gravity' => $gravity,
			'terrain' => $terrain,
			'surface_water' => $surfaceWater,
			'population' => $population,
			'created' => $timestamp,
			'edited' => $timestamp,
			'image_url' => null,
			'short_description' => $name . ' is a sequel-era location.',
			'long_description' => $name . ' appears in the sequel trilogy and is linked to the Resistance, First Order, or Sith Eternal conflict.',
		];
	}

	private function species()
	{
		return [
			$this->speciesRow(38, 'Abednedo', 'sentient', 'sentient', 'unknown', 'unknown', 'black, brown', 'none', 'tan, brown, grey', 'Abednedish', null),
			$this->speciesRow(39, 'Crolute', 'sentient', 'sentient', 'unknown', 'unknown', 'black', 'none', 'pink, tan', 'Crolute', null),
			$this->speciesRow(40, 'Anzellan', 'sentient', 'sentient', 'unknown', 'unknown', 'black', 'white', 'tan', 'Anzellan', null),
			$this->speciesRow(41, 'Vexis', 'reptile', 'sentient', 'unknown', 'unknown', 'black', 'none', 'brown, tan', 'unknown', 70),
		];
	}

	private function speciesRow($id, $name, $classification, $designation, $averageHeight, $averageLifespan, $eyeColors, $hairColors, $skinColors, $language, $homeworldId)
	{
		$timestamp = $this->timestamp();

		return [
			'id' => $id,
			'name' => $name,
			'classification' => $classification,
			'designation' => $designation,
			'average_height' => $averageHeight,
			'average_lifespan' => $averageLifespan,
			'eye_colors' => $eyeColors,
			'hair_colors' => $hairColors,
			'skin_colors' => $skinColors,
			'language' => $language,
			'created' => $timestamp,
			'edited' => $timestamp,
			'homeworld_id' => $homeworldId,
			'image_url' => null,
			'short_description' => $name . ' is a sequel-era species.',
			'long_description' => $name . ' appears in the sequel trilogy films or their connected sequel-era setting.',
		];
	}

	private function starships()
	{
		return [
			$this->starship(76, 'T-70 X-wing fighter', 'T-70 X-wing starfighter', 'starfighter', 'Incom-FreiTek Corporation', '149999', '12.48', '1', '0', '1050', '1', '100', '110', '1 week'),
			$this->starship(77, 'First Order TIE fighter', 'TIE/fo space superiority fighter', 'starfighter', 'Sienar-Jaemus Fleet Systems', 'unknown', '6.69', '1', '0', '1200', 'none', 'unknown', 'unknown', '2 days'),
			$this->starship(78, 'Kylo Ren\'s command shuttle', 'Upsilon-class command shuttle', 'transport', 'Sienar-Jaemus Fleet Systems', 'unknown', '37.2', '6', '20', 'unknown', '1', 'unknown', 'unknown', 'unknown'),
			$this->starship(79, 'Resistance transport', 'Resistance transport', 'transport', 'Incom-FreiTek Corporation', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown'),
			$this->starship(80, 'Finalizer', 'Resurgent-class Star Destroyer', 'Star Destroyer', 'Kuat-Entralla Engineering', 'unknown', '2915.81', '19000', '8000', 'unknown', '2.0', 'unknown', 'unknown', 'unknown'),
			$this->starship(81, 'Raddus', 'MC85 Star Cruiser', 'Star Cruiser', 'Mon Calamari Shipyards', 'unknown', '3438.37', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown'),
			$this->starship(82, 'Supremacy', 'Mega-class Star Dreadnought', 'Star Dreadnought', 'First Order shipyards', 'unknown', '60542.68', '2225000', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown'),
			$this->starship(83, 'TIE silencer', 'TIE/vn space superiority fighter', 'starfighter', 'Sienar-Jaemus Fleet Systems', 'unknown', '17.43', '1', '0', 'unknown', '1', 'unknown', 'unknown', 'unknown'),
			$this->starship(84, 'Bestoon Legacy', 'Oubliette-class transport', 'transport', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown'),
		];
	}

	private function starship($id, $name, $model, $class, $manufacturer, $cost, $length, $crew, $passengers, $speed, $hyperdrive, $mglt, $cargo, $consumables)
	{
		$timestamp = $this->timestamp();

		return [
			'id' => $id,
			'name' => $name,
			'model' => $model,
			'starship_class' => $class,
			'manufacturer' => $manufacturer,
			'cost_in_credits' => $cost,
			'length' => $length,
			'crew' => $crew,
			'passengers' => $passengers,
			'max_atmosphering_speed' => $speed,
			'hyperdrive_rating' => $hyperdrive,
			'MGLT' => $mglt,
			'cargo_capacity' => $cargo,
			'consumables' => $consumables,
			'created' => $timestamp,
			'edited' => $timestamp,
			'image_url' => null,
			'short_description' => $name . ' is a sequel-era starship.',
			'long_description' => $name . ' appears during the Resistance and First Order conflict in the sequel trilogy.',
		];
	}

	private function vehicles()
	{
		return [
			$this->vehicle(77, 'First Order snowspeeder', 'Light infantry utility vehicle', 'speeder', 'First Order', '4.1', 'unknown', '1', '0', '250', 'unknown', 'unknown'),
			$this->vehicle(78, 'V-4X-D ski speeder', 'V-4X-D ski speeder', 'airspeeder', 'Incom Corporation', '8.8', 'unknown', '1', '0', 'unknown', 'unknown', 'unknown'),
			$this->vehicle(79, 'Treadspeeder', '125-Z treadspeeder bike', 'speeder bike', 'Aratech-Loratus Corporation', '4.4', 'unknown', '1', '0', 'unknown', 'unknown', 'unknown'),
			$this->vehicle(80, 'Orbaks', 'Orbak mount', 'mount', 'unknown', 'unknown', 'unknown', '1', '1', 'unknown', 'unknown', 'unknown'),
		];
	}

	private function vehicle($id, $name, $model, $class, $manufacturer, $length, $cost, $crew, $passengers, $speed, $cargo, $consumables)
	{
		$timestamp = $this->timestamp();

		return [
			'id' => $id,
			'name' => $name,
			'model' => $model,
			'vehicle_class' => $class,
			'manufacturer' => $manufacturer,
			'length' => $length,
			'cost_in_credits' => $cost,
			'crew' => $crew,
			'passengers' => $passengers,
			'max_atmosphering_speed' => $speed,
			'cargo_capacity' => $cargo,
			'consumables' => $consumables,
			'created' => $timestamp,
			'edited' => $timestamp,
			'image_url' => null,
			'short_description' => $name . ' is a sequel-era vehicle.',
			'long_description' => $name . ' appears during the sequel trilogy conflict involving the Resistance, First Order, or Sith Eternal forces.',
		];
	}

	private function filmPeople()
	{
		return array_merge(
			$this->pairs(7, [1, 2, 5, 13, 14, 84, 85, 86, 88, 89, 90, 91, 92, 99, 100, 101, 102]),
			$this->pairs(8, [1, 2, 3, 5, 13, 20, 27, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 103, 104]),
			$this->pairs(9, [1, 2, 3, 5, 13, 21, 25, 84, 85, 86, 87, 88, 90, 91, 93, 96, 97, 98, 102, 103, 104, 105, 106, 107, 108])
		);
	}

	private function filmPlanets()
	{
		return array_merge(
			$this->pairs(7, [61, 62, 63, 64]),
			$this->pairs(8, [64, 65, 66, 67]),
			$this->pairs(9, [68, 69, 70, 71, 72])
		);
	}

	private function filmSpecies()
	{
		return array_merge(
			$this->pairs(7, [1, 2, 3, 8, 10, 38, 39]),
			$this->pairs(8, [1, 2, 3, 8, 10, 38]),
			$this->pairs(9, [1, 2, 3, 38, 40, 41])
		);
	}

	private function filmStarships()
	{
		return array_merge(
			$this->pairs(7, [10, 76, 77, 78, 79, 80]),
			$this->pairs(8, [10, 76, 77, 79, 81, 82, 83]),
			$this->pairs(9, [10, 76, 77, 80, 83, 84])
		);
	}

	private function filmVehicles()
	{
		return array_merge(
			$this->pairs(7, [77]),
			$this->pairs(8, [78]),
			$this->pairs(9, [79, 80])
		);
	}

	private function personSpecies()
	{
		return [
			[87, 2],
			[90, 38],
			[98, 2],
			[107, 40],
		];
	}

	private function personStarships()
	{
		return [
			[84, 10],
			[84, 76],
			[86, 76],
			[88, 78],
			[88, 83],
			[13, 10],
		];
	}

	private function personVehicles()
	{
		return [
			[85, 78],
			[93, 78],
			[96, 80],
		];
	}

	private function pairs($left, array $rightValues)
	{
		return array_map(function ($right) use ($left) {
			return [$left, $right];
		}, $rightValues);
	}
}
