<?php
/**
 * Ties everything together.
 *
 * @package ByRobots\CleverEnqueue
 */

namespace ByRobots\CleverEnqueue;

/**
 * Class Clever_Enqueue
 */
class Processes_File {
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
	public function __construct( WordPress_Invoker $invoker ) {
		// Add the invoker.
		$this->invoker = is_null( $invoker ) ? new WordPress_Invoker : $invoker;
	}

	/**
	 * Attempts to load assets.
	 *
	 * @param string $path_to_json The path the the JSON file.
	 */
	public function load_assets( $path_to_json ) {
		$retrieves_json = new Retrieves_JSON;

		try {
			$retrieved_json = $retrieves_json->retrieve( $path_to_json );
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
