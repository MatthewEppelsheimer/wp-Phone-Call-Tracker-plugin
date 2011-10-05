<?php

// Exit if not called when uninstalling plugin
if( !defined( 'WP_UNINSTALL_PLUGIN')  )	exit ();

// Delete option from options table
delete_option( 'prefix_plugin__name_options' );	// CHANGE PREFIX!

// REMOVE ANY ADDITIONAL OPTIONS AND TABLES

?>