<?php /* Template Name: Home Page Template */ ?>

<?php get_header(); ?>

	<main role="main">
		<?php get_template_part( 'template-parts/banner' ); ?>

		<section class="product__range__section">
			<div class="box__container">
				<?php if( have_rows('large_product_box') ): ?>
				    <?php while( have_rows('large_product_box') ): the_row(); 
				        $image = get_sub_field('image');
					?>
					<div class="large__product__box">
						<div class="upper">
							<img src="<?php echo $image['url']; ?>">
						</div>
						<div class="text__wrapper">
							<div class="text__inner">
								<h3 class="title">
									<?php the_sub_field('title'); ?>
								</h3>
								<div class="text__list">
									<?php the_sub_field('text_list'); ?>
								</div>
								<?php 
								$link = get_sub_field('link');
								if( $link ): 
								    $link_url = $link['url'];
								    $link_title = $link['title'];
								    $link_target = $link['target'] ? $link['target'] : '_self';
								    ?>
								    <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</div>

				    <?php endwhile; ?>
				<?php endif; ?>

				<div class="double__boxes">
					<?php if( have_rows('small_product_box_one') ): ?>
					    <?php while( have_rows('small_product_box_one') ): the_row(); 
					        $image = get_sub_field('image_1');
						?>
						<div class="small__product__box">
							<div class="upper">
								<img src="<?php echo $image['url']; ?>">
							</div>
							<div class="text__wrapper">
								<div class="text__inner">
									<h3 class="title">
										<?php the_sub_field('title'); ?>
									</h3>
									<div class="text__area">
										<?php the_sub_field('text_area'); ?>
									</div>
									<?php 
									$link = get_sub_field('link');
									if( $link ): 
									    $link_url = $link['url'];
									    $link_title = $link['title'];
									    $link_target = $link['target'] ? $link['target'] : '_self';
									    ?>
									    <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>

					    <?php endwhile; ?>
					<?php endif; ?>

					<?php if( have_rows('small_product_box_two') ): ?>
					    <?php while( have_rows('small_product_box_two') ): the_row(); 
					        $image = get_sub_field('image_2');
						?>
						<div class="small__product__box">
							<div class="upper">
								<img src="<?php echo $image['url']; ?>">
							</div>
							<div class="text__wrapper">
								<div class="text__inner">
									<h3 class="title">
										<?php the_sub_field('title'); ?>
									</h3>
									<div class="text__area">
										<?php the_sub_field('text_list'); ?>
									</div>
									<?php 
									$link = get_sub_field('link');
									if( $link ): 
									    $link_url = $link['url'];
									    $link_title = $link['title'];
									    $link_target = $link['target'] ? $link['target'] : '_self';
									    ?>
									    <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>

					    <?php endwhile; ?>
					<?php endif; ?>				
				</div>
			</div>
		</section>


		<?php if( have_rows('amazing_deals_banner') ): ?>
		    <?php while( have_rows('amazing_deals_banner') ): the_row(); 
		        $image = get_sub_field('image');
		    ?>
		    <section class="deals__banner home__deals__banner" style="background-image: url('<?php echo $image['url']; ?>');">
		    	<div class="background__overlay">
		    		<div class="text__wrapper">
		    			<div class="text__area">
			    			<h2>
				    			<?php the_sub_field('title'); ?>
				    		</h2>
				    		<p>
				    			<?php the_sub_field('text_area'); ?>
				    		</p>
			    		</div>

			    		<?php 
						$link = get_sub_field('link');
						if( $link ): 
						    $link_url = $link['url'];
						    $link_title = $link['title'];
						    $link_target = $link['target'] ? $link['target'] : '_self';
						    ?>
						    <a class="button button--blue" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php endif; ?>
		    		</div>
		    	</div>
		    </section>
		    <?php endwhile; ?>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/cta-bar' ); ?>
		<?php get_template_part( 'template-parts/latest-products' ); ?>
		
	</main>

<?php get_footer(); ?>
