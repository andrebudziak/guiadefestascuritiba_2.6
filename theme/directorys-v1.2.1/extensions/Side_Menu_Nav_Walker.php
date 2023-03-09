<?php
class Side_Menu_Nav_Walker extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {

        if ($depth == 0) {
            $output .= '<ul class="submenu">';
        } else {
            $output .= '';
        }

    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {

        if ($depth == 0) {
            $output .= '</ul>';
        } else {
            $output .= '';
        }
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        if ($args->has_children && $depth == 0) {

            $output .= '<li class="parent element">' . esc_attr($item->label);

        } else {

            $output .= '<li class="element">' . esc_attr($item->label);

        }

        $att = $item->title;

        $active_class = in_array("current_page_item",$item->classes) ? ' active' : '';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . $active_class . ' ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

        $item_output = '<a' . $attributes . '>' . apply_filters( 'the_title', $att, $item->ID ) . '</a>';

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {

        $output .= "</li>\n";

    }

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
    {
        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

}