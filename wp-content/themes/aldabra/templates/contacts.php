<?php
/**
 * Template Name: BMB Contacts Page Template
 */

get_header();

?>
    <?php $location = get_field('address', 'option'); ?>
    <div class="page-content contacts">
        <div id="main-content" class="main-content">
            <div class="top">
                <span class="title">
                CONTACT :
                </span>
                <div class="phones">
                    <?php
                        $phones = get_field('phones', 'option');
                        if ($phones && is_array($phones)) {
                            foreach ($phones AS $phone) {
                                echo '<span class="item">' . $phone['number'] . '</span>';
                            }
                        }
                    ?>
                </div>
                <div class="address">
                    <span class="item">
                        <?php echo $location['address']; ?>
                    </span>
                    <a class="item email" href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a>
                </div>
                <div class="f-clear"></div>
            </div>
            <div data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" id="map" class="map"></div>
            <div class="contact-form">
                <?php echo  do_shortcode('[contact-form-7 id="115" title="Contact form 1"]'); ?>
                <div class="f-clear"></div>
            </div>
        </div>
    </div>
<?php

get_footer();