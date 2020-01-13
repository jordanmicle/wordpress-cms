<?php
/**
 * Template Name: BMB Home Page Template
 */

get_header();

?>
    <div class="page-content home">

        <div id="main-content" class="main-content">
            <?php

            $args = array(
                'post_type'=> 'main_categories',
                'order'    => 'ASC'
            );

            $the_query = new WP_Query( $args );
            if ($the_query->have_posts() ) :
                while ( $the_query->have_posts() ) :
                    $the_query->the_post();
                    $post = get_post();
                    if ($post) :
                ?>
                <div class="box">
                    <div class="main-title table">
                        <div class="row">
                            <div class="cell">
                                <?php echo $post->post_title; ?>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="title">
                            <?php echo $post->post_title; ?>
                        </div>
                        <div class="description">
                            <?php echo $post->post_content; ?>
                        </div>
                    </div>
                </div>
                <?php
                    endif;
                endwhile;
            endif;
            ?>
            <div id="clear" class="f-clear"></div>
        </div>
    </div>
<?php

get_footer();