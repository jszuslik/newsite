<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwHeaderHooks {

	public function __construct() {

	}

	public function init() {
		add_action('nrw_action_before_header', array($this, 'header_start'), 5);
		add_action('nrw_action_after_header', array($this, 'header_end'), 15);
	}

	public function header_start() {
		if(NrwCore::get_option('fixed_header')) :
			?> <div class="fixed-top"> <?php
		endif;
	}

	public function header_end() {
		if(NrwCore::get_option('fixed_header')) :
			?> </div> <?php
		endif;
	}

	public function news_ticker() {
		if(NrwCore::get_option('show_ticker')) :
			$ticker_theme = NrwCore::get_option('ticker_theme'); ?>
			<div class="tophead ticker<?php echo $ticker_theme; ?>">
				<div class="container">
					<div class="top-news">
						<div class="ticker" role="alert">
                        <span class="top-news-title">
                            <?php $ticker_title = OmniCore::omni_wp_theme_get_option( 'ticker_title' );  ?>
                            <?php echo ( ! empty( $ticker_title ) ) ? esc_html( $ticker_title ) : '&nbsp;'; ?>
                        </span>
							<?php echo OmniCommon::omni_wp_theme_get_new_ticker_content(); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif;
	}

}
$nrwheaderhooks = new NrwHeaderHooks();
$nrwheaderhooks->init();