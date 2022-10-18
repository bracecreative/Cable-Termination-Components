<section class="cta__bar">
	<div class="cta__bar__inner container">
		<?php if( have_rows('call_to_action_bar','option') ): ?>
		    <?php while( have_rows('call_to_action_bar','option') ): the_row(); ?>
		    	<h3 class="title">
		    		<?php the_sub_field('title'); ?>
		    	</h3>
		    	<?php 
				$link = get_sub_field('link');
				if( $link ): 
				    $link_url = $link['url'];
				    $link_title = $link['title'];
				    $link_target = $link['target'] ? $link['target'] : '_self';
				    ?>
				    <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
		 	<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>