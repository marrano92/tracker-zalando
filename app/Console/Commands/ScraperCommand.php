<?php

namespace App\Console\Commands;

use Goutte\Client;
use Illuminate\Console\Command;
use Symfony\Component\HttpClient\HttpClient;

class ScraperCommand extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'scraper:start';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Start scraper to analyze all the prices for each product selected.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle() {
		Log:info('Start Scraper');

		$client = new Client( HttpClient::create(
			[ 'timeout' => 60 ]
		) );
		$crawler = $client->request('GET', 'https://www.zalando.it/uomo-home/');
		$crawler->filter('h2')->each(function ($node) {
			print $node->text()."\n";
		});
	}
}
