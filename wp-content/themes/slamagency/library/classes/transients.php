<?php


// - - - - - - - - - - - - - - - - - - - - - - - - - - -  Menus

/**
 * Use transient to populate menus, if they exist.
 * @param  array  $args [description]
 * @return [type]       [description]
 */
function ak_transient_menu( $args = array() ) {
    $defaults = array(
        'menu' => '',
        'theme_location' => '',
        'echo' => true,
    );

    $args = wp_parse_args( $args, $defaults );

    $transient_name = 'ak_menu-' . $args['theme_location'];
    $menu = get_transient( $transient_name );

    if ( false === $menu ) {
        $menu_args = $args;
        $menu_args['echo'] = false;
        $menu = wp_nav_menu( $menu_args );
        set_transient( $transient_name, $menu, 0 );
    }

    if( false === $args['echo'] ) {
        return $menu;
    }

    echo $menu;

}

/**
 * Delete transients for menus when menus are updated.
 */
add_action( 'wp_update_nav_menu', 'ak_update_menus' );
function ak_update_menus() {
    global $wpdb;
    $menus = $wpdb->get_results( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '%ak_menu_%'" );
    
    foreach( $menus as $menu ) {
    	$transient = $menu->option_name;
    	$transient = str_replace('_transient_', '', $transient);
        $result = delete_transient( $transient );
    }
}



// - - - - - - - - - - - - - - - - - - - - - - - - - - -  Pages

 

/**
 * Delete transients for menus when menus are updated.
 */
add_action( 'save_post', 'ak_update_page_transients' );
function ak_update_page_transients() {
    global $wpdb;
    $pages = $wpdb->get_results( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '_transient_ak_page_%'" );
    
    
    //error_log($pages);
    
    foreach( $pages as $page ) {
    	$transient = $page->option_name;
    	$transient = str_replace('_transient_', '', $transient);
        $result = delete_transient( $transient );
        error_log( 'Page Transient Update Result: ' . $result );
    }
}


// - - - - - - - - - - - - - - - - - - - - - - - - - - -  Pages

 

/**
 * Delete transients for menus when menus are updated.
 */
add_action( 'save_post', 'ak_update_event_transients' );
function ak_update_event_transients() {
    global $wpdb;
    $events = $wpdb->get_results( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '_transient_ak_event_%'" );
    
    
    //error_log($pages);
    
    foreach( $events as $event ) {
    	$transient = $event->option_name;
    	$transient = str_replace('_transient_', '', $transient);
        $result = delete_transient( $transient );
        error_log( 'Event Transient Update Result: ' . $result );
    }
}

/**
 * Delete transients for menus when menus are updated.
 */
add_action( 'save_post', 'ak_update_message_transients' );
function ak_update_message_transients() {
    global $wpdb;
    $events = $wpdb->get_results( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '_transient_ak_latest_message_%'" );
    
    
    //error_log($pages);
    
    foreach( $events as $event ) {
    	$transient = $event->option_name;
    	$transient = str_replace('_transient_', '', $transient);
        $result = delete_transient( $transient );
        error_log( 'Message Transient Update Result: ' . $result );
    }
}

