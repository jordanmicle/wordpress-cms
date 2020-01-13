<?php

/*
Plugin Name: Subscribers Plugin
*/


if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Subscribers_List extends WP_List_Table
{

    /** Class constructor */
    public function __construct()
    {

        parent::__construct([
            'singular' => __('Subscriber', 'sp'), //singular name of the listed records
            'plural' => __('Subscribers', 'sp'), //plural name of the listed records
            'ajax' => true //should this table support ajax?
        ]);

    }

    public static function get_subscribers( $per_page = 5, $page_number = 1 ) {

        global $wpdb;

        $sql = "SELECT * FROM {$wpdb->prefix}subscribers";

        if ( ! empty( $_REQUEST['orderby'] ) ) {
            $sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
            $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
        }

        $sql .= " LIMIT $per_page";

        $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;


        $result = $wpdb->get_results( $sql, 'ARRAY_A' );

        return $result;
    }

    public static function delete_subscriber( $id ) {
        global $wpdb;

        $wpdb->delete(
            "{$wpdb->prefix}subscribers",
            [ 'ID' => $id ],
            [ '%d' ]
        );
    }

    public static function record_count() {
        global $wpdb;

        $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}subscribers";

        return $wpdb->get_var( $sql );
    }

    function column_name( $item ) {
        // create a nonce
        $delete_nonce = wp_create_nonce( 'sp_delete_subscriber' );

        $title = '<strong>' . $item['name'] . '</strong>';

        $actions = [
            'delete' => sprintf( '<a href="?page=%s&action=%s&customer=%s&_wpnonce=%s">Delete</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['ID'] ), $delete_nonce )
        ];

        return $title . $this->row_actions( $actions );
    }

    public function column_default( $item, $column_name ) {
        switch ( $column_name ) {
            case 'firstname':
            case 'lastname':
            case 'email':
            case 'phone':
            case 'location':
            case 'type':
            case 'room_number':
            case 'max_budget':
            case 'date':
                return $item[ $column_name ];
            case 'estate_id':
                $id = intval($item[ $column_name ]);

                if ($id > 0) {
                    $args_total = [
                        'post_type' => 'estates',
                        'ID' => $id
                    ];
                    $posts = get_posts($args_total);

                    if ($posts) {
                        $post = $posts[0];
                        return '<a href="' . get_permalink($post) . '" target="_blank">' . $post->post_title . '</a>';
                    }
                }
                return '-';
            default:
                return print_r( $item, true );
        }
    }

    function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ID']
        );
    }

    function get_columns() {
        $columns = [
            'cb'      => '<input type="checkbox" />',
            'firstname'      => __( 'Firstname', 'db' ),
            'lastname'    => __( 'Lastname', 'db' ),
            'email'    => __( 'Email', 'db' ),
            'phone' => __( 'Phone', 'db' ),
            'estate_id' => __( 'Estate', 'db' ),
            'location' => __( 'Location', 'db' ),
            'type' => __( 'Type', 'db' ),
            'room_number' => __( 'Room number', 'db' ),
            'max_budget' => __( 'Max budget', 'db' ),
            'date' => __( 'Date', 'db' )
        ];

        return $columns;
    }

    public function get_sortable_columns() {
        $sortable_columns = array(
            'name' => array( 'name', true ),
            'nickname' => array( 'nickname', true ),
            'email' => array( 'email', true ),
            'estate_id' => array( 'estate_id', true ),
            'type' => array( 'type', true ),
            'room_number' => array( 'room_number', true ),
            'location' => array( 'location', true ),
            'max_budget' => array( 'max_budget', true )
        );

        return $sortable_columns;
    }

    public function get_bulk_actions() {
        $actions = [
            'bulk-delete' => 'Delete'
        ];

        return $actions;
    }

    public function prepare_items() {

        $this->_column_headers = $this->get_column_info();

        /** Process bulk action */
        $this->process_bulk_action();

        $per_page     = $this->get_items_per_page( 'subscribers_per_page', 5 );
        $current_page = $this->get_pagenum();
        $total_items  = self::record_count();

        $this->set_pagination_args( [
            'total_items' => $total_items, //WE have to calculate the total number of items
            'per_page'    => $per_page //WE have to determine how many items to show on a page
        ] );


        $this->items = self::get_subscribers( $per_page, $current_page );
    }

    public function process_bulk_action() {
        //Detect when a bulk action is being triggered...
        if ( 'delete' === $this->current_action() ) {
            echo "asd";
            exit;
            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr( $_REQUEST['_wpnonce'] );

            if ( ! wp_verify_nonce( $nonce, 'sp_delete_subscriber' ) ) {
                die( 'Go get a life script kiddies' );
            }
            else {
                self::delete_customer( absint( $_GET['subscriber'] ) );

                wp_redirect( esc_url( add_query_arg() ) );
                exit;
            }

        }

        // If the delete bulk action is triggered
        if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' )
            || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
        ) {

            $delete_ids = esc_sql( $_POST['bulk-delete'] );

            // loop over the array of record IDs and delete them
            foreach ( $delete_ids as $id ) {
                self::delete_subscriber( $id );

            }

            wp_redirect( esc_url( add_query_arg() ) );
            exit;
        }
    }
}


class Subscribers_Plugin
{
    // class instance
    static $instance;

    // customer WP_List_Table object
    public $subscribers_obj;

    // class constructor
    public function __construct()
    {
        add_filter('set-screen-option', [__CLASS__, 'set_screen'], 10, 3);
        add_action('admin_menu', [$this, 'plugin_menu']);
    }

    public static function set_screen( $status, $option, $value ) {
        return $value;
    }


    public function plugin_menu() {

        $hook = add_menu_page(
            'Subscribers Table',
            'Subscribers Table',
            'manage_options',
            'wp_list_table_class',
            [ $this, 'plugin_settings_page' ]
        );

        add_action( "load-$hook", [ $this, 'screen_option' ] );

    }

    public function screen_option() {
        $option = 'per_page';
        $args   = [
            'label'   => 'Subscribers',
            'default' => 5,
            'option'  => 'subscribers_per_page'
        ];

        add_screen_option( $option, $args );

        $this->subscribers_obj = new Subscribers_List();
    }

    public function plugin_settings_page() {
        ?>
        <div class="wrap">
            <h2>Subscribers Table</h2>

            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
                            <form method="post">
                                <?php
                                $this->subscribers_obj->prepare_items();
                                $this->subscribers_obj->display(); ?>
                            </form>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>
        <?php
    }

    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

add_action( 'plugins_loaded', function () {
    Subscribers_Plugin::get_instance();
} );
?>