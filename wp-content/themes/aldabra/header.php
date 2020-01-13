<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<script src=" https://use.fontawesome.com/d775e2225f.js"></script>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/aldabra.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/jgallery/jgallery.min.js"></script>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jgallery/jgallery.min.css" type="text/css" media="screen" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>

	<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.14.2/TweenMax.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/animation.gsap.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/debug.addIndicators.js"></script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="site-inner">
		<header id="masthead" class="site-header <?php echo (is_front_page() ? 'front' : ''); ?>" role="banner">
			<div class="wrapper">
				<div class="top opacity-animate">
					<div class="main-content">
						VOUS AVEZ UN BIEN À VENDRE ?
						<a href="<?php echo get_home_url(); ?>">
							<div class="sprites home"></div>
						</a>
					</div>
				</div>
				<div class="navigation">
					<div class="main-content">
						<?php if ( get_header_image() ) : ?>
							<div class="header-image">
								<?php if (is_front_page()) { ?>
									<div id="header-image-position"></div>
								<?php } ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<img id="header-image" src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
								</a>
							</div>
							<div class="mobile-button opacity-animate">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
						<?php endif;?>

						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<nav class="main-navigation opacity-animate" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'twentysixteen' ); ?>">
								<?php
								wp_nav_menu( array(
										'theme_location' => 'primary',
										'menu_class'     => 'primary-menu',
								) );
								?>
							</nav>
						<?php endif; ?>

						<div class="f-clear"></div>
					</div>
				</div>
			</div>


			<?php if (is_front_page()) { ?>
				<div id="home-animation" class="home-animation">

				</div>
			<?php } ?>

		</header>

		<div id="content" class="site-content">