<?php
/**
 * Plugin Name: WP Learn - Form Submissions
 * Description: A plugin to demonstrate creating custom routes and endpoints in the WP REST API.
 * Version: 1.0.0
 *
 * @package wp-learn-form-submissions
 */

require 'class-wpl-rest-form-submissions-controller.php';
add_action( 'rest_api_init', 'wp_learn_register_rest_routes' );
/**
 * Creates a new controller instance and registers the rest routes
 */
function wp_learn_register_rest_routes() {
	$controller = new WPL_REST_Form_Submissions_Controller();
	$controller->register_routes();
}

register_activation_hook( __FILE__, 'wp_learn_setup_table' );
/**
 * Create custom form_submissions table on plugin activation
 */
function wp_learn_setup_table() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'form_submissions';

	$sql = "CREATE TABLE $table_name (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  name varchar (100) NOT NULL,
	  email varchar (100) NOT NULL,
	  PRIMARY KEY  (id)
	)";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );
}
