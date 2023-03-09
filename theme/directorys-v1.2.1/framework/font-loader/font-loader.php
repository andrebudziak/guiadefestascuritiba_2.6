<?php

add_action( 'wp_ajax_get_fonts_icons', 'holo_get_fonts_icons');
add_action( 'wp_ajax_nopriv_get_fonts_icons', 'holo_get_fonts_icons' );

function holo_get_fonts_icons() {

    $fonts = array('fontawesome', 'fontello', 'linecons');

    $fonts_array = array();

    foreach ($fonts as $font) {

        $font_folder = get_template_directory() . '/includes/vendors';

        $fonts_array[] = json_decode(file_get_contents($font_folder . '/' . $font . '/config.json'));

    }

    $json_string = json_encode($fonts_array);

    echo $json_string;

    die();

}

function holo_add_website_font_icons() {

    $fonts = array('fontawesome', 'fontello', 'linecons');

    $font_folder = get_template_directory_uri() . '/includes/vendors';

    foreach ($fonts as $font) {
        wp_enqueue_style($font, $font_folder . '/' . $font . '/css/' . $font . '.css');
    }

}

function holo_add_admin_font_icons() {

    $fonts = array('fontawesome', 'fontello', 'linecons');

    $font_folder = get_template_directory_uri() . '/includes/vendors';

    foreach ($fonts as $font) {
        wp_enqueue_style($font, $font_folder . '/' . $font . '/css/' . $font . '.css');
    }

}

add_action('wp_enqueue_scripts', 'holo_add_website_font_icons');
add_action('admin_enqueue_scripts', 'holo_add_admin_font_icons');