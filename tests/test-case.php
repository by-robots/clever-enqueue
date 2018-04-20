<?php

namespace ByRobots\CleverEnqueue\Tests;

class Test_Case extends \WP_UnitTestCase {
	/**
	 * @var array
	 */
	private $interfaces = [
		'\ByRobots\CleverEnqueue\Interfaces\Rule_Interface' => __DIR__ . '/../includes/interfaces/rule-interface.php',
	];

	/**
	 * We'll use this to partially mock \WP_Post in tests.
	 *
	 * @var \WP_Post
	 */
	protected $WP_Post;

	/**
	 * Set-up tests.
	 */
	public function setUp() {
		parent:: setUp();

		global $post;
		$this->WP_Post = $post;

		foreach ( $this->interfaces as $interface => $definition ) {
			if ( !interface_exists( $interface ) ) {
				require $definition;
			}
		}
	}
}
