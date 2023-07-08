<?php

// Vizien Dashboard Thema

function vizien_admin_color_scheme() {
  //Get the theme directory
  $theme_dir = get_stylesheet_directory_uri();

  //Vizien
  wp_admin_css_color( 'vizien', __( 'Vizien' ),
    $theme_dir . '/css/vizien.css',
    array( '#1d2327', '#ffffff', '#f04e23' , '#f04e23')
  );
}
add_action('admin_init', 'vizien_admin_color_scheme');

?>