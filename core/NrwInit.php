<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class NrwInit {

	public function __construct() {

	}

	public function init() {
		nrw_require_file(NRW_CORE_PATH . 'NrwSetup.php');
		nrw_require_file(NRW_CORE_PATH . 'bootstrap-navigation/WP_Bootstrap_Navwalker.php');

		nrw_require_file(NRW_CORE_PATH . 'NrwCore.php');
		nrw_require_file(NRW_CORE_PATH . 'shared/NrwOptions.php');
		nrw_require_file(NRW_CORE_PATH . 'custom-post-types/alerts/NrwAlertsPostType.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/NrwCustomizer.php');
        nrw_require_file(NRW_CORE_PATH . 'customizer/structure/NrwStructureHooks.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/header/NrwHeaderHooks.php');
	}

}
$nrwinit = new NrwInit();
$nrwinit->init();