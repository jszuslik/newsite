<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class NrwAlertsPostType {

    public function __construct() {

    }

    public function init() {
        add_action('init', array($this, 'nrw_alerts'));
        add_action('nrw_alert_ticker_action', array($this, 'get_alerts'));
        add_action( 'wp_footer', array($this, 'enable_news_slider') );

    }

    public function nrw_alerts() {

        $labels = array(
            'name'                  => _x( 'Alerts', 'Post Type General Name', 'nrw-wp-theme' ),
            'singular_name'         => _x( 'Alert', 'Post Type Singular Name', 'nrw-wp-theme' ),
            'menu_name'             => __( 'Alerts', 'nrw-wp-theme' ),
            'name_admin_bar'        => __( 'Alert', 'nrw-wp-theme' ),
            'archives'              => __( 'Alert Archives', 'nrw-wp-theme' ),
            'attributes'            => __( 'Alert Attributes', 'nrw-wp-theme' ),
            'parent_item_colon'     => __( 'Parent Alert:', 'nrw-wp-theme' ),
            'all_items'             => __( 'All Alerts', 'nrw-wp-theme' ),
            'add_new_item'          => __( 'Add New Alert', 'nrw-wp-theme' ),
            'add_new'               => __( 'Add New Alert', 'nrw-wp-theme' ),
            'new_item'              => __( 'New Alert', 'nrw-wp-theme' ),
            'edit_item'             => __( 'Edit Alert', 'nrw-wp-theme' ),
            'update_item'           => __( 'Update Alert', 'nrw-wp-theme' ),
            'view_item'             => __( 'View Alert', 'nrw-wp-theme' ),
            'view_items'            => __( 'View Alerts', 'nrw-wp-theme' ),
            'search_items'          => __( 'Search Alert', 'nrw-wp-theme' ),
            'not_found'             => __( 'Not found', 'nrw-wp-theme' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'nrw-wp-theme' ),
            'featured_image'        => __( 'Featured Image', 'nrw-wp-theme' ),
            'set_featured_image'    => __( 'Set featured image', 'nrw-wp-theme' ),
            'remove_featured_image' => __( 'Remove featured image', 'nrw-wp-theme' ),
            'use_featured_image'    => __( 'Use as featured image', 'nrw-wp-theme' ),
            'insert_into_item'      => __( 'Insert into alert', 'nrw-wp-theme' ),
            'uploaded_to_this_item' => __( 'Uploaded to this alert', 'nrw-wp-theme' ),
            'items_list'            => __( 'Items alert', 'nrw-wp-theme' ),
            'items_list_navigation' => __( 'Alerts list navigation', 'nrw-wp-theme' ),
            'filter_items_list'     => __( 'Filter alerts list', 'nrw-wp-theme' ),
        );
        $args = array(
            'label'                 => __( 'Alert', 'nrw-wp-theme' ),
            'description'           => __( 'Alert', 'nrw-wp-theme' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes', 'post-formats', ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-warning',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => false,
        );
        register_post_type( 'nrw_alerts', $args );
    }

    public function get_alerts() {
        $alerts = $this->get_alert_details();
        if ( empty( $alerts ) ) {
            return;
        } ?>
        <div id="news-ticker" style="display: inline-block;">
            <div class="news-ticker-inner-wrap">
                <?php foreach ($alerts as $alert) : ?>
                    <div class="list">
                        <a href="<?php echo esc_url( $alert['link'] ); ?>" class="alert-link"><?php echo esc_html($alert['text']); ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

    public function get_alert_details() {
        $output = array();
        $args = array(
            'post_type'        => 'nrw_alerts',
            'posts_per_page'   => 5
        );
        $alerts = get_posts($args);
        $i = 0;
        foreach($alerts as $alert) {
            $output[$i]['text'] = apply_filters('the_title', $alert->post_title);
            $output[$i]['link'] = get_permalink($alert->ID);
            $i++;
        }
        return $output;
    }

    public function enable_news_slider() { ?>
        <script type="text/javascript">
            jQuery(document).ready( function($) {
                $('.news-ticker-inner-wrap').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    fade: true,
                    cssEase: 'linear',
                    arrows: false
                });
            });
        </script>
    <?php }


}
$nrwalertsporttype = new NrwAlertsPostType();
$nrwalertsporttype->init();
