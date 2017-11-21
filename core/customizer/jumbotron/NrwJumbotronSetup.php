<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwJumbotronSetup {

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
			'section_jumbo',
			array(
				'title'        => __('Jumbotron Options', NRW_TXT_DOMAIN),
				'priority'     => 100,
				'capability'   => 'edit_theme_options',
				'panel'        => 'theme_option_panel'
			)
		);
		$wp_customize->add_setting(
			'theme_options[enable_jumbo]',
			array(
				'default'             => $this->default['enable_jumbo'],
				'capability'          => 'edit_theme_options',
				'sanitize_callback'   => array( 'NrwSanitize', 'sanitize_checkbox')
			)
		);
		$wp_customize->add_control(
			'theme_options[enable_jumbo]',
			array(
				'label'    => __( 'Enable Jumbotron', NRW_TXT_DOMAIN ),
				'section'  => 'section_jumbo',
				'type'     => 'checkbox',
				'priority' => 100,
			)
		);
		$wp_customize->add_setting(
			'theme_options[jumbotron_type]',
			array(
				'default'      => $this->default['jumbotron_type'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array('NrwSanitize', 'sanitize_select')
			)
		);
		$wp_customize->add_control(
			'theme_options[jumbotron_type]',
			array(
				'label'    => __( 'Jumbotron Type', NRW_TXT_DOMAIN ),
				'section'  => 'section_jumbo',
				'type'     => 'select',
				'choices'  => NrwOptions::select_jumbotron_type_options(),
				'priority' => 100,
				'active_callback' => array( 'NrwCallback', 'is_jumbotron_enabled')
			)
		);
		$wp_customize->add_setting(
			'theme_options[jumbotron_classes]',
			array(
				'default'     => $this->default['jumbotron_classes'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'theme_options[jumbotron_classes]',
			array(
				'label'    => __( 'Jumbotron Custom Classes', NRW_TXT_DOMAIN ),
				'section'  => 'section_jumbo',
				'type'     => 'text',
				'priority' => 100,
				'active_callback' => array( 'NrwCallback', 'is_jumbotron_type_css')
			)
		);
		$wp_customize->add_setting( 'theme_options[jumbotron_mp4_upload]',
			array(
				'default'     => $this->default['jumbotron_mp4_upload'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'theme_options[jumbotron_mp4_upload]',
				array(
					'label'      => __( 'Jumbotron Background Video (Mp4 Format)', NRW_TXT_DOMAIN ),
					'section'    => 'section_jumbo',
					'settings'   => 'theme_options[jumbotron_mp4_upload]',
					'mime_type'  => 'video/mp4',
					'priority'   => 100,
					'active_callback' => array( 'NrwCallback', 'is_jumbotron_type_video')
				)
			)
		);
		// Upload OGG
		$wp_customize->add_setting(
			'theme_options[jumbotron_ogg_upload]',
			array(
				'default'     => $this->default['jumbotron_ogg_upload'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'theme_options[jumbotron_ogg_upload]',
				array(
					'label'      => __( 'Jumbotron Background Video (OGG, OGV or OGA Format)', NRW_TXT_DOMAIN ),
					'section'    => 'section_jumbo',
					'settings'   => 'theme_options[jumbotron_ogg_upload]',
					'mime_type'  => 'video/ogg',
					'priority'   => 100,
					'active_callback' => array( 'NrwCallback', 'is_jumbotron_type_video')
				)
			)
		);
		$wp_customize->add_setting(
			'theme_options[jumbotron_image_upload]',
			array(
				'default'     => $this->default['jumbotron_bg_image_upload'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'theme_options[jumbotron_image_upload]',
				array(
					'label'      => __( 'Jumbotron Background Image', NRW_TXT_DOMAIN ),
					'section'    => 'section_jumbo',
					'settings'   => 'theme_options[jumbotron_image_upload]',
					'priority'   => 100,
					'active_callback' => array( 'NrwCallback', 'is_jumbotron_type_image')
				)
			)
		);
		$wp_customize->add_setting(
			'theme_options[jumbotron_bg_color]',
			array(
				'default'              => $this->default['jumbotron_bg_color'],
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_options[jumbotron_bg_color]',
				array(
					'label'            => __('Jumbotron Background Color'),
					'section'          => 'section_jumbo',
					'priority'         => 100,
					'active_callback'  => array('NrwCallback', 'is_jumbotron_type_css')
				)
			)
		);
		$wp_customize->add_setting(
			'theme_options[jumbotron_header]',
			array(
				'default'     => $this->default['jumbotron_header'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'theme_options[jumbotron_header]',
			array(
				'label'    => __( 'Jumbotron Header', NRW_TXT_DOMAIN ),
				'section'  => 'section_jumbo',
				'type'     => 'text',
				'priority' => 100,
				'active_callback' => array( 'NrwCallback', 'is_jumbotron_enabled')
			)
		);
		$wp_customize->add_setting(
			'theme_options[jumbotron_header_color]',
			array(
				'default'              => $this->default['jumbotron_header_color'],
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_options[jumbotron_header_color]',
				array(
					'label'            => __('Jumbotron Header Color'),
					'section'          => 'section_jumbo',
					'priority'         => 100,
					'active_callback'  => array('NrwCallback', 'is_jumbotron_type_css')
				)
			)
		);
		$wp_customize->add_setting(
			'theme_options[jumbotron_sub_header]',
			array(
				'default'     => $this->default['jumbotron_sub_header'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'theme_options[jumbotron_sub_header]',
			array(
				'label'    => __( 'Jumbotron Sub Header', NRW_TXT_DOMAIN ),
				'section'  => 'section_jumbo',
				'type'     => 'text',
				'priority' => 100,
				'active_callback' => array( 'NrwCallback', 'is_jumbotron_enabled')
			)
		);
		$wp_customize->add_setting(
			'theme_options[jumbotron_sub_header_color]',
			array(
				'default'              => $this->default['jumbotron_sub_header_color'],
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_options[jumbotron_sub_header_color]',
				array(
					'label'            => __('Jumbotron Sub Header Color'),
					'section'          => 'section_jumbo',
					'priority'         => 100,
					'active_callback'  => array('NrwCallback', 'is_jumbotron_type_css')
				)
			)
		);
		$wp_customize->add_setting(
			'theme_options[jumbotron_content]',
			array(
				'default'     => $this->default['jumbotron_content'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'theme_options[jumbotron_content]',
			array(
				'label'    => __( 'Jumbotron Content', NRW_TXT_DOMAIN ),
				'section'  => 'section_jumbo',
				'type'     => 'textarea',
				'priority' => 100,
				'active_callback' => array( 'NrwCallback', 'is_jumbotron_enabled')
			)
		);
		$wp_customize->add_setting(
			'theme_options[jumbotron_content_color]',
			array(
				'default'              => $this->default['jumbotron_content_color'],
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_options[jumbotron_content_color]',
				array(
					'label'            => __('Jumbotron Content Color'),
					'section'          => 'section_jumbo',
					'priority'         => 100,
					'active_callback'  => array('NrwCallback', 'is_jumbotron_type_css')
				)
			)
		);
		$wp_customize->add_setting(
			'theme_options[jumbotron_cta_btn_text]',
			array(
				'default'     => $this->default['jumbotron_cta_btn_text'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'theme_options[jumbotron_cta_btn_text]',
			array(
				'label'    => __( 'CTA Button Text', NRW_TXT_DOMAIN ),
				'section'  => 'section_jumbo',
				'type'     => 'text',
				'priority' => 100,
				'active_callback' => array( 'NrwCallback', 'is_jumbotron_enabled')
			)
		);
		$wp_customize->add_setting(
			'theme_options[jumbotron_cta_btn_color]',
			array(
				'default'              => $this->default['jumbotron_cta_btn_color'],
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_options[jumbotron_cta_btn_color]',
				array(
					'label'            => __('Jumbotron Button Color'),
					'section'          => 'section_jumbo',
					'priority'         => 100,
					'active_callback'  => array('NrwCallback', 'is_jumbotron_type_css')
				)
			)
		);
	}

}
$nrwjumbotronsetup = new NrwJumbotronSetup();
$nrwjumbotronsetup->init();