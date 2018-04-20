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
	 * Decide if the given rule applies.
	 *
	 * @param \WP_Post  $post The post to check against. Note that this isn't
	 *                        type casted so a $post value can be mocked.
	 * @param \stdClass $rule The individual rule to check.
	 *
	 * @return bool TRUE if the rule passes (i.e. file should be enqueued).
	 */
	public function passes( $post, \stdClass $rule ) {
		if ( in_array( $post->ID, $rule->values ) ) {
			return true;
		}

		return false;
	}
}
