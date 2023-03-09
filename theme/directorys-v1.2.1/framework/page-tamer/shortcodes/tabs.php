<?php

class holo_tabs extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Tabs';
        $this->children_class = 'holo_tab';
        $this->admin_icon = 'entypo-window';

        $this->attributes = array(
            'tabs_position' => array(
                'label' => 'Tabs Position',
                'type' => 'select',
                'options' => array('top' => 'Top', 'right' => 'Right', 'left' => 'Left', 'bottom' => 'Bottom'),
                'default' => 'top'
            ),
//            'color_style' => array(
//                'label' => 'Color Style',
//                'type' => 'color_palette',
//                'options' => $this->get_color_palettes(),
//                'default' => '',
//                'description' => '',
//                'group' => array(
//                    'p_heading_color' => array(
//                        'type' => 'none',
//                    ),
//                    'p_text_color' => array(
//                        'type' => 'none',
//                    ),
//                    'p_highlight_color' => array(
//                        'type' => 'none',
//                    ),
//                    'p_background_color' => array(
//                        'type' => 'none',
//                    ),
//                    'p_border_color' => array(
//                        'type' => 'none',
//                    ),
//                )
//            ),
        );

        $this->use_styles(array(
            'margin_top',
            'margin_right',
            'margin_bottom',
            'margin_left',
        ));

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $return_markup = '';
        $tabs_index = '';
        $tabs_content = '';
        $GLOBALS['tabs'] = array();
        $unique_id = $this->unique_id;

        do_shortcode($content);

        $inline_style = $this->get_styles_markup();

        $index = 1;
        foreach ( $GLOBALS['tabs'] as $tab ) {

            $tabs_index .= '<li><a href="#' . $unique_id . '-' . $index . '"><h6>' . $tab['title'] . '</h6></a></li>';

            $tabs_content .= '
                <div id="' . $unique_id . '-' . $index . '">
                    ' . $tab['content'] . '
                </div>
            ';

            $index++;

        }

        $return_markup = $inline_style;

        switch ( $tabs_position ) {

            case 'top' :

                $return_markup .= '
                    <div class="tab def " id="' . $unique_id . '">
                ';

                break;
            case 'right' :

                $return_markup .= '
                    <div class="tab right" id="' . $unique_id . '">
                ';

                break;
            case 'left' :

                $return_markup .= '
                    <div class="tab left" id="' . $unique_id . '">
                ';

                break;
            case 'bottom' :

                $return_markup .= '
                    <div class="tab tabs-bottom" id="' . $unique_id . '">
                ';

                break;

        }

        if ( $tabs_position == 'bottom') {

            $return_markup .= '
                ' . $tabs_content . '

                <ul>
                    ' . $tabs_index . '
                </ul>
            ';

        } else {
            $return_markup .= '
                <ul>
                    ' . $tabs_index . '
                </ul>

                ' . $tabs_content . '
            ';
        }

        $return_markup .= '</div>';

        return $return_markup;

    }

}
