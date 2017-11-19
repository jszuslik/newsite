<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class NrwSetup {

	private $production;
	private $starter_content;

	public function __construct() {
		$this->production = false;

		$this->starter_content = array(
			'nav_menus' => array(
				'primary' => array(
					'name' => __('Primary Menu', NRW_TXT_DOMAIN),
					'items' => array(
						'link_home'
					),
				),
				'footer' => array(
					'name' => __('Footer Menu', NRW_TXT_DOMAIN),
					'items' => array(
						'link_home'
					),
				),
				'social' => array(
					'name' => __('Social Media Menu', NRW_TXT_DOMAIN),
					'items' => array(
						'link_facebook',
						'link_twitter',
						'link_instagram',
					)
				)
			)
		);
	}

	public function init() {
		add_action('after_setup_theme', array($this, 'theme_setup'));
		add_action( 'wp_head', array($this, 'javascript_detection'), 0 );
		add_action( 'wp_enqueue_scripts', array($this, 'scripts') );
	}

	public function theme_setup() {
		load_theme_textdomain(NRW_TXT_DOMAIN);
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('customize-selective-refresh-widgets');
		add_theme_support( 'footer-widgets', 4 );

		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );


		register_nav_menus(
			array(
				'primary' => __('Primary Menu', NRW_TXT_DOMAIN),
				'footer' => __('Footer Menu', NRW_TXT_DOMAIN),
				'social' => __('Social Media Menu', NRW_TXT_DOMAIN),
			)
		);

		$this->starter_content = apply_filters( 'nrw-wp-theme_starter_content', $this->starter_content );
		add_theme_support( 'starter-content', $this->starter_content );
	}

	/**
	 * Handles JavaScript detection.
	 *
	 * Adds a `js` class to the root `<html>` element when JavaScript is detected
	 *
	 */
	public function javascript_detection() {
		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function scripts() {
		wp_enqueue_style( 'nrw-style', get_stylesheet_uri() );
		if ($this->production) {
			wp_enqueue_script('nrw-script', get_template_directory_uri() . '/assets/js/scripts.min.js', array('jquery'), false, true);
		} else {
			wp_enqueue_script('omni-script', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), false, true);
		}
		wp_enqueue_style('omni-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,700,700i|Roboto:400,400i,500,500i,700,700i');

	}

}
$nrwsetup = new NrwSetup();
$nrwsetup->init();