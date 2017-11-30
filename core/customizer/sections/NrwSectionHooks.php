<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwSectionHooks {

	public function __construct() {

	}

	public function init() {
		add_action('nrw_action_homepage_sections', array($this, 'active_homepage_sections'), 1);
		add_action('nrw_tagline_action', array($this, 'tagline'), 10);
		add_action('nrw_funnel_action', array($this, 'funnels'), 10);
	}

	public function active_homepage_sections() {
		global $post;
		$orig_post = $post;
		$active_sections = NrwCore::get_active_homepage_sections();
		//p($active_sections);

		if ( ! empty( $active_sections ) ) {
			echo '<div id="front-page-home-sections" class="widget-area">';
			foreach ( $active_sections as $section ) {
				$post = $section;
				$template = get_post_meta($post->ID, 'hp_section_templates', true);
				switch($template) {
					case 'tagline':
						do_action('nrw_tagline_action');
						break;
					case 'three-col-fun':
						do_action('nrw_funnel_action');
						break;
				}

			}

			echo '</div><!-- #front-page-home-sections -->';
		}

		$post = $orig_post;
	}

	public function tagline() {
		global $post;
		$meta = get_post_meta($post->ID);
		$bg_color = $meta['tagline_bg_color'][0];
		$border_color = $meta['tagline_border_color'][0];
		$text_color = $meta['tagline_text_color'][0];
		$accent_color = $meta['tagline_accent_color'][0];
		$tagline = get_bloginfo('description');
		$tag_arr = explode(' ', $tagline);

		$c = count($tag_arr);
		$d = round(($c/2), 0, PHP_ROUND_HALF_DOWN);
		$tag_start = '';
		$tag_end = '';
		$tag_start .= '<span style="color: ' . $accent_color . '">';
		for($i = 0; $i < $c; $i++) {
			if($i < $d) {
				$tag_start .= $tag_arr[$i] . ' ';
			} else {
				$tag_end .= $tag_arr[$i] . ' ';
			}
		}
		$tag_start .= '</span>';
		?>
		<section id="<?php echo $meta['nrw_section_id'][0]; ?>" style="position: relative; z-index: 2; margin-bottom:-20px;">
			<div class="nrw-tagline-section" style="background: <?php echo $bg_color; ?>; border-top: 3px solid <?php
		echo $border_color; ?>">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h2 class="nrw-tagline" style="color: <?php echo $text_color; ?>"><?php echo $tag_start .
							                                                                       $tag_end; ?></h2>
						</div>
					</div>
				</div>
			</div>
			<div class="nrw-arrow-down" style="border-top: 20px solid <?php echo $bg_color; ?>"></div>
		</section>
	<?php }

	public function funnels() {
		global $post;
		$meta = get_post_meta($post->ID);
		$bg_color = $meta['funnel_bg_color'][0];
		$svg_1 = $meta['funnel_1_icon'][0];
		$header_1 = $meta['funnel_1_title'][0];
		$content_1 = $meta['funnel_1_content'][0];

		$svg_2 = $meta['funnel_2_icon'][0];
		$header_2 = $meta['funnel_2_title'][0];
		$content_2 = $meta['funnel_2_content'][0];

		$svg_3 = $meta['funnel_3_icon'][0];
		$header_3 = $meta['funnel_3_title'][0];
		$content_3 = $meta['funnel_3_content'][0];

		?>
		<section id="<?php echo $meta['nrw_section_id'][0]; ?>" style="position: relative; z-index: 1;">
            <div class="nrw-funnel-section" style="background: <?php echo $bg_color; ?>; padding: 50px 0 75px">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4">
                            <div class="funnel funnel-normal">
                                <div class="funnel-icon-wrapper">
                                    <img src="<?php echo $svg_1; ?>" />
                                </div>
                                <div class="funnel-content-wrapper">
                                    <h2 class="funnel-title">
                                        <?php echo $header_1; ?>
                                    </h2>
                                    <p class="funnel-content"><?php echo $content_1; ?></p>
                                    <a href="#" class="nrw-btn nrw-btn-light">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="funnel funnel-featured">
                                <div class="funnel-icon-wrapper">
                                    <img src="<?php echo $svg_2; ?>" />
                                </div>
                                <div class="funnel-content-wrapper">
                                    <h2 class="funnel-title">
					                    <?php echo $header_2; ?>
                                    </h2>
                                    <p class="funnel-content"><?php echo $content_2; ?></p>
                                    <a href="#" class="nrw-btn nrw-btn-dark">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="funnel funnel-normal">
                                <div class="funnel-icon-wrapper">
                                    <img src="<?php echo $svg_3; ?>" />
                                </div>
                                <div class="funnel-content-wrapper">
                                    <h2 class="funnel-title">
					                    <?php echo $header_3; ?>
                                    </h2>
                                    <p class="funnel-content"><?php echo $content_3; ?></p>
                                    <a href="#" class="nrw-btn nrw-btn-light">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</section>
	<?php }

}
$nrwsectionshook = new NrwSectionHooks();
$nrwsectionshook->init();