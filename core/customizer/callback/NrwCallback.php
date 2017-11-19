<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwCallback {

	public static function is_news_ticker_active( $control ) {
		if ( $control->manager->get_setting( 'theme_options[show_ticker]' )->value() ) {
			return true;
		} else {
			return false;
		}
	}
}