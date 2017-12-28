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
			'section_footer',
			array(
				'title'      => __( 'Footer Options', NRW_TXT_DOMAIN ),
				'priority'   => 100,
				'capability' => 'edit_theme_options',
				'panel'      => 'theme_option_panel'
			)
		);
		$wp_customize->add_setting(
			'theme_options[footer_cta_header]',
			array(
				'default'            => $this->default['ticker_title'],
				'capability'         => 'edit_theme_options',
				'sanatize_callback'  => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'theme_options[footer_cta_header]',
			array(
				'label'             => __('Footer CTA Header', NRW_TXT_DOMAIN),
				'section'           => 'section_footer',
				'type'              => 'text',
				'priority'          => 100
			)
		);
		$wp_customize->add_setting(
			'theme_options[footer_cta_btn_text]',
			array(
				'default'     => $this->default['footer_cta_btn_text'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'theme_options[footer_cta_btn_text]',
			array(
				'label'    => __( 'CTA Button Text', NRW_TXT_DOMAIN ),
				'section'  => 'section_footer',
				'type'     => 'text',
				'priority' => 100
			)
		);
		$wp_customize->add_setting(
			'theme_options[footer_cta_link]',
			array(
				'default'      => $this->default['footer_cta_link'],
				'capability'  => 'edit_theme_options'
			)
		);
		$wp_customize->add_control(
			'theme_options[footer_cta_link]',
			array(
				'label'    => __( 'CTA Page', NRW_TXT_DOMAIN ),
				'section'  => 'section_footer',
				'type'     => 'dropdown-pages',
				'priority' => 100
			)
		);
		$wp_customize->add_setting(
			'theme_options[footer_locations_header]',
			array(
				'default'     => $this->default['footer_locations_header'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'theme_options[footer_locations_header]',
			array(
				'label'    => __( 'Locations Served Header', NRW_TXT_DOMAIN ),
				'section'  => 'section_footer',
				'type'     => 'text',
				'priority' => 100
			)
		);
	}

}
$nrwfootersetup = new NrwFooterSetup();
$nrwfootersetup->init();