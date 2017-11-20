<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwCallback {

	public static function is_news_ticker_active( $control ) {
		if ( $control->manager->get_setting( 'theme_options[show_ticker]' )->value() ) {
			return true;
		}
		return false;
	}

	public static function is_news_ticker_custom_theme( $control ) {
		if ('-custom' == $control->manager->get_setting( 'theme_options[ticker_theme]' )->value() && self::is_news_ticker_active($control)) {
			return true;
		}
		return false;
	}

	public static function is_brand_custom_theme( $control ) {
		if ('-custom' == $control->manager->get_setting( 'theme_options[header_bg_color_select]' )->value()) {
			return true;
		}
		return false;
	}

	public static function is_navbar_custom_theme( $control ) {
		if ('-custom' == $control->manager->get_setting( 'theme_options[navbar_color_theme]' )->value()) {
			return true;
		}
		return false;
	}
}