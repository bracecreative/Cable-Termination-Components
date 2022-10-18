<?php /* Template Name: About Us Page Template */ ?>

<?php get_header(); ?>

	<main role="main">
		<?php get_template_part( 'template-parts/banner' ); ?>

		<div class="about__us__wrapper">
			<div class="about__us__inner container">
				<?php $image = get_field('image'); ?>
				<div class="image__wrapper">
					<img src="<?php echo $image['url']; ?>">
				</div>
				<div class="text__wrapper">
					<h1 class="title">
						<?php the_field('title'); ?>
					</h1>
					<div class="text__area">
						<?php the_field('text_area'); ?>
					</div>
				</div>
			</div>
		</div>
		<?php get_template_part( 'template-parts/cta-bar' ); ?>
		<?php get_template_part( 'template-parts/latest-products' ); ?>
	</main>

<?php get_footer(); ?>
