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
	 * Set-up tests.
	 */
	public function setUp() {
		parent:: setUp();

		$this->load_interfaces();
	}

	/**
	 * Load interfaces.
	 */
	private function load_interfaces() {
		foreach ( $this->interfaces as $interface => $definition ) {
			if ( !interface_exists( $interface ) ) {
				require $definition;
			}
		}
	}
}
