<?php

class Holo_Widget_Custom_Menu extends WP_Nav_Menu_Widget {

    function widget($args, $instance) {
        // Get menu
        $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

        if ( !$nav_menu )
            return;

        $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $args['before_widget'];

        if ( !empty($instance['title']) )
            echo $args['before_title'] . $instance['title'] . $args['after_title'];

//        wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu ) );

        echo '<div class="side-menu clearfix">';

        wp_nav_menu(array(
            'container' => false,
            'menu_class' => 'side-menu nav',
            'fallback_cb' => '',
            'walker' => new Side_Menu_Nav_Walker(),
            'depth' => 0,
            'echo' => true,
            'menu' => $nav_menu
        ));

        echo $args['after_widget'];

        echo '</div>';
    }

}