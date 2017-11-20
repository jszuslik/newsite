<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwDefault {

	public static function default_theme_options() {
		$defaults = array();

		/**
		 * News Ticker
		 */
		$defaults['fixed_header']                         = false;
		$defaults['show_ticker']                          = false;
		$defaults['ticker_theme']                         = '-primary';
		$defaults['ticker_number']                        = 3;
		$defaults['ticker_dark_color']                    = '#353535';
		$defaults['ticker_light_color']                   = '#03a9f4';

		/**
		 * Branding and Header Menu
		 */
		$defaults['primary_menu_alignment']               = 'under';
		$defaults['branding_container_width']             = 'container';
		$defaults['primary_menu_container_width']         = 'container';
		$defaults['header_bg_color_select']               = '-primary';
		$defaults['header_bg_color']                      = '#353535';
		$defaults['header_brand_color']                   = '#03a9f4';
		$defaults['brand_alignment']                      = 'left';
		$defaults['navbar_color_theme']                   = '-primary';
		$defaults['navbar_bg_color']                      = '#353535';
		$defaults['navbar_link_color']                    = '#03a9f4';
		$defaults['navbar_link_hover_color']              = '#027cb3';


		$defaults = apply_filters('nrw_filter_default_theme_options', $defaults);
		return $defaults;
	}

}