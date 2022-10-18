			<!-- footer -->
			<footer class="footer" role="contentinfo">
				<div class="link__groups">
					<div class="footer__links">
						<h4>
							Customer Service
						</h4>
						<?php if( have_rows('customer_service_links','option') ): ?>
						    <?php while( have_rows('customer_service_links','option') ): the_row(); ?>
						    	<?php 
									$link = get_sub_field('link');
									if( $link ): 
									    $link_url = $link['url'];
									    $link_title = $link['title'];
									    $link_target = $link['target'] ? $link['target'] : '_self';
									    ?>
									    <a class="link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
									<?php endif; ?>
						    <?php endwhile; ?>
						<?php endif; ?>
					</div>
					<div class="footer__links">
						<h4>
							Company Info
						</h4>
						<div class="footer__text__content">
							<?php the_field('company_info','option'); ?>
						</div>
					</div>
					<div class="footer__links">
						<h4>
							Terms & Conditions
						</h4>
						<?php if( have_rows('terms_&_conditions','option') ): ?>
						    <?php while( have_rows('terms_&_conditions','option') ): the_row(); ?>
						    	<?php 
									$link = get_sub_field('link');
									if( $link ): 
									    $link_url = $link['url'];
									    $link_title = $link['title'];
									    $link_target = $link['target'] ? $link['target'] : '_self';
									    ?>
									    <a class="link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
									<?php endif; ?>
						    <?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>

				<div class="copyright__content">
					<?php if( have_rows('copyright_information','option') ): ?>
					    <?php while( have_rows('copyright_information','option') ): the_row(); ?>
					    	<p class="address">
					    		<?php the_sub_field('text_area'); ?>
					    	</p>
					    	<div class="social">
					    		<h4>
					    			Follow Us
					    		</h4>
					    		<div class="social__link__wrappers">
					    			<?php if( have_rows('social','option') ): ?>
						    			<?php while( have_rows('social','option') ): the_row(); 
						    				$facebook = get_sub_field('facebook');
						    				$instagram = get_sub_field('instagram');
						    				$twitter = get_sub_field('twitter');
						    				$linkedin = get_sub_field('linkedin');
						    			?>
						    				
						    				<a href="<?php echo $facebook; ?>" class="social__link social__facebook">
						    					<img src="<?php echo get_template_directory_uri(); ?>/img/icons/facebook.svg" alt="facebook" class="">
						    				</a>
						    				<a href="<?php echo $instagram; ?>" class="social__link social__instagram">
						    					<img src="<?php echo get_template_directory_uri(); ?>/img/icons/instagram.svg" alt="instagram">
						    				</a>
						    				<a href="<?php echo $twitter; ?>" class="social__link social__twitter">
						    					<img src="<?php echo get_template_directory_uri(); ?>/img/icons/twitter.svg" alt="twitter">
						    				</a>
						    				<a href="<?php echo $linkedin; ?>" class="social__link social__linkedin">
						    					<img src="<?php echo get_template_directory_uri(); ?>/img/icons/linkedin.svg" alt="linkedin">
						    				</a>
						    			<?php endwhile; ?>
									<?php endif; ?>
					    		</div>
					    	</div>
					    	<div class="copyright">
					    		<?php the_sub_field('copyright'); ?>
					    	</div>
					    <?php endwhile; ?>
					<?php endif; ?>
				</div>
			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script>
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#263b8a"
    },
    "button": {
      "background": "#ffffff",
      "text": "#263b8a"
    }
  },
  "position": "bottom-right",
  "content": {
    "href": "https://mydummysite.co.uk/ctcuk/privacy-policy"
  }
});
</script>

	</body>
</html>
