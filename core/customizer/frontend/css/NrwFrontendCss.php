<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwFrontendCss {

	public function __construct() {

	}

	public function init() {
		add_action('wp_head', array($this, 'add_styles'));
	}

	public function add_styles() {
		$ticker_dark_color = NrwCore::get_option('ticker_dark_color');
		$ticker_light_color = NrwCore::get_option('ticker_light_color');
		$header_bg_color = NrwCore::get_option('header_bg_color');
		$header_brand_color = NrwCore::get_option('header_brand_color');
		$brand_alignment = NrwCore::get_option('brand_alignment');
		$navbar_bg_color = NrwCore::get_option('navbar_bg_color');
		$navbar_link_color = NrwCore::get_option('navbar_link_color');
		$navbar_link_hover_color = NrwCore::get_option('navbar_link_hover_color');
		?>
		<style id="nrw-frontend-custom-css">

			.ticker-custom {
				background-color: <?php echo $ticker_dark_color; ?>;
			}

			.ticker-custom .top-news-title {
				background-color: <?php echo $ticker_light_color; ?>;
				color: <?php echo $ticker_dark_color; ?>;
			}

			.ticker-custom .top-news-title::after {
				border-left: 16px solid <?php echo $ticker_light_color; ?>;
				border-top: 41px solid <?php echo $ticker_dark_color; ?>;
			}

			.ticker-custom .top-news a {
				color: <?php echo $ticker_light_color; ?>;
			}

            .nrw-header-bg-custom {
                background-color: <?php echo $header_bg_color; ?>;
            }
            .site-branding {
                text-align: <?php echo $brand_alignment; ?>;
            }
            .nrw-header-bg-custom .navbar-brand {
                color: <?php echo $header_brand_color; ?>;
            }

            .nrw-navbar-custom {
                background-color: <?php echo $navbar_bg_color; ?>;
            }

            .nrw-navbar-custom a {
                color: <?php echo $navbar_link_color; ?>;
            }

            .nrw-navbar-custom a:hover {
                 color: <?php echo $navbar_link_hover_color; ?>;
            }

		</style>
	<?php }
}
$nrwfrontendcss = new NrwFrontendCss();
$nrwfrontendcss->init();