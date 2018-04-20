<?php
/**
 * Takes a file entry from the JSON file and evaluates if it should be loaded
 * based on the rules present.
 *
 * @package ByRobots\CleverEnqueue
 */

namespace ByRobots\CleverEnqueue;

/**
 * Evaluates_File Class.
 */
class Evaluates_File {
	/**
	 * Receive a file entry and evaluate the rules.
	 *
	 * @param \WP_Post $post The post to evaluate against.
	 * @param object   $file The file entry.
	 *
	 * @param bool TRUE if the file should be loaded.
	 */
	public function shouldLoad( $post, \stdClass $file ) {
		//
	}
}
