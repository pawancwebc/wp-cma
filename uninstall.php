<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package     ReduxFramework\Uninstall
 * @author      Dovy Paukstys <info@simplerain.com>
 * @since       3.0.0
 */


// If uninstall, not called from WordPress, then exit
if( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

	$mycustomposts = get_posts( array( 'post_type' => 'req_user', 'number' => 1000) );
	foreach( $mycustomposts as $mypost ) {
	// Delete's each post.
	 wp_delete_post( $mypost->ID, true);
	// Set to False if you want to send them to Trash.
   }

// TODO: Define uninstall functionality here
