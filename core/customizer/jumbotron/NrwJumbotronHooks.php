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
	    $header = NrwCore::get_option('jumbotron_header');
	    $sub_header = NrwCore::get_option('jumbotron_sub_header');
	    $content = NrwCore::get_option('jumbotron_content');
	    ?>
        <div class="jumbotron-css">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <h2><?php echo $header; ?></h2>
                        <h2><?php echo $sub_header; ?></h2>
                        <p><?php echo $content; ?></p>
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

