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
		$wp_customize->add_setting(
			'theme_options[homepage_sections]',
			array(
				'default'           => $this->default['homepage_sections'],
				'capability'        => 'edit_theme_options',
//				'sanitize_callback' => array( 'NrwSanitize', 'sanitize_homepage_sections'),
			)
		);
		$wp_customize->add_control(
			new NrwHomepageSectionControl(
				$wp_customize,
				'theme_options[homepage_sections]',
				array(
					'label'    => __( 'Reorder/toggle sections', NRW_TXT_DOMAIN ),
					'section'  => 'section_manage',
					'settings' => 'theme_options[homepage_sections]',
					'priority' => 100,
					'choices'  => NrwOptions::get_home_section_posts(),
				)
			)
		);
	}

}
$nrwsectionssetup = new NrwSectionsSetup();
$nrwsectionssetup->init();