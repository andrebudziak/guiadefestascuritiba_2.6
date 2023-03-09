<?php

class holo_callout extends Holo_Abstract_Shortcodes {

    public function __construct() {

        $this->name = 'Callout';
        $this->admin_icon = 'entypo-attention';

        $this->attributes = array(
            'style' => array(
                'label' => 'Style',
                'type' => 'select',
                'default' => 'style_1',
                'options' => array('style_1' => 'Style 1', 'style_2' => 'Style 2')
            ),
            'title' => array(
                'label' => 'Title',
                'type' => 'text',
                'default' => 'Here Goes the title',
                'description' => 'The title of the callout'
            ),
            'content' => array(
                'label' => 'Content',
                'type' => 'textarea',
                'default' => 'Here Goes the content',
                'description' => 'The content of the callout'
            ),
            'backgroundimage' => array(
                'label' => 'Background Image',
                'type' => 'upload',
                'description' => 'The background image of the callout',
                'dependencies' => array('style' => 'style_2')
            ),
            'backgroundcolor' => array(
                'label' => 'Background Color',
                'type' => 'color',
                'description' => 'The background color of the callout',
                'dependencies' => array('style' => 'style_2')
            ),
            'backgroundtransparency' => array(
                'label' => 'Background Transparency',
                'type' => 'slider',
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => 0.5,
                'description' => 'The background color transparency of the callout',
                'dependencies' => array('style' => 'style_2')
            ),
            'show_button' => array(
                'label' => 'Show Button',
                'type' => 'checkbox',
                'default' => 0
            ),
            'button_text' => array(
                'label' => 'Button Text',
                'type' => 'text',
                'default' => 'Here Goes the button text',
                'description' => 'The Button Text',
                'dependencies' => array('show_button' => 1)
            ),
            'button_link' => array(
                'label' => 'Button Link',
                'type' => 'text',
                'default' => 'Here Goes the button link',
                'description' => 'The Button Link',
                'dependencies' => array('show_button' => 1)
            ),
            'new_tab' => array(
                'label' => 'Open In New Window?',
                'type' => 'checkbox',
                'default' => 0,
                'dependencies' => array('show_button' => 1)
            ),
            'button_type' => array(
                'label' => 'Button Style',
                'type' => 'select',
                'options' => array('solid' => 'Solid', 'empty' => 'Empty'),
                'default' => 'solid',
                'dependencies' => array('show_button' => 1)
            ),
            'button_size' => array(
                'label' => 'Button Size',
                'type' => 'select',
                'options' => array('small' => 'Small', 'medium' => 'Medium', 'large' => 'Large'),
                'default' => 'medium',
                'dependencies' => array('show_button' => 1)
            ),
            'button_icon' => array(
                'label' => 'Button Icon',
                'type' => 'icon',
                'default' => '',
                'dependencies' => array('show_button' => 1)
            ),
        );

        $this->use_styles(array(
//            'background_image',
//            'background_repeat',
//            'background_transparency',
            'margin_top',
            'margin_right',
            'margin_bottom',
            'margin_left',
            'padding_top',
            'padding_right',
            'padding_bottom',
            'padding_left',
        ));

        parent::__construct();

    }

    public function shortcode_function($atts, $content)
    {
        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $button_markup = '';
        $return_markup = '';
        $position_class = '';

//        switch ( $content_position ) {
//            case 'center' :
//                $position_class = 'content-center';
//                break;
//
//            case 'right' :
//                $position_class = 'content-right';
//
//                break;
//            case 'left' :
//                $position_class = 'content-left';
//
//                break;
//
//        }

        if ( 1 === (int)$show_button ) {

            switch ($button_size) {
                case 'small' :
                    $size = 'sm';
                    break;
                case 'medium' :
                    $size = 'md';
                    break;
                case 'large' :
                    $size = 'lg';
                    break;
                default :
                    $size = '';
                    break;
            }

            $color = $p_background_color;

            if ( $button_type == 'solid' ) {

                $icon = $button_icon !== '' ? '<i class="' . $button_icon . '"></i> ' : '';

                $button_markup = '
                <a class="button solid ' . $size . '" href="' . $button_link . '" ' . '' . $target . '>
                    ' . $icon . '' . $button_text . '
                </a>
            ';

            } else {

                $button_markup = '<a class="button striped ' . $size . '" href="' . $button_link . '"' . '' . $target . '>' . $content . '</a>';

            }
        }

        $title = ('' !== $title ? '<h2>' . $title . '</h2>' : '');
        $content = ('' !== $content ? '<p>' . $content . '</p>' : '');

        if ($style == 'style_1') {

            $return_markup .= '<div class="callouts">';

            $return_markup .= '<div class="callount-content-wrapper ' . $position_class . '">';

            $return_markup .= $title . '<div class="separator-down"></div>' . $content . $button_markup;

            $return_markup .= '</div></div>';

        } elseif ($style == 'style_2') {

            $args = array(
                'background_image' => $backgroundimage,
                'background_color' => get_transparent_color($backgroundcolor, $backgroundtransparency),
            );

            $background = $this->get_background($args);

            $return_markup .= '<div class="callouts callouts-1">';

            $return_markup .= $background;

            $return_markup .= $title . $content . $button_markup;

            $return_markup .= '</div>';

        }

        return $return_markup;
    }
}
