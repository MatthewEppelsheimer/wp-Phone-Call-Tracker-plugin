<?php
/*
Plugin Name: Phone Call Tracker
Plugin URI: http://rocketlift.com/software/wordpress-plugins/my-plugin
Description: Tracks mobile phone calls initiated through a website click
Version: 0.2.0
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

function pct_activate() {
    // Check for WordPress version compatibility
    if ( version_compare( get_bloginfo( 'version' ), '3.4', '<' ) ) {

            // SEND ALERT TO USER ATTEMPTING TO ACTIVATE

            deactivate_plugins( basename(__FILE__ ) );  //Deactivation
    }

	$pct_options = array(	
		//	OPTIONS GO HERE
	);
	update_option( 'pct_options', $rli_mle_name_options );	
	
    //	DO MORE STUFF HERE
}

register_activation_hook( __FILE__, 'pct_activate' );	

/*
 *	DEACTIVATION
 */

function pct_deactivate() {	
 	// DO STUFF HERE
}

register_deactivation_hook( __FILE__, 'pct_deactivate' );	

/*
 *  PLUGINS_LOADED HOOK
 */

function pct_plugin_setups() {   
     // WordPress hasn't fully loaded yet.
     // DO PLUGINS_LOADED STUFF HERE.
}

add_action( 'plugins_loaded', 'pct_plugin_setups' );    

/*
 *  HEADER HOOK
 */

function pct_header() {
	if ( ! get_option( 'pct_code_out' ) ) {
		return;
	}
?>
<script type="text/javascript">
  /* <![CDATA[ */
  goog_snippet_vars = function() {
    var w = window;
    w.google_conversion_id = "<?php echo get_option( 'pct_con_id' ); ?>";
    w.google_conversion_label = "<?php echo get_option( 'pct_con_label' ); ?>";
    w.google_remarketing_only = <?php echo ( get_option( 'pct_goog_mark' ) ) ? 'true': 'false'; ?>;
  }
  goog_report_conversion = function(url) {
    goog_snippet_vars();
    window.google_conversion_format = "3";
    window.google_is_call = true;
    var opt = new Object();
    opt.onload_callback = function() {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  }
  var conv_handler = window['google_trackConversion'];
  if (typeof(conv_handler) == 'function') {
    conv_handler(opt);
  }
}
/* ]]> */
</script>
<script type="text/javascript"
  src="//www.googleadservices.com/pagead/conversion_async.js">
</script>

<?php }
add_action( 'wp_head', 'pct_header' ); 


function pct_admin_init() {
	wp_register_script( 'pct-settings-script', plugins_url( '/js/settings-page.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'pct-settings-script' );
}

add_action( 'admin_init', 'pct_admin_init' );

/*
 *  ADMIN_MENU HOOK
 */

function pct_admin_menu() {
	// Called when in the admin section.
	add_submenu_page('options-general.php', __('Phone Call Tracker', 'phone-call-tracker'), __('Phone Call Tracker', 'phone-call-tracker'), 'manage_options', 'phone-call-tracker', 'pct_setting_page' ); 
}

function pct_setting_page() {
	if ( ! current_user_can( 'manage_options' ) ) {  
		wp_die( __('You do not have sufficient permissions to access this page.', 'phone-call-tracker' ) );
	}
	if ( isset( $_POST["update_settings"] ) ) {
		// Do the saving
		
		$goog_code_out = esc_attr( $_POST["goog_code_out"] );
		$goog_code_out = (bool)$goog_code_out;
		update_option( 'pct_code_out', $goog_code_out );
		
		if ( $goog_code_out ) {
		
			$con_id = esc_attr( $_POST["con_id"] );
		
			// validation 
			if ( ! preg_match( '/[^0-9]/', $con_id ) ) {
				update_option( 'pct_con_id', $con_id );
			} else {
				$con_id = get_option( 'pct_con_id' );
			}
		
			$con_label = esc_attr( $_POST["con_label"] );
		
			// validation
			if ( ! preg_match( '/[^a-zA-Z\d]/', $con_label ) ) {
				update_option( 'pct_con_label', $con_label );
			} else {
				$con_label = get_option( 'pct_con_label' );
			}
		
			$goog_remarketing = esc_attr( $_POST["goog_remarketing"] );
			$goog_remarketing = (bool)$goog_remarketing;
			update_option( 'pct_goog_mark', $goog_remarketing );
		} else {
			$con_id = get_option( 'pct_con_id' );
			$con_label = get_option( 'pct_con_label' );
			$goog_remarketing = get_option( 'pct_goog_mark' );
		}
	} else {
		$goog_code_out = get_option( 'pct_code_out' );
		$con_id = get_option( 'pct_con_id' );
		$con_label = get_option( 'pct_con_label' );
		$goog_remarketing = get_option( 'pct_goog_mark' );
	}
	?>
	<div class="wrap">  
	  <?php screen_icon('themes'); ?> <h2><?php echo __('Phone Call Tracker', 'phone-call-tracker');?></h2>
	</div>

    <form method="POST" action="">
    	<label for="goog_code_out"><?php echo __('Enable Google Code Output:', 'phone-call-tracker');?></label>
    	<input type="radio" name="goog_code_out" value="Y" <?php if($goog_code_out){echo 'checked';}?>/>
    	</br>
    	<label><?php echo __('Manual Output Code:', 'phone-call-tracker');?></label>
    	<input type="Radio" name="goog_code_out" value="" <?php if(!$goog_code_out){echo 'checked';} ?>> <span class="description"><?php echo __('Check this box if your theme or another plugin adds your Google tracking code. We will not output the code a second time, but still enable links to call the goog_report_conversion() when someone clicks a phone number link or button.', 'phone-call-tracker');?></span></input>
    	</br>
    	
        <label for="con_id"><?php echo __('Google Conversion ID:', 'phone-call-tracker');?></label> 
        <input <?php if(!$goog_code_out){echo 'disabled';}?> type="text" name="con_id" size="25" value="<?php echo $con_id; ?>" />
        </br>
        <label for="con_label"><?php echo __('Google Conversion Label:', 'phone-call-tracker');?></label> 
        <input <?php if(!$goog_code_out){echo 'disabled';}?> type="text" name="con_label" size="25" value="<?php echo $con_label; ?>" />
        </br>
        <label for="goog_marketing"><?php echo __('Google Remarketing Only:', 'phone-call-tracker');?></label>
        <input <?php if(!$goog_code_out){echo 'disabled';}?> type="checkbox" name="goog_remarketing" value="Y" <?php if($goog_remarketing){echo 'checked';}?>/>
        
        <input type="hidden" name="update_settings" value="Y" />
	    <p>
			<input type="submit" value="<?php echo __('Save settings', 'phone-call-tracker'); ?>" class="button-primary"/>
		</p>
	</form>
</div>
<?php
}

add_action( 'admin_menu', 'pct_admin_menu' );    	

/*
 *  TEMPLATE_REDIRECT HOOK
 */

function pct_page_setups() {   
     // WordPress now knows what page we're viewing.
     // This only happens in the front-end.
     // DO FRONT-END PAGE VIEW-SPECIFIC STUFF HERE.
}

add_action( 'template_redirect', 'pct_page_setups' );    

/*
 *	Shortcode  
 */

function pct_phonenumber( $atts, $content = null ) {
	$schema = '';
	if ( isset( $atts['schema'] ) ) {
		$schema = $atts['schema'];
	} else {
		$schema = 'organization';
	}
	
	$phonenumber = preg_replace( '/\D/', '', $content );
	
	switch ( $schema ) {
		case 'organization':
		case 'organisation':
			$out = '<span itemscope itemtype="http://schema.org/Organization"><a onclick="goog_report_conversion("tel:' . $phonenumber . '");" itemprop="telephone" class="hcard p-tel" href="tel:' . $phonenumber . '">' . $content . '</a></span>';
			break;
		case 'person':
			$out = '<span itemscope itemtype="http://schema.org/Person"><a onclick="goog_report_conversion("tel:' . $phonenumber . '");" itemprop="telephone" class="hcard p-tel" href="tel:' . $phonenumber . '">' . $content . '</a></span>';
			break; 
		default:
			$out = '<a onclick="goog_report_conversion("tel:' . $phonenumber . '");" class="hcard p-tel" href="tel:' . $phonenumber . '">' . $content . '</a>';
			break;
	}
	return $out;
}
add_shortcode( 'phonenumber', 'pct_phonenumber' );

