<?php
/**
 * Plugin Name: Order Posts per Taxonomy
 * Description: Order posts separately for each taxonomy
 * Version: 1.5.0
 * Plugin URI: https://wpsmartlab.com/
 * Author: WPSmartLab
 * Author URI: https://wpsmartlab.com/
 * Text Domain: cps
 * Domain Path: /languages/
 * Requires at least: 5.5
 * Tested up to: 6.1
 * Requires PHP: 7.0
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly

use WPSL\PostsOrder\Dashboard\Settings;
use WPSL\PostsOrder\PostsOrder;

defined( 'ABSPATH' ) || exit;

function wpsl_posts_order() {
	$file = __FILE__;
	load_plugin_textdomain( 'cps', false, basename( dirname( $file ) ) . '/languages' );
	include dirname( $file ) . '/src/PostsOrder.php';
	include dirname( $file ) . '/src/Dashboard/Settings.php';
	if ( is_admin() ) {
		new Settings();
	}
	new PostsOrder( $file );
}

add_action( 'plugins_loaded', 'wpsl_posts_order', 99 );
