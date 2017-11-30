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
					),
					array(
						'type'         => 'check',
						'name'         => 'enable_section',
						'id'           => 'enable_section',
						'choices'      => array(
							'enabled'   => __('Enable Section', NRW_TXT_DOMAIN)
						),
						'label'        => '',
						'description'  => ''
					)
				)
			)
		);
	}

	public function init() {
		add_action( 'init', array($this, 'homepage_sections_post_type'), 0 );
		add_action( 'add_meta_boxes', array($this, 'add_template_select_meta_box') );
		add_action('save_post', array( $this, 'save_meta_data' ) );

		add_action( 'wp_ajax_nopriv_nrw_ajax_update_post_menu_order', array($this, 'nrw_ajax_update_post_menu_order') );
		add_action( 'wp_ajax_nrw_ajax_update_post_menu_order', array($this, 'nrw_ajax_update_post_menu_order') );
		add_action( 'wp_ajax_nopriv_nrw_ajax_update_enable_section', array($this, 'nrw_ajax_update_enable_section') );
		add_action( 'wp_ajax_nrw_ajax_update_enable_section', array($this, 'nrw_ajax_update_enable_section') );
	}

	public function homepage_sections_post_type() {

		$labels = array(
			'name'                  => _x( 'Homepage Sections', 'Post Type General Name', NRW_TXT_DOMAIN ),
			'singular_name'         => _x( 'Homepage Section', 'Post Type Singular Name', NRW_TXT_DOMAIN ),
			'menu_name'             => __( 'Homepage Sections', NRW_TXT_DOMAIN ),
			'name_admin_bar'        => __( 'Homepage Section', NRW_TXT_DOMAIN ),
			'archives'              => __( 'Homepage Sections Archives', NRW_TXT_DOMAIN ),
			'attributes'            => __( 'Homepage Sections Attributes', NRW_TXT_DOMAIN ),
			'parent_item_colon'     => __( 'Parent Homepage Section:', NRW_TXT_DOMAIN ),
			'all_items'             => __( 'All Homepage Sections', NRW_TXT_DOMAIN ),
			'add_new_item'          => __( 'Add New Homepage Section', NRW_TXT_DOMAIN ),
			'add_new'               => __( 'Add New Homepage Section', NRW_TXT_DOMAIN ),
			'new_item'              => __( 'New Homepage Section', NRW_TXT_DOMAIN ),
			'edit_item'             => __( 'Edit Homepage Section', NRW_TXT_DOMAIN ),
			'update_item'           => __( 'Update Homepage Section', NRW_TXT_DOMAIN ),
			'view_item'             => __( 'View Homepage Section', NRW_TXT_DOMAIN ),
			'view_items'            => __( 'View Homepage Sections', NRW_TXT_DOMAIN ),
			'search_items'          => __( 'Search Homepage Section', NRW_TXT_DOMAIN ),
			'not_found'             => __( 'Not found', NRW_TXT_DOMAIN ),
			'not_found_in_trash'    => __( 'Not found in Trash', NRW_TXT_DOMAIN ),
			'featured_image'        => __( 'Featured Image', NRW_TXT_DOMAIN ),
			'set_featured_image'    => __( 'Set featured image', NRW_TXT_DOMAIN ),
			'remove_featured_image' => __( 'Remove featured image', NRW_TXT_DOMAIN ),
			'use_featured_image'    => __( 'Use as featured image', NRW_TXT_DOMAIN ),
			'insert_into_item'      => __( 'Insert into Homepage Section', NRW_TXT_DOMAIN ),
			'uploaded_to_this_item' => __( 'Uploaded to this Homepage Section', NRW_TXT_DOMAIN ),
			'items_list'            => __( 'Homepage Sections list', NRW_TXT_DOMAIN ),
			'items_list_navigation' => __( 'Homepage Sections list navigation', NRW_TXT_DOMAIN ),
			'filter_items_list'     => __( 'Filter Homepage Sections list', NRW_TXT_DOMAIN ),
		);
		$args = array(
			'label'                 => __( 'Homepage Section', NRW_TXT_DOMAIN ),
			'description'           => __( 'Homepage Section', NRW_TXT_DOMAIN ),
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
			'hp_section_templates',
			__('Section Options', NRW_TXT_DOMAIN),
			array($this, 'hp_section_render_template_select'),
			'homepage_section',
			'side',
			'default'
		);
	}

	public function hp_section_render_template_select($post) {
		// p(NrwOptions::get_home_section_posts());
		wp_nonce_field('hp_section_nonce_action', 'hp_section_template_nonce');
		echo NrwCore::render_meta_boxes($this->meta_groups, get_post_meta($post->ID));

	}

	public function save_meta_data($post_id) {
		$nonce_name   = isset( $_POST['hp_section_template_nonce'] ) ? $_POST['hp_section_template_nonce'] : '';
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
						if ( isset( $_POST[ $field['id']] ) ) {
							update_post_meta( $post_id, $field['id'], $key );
						} else {
							update_post_meta( $post_id, $field['id'], '' );
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

	public function nrw_ajax_update_post_menu_order() {
		global $wpdb;
		$post = get_post($_POST['post_id']);
		$menu_order = $_POST['menu_order'];
		$wpdb->update($wpdb->posts, array( 'menu_order' => $menu_order), array('ID' => $post->ID));

		die();
	}

	public function nrw_ajax_update_enable_section() {
		global $wpdb;
		$post = get_post($_POST['post_id']);
		$enabled = $_POST['value'];
		if ('true' == $enabled) {
			echo 'Post Id - ' . $post->ID . '- Is Enabled - ' . $wpdb->update($wpdb->postmeta, array('meta_value' => 'enabled'), array('post_id' => $post->ID, 'meta_key' => 'enable_section'));
		} else {
			echo 'Post Id - ' . $post->ID . '- Is Enabled - ' . $wpdb->update($wpdb->postmeta, array('meta_value' => ''), array('post_id' => $post->ID, 'meta_key' => 'enable_section'));
		}
		die();
	}

}
$nrwhomepagesectionsposttype = new NrwHomepageSectionsPostType();
$nrwhomepagesectionsposttype->init();