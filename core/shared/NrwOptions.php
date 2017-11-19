<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class NrwOptions {

	public static function get_home_sections_options() {
		$choices = array(
			'two-column-funnels' => array(
				'label'       => __( '2 Column Funnels', NRW_TXT_DOMAIN ),
				'template'    => 'template-parts/funnels/two-column-funnels'
			)
		);
		$output = apply_filters( 'nrw_filter_home_section_templates', $choices);
		return $output;
	}

	public static function get_bs_color_options() {

		$choices = array(
			'-primary'       => __( 'Primary', NRW_TXT_DOMAIN ),
			'-secondary'     => __('Secondary', NRW_TXT_DOMAIN ),
			'-success'       => __('Success', NRW_TXT_DOMAIN ),
			'-danger'        => __('Danger', NRW_TXT_DOMAIN ),
			'-warning'       => __('Warning', NRW_TXT_DOMAIN ),
			'-info'          => __('Info', NRW_TXT_DOMAIN ),
			'-light'         => __('Light', NRW_TXT_DOMAIN ),
			'-dark'          => __('Dark', NRW_TXT_DOMAIN ),
			'-custom'        => __('Custom', NRW_TXT_DOMAIN)
		);

		$output = apply_filters('nrw_theme_filter_ticker_theme', $choices);
		return $output;

	}

}