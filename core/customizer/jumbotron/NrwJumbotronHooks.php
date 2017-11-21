<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwJumbotronHooks {

	public function __construct() {

	}

	public function init() {

	}

	public function jumbotron_content() {
		$type = NrwCore::get_option('jumbotron_type');
		switch($type) {
			case 'css':
				break;
			case 'image':
				break;
			case 'video':
				break;
		}
	}

	public function jumbotron_start() {

	}

	public function jumbotron_end() {

	}

	public function jumbotron_css() { ?>
		
	<?php }

	public function jumbotron_image() {

	}

	public function jumbotron_video() {

	}

}