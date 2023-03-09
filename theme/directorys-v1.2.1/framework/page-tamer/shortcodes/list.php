<?php

class holo_list extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'List';
        $this->children_class = 'holo_list_item';
        $this->admin_icon = 'entypo-list';

        $this->attributes = array(
            'type' => array(
                'label' => 'List Type',
                'type' => 'select',
                'options' => array('icon' => 'Icon List', 'order' => 'Order List'),
                'default' => 'icon'
            ),
            'icon_size' => array(
                'label' => 'Icon Size',
                'type' => 'slider',
            ),
            'icon_color' => array(
                'label' => 'Icon Color',
                'type' => 'color',
                'default' => ''
            ),
            'badge_color' => array(
                'label' => 'Icon Badge Color',
                'type' => 'color',
                'default' => ''
            )
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

        $GLOBALS['list_items'] = array();
        $list_items = '';

        $this->add_inline_style(array(
            'line-height' => $icon_size . 'px'
        ));

        $icon_inline_style = $this->create_inline_style(array(
            'color' => $icon_color,
            'background-color' => $badge_color,
            'font-size' => $icon_size * 0.5 . 'px',
            'width' => $icon_size . 'px',
            'height' => $icon_size . 'px',
            'line-height' => $icon_size . 'px'
        ));

        $color = ( $icon_color !== '' ? 'color: ' . $icon_color . ';' : '' );
        $badge_color = ( $badge_color !== '' ? 'background-color: ' . $badge_color . ';' : '' );
        $icon_size = ( $icon_size !== '' ? 'font-size: ' . $icon_size . 'px;' : '' );

        $font_size = $icon_size * 0.5;

        do_shortcode($content);

        $index = 1;
        foreach ( $GLOBALS['list_items'] as $list_item) {

            if ( $type == 'icon' ) {
                $list_items .= '
                    <div class="element">
                        <i class="alt-text-color pull-left ' . $list_item['icon'] . '" ' . $icon_inline_style . '></i>
                        <p>' . $list_item['content'] . '</p>
                    </div>
                ';
            } else {

                $dot = ( $badge_color === '' ? '.' : '' );

                $list_items .= '
                    <div class="element">
                        <i class="alt-text-color pull-left" ' . $icon_inline_style . '>' . $index . $dot . '</i>
                        <p>' . $list_item['content'] . '</p>
                    </div>
                ';
            }

            $index++;

        }

        $return_markup = '
            <div class="icon-list-1"' . $this->get_inline_styles() . '>
                ' . $list_items . '
            </div>
        ';

        return $return_markup;

    }

}
