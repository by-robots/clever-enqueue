<?php
/**
 * The main plugin class. Sets up hooks.
 *
 * @package ByRobots\CleverEnqueue
 */

namespace ByRobots\CleverEnqueue;

/**
 * Class Clever_Enqueue
 */
class Clever_Enqueue {
	/**
	 * Set-up the plugin.
	 */
	public function __construct() {
		register_activation_hook( WC_PLUGIN_FILE, array( $this, 'install' ) );
	}

	/**
	 * Install the plugin.
	 */
	public function install() {
	}
}
