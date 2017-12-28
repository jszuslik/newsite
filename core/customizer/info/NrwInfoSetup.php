<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwInfoSetup {

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
			'section_social_media',
			array(
				'title'      => __( 'Social Media', NRW_TXT_DOMAIN ),
				'priority'   => 100,
				'capability' => 'edit_theme_options',
				'panel'      => 'nrw_info_panel'
			)
		);
		$wp_customize->add_setting(
			'theme_options[nrw_facebook]',
			array(
				'default'            => $this->default['nrw_facebook'],
				'capability'         => 'edit_theme_options',
				'sanatize_callback'  => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'theme_options[nrw_facebook]',
			array(
				'label'             => __('Facebook URL', NRW_TXT_DOMAIN),
				'section'           => 'section_social_media',
				'type'              => 'text',
				'priority'          => 100
			)
		);

		$wp_customize->add_section(
			'section_contact_info',
			array(
				'title'      => __( 'Contact Info', NRW_TXT_DOMAIN ),
				'priority'   => 100,
				'capability' => 'edit_theme_options',
				'panel'      => 'nrw_info_panel'
			)
		);
		$wp_customize->add_setting(
			'theme_options[nrw_email_address]',
			array(
				'default'            => $this->default['nrw_email_address'],
				'capability'         => 'edit_theme_options',
				'sanatize_callback'  => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'theme_options[nrw_email_address]',
			array(
				'label'             => __('E-mail Address', NRW_TXT_DOMAIN),
				'section'           => 'section_contact_info',
				'type'              => 'text',
				'priority'          => 100
			)
		);
		$wp_customize->add_setting(
			'theme_options[nrw_phone_number]',
			array(
				'default'            => $this->default['nrw_phone_number'],
				'capability'         => 'edit_theme_options',
				'sanatize_callback'  => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'theme_options[nrw_phone_number]',
			array(
				'label'             => __('Main Phone Number', NRW_TXT_DOMAIN),
				'section'           => 'section_contact_info',
				'type'              => 'text',
				'priority'          => 100
			)
		);
		$wp_customize->add_setting(
			'theme_options[nrw_location]',
			array(
				'default'            => $this->default['nrw_location'],
				'capability'         => 'edit_theme_options',
				'sanatize_callback'  => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'theme_options[nrw_location]',
			array(
				'label'             => __('Location', NRW_TXT_DOMAIN),
				'section'           => 'section_contact_info',
				'type'              => 'text',
				'priority'          => 100
			)
		);
		$wp_customize->add_setting(
			'theme_options[nrw_address1]',
			array(
				'default'            => $this->default['nrw_address1'],
				'capability'         => 'edit_theme_options',
				'sanatize_callback'  => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'theme_options[nrw_address1]',
			array(
				'label'             => __('Address 1', NRW_TXT_DOMAIN),
				'section'           => 'section_contact_info',
				'type'              => 'text',
				'priority'          => 100
			)
		);
		$wp_customize->add_setting(
			'theme_options[nrw_address2]',
			array(
				'default'            => $this->default['nrw_address2'],
				'capability'         => 'edit_theme_options',
				'sanatize_callback'  => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'theme_options[nrw_address2]',
			array(
				'label'             => __('Address 2', NRW_TXT_DOMAIN),
				'section'           => 'section_contact_info',
				'type'              => 'text',
				'priority'          => 100
			)
		);
		$wp_customize->add_setting(
			'theme_options[nrw_city_state_zip]',
			array(
				'default'            => $this->default['nrw_city_state_zip'],
				'capability'         => 'edit_theme_options',
				'sanatize_callback'  => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'theme_options[nrw_city_state_zip]',
			array(
				'label'             => __('City, State Zip', NRW_TXT_DOMAIN),
				'section'           => 'section_contact_info',
				'type'              => 'text',
				'priority'          => 100
			)
		);
		$wp_customize->add_setting(
			'theme_options[nrw_location_memo]',
			array(
				'default'            => $this->default['nrw_location_memo'],
				'capability'         => 'edit_theme_options',
				'sanatize_callback'  => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'theme_options[nrw_location_memo]',
			array(
				'label'             => __('Location Memo', NRW_TXT_DOMAIN),
				'section'           => 'section_contact_info',
				'type'              => 'text',
				'priority'          => 100
			)
		);
	}

}

$nrwinfosetup = new NrwInfoSetup();
$nrwinfosetup->init();