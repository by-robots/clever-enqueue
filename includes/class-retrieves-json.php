<?php
/**
 * Responsible for retrieving a JSON file and returning it as a PHP friendly
 * object.
 *
 * @package ByRobots\CleverEnqueue
 */

namespace ByRobots\CleverEnqueue;

/**
 * Retrieves_JSON Class.
 */
class Retrieves_JSON {
	/**
	 * Grab a JSON file and convert it to it's PHP equivalent.
	 *
	 * @param string $file Absolute path to the JSON file.
	 *
	 * @return object
	 * @throws \Exception Exception is thrown in the event of a missing or
	 *                    invalid JSON file.
	 */
	public function retrieve( $file ) {
		if ( ! file_exists( $file ) ) {
			throw new \Exception( $file . ' not found.' );
		}

		$file_contents = file_get_contents( $file );
		$json          = json_decode( $file_contents );

		if ( json_last_error() === JSON_ERROR_NONE ) {
			return $json;
		}

		throw new \Exception( 'JSON passed was invalid.' );
	}
}
