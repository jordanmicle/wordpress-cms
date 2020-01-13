<?php
/**
 * Template Name: BMB Programs Page Template
 */

get_header();

?>
    <div class="page-content programs">
        <div id="main-content" class="main-content">
            <?php $search = isset($_GET['search']) ? trim($_GET['search']) : ''; ?>

            <?php
            $page_url = get_permalink();
            ?>

            <div class="search">
                <div class="form">
                    <form type="GET" action="<?php echo $page_url; ?>">
                        <input value="<?php echo $search; ?>" name="search" id="search_news" />
                        <button class="sprites search-icon" type="submit"></button>
                    </form>
                </div>
            </div>

            <div class="title">
                DÉCOUVREZ NOS PROGRAMMES NEUFS
            </div>

            <div class="programs-table">
                <?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $items_per_page = 2;
                $args_total = [
                    'post_type'=> 'programs'
                ];
                $args = [
                    'post_type'=> 'programs',
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
                            $image = '';
                            $gallery = get_field('gallery');
                            if (!empty($gallery) && is_array($gallery)) {
                                $image = $gallery[0]['url'];
                            }

                    ?>
                    <a href="<?php echo get_permalink($post); ?>" class="item">
                        <div class="image" style="background-image: url(<?php echo $image; ?>)">
                            <div class="info">
                                <div class="name">
                                    <?php echo $post->post_title; ?>
                                </div>
                                <div class="price">
                                    <?php the_field('price'); ?>
                                </div>
                            </div>
                            <div class="more">
                                <div class="text">EN SAVOIR PLUS</div>
                                <div class="sprites plus-icon"></div>
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
            <div id="subscribe-show" class="subscribe">
                <div class="text">
                    <div class="inner">
                        Vous souhaitez accéder à l’offre de Cogedim, merci de nous indiquer <br />
                        vos critères de recherche, vous recevrez rapidement les biens correspondants.
                    </div>
                    <div class="form">
                        <div class="input">
                            PARTENARIAT COGEDIM
                            <div class="sprites plus-purple"></div>
                        </div>
                        <img src="<?php bloginfo('template_directory'); ?>/images/cogedim_logo.png" alt="logo" />
                        <div class="f-clear"></div>
                    </div>
                </div>
            </div>
            <div id="subscribe-form" class="subscribe-form">
                <div class="body">
                    <div class="top">
                        <img src="<?php bloginfo('template_directory'); ?>/images/logo-gray.png" alt="logo" />
                        <div class="close">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="content-success">
                        <div class="sprites success-icon"></div>
                        Votre message a bien été envoyé .
                    </div>
                    <div class="content">
                        <input id="url" type="hidden" value="<?php echo admin_url('admin-ajax.php') . '?action=set_estate_subscriber'; ?>" />
                        <?php wp_nonce_field( 'set_estate_subscriber', 'set_estate_subscriber' ); ?>
                        <div class="row">
                            <div class="label">Nom* :</div>
                            <div class="input-wrapper">
                                <div class="line"></div>
                                <input id="firstname" class="input" name="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Prénom* :</div>
                            <div class="input-wrapper">
                                <div class="line"></div>
                                <input id="lastname" class="input" name="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Adresse mail* :</div>
                            <div class="input-wrapper">
                                <div class="line"></div>
                                <input id="email" class="input" name="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Téléphone :</div>
                            <div class="input-wrapper">
                                <div class="line"></div>
                                <input id="phone" class="input" name="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Localisation* :</div>
                            <div class="input-wrapper">
                                <div class="line"></div>
                                <input id="location" class="input" name="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Type* :</div>
                            <div class="input-wrapper">
                                <div class="line"></div>
                                <div id="type" class="input multiselect icon">
                                    <input id="type_input" class="input" type="hidden" />
                                    <div class="text"></div>
                                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    <div class="options">
                                        <div class="option" data-type="Maison" data-active="0">
                                            <div class="checkbox">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </div>
                                            <label for="maison">Maison</label>
                                        </div>
                                        <div class="option" data-type="Appartement" data-active="0">
                                            <div class="checkbox">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </div>
                                            <label for="appartement">Appartement</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Nb. de pièces* :</div>
                            <div class="input-wrapper">
                                <div class="line"></div>
                                <input id="room_number" name="" class="input" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="label">Budget max* :</div>
                            <div class="input-wrapper">
                                <div class="line"></div>
                                <div class="sprites euro"></div>
                                <input id="budget" name="" class="input icon" />
                            </div>
                        </div>
                        <div id="submit-full-subscribe" class="submit">
                            <img id="loading" class="loading" src="<?php bloginfo('template_directory'); ?>/images/loading2.gif" />
                            ENVOYER
                        </div>
                        <div class="f-clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php

get_footer();