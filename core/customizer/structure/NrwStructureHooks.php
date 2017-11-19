<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwStructureHooks {

	public function __construct() {

	}

	public function init() {
		add_action('nrw_action_head', array($this, 'doctype'), 5);
		add_action('nrw_action_head', array($this, 'head'), 10);
	}

	public function doctype() {
		?> <!DOCTYPE HTML> <html <?php language_attributes(); ?>><?php
	}

	public function head() { ?>
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>"/>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
			<meta name="viewport" content="width=device-width, initial-scale=1"/>
			<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
			<?php wp_head(); ?>
		</head>
	<?php }

}
$nrwstructurehooks = new NrwStructureHooks();
$nrwstructurehooks->init();