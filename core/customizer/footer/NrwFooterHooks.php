<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwFooterHooks {

	public function __construct() {

	}

	public function init() {
		add_action('nrw_action_footer_cta', array($this, 'nrw_footer_cta'), 10);
		add_action('nrw_action_footer_locations_served', array($this, 'nrw_footer_locations_served'), 10);
		add_action('nrw_action_footer_company_info', array($this, 'nrw_footer_company_info'), 10);
	}

	public function nrw_footer_cta() {
		$header = NrwCore::get_option('footer_cta_header');
		$btn_text = NrwCore::get_option('footer_cta_btn_text');
		$link_id = NrwCore::get_option('footer_cta_link');
		$link = get_the_permalink($link_id);

		?>
		<section id="nrw-footer-cta-section" class="nrw-footer-cta-section">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<h2 class="footer-cta-header"><?php echo $header; ?></h2>
						<a href="<?php echo $link; ?>" class="nrw-btn nrw-btn-light"><?php echo $btn_text; ?></a>
					</div>
				</div>
			</div>
		</section>
	<?php }

	public function nrw_footer_locations_served() {

	    $args = array(
            'post_type'         => 'locations_served',
            'posts_per_page'    => -1,
            'order'             => 'ASC'
        );

	    $q = new WP_Query($args);

	    ?>
		<section id="nrw-footer-serving-section" class="nrw-footer-serving-section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h5 class="nrw-serving-section-header">Proudly Serving the Following Communities and Beyond</h5>
						<div class="row nrw-serving-section-list">
                            <?php while ($q->have_posts()) : $q->the_post(); ?>
							<div class="col-2">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</div>
                            <?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php }

	public function nrw_footer_company_info() { ?>
        <footer id="nrw-footer" class="nrw-footer">
            <div class="container-fluid">
                <div class="row">
                    <?php $this->nrw_contact_column(); ?>
                </div>
            </div>
        </footer>
    <?php }

    public function nrw_social_media_info() {

    }

    private function sanitize_phone_number($phone) {
	    if(!isset($phone{3})) { return ''; }

	    $phone = preg_replace("/[^0-9]/", "", $phone);
	    $length = strlen($phone);
	    switch($length) {
		    case 7:
			    return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
			    break;
		    case 10:
			    return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
			    break;
		    case 11:
			    return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1($2) $3-$4", $phone);
			    break;
		    default:
			    return $phone;
			    break;
	    }
    }

    private function get_phone_link($phone) {
	    $phone = preg_replace("/[^0-9]/", "", $phone);
	    return 'tel:+1' . $phone;
    }

    public function nrw_contact_column() {
	    $phone_raw = NrwCore::get_option('nrw_phone_number');
	    $phone = $this->sanitize_phone_number($phone_raw);
	    $phone_link = $this->get_phone_link($phone);
	    $email = NrwCore::get_option('nrw_email_address');

	    ?>
        <div class="col-3">
            <div class="nrw-footer-info-wrapper">
                <div class="nrw-footer-info-items">
                    <div class="nrw-footer-info-item-outer-wrapper">
                        <div class="nrw-footer-info-item-inner-wrapper">
                            <h4 class="nrw-footer-heading">Contact Us</h4>
                        </div>
                    </div>
                    <div class="nrw-footer-info-item-outer-wrapper">
                        <div class="nrw-footer-info-item-inner-wrapper">
                            <div class="nrw-footer-info-item-icon-wrap">
                                            <span class="icon">
                                                <a href="<?php echo $phone_link; ?>" class="icon-link">
                                                    <i class="fa fa-phone"></i>
                                                </a>
                                            </span>
                                <div class="nrw-footer-info-item-text">
                                    <a href="<?php echo $phone_link; ?>" class="text-link"><?php echo $phone; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nrw-footer-info-item-outer-wrapper">
                        <div class="nrw-footer-info-item-inner-wrapper">
                            <div class="nrw-footer-info-item-icon-wrap">
                                            <span class="icon">
                                                <a href="mailto:<?php echo $email; ?>" class="icon-link">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            </span>
                                <div class="nrw-footer-info-item-text">
                                    <a href="mailto:<?php echo $email; ?>" class="text-link"><?php echo $email; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nrw-footer-info-item-outer-wrapper">
                        <div class="nrw-footer-info-item-inner-wrapper">
                            <div class="nrw-footer-info-item-icon-wrap">
                                            <span class="icon">
                                                <a href="#" class="icon-link">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </span>
                                <div class="nrw-footer-info-item-text">
                                    <a href="#" class="text-link">No Rules Web</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }

    public function nrw_location_column() {

    }
}
$nrwfooterhooks = new NrwFooterHooks();
$nrwfooterhooks->init();