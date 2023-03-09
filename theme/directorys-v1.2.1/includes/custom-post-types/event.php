<?php

/**
 *  Registers the Event custom post type
 */

add_action('init', 'hb_register_event');

function hb_register_event() {

    $labels = array(
        'name'               => _x( 'Events', 'post type general name' ),
        'singular_name'      => _x( 'Event', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'new portfolio item' ),
        'add_new_item'       => __( 'Add New Event' ),
        'edit_item'          => __( 'Edit Event' ),
        'new_item'           => __( 'New Event' ),
        'all_items'          => __( 'Events' ),
        'view_item'          => __( 'View Event' ),
        'search_items'       => __( 'Search Event' ),
        'not_found'          => __( 'No Events found' ),
        'not_found_in_trash' => __( 'No Events found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Event'
    );

    $args = array(
        'labels' => $labels,
        'description' => 'Holds events specific data',
        'show_ui' => true,
        'public' => true,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'comments'),
        'has_archive' => true,
    );

    register_post_type('event', $args);

}

/**
 *  Registers the taxonomy for portfolio custom post type
 */

add_action ('init', 'hb_register_event_category_taxonomy');

function hb_register_event_category_taxonomy() {

    $args = array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Events Categories', 'taxonomy general name' ),
            'singular_name' => _x( 'Event Category', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Event Categories' ),
            'all_items' => __( 'All Categories' ),
            'parent_item' => __( 'Parent Category' ),
            'parent_item_colon' => __( 'Parent Category:' ),
            'edit_item' => __( 'Edit Category' ),
            'update_item' => __( 'Update Category' ),
            'add_new_item' => __( 'Add New Category' ),
            'new_item_name' => __( 'New Category Name' ),
            'menu_name' => __( 'Events Categories' ),
        ),
        'rewrite' => array(
            'slug' => 'event_category', // This controls the base slug that will display before each term
            'with_front' => true, // Don't display the category base before "/locations/"
            'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
        ),

    );

    register_taxonomy('event_category', array('event'), $args);

}
