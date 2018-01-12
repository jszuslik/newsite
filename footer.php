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

<?php wp_footer(); ?>
</body>
</html>