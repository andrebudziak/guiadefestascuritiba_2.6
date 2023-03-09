<?php
class Header_Nav_Walker extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( $depth === 0 ) {
            $output .= '<ul class="clearfix" role="menu">';
        }
        elseif ( $depth === 1 ) {
            $output .= '<ul>';
        }
	    elseif ( $depth === 2 )  {
		    $output .= '<ul>';
	    }
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '</ul>';
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
//        global $NHP_Options;
//        $options = $NHP_Options->options;

//        $main_menu_style = get_option('main_menu_style');

	    $mega_menu_markup = '';

        if ( $depth === 0 ) {

	        if ( $item->enable_mega_menu ) {
		        $output .= '<li class="uber-dropdown">' . esc_attr($item->label);

		        $mega_menu_markup = '<div class="uber-menu panel-collapse">
                        <div class="container">
                            <div class="main-wrap"><div class="items-wrap">';
	        }
	        else {
		        $output .= '<li class="default-dropdown">' . esc_attr($item->label);
	        }

            $att = $item->title;
        } elseif ( $depth == 1 ) {
            $output .= '<li>' . esc_attr($item->label);

            $att = $item->title;
        }
        elseif ( $depth == 2 ) {
            $output .= '<li>' . esc_attr($item->label);

            $att = $item->title;
        }

        $active_class = in_array("current_page_item",$item->classes) ? ' active' : '';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . $active_class . ' ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
	    $attributes .= $args->has_children ? ' data-parent="true"' : '';

	    if ( $depth === 1 && $item->enable_mega_menu ) {

		    if ( !empty($item->mega_menu_column_name) ) {
			    $item_output = '<h4>' . apply_filters( 'the_title', $item->mega_menu_column_name, $item->ID ) . '</h4>';
		    }

	    } elseif ( $depth == 0) {

            if ($args->has_children) {

                $item_output = '<a' . $attributes . '>' . apply_filters( 'the_title', $att, $item->ID ) . '<span class="main-text-color exp"></span></a>';

            } else {

                $item_output = '<a' . $attributes . '>' . apply_filters( 'the_title', $att, $item->ID ) . '</a>';

            }

        } else {

		    $item_output = '<a' . $attributes . '>' . apply_filters( 'the_title', $att, $item->ID ) . '</a>';

	    }

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	    $output .= $mega_menu_markup;
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {

	    if ( $depth === 0 && $item->enable_mega_menu ) {
		    $output .= "</div></div></div></div></li>\n";
	    }
	    else {
		    $output .= "</li>\n";
	    }
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