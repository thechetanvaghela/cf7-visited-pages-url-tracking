<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/thechetanvaghela/
 * @since      1.0.0
 *
 * @package    Cf7_Visited_Pages_Url_Tracking
 * @subpackage Cf7_Visited_Pages_Url_Tracking/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cf7_Visited_Pages_Url_Tracking
 * @subpackage Cf7_Visited_Pages_Url_Tracking/public
 * @author     Chetan Vaghela <ckvaghela92@gmail.com>
 */
class Cf7_Visited_Pages_Url_Tracking_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cf7-visited-pages-url-tracking-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cf7-visited-pages-url-tracking-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Before Sent Contact form 7 Mail
	 *
	 * @since    1.0.0
	 */
	public function cf7vput_add_links_to_mail_body($contact_form )
	{
		$submission = WPCF7_Submission::get_instance();
		if ( $submission ) 
		{
			$mail = $contact_form->prop( 'mail' );
			if(isset($_COOKIE['cf7vput_last_visited_pages']) && !empty($_COOKIE['cf7vput_last_visited_pages']))
			{
				if (strpos($mail['body'], '[CF7VPUT_VISITED_Details]') !== false) 
				{
					$visited_list = json_encode($_COOKIE['cf7vput_last_visited_pages']);
					$cookie_visited_list = $_COOKIE['cf7vput_last_visited_pages'];
					$visited_list = stripslashes($cookie_visited_list);
					$visited_list_array = json_decode($visited_list, true);
					if(!empty($visited_list_array))
					{
						$html = '';
						$html .= '<ul>';
						foreach ($visited_list_array as $key => $visited) {
							$html .= '<li>';
							$html .= $visited;
							$html .= '</li>';
						}
						$html .= '</li>';
					}
					$finalstring = "Last Visited Pages: " . $html;
					$mail['body'] = str_replace("[CF7VPUT_VISITED_Details]",$finalstring,$mail['body']);
				}
			}
			$contact_form->set_properties( array( 'mail' => $mail ) );
		}
	}

}
