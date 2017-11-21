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

	public static function get_primary_menu_alignment_options() {

		$choices = array(
			'under'       => __('Menu Under Branding', NRW_TXT_DOMAIN),
			'inline'      => __('Menu Inline With Branding', NRW_TXT_DOMAIN)
		);

		$output = apply_filters('nrw_filter_menu_alignment_options', $choices);
		return $output;

	}

	public static function content_width_options() {

		$choices = array(
			'container'          => __('Contained', NRW_TXT_DOMAIN),
			'container-fluid'    => __('Full Width', NRW_TXT_DOMAIN)
		);

		$output = apply_filters('nrw_filter_menu_width_options', $choices);
		return $output;
	}

	public static function text_alignment_options() {

		$choices = array(
			'left'          => __('Left', NRW_TXT_DOMAIN),
			'center'        => __('Center', NRW_TXT_DOMAIN),
			'right'         => __('Right', NRW_TXT_DOMAIN)
		);

		$output = apply_filters('nrw_filter_text_alignment_options', $choices);
		return $output;
	}

	public static function menu_alignment_options() {
	    $choices = self::text_alignment_options();
	    $choices['justify'] = __('Justify', NRW_TXT_DOMAIN);

        $output = apply_filters('nrw_filter_menu_alignment_options', $choices);
        return $output;
    }

}