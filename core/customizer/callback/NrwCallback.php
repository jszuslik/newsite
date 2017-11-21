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

	public static function is_news_menu_under_branding( $control ) {
		if ( 'under' == $control->manager->get_setting( 'theme_options[primary_menu_alignment]' )->value() ) {
			return true;
		}
		return false;
	}

	public static function is_news_menu_inline_branding( $control ) {
		if ( 'inline' == $control->manager->get_setting( 'theme_options[primary_menu_alignment]' )->value() ) {
			return true;
		}
		return false;
	}

	public static function is_not_justify_alignment( $control ) {
		if ( 'justify' != $control->manager->get_setting( 'theme_options[navbar_alignment]' )->value() ) {
			return true;
		}
		return false;
	}

	public static function is_jumbotron_enabled( $control ) {
		if ( $control->manager->get_setting( 'theme_options[enable_jumbo]' )->value() ) {
			return true;
		}
		return false;
	}

	public static function is_jumbotron_type_video( $control ) {
		if ( 'video' == $control->manager->get_setting( 'theme_options[jumbotron_type]' )->value() && self::is_jumbotron_enabled( $control ) ) {
			return true;
		}
		return false;
	}

	public static function is_jumbotron_type_image( $control ) {
		if ( 'image' == $control->manager->get_setting( 'theme_options[jumbotron_type]' )->value() &&
		     self::is_jumbotron_enabled( $control ) ) {
			return true;
		}
		return false;
	}

	public static function is_jumbotron_type_css( $control ) {
		if ( 'css' == $control->manager->get_setting( 'theme_options[jumbotron_type]' )->value() &&
		     self::is_jumbotron_enabled( $control ) ) {
			return true;
		}
		return false;
	}
}