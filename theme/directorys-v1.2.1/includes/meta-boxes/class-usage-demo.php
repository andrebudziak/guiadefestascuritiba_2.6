<?php

//include the main class file
include_once( HOLO_FRAMEWORK_DIR . '/meta-boxes/meta-box-master/meta-box.php' );

add_filter( 'rwmb_meta_boxes', 'holo_register_meta_boxes' );
add_filter( 'rwmb_meta_boxes', 'holo_register_site_meta_boxes' );

function holo_register_meta_boxes( $meta_boxes ){
    $prefix = 'holo_';

    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'standard',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Standard Fields', 'rwmb' ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( 'post', 'page' ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'high',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        'fields' => array(
            // TEXT
            array(
                // Field name - Will be used as label
                'name'  => __( 'Post Video', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}video",
                // Field description (optional)
                'desc'  => __( 'Here you insert the video iframe for your post.', 'rwmb' ),
                'type'  => 'textarea',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
        )
    );

    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'gallery',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Standard Fields', 'rwmb' ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( 'post', 'page' ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'high',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        'fields' => array(
            // TEXT
            array(
                'name'             => __( 'Gallery', 'rwmb' ),
                'id'               => "{$prefix}post_gallery",
                'type'             => 'image_advanced',
                'desc'             => 'When you choose the image the image. Make sure you choose "Full Size" from the Image Size attribute.',
                'max_file_uploads' => 0,
            ),
        )
    );

    return $meta_boxes;
}

function holo_register_site_meta_boxes() {

    global $directorys_options;

    $prefix = 'holo_';

    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'gallery',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Standard Fields', 'rwmb' ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( 'post', 'site' ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'high',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        'fields' => array(
            // TEXT
            array(
                'name'             => __( 'Gallery', 'rwmb' ),
                'id'               => "{$prefix}post_gallery",
                'type'             => 'image_advanced',
                'desc'             => 'When you choose the image the image. Make sure you choose "Full Size" from the Image Size attribute.',
                'max_file_uploads' => 0,
            ),
        )
    );

    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'video',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Standard Fields', 'rwmb' ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( 'post', 'site' ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'high',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        'fields' => array(
            // TEXT
            array(
                // Field name - Will be used as label
                'name'  => __( 'Post Video', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}video",
                // Field description (optional)
                'desc'  => __( 'Here you insert the video iframe for your post.', 'rwmb' ),
                'type'  => 'textarea',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
        )
    );

    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'site_position',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Map Position', 'rwmb' ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( 'site' ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'high',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        'fields' => array(
            array(
                // Field name - Will be used as label
                'name'  => __( 'Map Latitude coordinates', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}site_lat_coords",
                // Field description (optional)
                'desc' => 'Find the Latitude coordinates using this <a href="http://www.gps-coordinates.net" target="_blank">application</a>',
                'type'  => 'text',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
            array(
                // Field name - Will be used as label
                'name'  => __( 'Map Longitude coordinates', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}site_long_coords",
                // Field description (optional)
                'desc' => 'Find the Longitude coordinates using this <a href="http://www.gps-coordinates.net target="_blank">application</a>',
                'type'  => 'text',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
        )
    );

    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'site_schedule',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Opening Hours', 'rwmb' ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( 'site' ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'high',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        'fields' => array(
            array(
                // Field name - Will be used as label
                'name'  => __( 'Show Schedule', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}site_schedule",
                // Field description (optional)
                'type'  => 'checkbox',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
            array(
                // Field name - Will be used as label
                'name'  => __( 'Monday', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}monday",
                // Field description (optional)
                'type'  => 'text',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
            array(
                // Field name - Will be used as label
                'name'  => __( 'Tuesday', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}tuesday",
                // Field description (optional)
                'type'  => 'text',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
            array(
                // Field name - Will be used as label
                'name'  => __( 'Wednesday', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}wednesday",
                // Field description (optional)
                'type'  => 'text',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
            array(
                // Field name - Will be used as label
                'name'  => __( 'Thursday', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}thursday",
                // Field description (optional)
                'type'  => 'text',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
            array(
                // Field name - Will be used as label
                'name'  => __( 'Friday', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}friday",
                // Field description (optional)
                'type'  => 'text',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
            array(
                // Field name - Will be used as label
                'name'  => __( 'Saturday', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}saturday",
                // Field description (optional)
                'type'  => 'text',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
            array(
                // Field name - Will be used as label
                'name'  => __( 'Sunday', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}sunday",
                // Field description (optional)
                'type'  => 'text',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
        )
    );

    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'site_show_rating',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Other Options', 'rwmb' ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( 'site' ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'high',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        'fields' => array(
            array(
                // Field name - Will be used as label
                'name'  => __( 'Show Ratings', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}site_show_ratings",
                // Field description (optional)
                'desc' => '',
                'type'  => 'checkbox',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            )
        )
    );

    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'sidebar_settings',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Sidebar Settings', 'rwmb' ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( 'page' ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'side',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'low',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        'fields' => array(
            array(
                // Field name - Will be used as label
                'name'  => __( 'Show Sidebar', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}sidebar_show",
                // Field description (optional)
                'desc' => '',
                'type'  => 'checkbox',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false
            ),
            array(
                // Field name - Will be used as label
                'name'  => __( 'Choose Sidebar', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}sidebar_select",
                // Field description (optional)
                'desc' => '',
                'type'  => 'select',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
                'options' => holo_get_reg_sidebars()
            ),
            array(
                // Field name - Will be used as label
                'name'  => __( 'Sidebar Position', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}sidebar_position",
                // Field description (optional)
                'desc' => '',
                'type'  => 'select',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
                'options' => array('left' => 'Left', 'right' => 'Right')
            ),
        )
    );

    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'featured_listing',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Featured Listing', 'rwmb' ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( 'site' ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'normal',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'high',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        'fields' => array(
            array(
                // Field name - Will be used as label
                'name'  => __( 'Featured Listing', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}site_featured",
                // Field description (optional)
                'desc' => 'This is used for "Best Sites" shortcode',
                'type'  => 'checkbox',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
        )
    );

    $meta_boxes[] = array(
        // Meta box id, UNIQUE per meta box. Optional since 4.1.5
        'id' => 'page_settings',

        // Meta box title - Will appear at the drag and drop handle bar. Required.
        'title' => __( 'Page Settings', 'rwmb' ),

        // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
        'pages' => array( 'page' ),

        // Where the meta box appear: normal (default), advanced, side. Optional.
        'context' => 'side',

        // Order of meta box: high (default), low. Optional.
        'priority' => 'low',

        // Auto save: true, false (default). Optional.
        'autosave' => true,

        'fields' => array(
            array(
                // Field name - Will be used as label
                'name'  => __( 'Show Site Filter', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}page_show_filter",
                // Field description (optional)
                'desc' => '',
                'type'  => 'checkbox',
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
                // Default value (optional)
            ),
            array(
                // Field name - Will be used as label
                'name'  => __( 'Top Section', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}page_top_section",
                // Field description (optional)
                'desc' => '',
                'type'  => 'select',
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
                'options' => array('none' => 'No Top Content', 'slider' => 'Revolution Slider', 'map' => 'Google Map'),
            ),
            array(
                // Field name - Will be used as label
                'name'  => __( 'Slider alias', 'rwmb' ),
                // Field ID, i.e. the meta key
                'id'    => "{$prefix}page_top_slider",
                // Field description (optional)
                'desc' => '',
                'type'  => 'text',
                // Default value (optional)
                'std'   => __( '', 'rwmb' ),
                // CLONES: Add to make the field cloneable (i.e. have multiple value)
                'clone' => false,
            ),
        )
    );

    return $meta_boxes;

}
