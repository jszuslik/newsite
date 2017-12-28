<?php

$custom_css = array('jumbotron-css');
$container = NrwCore::get_option('jumbo_container_width');
$custom_css[] = NrwCore::get_option('jumbotron_classes');
global $post;
$meta = get_post_meta($post->ID);

$services = 3;
$service_arr = array();
for($i = 1; $i <= $services; $i++) {
    if(isset($meta['service_' . $i . '_title'][0]) &&
                $meta['service_' .$i . '_icon'][0] &&
                $meta['service_' .$i . '_content'][0]) {
        $service_arr[] = array(
                'title'    => $meta['service_' . $i . '_title'][0],
                'icon'     => $meta['service_' . $i . '_icon'][0],
                'content'  => $meta['service_' . $i . '_content'][0],
                'link'     => get_permalink($meta['service_' . $i . '_link_id'][0])
        );
    }
}

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
<section id="nrw-services-page-content">
	<div class="container-fluid">
		<div class="row">
            <?php foreach ( $service_arr as $service ) : ?>
                <div class="col-4">
                    <div class="nrw-service-funnel">
                        <div class="nrw-service-funnel-icon-wrapper">
                            <img src="<?php echo $service['icon']; ?>" class="style-svg" />
                        </div>
                        <div class="nrw-service-funnel-content-wrapper">
                            <h2 class="funnel-title"><?php echo $service['title']; ?></h2>
                            <p class="funnel-content"><?php echo $service['content']; ?></p>
                            <a href="<?php echo $service['link']; ?>" class="nrw-btn nrw-btn-dark">Learn More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
		</div>
	</div>
</section>

