<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwFooterSetup {

	private $default = null;

	public function __construct() {
		$this->default = NrwDefault::default_theme_options();
	}

	public function init() {
		$this->add_options();
	}

	public function add_options() {
		global $wp_customize;

		$wp_customize->add_section(
			'section_header',
			array(
				'title'      => __( 'Footer Options', NRW_TXT_DOMAIN ),
				'priority'   => 100,
				'capability' => 'edit_theme_options',
				'panel'      => 'theme_option_panel'
			)
		);
	}

}
$nrwfootersetup = new NrwFooterSetup();
$nrwfootersetup->init();