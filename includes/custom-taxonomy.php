<?php

// Custom taxonomy

// Register custom taxonomy for projecten
// add_action( 'init', 'projecten_tax' );
function projecten_tax() {
    $labels = array(
        'name'              => _x( 'Labels', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Label', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Zoek label', 'textdomain' ),
        'all_items'         => __( 'Alle labels', 'textdomain' ),
        'parent_item'       => __( 'Parent label', 'textdomain' ),
        'parent_item_colon' => __( 'Parent label:', 'textdomain' ),
        'edit_item'         => __( 'Label aanpassen', 'textdomain' ),
        'update_item'       => __( 'Update label', 'textdomain' ),
        'add_new_item'      => __( 'Nieuw label', 'textdomain' ),
        'new_item_name'     => __( 'Nieuwe label naam', 'textdomain' ),
        'menu_name'         => __( 'Label', 'textdomain' ),
    );
 
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'label' ),
    );

    register_taxonomy( 'label', array( 'projecten' ), $args );
}

?>