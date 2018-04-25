<?php

namespace ByRobots\CleverEnqueue\Tests;

use ByRobots\CleverEnqueue\WordPress_Invoker;

class Processes_File extends Test_Case {
	/**
	 * @var \ByRobots\CleverEnqueue\Processes_File
	 */
	private $class;

	/**
	 * Set-up the tests.
	 */
	public function setUp() {
		parent::setUp();

		if ( ! class_exists( '\ByRobots\CleverEnqueue\Processes_File' ) ) {
			include __DIR__ . '/../includes/class-processes-file.php';
		}

		// As we'll be doing some mocking we won't initialise the class here.
	}

	/**
	 * Files should be enqueued.
	 */
	public function test_enqueues_files() {
		// Set the post to test against
		global $post;
		$post     = \Mockery::mock(\stdClass::class);
		$post->ID = 999;

		// Mock the invoker
		$invoker = \Mockery::mock(WordPress_Invoker::class);
		$invoker->shouldReceive('wp_deregister_javascript')->twice();
		$invoker->shouldReceive('wp_enqueue_javascript')->twice();
		$invoker->shouldReceive('wp_deregister_style')->once();
		$invoker->shouldReceive('wp_enqueue_style')->once();

		// Process the file
		$this->class = new \ByRobots\CleverEnqueue\Processes_File($invoker);
		$this->class->load_assets( __DIR__ . '/testdata/full-example.json' );
	}
}
