<?php

namespace ByRobots\CleverEnqueue\Tests\Rules;

use ByRobots\CleverEnqueue\Tests\Test_Case;

class Retrieves_JSON extends Test_Case {
	/**
	 * @var \ByRobots\CleverEnqueue\Interfaces\Rule_Interface
	 */
	private $rule;

	/**
	 * @var \stdClass
	 */
	private $testData;

	/**
	 * Set-up the rule class to test with.
	 */
	public function setUp() {
		parent::setUp();

		if ( ! class_exists( '\ByRobots\CleverEnqueue\Rules\Matches_ID' ) ) {
			include __DIR__ . '/../../includes/rules/class-matches-id.php';
		}

		$this->rule     = new \ByRobots\CleverEnqueue\Rules\Matches_ID;
		$this->testData = json_decode( file_get_contents( __DIR__ . '/../testdata/matches-id.json' ) );
	}

	/**
	 * If the IP of the current page matches the rule should pass.
	 */
	public function test_passes() {
		$post     = \Mockery::mock(\stdClass::class);
		$post->ID = 123;

		$this->assertTrue($this->rule->passes($post, $this->testData));
	}
}
