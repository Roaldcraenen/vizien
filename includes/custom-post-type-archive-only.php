<?php

// CPT where only the archive is visibiel/indexable/crawlable

add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'medewerkers',
        array(
            'labels' => array(
                'name' => __( 'Medewerkers' ),
                'singular_name' => __( 'Medewerker' ),
                'add_new' => __('Nieuwe medewerker'),
                'all_items' => __('Alle medewerkers')
            ),
            'menu_icon' => 'dashicons-groups',
            'public' => false, // hide archive + single
            'publicly_queryable' => true, // enable to query it
            'show_ui' => true, // enable to edit in wp-admin
            'exclude_from_search' => true, // exclude from on-site search
            'show_in_nav_menus' => true, // enable to add to menus
            'has_archive' => true, // enable archive
            'rewrite' => array('with_front' => false), // If you set 'blog' in front of blog URLs, make sure this custom post type removes it
            'supports' => array( 'title', 'editor', 'thumbnail' )
        )
    );
}

// Redirect 'medewerkers' single to archive
add_action( 'template_redirect', 'redirect_medewerkers_single' );
function redirect_medewerkers_single() {
    if ( is_singular( 'medewerkers' ) ) :
        wp_redirect( get_post_type_archive_link('medewerkers'), 301 );
        exit;
    endif;
}
?>