<?php

/**
 * Plugin Name: Clever Enqueue
 * Plugin URI: https://clever-enqueue.by-robots.com
 * Description: Allows for conditional enqueuing of Javascript and CSS assets in WordPress.
 * Version: 0.1
 * Author: By Robots
 * Author URI: https://www.by-robots.com
 * License: MIT
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include the main WooCommerce class.
if ( ! class_exists( 'Clever_Enqueue' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-clever-enqueue.php';
}

/**
 * Main instance of WooCommerce.
 *
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @since  2.1
 * @return \Clever_Enqueue
 */
function clever_enqueue() {
	return new Clever_Enqueue;
}

// Global for backwards compatibility.
$GLOBALS['clever_enqueue'] = clever_enqueue();