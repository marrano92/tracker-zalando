<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScraperController extends Controller {

	public function start(){

	}

	private function writeToOutputFile() {

		$myfile = fopen(self::getFileName($oem_name), "w");
		fwrite( $myfile, json_encode( self::$offers, JSON_PRETTY_PRINT ) );
	}
}
