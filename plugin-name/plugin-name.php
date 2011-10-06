<?php
/*
Plugin Name: Plugin Name Here
Plugin URI: http://example.com/wordpress-plugins/my-plugin
Description: A brief description of the plugin here
Version: 1.0
Author: Author's Name
Author URI: http://example.com
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

register_activation_hook( __FILE__, 'prefix_plugin_name_activate' );	// CHANGE PREFIX!!

function prefix_plugin_name_activate() {	//	CHANGE PREFIX!!
    // Check for WordPress version compatibility
    if ( version_compare( get_bloginfo( 'version' ), '3.3', '<' ) ) {// UPDATE VERSION

            //SEND ALERT TO USER ATTEMPTING TO ACTIVATE

            deactivate_plugins( basename(__FILE__ ) );  //Deactivation
    }

	$prefix_plugin_name_options = array(	// CHANGE PREFIX!!
		//	OPTIONS GO HERE
	);
	update_option( 'prefix_plugin_name_options', $prefix_plugin_name_options );	//	CHANGE PREFIX!!
	
    //	DO MORE STUFF HERE
}

/*
 *	DEACTIVATION
 */

 register_deactivation_hook( __FILE__,'prefix_plugin_name_deactivate' );	//	CHANGE PREFIX!!

 function prefix_plugin_name_deactivate(){	// CHANGE PREFIX!!
 	// DO STUFF HERE
 }

/*
 *  PLUGINS_LOADED HOOK
 */

 add_action('plugins_loaded', 'prefix_plugin_name_plugin_setups' );    //  CHANGE PREFIX!!

 function prefix_plugin_name_plugin_setups(){   //  CHANGE PREFIX!
     // WordPress hasn't fully loaded yet.
     // DO PLUGINS_LOADED STUFF HERE.
 }

/*
 *  INIT HOOK
 */

 add_action('init', 'prefix_plugin_name_init' );    //  CHANGE PREFIX!!

 function prefix_plugin_name_init(){   //  CHANGE PREFIX!
     // WordPress is loaded now.
     // DO STUFF HERE
 }


/*
 *  ADMIN_MENU HOOK
 */

 add_action('admin_menu', 'prefix_plugin_name_admin_menu' );    //  CHANGE PREFIX!!

 function prefix_plugin_name_admin_menu(){   //  CHANGE PREFIX!
     // Called when in the admin section.
     // DO ADMIN MENU SETUP AND OTHER BACKEND WORK HERE.
 }


/*
 *  TEMPLATE_REDIRECT HOOK
 */

 add_action('template_redirect', 'prefix_plugin_name_page_setups' );    //  CHANGE PREFIX!!

 function prefix_plugin_name_page_setups(){   //  CHANGE PREFIX!
     // WordPress now knows what page we're viewing.
     // This only happens in the front-end.
     // DO FRONT-END PAGE VIEW-SPECIFIC STUFF HERE.
 }


/*
 *  WP_HEAD HOOK
 */

 add_action('wp_head', 'prefix_plugin_name_wp_head' );    //  CHANGE PREFIX!!

 function prefix_plugin_name_wp_head(){   //  CHANGE PREFIX!
     // WordPress is now compiling information to appear before the <body> tag.
     // DO STUFF TO PUT ANYTHING NECESSARY IN THE HEAD TAG HERE.
 }


/*
 *	MORE PLUGIN CODE
 */



?>