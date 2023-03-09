<?php

class Excerpt {

    // Default length (by WordPress)
    public static $length = 55;

    // So you can call: my_excerpt('short');
    public static $types = array(
        'short' => 25,
        'regular' => 55,
        'long' => 100
    );

    /**
     * Sets the length for the excerpt,
     * then it adds the WP filter
     * And automatically calls the_excerpt();
     *
     * @param int|string $new_length
     * @return void
     * @author Baylor Rae'
     */
    public static function length($new_length = 55) {
        Excerpt::$length = $new_length;

        add_filter('excerpt_length', 'Excerpt::new_length', 999);

        Excerpt::output();
    }

    // Tells WP the new length
    public static function new_length() {
        if( isset(Excerpt::$types[Excerpt::$length]) )
            return Excerpt::$types[Excerpt::$length];
        else
            return Excerpt::$length;
    }

    // Echoes out the excerpt
    public static function output() {
        return get_the_excerpt();
    }

}

// An alias to the class
function get_custom_excerpt($length = 55) {

    Excerpt::$length = $length;

    add_filter('excerpt_length', 'Excerpt::new_length', 999);

    return get_the_excerpt();
}

function holo_get_image_by_size($img, $width, $height) {

    $img_array = explode('.', $img);

    $img_extension = $img_array[count($img_array) - 1];

    //delete the extension part from the array
    unset($img_array[count($img_array) - 1]);

    $img = implode('.', $img_array);

    $image_name = $img . '-' . $width . 'x' . $height . '.' . $img_extension;

    return $image_name;
}

function holo_get_excerpt_by_id($post_id, $length = 35) {

    $the_excerpt = get_the_excerpt();
    $words = explode(' ', $the_excerpt, $length + 1);

    if(count($words) > $length) :
        array_pop($words);
        array_push($words, '…');
        $the_excerpt = implode(' ', $words);
    endif;

    return $the_excerpt;

}

function holo_get_number_items_show_markup($items_found, $items_per_page, $items_this_page, $page) {

    $page = ($page < 1 ? 1 : $page);

    $items_from = ($page - 1) * $items_per_page + 1;
    $items_to = ($page * $items_per_page) - ($items_per_page - $items_this_page);

    if ($items_found > 0) {

        $return_string = __('Showing', THEME_TEXT_DOMAIN) . ' ' . $items_from . ' - ' . $items_to . ' ' . __('of', THEME_TEXT_DOMAIN) . ' ' . $items_found . ' ' .__('Items', THEME_TEXT_DOMAIN);

    } else {
        $return_string = __('No Items', THEME_TEXT_DOMAIN);
    }

    return $return_string;

}
