<?php
use App\Models\Film;
use App\Models\Person;
use App\Models\Planet;
use App\Models\Species;
use App\Models\Starship;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;

// Films
$items = json_decode(Storage::get('films.json'));
foreach($items as $item) {
    $film = Film::updateOrCreate(
        ['id' => $item->id],
        (array) $item
    );
    dump("Film: {$item->title}");
}

// Planets
$items = json_decode(Storage::get('planets.json'));
foreach($items as $item) {
    $planet = Planet::updateOrCreate(
        ['id' => $item->id],
        (array) $item
    );
    $planet->films()->sync($item->films);

    dump("Planet: {$item->name}");
}

// Species
$items = json_decode(Storage::get('species.json'));
foreach($items as $item) {
    $species = Species::updateOrCreate(
        ['id' => $item->id],
        (array) $item
    );
    $species->films()->sync($item->films);
    
    dump("Species: {$item->name}");
}

// Starships
$items = json_decode(Storage::get('starships.json'));
foreach($items as $item) {
    $starship = Starship::updateOrCreate(
        ['id' => $item->id],
        (array) $item
    );
    $starship->films()->sync($item->films);
    
    dump("Starship: {$item->name}");
}

// Vehicles
$items = json_decode(Storage::get('vehicles.json'));
foreach($items as $item) {
    $vehicle = Vehicle::updateOrCreate(
        ['id' => $item->id],
        (array) $item
    );
    $vehicle->films()->sync($item->films);
    
    dump("Vehicle: {$item->name}");
}

// People
$items = json_decode(Storage::get('people.json'));
foreach($items as $item) {
    $person = Person::updateOrCreate(
        ['id' => $item->id],
        (array) $item
    );
    $person->films()->sync($item->films);
    $person->species()->sync($item->species);
    $person->starships()->sync($item->starships);
    $person->vehicles()->sync($item->vehicles);
    
    dump("Person: {$item->name}");
}
