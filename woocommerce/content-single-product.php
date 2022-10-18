<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div class="custom__single__product">
	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'product__desc__image', $product ); ?>>
		<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
		?>

		<?php 
		$product = wc_get_product();
		if ( $product->is_type( 'variable' ) ) { ?>
			<div class="summary entry-summary">
				<h1 class="product_title entry-title"> 
					<?php the_title(); ?>
				</h1>
				<?php echo get_the_excerpt(); ?>
			</div>
		<?php } else { ?>

			<div class="summary entry-summary">
				<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
					?>
				</div>

			<?php } ?>
		</div>

		<section class="product__table">

			<?php
				if ( $product->is_type( 'variable' ) ) {
					$id = $product->id;
					$table_post_id = get_post_meta($id, 'display_table', true);

					$tables = get_option( 'tablepress_tables' );
					$tables = json_decode( $tables, true );

					$posts = array_flip( $tables['table_post'] );
					
					$table_shortcode_id = isset($posts[$table_post_id]) ? $posts[$table_post_id] : false;
					?>

					<?php if (!empty($table_shortcode_id)): ?>
						<h3>
							Technical Specifications
						</h3>
					<?php endif ?>

					<?php

					if($table_shortcode_id){
						echo do_shortcode(sprintf('[table id="%d"]', $table_shortcode_id));
					}
				}
			?>
		</section>

		<section class="product__variations">
			<?php 
			$product = wc_get_product();
			if ( $product->is_type( 'variable' ) ) { ?>
				<h3 class="title">
					Full Range
				</h3>
				<?php $variations = $product->get_available_variations();
				foreach ($variations as $key => $value){ ?>
					<?php $id = $product->get_id(); ?>
					<?php $variation_id = $value['variation_id']; ?>
					<?php if ( ! is_user_logged_in() ) {  
						$loggedinClass = 'space__between';
					} else {
						$loggedinClass = '';
					} ?>
					<div class="product__variant <?php echo $loggedinClass ?>">
						<div class="title__wrapper">
							<h4>
								<?php 
								$variation = wc_get_product($variation_id);
								$name = $variation->get_name();
								echo $name;
								?>
							</h4>
							<p class="product__code">
								<?php $sku = get_post_meta( $variation_id, '_sku', true );
								echo $sku;
								?>	
							</p>

							<div class="variant__description">
								<?php echo $value['variation_description']; ?>
							</div>
						</div>
						<?php $url = get_permalink( $id ); ?>

						<?php if ( is_user_logged_in() ) {  ?>
						<form class="variations__form cart" action="<?php echo $url; ?>" method="post" enctype="multipart/form-data" data-product_id="<?php echo $id; ?>">
							<span class="price">
								<?php echo $value['price_html']; ?>
								<p class="pack__quantity">
									PACK QTY: <?php echo get_post_meta($variation_id, 'unit_quantity', true); ?>
								</p>
							</span>
							<div class="quantity__wrapper">
								<div class="btn-minus quantity__input__button">
									<img src="<?php echo get_template_directory_uri(); ?>/img/icons/chevron-left.svg" alt="chevron-left">
								</div>
								<?php woocommerce_quantity_input(); ?>
								<div class="btn-plus quantity__input__button">
									<img src="<?php echo get_template_directory_uri(); ?>/img/icons/chevron-right.svg" alt="chevron-right">
								</div>
							</div>
							<button type="submit" class="single_add_to_cart_button button button--blue">Add to basket</button>

							<input type="hidden" name="add-to-cart" value="<?php echo $id; ?>">
							<input type="hidden" name="product_id" value="<?php echo $id; ?>">
							<input type="hidden" name="variation_id" class="variation_id" value="<?php echo $value['variation_id']; ?>">
						</form>

					<?php } else { ?>
						<a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>" class="button button--blue">Log in to see prices</a>
					<?php } ?>
					</div>
				<?php }
			}
			?>
		</section>
</div>


<?php do_action( 'woocommerce_after_single_product' ); ?>
