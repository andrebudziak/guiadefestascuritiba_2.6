<?php

/**
 * Class Holo_Abstract_Shortcodes
 *
 * this class contains function required for page builder shortcodes registration
 */
abstract class Holo_Abstract_Shortcodes {

    public $name;
    public $attributes = array();
    public $show_as_model = true;
    public $children_class = null;
    public $content = null;
    public $child = false;
    public $admin_icon = '';

    public $unique_id;
    private $sc_atts;
    public $css_styles;

    public $style_atts = array(
        'background_image' => array(
            'label' => 'Background Image',
            'type' => 'upload',
            'unit' => '',
            'default' => '',
        ),
        'background_repeat' => array(
            'label' => 'Background Repeat',
            'type' => 'select',
            'options' => array('no-repeat' => 'No repeat', 'repeat' => 'Repeat', 'repeat-x' => 'Repeat x', 'repeat-y' => 'Repeat y'),
            'unit' => '',
            'default' => 'no-repeat',
        ),
        'background_transparency' => array(
            'label' => 'Background Transparency',
            'type' => 'slider',
            'min' => 0,
            'max' => 1,
            'step' => 0.1,
            'unit' => '',
            'default' => '',
        ),
        'background_color' => array(
            'label' => 'Background Color',
            'type' => 'color',
            'unit' => '',
            'default' => '',
        ),
        'margin_top' => array(
            'label' => 'Margin Top',
            'type' => 'slider',
            'min' => 1,
            'max' => 200,
            'step' => 1,
            'unit' => 'px',
            'default' => '',
            'css_attr' => 'margin-top'
        ),
        'margin_bottom' => array(
            'label' => 'Margin Bottom',
            'type' => 'slider',
            'min' => 1,
            'max' => 200,
            'step' => 1,
            'unit' => 'px',
            'default' => 20,
            'css_attr' => 'margin-bottom'
        ),
        'margin_left' => array(
            'label' => 'Margin Left',
            'type' => 'slider',
            'min' => 1,
            'max' => 200,
            'step' => 1,
            'unit' => 'px',
            'default' => '',
            'css_attr' => 'margin-left'
        ),
        'margin_right' => array(
            'label' => 'Margin Right',
            'type' => 'slider',
            'min' => 1,
            'max' => 200,
            'step' => 1,
            'unit' => 'px',
            'default' => '',
            'css_attr' => 'margin-right'
        ),
        'padding_top' => array(
            'label' => 'Padding Top',
            'type' => 'slider',
            'min' => 1,
            'max' => 200,
            'step' => 1,
            'unit' => 'px',
            'default' => '',
            'css_attr' => 'padding-top'
        ),
        'padding_right' => array(
            'label' => 'Padding Right',
            'type' => 'slider',
            'min' => 1,
            'max' => 200,
            'step' => 1,
            'unit' => 'px',
            'default' => '',
            'css_attr' => 'padding-right'
        ),
        'padding_bottom' => array(
            'label' => 'Padding Bottom',
            'type' => 'slider',
            'min' => 1,
            'max' => 200,
            'step' => 1,
            'unit' => 'px',
            'default' => '',
            'css_attr' => 'padding-bottom'
        ),
        'padding_left' => array(
            'label' => 'Padding Left',
            'type' => 'slider',
            'min' => 1,
            'max' => 200,
            'step' => 1,
            'unit' => 'px',
            'default' => '',
            'css_attr' => 'padding-left'
        ),
        'border_top' => array(
            'label' => 'Border Top',
            'type' => 'checkbox',
            'default' => 1
        ),
        'border_bottom' => array(
            'label' => 'Border Bottom',
            'type' => 'checkbox',
            'default' => 1
        ),
        'border_left' => array(
            'label' => 'Border Left',
            'type' => 'checkbox',
            'default' => 1
        ),
        'border_right' => array(
            'label' => 'Border Right',
            'type' => 'checkbox',
            'default' => 1
        ),
        'border_width' => array(
            'label' => 'Border Width',
            'type' => 'slider',
            'min' => 1,
            'max' => 20,
            'step' => 1,
            'unit' => 'px',
            'default' => '1',
            'css_attr' => 'border-width'
        ),
        'border_style' => array(
            'label' => 'Border Style',
            'type' => 'select',
            'options' => array('solid' => 'Solid', 'dashed' => 'Dashed', 'dotted' => 'Dotted', 'doubled' => 'Doubled'),
            'unit' => '',
            'default' => '',
            'css_attr' => 'border-style'
        ),
        'border_color' => array(
            'label' => 'Border Color',
            'type' => 'color',
            'default' => '#e5e5e5',
            'unit' => '',
            'css_attr' => 'border-color'
        ),
        'border_radius' => array(
            'label' => 'Border Radius',
            'type' => 'slider',
            'default' => '',
            'min' => 1,
            'max' => 50,
            'step' => 1,
            'unit' => 'px',
            'css_attr' => 'border-radius'
        ),
        'float' => array(
            'label' => 'Float',
            'type' => 'select',
            'options' => array('none' => 'None', 'left' => 'Left', 'right' => 'Right'),
            'default' => 'none',
            'unit' => '',
            'css_attr' => 'float',
        ),
        'heading_color' => array(
            'type' => 'hidden',
            'unit' => ''
        ),
        'text_color' => array(
            'type' => 'hidden',
            'unit' => ''
        ),
    );

    abstract public function shortcode_function($atts, $content);


    public function __construct() {

        $this->css_styles = array();

        $this->register_shortcode();

    }

    public function register_attributes($sc_atts) {

        $this->sc_atts = $sc_atts;
        $this->unique_id = isset($sc_atts['unique_id']) ? $sc_atts['unique_id'] : '';

        foreach ( $this->style_atts as $attr => $attr_settings) {

            if ( isset($attr_settings['css_attr']) ) {

                if ( isset($sc_atts[$attr]) && $sc_atts[$attr] === '0') {
                    $this->css_styles[$attr_settings['css_attr']] = $sc_atts[$attr];
                }
                elseif (!empty($sc_atts[$attr])) {
                    $this->css_styles[$attr_settings['css_attr']] = $sc_atts[$attr] . $attr_settings['unit'];
                }

            }

        }

        if ( !empty($sc_atts['background_color']) ) {

            if ( !empty($sc_atts['background_transparency']) ) {
                $background_color = get_transparent_color($sc_atts['background_color'], $sc_atts['background_transparency']);
            } else {
                $background_color = get_transparent_color($sc_atts['background_color'], 1);
            }

            $this->css_styles['background-color'] = $background_color;

        }

        if ( !empty($sc_atts['background_image']) ) {

            $this->css_styles['background-image'] = $sc_atts['background_image'];

            if ( !empty($sc_atts['background_repeat']) ) {

                $this->css_styles['background-repeat'] = $sc_atts['background_repeat'];

            }

        }

    }

    /**
     * @return array
     */
    public function get_registered_attributes() {

        $attributes = array();

        $registered_atts = $this->get_atts();

        foreach ( $registered_atts as $registered_att => $options ) {

            if ( isset($options['default']) ) {
                $attributes[$registered_att] = $options['default'];
            } else {
                $attributes[$registered_att] = '';
            }

        }

        return shortcode_atts($attributes, $this->sc_atts);

    }

    public function get_inline_styles() {

        $sc_style_attr = ' style="';

        foreach ( $this->css_styles as $attr => $value) {

            $sc_style_attr .= $attr . ': ' . $value . ';';

        }

        $sc_style_attr .= '"';

        $this->css_styles = array();

        return $sc_style_attr;

    }

    public function get_styles_markup($styles = '') {

        $styles_markup = '<style type="text/css">';

        $styles_markup .= '#' .$this->unique_id . '{ ';

        foreach ( $this->css_styles as $attr => $value) {

            $styles_markup .= $attr . ': ' . $value . ';';

        }

        $styles_markup .= ' }';

        $styles_markup .= $styles;

        $styles_markup .= '</style>';

        return $styles_markup;

    }

    public function get_background($args = array()) {

        $default_args = array(
            'background_image' => $this->css_styles['background-image'],
            'background_color' => $this->css_styles['background-color'],
            'background-repeat' => $this->css_styles['background-repeat']
        );

        $options = array_merge($default_args, $args);

        $return_markup = '';

        if ( !empty($options['background_image']) || !empty($options['background_color']) ) {

            $bg_style = 'style="background-image: url(' . $options['background_image'] . '); background-repeat: ' . $options['background_repeat'] . '"';

            $return_markup .= '<div class="holo-background-wrapper" ' . $bg_style . '>';

            if ( !empty($options['background_color']) ){
                $return_markup .= '<div class="holo-background-overlay" style="background-color: ' . $options['background_color'] . '"></div>';
            }

            $return_markup .= '</div>';
        }

        $this->extract_inline_style('background-image');
        $this->extract_inline_style('background-color');
        $this->extract_inline_style('background-repeat');

        return $return_markup;

    }

    public function create_inline_style($styles) {

        $inline_style = ' style="';

        if ( is_array($styles) ) {

            foreach ( $styles as $style_attr => $style_val) {

                $inline_style .= $style_attr . ': ' . $style_val . ';';

            }

        }

        $inline_style .= '"';

        return $inline_style;

    }

    public function extract_inline_style($style_attr) {

        $style_value = isset($this->css_styles[$style_attr]) ? $this->css_styles[$style_attr] : '';

        unset($this->css_styles[$style_attr]);

        return $style_value;

    }

    public function add_inline_style($styles) {

        if ( is_array($styles) ) {

            foreach ( $styles as $style_attr => $style_val) {

                $this->css_styles[$style_attr] = $style_val;

            }

        }

    }

    public function get_css_style($css_style) {

        return $this->css_styles[$css_style];

    }

    public function use_styles($styles) {

        if ( is_array($styles) ) {

            $chosen_styles = array();

            foreach( $styles as $style ) {
                foreach ( $this->style_atts as $attr => $attr_settings ) {

                    if ( $style === $attr ) {

                        $chosen_styles[$attr] = $attr_settings;

                    }

                }
            }

            $this->style_atts = $chosen_styles;

        }

        return;

    }

    public function register_shortcode() {

        add_shortcode(get_called_class(), array($this, 'shortcode_function'));

    }

    public function get_atts() {

        $atts = $this->attributes;

        foreach ( $this->attributes as $attr) {

            if ( isset($attr['group']) && is_array($attr['group']) ) {

                foreach ($attr['group'] as $attr_id => $attr_settings) {

                    $atts[$attr_id] = $attr_settings;

                }

            }

        }

        return array_merge($atts, $this->style_atts);

    }

    public function get_color_palettes() {

        $palettes_options = get_option('holo_color_palettes');

        $palettes = array();

        if ($palettes_options) {
            foreach ( $palettes_options as $palette ) {
                $palettes[] = $palette['name'];
            }
        }

        return $palettes;

    }

}