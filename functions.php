<?php
if ( ! defined( 'ABSPATH' ) ) exit;
define('NRW_TXT_DOMAIN', 'nrw-wp-theme');
define('NRW_CORE_PATH', get_template_directory() . '/core/');

function nrw_require_file( $path ) {
	if ( file_exists($path) ) {
		require $path;
	}
}
nrw_require_file( NRW_CORE_PATH . 'NrwInit.php' );

function p($var) {
	$is_prod = false;
	if(!$is_prod) {
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}
