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
		add_action('nrw_intro_cta_action', array($this, 'intro_cta'), 10);
		add_action('nrw_process_section_action', array($this, 'process_section'), 10);
		add_action('nrw_choose_us_section_action', array($this, 'choose_us_section'), 10);
		add_action('nrw_choose_images_section_action', array($this, 'choose_images_section'), 10);

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
                    case 'intro_cta':
                        do_action('nrw_intro_cta_action');
                        break;
                    case 'process_section':
                        do_action('nrw_process_section_action');
                        break;
                    case 'choose_us':
                        do_action('nrw_choose_us_section_action');
                        break;
					case 'choose_images':
						do_action('nrw_choose_images_section_action');
						break;
				}

			}

			echo '</div><!-- #front-page-home-sections -->';
		}

		$post = $orig_post;
	}

	public function choose_images_section() {
		global $post;
		$meta = get_post_meta( $post->ID );
		$id = $meta['nrw_section_id'][0];

		$choices = 4;
		$choice_arr = array();
		for($i = 1; $i <= $choices; $i++) {
			if(isset($meta['nrw_choice_'. $i . '_title'][0]) &&
			   isset($meta['nrw_choice_'. $i . '_content'][0]) &&
			   isset($meta['nrw_choice_'. $i . '_image'][0])) {
				$choice_arr[] = array(
					'title'       => $meta['nrw_choice_'. $i . '_title'][0],
					'content'     => $meta['nrw_choice_'. $i . '_content'][0],
					'icon'        => $meta['nrw_choice_'. $i . '_image'][0]
				);
			}
		}

		?>
        <section id="<?php echo $id; ?>" class="nrw-choose-images-section-wrapper"  style="background: <?php echo $bg_color; ?>;">
            <div class="nrw-choose-us-section">
                <div class="container">
                    <div class="row">
                        <div class="col-6 col-md-8">
                            <div class="nrw-image-outer-wrapper">
                                <div class="nrw-image-inner-wrapper">
                                    <img src="http://newsite.dev/wp-content/uploads/2018/02/collaborative-custom-design-focused-on-obtaining-leads.jpg" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="nrw-image-outer-wrapper">
                                <div class="nrw-image-inner-wrapper">
                                    <img src="http://newsite.dev/wp-content/uploads/2018/02/seo.jpg" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <div class="nrw-image-outer-wrapper">
                                <div class="nrw-image-inner-wrapper">
                                    <img src="http://newsite.dev/wp-content/uploads/2018/02/custom-code.jpg" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-8">
                            <div class="nrw-image-outer-wrapper">
                                <div class="nrw-image-inner-wrapper">
                                    <img src="http://newsite.dev/wp-content/uploads/2018/02/responsive-design.jpg" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

	<?php }

	public function choose_us_section() {
		global $post;
		$meta = get_post_meta($post->ID);
		$id = $meta['nrw_section_id'][0];
		$bg_color = $meta['base_bg_color'][0];
		$header_color = $meta['choose_header_color'][0];
		$header_text = $meta['nrw_choose_header'][0];

		$header_arr = explode(' ', $header_text);

		$c = count($header_arr);
		$d = round(($c/2), 0, PHP_ROUND_HALF_UP);

		$header_start = '';
		$header_end = '';

		for($i = 0; $i < $c; $i++) {
			if($i < $d) {
			    $header_start .= $header_arr[$i] . ' ';
			} else {
				$header_end .= $header_arr[$i] . ' ';
            }
		}

		$content_1 = $meta['nrw_choose_content_1'][0];
		$content_2 = $meta['nrw_choose_content_2'][0];
		$content_3 = $meta['nrw_choose_content_3'][0];
		?>

        <section id="<?php echo $id; ?>" class="nrw-process-section-wrapper"  style="background: <?php echo $bg_color; ?>;">
            <div class="nrw-choose-us-section">
                <div class="container" style="max-width: 955px;">
                    <div class="row">
                        <div class="col-12">
                            <div class="nrw-choose-header">
                                <h2 class="nrw-choose-title" style="color: <?php echo $header_color; ?>">
                                    <?php echo $header_start; ?>
                                </h2>
                                <br>
                                <h2 class="nrw-choose-title" style="color: <?php echo $header_color; ?>">
                                    <?php echo $header_end; ?>
                                </h2>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="nrw-choose-desc-bold-color" style="color: <?php echo $header_color; ?>"><?php echo $content_1; ?></p>
                        </div>
                        <div class="col-12 col-md-6">
                            <p class="card-text"><?php echo $content_2; ?></p>
                            <p class="card-text"><?php echo $content_3; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php }

	public function process_section() {
		global $post;
		$meta = get_post_meta($post->ID);
		$id = $meta['nrw_section_id'][0];
		$bg_color = $meta['base_bg_color'][0];
		$header = $meta['nrw_process_header'][0];

		$phases = 7;
		$phase_arr = array();
		for($i = 1; $i <= $phases; $i++) {
		    if(isset($meta['nrw_process_phase_'. $i . '_title'][0]) &&
               isset($meta['nrw_process_phase_'. $i . '_content'][0]) &&
		       isset($meta['nrw_process_phase_'. $i . '_icon'][0])) {
		        $phase_arr[] = array(
                    'title'       => $meta['nrw_process_phase_'. $i . '_title'][0],
                    'content'     => $meta['nrw_process_phase_'. $i . '_content'][0],
                    'icon'        => $meta['nrw_process_phase_'. $i . '_icon'][0]
                );
            }
        }
		?>
        <section id="<?php echo $id; ?>" class="nrw-process-section-wrapper">
            <div id="nrw-process-section">
                <div class="container-fluid" style="background: <?php echo $bg_color; ?>;">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="nrw-process-header">
			                    <?php echo $header; ?>
                            </h2>
                        </div>
		<?php
        $ph_i = 1;
        foreach ($phase_arr as $phase) :
            $col = 'col-lg-4';
            if($ph_i <=4) {
	            $col = 'col-lg-3';
            }
            ?>
                       <div class="col-12 col-sm-6 <?php echo $col; ?>">
                            <div id="nrw-card-<?php echo $ph_i; ?>" class="card nrw-card">
                                <div class="card-header">
                                    <img class="card-img-top style-svg" src="<?php echo $phase['icon']; ?>">
                                    <h5 class="card-title"><?php echo $phase['title']; ?></h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $phase['content']; ?></p>
                                </div>
                            </div>
                       </div>
		<?php
        $ph_i++;
        endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php }

	public function intro_cta() {
	    global $post;
	    $meta = get_post_meta($post->ID);
	    $id = $meta['nrw_section_id'][0];
	    $bg_color = $meta['base_bg_color'][0];
	    $header_color = $meta['intro_header_color'][0];
	    $header_text = $meta['nrw_intro_header'][0];
	    $content = $meta['nrw_intro_content'][0];
		$content_color = $meta['intro_content_color'][0];
		$btn_text = $meta['nrw_intro_btn'][0];
		$btn_link_id = $meta['nrw_intro_link'][0];
        $btn_link = get_permalink($btn_link_id);
	    ?>
        <section id="<?php echo $id; ?>" class="nrw-intro-section" style="background: <?php echo $bg_color; ?>; border-color: <?php echo $header_color; ?>">
            <div class="nrw-intro-cta-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="nrw-intro-title" style="color: <?php echo $header_color; ?>">
                                <?php echo $header_text; ?>
                            </h2>
                            <p style="color: <?php echo $content_color; ?> "><?php echo $content; ?></p>
                            <a href="<?php echo $btn_link; ?>" class="nrw-btn nrw-btn-orange"><?php echo $btn_text;
                            ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php }

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
							<h2 class="nrw-tagline" style="color: <?php echo $text_color; ?>"><?php echo $tag_start . $tag_end; ?></h2>
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
		$link_1_id = $meta['funnel_1_link_id'][0];
        $link_1 = get_permalink($link_1_id);

		$svg_2 = $meta['funnel_2_icon'][0];
		$header_2 = $meta['funnel_2_title'][0];
		$content_2 = $meta['funnel_2_content'][0];
		$link_2_id = $meta['funnel_2_link_id'][0];
		$link_2 = get_permalink($link_2_id);

		$svg_3 = $meta['funnel_3_icon'][0];
		$header_3 = $meta['funnel_3_title'][0];
		$content_3 = $meta['funnel_3_content'][0];
		$link_3_id = $meta['funnel_3_link_id'][0];
		$link_3 = get_permalink($link_3_id);

		?>
		<section id="<?php echo $meta['nrw_section_id'][0]; ?>" style="position: relative; z-index: 1;">
            <div class="nrw-funnel-section" style="background: <?php echo $bg_color; ?>; padding: 50px 0 75px">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4">
                            <div class="funnel funnel-featured">
                                <div class="funnel-icon-wrapper">
                                    <img src="<?php echo $svg_1; ?>" class="style-svg" />
                                </div>
                                <div class="funnel-content-wrapper">
                                    <h2 class="funnel-title">
                                        <?php echo $header_1; ?>
                                    </h2>
                                    <p class="funnel-content"><?php echo $content_1; ?></p>
                                    <a href="<?php echo $link_1; ?>" class="nrw-btn nrw-btn-dark">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="funnel funnel-featured">
                                <div class="funnel-icon-wrapper">
                                    <img src="<?php echo $svg_2; ?>" class="style-svg" />
                                </div>
                                <div class="funnel-content-wrapper">
                                    <h2 class="funnel-title">
					                    <?php echo $header_2; ?>
                                    </h2>
                                    <p class="funnel-content"><?php echo $content_2; ?></p>
                                    <a href="<?php echo $link_2; ?>" class="nrw-btn nrw-btn-dark">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="funnel funnel-featured">
                                <div class="funnel-icon-wrapper">
                                    <img src="<?php echo $svg_3; ?>" class="style-svg" />
                                </div>
                                <div class="funnel-content-wrapper">
                                    <h2 class="funnel-title">
					                    <?php echo $header_3; ?>
                                    </h2>
                                    <p class="funnel-content"><?php echo $content_3; ?></p>
                                    <a href="<?php echo $link_3; ?>" class="nrw-btn nrw-btn-dark">Learn More</a>
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