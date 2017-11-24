<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwSectionsSetup {

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
			'section_manage',
			array(
				'title'        => __('Manage HomePage Sections', NRW_TXT_DOMAIN),
				'priority'     => 100,
				'capability'   => 'edit_theme_options',
				'panel'        => 'theme_option_panel'
			)
		);
	}

}