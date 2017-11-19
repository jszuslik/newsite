<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwDefault {

	public static function default_theme_options() {
		$defaults = array();

		$defaults['fixed_header']                = false;
		$defaults['show_ticker']                 = false;
		$defaults['ticker_theme']                = '-primary';

		$defaults = apply_filters('nrw_filter_default_theme_options', $defaults);
		return $defaults;
	}

}