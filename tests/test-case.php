<?php

namespace ByRobots\CleverEnqueue\Tests;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\Mock;

class Test_Case extends \WP_UnitTestCase {
	use MockeryPHPUnitIntegration;

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
	 * Tear down.
	 */
	public function tearDown() {
		\Mockery::close();
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
