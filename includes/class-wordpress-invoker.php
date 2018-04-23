<?php
/**
 * Abstract WordPress' core methods allowing them to be mocked in tests.
 *
 * Thanks to https://exceptionshub.com/tdd-with-wordpress-global-functions-and-phpunit.html
 *
 * @package ByRobots\CleverEnqueue
 */

namespace ByRobots\CleverEnqueue;

/**
 * Class WordPress_Link
 */
class WordPress_Invoker {
	/**
	 * Call a global WordPress method.
	 *
	 * @param string $name      Name of the function to call.
	 * @param array  $arguments Arguments to pass to the function.
	 *
	 * @return mixed
	 */
	public function __call( $name, array $arguments ) {
		return call_user_func_array( $name, $arguments );
	}
}
