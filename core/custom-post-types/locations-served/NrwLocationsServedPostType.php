<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwLocationsServedPostType {

	public function __construct() {

	}

	public function init() {
		add_action( 'init', array($this, 'locations_served'), 0 );
	}

// Register Custom Post Type
	function locations_served() {

		$labels = array(
			'name'                  => _x( 'Locations', 'Post Type General Name', 'nrw-wp-theme' ),
			'singular_name'         => _x( 'Location', 'Post Type Singular Name', 'nrw-wp-theme' ),
			'menu_name'             => __( 'Locations', 'nrw-wp-theme' ),
			'name_admin_bar'        => __( 'Location', 'nrw-wp-theme' ),
			'archives'              => __( 'Location Archives', 'nrw-wp-theme' ),
			'attributes'            => __( 'Location Attributes', 'nrw-wp-theme' ),
			'parent_item_colon'     => __( 'Parent Location:', 'nrw-wp-theme' ),
			'all_items'             => __( 'All Locations', 'nrw-wp-theme' ),
			'add_new_item'          => __( 'Add New Location', 'nrw-wp-theme' ),
			'add_new'               => __( 'Add New', 'nrw-wp-theme' ),
			'new_item'              => __( 'New Location', 'nrw-wp-theme' ),
			'edit_item'             => __( 'Edit Location', 'nrw-wp-theme' ),
			'update_item'           => __( 'Update Location', 'nrw-wp-theme' ),
			'view_item'             => __( 'View Location', 'nrw-wp-theme' ),
			'view_items'            => __( 'View Locations', 'nrw-wp-theme' ),
			'search_items'          => __( 'Search Location', 'nrw-wp-theme' ),
			'not_found'             => __( 'Not found', 'nrw-wp-theme' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'nrw-wp-theme' ),
			'featured_image'        => __( 'Featured Image', 'nrw-wp-theme' ),
			'set_featured_image'    => __( 'Set featured image', 'nrw-wp-theme' ),
			'remove_featured_image' => __( 'Remove featured image', 'nrw-wp-theme' ),
			'use_featured_image'    => __( 'Use as featured image', 'nrw-wp-theme' ),
			'insert_into_item'      => __( 'Insert into Location', 'nrw-wp-theme' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Location', 'nrw-wp-theme' ),
			'items_list'            => __( 'Locations list', 'nrw-wp-theme' ),
			'items_list_navigation' => __( 'Locations list navigation', 'nrw-wp-theme' ),
			'filter_items_list'     => __( 'Filter Locations list', 'nrw-wp-theme' ),
		);
		$rewrite = array(
			'slug'                  => 'locations-served',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
		$args = array(
			'label'                 => __( 'Location', 'nrw-wp-theme' ),
			'description'           => __( 'All Locations Served', 'nrw-wp-theme' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'thumbnail' ),
			'taxonomies'            => array( ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-admin-site',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
			'show_in_rest'          => false,
		);
		register_post_type( 'locations_served', $args );

	}

}
$nrwlocationsservedposttype = new NrwLocationsServedPostType();
$nrwlocationsservedposttype->init();