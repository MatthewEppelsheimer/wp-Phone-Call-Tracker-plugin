<?php
/*
Plugin Name: Plugin Name Here
Plugin URI: http://rocketlift.com/software/wordpress-plugins/my-plugin
Description: A brief description of the plugin here
Version: 1.0
Author: Rocket Lift Incorporated
Author URI: http://rocketlift.com
License: GPLv2
*/

/*  Copyright YEAR  AUTHOR  (email : you@example.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
 *	ACTIVATION
 */

function prefix_activate() {	
    // Check for WordPress version compatibility
    if ( version_compare( get_bloginfo( 'version' ), '3.4', '<' ) ) {

            // SEND ALERT TO USER ATTEMPTING TO ACTIVATE

            deactivate_plugins( basename(__FILE__ ) );  //Deactivation
    }

	$prefix_options = array(	
		//	OPTIONS GO HERE
	);
	update_option( 'prefix_options', $rli_mle_name_options );	
	
    //	DO MORE STUFF HERE
}

register_activation_hook( __FILE__, 'prefix_activate' );	

/*
 *	DEACTIVATION
 */

function prefix_deactivate() {	
 	// DO STUFF HERE
}

register_deactivation_hook( __FILE__, 'prefix_deactivate' );	

/*
 *  PLUGINS_LOADED HOOK
 */

function prefix_plugin_setups() {   
     // WordPress hasn't fully loaded yet.
     // DO PLUGINS_LOADED STUFF HERE.
}

add_action( 'plugins_loaded', 'prefix_plugin_setups' );    

/*
 *  INIT HOOK
 */

function prefix_init() {   
     // WordPress is loaded now.
     // DO STUFF HERE
}

add_action( 'init', 'prefix_init' );    

/*
 *  ADMIN_MENU HOOK
 */

function prefix_admin_menu() {   
     // Called when in the admin section.
     // DO ADMIN MENU SETUP AND OTHER BACKEND WORK HERE.
}

add_action( 'admin_menu', 'prefix_admin_menu' );    

/*
 *  TEMPLATE_REDIRECT HOOK
 */

function prefix_page_setups() {   
     // WordPress now knows what page we're viewing.
     // This only happens in the front-end.
     // DO FRONT-END PAGE VIEW-SPECIFIC STUFF HERE.
}

add_action( 'template_redirect', 'prefix_page_setups' );    

/*
 *  WP_HEAD HOOK
 */

function prefix_wp_head() {   
     // WordPress is now compiling information to appear before the <body> tag.
     // DO STUFF TO PUT ANYTHING NECESSARY IN THE HEAD TAG HERE.
}

add_action( 'wp_head', 'prefix_wp_head' );    

/*
 *	MORE PLUGIN CODE
 */


