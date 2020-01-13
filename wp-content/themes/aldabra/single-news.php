<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="page-content news single">
	<div id="main-content" class="main-content">
		<?php $search = isset($_GET['search']) ? trim($_GET['search']) : ''; ?>
		<div class="search">
			<div class="form">
				<form type="GET" action="<?php echo get_page_link(76); ?>">
					<input value="<?php echo $search; ?>" name="search" id="search_news" />
					<button class="sprites search-icon" type="submit"></button>
				</form>
			</div>
		</div>
		<?php

		$ID = get_the_ID();

		$args = [
			'post_type'=> 'news',
			'order'    => 'ASC',
			//'posts_per_page' => $items_per_page
		];
		$the_query = new WP_Query( $args );
		$other = '';

		if ($the_query->have_posts() ) :
			$other .= '<div class="other"><div class="wrapper">';
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
				$post = get_post();

				if ($post) :

					if ($post->ID == $ID) {
						continue;
					}

					$image = get_field('image');
					$other .= '
						<a href="' . get_permalink($post) . '" class="item">
							<div class="image" style="background-image: url(' . $image . ' )"></div>
							<div class="date">
								<i class="fa fa-calendar" aria-hidden="true"></i>
								' . get_field('date') . '
							</div>
							<div class="ruler"></div>
						</a>';
				endif;
			endwhile;
			$other .= '</div></div>';
		endif;

		// Start the loop.
		while ( have_posts() ) : the_post();
			$image = get_field('image');
		?>

			<div class="title"><?php the_title(); ?></div>
			<?php if ($image) : ?>
			<div class="image" style="background-image: url(<?php echo $image; ?>)"></div>
			<?php endif; ?>

			<div class="description">
				<?php echo $other; ?>
				<div class="content">
					<?php the_content(); ?>
				</div>
				<div class="f-clear"></div>
			</div>
		<?php endwhile; ?>
	</div><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
