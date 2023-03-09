<?php

function mytheme_nav_fallback() {

    $args = array(
        'depth'       => 0,
        'sort_column' => 'menu_order, post_title',
        'menu_class'  => 'holo-default-menu',
        'include'     => '',
        'exclude'     => '',
        'echo'        => true,
        'show_home'   => false,
        'link_before' => '',
        'link_after'  => ''
    );

    wp_page_menu( $args );
}