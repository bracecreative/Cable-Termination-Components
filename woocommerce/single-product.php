<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<div class="container">
	

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	?>

</div>

<div class="related__products">
	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>

	<?php $terms = get_the_terms( $product->get_id(), 'product_cat' ); ?>
	<div class="related__products__wrapper">
		<h3>
			Customers Also Bought
		</h3>
		<div class="newest__products">
			<?php
			$args = array( 
				'post_type' => 'product',
				'order' => 'DESC',
				'orderby' => 'rand',
				'tax_query' => array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'term_id',
						'terms' => $terms[0]->term_id,
					)
				)
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
			<a href="" class="button button--grey full__range__button">
				View Full Range
			</a>
		</div>
	</div>
</div>

<?php get_template_part( 'template-parts/cta-bar' ); ?>

<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
