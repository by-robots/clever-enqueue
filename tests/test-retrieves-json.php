<?php

namespace ByRobots\CleverEnqueue\Tests;

class Retrieves_JSON extends \WP_UnitTestCase {
	/**
	 * @var \ByRobots\CleverEnqueue\Retrieves_JSON
	 */
	private $class;

	/**
	 * Set-up the tests.
	 */
	public function setUp() {
		parent::setUp();

		if ( ! class_exists( '\ByRobots\CleverEnqueue\Retrieves_JSON' ) ) {
			include __DIR__ . '/../includes/class-retrieves-json.php';
		}

		$this->class = new \ByRobots\CleverEnqueue\Retrieves_JSON;
	}

	/**
	 * Test JSON is retrieved when the file exists.
	 */
	public function testExists() {
		$result = $this->class->retrieve( __DIR__ . '/testdata/retrieves-json.json' );
		$this->assertTrue( is_object( $result ) );
	}

	/**
	 * When the file does not exist an exception should be thrown.
	 */
	public function testDoesntExist() {
		$this->expectException( \Exception::class );
		$this->class->retrieve( __DIR__ . '/testdata/abc123.json' );
	}

	/**
	 * Test invalid JSON is handled responsibly.
	 */
	public function testInvalidJSON() {
		$this->expectException( \Exception::class );
		$this->class->retrieve( __DIR__ . '/testdata/invalid-json.json' );
	}
}
