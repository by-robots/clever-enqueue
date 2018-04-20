<?php
/**
 * Takes a file entry from the JSON file and evaluates if it should be loaded
 * based on the rules present.
 *
 * @package ByRobots\CleverEnqueue
 */

namespace ByRobots\CleverEnqueue;
use ByRobots\CleverEnqueue\Rules\Except_ID;
use ByRobots\CleverEnqueue\Rules\Matches_ID;

/**
 * Evaluates_File Class.
 */
class Evaluates_File {
	/**
	 * @var \WP_Post
	 */
	private $post;

	/**
	 * Receive a file entry and evaluate the rules.
	 *
	 * @param \WP_Post  $post The post to evaluate against.
	 * @param \stdClass $file The file entry.
	 *
	 * @return bool TRUE if the file should be loaded.
	 */
	public function should_load( $post, \stdClass $file ) {
		$this->post = $post;

		foreach ( $file->rules as $rule ) {
			if ( ! $this->process_rule ( $rule ) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Process a rule entry.
	 *
	 * @param \stdClass $rule
	 *
	 * @return bool
	 */
	private function process_rule ( \stdClass $rule ) {
		switch ( $rule->rule ) {
			case 'matches_id':
				$validator = new Matches_ID;
				break;
			case 'except_id':
				$validator = new Except_ID;
				break;
			default:
				return false;
		}

		return $validator->passes( $this->post, $rule );
	}
}
