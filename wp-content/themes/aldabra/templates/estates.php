<?php
/**
 * Template Name: BMB Estates Page Template
 */

get_header();

?>
    <div class="page-content estates">
        <div id="main-content" class="main-content">
            <?php $search = isset($_GET['search']) ? trim($_GET['search']) : ''; ?>
            <?php $town = isset($_GET['ville']) ? intval($_GET['ville']) : 0; ?>
            <?php $typologie = isset($_GET['typologie']) ? intval($_GET['typologie']) : 0; ?>

            <?php
            $page_url = get_permalink();
            $url_towns = $page_url;
            $url_typology = $page_url;
            $search_url = $page_url;
            $typo_sign = '?';
            $ville_sign = '?';
            if ($search) {
                $url_typology .= $typo_sign . 'search=' . $search;
                $typo_sign = '&';
                $url_towns .= $ville_sign . 'search=' . $search;
                $ville_sign = '&';
            }

            if ($town) {
                $url_typology .= $typo_sign . 'ville=' . $town;
                $typo_sign = '&';
            }

            if ($typologie) {
                $url_towns .= $ville_sign . 'typologie=' . $typologie;
                $ville_sign = '&';
            }
            ?>

            <div class="search">
                <div class="form">
                    <form type="GET" action="<?php echo $search_url; ?>">
                        <?php
                            if ($town) {
                                echo '<input type="hidden" name="ville" value="' . $town . '" />';
                            }

                            if ($typologie) {
                                echo '<input type="hidden" name="typologie" value="' . $typologie . '" />';
                            }
                        ?>
                        <input value="<?php echo $search; ?>" name="search" id="search_news" />
                        <button class="sprites search-icon" type="submit"></button>
                    </form>
                </div>
            </div>
            <div class="filters">
                <div class="title">NOS BIENS IMMOBILIERS D’EXCEPTION</div>
                <?php
                $args_total = [
                    'post_type'=> 'topologies'
                ];
                $the_query_total = new WP_Query( $args_total );
                if ( $the_query_total->have_posts() ) :
                    ?>
                    <div class="filter">
                        <?php $active_typology = 'Typologie'; ?>
                        <div class="body">
                            <a href="<?php echo $url_typology; ?>" class="filter-name">Tout...</a>
                            <?php
                            while ( $the_query_total->have_posts() ) : $the_query_total->the_post();
                                $post = get_post();
                                if ($post) :
                                    ?>
                                    <a href="<?php echo $url_typology . $typo_sign . 'typologie=' . $post->ID; ?>" class="filter-name"><?php echo $post->post_title; ?></a>
                                    <?php

                                    if ($post->ID == $typologie) {
                                        $active_typology = $post->post_title;
                                    }
                                endif;
                            endwhile;
                            ?>
                        </div>
                        <div class="name"><?php echo $active_typology; ?> <i class="fa fa-caret-down" aria-hidden="true"></i></div>
                    </div>
                    <?php
                endif;
                ?>

                <?php
                $args_total = [
                    'post_type'=> 'towns'
                ];
                $the_query_total = new WP_Query( $args_total );
                if ( $the_query_total->have_posts() ) :
                    ?>
                    <div class="filter">
                        <?php $active_town = 'Ville'; ?>
                        <div class="body">
                            <a href="<?php echo $url_towns; ?>" class="filter-name">Tout...</a>
                            <?php
                            while ( $the_query_total->have_posts() ) : $the_query_total->the_post();
                                $post = get_post();
                                if ($post) :
                                    ?>
                                    <a href="<?php echo $url_towns . $ville_sign . 'ville=' . $post->ID; ?>" class="filter-name"><?php echo $post->post_title; ?></a>
                                    <?php

                                    if ($post->ID == $town) {
                                        $active_town = $post->post_title;
                                    }
                                endif;
                            endwhile;
                            ?>
                        </div>
                        <div class="name"><?php echo $active_town; ?> <i class="fa fa-caret-down" aria-hidden="true"></i></div>
                    </div>
                    <?php
                endif;
                ?>
                <div class="f-clear"></div>
            </div>
            <div class="estates-table">
                <?php

                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $items_per_page = 4;
                $args_total = [
                    'post_type'=> 'estates'
                ];
                $args = [
                    'post_type'=> 'estates',
                    'order'    => 'ASC',
                    'paged'    => $paged,
                    'posts_per_page' => $items_per_page
                ];

                if ($search != '') {
                    $args['s'] = $search;
                    $args_total['s'] = $search;
                }


                if ($town && $typologie) {
                    $args['meta_query'] = [
                        'relation'		=> 'AND',
                        [
                            'key'	 	=> 'town',
                            'value'	  	=> $town,
                            'compare' 	=> '=',
                        ],
                        [
                            'key'	 	=> 'typology',
                            'value'	  	=> $typologie,
                            'compare' 	=> '=',
                        ],
                    ];
                    $args_total['meta_query'] = $args['meta_query'];
                } else if ($town) {
                    $args['meta_key'] = 'town';
                    $args['meta_value'] = $town;

                    $args_total['meta_key'] = 'town';
                    $args_total['meta_value'] = $town;
                } else if (!$town && $typologie) {
                    $args['meta_key'] = 'typology';
                    $args['meta_value'] = $typologie;

                    $args_total['meta_key'] = 'typology';
                    $args_total['meta_value'] = $typologie;
                }

                $the_query = new WP_Query( $args );
                $the_query_total = new WP_Query( $args_total );
                $total_items = $the_query_total->post_count;

                if ($the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                        $post = get_post();
                        if ($post) :
                            $image = '';
                            $gallery = get_field('gallery');
                            if (!empty($gallery) && is_array($gallery)) {
                                $image = $gallery[0]['url'];
                            }

                    ?>
                    <a href="<?php echo get_permalink($post); ?>" class="item">
                        <div class="image" style="background-image: url(<?php echo $image; ?>)">
                            <div class="title">
                                <div class="name">
                                    <?php echo $post->post_title; ?>
                                </div>
                                <div class="price">
                                    <?php echo the_field('price'); ?>
                                </div>
                            </div>
                            <div class="white">
                                <div class="sprites plus-icon"></div>
                                <div class="sprites plus-icon-big"></div>
                            </div>
                        </div>
                        <div class="f-clear"></div>
                    </a>
                    <?php
                        endif;
                    endwhile;
                    ?>
                    <nav class="pagination-nav">
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