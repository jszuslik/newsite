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
                    <?php $this->nrw_location_column(); ?>
                    <?php $this->nrw_ftr_contact_form(); ?>
                </div>
            </div>
        </footer>
    <?php }

    public function nrw_ftr_contact_form() { ?>
        <div class="col-4">
            <div class="nrw-footer-info-wrapper">
                <div class="nrw-footer-info-items">
                    <div class="nrw-footer-info-item-outer-wrapper">
                        <div class="nrw-footer-info-item-inner-wrapper">
                            <h4 class="nrw-footer-heading">Send us a message</h4>
                            <?php do_action('nrw_action_footer_form'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }

    public function nrw_social_media_info() {
        $facebook_url = NrwCore::get_option('nrw_facebook');
        $twitter_url = NrwCore::get_option('nrw_twitter');
        $linkedin_url = NrwCore::get_option('nrw_linkedin');
        $instagram_url = NrwCore::get_option('nrw_instagram');
	    $github_url = NrwCore::get_option('nrw_github');
	    ?>
        <div class="nrw-footer-info-item-icon-wrap">
        <?php if(isset($facebook_url) && strlen($facebook_url) > 0) : ?>
            <span class="icon social-icon">
                <a href="<?php echo $facebook_url; ?>" target="_blank" class="icon-link social-icon-link">
                    <i class="fa fa-facebook-square"></i>
                </a>
            </span>
        <?php endif; ?>
	    <?php if(isset($twitter_url) && strlen($twitter_url) > 0) : ?>
            <span class="icon social-icon">
                <a href="<?php echo $twitter_url; ?>" target="_blank" class="icon-link social-icon-link">
                    <i class="fa fa-twitter-square"></i>
                </a>
            </span>
	    <?php endif; ?>
	    <?php if(isset($linkedin_url) && strlen($linkedin_url) > 0) : ?>
            <span class="icon social-icon">
                <a href="<?php echo $linkedin_url; ?>" target="_blank" class="icon-link social-icon-link">
                    <i class="fa fa-linkedin-square"></i>
                </a>
            </span>
	    <?php endif; ?>
	    <?php if(isset($instagram_url) && strlen($instagram_url) > 0) : ?>
            <span class="icon social-icon">
                <a href="<?php echo $instagram_url; ?>" target="_blank" class="icon-link social-icon-link">
                    <i class="fa fa-instagram"></i>
                </a>
            </span>
	    <?php endif; ?>
	    <?php if(isset($github_url) && strlen($github_url) > 0) : ?>
            <span class="icon social-icon">
                <a href="<?php echo $github_url; ?>" target="_blank" class="icon-link social-icon-link">
                    <i class="fa fa-github-square"></i>
                </a>
            </span>
	    <?php endif; ?>
        </div>
    <?php }

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
                            <?php $this->nrw_social_media_info(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }

    public function nrw_location_column() {
	    $location = null;
	    $address1 = null;
	    $address2 = null;
	    $citystatezip = null;
	    $memo = null;
	    if(NrwCore::get_option('nrw_location') != null) {
		    $location = NrwCore::get_option('nrw_location');
        }
	    if(NrwCore::get_option('nrw_address1') != null) {
		    $address1 = NrwCore::get_option('nrw_address1');
	    }
	    if(NrwCore::get_option('nrw_address2') != null) {
		    $address2 = NrwCore::get_option('nrw_address2');
	    }
	    if(NrwCore::get_option('nrw_city_state_zip') != null) {
		    $citystatezip = NrwCore::get_option('nrw_city_state_zip');
	    }
	    if(NrwCore::get_option('nrw_location_memo') != null) {
		    $memo = NrwCore::get_option('nrw_location_memo');
	    }


	    ?>
        <div class="col-3">
            <div class="nrw-footer-info-wrapper">
                <div class="nrw-footer-info-items">
                    <div class="nrw-footer-info-item-outer-wrapper">
                        <div class="nrw-footer-info-item-inner-wrapper">
                            <h4 class="nrw-footer-heading">Location</h4>
	                        <?php if($location != null ) : ?>
                                <p class="location location-header"><?php echo $location; ?></p>
                            <?php endif; ?>
	                        <?php if($address1 != null ) : ?>
                                <p class="location location-address"><?php echo $address1; ?></p>
                            <?php endif; ?>
	                        <?php if($address2 != null ) : ?>
                                <p class="location location-address"><?php echo $address2; ?></p>
	                        <?php endif; ?>
	                        <?php if($citystatezip != null ) : ?>
                                <p class="location location-address"><?php echo $citystatezip; ?></p>
	                        <?php endif; ?>
	                        <?php if($memo != null ) : ?>
                                <p class="location location-appt"><?php echo $memo; ?></p>
	                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php }

    public function nrw_footer_copyright() {
	    ?>
        <section id="nrw-footer-copyright">
            <div class="container-fluid">

            </div>
        </section>
    <?php }


}
$nrwfooterhooks = new NrwFooterHooks();
$nrwfooterhooks->init();