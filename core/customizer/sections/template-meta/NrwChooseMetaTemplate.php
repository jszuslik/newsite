<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwChooseMetaTemplate extends NrwBaseMetaTemplate {

	protected $meta_groups;

	public function __construct() {
		parent::__construct();

		$this->base_meta_groups[] = array(
				'name'         => __('Why Choose Us Settings', NRW_TXT_DOMAIN),
				'fields'       => array(
					array(
						'type'           => 'text',
						'name'           => 'nrw_choose_header',
						'id'             => 'nrw_choose_header',
						'label'          => __('Why Choose Us Header', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'color',
						'name'           => 'choose_header_color',
						'id'             => 'choose_header_color',
						'label'          => __('Header Color', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'text',
						'name'           => 'nrw_choose_header_1',
						'id'             => 'nrw_choose_header_1',
						'label'          => __('Why #1 Header', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'textarea',
						'name'           => 'nrw_choose_content_1',
						'id'             => 'nrw_choose_content_1',
						'label'          => __('Why #1 Description', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'text',
						'name'           => 'nrw_choose_header_2',
						'id'             => 'nrw_choose_header_2',
						'label'          => __('Why #2 Header', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'textarea',
						'name'           => 'nrw_choose_content_2',
						'id'             => 'nrw_choose_content_2',
						'label'          => __('Why #2 Description', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'text',
						'name'           => 'nrw_choose_header_3',
						'id'             => 'nrw_choose_header_3',
						'label'          => __('Why #3 Header', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'textarea',
						'name'           => 'nrw_choose_content_3',
						'id'             => 'nrw_choose_content_3',
						'label'          => __('Why #3 Description', NRW_TXT_DOMAIN),
						'description'    => ''
					),
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
$nrwchoosemetatemplate = new NrwChooseMetaTemplate();
if ( isset( $_GET['post'] ) ) {
	$post_id = $_GET['post'];
	$template_slug = get_post_meta($post_id, 'hp_section_templates', true);
	if('choose_us' == $template_slug) {
		$nrwchoosemetatemplate->init();
	}
}
$nrwchoosemetatemplate->init_save();