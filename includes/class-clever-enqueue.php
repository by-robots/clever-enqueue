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
	 * Class files to include.
	 *
	 * @var array
	 */
	private $files = [
		__DIR__ . '/class-evaluates-file.php',
		__DIR__ . '/class-processes-file.php',
		__DIR__ . '/class-retrieves-json.php',
		__DIR__ . '/class-wordpress-invoker.php',
	];

	/**
	 * JSON config file name.
	 *
	 * @var string
	 */
	private $json_config;

	/**
	 * The WordPress invoker.
	 *
	 * @var WordPress_Invoker
	 */
	private $invoker;

	/**
	 * Set-up the plugin.
	 *
	 * @param WordPress_Invoker $invoker The invoker to use to use WordPress' global functions.
	 */
	public function __construct( WordPress_Invoker $invoker = null ) {
		// The default JSON config file.
		$this->json_config = get_stylesheet_directory() . '/clever-enqueue.json';

		// Load classes.
		foreach ( $this->files as $file ) {
			require_once $file;
		}

		// Add the invoker.
		$this->invoker = is_null( $invoker ) ? new WordPress_Invoker : $invoker;

		// Register hooks.
		$this->invoker->add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Initialise the plugin.
	 */
	public function init() {
		if ( ! $this->invoker->is_admin() ) { // Make sure admin assets aren't messed with.
			$processor = new Processes_File( $this->invoker );
			$processor->load_assets( $this->json_config );
		}
	}
}
