<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwTaglineMetaTemplate {

	private $meta_groups;

	public function __construct() {
		$this->meta_groups = array(
			array(
				'name'         => __('', NRW_TXT_DOMAIN),
				'fields'       => array(
					array(
						'type'           => 'text',
						'name'           => 'nrw_section_id',
						'id'             => 'nrw_section_id',
						'label'          => __('Section ID', NRW_TXT_DOMAIN),
						'description'    => 'This is used for one page navigation or custom css'
					),
					array(
						'type'           => 'color',
						'name'           => 'tagline_bg_color',
						'id'             => 'tagline_bg_color',
						'label'          => __('Background Color', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'color',
						'name'           => 'tagline_border_color',
						'id'             => 'tagline_border_color',
						'label'          => __('Border Color', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'color',
						'name'           => 'tagline_text_color',
						'id'             => 'tagline_text_color',
						'label'          => __('Text Color', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'           => 'color',
						'name'           => 'tagline_accent_color',
						'id'             => 'tagline_accent_color',
						'label'          => __('Accent Color', NRW_TXT_DOMAIN),
						'description'    => ''
					)
				)
			)
		);
	}

	public function init() {
		add_action( 'add_meta_boxes', array($this, 'add_meta_boxes') );

	}

	public function init_save() {
		add_action('save_post', array( $this, 'save_meta_data' ) );
	}

	public function add_meta_boxes() {
		add_meta_box(
			'nrw_hp_tagline_template',
			__('Section Settings', NRW_TXT_DOMAIN),
			array($this, 'render_meta_boxes'),
			'homepage_section',
			'normal',
			'default'
		);
	}

	public function render_meta_boxes( $post ) {
		wp_nonce_field('hp_tagline_nonce_action', 'hp_tagline_nonce');
		echo NrwCore::render_meta_boxes($this->meta_groups, get_post_meta($post->ID));
	}

	public function save_meta_data($post_id) {
		$nonce_name   = isset( $_POST['hp_tagline_nonce'] ) ? $_POST['hp_tagline_nonce'] : '';
		$nonce_action = 'hp_tagline_nonce_action';

		if ( ! isset( $nonce_name ) ) {
			return;
		}

		// Check if nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
			return;
		}

		// Check if user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Check if not an autosave.
		if ( wp_is_post_autosave( $post_id ) ) {
			return;
		}

		// Check if not a revision.
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		foreach ( $this->meta_groups as $field_group ) {
			foreach ( $field_group['fields'] as $field ) {
				if ( 'check' == $field['type'] || 'enable_opt_in' == $field['type'] ) {
					foreach ( $field['choices'] as $key => $choice ) {
						if ( isset( $_POST[ $field['id'] . '_' . $key ] ) ) {
							update_post_meta( $post_id, $field['id'] . '_' . $key, $key );
						} else {
							update_post_meta( $post_id, $field['id'] . '_' . $key, '' );
						}
					}
				} elseif ( 'radio' == $field['type'] ) {
					update_post_meta( $post_id, $field['id'], sanitize_html_class( $_POST[ $field['id'] ] ) );
				} elseif ( isset( $_POST[ $field['id'] ] ) ) {
					update_post_meta( $post_id, $field['id'], sanitize_text_field( $_POST[ $field['id'] ] ) );
				}
			}
		}
	}

}
$nrwtaglinemetatemplate = new NrwTaglineMetaTemplate();
if ( isset( $_GET['post'] ) ) {
	$post_id = $_GET['post'];
	$template_slug = get_post_meta($post_id, 'hp_section_templates', true);
	if('tagline' == $template_slug) {
		$nrwtaglinemetatemplate->init();
	}
}
$nrwtaglinemetatemplate->init_save();
