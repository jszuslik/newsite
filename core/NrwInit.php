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

		nrw_require_file(NRW_CORE_PATH . 'objects/NrwBaseImage.php');
		nrw_require_file(NRW_CORE_PATH . 'objects/NrwBaseSection.php');
		nrw_require_file(NRW_CORE_PATH . 'objects/NrwChoiceImageSection.php');

		nrw_require_file(NRW_CORE_PATH . 'custom-post-types/alerts/NrwAlertsPostType.php');
		nrw_require_file(NRW_CORE_PATH . 'custom-post-types/hpsections/NrwHomepageSectionsPostType.php');
		nrw_require_file(NRW_CORE_PATH . 'custom-post-types/locations-served/NrwLocationsServedPostType.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/NrwCustomizer.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/frontend/css/NrwFrontendCss.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/frontend/js/NrwFrontendJs.php');
        nrw_require_file(NRW_CORE_PATH . 'customizer/structure/NrwStructureHooks.php');
		nrw_require_file(NRW_CORE_PATH . 'forms/NrwFormHooks.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/header/NrwHeaderHooks.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/jumbotron/NrwJumbotronHooks.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/sections/NrwSectionHooks.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/footer/NrwFooterHooks.php');



		nrw_require_file(NRW_CORE_PATH . 'customizer/sections/template-meta/NrwBaseMetaTemplate.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/sections/template-meta/NrwTaglineMetaTemplate.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/sections/template-meta/NrwFunnelsMetaTemplate.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/sections/template-meta/NrwIntroMetaTemplate.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/sections/template-meta/NrwChooseMetaTemplate.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/sections/template-meta/NrwChooseImagesMetaTemplate.php');
		nrw_require_file(NRW_CORE_PATH . 'customizer/sections/template-meta/NrwProcessMetaTemplate.php');

		nrw_require_file(NRW_CORE_PATH . 'meta-templates/NrwServicesPageMeta.php');
		nrw_require_file(NRW_CORE_PATH . 'meta-templates/NrwServicePageMeta.php');
	}

}
$nrwinit = new NrwInit();
$nrwinit->init();