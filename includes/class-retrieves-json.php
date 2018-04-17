<?php

namespace ByRobots\CleverEnqueue;

class Retrieves_JSON {
	/**
	 * Grab a JSON file and convert it to it's PHP equivalent.
	 *
	 * @param string $file
	 *
	 * @return object
	 * @throws \Exception
	 */
	public function retrieve( $file ) {
		if ( ! file_exists( $file ) ) {
			throw new \Exception( $file . ' not found.' );
		}

		$fileContents = file_get_contents( $file );
		$json         = json_decode( $fileContents );

		if ( json_last_error() === JSON_ERROR_NONE ) {
			return $json;
		}

		throw new \Exception( 'JSON passed was invalid.' );
	}
}
