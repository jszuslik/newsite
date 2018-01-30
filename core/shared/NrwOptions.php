<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class NrwOptions {

	public static function get_bs_color_options() {

		$choices = array(
			'-primary'       => __( 'Primary', NRW_TXT_DOMAIN ),
			'-secondary'     => __('Secondary', NRW_TXT_DOMAIN ),
			'-success'       => __('Success', NRW_TXT_DOMAIN ),
			'-danger'        => __('Danger', NRW_TXT_DOMAIN ),
			'-warning'       => __('Warning', NRW_TXT_DOMAIN ),
			'-info'          => __('Info', NRW_TXT_DOMAIN ),
			'-light'         => __('Light', NRW_TXT_DOMAIN ),
			'-dark'          => __('Dark', NRW_TXT_DOMAIN ),
			'-custom'        => __('Custom', NRW_TXT_DOMAIN)
		);

		$output = apply_filters('nrw_theme_filter_ticker_theme', $choices);
		return $output;

	}

	public static function get_primary_menu_alignment_options() {

		$choices = array(
			'under'       => __('Menu Under Branding', NRW_TXT_DOMAIN),
			'inline'      => __('Menu Inline With Branding', NRW_TXT_DOMAIN)
		);

		$output = apply_filters('nrw_filter_menu_alignment_options', $choices);
		return $output;

	}

	public static function content_width_options() {

		$choices = array(
			'container'          => __('Contained', NRW_TXT_DOMAIN),
			'container-fluid'    => __('Full Width', NRW_TXT_DOMAIN)
		);

		$output = apply_filters('nrw_filter_menu_width_options', $choices);
		return $output;
	}

	public static function text_alignment_options() {

		$choices = array(
			'left'          => __('Left', NRW_TXT_DOMAIN),
			'center'        => __('Center', NRW_TXT_DOMAIN),
			'right'         => __('Right', NRW_TXT_DOMAIN)
		);

		$output = apply_filters('nrw_filter_text_alignment_options', $choices);
		return $output;
	}

	public static function menu_alignment_options() {
	    $choices = self::text_alignment_options();
	    $choices['justify'] = __('Justify', NRW_TXT_DOMAIN);

        $output = apply_filters('nrw_filter_menu_alignment_options', $choices);
        return $output;
    }

	public static function select_jumbotron_type_options() {

		$choices = array(
			'css'            => __( 'CSS Background', NRW_TXT_DOMAIN ),
			'image'          => __( 'Image Background', NRW_TXT_DOMAIN),
			'video'          => __( 'Video Background', NRW_TXT_DOMAIN)
		);

		$output = apply_filters('nrw_filter_jumbotron_type_options', $choices);
		return $output;

	}

	public static function select_jumbotron_cta_type_options() {

		$choices = array(
			'modal'            => __( 'Modal Popup', NRW_TXT_DOMAIN ),
			'internal'         => __( 'Internal Link', NRW_TXT_DOMAIN),
			'external'         => __( 'External Link', NRW_TXT_DOMAIN)
		);

		$output = apply_filters('nrw_filter_jumbotron_cta_type_options', $choices);
		return $output;

	}

	public static function get_hp_section_templates() {

		$choices = array(
			'tagline'            => __( 'Tagline Display', NRW_TXT_DOMAIN),
			'three-col-fun'      => __( 'Three Column Funnel', NRW_TXT_DOMAIN),
			'intro_cta'          => __( 'Intro CTA', NRW_TXT_DOMAIN ),
			'process_section'    => __( 'Process Section', NRW_TXT_DOMAIN),
			'choose_us'    => __( 'Choose Us Section', NRW_TXT_DOMAIN)
		);

		$output = apply_filters('nrw_filter_hpsection_templates', $choices);
		return $output;

	}

	public static function get_home_section_posts() {
		$args = array(
			'posts_per_page'  => -1,
			'post_type'       => 'homepage_section',
			'orderby'         => 'menu_order',
			'order'           => 'ASC'
		);
		$posts = get_posts($args);

		$choices = array();

		foreach ($posts as $post) :

			$choices[$post->post_name] = array(
				'label'      => $post->post_title,
				'template'   => get_post_meta($post->ID, "hp_section_templates", true),
				'enabled'    => get_post_meta($post->ID, 'enable_section', true),
				'menu_order' => $post->menu_order,
				'post_id'    => $post->ID
			);

		endforeach;

		$output = apply_filters( 'nrw_filter_home_section_posts', $choices );
		return $output;
	}

	public static function get_all_pages() {
		$args = array(
			'sort_order' => 'asc',
			'sort_column' => 'post_title',
			'hierarchical' => 1,
			'exclude' => '',
			'include' => '',
			'meta_key' => '',
			'meta_value' => '',
			'authors' => '',
			'child_of' => 0,
			'parent' => -1,
			'exclude_tree' => '',
			'number' => '',
			'offset' => 0,
			'post_type' => 'page',
			'post_status' => 'publish'
		);
		$pages = get_pages($args);

		$choices = array();
		foreach ($pages as $page) {
			$choices[$page->ID] = $page->post_title;
		}

		$output = apply_filters( 'nrw_filter_pages', $choices );
		return $output;
	}


}