<?php

class AldabraPostTypes
{

    public static function createMainTags()
    {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Main Categories', 'Category General Name' ),
            'singular_name'       => _x( 'Main Category', 'Category Singular Name' ),
            'menu_name'           => __( 'Main Categories' ),
            'parent_item_colon'   => __( 'Parent Category' ),
            'all_items'           => __( 'All Categories' ),
            'view_item'           => __( 'View Category' ),
            'add_new_item'        => __( 'Add New Category' ),
            'add_new'             => __( 'Add Category' ),
            'edit_item'           => __( 'Edit Category' ),
            'update_item'         => __( 'Update Category' ),
            'search_items'        => __( 'Search Category' ),
            'not_found'           => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );

        // Set other options for Custom Post Type
        $args = array(
            'label'               => __( 'main_categories' ),
            'description'         => __( 'Category Description' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'order' ),
            // You can associate this CPT with a taxonomy or custom taxonomy.
            'taxonomies'          => array( 'main_categories' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'menu_icon' => 'dashicons-list-view'
        );

        // Registering your Custom Post Type
        register_post_type( 'main_categories', $args );

        /* Hook into the 'init' action so that the function
         * Containing our post type registration is not
         * unnecessarily executed.
         */

        add_action( 'init', 'AldabraPostTypes::createMainTags', 0 );
    }

    public static function createNews()
    {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'News', 'News General Name' ),
            'singular_name'       => _x( 'News', 'Category Singular Name' ),
            'menu_name'           => __( 'News' ),
            'parent_item_colon'   => __( 'Parent News' ),
            'all_items'           => __( 'All News' ),
            'view_item'           => __( 'View Article' ),
            'add_new_item'        => __( 'Add New Article' ),
            'add_new'             => __( 'Add Article' ),
            'edit_item'           => __( 'Edit Article' ),
            'update_item'         => __( 'Update Article' ),
            'search_items'        => __( 'Search Article' ),
            'not_found'           => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );

        // Set other options for Custom Post Type
        $args = array(
            'label'               => __( 'news' ),
            'description'         => __( 'Description' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ),
            // You can associate this CPT with a taxonomy or custom taxonomy.
            'taxonomies'          => array( 'news' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'menu_icon' => 'dashicons-admin-site'
        );

        // Registering your Custom Post Type
        register_post_type( 'news', $args );

        /* Hook into the 'init' action so that the function
         * Containing our post type registration is not
         * unnecessarily executed.
         */

        add_action( 'init', 'AldabraPostTypes::createNews', 0 );
    }

    public static function createEstates()
    {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Estates', 'Estates General Name' ),
            'singular_name'       => _x( 'Estate', 'Category Singular Name' ),
            'menu_name'           => __( 'Estates' ),
            'parent_item_colon'   => __( 'Parent Estate' ),
            'all_items'           => __( 'All Estates' ),
            'view_item'           => __( 'View Estate' ),
            'add_new_item'        => __( 'Add New Estate' ),
            'add_new'             => __( 'Add Estate' ),
            'edit_item'           => __( 'Edit Estate' ),
            'update_item'         => __( 'Update Estate' ),
            'search_items'        => __( 'Search Estate' ),
            'not_found'           => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );

        // Set other options for Custom Post Type
        $args = array(
            'label'               => __( 'estates' ),
            'description'         => __( 'Description' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ),
            // You can associate this CPT with a taxonomy or custom taxonomy.
            'taxonomies'          => array( 'Estates' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'menu_icon' => 'dashicons-admin-home'
        );

        // Registering your Custom Post Type
        register_post_type( 'estates', $args );

        /* Hook into the 'init' action so that the function
         * Containing our post type registration is not
         * unnecessarily executed.
         */

        add_action( 'init', 'AldabraPostTypes::createEstates', 0 );
    }

    public static function createPrograms()
    {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Programs', 'Estates General Name' ),
            'singular_name'       => _x( 'Program', 'Category Singular Name' ),
            'menu_name'           => __( 'Programs' ),
            'parent_item_colon'   => __( 'Parent Program' ),
            'all_items'           => __( 'All Programs' ),
            'view_item'           => __( 'View Program' ),
            'add_new_item'        => __( 'Add New Programs' ),
            'add_new'             => __( 'Add Program' ),
            'edit_item'           => __( 'Edit Program' ),
            'update_item'         => __( 'Update Program' ),
            'search_items'        => __( 'Search Program' ),
            'not_found'           => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );

        // Set other options for Custom Post Type
        $args = array(
            'label'               => __( 'programs' ),
            'description'         => __( 'Description' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ),
            // You can associate this CPT with a taxonomy or custom taxonomy.
            'taxonomies'          => array( 'Programs' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'menu_icon' => 'dashicons-exerpt-view'
        );

        // Registering your Custom Post Type
        register_post_type( 'programs', $args );

        /* Hook into the 'init' action so that the function
         * Containing our post type registration is not
         * unnecessarily executed.
         */

        add_action( 'init', 'AldabraPostTypes::createPrograms', 0 );
    }

    public static function createTopology()
    {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Topologies', 'Estates General Name' ),
            'singular_name'       => _x( 'Topology', 'Category Singular Name' ),
            'menu_name'           => __( 'Topologies' ),
            'parent_item_colon'   => __( 'Parent Topology' ),
            'all_items'           => __( 'All Topologies' ),
            'view_item'           => __( 'View Topology' ),
            'add_new_item'        => __( 'Add New Topology' ),
            'add_new'             => __( 'Add Topology' ),
            'edit_item'           => __( 'Edit Topology' ),
            'update_item'         => __( 'Update Topology' ),
            'search_items'        => __( 'Search Topology' ),
            'not_found'           => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );

        // Set other options for Custom Post Type
        $args = array(
            'label'               => __( 'Topology' ),
            'description'         => __( 'Description' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ),
            // You can associate this CPT with a taxonomy or custom taxonomy.
            'taxonomies'          => array( 'Topology' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'menu_icon' => 'dashicons-exerpt-view'
        );

        // Registering your Custom Post Type
        register_post_type( 'topologies', $args );

        /* Hook into the 'init' action so that the function
         * Containing our post type registration is not
         * unnecessarily executed.
         */

        add_action( 'init', 'AldabraPostTypes::createTopology', 0 );
    }

    public static function createTowns()
    {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Towns', 'Estates General Name' ),
            'singular_name'       => _x( 'Town', 'Category Singular Name' ),
            'menu_name'           => __( 'Towns' ),
            'parent_item_colon'   => __( 'Parent Town' ),
            'all_items'           => __( 'All Towns' ),
            'view_item'           => __( 'View Town' ),
            'add_new_item'        => __( 'Add New Town' ),
            'add_new'             => __( 'Add Town' ),
            'edit_item'           => __( 'Edit Town' ),
            'update_item'         => __( 'Update Town' ),
            'search_items'        => __( 'Search Town' ),
            'not_found'           => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );

        // Set other options for Custom Post Type
        $args = array(
            'label'               => __( 'Town' ),
            'description'         => __( 'Description' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ),
            // You can associate this CPT with a taxonomy or custom taxonomy.
            'taxonomies'          => array( 'Town' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'menu_icon' => 'dashicons-exerpt-view'
        );

        // Registering your Custom Post Type
        register_post_type( 'towns', $args );

        /* Hook into the 'init' action so that the function
         * Containing our post type registration is not
         * unnecessarily executed.
         */

        add_action( 'init', 'AldabraPostTypes::createTowns', 0 );
    }

    public static function getTowns($result) {
        $result['choices'] = [];
        $args_total = [
            'post_type'=> 'towns',
            'order'    => 'ASC'
        ];

        $posts = get_posts( $args_total );
        if ($posts) {
            foreach ($posts AS $post) {
                $result['choices'][$post->ID] = $post->post_title;
            }
        }

        return $result;
    }

    public static function getTopology($result) {
        $result['choices'] = [];
        $args_total = [
            'post_type'=> 'topologies',
            'order'    => 'ASC'
        ];

        $posts = get_posts( $args_total );
        if ($posts) {
            foreach ($posts AS $post) {
                $result['choices'][$post->ID] = $post->post_title;
            }
        }

        return $result;
    }

    public static function setSubscriber() {
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : [];
        $errors = [];
        $success = true;
        try {
            $nonce = !empty($data['nonce']) ? $data['nonce'] : '';
            $firstname = !empty($data['firstname']) ? trim($data['firstname']) : '';
            $lastname = !empty($data['lastname']) ? trim($data['lastname']) : '';
            $email = !empty($data['email']) ? trim($data['email']) : '';
            $phone = !empty($data['phone']) ? trim($data['phone']) : '';
            $full = !empty($data['full_form']) ? intval($data['full_form']) : 0;
            $estate_id = 0;
            $location = '';
            $type = '';
            $room_number = '';
            $budget = '';

            if ($full) {
                $location = !empty($data['location']) ? trim($data['location']) : '';
                $type = !empty($data['type']) ? trim($data['type']) : '';
                $room_number = !empty($data['room_number']) ? trim($data['room_number']) : '';
                $budget = !empty($data['budget']) ? trim($data['budget']) : '';
            } else {
                $estate_id = !empty($data['estate_id']) ? intval($data['estate_id']) : 0;
            }

            if ($firstname == '') {
                $errors[] = 'firstname';
            }

            if ($lastname == '') {
                $errors[] = 'lastname';
            }

            if ($email == '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'email';
            }

            if ($full == 0) {
                if ($estate_id < 1) {
                    $errors[] = 'estate_id';
                }
            } else {
                if ($location == '') {
                    $errors[] = 'location';
                }

                if ($type == '') {
                    $errors[] = 'type';
                }

                if ($room_number == '') {
                    $errors[] = 'room_number';
                }

                if ($budget == '') {
                    $errors[] = 'budget';
                }
            }

            if ($errors) {
                throw new Exception("Incorrect Input");
            }

            if (!wp_verify_nonce($nonce, 'set_estate_subscriber')) {
                $errors[] = 'nonce';
                throw new Exception("Incorrect Input");
            }

            global $wpdb;
            $last_id = 0;
            $set_data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'phone' => $phone,
                'estate_id' => $estate_id,
                'location' => $location,
                'type' => $type,
                'room_number' => $room_number,
                'max_budget' => $budget,
            ];

            $wpdb->insert($wpdb->base_prefix . 'subscribers', $set_data);
            $last_id = $wpdb->insert_id;

            if ($last_id < 1) {
                $errors[] = 'system';
                throw new Exception('System error');
            }

            $estate_link = '';
            if ($estate_id > 0) {
                $args_total = [
                    'post_type' => 'estates',
                    'ID' => $estate_id
                ];
                $posts = get_posts($args_total);

                if ($posts) {
                    $post = $posts[0];
                    $estate_link = '<a href="' . get_permalink($post) . '" target="_blank">' . $post->post_title . '</a>';
                }
            }

            // send email
            $to = get_field('email_subscribers', 'option');
            $subject = 'Nouveau Abonné';
            $body = '
            <html>
                <head>
                    <meta charset="UTF-8">
                </head>
                <body>
                    <h2>Nouveau Abonné</h2>
                    <p>
                        <b>Nom :</b>' . $firstname . '
                    </p>
                    <p>
                        <b>Prénom :</b> ' . $lastname . '
                    </p>
                    <p>
                        <b>Adresse mail :</b> ' . $email . '
                    </p>
                    <p>
                        <b>Téléphone  :</b> ' . $phone . '
                    </p>';

            if ($estate_link) {
                $body .= '<p><b>Propriété :</b> ' . $estate_link . '</p>';
            } else {
                $body .= '                    <p>
                        <b>Localisation : </b>' . $location . '
                    </p>
                    <p>
                        <b>Type : </b>' . $type . '
                    </p>
                    <p>
                        <b>Nb. de pièces : </b>' . $room_number . '
                    </p>
                    <p>
                        <b>Budget max : </b>' . $budget . '
                    </p>';
            }

            $body .= '
                </body>
            <html>
            ';

            $headers = array('Content-Type: text/html; charset=UTF-8');

            wp_mail( $to, $subject, $body, $headers );

        } catch(Exception $e) {
            $success = false;
            if (empty($errors)) {

                $errors[] = 'system';
            }
        } finally {
            wp_send_json(compact('success', 'errors'));
        }
    }
}