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
		$defaults['ticker_title']                         = '';

		/**
		 * Branding and Header Menu
		 */
		$defaults['primary_menu_alignment']               = 'under';
		$defaults['brand_custom_css']                     = false;
		$defaults['branding_container_width']             = 'container';
		$defaults['primary_menu_container_width']         = 'container';
		$defaults['branding_menu_container_width']        = 'container';
		$defaults['header_bg_color_select']               = '-primary';
		$defaults['header_bg_color']                      = '#353535';
		$defaults['header_brand_color']                   = '#03a9f4';
		$defaults['brand_alignment']                      = 'left';
		$defaults['navbar_color_theme']                   = '-primary';
		$defaults['navbar_bg_color']                      = '#353535';
		$defaults['navbar_link_color']                    = '#03a9f4';
		$defaults['navbar_link_hover_color']              = '#027cb3';
        $defaults['navbar_alignment']                     = 'left';
		$defaults['menu_item_padding']                    = 15;

		/**
		 * Jumbotron
		 */
		$defaults['enable_jumbo']                         = false;
		$defaults['jumbotron_type']                       = 'css';
		$defaults['jumbo_container_width']                = 'container';
		$defaults['jumbotron_classes']                    = 'jumbotron-custom-class';
		$defaults['jumbotron_mp4_upload']                 = '';
		$defaults['jumbotron_ogg_upload']                 = '';
		$defaults['jumbotron_image_upload']               = '';
		$defaults['jumbotron_bg_color']                   = '#353535';
		$defaults['jumbotron_header']                     = '';
		$defaults['jumbotron_header_color']               = '#fff';
		$defaults['jumbotron_sub_header']                 = '';
		$defaults['jumbotron_sub_header_color']           = '#03a9f4';
		$defaults['jumbotron_content']                    = '';
		$defaults['jumbotron_content_color']              = '#fff';
		$defaults['jumbotron_cta_btn_text']               = 'Contact Us';
		$defaults['jumbotron_cta_btn_color']              = '#03a9f4';
		$defaults['jumbotron_cta_type']                   = 'modal';
		$defaults['jumbotron_cta_type_internal']          = '0';
		$defaults['jumbotron_bg_image_upload']             = '';
		$defaults['jumbotron_mp4_exp_upload']             = '';
		$defaults['jumbotron_ogg_exp_upload']             = '';

		/**
		 * Homepage Sections
		 */
		$defaults['homepage_sections']                    = '';
		$defaults['footer_cta_link']                      = '0';
		$defaults['footer_cta_btn_text']                  = 'Contact Us';
		$defaults['footer_locations_header']              = '';

		/**
		 * Footer
		 */
		$defaults['footer_cta_header']                    = '';

		/**
		 * Company Info
		 */
		$defaults['nrw_facebook']                         = '';
		$defaults['nrw_twitter']                          = '';
		$defaults['nrw_linkedin']                         = '';
		$defaults['nrw_instagram']                         = '';
		$defaults['nrw_github']                           = '';
		$defaults['nrw_phone_number']                     = '';
		$defaults['nrw_email_address']                    = '';
		$defaults['nrw_location']                         = 'Waukesha, Wisconsin';
		$defaults['nrw_address1']                         = '';
		$defaults['nrw_address2']                         = '';
		$defaults['nrw_city_state_zip']                   = 'Waukesha, WI 53189';
		$defaults['nrw_location_memo']                    = 'By Appointment Only';



		$defaults = apply_filters('nrw_filter_default_theme_options', $defaults);
		return $defaults;
	}

}