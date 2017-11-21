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

	public function jumbotron_css() { ?>
		<h2>I am a jumbotron!</h2>
	<?php }

	public function jumbotron_image() {

	}

	public function jumbotron_video() {

	}

}
$nrwjumbotronhooks = new NrwJumbotronHooks();
$nrwjumbotronhooks->init();