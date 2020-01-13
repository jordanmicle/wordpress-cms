<?php

class AldabraMenuPage {

    protected $title;
    protected $menu_title;
    protected $slug;

    function __construct($title, $menu_title, $slug) {
        $this->title = $title;
        $this->menu_title = $menu_title;
        $this->slug = $slug;

        $this->admin_menu();

        //add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    function admin_menu() {
        if( function_exists('acf_add_options_page') )
        {
            acf_add_options_page([
                'page_title' => $this->title,
                'menu_title' => $this->menu_title,
                '$menu_title' => $this->slug,
                'capability' => 'edit_posts',
                'position' => 6,
                'icon_url' => 'dashicons-email-alt'
            ]);
        }
    }
}