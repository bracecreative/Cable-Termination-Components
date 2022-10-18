<?php if( have_rows('banner','option') ): ?>
    <?php while( have_rows('banner','option') ): the_row(); 
        $image = get_sub_field('image');
    ?>
    <section class="deals__banner" style="background-image: url('<?php echo $image['url']; ?>');">
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
				    <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
    		</div>
    	</div>
    </section>
    <?php endwhile; ?>
<?php endif; ?>
