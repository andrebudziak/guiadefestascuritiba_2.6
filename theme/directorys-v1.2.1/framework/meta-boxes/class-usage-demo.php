<?php

//include the main class file
include_once( HOLO_FRAMEWORK_DIR . '/meta-boxes/meta-box-master/meta-box.php' );

add_filter( 'rwmb_meta_boxes', 'holo_register_meta_boxes' );

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

function holo_register_meta_boxes2() {
    if (is_admin()){
        /*
         * prefix of meta keys, optional
         * use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
         *  you also can make prefix empty to disable it
         *
         */
        $prefix = 'holo_';

//        $config = array(
//            'id'             => 'sidebar',          // meta box id, unique per meta box
//            'title'          => 'Simple Meta Box fields',          // meta box title
//            'pages'          => array('post', 'page'),      // post types, accept custom post types as well, default is array('post'); optional
//            'context'        => 'side',            // where the meta box appear: normal (default), advanced, side; optional
//            'priority'       => 'low',            // order of meta box: high (default), low; optional
//            'fields'         => array(),            // list of meta fields (can be added by field arrays)
//            'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
//            'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
//        );
//
//        $my_meta =  new AT_Meta_Box($config);
//
//        $sidebars_raw = get_option('holo_sidebars');
//
//        foreach ( $sidebars_raw as $sidebar ) {
//            $sidebars[$sidebar] = $sidebar;
//        }
//
//        $my_meta->addSelect(
//            $prefix . 'select_field_id',
//            $sidebars,
//            array('name'=> 'My select ', 'std'=> array('selectkey2'))
//        );
//
//        $my_meta->Finish();

        /*
    * configure your meta box
    */
        $event_info_config = array(
            'id'             => 'event_information',          // meta box id, unique per meta box
            'title'          => 'Event Information',          // meta box title
            'pages'          => array('event'),      // post types, accept custom post types as well, default is array('post'); optional
            'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
            'priority'       => 'high',            // order of meta box: high (default), low; optional
            'fields'         => array(),            // list of meta fields (can be added by field arrays)
            'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
            'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
        );


        /*
        * Initiate your meta box
        */
        $event_info =  new AT_Meta_Box($event_info_config);

        /*
	   * Add fields to your meta box
	   */
        //text field
        $event_info->addText($prefix . 'event_location',array('name'=> 'Event Location', 'desc' => 'E.G. Miami, USA'));
        $event_info->addText($prefix . 'event_address',array('name'=> 'Event Address', 'desc' => 'E.G. 635 McQueen Smith Road'));
        $event_info->addDate($prefix . 'event_date',array('name'=> 'Event Date', 'desc' => 'E.G. 635 McQueen Smith Road'));
        $event_info->addTime($prefix . 'event_starting_time',array('name'=> 'Event Starting Time', 'desc' => 'E.G. 09:00'));
        $event_info->addTime($prefix . 'event_ending_time',array('name'=> 'Event Ending Time', 'desc' => 'E.G. 11:00'));
        $event_info->addCheckbox($prefix . 'event_canceled',array('name'=> 'Event Is Canceled', 'desc' => 'Check if the event is canceled.'));
        $event_info->addTextarea($prefix . 'event_map',array('name'=> 'Event Map'));

        /*
         * Don't Forget to Close up the meta box Declaration
         */
        //Finish Meta Box Declaration
        $event_info->Finish();


	    $sidebar_config = array(
		    'id'             => 'sidebar_select',          // meta box id, unique per meta box
		    'title'          => 'Choose sidebar',          // meta box title
		    'pages'          => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
		    'context'        => 'side',            // where the meta box appear: normal (default), advanced, side; optional
		    'priority'       => 'low',            // order of meta box: high (default), low; optional
		    'fields'         => array(),            // list of meta fields (can be added by field arrays)
		    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
		    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	    );


	    /*
	* Initiate your meta box
	*/
	    $sidebar_info =  new AT_Meta_Box($sidebar_config);


	    $sidebar_info->addSelect(
		    $prefix . 'select_sidebar',
		    holo_get_reg_sidebars(),
		    array('name'=> 'Choose Sidebar', 'std'=> array('selectkey2'))
	    );

	    $sidebar_info->Finish();

    }

}
