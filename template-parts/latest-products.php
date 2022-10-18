<div class="newest__products__wrapper">
			<h3>
				Our latest products
			</h3>
			<div class="newest__products">
				<?php
				$args = array( 
					'post_type' => 'product',
					'order' => 'DESC',
				);
				$loop = new WP_Query( $args );

				while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->id) ); ?>
					<div class="product__wrapper">
						<div class="product__wrapper__inner">
							<a href="<?php echo get_permalink( $loop->post->ID ) ?>">
								<div class="product__image" style="background-image: url('<?php echo $url; ?>');"></div>
							</a>
						    <a href="<?php echo get_permalink( $loop->post->ID ) ?>" class="product__title__link">
						        <h4>
						        	<?php the_title(); ?>
						        </h4>
						    </a>
						    <?php $product = wc_get_product( get_the_ID() ); /* get the WC_Product Object */ ?>
							<?php if ( is_user_logged_in() ) {  ?>
								<p class="price"><?php echo $product->get_price_html(); ?></p>
							<?php } else { ?>
								<a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>" class="button button--blue">Log in to see prices</a>
							<?php } ?>
						</div>
					</div>

				<?php endwhile; wp_reset_postdata();?>
			</div>
			<div class="link__wrapper">
				<?php 
				$link = get_field('view_whole_range_link','option');
				if( $link ): 
				    $link_url = $link['url'];
				    $link_title = $link['title'];
				    $link_target = $link['target'] ? $link['target'] : '_self';
				    ?>
				    <a class="button button--grey view__all__link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
			</div>
		</div>