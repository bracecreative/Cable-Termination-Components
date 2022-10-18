<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/favicon-16x16.png">
		<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/site.webmanifest">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="theme-color" content="#ffffff">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-X53WTWT2Y8"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());
		  gtag('config', 'G-X53WTWT2Y8');
		</script>

	</head>
	<body <?php body_class(); ?>>

		<div class="wrapper">
			<header class="header clear" role="banner">
				<div class="header__upper container">
					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
						</a>
					</div>

					<div class="basket__wrapper account__wrapper mobile__content">
							<?php 
							$cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
					        $cart_url = wc_get_cart_url();  // Set Cart URL  
					        $cart_total = WC()->cart->get_cart_total();
					        ?>

					        <?php 
								$link = get_field('my_account_link','option');
								if( $link ): 
								    $link_url = $link['url'];
								    $link_title = $link['title'];
								    $link_target = $link['target'] ? $link['target'] : '_self';
								    ?>
					         <a href="<?php echo esc_url( $link_url ); ?>" class="account__link">
					        	<img src="<?php echo get_template_directory_uri(); ?>/img/icons/account.svg">
					        	<div class="register__account">
					        		<p>
					        			Your Account
					        		</p>
					        		<p class="label">
					        			sign in or register
					        		</p>
					        	</div>
					        </a>
					        <?php endif; ?>

					        <a class="cart__link" href="<?php echo $cart_url; ?>" title="My Basket">
					        	<img src="<?php echo get_template_directory_uri(); ?>/img/icons/basket.svg">
					        	<div class="count__wrapper">
					        		<span class="cart-contents-count"><?php echo $cart_count; ?> Items - <?php echo $cart_total; ?></span>
					        		<p class="label">
					        			View basket or checkout
					        		</p>
					        	</div>
					        </a>
						</div>

					<div class="header__right">
						<div class="header__right--upper">
							<div class="link__wrapper">
								<?php 
								$link = get_field('link1','option');
								if( $link ): 
								    $link_url = $link['url'];
								    $link_title = $link['title'];
								    $link_target = $link['target'] ? $link['target'] : '_self';
								    ?>
								    <a class="link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
								<?php endif; ?>
								<?php 
								$link = get_field('link2','option');
								if( $link ): 
								    $link_url = $link['url'];
								    $link_title = $link['title'];
								    $link_target = $link['target'] ? $link['target'] : '_self';
								    ?>
								    <a class="link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
								<?php endif; ?>
							</div>
							<div class="tax__toggle__wrapper">
								<div class="tax__toggle">
									<span class="label">
										Ex. vat
									</span>
									<div class="switch">
									  <span class="switch__button"></span>
									  <span class="slider"></span>
									</div>
									<span class="label">
										Inc. vat
									</span>
								</div>
							</div>
						</div>

						<div class="basket__wrapper account__wrapper desktop__content">
							<?php 
							$cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
					        $cart_url = wc_get_cart_url();  // Set Cart URL  
					        $cart_total = WC()->cart->get_cart_total();
					        ?>

					        <?php 
								$link = get_field('my_account_link','option');
								if( $link ): 
								    $link_url = $link['url'];
								    $link_title = $link['title'];
								    $link_target = $link['target'] ? $link['target'] : '_self';
								    ?>
					         <a href="<?php echo esc_url( $link_url ); ?>" class="account__link">
					        	<img src="<?php echo get_template_directory_uri(); ?>/img/icons/account.svg">
					        	<div class="register__account">
					        		<p>
					        			Your Account
					        		</p>
					        		<p class="label">
					        			sign in or register
					        		</p>
					        	</div>
					        </a>
					        <?php endif; ?>

					        <a class="cart__link" href="<?php echo $cart_url; ?>" title="My Basket">
					        	<img src="<?php echo get_template_directory_uri(); ?>/img/icons/basket.svg">
					        	<div class="count__wrapper">
					        		<span class="cart-contents-count"><?php echo $cart_count; ?> Items - <?php echo $cart_total; ?></span>
					        		<p class="label">
					        			View basket or checkout
					        		</p>
					        	</div>
					        </a>
						</div>
					</div>
				</div>

				<div class="menu__bar">
					<div class="toggle__wrapper">
						<div class="menu__toggle menu-closed">
							<span></span>
							<span></span>
							<span></span>
						</div>

						<h3 class="hint">
							Browse
						</h3>
					</div>

					<div class="search__bar">
						<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
					        <input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search', 'shape' ); ?>" />
					        <button class="submit" name="submit" id="searchsubmit">
					        	<img src="<?php echo get_template_directory_uri(); ?>/img/icons/search.svg" alt="search icon">
					        </button>
					    </form>
					</div>
				</div>

				<nav class="nav" role="navigation">
					<?php main_nav(); ?>
				</nav>

				<div class="icon__row">
					<span class="icon__set">
						<img src="<?php echo get_template_directory_uri(); ?>/img/icons/box.svg">
						<p>
							Free Delivery Over £100
						</p>
					</span>
					<span class="icon__set">
						<img src="<?php echo get_template_directory_uri(); ?>/img/icons/check.svg">
						<p>
							Click & Collect
						</p>
					</span>
					<span class="icon__set">
						<img src="<?php echo get_template_directory_uri(); ?>/img/icons/click.svg">
						<p>
							Sign Up For An Account
						</p>
					</span>
					<span class="icon__set">
						<img src="<?php echo get_template_directory_uri(); ?>/img/icons/cog.svg">
						<p>
							Request Technical Help
						</p>
					</span>
				</div>
			</header>

			<div class="modal__background"></div>