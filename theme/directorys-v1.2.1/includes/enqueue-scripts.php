<?php

define('HOLO_INCLUDES_DIR_URI', HOLO_TEMPLATE_DIR_URI . '/includes');

/** add front-end related scripts */
function holo_add_website_scripts() {

//    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery', HOLO_INCLUDES_DIR_URI . '/js/jquery-1.11.1.js');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('jquery-ui-slider');

    wp_enqueue_style('bootstrap', HOLO_INCLUDES_DIR_URI . '/vendors/bootstrap/css/bootstrap.css');
    wp_enqueue_style('bxslider', HOLO_INCLUDES_DIR_URI . '/vendors/bxslider/jquery.bxslider.css');
    wp_enqueue_style('fancybox', HOLO_INCLUDES_DIR_URI . '/vendors/fancybox/source/jquery.fancybox.css');
    wp_enqueue_style('pretty-photo', HOLO_INCLUDES_DIR_URI . '/vendors/pretty-photo/css/prettyPhoto.css');
    wp_enqueue_style('shortcodes-aspect', HOLO_INCLUDES_DIR_URI . '/css/core-css/aspect.css');
    wp_enqueue_style('main-style', HOLO_INCLUDES_DIR_URI . '/css/core-css/style.css');
    wp_enqueue_style('magnific-popup', HOLO_TEMPLATE_DIR_URI . '/includes/vendors/magnific-popup/magnific-popup.css');
    wp_enqueue_style('slick-carousel', HOLO_TEMPLATE_DIR_URI . '/includes/vendors/slick/slick.css');

//    wp_enqueue_style('directorys-color-theme', HOLO_INCLUDES_DIR_URI . '/css/directorys-color-theme.css');
    wp_enqueue_style('directorys-style', HOLO_INCLUDES_DIR_URI . '/css/directorys-style.css');
    wp_enqueue_style('directorys-shortcodes', HOLO_INCLUDES_DIR_URI . '/css/shortcodes.css');

    wp_enqueue_style('wp-add', HOLO_INCLUDES_DIR_URI . '/css/wp-add.css');
    wp_enqueue_style('responsive', HOLO_INCLUDES_DIR_URI . '/css/core-css/responsive.css');
    wp_enqueue_style('directorys-responsive', HOLO_INCLUDES_DIR_URI . '/css/directorys-responsive.css');

    wp_enqueue_style('style', get_stylesheet_uri());

    /* Google Map API */
    wp_enqueue_script('google-map-js', "https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry");

    wp_enqueue_script('google-map-infobox', HOLO_INCLUDES_DIR_URI . '/js/infobox.js', array(), false, true);
    wp_enqueue_script('google-map-markerclusterer', HOLO_INCLUDES_DIR_URI . '/js/markerclusterer.js', array(), false, true);

    wp_enqueue_script('bootstrap', HOLO_INCLUDES_DIR_URI . '/vendors/bootstrap/js/bootstrap.js', array(), false, true);
    wp_enqueue_script('slick-carousel', HOLO_TEMPLATE_DIR_URI . '/includes/vendors/slick/slick.min.js', array(), false, true);
    wp_enqueue_script('caroufredsel', HOLO_INCLUDES_DIR_URI . '/vendors/caroufredsel-6.2.1/jquery.carouFredSel-6.2.1-packed.js', array(), false, true);
    wp_enqueue_script('bxslider', HOLO_INCLUDES_DIR_URI . '/vendors/bxslider/jquery.bxslider.js', array(), false, true);
    wp_enqueue_script('handlebars', HOLO_INCLUDES_DIR_URI . '/vendors/handlebars/handlebars-1.0.rc.1.min.js', array(), false, true);
    wp_enqueue_script('fancybox', HOLO_INCLUDES_DIR_URI . '/vendors/fancybox/source/jquery.fancybox.pack.js', array(), false, true);
    wp_enqueue_script('pretty-photo', HOLO_INCLUDES_DIR_URI . '/vendors/pretty-photo/jquery.prettyPhoto.js', array(), false, true);
    wp_enqueue_script('imagesloaded', HOLO_INCLUDES_DIR_URI . '/vendors/isotope/imagesloaded.pkgd.min.js', array(), false, true);
    wp_enqueue_script('isotope', HOLO_INCLUDES_DIR_URI . '/vendors/isotope/jquery.isotope.min.js', array(), false, true);
    wp_enqueue_script('modernizr', HOLO_INCLUDES_DIR_URI . '/vendors/modernizr/modernizr.custom.98434.js', array(), false, true);
    wp_enqueue_script('mixitup', HOLO_INCLUDES_DIR_URI . '/vendors/mixitup/jquery.mixitup.min.js', array(), false, true);
    wp_enqueue_script('cycle', HOLO_INCLUDES_DIR_URI . '/vendors/cycle/jquery.cycle.all.min.js', array(), false, true);
    wp_enqueue_script('magnific-popup', HOLO_INCLUDES_DIR_URI . '/vendors/magnific-popup/jquery.magnific-popup.min.js', array(), false, true);
    wp_enqueue_script('main-script', HOLO_INCLUDES_DIR_URI . '/js/script.js', array(), false, true);
//    wp_enqueue_script('ajax', HOLO_TEMPLATE_DIR_URI . '/ajax/ajax_functions.js', array(), false, true);
}

/** add admin related scripts */
function holo_add_admin_scripts() {

//    wp_enqueue_script('jquery');

	wp_enqueue_style('minicolors-style', HOLO_INCLUDES_DIR_URI . '/vendors/jquery-minicolors/jquery.minicolors.css');
	wp_enqueue_style('admin-style', HOLO_INCLUDES_DIR_URI . '/admin/style.css');

    wp_enqueue_media();

    wp_enqueue_script('minicolors-script', HOLO_INCLUDES_DIR_URI . '/vendors/jquery-minicolors/jquery.minicolors.min.js', array(), false, true);
    wp_enqueue_script('iconsform', HOLO_INCLUDES_DIR_URI . '/admin/jquery.iconsform.js', array(), false, true);
    wp_enqueue_script('ht-modal', HOLO_INCLUDES_DIR_URI . '/admin/holo-modal.js', array(), false, true);
    wp_enqueue_script('ht-media-upload', HOLO_INCLUDES_DIR_URI . '/admin/media-upload.js', array(), false, true);
    wp_enqueue_script('admin-script', HOLO_INCLUDES_DIR_URI . '/admin/script.js', array(), false, true);
    wp_enqueue_script('admin-importer', HOLO_FRAMEWORK_DIR_URI . '/auto_importer/holo_importer.js', array(), false, true);

}

add_action('wp_enqueue_scripts', 'holo_add_website_scripts');
add_action('admin_enqueue_scripts', 'holo_add_admin_scripts');
//add_action("admin_head","myplugin_load_tiny_mce");
