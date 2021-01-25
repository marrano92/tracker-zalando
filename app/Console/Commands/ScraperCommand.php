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
		Log:
		info( 'Start Scraper' );

		$products = [
			'https://www.zalando.it/gabba-pisa-redue-pants-pantaloni-grey-check-g5022e00y-c11.html',
			'https://www.zalando.it/kings-will-dream-bolo-smart-joggers-pantaloni-grey-kie22e011-c11.html',
		];
		$client   = new Client( HttpClient::create(
			[ 'timeout' => 60 ]
		) );
		foreach ( $products as $request ) {
			$crawler = $client->request( 'GET', $request );
			$crawler->filter( '#z-vegas-pdp-props' )->each( function ( $node ) {
				$json = str_replace( "<![CDATA[", "", $node->text() );
				$json = str_replace( "]]>", "", $json );
				$obj =  json_decode( $json );
				print  'Nome prodotto: ' . $obj->model->articleInfo->name . "\n";
				print 'Marca prodotto: ' .$obj->model->articleInfo->brand->name . "\n";
				print 'Prezzo prodotto: ' .$obj->model->articleInfo->displayPrice->price->formatted . "\n";
			} );
		}
	}
}
