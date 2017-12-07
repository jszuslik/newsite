<?php

if ( ! defined( 'ABSPATH' ) ) exit;
get_header();



?>
<?php if ( 'page' == get_option('show_on_front') && is_front_page() ) : ?>
	<?php
	if(NrwCore::get_option('enable_jumbo')) :
		do_action('nrw_before_jumbotron_action');
		do_action( 'nrw_jumbtron_action');
		do_action( 'nrw_after_jumbotron_action');
	endif;

	do_action('nrw_action_homepage_sections');

	?>
<?php else : ?>
	<div class="container">
		<div id="primary">
			<main id="main">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
						?>

					<?php endwhile; ?>


				<?php else : ?>

					<?php get_template_part( 'no-results', 'index' ); ?>

				<?php endif; ?>
			</main>
		</div>
	</div>
<?php endif; ?>
<?php get_footer();