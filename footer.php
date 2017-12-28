<?php
global $post;
if(isset($post)) {
	if('contact' != $post->post_name) {
		do_action('nrw_action_footer_cta');
	}
} else {
	do_action('nrw_action_footer_cta');
}

do_action('nrw_action_footer_locations_served');

do_action('nrw_action_footer_company_info');
?>

<footer id="nrw-footer" class="nrw-footer">
    <div class="container-fluid">
        <div class="row">
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
                                        <a href="#" class="icon-link">
                                            <i class="fa fa-phone"></i>
                                        </a>
                                    </span>
                                    <div class="nrw-footer-info-item-text">
                                        <a href="#" class="text-link">555-555-5555</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nrw-footer-info-item-outer-wrapper">
                            <div class="nrw-footer-info-item-inner-wrapper">
                                <div class="nrw-footer-info-item-icon-wrap">
                                    <span class="icon">
                                        <a href="#" class="icon-link">
                                            <i class="fa fa-envelope"></i>
                                        </a>
                                    </span>
                                    <div class="nrw-footer-info-item-text">
                                        <a href="#" class="text-link">joshuaszuslik@gmail.com</a>
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
            <div class="col-3">
                <div class="nrw-footer-info-wrapper">
                    <div class="nrw-footer-info-items">
                        <div class="nrw-footer-info-item-outer-wrapper">
                            <div class="nrw-footer-info-item-inner-wrapper">
                                <h4 class="nrw-footer-heading">Location</h4>
                                <p class="location location-header">Waukesha, Wisconsin</p>
                                <p class="location location-address">W257S6750 Fox Ct</p>
                                <p class="location location-address">Waukesha, WI 53189</p>
                                <p class="location location-appt">By Appointment Only</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="nrw-footer-info-wrapper">
                    <div class="nrw-footer-info-items">
                        <div class="nrw-footer-info-item-outer-wrapper">
                            <div class="nrw-footer-info-item-inner-wrapper">
                                <h4 class="nrw-footer-heading">Send us a message</h4>
                                <form>
                                    <div class="nrw-input-group-wrapper">
                                        <div class="nrw-input-text-wrapper nrw-input-half nrw-input-left">
                                            <input type="text" id="nrw_name" name="nrw_name" placeholder="Your Name" required>
                                        </div>
                                        <div class="nrw-input-text-wrapper nrw-input-half nrw-input-right">
                                            <input type="email" id="nrw_email" name="nrw_email" placeholder="Your Email" required>
                                        </div>
                                        <div class="nrw-input-text-wrapper">
                                            <input type="text" id="nrw_subject" name="nrw_subject" placeholder="Subject">
                                        </div>
                                        <div class="nrw-input-text-wrapper">
                                            <textarea id="nrw_message" name="nrw_message" placeholder="Your Message"></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="nrw-btn nrw-btn-blue nrw-btn-full">Send Your Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<?php wp_footer(); ?>
</body>
</html>