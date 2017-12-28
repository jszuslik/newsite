<?php
$custom_css = array('jumbotron-css');
$container = NrwCore::get_option('jumbo_container_width');
$custom_css[] = NrwCore::get_option('jumbotron_classes');
global $post;
$meta = get_post_meta($post->ID);

?>
<section id="nrw-page-jumbotron">
	<div class="<?php echo implode(' ', $custom_css); ?>">
		<div class="container">
			<div class="row">
				<div class="col-12">
                    <div class="nrw-page-header-wrapper">
                        <h2 class="nrw-page-header"><?php echo $meta['service_page_header'][0]; ?></h2>
	                    <?php if (get_the_content()) :
		                    the_content();
	                    endif; ?>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>
