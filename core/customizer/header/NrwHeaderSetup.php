<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwHeaderSetup {

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
				'title'        => __('Header Options', NRW_TXT_DOMAIN),
				'priority'     => 100,
				'capability'   => 'edit_theme_options',
				'panel'        => 'theme_option_panel'
			)
		);
		$wp_customize->add_setting(
			'theme_options[fixed_header]',
			array(
				'default'             => $this->default['fixed_header'],
				'capability'          => 'edit_theme_options',
				'sanitize_callback'   => array( 'NrwSanitize', 'sanitize_checkbox')
			)
		);
		$wp_customize->add_control(
			'theme_options[fixed_header]',
			array(
				'label'    => __( 'Fixed Header', NRW_TXT_DOMAIN ),
				'section'  => 'section_header',
				'type'     => 'checkbox',
				'priority' => 100,
			)
		);
		$wp_customize->add_setting(
			'theme_options[show_ticker]',
			array(
				'default'             => $this->default['show_ticker'],
				'capability'          => 'edit_theme_options',
				'sanitize_callback'   => array( 'NrwSanitize', 'sanitize_checkbox')
			)
		);
		$wp_customize->add_control(
			'theme_options[show_ticker]',
			array(
				'label'    => __( 'Show News Ticker', NRW_TXT_DOMAIN ),
				'section'  => 'section_header',
				'type'     => 'checkbox',
				'priority' => 100,
			)
		);
		$wp_customize->add_setting(
			'theme_options[ticker_theme]',
			array(
				'default'             => $this->default['ticker_theme'],
				'capability'          => 'edit_theme_options',
				'sanitize_callback'   => array('NrwSanitize', 'sanitize_select')
			)
		);
		$wp_customize->add_control(
			'theme_options[ticker_theme]',
			array(
				'label'           => __( 'Ticker Theme', NRW_TXT_DOMAIN ),
				'section'         => 'section_header',
				'type'            => 'select',
				'choices'         => NrwOptions::get_bs_color_options(),
				'priority'        => 100,
				'active_callback' => array( 'NrwCallback', 'is_news_ticker_active' )
			)
		);
		$wp_customize->add_setting(
			'theme_options[ticker_dark_color]',
			array(
				'default'              => $this->default['ticker_dark_color'],
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_options[ticker_dark_color]',
				array(
					'label'            => __('Ticker - Dark Accent Color'),
					'section'          => 'section_header',
					'priority'         => 100,
					'active_callback'  => array('NrwCallback', 'is_news_ticker_custom_theme')
				)
			)
		);
		$wp_customize->add_setting(
			'theme_options[ticker_light_color]',
			array(
				'default'              => $this->default['ticker_light_color'],
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_options[ticker_light_color]',
				array(
					'label'            => __('Ticker - Light Accent Color'),
					'section'          => 'section_header',
					'priority'         => 100,
					'active_callback'  => array('NrwCallback', 'is_news_ticker_custom_theme')
				)
			)
		);
		$wp_customize->add_setting(
			'theme_options[ticker_title]',
			array(
				'default'            => $this->default['ticker_title'],
				'capability'         => 'edit_theme_options',
				'sanatize_callback'  => 'sanitize_text_field'
			)
		);
		$wp_customize->add_control(
			'theme_options[ticker_title]',
			array(
				'label'             => __('Ticker Title', NRW_TXT_DOMAIN),
				'section'           => 'section_header',
				'type'              => 'text',
				'priority'          => 100,
				'active_callback' => array( 'NrwCallback', 'is_news_ticker_active' )
			)
		);
		$wp_customize->add_setting( 'theme_options[ticker_number]',
			array(
				'default'           => $this->default['ticker_number'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array( 'NrwSanitize', 'sanitize_positive_integer'),
			)
		);
		$wp_customize->add_control( 'theme_options[ticker_number]',
			array(
				'label'           => __( 'Number of Alerts', NRW_TXT_DOMAIN ),
				'section'         => 'section_header',
				'type'            => 'number',
				'priority'        => 100,
				'active_callback' => array( 'NrwCallback', 'is_news_ticker_active'),
				'input_attrs'     => array( 'min' => 1, 'max' => 20, 'style' => 'width: 55px;' ),
			)
		);
		$wp_customize->add_setting(
			'theme_options[primary_menu_alignment]',
			array(
				'default'           => $this->default['primary_menu_alignment'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array('NrwSanitize', 'sanitize_select')
			)
		);
		$wp_customize->add_control(
			'theme_options[primary_menu_alignment]',
			array(
				'label'           => __( 'Primary Menu Alignment', NRW_TXT_DOMAIN ),
				'section'         => 'section_header',
				'type'            => 'select',
				'choices'         => NrwOptions::get_primary_menu_alignment_options(),
				'priority'        => 100
			)
		);
		$wp_customize->add_setting(
			'theme_options[brand_custom_css]',
			array(
				'default'             => $this->default['brand_custom_css'],
				'capability'          => 'edit_theme_options',
				'sanitize_callback'   => array( 'NrwSanitize', 'sanitize_checkbox')
			)
		);
		$wp_customize->add_control(
			'theme_options[brand_custom_css]',
			array(
				'label'    => __( 'Use Custom Css for Brand', NRW_TXT_DOMAIN ),
				'section'  => 'section_header',
				'type'     => 'checkbox',
				'priority' => 100,
			)
		);
		$wp_customize->add_setting(
			'theme_options[branding_container_width]',
			array(
				'default'           => $this->default['branding_container_width'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array('NrwSanitize', 'sanitize_select')
			)
		);
		$wp_customize->add_control(
			'theme_options[branding_container_width]',
			array(
				'label'           => __( 'Branding Container Width', NRW_TXT_DOMAIN ),
				'section'         => 'section_header',
				'type'            => 'select',
				'choices'         => NrwOptions::content_width_options(),
				'priority'        => 100,
				'active_callback' => array('NrwCallback', 'is_news_menu_under_branding')
			)
		);
		$wp_customize->add_setting(
			'theme_options[branding_menu_container_width]',
			array(
				'default'           => $this->default['branding_menu_container_width'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array('NrwSanitize', 'sanitize_select')
			)
		);
		$wp_customize->add_control(
			'theme_options[branding_menu_container_width]',
			array(
				'label'           => __( 'Header Container Width', NRW_TXT_DOMAIN ),
				'section'         => 'section_header',
				'type'            => 'select',
				'choices'         => NrwOptions::content_width_options(),
				'priority'        => 100,
				'active_callback' => array('NrwCallback', 'is_news_menu_inline_branding')
			)
		);
		$wp_customize->add_setting(
			'theme_options[brand_alignment]',
			array(
				'default'           => $this->default['brand_alignment'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array('NrwSanitize', 'sanitize_select')
			)
		);
		$wp_customize->add_control(
			'theme_options[brand_alignment]',
			array(
				'label'           => __( 'Brand Alignment', NRW_TXT_DOMAIN ),
				'section'         => 'section_header',
				'type'            => 'select',
				'choices'         => NrwOptions::text_alignment_options(),
				'priority'        => 100,
				'active_callback' => array('NrwCallback', 'is_news_menu_under_branding')
			)
		);
		$wp_customize->add_setting(
			'theme_options[primary_menu_container_width]',
			array(
				'default'           => $this->default['primary_menu_container_width'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array('NrwSanitize', 'sanitize_select')
			)
		);
		$wp_customize->add_control(
			'theme_options[primary_menu_container_width]',
			array(
				'label'           => __( 'Primary Menu Container Width', NRW_TXT_DOMAIN ),
				'section'         => 'section_header',
				'type'            => 'select',
				'choices'         => NrwOptions::content_width_options(),
				'priority'        => 100,
				'active_callback' => array('NrwCallback', 'is_news_menu_under_branding')
			)
		);
        $wp_customize->add_setting(
            'theme_options[navbar_alignment]',
            array(
                'default'           => $this->default['navbar_alignment'],
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => array('NrwSanitize', 'sanitize_select')
            )
        );
        $wp_customize->add_control(
            'theme_options[navbar_alignment]',
            array(
                'label'           => __( 'NavBar Alignment', NRW_TXT_DOMAIN ),
                'section'         => 'section_header',
                'type'            => 'select',
                'choices'         => NrwOptions::menu_alignment_options(),
                'priority'        => 100
            )
        );
		$wp_customize->add_setting( 'theme_options[menu_item_padding]',
			array(
				'default'           => $this->default['menu_item_padding'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array( 'NrwSanitize', 'sanitize_positive_integer'),
			)
		);
		$wp_customize->add_control( 'theme_options[menu_item_padding]',
			array(
				'label'           => __( 'Nav Item Side Padding', NRW_TXT_DOMAIN ),
				'section'         => 'section_header',
				'type'            => 'number',
				'priority'        => 100,
				'active_callback' => array( 'NrwCallback', 'is_not_justify_alignment'),
				'input_attrs'     => array( 'min' => 0, 'max' => 100, 'style' => 'width: 55px;' ),
			)
		);
		$wp_customize->add_setting(
			'theme_options[header_bg_color_select]',
			array(
				'default'             => $this->default['header_bg_color_select'],
				'capability'          => 'edit_theme_options',
				'sanitize_callback'   => array('NrwSanitize', 'sanitize_select')
			)
		);
		$wp_customize->add_control(
			'theme_options[header_bg_color_select]',
			array(
				'label'           => __( 'Header Color Theme', NRW_TXT_DOMAIN ),
				'section'         => 'section_header',
				'type'            => 'select',
				'choices'         => NrwOptions::get_bs_color_options(),
				'priority'        => 100
			)
		);
		$wp_customize->add_setting(
			'theme_options[header_bg_color]',
			array(
				'default'              => $this->default['header_bg_color'],
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_options[header_bg_color]',
				array(
					'label'            => __('Header Background Color'),
					'section'          => 'section_header',
					'priority'         => 100,
					'active_callback'  => array('NrwCallback', 'is_brand_custom_theme')
				)
			)
		);
		$wp_customize->add_setting(
			'theme_options[header_brand_color]',
			array(
				'default'              => $this->default['header_brand_color'],
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_options[header_brand_color]',
				array(
					'label'            => __('Header Brand Color'),
					'section'          => 'section_header',
					'priority'         => 100,
					'active_callback'  => array('NrwCallback', 'is_brand_custom_theme')
				)
			)
		);
		$wp_customize->add_setting(
			'theme_options[navbar_color_theme]',
			array(
				'default'             => $this->default['navbar_color_theme'],
				'capability'          => 'edit_theme_options',
				'sanitize_callback'   => array('NrwSanitize', 'sanitize_select')
			)
		);
		$wp_customize->add_control(
			'theme_options[navbar_color_theme]',
			array(
				'label'           => __( 'NavBar Color Theme', NRW_TXT_DOMAIN ),
				'section'         => 'section_header',
				'type'            => 'select',
				'choices'         => NrwOptions::get_bs_color_options(),
				'priority'        => 100
			)
		);
		$wp_customize->add_setting(
			'theme_options[navbar_bg_color]',
			array(
				'default'              => $this->default['navbar_bg_color'],
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_options[navbar_bg_color]',
				array(
					'label'            => __('NavBar Background Color'),
					'section'          => 'section_header',
					'priority'         => 100,
					'active_callback'  => array('NrwCallback', 'is_navbar_custom_theme')
				)
			)
		);
		$wp_customize->add_setting(
			'theme_options[navbar_link_color]',
			array(
				'default'              => $this->default['navbar_link_color'],
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_options[navbar_link_color]',
				array(
					'label'            => __('NavBar Link Color'),
					'section'          => 'section_header',
					'priority'         => 100,
					'active_callback'  => array('NrwCallback', 'is_navbar_custom_theme')
				)
			)
		);
		$wp_customize->add_setting(
			'theme_options[navbar_link_hover_color]',
			array(
				'default'              => $this->default['navbar_link_hover_color'],
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_options[navbar_link_hover_color]',
				array(
					'label'            => __('NavBar Link Hover Color'),
					'section'          => 'section_header',
					'priority'         => 100,
					'active_callback'  => array('NrwCallback', 'is_navbar_custom_theme')
				)
			)
		);

	}

}
$nrwheadersetup = new NrwHeaderSetup();
$nrwheadersetup->init();