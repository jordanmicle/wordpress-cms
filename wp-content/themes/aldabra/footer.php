<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
		</div>
		<?php if (!is_home()) : ?>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="main-content">
				<div class="address item">
					<img src="<?php bloginfo('template_directory'); ?>/images/aldabra_logo_gray.png" alt="Logo" />
					<?php
						$location = get_field('address', 'option');
						if ($location) {
							echo '<div class="address-row location">' . $location['address'] . '</div>';
						}

						$phones = get_field('phones', 'option');
						if ($phones && is_array($phones)) {
							foreach ($phones AS $phone) {
								echo '<div class="address-row phone">' . $phone['number'] . '</div>';
							}
						}

						echo '<a href="mailto:'. get_field('email', 'option') . '" class="address-row">' . get_field('email', 'option') . '</a>';
					?>
				</div>
				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation item" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>',
							) );
						?>
					</nav>
				<?php endif; ?>
				<?php
					$social = get_field('social_links', 'option');
					if ($social && is_array($social)) :
				?>
				<div class="social item">
				<?php
					foreach ($social AS $s) :
						$image = !empty($s['icon']['url']) ? $s['icon']['url'] : '';
						echo '
							<a href="' . $s['link'] . '" target="_blank" class="social-row">
								<img src="' . $s['icon']['url'] . '" /> <span>' . $s['name'] . '</span>
							</a>';
				?>
				<?php
						endforeach;
					echo '</div>';
					endif;
				?>
				<div class="bmb item">
					<span class="copyright">&copy; Aldabra Reim 2016</span>
					<img src="<?php bloginfo('template_directory'); ?>/images/bmb.png" alt="BMB Logo" />
					<div class="bmb-text">
						<span>Conception et réalisation BMB Advertising</span>
						<br />
						<a href="http://bmb-advertising.eu" target="_blank">www.bmb-advertising.eu</a>
					</div>
				</div>
				<div class="f-clear"></div>
			</div>
		</footer>
		<?php endif; ?>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzVr4MUjEa9sUqcQb3u3NrMUFJV8cJUmY"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Clamp.js/0.5.1/clamp.min.js"></script>
<?php if (!is_home()) : ?>
	<?php wp_footer(); ?>
<?php endif; ?>
</body>
</html>
