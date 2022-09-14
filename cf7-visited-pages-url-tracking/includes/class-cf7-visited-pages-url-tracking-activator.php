<?php

/**
 * Fired during plugin activation
 *
 * @link       https://profiles.wordpress.org/thechetanvaghela/
 * @since      1.0.0
 *
 * @package    Cf7_Visited_Pages_Url_Tracking
 * @subpackage Cf7_Visited_Pages_Url_Tracking/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Cf7_Visited_Pages_Url_Tracking
 * @subpackage Cf7_Visited_Pages_Url_Tracking/includes
 * @author     Chetan Vaghela <ckvaghela92@gmail.com>
 */
class Cf7_Visited_Pages_Url_Tracking_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		if ( !in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				
			// Deactivate the plugin
			deactivate_plugins(plugin_basename( __FILE__ ));
			
			
			// Throw an error in the wordpress admin console
			$error_message = __('CF7 Visited Pages URL Tracking requires <a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">Contact Form 7</a> plugin to be active!', 'cf7-visited-pages-url-tracking');
			die($error_message);
			
		}

	}

}
