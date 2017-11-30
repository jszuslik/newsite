<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwFrontendJs {

	public function __construct() {

	}

	public function init() {
		if(NrwCore::get_option('fixed_header')) {
			add_action( 'wp_footer', array($this, 'enable_shrink_header') );
		}
	}

	public function enable_shrink_header() { ?>
		<script type="text/javascript">
            jQuery(document).on("scroll", function(){
                if
                (jQuery(document).scrollTop() > 100){
                    jQuery(".nrw-brand-inline-menu-wrapper").addClass("shrink");
                }
                else
                {
                    jQuery(".nrw-brand-inline-menu-wrapper").removeClass("shrink");
                }
            });
		</script>

	<?php }

}
$nrwfrontendjs = new NrwFrontendJs();
$nrwfrontendjs->init();