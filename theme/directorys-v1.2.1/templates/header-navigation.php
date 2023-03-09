<?php

$navigation_class = '';

if ( isset($directorys_options['header_nav_style']) ) {

    $navigation_class = ' ' . $directorys_options['header_nav_style'];

}

function holo_header_nav_fallback() {
    wp_page_menu( 'menu_class=wp-default-menu' );
}

wp_nav_menu(array(
    'theme_location' => 'header_navigation',
    'container' => false,
    'menu_class' => 'nav navbar-nav mobile-hidden expandable' . $navigation_class,
    'fallback_cb' => 'holo_header_nav_fallback',
    'walker' => new Header_Nav_Walker(),
    'depth' => 0,
    'echo' => true,
    'items_wrap' => ' <ul id="%1$s" class="%2$s"><li class="main alt-bg-color mobile-menu-toggle">
                                <button type="button" class="fa fa-cancel"></button>
                            </li>%3$s</ul>'
));