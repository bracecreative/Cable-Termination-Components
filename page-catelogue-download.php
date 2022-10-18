<?php /* Template Name: Catelogue Download Page Template */ ?>

<?php get_header(); ?>

	<main role="main">
		<?php get_template_part( 'template-parts/banner' ); ?>

		<div class="catalogue__wrapper">
			<div class="catalogue__wrapper__inner catalogue__wrapper__container">
				<div class="image">
					<?php $image = get_field('catalogue_preview_image'); ?>
					<img src="<?php echo $image['url']; ?>">
				</div>
				<div class="form__container">
					<div class="form__wrapper">
						<h3 class="title">
							Download a copy of our brochure
						</h3>
						<?php gravity_form('Brochure Download Form', false, false, false, '', false); ?>
					</div>
				</div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>
