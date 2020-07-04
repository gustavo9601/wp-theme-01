<?php

// Register Custom Taxonomy
function custom_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Taxonomies Pruebas', 'Taxonomy General Name', 'mawt' ),
        'singular_name'              => _x( 'Taxonomy Prueba', 'Taxonomy Singular Name', 'mawt' ),
        'menu_name'                  => __( 'Taxonomy Prueba', 'mawt' ),
        'all_items'                  => __( 'All Items', 'mawt' ),
        'parent_item'                => __( 'Parent Item', 'mawt' ),
        'parent_item_colon'          => __( 'Parent Item:', 'mawt' ),
        'new_item_name'              => __( 'New Item Name', 'mawt' ),
        'add_new_item'               => __( 'Add New Item', 'mawt' ),
        'edit_item'                  => __( 'Edit Item', 'mawt' ),
        'update_item'                => __( 'Update Item', 'mawt' ),
        'view_item'                  => __( 'View Item', 'mawt' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'mawt' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'mawt' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'mawt' ),
        'popular_items'              => __( 'Popular Items', 'mawt' ),
        'search_items'               => __( 'Search Items', 'mawt' ),
        'not_found'                  => __( 'Not Found', 'mawt' ),
        'no_terms'                   => __( 'No items', 'mawt' ),
        'items_list'                 => __( 'Items list', 'mawt' ),
        'items_list_navigation'      => __( 'Items list navigation', 'mawt' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false, # en false se comporatara como etiqueta, en caso contrario como una categoria
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    # a_taxonomy es el slug de la url que se usara para acceder a  la taxonomia
    # array( 'post' )  a que elementos se agregara este feature
    register_taxonomy( 'a_taxonomy', array( 'post' ), $args );
}
add_action( 'init', 'custom_taxonomy', 0 );