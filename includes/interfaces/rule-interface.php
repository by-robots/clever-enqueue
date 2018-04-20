<?php
/**
 * Define how the rule classes should be implemented.
 *
 * @package ByRobots\CleverEnqueue
 */

namespace ByRobots\CleverEnqueue\Interfaces;

/**
 * Interface Rule_Interface
 */
interface Rule_Interface {
	/**
	 * Decide if the given rule applies.
	 *
	 * @param \WP_Post  $post The post to check against.
	 * @param \stdClass $rule The individual rule to check.
	 *
	 * @return bool TRUE if the rule passes (i.e. file should be enqueued).
	 */
	public function passes( \WP_Post $post, \stdClass $rule );
}
