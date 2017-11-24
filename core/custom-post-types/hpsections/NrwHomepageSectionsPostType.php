<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwHomepageSectionsPostType {

	private $meta_groups;

	public function __construct() {
		$this->meta_groups = array(
			array(
				'name'       => __('', NRW_TXT_DOMAIN),
				'fields'     => array(
					array(
						'type'         => 'select',
						'name'         => 'hp_section_templates',
						'id'           => 'hp_section_templates',
						'choices'      => NrwOptions::get_hp_section_templates(),
						'label'        => __( 'Section Content Width', NRW_TXT_DOMAIN),
						'description'  => ''
					)
				)
			)
		);
	}

	public function init() {
		add_action( 'init', array($this, 'homepage_sections_post_type'), 0 );
		add_action( 'add_meta_boxes', array($this, 'add_meta_boxes') );
		add_action('save_post', array( $this, 'save_meta_data' ) );
	}

	public function homepage_sections_post_type() {

		$labels = array(
			'name'                  => _x( 'Homepage Sections', 'Post Type General Name', 'omni-wp-theme' ),
			'singular_name'         => _x( 'Homepage Section', 'Post Type Singular Name', 'omni-wp-theme' ),
			'menu_name'             => __( 'Homepage Sections', 'omni-wp-theme' ),
			'name_admin_bar'        => __( 'Homepage Section', 'omni-wp-theme' ),
			'archives'              => __( 'Homepage Sections Archives', 'omni-wp-theme' ),
			'attributes'            => __( 'Homepage Sections Attributes', 'omni-wp-theme' ),
			'parent_item_colon'     => __( 'Parent Homepage Section:', 'omni-wp-theme' ),
			'all_items'             => __( 'All Homepage Sections', 'omni-wp-theme' ),
			'add_new_item'          => __( 'Add New Homepage Section', 'omni-wp-theme' ),
			'add_new'               => __( 'Add New Homepage Section', 'omni-wp-theme' ),
			'new_item'              => __( 'New Homepage Section', 'omni-wp-theme' ),
			'edit_item'             => __( 'Edit Homepage Section', 'omni-wp-theme' ),
			'update_item'           => __( 'Update Homepage Section', 'omni-wp-theme' ),
			'view_item'             => __( 'View Homepage Section', 'omni-wp-theme' ),
			'view_items'            => __( 'View Homepage Sections', 'omni-wp-theme' ),
			'search_items'          => __( 'Search Homepage Section', 'omni-wp-theme' ),
			'not_found'             => __( 'Not found', 'omni-wp-theme' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'omni-wp-theme' ),
			'featured_image'        => __( 'Featured Image', 'omni-wp-theme' ),
			'set_featured_image'    => __( 'Set featured image', 'omni-wp-theme' ),
			'remove_featured_image' => __( 'Remove featured image', 'omni-wp-theme' ),
			'use_featured_image'    => __( 'Use as featured image', 'omni-wp-theme' ),
			'insert_into_item'      => __( 'Insert into Homepage Section', 'omni-wp-theme' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Homepage Section', 'omni-wp-theme' ),
			'items_list'            => __( 'Homepage Sections list', 'omni-wp-theme' ),
			'items_list_navigation' => __( 'Homepage Sections list navigation', 'omni-wp-theme' ),
			'filter_items_list'     => __( 'Filter Homepage Sections list', 'omni-wp-theme' ),
		);
		$args = array(
			'label'                 => __( 'Homepage Section', 'omni-wp-theme' ),
			'description'           => __( 'Homepage Section', 'omni-wp-theme' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'revisions', 'page-attributes', ),
			'taxonomies'            => array( 'homepage_section' ),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'rewrite'               => false,
			'capability_type'       => 'page',
			'show_in_rest'          => false,
		);
		register_post_type( 'homepage_section', $args );

	}

	public function add_template_select_meta_box() {
		add_meta_box(
			'omni_hp_section_templates',
			__('Section Options', NRW_TXT_DOMAIN),
			array($this, 'hp_section_render_template_select'),
			'homepage_section',
			'side',
			'default'
		);
	}

	public function hp_section_render_template_select($post) {
		wp_nonce_field('hp_section_nonce_action', 'hp_section_nonce');
		echo NrwCore::render_meta_boxes($this->meta_groups, get_post_meta($post->ID));

	}

	public function save_meta_data($post_id) {
		$nonce_name   = isset( $_POST['hp_section_nonce'] ) ? $_POST['hp_section_nonce'] : '';
		$nonce_action = 'hp_section_nonce_action';

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