<?php

// Exit if not called when uninstalling plugin
if( !defined( 'WP_UNINSTALL_PLUGIN')  ) {
	exit ();
}

// Delete option from options table
delete_option( 'prefix_options' );

// REMOVE ANY ADDITIONAL OPTIONS AND TABLES

