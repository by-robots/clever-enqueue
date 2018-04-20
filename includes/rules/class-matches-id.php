<?php
/**
 * Check if IDs match.
 *
 * @package ByRobots\CleverEnqueue
 */

namespace ByRobots\CleverEnqueue\Rules;

use ByRobots\CleverEnqueue\Interfaces\Rule_Interface;

/**
 * Class Matches_ID
 */
class Matches_ID implements Rule_Interface {
	/**
	 * @inheritDoc
	 */
	public function passes( $post, \stdClass $rule ) {
		if ( in_array( $post->ID, $rule->values ) ) {
			return true;
		}

		return false;
	}
}
