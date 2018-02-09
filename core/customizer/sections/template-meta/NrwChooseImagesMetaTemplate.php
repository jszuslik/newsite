<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwChooseImagesMetaTemplate extends NrwBaseMetaTemplate {

	protected $meta_groups;

	public function __construct() {
		parent::__construct();

		$choices = 4;
		for($i = 1; $i <= $choices; $i++) {
			$this->base_meta_groups[] = array(
				'name'   => __( 'Choice '. $i .' Title', NRW_TXT_DOMAIN ),
				'fields' => array(
					array(
						'type'        => 'text',
						'name'        => 'nrw_choice_'. $i .'_title',
						'id'          => 'nrw_choice_'. $i .'_title',
						'label'       => __( 'Choice '. $i .' Title', NRW_TXT_DOMAIN ),
						'description' => ''
					),
					array(
						'type'        => 'textarea',
						'name'        => 'nrw_choice_'. $i .'_content',
						'id'          => 'nrw_choice_'. $i .'_content',
						'label'       => __( 'Choice '. $i .' Content', NRW_TXT_DOMAIN ),
						'description' => ''
					),
					array(
						'type'        => 'image',
						'name'        => 'nrw_choice_'. $i .'_image',
						'id'          => 'nrw_choice_'. $i .'_image',
						'btn_id'      => 'btn_nrw_choice_'. $i .'_image',
						'label'       => __( 'Choice '. $i .' Image', NRW_TXT_DOMAIN ),
						'description' => ''
					)
				)
			);
		}
	}

	public function init() {
		$this->base_init();

	}

	public function init_save() {
		$this->base_init_save();

	}

}
$nrwchooseimagesmetatemplate = new NrwChooseImagesMetaTemplate();
if ( isset( $_GET['post'] ) ) {
	$post_id = $_GET['post'];
	$template_slug = get_post_meta($post_id, 'hp_section_templates', true);
	if('choose_images' == $template_slug) {
		$nrwchooseimagesmetatemplate->init();
	}
}
$nrwchooseimagesmetatemplate->init_save();