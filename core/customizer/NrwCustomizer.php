<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class NrwCustomizer {

	public function __construct() {

	}

	public function init() {
		nrw_require_file(NRW_CORE_PATH . 'customizer/default/NrwDefault.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/sanitize/NrwSanitize.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/callback/NrwCallback.php');
		add_action( 'customize_register', array($this, 'register') );
		add_action( 'customize_controls_enqueue_scripts', array($this, 'scripts'), 0 );
		add_filter('upload_mimes', array($this, 'mime_types') );
	}

	public function register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		nrw_require_file(NRW_CORE_PATH . 'customizer/NrwThemeOptionsSetup.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/header/NrwHeaderSetup.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/jumbotron/NrwJumbotronSetup.php');
	}

	public function scripts() {
		wp_register_script( 'nrw-wp-theme-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array( 'jquery', 'customize-controls', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0.0', true );
		wp_register_style( 'nrw-wp-theme-css-customize-controls', get_template_directory_uri() . '/assets/css/customize-controls.css' );
	}

	public function mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

}
$nrwcustomizer = new NrwCustomizer();
$nrwcustomizer->init();