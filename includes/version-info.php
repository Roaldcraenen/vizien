<?php

// Remove dashboard WordPress version
function remove_version_info() {
    remove_filter( 'update_footer', 'core_update_footer' ); 
}
add_action( 'admin_menu', 'remove_version_info' );

// Remove default WordPress text
// function admin_left_footer () {
//     echo '';
// }
// add_filter('admin_footer_text', 'admin_left_footer');

// Show custom version information if user is an admin

// FOOTER version
function admin_left_footer () {
    if ( is_user_logged_in() && current_user_can('administrator') ) :
        // Get Bootstrap JS file path
        $bootstrap_path = get_stylesheet_directory_uri() . '/js/bootstrap.bundle.min.js';
        // Get version from beginning of file
        $bootstrap_version = file_get_contents($bootstrap_path, FALSE, NULL, 8, 16);
         echo '<span style="background:#777bb3;color:#fff;padding: 0 7px 2px 7px;border-radius: 5px;">PHP ' . phpversion() . '</span>' . '<span style="color:#fff;background:#2271b1;padding: 0 7px 2px 7px;border-radius:5px;margin: 0 5px;">WordPress ' . get_bloginfo('version') . '</span>' . '<span style="background:#7952b3;color:#fff;border-radius:5px;padding: 0 7px 2px 7px;">' . $bootstrap_version . '</span>';
    elseif( is_user_logged_in() && !current_user_can('administrator') ):
        return '';
    endif;
}
add_filter('admin_footer_text', 'admin_left_footer');

// WIDGET version
// add_action('wp_dashboard_setup', 'dashboard_version_info_widget');
 
// function dashboard_version_info_widget() {
//     if ( is_user_logged_in() && current_user_can('administrator') ) :
//         global $wp_meta_boxes;
//         wp_add_dashboard_widget('custom_help_widget', 'Version information', 'custom_dashboard_help');
//     elseif( is_user_logged_in() && !current_user_can('administrator') ):
//         return '';
//     endif;
// }
 
// function custom_dashboard_help() {
//     if ( is_user_logged_in() && current_user_can('administrator') ) :
//         // Get Bootstrap JS file path
//         $bootstrap_path = get_stylesheet_directory_uri() . '/js/bootstrap.bundle.min.js';
//         // Get version from beginning of file
//         $bootstrap_version = file_get_contents($bootstrap_path, FALSE, NULL, 8, 16);
//          echo '<div style="display:flex;flex-direction:column;">' . '<span style="display:block;width:max-content;background:#777bb3;color:#fff;padding: 0 7px 2px 7px;border-radius: 5px;margin-bottom:10px;">PHP ' . phpversion() . '</span>' . '<span style="display:block;width:max-content;color:#fff;background:#2271b1;padding: 0 7px 2px 7px;border-radius:5px;margin-bottom:10px;">WordPress ' . get_bloginfo('version') . '</span>' . '<span style="display:block;width:max-content;background:#7952b3;color:#fff;border-radius:5px;padding: 0 7px 2px 7px;">' . $bootstrap_version . '</span>';
//     elseif( is_user_logged_in() && !current_user_can('administrator') ):
//         return '';
//     endif;
// }

?>