<?php
defined( 'ABSPATH' ) or die();


function rsssl_premium_security_notices( $notices ) {
	global $wpdb;
	if ( $wpdb->prefix === 'wp_' && get_option('rsssl_db_prefix_rename_failed') ) {
		$notices['rename_db_failed'] = array(
			'condition' => [ 'wp_option_rsssl_db_prefix_rename_failed' ],
			'callback' => '_true_',
			'score' => 5,
			'output' => array(
				'true' => array(
					'msg'  => __( 'You have enabled the "Rename and randomize your database prefix" option, but the attempt to do this has failed. The option has been disabled.', "really-simple-ssl" ),
					'icon' => 'warning',
					'dismissible' => true,
				),
			),
			'show_with_options' => [
				'rename_db_prefix',
			],
		);
	}

	return $notices;
}
add_filter( 'rsssl_notices', 'rsssl_premium_security_notices' );
