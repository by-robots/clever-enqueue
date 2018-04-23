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
			$this->load_assets();
		}
	}

	/**
	 * Attempts to load assets.
	 */
	private function load_assets() {
		// Get the JSON config.
		$retrieves_json = new Retrieves_JSON;

		try {
			$retrieved_json = $retrieves_json->retrieve( $this->json_config );
		} catch ( \Exception $e ) {
			// File not found or invalid. Bail out.
			return;
		}

		// Load resources.
		$this->load_asset_type( 'javascript', $retrieved_json->javascript );
		$this->load_asset_type( 'style', $retrieved_json->style );
	}

	/**
	 * Run an asset type.
	 *
	 * @param string $type   Type as asset, i.e. javascript or style.
	 * @param array  $assets Assets to check through.
	 */
	private function load_asset_type( $type, array $assets ) {
		global $post;

		$evaluate          = new Evaluates_File;
		$deregister_method = 'wp_deregister_' . $type;
		$enqueue_method    = 'wp_enqueue_' . $type;

		foreach ( $assets as $asset ) {
			$this->invoker->$deregister_method( $asset->name );

			if ( $evaluate->should_load( $post, $asset ) ) {
				$this->invoker
					->$enqueue_method( $asset->name, get_stylesheet_directory() . '/' . $asset->file, $asset->requires );
			}
		}
	}
}
