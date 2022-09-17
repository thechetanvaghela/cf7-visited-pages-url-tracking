<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/thechetanvaghela/
 * @since      1.0.0
 *
 * @package    Cf7_Visited_Pages_Url_Tracking
 * @subpackage Cf7_Visited_Pages_Url_Tracking/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cf7_Visited_Pages_Url_Tracking
 * @subpackage Cf7_Visited_Pages_Url_Tracking/admin
 * @author     Chetan Vaghela <ckvaghela92@gmail.com>
 */
class Cf7_Visited_Pages_Url_Tracking_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cf7_Visited_Pages_Url_Tracking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cf7_Visited_Pages_Url_Tracking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cf7-visited-pages-url-tracking-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cf7_Visited_Pages_Url_Tracking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cf7_Visited_Pages_Url_Tracking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cf7-visited-pages-url-tracking-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add menu page to admin
	 *
	 * @since    1.0.0
	 */
	public function cf7vput_admin_menu_callback() {
		# add menu page option to admin
		add_menu_page('CF7 - Track visited pages','CF7 - Track visited pages','manage_options','cf7vput_settings_page',array($this,'cf7vput_settings_page_callback'),'dashicons-visibility');
	}

	/**
	 * callback menu page to admin
	 *
	 * @since    1.0.0
	 */
	public function cf7vput_settings_page_callback() 
	{
		?>
		<div class="wrap">
			<div id="cf7vput-setting-container">
				<div id="cf7vput-body">
					<div id="cf7vput-body-content">
						<div class="">
							<form method="post" enctype="multipart/form-data">
               					<div class="cf7vput-container">
               						<div class="cf7vput-container-heading">
               							<h2><?php esc_html_e('CF7 - Track visited pages','cf7-visited-pages-url-tracking'); ?></h2>
               							<hr/>
               						</div>

								   <div  class="cf7vput-active">
								        <h2><?php _e('How to Use?','cf7-visited-pages-url-tracking'); ?></h2>
								        <div class="cf7vput-scroll-progress-bar-wrap">
											<p><?php _e('You need to add <code>[CF7VPUT_VISITED_Details]</code> into mail template of admin.','cf7-visited-pages-url-tracking'); ?> (<a href="<?php echo esc_url(plugin_dir_url( __FILE__ ) . 'images/how-to-use.png');?>" target="_blank">screenshot</a>)</p>
										</div>
								    </div>

									<div  class="cf7vput-active">
								        <h2><?php _e('What is Use?','cf7-visited-pages-url-tracking'); ?></h2>
								        <div class="cf7vput-scroll-progress-bar-wrap">
											<p><?php _e('By doing this, the site owner will be able to see which pages have been visited before submitting a form.','cf7-visited-pages-url-tracking'); ?></p>
										</div>
								    </div>

									<div  class="cf7vput-active">
								        <h2><?php _e('How works plugin?','cf7-visited-pages-url-tracking'); ?></h2>
								        <div class="cf7vput-scroll-progress-bar-wrap">
											<p><?php _e('Users visit pages on the site that are stored in cookies. Once they reach the contact form and submit the form, the links to those previously visited pages are added to the body of the email.','cf7-visited-pages-url-tracking'); ?> (<a href="<?php echo esc_url(plugin_dir_url( __FILE__ ) . 'images/visited-pages-cookie.png');?>" target="_blank">screenshot</a>)</p>
										</div>
								    </div>

									

									<hr/>

								    <div class="cf7vput-our-plugins-section-wrap">
								      	<h2><?php _e('Check other plugins','cf7-visited-pages-url-tracking'); ?></h2>
										<div class="cf7vput-plugins-section-wrap">
											<div class="cf7vput-our-plugins-wrap">
												<?php
												$transient = 'cf7vput-our-plugin-data';
												$html_data = get_transient( $transient );
												if(!empty($html_data))
												{
													$html = $html_data;
												}
												else
												{
													$api_url = 'https://api.wordpress.org/plugins/info/1.2/?action=query_plugins&request[author]=thechetanvaghela';
													$api_response = wp_remote_get($api_url);
													$api_http_code = wp_remote_retrieve_response_code( $api_response );
													$html = '';
													if(isset($api_http_code) && !empty($api_http_code))
													{
														if($api_http_code == 200)
														{
															$api_body = wp_remote_retrieve_body( $api_response );
															if(!empty($api_body))
															{
																$get_data = json_decode($api_body,true);
																if(!empty($get_data))
																{
																	$info = isset($get_data['info']) ? $get_data['info'] :'';
																	$plugins = isset($get_data['plugins']) ? $get_data['plugins'] : array();
																	if(!empty($plugins))
																	{
																		$success = true;
																			
																		foreach ($plugins as $key => $plugin) 
																		{
																			$wp_plugins_path = 'https://wordpress.org/plugins/';
																			$name = isset($plugin['name']) ? $plugin['name'] : '';
																			$slug = isset($plugin['slug']) ? $plugin['slug'] : '';

																			// if($slug == 'common-tools-for-site')
																			// {
																			// 	continue;
																			// }
																			$plugin_path = $wp_plugins_path.$slug.'/';
																			$version = isset($plugin['version']) ? $plugin['version'] : '';
																			$author = isset($plugin['author']) ? $plugin['author'] : '';
																			$author_profile = isset($plugin['author_profile']) ? $plugin['author_profile'] : '';
																			$downloaded = isset($plugin['downloaded']) ? $plugin['downloaded'] : '';
																			$short_description = isset($plugin['short_description']) ? $plugin['short_description'] : '';
																			$download_link = isset($plugin['download_link']) ? $plugin['download_link'] : '';
																			$icons = isset($plugin['icons']) ? $plugin['icons'] : '';
																			$icons_url = !empty($plugin['icons']['1x']) ? $plugin['icons']['1x'] : '';

																			
																			$html .= '<article class="cf7vput-plugin-card  cf7vput-status-publish '.esc_attr($slug).'">';
																			$html .= '<div class="cf7vput-entry-wrap">';
																			$html .= '<div class="cf7vput-entry-thumbnail">';
																			$html .= '<a href="'.esc_url($plugin_path).'" target="_blank" rel="bookmark">';
																			$html .= '<img class="cf7vput-plugin-icon" src="'.esc_url($icons_url).'">';
																			$html .= '</a>';
																			$html .= '</div>';
																			$html .= '<div class="cf7vput-entry">';
																			$html .= '<header class="cf7vput-entry-header">';
																			$html .= '<h3 class="cf7vput-entry-title"><a href="'.esc_url($plugin_path).'" rel="bookmark" target="_blank">'.esc_attr($name).'</a></h3>';		
																			$html .= '</header>';
																			$html .= '<div class="cf7vput-entry-excerpt">';
																			$html .= '<p>'.esc_html($short_description).'</p>';
																			$html .= '</div>';
																			$html .= '</div>';
																			$html .= '</div>';
																			$html .= '<hr>';
																			$html .= '<footer>';
																			$html .= '<span class="cf7vput-plugin-author">';
																			$html .= '<i class="dashicons dashicons-admin-users"></i>';	
																			$html .= '<a href="'.esc_url($author_profile).'" rel="bookmark">Chetan Vaghela</a>';	
																			$html .= '</span>';
																			$html .= '<span class="cf7vput-download-link">';
																			$html .= '<i class="dashicons dashicons-download"></i>';
																			$html .= '<a href="'.esc_url($download_link).'" rel="bookmark" target="_blank">Download</a>';
																			$html .= '</span>';
																			$html .= '<span class="cf7vput-active-installs">';
																			$html .= '<i class="dashicons dashicons-chart-area"></i>';
																			$html .= 'Total downloads:'.esc_attr($downloaded).'';
																			$html .= '</span>';
																			$html .= '<span class="tested-with">';
																			$html .= '<i class="dashicons dashicons-wordpress-alt"></i>';
																			$html .= 'Plugin Version '.esc_attr($version).'</span>';
																			$html .= '</footer>';
																			$html .= '</article>';
																		}
																	}
																	else
																	{
																		$html .= '<article class="">';
																		$html .= '<div class="entry">';
																		$html .= '<header class="entry-header">';
																		$html .= '<h3 class="entry-title">No Plugins found!</h3>';		
																		$html .= '</header>';
																		$html .= '</div>';
																		$html .= '</article>';
																	}
																}
															}
														}
														else
														{
															$html .= '<article class="plugin-card plugin type-plugin status-publish '.esc_attr($slug).'">';
															$html .= '<div class="entry">';
															$html .= '<header class="entry-header">';
															$html .= '<h3 class="entry-title">Something went wrong!</h3>';		
															$html .= '</header>';
															$html .= '</div>';
															$html .= '</article>';
														}
														$expiration = DAY_IN_SECONDS;
														set_transient( $transient, esc_attr($html), $expiration );
													}
												}
												echo html_entity_decode($html);
												?>
											</div>
										</div> 
								   </div>
								</div><!--end of container-->
							</form>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>
		<?php
	}

}
