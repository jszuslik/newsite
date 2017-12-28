<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwIntroMetaTemplate extends NrwBaseMetaTemplate {

	protected $meta_groups;

	public function __construct() {
		parent::__construct();

		$this->base_meta_groups[] = array(
				'name'         => __('Intro Settings', NRW_TXT_DOMAIN),
				'fields'       => array(
					array(
						'type'           => 'text',
						'name'           => 'nrw_intro_header',
						'id'             => 'nrw_intro_header',
						'label'          => __('Intro Header', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'color',
						'name'           => 'intro_header_color',
						'id'             => 'intro_header_color',
						'label'          => __('Header Color', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'textarea',
						'name'           => 'nrw_intro_content',
						'id'             => 'nrw_intro_content',
						'label'          => __('Intro Content', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'color',
						'name'           => 'intro_content_color',
						'id'             => 'intro_content_color',
						'label'          => __('Content Color', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'text',
						'name'           => 'nrw_intro_btn',
						'id'             => 'nrw_intro_btn',
						'label'          => __('Button Text', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'         => 'select',
						'name'         => 'nrw_intro_link',
						'id'           => 'nrw_intro_link',
						'choices'      => NrwOptions::get_all_pages(),
						'label'        => __( 'Intro Link', NRW_TXT_DOMAIN),
						'description'  => ''
					)
				)
		);
	}

	public function init() {
		$this->base_init();

	}

	public function init_save() {
		$this->base_init_save();

	}

}
$nrwintrometatemplate = new NrwIntroMetaTemplate();
if ( isset( $_GET['post'] ) ) {
	$post_id = $_GET['post'];
	$template_slug = get_post_meta($post_id, 'hp_section_templates', true);
	if('intro_cta' == $template_slug) {
		$nrwintrometatemplate->init();
	}
}
$nrwintrometatemplate->init_save();