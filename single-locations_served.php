<?php
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();



?>
	<div class="container-fluid no-gutters" style="padding: 0;">
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
						get_template_part( 'template-parts/content', 'locations_served' );
						?>

					<?php endwhile; ?>


				<?php else : ?>

					<?php get_template_part( 'no-results', 'index' ); ?>

				<?php endif; ?>
			</main>
		</div>
	</div>
<?php get_footer();
