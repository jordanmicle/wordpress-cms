<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="page-content estates single">
	<div id="main-content" class="main-content">
		<?php $search = isset($_GET['search']) ? trim($_GET['search']) : ''; ?>
		<div class="search">
			<div class="form">
				<form type="GET" action="<?php echo get_page_link(72); ?>">
					<input value="<?php echo $search; ?>" name="search" id="search_news" />
					<button class="sprites search-icon" type="submit"></button>
				</form>
			</div>
		</div>
		<?php
		while ( have_posts() ) : the_post();
			$gallery = get_field('gallery');
		?>

			<div class="title"><?php the_title(); ?></div>
			<div class="">
			<?php if ($gallery) : ?>
				<div id="gallery" class="gallery">
					<div class="content">
						<?php foreach ($gallery AS $image) : ?>
							<a href="<?php echo $image['url']; ?>">
								<img src="<?php echo $image['url']; ?>" alt="Photo 1" />
							</a>
						<?php endforeach; ?>
					</div>
					<div class="slides">
						<ul class="slides">
							<?php foreach ($gallery AS $image) : ?>
								<li>
									<img src="<?php echo $image['url']; ?>" />
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>
				<div class="subscribe">
					<div id="subscribe-to-estate" class="box">
						<div class="sprites plus-icon-white"></div>
						<div class="title">
							DEMANDE DE RENSEIGNEMENTS
						</div>
					</div>
					<div id="estate-form" class="form">
						<div class="title-form">
							Nous vous contacterons
							très rapidement !
						</div>
						<input id="firstname" type="text" placeholder="Prénom*" />
						<input id="lastname" type="text" placeholder="Nom*" />
						<input id="email" type="text" placeholder="Email*" />
						<input id="phone" type="text" placeholder="Numéro de téléphone*" />
						<input id="estate_id" type="hidden" value="<?php the_id(); ?>" />
						<input id="url" type="hidden" value="<?php echo admin_url('admin-ajax.php') . '?action=set_estate_subscriber'; ?>" />
						<?php wp_nonce_field( 'set_estate_subscriber', 'set_estate_subscriber' ); ?>
						<div class="sub-title">
							Vos informations ne sont pas
							communiquées à des tiers.
						</div>
						<div id="subscribe-to-estate-button" class="submit">
							<img id="loading" src="<?php bloginfo('template_directory'); ?>/images/loading.gif" />
							Envoyer
						</div>
					</div>
				</div>
				<div class="f-clear"></div>
			</div>

			<div class="description">
				<?php the_content(); ?>
			</div>

			<?php
				$similar_estates = get_field('related_estates');
			?>
			<?php if ($similar_estates) : ?>
				<div class="related_estates">
					<div class="title">BIENS SIMILAIRES</div>
					<div class="content">
					<?php foreach ($similar_estates AS $estate): ?>
						<?php
							$gallery = get_field('gallery', $estate->ID);
							$image = '';
							if (!empty($gallery) && is_array($gallery)) {
								$image = $gallery[0]['url'];
							}
						?>
						<a href="<?php echo get_permalink($estate->ID); ?>" class="estate">
							<div class="image" style="background-image:url(<?php echo $image; ?>);">
								<div class="white">
									<div class="sprites plus-icon-big"></div>
								</div>
							</div>
							<div class="name"><?php echo $estate->post_title; ?></div>
						</a>
					<?php endforeach; ?>
						<div class="f-clear"></div>
					</div>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
	</div><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
