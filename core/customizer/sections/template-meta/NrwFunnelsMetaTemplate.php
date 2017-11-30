<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwFunnelsMetaTemplate {

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
						'name'           => 'funnel_bg_color',
						'id'             => 'funnel_bg_color',
						'label'          => __('Background Color', NRW_TXT_DOMAIN),
						'description'    => ''
					)
				)
			),
			array(
				'name'      => __('Funnel One', NRW_TXT_DOMAIN),
				'fields'    => array(
					array(
						'type'           => 'text',
						'name'           => 'funnel_1_title',
						'id'             => 'funnel_1_title',
						'label'          => __('Funnel 1 Title', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'         => 'image',
						'name'         => 'funnel_1_icon',
						'id'           => 'funnel_1_icon',
						'btn_id'       => 'btn_funnel_1_icon',
						'label'        => __('Funnel 1 Image', NRW_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'textarea',
						'name'         => 'funnel_1_content',
						'id'           => 'funnel_1_content',
						'label'        => __('Funnel 1 Content', NRW_TXT_DOMAIN),
						'description'  => ''
					),
				)
			),
			array(
				'name'      => __('Funnel Two', NRW_TXT_DOMAIN),
				'fields'    => array(
					array(
						'type'           => 'text',
						'name'           => 'funnel_2_title',
						'id'             => 'funnel_2_title',
						'label'          => __('Funnel 2 Title', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'         => 'image',
						'name'         => 'funnel_2_icon',
						'id'           => 'funnel_2_icon',
						'btn_id'       => 'btn_funnel_2_icon',
						'label'        => __('Funnel 2 Image', NRW_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'textarea',
						'name'         => 'funnel_2_content',
						'id'           => 'funnel_2_content',
						'label'        => __('Funnel 2 Content', NRW_TXT_DOMAIN),
						'description'  => ''
					),
				)
			),
			array(
				'name'      => __('Funnel Three', NRW_TXT_DOMAIN),
				'fields'    => array(
					array(
						'type'           => 'text',
						'name'           => 'funnel_3_title',
						'id'             => 'funnel_3_title',
						'label'          => __('Funnel 3 Title', NRW_TXT_DOMAIN),
						'description'    => ''
					),
					array(
						'type'         => 'image',
						'name'         => 'funnel_3_icon',
						'id'           => 'funnel_3_icon',
						'btn_id'       => 'btn_funnel_3_icon',
						'label'        => __('Funnel 3 Image', NRW_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'textarea',
						'name'         => 'funnel_3_content',
						'id'           => 'funnel_3_content',
						'label'        => __('Funnel 3 Content', NRW_TXT_DOMAIN),
						'description'  => ''
					),
				)
			)
		);
	}

	public function init() {
		add_action( 'add_meta_boxes', array($this, 'add_meta_boxes') );
		add_action('admin_print_styles', array( $this, 'meta_image_enqueue'));

	}

	public function init_save() {
		add_action('save_post', array( $this, 'save_meta_data' ) );
	}

	public function add_meta_boxes() {
		add_meta_box(
			'nrw_hp_funnel_template',
			__('Section Settings', NRW_TXT_DOMAIN),
			array($this, 'render_meta_boxes'),
			'homepage_section',
			'normal',
			'default'
		);
	}

	public function render_meta_boxes( $post ) {
		wp_nonce_field('hp_funnel_nonce_action', 'hp_funnel_nonce');
		echo NrwCore::render_meta_boxes($this->meta_groups, get_post_meta($post->ID));
	}

	public function save_meta_data($post_id) {
		$nonce_name   = isset( $_POST['hp_funnel_nonce'] ) ? $_POST['hp_funnel_nonce'] : '';
		$nonce_action = 'hp_funnel_nonce_action';

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

}
$nrwfunnelsmetatemplate = new NrwFunnelsMetaTemplate();
if ( isset( $_GET['post'] ) ) {
	$post_id = $_GET['post'];
	$template_slug = get_post_meta($post_id, 'hp_section_templates', true);
	if('three-col-fun' == $template_slug) {
		$nrwfunnelsmetatemplate->init();
	}
}
$nrwfunnelsmetatemplate->init_save();