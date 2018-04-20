<?php
/**
 * Check if the ID is an excluded from loading the file. Basically the opposite
 * of Matches_ID.
 *
 * @package ByRobots\CleverEnqueue
 */

namespace ByRobots\CleverEnqueue\Rules;

use ByRobots\CleverEnqueue\Interfaces\Rule_Interface;

/**
 * Class Except_ID
 */
class Except_ID implements Rule_Interface {
	/**
	 * @inheritDoc
	 */
	public function passes( $post, \stdClass $rule ) {
		if ( !in_array( $post->ID, $rule->values ) ) {
			return true;
		}

		return false;
	}
}
