<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwProcessMetaTemplate extends NrwBaseMetaTemplate {

	public function __construct() {
		parent::__construct();

		$this->base_meta_groups[] = array(
			'name'            => __('Process Settings', NRW_TXT_DOMAIN),
			'fields'          => array(
				array(
					'type'         => 'text',
					'name'         => 'nrw_process_header',
					'id'           => 'nrw_process_header',
					'label'        => __('Process Section Header', NRW_TXT_DOMAIN),
					'description'  => ''
				)
			)
		);

		$phases = 7;
		for($i = 1; $i <= $phases; $i++) {
			$this->base_meta_groups[] = array(
				'name'   => __( 'Phase '. $i .' Title', NRW_TXT_DOMAIN ),
				'fields' => array(
					array(
						'type'        => 'text',
						'name'        => 'nrw_process_phase_'. $i .'_title',
						'id'          => 'nrw_process_phase_'. $i .'_title',
						'label'       => __( 'Phase '. $i .' Title', NRW_TXT_DOMAIN ),
						'description' => ''
					),
					array(
						'type'        => 'textarea',
						'name'        => 'nrw_process_phase_'. $i .'_content',
						'id'          => 'nrw_process_phase_'. $i .'_content',
						'label'       => __( 'Phase '. $i .' Content', NRW_TXT_DOMAIN ),
						'description' => ''
					),
					array(
						'type'        => 'image',
						'name'        => 'nrw_process_phase_'. $i .'_icon',
						'id'          => 'nrw_process_phase_'. $i .'_icon',
						'btn_id'      => 'btn_nrw_process_phase_'. $i .'_icon',
						'label'       => __( 'Phase '. $i .' Image', NRW_TXT_DOMAIN ),
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
$nrwprocessmetatemplate = new NrwProcessMetaTemplate();
if ( isset( $_GET['post'] ) ) {
	$post_id = $_GET['post'];
	$template_slug = get_post_meta($post_id, 'hp_section_templates', true);
	if('process_section' == $template_slug) {
		$nrwprocessmetatemplate->init();
	}
}
$nrwprocessmetatemplate->init_save();