<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="page-content programs single">
	<div id="main-content" class="main-content">

		<?php
		$args = [
				'post_type'=> 'programs',
				'order'    => 'ASC',
			//'posts_per_page' => $items_per_page
		];
		$the_query = new WP_Query( $args );
		$other = '';
		$ID = get_the_ID();
		if ($the_query->have_posts() ) :
			$other .= '<div class="other"><div class="wrapper">';
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$post = get_post();

				if ($post) :

					if ($post->ID == $ID) {
						continue;
					}

					$image = '';
					$gallery = get_field('gallery');
					if (!empty($gallery)) {
						$image = $gallery[0]['url'];
					}

					$other .= '
						<a href="' . get_permalink($post) . '" class="item">
							<div class="image" style="background-image: url(' . $image . ' )"></div>
							<div class="name">
								' . $post->post_title . '
							</div>
							<div class="ruler"></div>
						</a>';
				endif;
			endwhile;
			$other .= '</div></div>';
		endif;

		?>


		<?php $search = isset($_GET['search']) ? trim($_GET['search']) : ''; ?>
		<div class="search">
			<div class="form">
				<form type="GET" action="<?php echo get_page_link(74); ?>">
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
				<?php echo $other; ?>
				<div class="f-clear"></div>
			</div>

			<div class="description">
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	</div><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
