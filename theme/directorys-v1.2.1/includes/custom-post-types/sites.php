<?php

/**
 *  Registers the Sites custom post type
 */

add_action( 'admin_init', 'add_event_caps');
function add_event_caps() {
    $role = get_role( 'administrator' );

    $role->add_cap( 'publish_locations' );
    $role->add_cap( 'edit_published_locations' );
    $role->add_cap( 'edit_locations' );
    $role->add_cap( 'edit_others_locations' );
    $role->add_cap( 'read_private_locations' );
    $role->add_cap( 'edit_location' );
    $role->add_cap( 'read_location' );
    $role->add_cap( 'delete_location' );
    $role->add_cap( 'delete_locations' );
    $role->add_cap( 'delete_others_locations' );
    $role->add_cap( 'delete_published_locations');
}

add_action('init', 'hb_register_site');

function hb_register_site() {



    global $directorys_options;

    if ( isset($directorys_options['listings_permalink_slug']) && !empty($directorys_options['listings_permalink_slug']) ) {

        $listings_permalink_slug = $directorys_options['listings_permalink_slug'];

    } else {
        $listings_permalink_slug = 'site';
    }

    $labels = array(
        'name'               => _x( 'Sites', 'post type general name' ),
        'singular_name'      => _x( 'Site', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'new portfolio item' ),
        'add_new_item'       => __( 'Add New Site' ),
        'edit_item'          => __( 'Edit Site' ),
        'new_item'           => __( 'New Site' ),
        'all_items'          => __( 'Sites' ),
        'view_item'          => __( 'View Site' ),
        'search_items'       => __( 'Search Site' ),
        'not_found'          => __( 'No Sites found' ),
        'not_found_in_trash' => __( 'No Sites found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Sites'
    );

    $args = array (
        'labels' => $labels,
        'description' => 'Holds sites specific data',
        'show_ui' => true,
        'public' => true,
        'menu_position' => 5,
        'supports' => array ('title', 'editor', 'thumbnail', 'comments', 'excerpt'),
        'has_archive' => true,
        'rewrite' => array ('slug' => $listings_permalink_slug),
        'publicly_queryable' => true,
        'capability_type' => 'location',
        'capabilities' => array (
            'publish_posts' => 'publish_locations',
            'edit_published_posts' => 'edit_published_locations',
            'edit_posts' => 'edit_locations',
            'edit_others_posts' => 'edit_others_locations',
            'delete_posts' => 'delete_locations',
            'delete_others_posts' => 'delete_others_locations',
            'read_private_posts' => 'read_private_locations',
            'edit_post' => 'edit_location',
            'delete_post' => 'delete_location',
            'delete_published_posts' => 'delete_published_locations',
            'read_post' => 'read_location',
        ),
        'map_meta_cap' => true
    );

//    if (isset($listings_permalink_slug) && !empty($listings_permalink_slug)) {
//
//        $args['rewrite'] = array('slug' => $listings_permalink_slug);
//
//        ht_change_permalink_to('/%postname%/');
//
//        echo 'cool';
//
//    }

    register_post_type('site', $args);

}

/**
 *  Registers the location taxonomy for Sites custom post type
 */

add_action ('init', 'hb_register_sites_location_taxonomy');

function hb_register_sites_location_taxonomy() {

    $args = array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Sites Locations', 'taxonomy general name' ),
            'singular_name' => _x( 'Sites Locations', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Sites Locations' ),
            'all_items' => __( 'All Locations' ),
            'parent_item' => __( 'Parent Location' ),
            'parent_item_colon' => __( 'Parent Lcoation:' ),
            'edit_item' => __( 'Edit Location' ),
            'update_item' => __( 'Update Location' ),
            'add_new_item' => __( 'Add New Location' ),
            'new_item_name' => __( 'New Location Name' ),
            'menu_name' => __( 'Sites Locations' ),
        ),
        'rewrite' => array(
            'slug' => 'sites_location', // This controls the base slug that will display before each term
            'with_front' => true, // Don't display the category base before "/locations/"
            'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
        ),
        'capabilities'    => array(
            'manage_terms'                =>'edit_users',
            'edit_terms'              =>'ht_edit_listings_terms',
            'delete_terms'                =>'edit_users',
            'assign_terms'                =>'ht_assign_listings_terms',
        ),

    );

    register_taxonomy('sites_location', array('site'), $args);

}

/**
 *  Registers the category taxonomy for Sites custom post type
 */

add_action ('init', 'hb_register_sites_category_taxonomy');

function hb_register_sites_category_taxonomy() {

    $args = array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x( 'Sites Categories', 'taxonomy general name' ),
            'singular_name' => _x( 'Sites Category', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Sites Categories' ),
            'all_items' => __( 'All Categories' ),
            'parent_item' => __( 'Parent Category' ),
            'parent_item_colon' => __( 'Parent Category:' ),
            'edit_item' => __( 'Edit Category' ),
            'update_item' => __( 'Update Category' ),
            'add_new_item' => __( 'Add New Category' ),
            'new_item_name' => __( 'New Category Name' ),
            'menu_name' => __( 'Sites Categories' ),
        ),
        'rewrite' => array(
            'slug' => 'sites_category', // This controls the base slug that will display before each term
            'with_front' => true, // Don't display the category base before "/locations/"
            'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
        ),
        'capabilities'    => array(
            'manage_terms'                =>'edit_users',
            'edit_terms'                  =>'ht_edit_listings_terms',
            'delete_terms'                =>'edit_users',
            'assign_terms'                =>'ht_assign_listings_terms',
        ),

    );

    register_taxonomy('sites_category', array('site'), $args);

}

/**
 * @param $term
 *
 * Add custom field to the edit page of the Site Category Taxonomy
 */
add_action( 'sites_category_edit_form_fields', 'ht_edit_site_category_generate_pin_markup', 10, 2 );

function ht_edit_site_category_generate_pin_markup($term) {

    if (!function_exists('gd_info')) {

        echo '<div class="alert alert-warning">
                <i class="fa fa-attention pull-left"></i>
                <div class="text">You cannot create pins because the GD library is not installed. Please contact your host provider and ask to help install it.</div>
            </div>';

    }

    // put the term ID into a variable
    $t_id = $term->term_id;

    // retrieve the existing value(s) for this meta field. This returns an array
    $term_meta = get_option( "taxonomy_$t_id" );

    ?>

    <tr class="form-field">
        <th scope="row" valign="top"><label for="site_cat_meta[color]"><?php _e( 'Category badge', 'pippin' ); ?></label></th>
        <td>
            <div class="site-category-badge-generator">
                <div class="site-category-badge-color">
                    <input type="text" class="badge-color" />
                </div>

                <div class="upload-container">
                    <div class="upload-wrapper">
                        <div class="badge-preview"></div>
                        <button class="ht-badge-icon-upload" data-frame="select" data-state="holo-single-image" data-button="insert image">Choose Icon</button>
                    </div>

                    <input type="hidden" class="badge-image" value="" />
                </div>

                <button class="action generate-badge">Generate Badge</button>
            </div>

            <div class="badge-result-container">

                <?php if (!empty($term_meta['pin'])) : ?>

                    <img src="<?php echo esc_attr( $term_meta['pin'] ) ? esc_attr( $term_meta['pin'] ) : ''; ?>" />
                    <img src="<?php echo esc_attr( $term_meta['badge'] ) ? esc_attr( $term_meta['badge'] ) : ''; ?>" />

                <?php endif; ?>

            </div>

            <input type="hidden" name="site_cat_meta[pin]" id="site_cat_meta[pin]" class="site-category-pin-input"
                   value="<?php echo esc_attr( $term_meta['pin'] ) ? esc_attr( $term_meta['pin'] ) : ''; ?>">
            <input type="hidden" name="site_cat_meta[badge]" id="site_cat_meta[badge]" class="site-category-badge-input"
                   value="<?php echo esc_attr( $term_meta['badge'] ) ? esc_attr( $term_meta['badge'] ) : ''; ?>">

            <?php if (!empty($term_meta['pin'])) : ?>

                <button class="ht-badge-add">Change Badge</button>

            <?php else : ?>

                <button class="ht-badge-add">Add Badge</button>

            <?php endif; ?>

        </td>
    </tr>
<?php
}

add_action( 'sites_category_add_form_fields', 'ht_add_site_category_generate_pin_markup', 10, 2 );

function ht_add_site_category_generate_pin_markup() {

    if (!function_exists('gd_info')) {

        echo '<div class="alert alert-warning">
                <i class="fa fa-attention pull-left"></i>
                <div class="text">You cannot create pins because the GD library is not installed. Please contact your host provider and ask to help install it.</div>
            </div>';

    }

    ?>

<!--    <div class="form-field">-->
<!--        <label for="site_cat_meta[color]">--><?php //_e( 'Category badge', 'pippin' ); ?><!--</label>-->
<!---->
<!--        <div class="site-category-badge-generator">-->
<!--            <div class="site-category-badge-color">-->
<!--                <input type="text" class="badge-color" />-->
<!--            </div>-->
<!---->
<!--            <div class="upload-container">-->
<!--                <div class="upload-wrapper">-->
<!--                    <div class="badge-preview"></div>-->
<!--                    <button class="ht-badge-icon-upload" data-frame="select" data-state="holo-single-image" data-button="insert image">Choose Icon</button>-->
<!--                </div>-->
<!---->
<!--                <input type="hidden" class="badge-image" value="" />-->
<!--            </div>-->
<!---->
<!--            <button class="action generate-badge">Generate Badge</button>-->
<!--        </div>-->
<!---->
<!--        <div class="badge-result-container"></div>-->
<!---->
<!--        <input type="hidden" name="site_cat_meta[pin]" id="site_cat_meta[pin]" class="site-category-pin-input" value="">-->
<!--        <input type="hidden" name="site_cat_meta[badge]" id="site_cat_meta[badge]" class="site-category-badge-input" value="">-->
<!---->
<!--        <button class="ht-badge-add">Add Badge</button>-->
<!--    </div>-->
<?php

}

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {

    if ( isset( $_POST['site_cat_meta'] ) ) {

        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $cat_keys = array_keys( $_POST['site_cat_meta'] );
        foreach ( $cat_keys as $key ) {
            if ( isset ( $_POST['site_cat_meta'][$key] ) ) {
                $term_meta[$key] = $_POST['site_cat_meta'][$key];
            }
        }
        // Save the option array.
        update_option( "taxonomy_$t_id", $term_meta );
    }
}
add_action( 'edited_sites_category', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_sites_category', 'save_taxonomy_custom_meta', 10, 2 );