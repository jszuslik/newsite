<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwHeaderHooks {

	public function __construct() {

	}

	public function init() {
		add_action('nrw_action_before_header', array($this, 'header_start'), 5);
        add_action('nrw_action_before_header', array($this, 'news_ticker'), 10);
		add_action('nrw_action_after_header', array($this, 'header_end'), 15);
		add_action('nrw_action_header', array($this, 'branding_menu'));
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
            do_action('nrw_alert_ticker_action');
		endif;
	}

	public function branding_menu() {
	    $style = NrwCore::get_option('primary_menu_alignment');
	    switch($style) {
            case 'under':
	            $this->branding_above_menu();
	            break;
            case 'inline':
                $this->branding_inline_menu();
                break;
        }

    }

    private function branding_above_menu() { ?>
        <div class="nrw-brand-above-menu-wrapper nrw-header-bg<?php echo NrwCore::get_option('header_bg_color_select'); ?>">
            <div class="container-fluid no-gutters">
                <div class="nrw-branding-wrapper">
                    <div class="<?php echo NrwCore::get_option('branding_container_width'); ?>">
                        <div class="site-branding">
	                        <?php if(!has_custom_logo()) { ?>
                                <a class="navbar-brand" href="/"><h1><?php bloginfo('name'); ?></h1></a>
	                        <?php } else { ?>
		                        <?php the_custom_logo(); ?>
	                        <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="nrw-menu-wrapper">
                    <div class="<?php echo NrwCore::get_option('primary_menu_container_width'); ?>">
                        <nav class="navbar navbar-expand-md nrw-navbar<?php echo NrwCore::get_option('navbar_color_theme'); ?>">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
	                        <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location'	=> 'primary',
                                        'depth'				=> 2,
                                        'container'			=> 'div',
                                        'container_class'	=> 'collapse navbar-collapse',
                                        'container_id'		=> 'navbarSupportedContent',
                                        'menu_class'		=> 'navbar-nav mr-auto',
                                        'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
                                        'walker'			=> new WP_Bootstrap_Navwalker()
                                    )
                                );
	                        ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    <?php }

    private function branding_inline_menu() {

    }

}
$nrwheaderhooks = new NrwHeaderHooks();
$nrwheaderhooks->init();