<?php
/**
 * Template Name: BMB News Page Template
 */

get_header();

?>
    <div class="page-content news">
        <div id="main-content" class="main-content">
            <?php $search = isset($_GET['search']) ? trim($_GET['search']) : ''; ?>
            <div class="search">
                <div class="form">
                    <form type="GET" action="<?php echo get_permalink(); ?>">
                        <input value="<?php echo $search; ?>" name="search" id="search_news" />
                        <button class="sprites search-icon" type="submit"></button>
                    </form>
                </div>
            </div>

            <div class="news-table">
                <?php

                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $items_per_page = 2;
                $args_total = [
                    'post_type'=> 'news'
                ];
                $args = [
                    'post_type'=> 'news',
                    'order'    => 'ASC',
                    'paged'    => $paged,
                    'posts_per_page' => $items_per_page
                ];

                if ($search != '') {
                    $args['s'] = $search;
                    $args_total['s'] = $search;
                }

                $the_query = new WP_Query( $args );
                $the_query_total = new WP_Query( $args_total );
                $total_items = $the_query_total->post_count;

                if ($the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                        $post = get_post();
                        if ($post) :
                            $image = get_field('image');
                    ?>
                    <a href="<?php echo get_permalink($post); ?>" class="item">
                        <div class="main">
                            <div class="date">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <?php the_field('date'); ?>
                            </div>
                            <div class="title">
                                <?php echo $post->post_title; ?>
                            </div>
                        </div>
                        <?php if ($image) : ?>
                        <div class="image" style="background-image: url(<?php echo $image; ?>)"></div>
                        <?php endif; ?>
                        <div class="description table">
                            <div class="row">
                                <div class="cell">
                                    <?php echo $post->post_content; ?>
                                </div>
                            </div>
                        </div>
                        <div class="f-clear"></div>
                    </a>
                    <?php
                        endif;
                    endwhile;
                    ?>
                    <nav>
                        <?php
                            customPagination($paged, $total_items, $items_per_page);
                        ?>
                    </nav>
                    <?php
                endif;
                ?>
                <div class="f-clear"></div>
            </div>
        </div>
    </div>
<?php

get_footer();