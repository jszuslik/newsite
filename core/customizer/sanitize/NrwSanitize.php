<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwSanitize {

	public static function sanitize_select( $input, $setting ) {
		//Ensure input is a slug
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	public static function sanitize_checkbox($checked) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}

	public static function sanitize_positive_integer( $input, $setting ) {
		$input = absint( $input );

		// If the input is an absolute integer, return it.
		// otherwise, return the default.
		return ( $input ? $input : $setting->default );
	}

	public static function sanitize_homepage_sections( $input, $setting ) {
		$input = (array)$input;
		$output = array();

		if ( ! empty( $input ) ) {
			$all_sections = NrwOptions::get_home_section_posts();
			p($all_sections);
			$section_keys = array_keys( $all_sections );

			foreach ( $input as $key ) {
				if ( in_array( $key, $section_keys ) ) {
					$output[] = sanitize_text_field( $key );
				}
			}
		}
		return $output;
	}
}