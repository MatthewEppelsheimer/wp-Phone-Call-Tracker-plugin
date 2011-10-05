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
 *	MORE PLUGIN CODE
 */



?>