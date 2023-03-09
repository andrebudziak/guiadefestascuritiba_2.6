<?php

function holo_page_title() {

    global $page_id;

    if ( is_category() ) {
        echo single_cat_title('', FALSE);
    }
    elseif ( is_tag() ) {
        echo thematic_tag_query();
    }
    elseif ( is_author() ) {
        echo get_the_author();
    }
    elseif ( is_404() ) {
        echo __('404 Error - This page could not be found', THEME_TEXT_DOMAIN);
    }
    elseif ( is_search() ) {
        echo __('Search for', THEME_TEXT_DOMAIN) . ' "' . get_search_query() . '"';
    }
    elseif ( is_year() ) {
        echo get_the_time('Y');
    }
    elseif ( is_month() ) {
        echo get_the_time('F') . ' ' . get_the_time('Y');
    }
    elseif ( is_day() ) {
        echo get_the_time('F') . ' ' . get_the_time('Y') . ' ' . get_the_time('d');
    }
//    elseif ( is_woocommerce() ) {
//        if(is_shop()) {
//            echo get_the_title(woocommerce_get_page_id('shop'));
//        }
//        elseif(is_product()) {
//
//        }
//
//        echo 'Shop';
//    }
    else {
        echo get_the_title($page_id);
    }

    if ( get_query_var('paged') ) {
        echo ' | ';
        echo 'Page ' . get_query_var('paged');
    }

}

function holo_get_reg_sidebars() {

	$sidebars = '';

//	$custom_sidebars = get_option('holo_sidebars');
	$wp_registered_sidebars = $GLOBALS['wp_registered_sidebars'];

//    if ( is_array($custom_sidebars) ) {
//        foreach ( $custom_sidebars as $sidebar ) {
//            $sidebars[$sidebar] = $sidebar;
//        }
//    }

	foreach ( $wp_registered_sidebars as $sidebar ) {
		$sidebars[$sidebar['id']] = $sidebar['name'];
	}

	return $sidebars;

}

function holo_get_unique_id() {

    $unique_class = 'ht-unique-';

    $depth = 8;

    $characters = '1234567890abcdefghijklmnopqrstuvwyz';

    for ($i = 0; $i <= 8; $i++) {

        $uniqueId = rand(0, 35);

        $unique_class .= substr($characters, $uniqueId, 1);

    }

    return $unique_class;

}

function holo_show_carousel_by_images($images) {

    $unique_class = holo_get_unique_id();

    $output =
        '<div id="' . $unique_class . '" data-ride="carousel" class="mgp-gal carousel slide carousel-fade">
            <div class="carousel-inner">';

    $index = 0;
    foreach ($images as $image) {

        $active_class = ($index === 0 ? 'active' : '');

        $output .=
            '<div class="item ' . $active_class . '">
                <div class="image">
                    <a class="overlay" href="' . $image['full_url'] . '">
                        <i class="fa-search md"></i>
                    </a>
                    <img alt="' . $image['alt'] . '" title="' . $image['title'] . '" class="img-responsive" src="' . $image['url'] . '">
                </div>
            </div>';

        $index++;
    }

    $output .=
        '</div>
        <div class="controls">
            <a data-slide="prev" href="#' . $unique_class . '" class="left fa fa-left-open"> </a>
            <a data-slide="next" href="#' . $unique_class . '" class="right fa fa-right-open"> </a>
        </div>
    </div>';

    return $output;

}

function holo_get_media_by_post_format($post_id, $images_format = 'full') {

    $post_format = get_post_format($post_id);

    $args = array(
        'type' => 'image',
        'size' => 'post_image'
    );

    $gallery = rwmb_meta('holo_post_gallery', $args);
    $video = get_post_meta($post_id, 'holo_video', true);

    $gallery_images = array();
    $index = 0;
    foreach ($gallery as $image) {

        $gallery_images[$index]['url'] = $image['url'];
        $gallery_images[$index]['full_url'] = $image['full_url'];
        $gallery_images[$index]['title'] = $image['title'];
        $gallery_images[$index]['alt'] = $image['alt'];

        $index++;
    }

    $attachment_image = wp_get_attachment_image(get_post_thumbnail_id($post_id), $images_format);
    $attachment_image_url = wp_get_attachment_url(get_post_thumbnail_id($post_id), $images_format);
    $attachment_image_url_full = wp_get_attachment_url(get_post_thumbnail_id($post_id), 'full');

    $post_media = '';

    if ($post_format === 'video') {

        if ($video) {

            $post_media .= '<div class="post-media"><div style="clear: both"></div>' . $video . '</div>';

        }

    }
    elseif ($post_format === 'gallery') {

        if ($gallery_images) {

            $post_media .= '<div class="post-media">' . holo_show_carousel_by_images($gallery_images) . '</div>';

        }

    }
    else {

        if ($attachment_image) {

            $post_media .=
                '<div class="post-media"><div class="image">
                    <a class="overlay mgp-img" href="' . $attachment_image_url_full . '">
                        <i class="fa-search md"></i>
                    </a>
                    ' . $attachment_image . '
                </div></div>';

        }

    }

    return $post_media;

}

function holo_get_theme_color() {

    global $directorys_options;

    return $directorys_options['color_theme'];

}

function holo_get_ratings($site_id) {

    global $wpdb;

    $show_ratings = get_post_meta($site_id, 'holo_site_show_ratings', true);

    $rating_terms_table = $wpdb->prefix . 'rating_terms';
    $ratings_table = $wpdb->prefix . 'ratings';

    if ($show_ratings) {

        $rating_terms = $wpdb->get_results( "SELECT * FROM $rating_terms_table", ARRAY_A );

        $rating_values = $wpdb->get_results( "SELECT * FROM $ratings_table WHERE post_id=$site_id", ARRAY_A );

        $ordered_ratings = array();

        $rating_total = 0;

        $index = 0;

        foreach($rating_values as $rating_set) {

            $rating_total += $rating_set['rating_value'];

            $index++;

        }

        if ($rating_total === 0) {

            return '<div class="star">' . __('No Rating Yet', THEME_TEXT_DOMAIN) . '</div>';

        } else {

            $rating_total = $rating_total / $index;

            return '
            <div class="star">
                <div class="star-rating">
                    <div class="star-rating-filled-section"></div>
                    <div class="star-rating-select-section"></div>
                    <div class="star-rating-hover-section"></div>
                    <input type="hidden" value="' . $rating_total . '" class="star-rating-value" />
                </div>
            </div>';
        }

    } else {

        return '<div class="ratings-off"></div>';

    }

}

/**
 * Inserts a new key/value before the key in the array.
 *
 * @param $key  The key to insert before.
 * @param $array  An array to insert in to.
 * @param $new_key  The key/array to insert.
 * @param $new_value  An value to insert.
 * @return array
 */
//function array_insert_before($key, array $array, $new_key, $new_value = null) {
//    if (array_key_exists($key, $array)) {
//        $new = array();
//        foreach($array as $k => $value) {
//            if ($k === $key) {
//                if (is_array($new_key) && count($new_key) > 0) {
//                    $new = array_merge($new, $new_key);
//                } else {
//                    $new[$new_key] = $new_value;
//                }
//            }
//            $new[$k] = $value;
//        }
//        return $new;
//    }
//    return false;
//}

/**
 * Inserts a new key/value after the key in the array.
 *
 * @param $key  The key to insert after.
 * @param $array  An array to insert in to.
 * @param $new_key  The key/array to insert.
 * @param $new_value  An value to insert.
 *
 * @return array
 */

if (!function_exists('array_insert_after')) {

    function array_insert_after($key, array  $array, $new_key, $new_value = null)
    {

        if (array_key_exists($key, $array)) {
            $new = array();

            foreach ($array as $k => $value) {
                $new[$k] = $value;
                if ($k === $key) {
                    if (is_array($new_key) && count($new_key) > 0) {
                        $new = array_merge($new, $new_key);
                    } else {
                        $new[$new_key] = $new_value;
                    }
                }
            }

            return $new;
        }
        return false;
    }

}

function ht_change_permalink_to($name = '') {

    update_option('permalink_structure', $name);

}

function ht_remove_unpaired_p($string) {

    $cleaned_string = '';

    $pattern = "/^<\/p[^>]*>|<p[^>]*>(?!.+)/";

    $cleaned_string = preg_replace($pattern, '', $string);

//    $cleaned_string = trim($cleaned_string);

    return $cleaned_string;

}

function closetags($html) {
    preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openedtags = $result[1];
    preg_match_all('#</([a-z]+)>#iU', $html, $result);
    $closedtags = $result[1];
    $len_opened = count($openedtags);
    if (count($closedtags) == $len_opened) {
        return $html;
    }
    $openedtags = array_reverse($openedtags);
    for ($i=0; $i < $len_opened; $i++) {
        if (!in_array($openedtags[$i], $closedtags)) {
            $html .= '</'.$openedtags[$i].'>';
        } else {
            unset($closedtags[array_search($openedtags[$i], $closedtags)]);
        }
    }
    return $html;
}
