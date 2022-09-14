<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://profiles.wordpress.org/thechetanvaghela/
 * @since             1.0.0
 * @package           Cf7_Visited_Pages_Url_Tracking
 *
 * @wordpress-plugin
 * Plugin Name:       CF7 Visited Pages URL Tracking
 * Plugin URI:        https://github.com/thechetanvaghela
 * Description:       Add visited site links to the mail of contact form 7, So admin/user can track that the user had which page visited before submit the form.
 * Version:           1.0.0
 * Author:            Chetan Vaghela
 * Author URI:        https://profiles.wordpress.org/thechetanvaghela/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cf7-visited-pages-url-tracking
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
* deactivate plugin on deactivation of wp-contact-form-7
*/
add_action( 'admin_init', 'cf7vput_deactivate_plugin_conditional' );
function cf7vput_deactivate_plugin_conditional() 
{
	//require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
    if ( !is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) )
  	{
        $plugin = plugin_basename(__FILE__);

        if ( is_plugin_active($plugin) ) {
            deactivate_plugins($plugin);    
        }   
        add_action('admin_notices', 'cf7vput_deactivation_notice');
    }
}

function cf7vput_deactivation_notice() {
	
		$class = 'notice notice-error is-dismissible';
		
		$text    = esc_html__( 'Contact Form 7', 'cf7-visited-pages-url-tracking' );
		$link    = esc_url( add_query_arg( array(
											'tab'       => 'plugin-information',
											'plugin'    => 'contact-form-7',
											'TB_iframe' => 'true',
											'width'     => '640',
											'height'    => '500',
										), admin_url( 'plugin-install.php' ) ) );
		$message = wp_kses( __( "<strong>CF7 Visited Pages URL Tracking</strong> plugin was deactivate due to deactivation of Contact Form 7. Please Install/Active ", 'cf7-visited-pages-url-tracking' ), array( 'strong' => array() ) );
		
		printf( '<div class="%1$s"><p>%2$s <a class="thickbox open-plugin-details-modal" href="%3$s"><strong>%4$s</strong></a></p></div>', $class, $message, $link, $text );
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CF7_VISITED_PAGES_URL_TRACKING_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cf7-visited-pages-url-tracking-activator.php
 */
function activate_cf7_visited_pages_url_tracking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cf7-visited-pages-url-tracking-activator.php';
	Cf7_Visited_Pages_Url_Tracking_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cf7-visited-pages-url-tracking-deactivator.php
 */
function deactivate_cf7_visited_pages_url_tracking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cf7-visited-pages-url-tracking-deactivator.php';
	Cf7_Visited_Pages_Url_Tracking_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cf7_visited_pages_url_tracking' );
register_deactivation_hook( __FILE__, 'deactivate_cf7_visited_pages_url_tracking' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cf7-visited-pages-url-tracking.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cf7_visited_pages_url_tracking() {

	$plugin = new Cf7_Visited_Pages_Url_Tracking();
	$plugin->run();

}
run_cf7_visited_pages_url_tracking();
