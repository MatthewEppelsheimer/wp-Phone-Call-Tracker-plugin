<?php
/*
Plugin Name: Sensor Logs
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

function rlisl_activate() {
    // Check for WordPress version compatibility
    if ( version_compare( get_bloginfo( 'version' ), '3.4', '<' ) ) {

            // SEND ALERT TO USER ATTEMPTING TO ACTIVATE

            deactivate_plugins( basename(__FILE__ ) );  //Deactivation
    }

	$rlisl_options = array(	
		//	OPTIONS GO HERE
	);
	update_option( 'rlisl_options', $rli_mle_name_options );	
	
    //	DO MORE STUFF HERE
}

register_activation_hook( __FILE__, 'rlisl_activate' );	

/*
 *	DEACTIVATION
 */

function rlisl_deactivate() {	
 	// DO STUFF HERE
}

register_deactivation_hook( __FILE__, 'rlisl_deactivate' );	

/*
 *  PLUGINS_LOADED HOOK
 */

function rlisl_plugin_setups() {   
     // WordPress hasn't fully loaded yet.
     // DO PLUGINS_LOADED STUFF HERE.
}

add_action( 'plugins_loaded', 'rlisl_plugin_setups' );    

/*
 *  INIT HOOK
 */

function rlisl_init() {   
     // WordPress is loaded now.
     // DO STUFF HERE
}

add_action( 'init', 'rlisl_init' );    

/*
 *  ADMIN_MENU HOOK
 */

function rlisl_admin_menu() {   
	// Called when in the admin section.
	add_submenu_page('options-general.php', 'Rocket Lift Call Tracker', 'Sensor Logs', 'manage_options', 'rli-sensor-logs', function(){
		if ( ! current_user_can( 'manage_options' ) ) {  
    		wp_die('You do not have sufficient permissions to access this page.');  
		}
		if ( isset( $_POST["update_settings"] ) ) {
			// Do the saving
			
			$goog_code_out = esc_attr( $_POST["goog_code_out"] );
			$goog_code_out = (bool)$goog_code_out;
			update_option( 'rlisl_code_out', $goog_code_out );
			
			$goog_man_code = esc_attr( $_POST["goog_man_code"] );
			$goog_man_code = (bool)$goog_man_code;
			update_option( 'rlisl_man_code', $goog_man_code );
			
			$con_id = esc_attr( $_POST["con_id"] );
			
			// validation 
			if ( ! preg_match( '/[^0-9]/', $con_id ) ) {
				update_option( 'rlisl_con_id', $con_id );
			} else {
				$con_id = get_option( 'rlisl_con_id' );
			}
			
			$con_label = esc_attr( $_POST["con_label"] );
			
			// validation
			if ( ! preg_match( '/[^a-zA-Z\d]/', $con_label ) ) {
				update_option( 'rlisl_con_label', $con_label );
			} else {
				$con_label = get_option( 'rlisl_con_label' );
			}
			
			$goog_remarketing = esc_attr( $_POST["goog_remarketing"] );
			$goog_remarketing = (bool)$goog_remarketing;
			update_option( 'rlisl_goog_mark', $goog_remarketing );
			
		} else {
			$con_id = get_option( 'rlisl_con_id' );
			$con_label = get_option( 'rlisl_con_label' );
			$goog_remarketing = get_option( 'rlisl_goog_mark' );
		}
		?>
		<div class="wrap">  
		  <?php screen_icon('themes'); ?> <h2>Sensor Logs</h2>
		</div>
 
        <form method="POST" action="">
        	<label for="goog_code_out">Enable Google Code Output:</label>
        	<input type="checkbox" name="goog_code_out" value="Y" <?php if($goog_code_out){echo 'checked';}?>/>
        	</br>
        	<label for="goog_man_code">Manual Output Code:</label>
        	<input type="checkbox" name="goog_man_code" value="Y" <?php if($goog_man_code){echo 'checked';}?>/>
        	</br>
        	
            <label for="con_id">Google Conversion ID:</label> 
            <input type="text" name="con_id" size="25" value="<?php echo $con_id; ?>" />
            </br>
            <label for="con_label">Google Conversion Label:</label> 
            <input type="text" name="con_label" size="25" value="<?php echo $con_label; ?>" />
            </br>
            <label for="goog_marketing">Google Remarketing Only:</label>
            <input type="checkbox" name="goog_remarketing" value="Y" <?php if($goog_remarketing){echo 'checked';}?>/>
            
            <input type="hidden" name="update_settings" value="Y" />
		    <p>
				<input type="submit" value="Save settings" class="button-primary"/>
			</p>
		</form>
    </div>
		<?php
	});
}

add_action( 'admin_menu', 'rlisl_admin_menu' );    	

/*
 *  TEMPLATE_REDIRECT HOOK
 */

function rlisl_page_setups() {   
     // WordPress now knows what page we're viewing.
     // This only happens in the front-end.
     // DO FRONT-END PAGE VIEW-SPECIFIC STUFF HERE.
}

add_action( 'template_redirect', 'rlisl_page_setups' );    

/*
 *	MORE PLUGIN CODE
 */


