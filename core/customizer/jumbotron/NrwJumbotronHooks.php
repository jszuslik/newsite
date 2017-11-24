<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwJumbotronHooks {

	public function __construct() {

	}

	public function init() {
		add_action('nrw_before_jumbotron_action', array($this, 'jumbotron_start'), 10);
		add_action('nrw_jumbtron_action', array($this, 'jumbotron_content'), 10);
		add_action('nrw_after_jumbotron_action', array($this, 'jumbotron_start'), 10);
	}

	public function jumbotron_content() {
		$type = NrwCore::get_option('jumbotron_type');
		switch($type) {
			case 'css':
				$this->jumbotron_css();
				break;
			case 'image':
				break;
			case 'video':
				break;
		}
	}

	public function jumbotron_start() { ?>
		<section id="nrw-jumbotron">
	<?php }

	public function jumbotron_end() { ?>
		</section>
	<?php }

	public function jumbotron_css() {
		$custom_css = array('jumbotron-css');
	    $container = NrwCore::get_option('jumbo_container_width');
	    $custom_css[] = NrwCore::get_option('jumbotron_classes');
	    $header = NrwCore::get_option('jumbotron_header');
	    $sub_header = NrwCore::get_option('jumbotron_sub_header');
	    $content = NrwCore::get_option('jumbotron_content');
		$btn_text = NrwCore::get_option('jumbotron_cta_btn_text');
		$mp4 = NrwCore::get_option('jumbotron_mp4_exp_upload');
		$ogg = NrwCore::get_option('jumbotron_ogg_exp_upload');
	    $cta_type = NrwCore::get_option('jumbotron_cta_type');
	    $btn_link = '';
	    switch($cta_type) {
            case 'internal':
                $btn_link = get_the_permalink(NrwCore::get_option('jumbotron_cta_type_internal'));
                break;
        }
	    ?>
        <div class="<?php echo implode(' ', $custom_css); ?>">
            <div class="<?php echo $container; ?>">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="jumbo-content-wrapper">
                            <h1 class="jumbo-header"><?php echo $header; ?></h1>
                            <h3 class="jumbo-sub-header"><?php echo $sub_header; ?></h3>
                            <p class="jumbo-content"><?php echo $content; ?></p>
                            <a class="jumbo-btn" href="<?php echo $btn_link; ?>"><?php echo $btn_text; ?></a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="jumbo-video-wrapper">
                            <video class="video-background" preload="" muted="" autoplay="" loop="">
                                <source src="<?php echo wp_get_attachment_url($mp4); ?>" type="video/mp4">
                                <source src="<?php echo wp_get_attachment_url($ogg); ?>" type="video/ogg">
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php }

	public function jumbotron_image() {

	}

	public function jumbotron_video() {

	}

}

$nrwjumbotronhooks = new NrwJumbotronHooks();
$nrwjumbotronhooks->init();

