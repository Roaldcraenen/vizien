<?php

// Roles & Capabilities

// Hide additional menu items for non-admin users
function hide_redundant_menu_items() {
    if( is_user_logged_in() && !current_user_can('administrator') ) :
        remove_menu_page( 'tools.php' ); // Remove 'Tools' menu
        remove_menu_page( 'wpcf7' ); // Remove 'Contact Form 7' menu
    endif;
}
add_action( 'admin_head', 'hide_redundant_menu_items', 99 ); 

// Hide Yoast menu item for non admin-users
function hide_yoast_menu(){
    if( is_user_logged_in() && !current_user_can('administrator') ) :
        remove_menu_page( 'wpseo_workouts' ); // Remove 'Yoast' menu
    endif;
}
add_action('admin_menu', 'hide_yoast_menu', 999);

// Remove default Yoast user roles
function remove_yoast_user_roles() {
    if ( get_role('wpseo_manager') ) {
        remove_role( 'wpseo_manager' ); // Remove 'WP SEO manager' role
    }
    if ( get_role('wpseo_editor') ) {
        remove_role( 'wpseo_editor' ); // Remove 'WP SEO editor' role
    }
}
add_action( 'init', 'remove_yoast_user_roles' ); 

// Disable default widgets
function disable_default_dashboard_widgets() {
    if( is_user_logged_in() && !current_user_can('administrator') ) :
        remove_meta_box('dashboard_primary', 'dashboard', 'side'); // Remove 'WordPress news'
        remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // Remove 'Activity'
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // Remove 'Quick draft'
        remove_action('welcome_panel', 'wp_welcome_panel'); // Remove 'Welcome panel'
        remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // Remove 'At a glance'
        remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' ); // Remove 'Yoast'
    endif;
}
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);

// Add custom administrator role
function add_custom_user_role() {
    add_role('klant', __('Klant'), array(
        'manage_categories' => true,'manage_links' => true,'upload_files' => true,'edit_posts' => true,'edit_others_posts' => true,'edit_published_posts' => true,'publish_posts' => true,'edit_pages' => true,'read' => true,'publish_pages' => true,'edit_others_pages' => true,'edit_published_pages' => true,'delete_pages' => true,'delete_others_pages' => true,'delete_published_pages' => true,'delete_posts' => true,'delete_others_posts' => true,'delete_published_posts' => true,'delete_private_posts' => true,'edit_private_posts' => true,'read_private_posts' => true,'delete_private_pages' => true,'edit_private_pages' => true,'read_private_pages' => true,'list_users' => true,'edit_theme_options' => true,'create_users' => true,'edit_comment' => true,'edit_themes' => false,'switch_themes' => false,'install_themes' => false,'activate_plugins' => false,'edit_plugins' => false,'install_plugins' => false,'edit_users' => false,'manage_options' => false,'moderate_comments' => false,'import' => false,'unfiltered_html' => false,'delete_users' => false,'unfiltered_upload' => false,'edit_dashboard' => false,'customize' => false,'update_plugins' => false,'delete_plugins' => false,'update_themes' => false,'update_core' => false,'remove_users' => false,'promote_users' => false,'delete_themes' => false,'export' => false,
       ));
    }
add_action('init', 'add_custom_user_role');

// Remove 'Appearance' menu items for non-admin users
function check_admin_role_existence(){
    if ( is_user_logged_in() && !current_user_can('administrator') ) :
        remove_submenu_page( 'themes.php', 'themes.php' ); // Remove 'Themes' menu
        remove_submenu_page( 'themes.php', 'widgets.php' ); // Remove 'Widgets' menu
        $customizer_url = add_query_arg( 'return', urlencode( remove_query_arg( wp_removable_query_args(), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ), 'customize.php' ); // Get URL
        remove_submenu_page( 'themes.php', $customizer_url ); // Remove 'Customizer' menu
    endif;
}
add_action( 'admin_head', 'check_admin_role_existence' );

?>