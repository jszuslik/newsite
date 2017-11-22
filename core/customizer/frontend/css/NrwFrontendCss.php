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
		$navbar_link_side_padding = NrwCore::get_option('menu_item_padding');
		$jumbotron_bg_color = NrwCore::get_option('jumbotron_bg_color');
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
            .navbar .navbar-nav .nav-item .nav-link {
                padding-left: <?php echo $navbar_link_side_padding; ?>px;
                padding-right: <?php echo $navbar_link_side_padding; ?>px;
            }

            .nrw-navbar-custom .nav-item .nav-link {
                color: <?php echo $navbar_link_color; ?>;
            }

            .nrw-navbar-custom .nav-item .nav-link:hover {
                 color: <?php echo $navbar_link_hover_color; ?>;
            }

            .nrw-navbar-custom .nav-item.active::after,
            .nrw-navbar-custom .nav-item::after {
                background: <?php echo $navbar_link_hover_color; ?>;
            }

            .jumbotron-css {
                background: <?php echo $jumbotron_bg_color; ?>;
                color: #fff;
            }

		</style>
	<?php }
}
$nrwfrontendcss = new NrwFrontendCss();
$nrwfrontendcss->init();