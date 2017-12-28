<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwBaseMetaTemplate {

	protected $base_meta_groups;

	public function __construct() {
		$this->base_meta_groups = array(
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
						'name'           => 'base_bg_color',
						'id'             => 'base_bg_color',
						'label'          => __('Background Color', NRW_TXT_DOMAIN),
						'description'    => ''
					)
				)
			)
		);
	}

	public function base_init() {
		add_action( 'add_meta_boxes', array($this, 'add_base_meta_boxes') );
		add_action('admin_print_styles', array( $this, 'meta_image_enqueue'));
		add_action( 'admin_enqueue_scripts', array($this, 'add_color_picker_scripts') );
	}

	public function base_init_save() {
		add_action('save_post', array( $this, 'save_base_meta_data' ) );
	}

	public function add_base_meta_boxes() {
		add_meta_box(
			'nrw_hp_base_template',
			__('Section Settings', NRW_TXT_DOMAIN),
			array($this, 'render_base_meta_boxes'),
			'homepage_section',
			'normal',
			'default'
		);
	}

	public function render_base_meta_boxes($post) {
		wp_nonce_field('hp_base_nonce_action', 'hp_base_nonce');
		echo NrwCore::render_meta_boxes($this->base_meta_groups, get_post_meta($post->ID));
	}

	public function save_base_meta_data($post_id) {
		$nonce_name   = isset( $_POST['hp_base_nonce'] ) ? $_POST['hp_base_nonce'] : '';
		$nonce_action = 'hp_base_nonce_action';

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

		foreach ( $this->base_meta_groups as $field_group ) {
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

	public function meta_image_enqueue(){
		wp_enqueue_media();
		wp_enqueue_style( 'wpb-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
		// Registers and enqueues the required javascript.
		wp_register_script( 'meta-box-image', get_template_directory_uri() . '/admin/js/admin-meta.js', array( 'jquery' ) );
		wp_localize_script( 'meta-box-image', 'meta_image',
		                    array(
			                    'title' => __( 'Choose or Upload a File', NRW_TXT_DOMAIN ),
			                    'button' => __( 'Use this file', NRW_TXT_DOMAIN ),
		                    )
		);
		wp_enqueue_script( 'meta-box-image' );
	}

	public function add_color_picker_scripts($hook) {
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('nrw-color-picker-js', get_template_directory_uri() . '/admin/js/nrw-color-picker.js',
		                  array(	'wp-color-picker' ), false, true);
	}
}