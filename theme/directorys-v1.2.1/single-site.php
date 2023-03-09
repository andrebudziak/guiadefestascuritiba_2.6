<?php

global $directorys_options;

$show_sidebar = true;

if ( isset($directorys_options['sites_sidebar_position']) ) {

    $sidebar_position = $directorys_options['sites_sidebar_position'];

    if ( $sidebar_position == 'left' ) {

        $sidebar_pos_class = 'sidebar-left';

    } elseif ( $sidebar_position == 'right' ) {

        $sidebar_pos_class = '';

    } else {

        $sidebar_pos_class = 'no-sidebar';

        $show_sidebar = false;

    }

}

get_header();

?>

<div class="container">
    <div class="row <?php echo $sidebar_pos_class ?>">
        <div class="col-md-9 blog-wrapper">

        <?php

        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();

                $attachment_image = wp_get_attachment_image(get_post_thumbnail_id(), 'post_image');

                $site_categories = wp_get_post_terms($post->ID, 'sites_category');

                if (!empty($site_categories) && !is_object($site_categories)) {

//                    print_r($site_categories);

                    $site_icon = get_option('taxonomy_' . $site_categories[0]->term_id);

                    $site_icon = $site_icon['pin'];

                    $site_category_id = $site_categories[0]->term_id;

                } else {

                    $site_icon = HOLO_INCLUDES_DIR_URI . '/admin/img/pin-default.png';

                    $site_category_id = 0;

                }

                $contact_fields = get_post_meta($post->ID, 'contact', true);
                $custom_fields = get_post_meta($post->ID, 'site_custom_fields', true);

                $site_latitude = get_post_meta($post->ID, 'holo_site_lat_coords', true);
                $site_longitude = get_post_meta($post->ID, 'holo_site_long_coords', true);

                $show_ratings = get_post_meta($post->ID, 'holo_site_show_ratings', true);
                $show_schedule = get_post_meta($post->ID, 'holo_site_schedule', true);

                $monday = get_post_meta($post->ID, 'holo_monday', true);
                $tuesday = get_post_meta($post->ID, 'holo_tuesday', true);
                $wednesday = get_post_meta($post->ID, 'holo_wednesday', true);
                $thursday = get_post_meta($post->ID, 'holo_thursday', true);
                $friday = get_post_meta($post->ID, 'holo_friday', true);
                $saturday = get_post_meta($post->ID, 'holo_saturday', true);
                $sunday = get_post_meta($post->ID, 'holo_sunday', true);
                $event_date = get_post_meta($post->ID, 'holo_event_date', true);
                $event_starting_time = get_post_meta($post->ID, 'holo_event_starting_time', true);
                $event_ending_time = get_post_meta($post->ID, 'holo_event_ending_time', true);

                $custom_info_title = isset($directorys_options['listing_custom_info_title']) ? $directorys_options['listing_custom_info_title'] : '';

                ?>

            <div class="divider divider-1">
                <h1 class="title"><?php the_title() ?></h1><div class="separator"></div>
            </div>

            <div class="list-wrapper">

                <div class="single-listing">
<!--                    <div class="image">-->
<!--                        --><?php //echo $attachment_image ?>
<!--                    </div>-->
                    <?php echo holo_get_media_by_post_format($post->ID, 'post_image') ?>

                    <div class="content">

                        <?php the_content(); ?>

                        <!--<div class="social">
                            <ul>
                                <li>LIKE</li>
                                <li>Tweet</li>
                                <li>Google +</li>
                            </ul>
                        </div>-->

                        <div class="content-bottom">

                            <div class="col-sm-8">

                            <?php if (!empty($custom_fields)) : ?>

                                <div class="custom-fields">
                                    <h4><?php echo $custom_info_title ?></h4>
                                    <table class="list">

                                        <?php

                                        foreach ($custom_fields as $field) {

                                            echo '<tr><td class="custom-field-name">' . $field['icon'] . ':</td><td>&nbsp;&nbsp;' . $field['value'] . '</td></tr>';

                                        }

                                        ?>
                                    </table>
                                </div>

                            <?php endif; ?>

                                <h4><?php _e('Contact', THEME_TEXT_DOMAIN) ?></h4>
                            <?php if ( !empty($contact_fields) ) : ?>

                                <ul class="list">

                                    <?php

                                    foreach ($contact_fields as $contact) {

                                        echo '<li><i class="' . $contact['icon'] . ' main-text-color"></i>' . $contact['value'] . '</li>';

                                    }

                                    ?>
                                </ul>

                            <?php else : ?>

                                <p>No Contact Information</p>

                            <?php endif; ?>

                                <?php if ($show_schedule) : ?>

                                <div class="list-schedule">

                                    <h4><?php _e('Opening hours', THEME_TEXT_DOMAIN) ?></h4>
                                    <ul class="list list-1">
                                        <li><?php _e('Monday', THEME_TEXT_DOMAIN) ?>: <dd><?php echo $monday; ?></dd></li>
                                        <li><?php _e('Tuesday', THEME_TEXT_DOMAIN) ?>: <dd><?php echo $tuesday; ?></dd></li>
                                        <li><?php _e('Wednesday', THEME_TEXT_DOMAIN) ?>:<dd><?php echo $wednesday; ?></dd></li>
                                        <li><?php _e('Thurstday', THEME_TEXT_DOMAIN) ?>:<dd><?php echo $thursday; ?></dd></li>
                                        <li><?php _e('Friday', THEME_TEXT_DOMAIN) ?>:<dd><?php echo $friday; ?></dd></li>
                                        <li><?php _e('Saturday', THEME_TEXT_DOMAIN) ?>:<dd><?php echo $saturday; ?></dd></li>
                                        <li><?php _e('Sunday', THEME_TEXT_DOMAIN) ?>:<dd><?php echo $sunday; ?></dd></li>
                                    </ul>

                                </div>

                                <?php endif;  ?>

                            </div>

                            <?php if (!empty($site_latitude) && !empty($site_longitude)) : ?>

                            <div class="col-sm-4">
                                <div class="map">
                                    <div id="map-canvas"></div>
                                </div>
                            </div>

                            <script type="text/javascript">
                                var map;
                                function initialize() {
                                    var mapOptions = {
                                        zoom: 15,
                                        center: new google.maps.LatLng(<?php echo $site_latitude ?>, <?php echo $site_longitude ?>),
                                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                                        scrollwheel: false,
                                        disableDefaultUI: true,
                                        panControl: false,
                                        zoomControl: true,
                                        mapTypeControl: false,
                                        scaleControl: false,
                                        streetViewControl: true,
                                        overviewMapControl: false
                                    };

                                    map = new google.maps.Map(document.getElementById('map-canvas'),
                                        mapOptions);

                                    function CoordMapType(tileSize) {
                                        this.tileSize = tileSize;
                                    }

                                    CoordMapType.prototype.getTile = function(coord, zoom, ownerDocument) {
                                        var div = ownerDocument.createElement('div');
                                        div.style.width = this.tileSize.width + 'px';
                                        div.style.height = this.tileSize.height + 'px';
                                        div.style.fontSize = '10';
                                        div.style.backgroundColor = '<?php echo $directorys_options['second_color_theme'] ?>';
                                        div.style.opacity = '<?php echo $directorys_options['map_overlay_opacity'] ?>';
                                        return div;
                                    };

                                    map.overlayMapTypes.insertAt(0, new CoordMapType(new google.maps.Size(256, 256)));

                                    var markerShape = {
                                        coords: [1, 1, 1, 1, 1, 1, 1, 1],
                                        type: 'poly'
                                    };

                                    var markerImage = {
                                        url: '<?php echo $site_icon ?>'
                                    };

                                    var marker = new google.maps.Marker({
                                        position: new google.maps.LatLng(<?php echo $site_latitude ?>, <?php echo $site_longitude ?>),
                                        map: map,
                                        icon: markerImage,
                                        shape: markerShape,
                                        title: '<?php the_title() ?>',
                                        zIndex: 1,
                                        fillOpacity: 1,
                                        visible: true
                                    });

                                }

                                google.maps.event.addDomListener(window, 'load', initialize);
                            </script>

                            <?php

                            endif;

                            if ($show_ratings) :

                                global $wpdb, $post;

                                $already_rated = false;

                                $post_id = $post->ID;
                                $user_id = get_current_user_id();

                                $rating_terms_table = $wpdb->prefix . 'rating_terms';
                                $ratings_table = $wpdb->prefix . 'ratings';

                            ?>

                            <div id="rating" class="content-rating">

                                <?php

                                if ( isset($_POST['ratings_submit'])) {
                                    $ratings = $_REQUEST['rating'];
                                    $user_ip = $_SERVER['REMOTE_ADDR'];

                                    $ratings_table_name = $wpdb->prefix . 'ratings';
                                    $reviews_table_name = $wpdb->prefix . 'reviews';
                                    $rating_logs_table_name = $wpdb->prefix . 'rating_logs';

                                    $user_log = $wpdb->get_results( "SELECT * FROM $rating_logs_table_name WHERE post_id=$post_id AND user_ip='$user_ip'", ARRAY_A );

                                    if (empty($user_log)) {

                                        $wpdb->insert(
                                            $rating_logs_table_name,
                                            array(
                                                'post_id' => $post_id,
                                                'user_id' => $user_id,
                                                'log_date' => current_time( 'mysql' ),
                                                'user_ip' => $user_ip,
                                            )
                                        );

                                        if ( !empty($ratings['review']['message']) ) {
                                            $wpdb->insert(
                                                $reviews_table_name,
                                                array(
                                                    'review_post_id' => $post_id,
                                                    'review_date' => current_time( 'mysql' ),
                                                    'review_content' => $ratings['review']['message'],
                                                    'user_name' => $ratings['review']['name'],
                                                )
                                            );

                                            $last_review_id = $wpdb->insert_id;

                                            foreach ($ratings['terms'] as $term_id => $rating_value) {

                                                $wpdb->insert(
                                                    $ratings_table_name,
                                                    array(
                                                        'rating_term' => $term_id,
                                                        'rating_value' => $rating_value['rating'],
                                                        'post_id' => $post_id,
                                                        'review_id' => $last_review_id
                                                    )
                                                );

                                            }

                                        }

                                        ?>

                                        <div class="alert alert-success">
                                            <i class="fa fa-info pull-left"></i>
                                            <div class="text"><?php _e('Thank you for your rating', THEME_TEXT_DOMAIN) ?>!</div>
                                        </div>

                                        <?php

                                    } else {

                                        ?>

                                        <div class="alert alert-danger">
                                            <i class="fa fa-attention-circled pull-left"></i>
                                            <div class="text"><?php _e('You have already rated this site', THEME_TEXT_DOMAIN) ?>!</div>
                                        </div>


                                        <?php

                                    }

                                }

                                $rating_terms = $wpdb->get_results( "SELECT * FROM $rating_terms_table", ARRAY_A );

                                $rating_values = $wpdb->get_results( "SELECT * FROM $ratings_table WHERE post_id=$post_id", ARRAY_A );

                                $ordered_ratings = array();

                                foreach($rating_values as $rating_set) {

                                    $ordered_ratings[$rating_set['rating_term']][] = $rating_set;

                                }

                                ?>

                                <form method="post" action="#rating">

                                    <div class="col-sm-8">
                                        <div class="form form-2">
                                            <div class="inputs">
                                                <input type="text" placeholder="<?php _e('Name', THEME_TEXT_DOMAIN) ?> *" class="form-control" name="rating[review][name]" />

                                                <textarea placeholder="<?php _e('Message', THEME_TEXT_DOMAIN) ?> *" class="form-control" name="rating[review][message]"></textarea>

                                                <input name="ratings_submit" type="submit" class="button solid main-bg-color" value="<?php _e('Submit rating', THEME_TEXT_DOMAIN) ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="list-rating">
                                            <ul>
                                                <?php

                                                foreach ($rating_terms as $term) :

                                                    $rating_value = 0;

                                                    if (is_array($ordered_ratings) && !empty($ordered_ratings)) {

                                                        $index = 0;

                                                        foreach ($ordered_ratings[$term['term_id']] as $rating) {

                                                            $rating_value += $rating['rating_value'];

                                                            $index++;
                                                        }

                                                        $rating_value = $rating_value / $index;

                                                    }
                                                ?>

                                                <li>
                                                    <?php echo $term['term_name'] ?>

                                                    <div id="ht-star-rating" class="star star-rating">
                                                        <div class="star-rating-filled-section"></div>
                                                        <div class="star-rating-select-section"></div>
                                                        <div class="star-rating-hover-section"></div>
                                                        <span class="star-rating-section" data-value="5"></span>
                                                        <span class="star-rating-section" data-value="10"></span>
                                                        <span class="star-rating-section" data-value="15"></span>
                                                        <span class="star-rating-section" data-value="20"></span>
                                                        <span class="star-rating-section" data-value="25"></span>
                                                        <span class="star-rating-section" data-value="30"></span>
                                                        <span class="star-rating-section" data-value="35"></span>
                                                        <span class="star-rating-section" data-value="40"></span>
                                                        <span class="star-rating-section" data-value="45"></span>
                                                        <span class="star-rating-section" data-value="50"></span>
                                                        <input type="hidden" name="rating[terms][<?php echo $term['term_id'] ?>][rating]" value="<?php echo $rating_value ?>" class="star-rating-value" />
                                                    </div>
                                                </li>

                                                <?php

                                                endforeach;

                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="content-prev-comment">

                                <?php


                                $reviews_table_name = $wpdb->prefix . 'reviews';
                                $ratings_table_name = $wpdb->prefix . 'ratings';

                                $post_id = $post->ID;

                                $reviews = $wpdb->get_results( "SELECT * FROM $reviews_table_name WHERE review_post_id=$post_id", ARRAY_A );

                                foreach ($reviews as $review) :

                                    $review_id = $review['review_id'];

                                    $rating_values = $wpdb->get_results( "SELECT * FROM $ratings_table_name WHERE post_id = $post_id && review_id = $review_id", ARRAY_A );

                                    $index = 0;
                                    $total_values = 0;
                                    foreach($rating_values as $rating_set) {

                                        $total_values += $rating_set['rating_value'];

                                        $index++;

                                    }

                                    if ($index) {
                                        $rating_total = $total_values / $index;
                                    }

                                ?>

                                <div class="col-sm-12 prev-comment">
                                    <div class="rating-header">
                                        <span class="numele"><?php echo $review['user_name'] ?></span><span class="separator-right"></span> <?php echo $review['review_date'] ?>

                                        <?php if ($index) : ?>
                                            <div class="star" style="float: right">
                                                <div class="star-rating">
                                                    <div class="star-rating-filled-section"></div>
                                                    <div class="star-rating-select-section"></div>
                                                    <div class="star-rating-hover-section"></div>
                                                    <input type="hidden" value="<?php echo $rating_total; ?>" class="star-rating-value" />
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <p><?php echo $review['review_content'] ?></p>
                                </div>

                                <?php endforeach; ?>

                            </div>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>

            </div>

            <?php

            endwhile;
        endif;

        ?>

            <?php comments_template('/templates/comments.php') ?>

        </div>

        <?php

        if ($show_sidebar) :

            get_template_part('templates/sidebar');

        endif;

        ?>

    </div>
</div>



<?php get_footer(); ?>