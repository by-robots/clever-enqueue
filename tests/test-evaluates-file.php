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
	 * When only one rule is present in a file entry, and it matches the post,
	 * the class should decide the file is to be loaded.
	 */
	public function test_one_matching_rule() {
		$rule     = json_decode( file_get_contents( __DIR__ . '/testdata/files/single-rule.json' ) );
		$post     = \Mockery::mock( \stdClass::class );
		$post->ID = 123;

		$this->assertTrue( $this->class->should_load( $post, $rule ) );
	}

	/**
	 * When only one rule is present in a file entry, and it does not match the
	 * post, the class should decide the file is to be loaded.
	 */
	public function test_one_non_matching_rule() {
		$rule     = json_decode( file_get_contents( __DIR__ . '/testdata/files/single-rule.json' ) );
		$post     = \Mockery::mock( \stdClass::class );
		$post->ID = 321;

		$this->assertFalse( $this->class->should_load( $post, $rule ) );
	}

	/**
	 * When two rules conflict the class should decide not to load the file.
	 */
	public function test_conflicting_rules() {
		$rule     = json_decode( file_get_contents( __DIR__ . '/testdata/files/conflicting-rules.json' ) );
		$post     = \Mockery::mock( \stdClass::class );
		$post->ID = 123;

		$this->assertFalse( $this->class->should_load( $post, $rule ) );
	}
}
