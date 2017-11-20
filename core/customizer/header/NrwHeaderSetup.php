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
	}

}
$nrwheadersetup = new NrwHeaderSetup();
$nrwheadersetup->init();