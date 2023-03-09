<?php

/**
 *  Registers the Portfolio custom post type
 */

add_action('init', 'hb_register_portfolio');

function hb_register_portfolio() {

    $labels = array(
        'name'               => _x( 'Portfolio', 'post type general name' ),
        'singular_name'      => _x( 'Portfolio', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'new portfolio item' ),
        'add_new_item'       => __( 'Add New Portfolio Item' ),
        'edit_item'          => __( 'Edit Portfolio Item' ),
        'new_item'           => __( 'New Portfolio Item' ),
        'all_items'          => __( 'Portfolio Items' ),
        'view_item'          => __( 'View Portfolio Item' ),
        'search_items'       => __( 'Search Portfolio Items' ),
        'not_found'          => __( 'No Portfolio Items found' ),
        'not_found_in_trash' => __( 'No Portfolio Items found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Portfolio'
    );

    $args = array(
        'labels' => $labels,
        'description' => 'Holds portfolio specific data',
        'show_ui' => true,
        'public' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'comments'),
        'has_archive' => true,
    );

    register_post_type('portfolio', $args);

}

/**
 *  Registers the taxonomy for portfolio custom post type
 */

add_action ('init', 'hb_register_portfolio_category_taxonomy');

function hb_register_portfolio_category_taxonomy() {

    $args = array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Portfolio Categories', 'taxonomy general name' ),
            'singular_name' => _x( 'Category', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Categories' ),
            'all_items' => __( 'All Categories' ),
            'parent_item' => __( 'Parent Category' ),
            'parent_item_colon' => __( 'Parent Category:' ),
            'edit_item' => __( 'Edit Category' ),
            'update_item' => __( 'Update Category' ),
            'add_new_item' => __( 'Add New Category' ),
            'new_item_name' => __( 'New Category Name' ),
            'menu_name' => __( 'Portfolio Categories' ),
        ),
        'rewrite' => array(
            'slug' => 'portfolio_category', // This controls the base slug that will display before each term
            'with_front' => true, // Don't display the category base before "/locations/"
            'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
        ),

    );

    register_taxonomy('portfolio_category', array('portfolio'), $args);

}
