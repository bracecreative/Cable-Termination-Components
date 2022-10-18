<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php endwhile; else : ?>
				<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
