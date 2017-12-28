<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwThemeOptionsSetup {

	private $default = null;

	public function __construct() {
		$this->default = NrwDefault::default_theme_options();
	}

	public function init() {
		$this->add_options();
	}

	public function add_options() {
		global $wp_customize;

		$wp_customize->add_panel(
			'theme_option_panel',
			array(
				'title'       => __( 'Theme Options', NRW_TXT_DOMAIN ),
				'priority'    => 100,
				'capability'  => 'edit_theme_options',
			)
		);

		$wp_customize->add_panel(
			'nrw_info_panel',
			array(
				'title'       => __( 'Company Info', NRW_TXT_DOMAIN ),
				'priority'    => 100,
				'capability'  => 'edit_theme_options',
			)
		);
	}

}
$nrwthemeoptionssetup = new NrwThemeOptionsSetup();
$nrwthemeoptionssetup->init();