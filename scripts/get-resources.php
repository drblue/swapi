<?php
use App\Models\Film;
use App\Models\Person;
use App\Models\Planet;
use App\Models\Species;
use App\Models\Starship;
use App\Models\Vehicle;

//$films = Film::with(['starships'])->get();

$people = Person::with(['homeworld:id,name', 'films:id,title'])->take(10)->get();

//$planets = Planet::with(['residents'])->get();
