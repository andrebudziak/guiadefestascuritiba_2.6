<?php
/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class rc_scm_walker extends Walker_Nav_Menu
{

    public $is_mega_menu = false;

    function start_lvl( &$output, $depth = 0, $args = array() ) {

        if ( $depth > 0 ) {
            $output .= '<ul class="dropdown dropdown-menu clearfix" role="menu">';
        } else {
            $output .= '<ul class="dropdown dropdown-menu clearfix" role="menu">';
        }

    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '</ul>';
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        if ( $depth === 0 ) {
            if ( $item->enable_mega_menu ) {
                $output .= '<li class="mega-menu">' . esc_attr($item->label);
            } else {
                $output .= '<li class="default-menu">' . esc_attr($item->label);
            }

            $att = $item->title;
        } elseif ( $depth === 1 ) {

            $output .= '<li class="dropdown-submenu sub-menu">' . esc_attr($item->label);

            $att = $item->title;

        } else {

            $output .= '<li class=" ">' . esc_attr($item->label);
            $att = $item->title . '<i class="fa-icon-angle-right"></i>';

        }

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="' . ( $depth === 0 ? 'dropdown-toggle' : '' ) . '"';
        $attributes .= ( $depth === 0 ? ' data-delay="50" data-hover="dropdown"' : '');

        $item_output = $args->before . '<a' . $attributes . '>' . $args->link_before . apply_filters( 'the_title', $att, $item->ID ) .
            $args->link_after . '</a>' . $mega . $args->after;

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }

}