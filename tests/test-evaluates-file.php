<?php

namespace ByRobots\CleverEnqueue\Tests;

class Evaluates_File extends Test_Case {
	/**
	 * @var \ByRobots\CleverEnqueue\Evaluates_File
	 */
	private $class;

	/**
	 * Set-up the tests.
	 */
	public function setUp() {
		parent::setUp();

		if ( ! class_exists( '\ByRobots\CleverEnqueue\Evaluates_File' ) ) {
			include __DIR__ . '/../includes/class-evaluates-file.php';
		}

		$this->class = new \ByRobots\CleverEnqueue\Evaluates_File;
	}

	/**
	 * When only one rule is present in a file entry, and it is valid, the
	 * class should decide the file is to be loaded.
	 */
	public function test_one_successful_rule() {
		$rule     = json_decode( file_get_contents( __DIR__ . '/testdata/files/single-rule.json' ) );
		$post     = \Mockery::mock(\stdClass::class);
		$post->ID = 123;

		$this->assertTrue( $this->class->shouldLoad( $post, $rule ) );
	}
}
