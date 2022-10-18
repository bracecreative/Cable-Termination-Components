<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Shape
 * @since Shape 1.0
 */

get_header(); ?>
<?php get_template_part( 'template-parts/banner' ); ?>

<section class="search__wrapper container">
    <h1 class="search__query__title"><?php printf( __( 'Search Results for: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

    <div class="search__wrapper__products">
        <?php 
        if ( have_posts() ) : ?>

            <?php
            while ( have_posts() ) : the_post(); ?>

                <div class="products">
                    <?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');  ?>
                    <div class="product__image" style="background-image: url('<?php echo $featured_img_url; ?>');"></div>

                    <h3 class="title">
                        <?php the_title(); ?>
                    </h3>

                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="see__more__link button button--blue">
                        View Product
                    </a>
                </div>

        <?php endwhile; 

        else: ?>
            <p>Sorry, no posts matched your criteria.</p>
        <?php endif; 

        wp_reset_postdata();
        ?>

    </div>
</section>

<?php get_footer(); ?>