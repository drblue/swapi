<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CrawlSwapiData extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'swapi:crawl {--resource=}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Crawl swapi.dev and store data in the filesystem as json';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		// Get resource to crawl from the command line
		$resource = $this->option('resource');
		$results = collect();

		// Get the first page of the resource
		$url = "https://swapi.dev/api/{$resource}/";
		$response = Http::get($url);
		$this->log("info", "Got response from {$url}: {$response->status()}");
		$data = $response->json();

		$results = $results->merge($data['results']);

		// Get the next page of the resource
		while ($data['next']) {
			$url = $data['next'];
			$response = Http::get($url);
			$this->log("info", "Got response from {$url}: {$response->status()}");
			$data = $response->json();

			$results = $results->merge($data['results']);
		}

		// Store the results in the filesystem as json
		// N.B. Files need to be cleaned up manually, i.e. replace "url" with "id" and remove all URLs
		// Also - homeworld needs to be renamed to homeworld_id 😅
		Storage::put("{$resource}.json", $results->toJson());

		// Log the results
		$this->log("info", "Stored {$resource} in the filesystem");
	}

	/**
	 * Helper to log both to the console and the log file.
	 */
	private function log($verbosity = "info", $message)
	{
		$this->$verbosity($message);
		Log::{$verbosity}($message);
	}
}
