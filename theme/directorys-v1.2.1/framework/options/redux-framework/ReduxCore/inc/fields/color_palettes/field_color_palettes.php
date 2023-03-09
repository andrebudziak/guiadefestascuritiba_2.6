<?php

// Exit if accessed directly
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    if ( ! class_exists( 'ReduxFramework_color_palettes' ) ) {
        class ReduxFramework_color_palettes {

            /**
             * Field Constructor.
             * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
             *
             * @since ReduxFramework 1.0.0
             */
            function __construct( $field = array(), $value = '', $parent ) {
                $this->parent = $parent;
                $this->field  = $field;
                $this->value  = $value;
            }

            /**
             * Field Render Function.
             * Takes the vars and outputs the HTML for the field in the settings
             *
             * @since ReduxFramework 1.0.0
             */
            function render() {

                Holo::colors_palettes($this->value);

                echo '<input data-id="' . $this->field['id'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '" id="' . $this->field['id'] . '" class="palette-input ' . $this->field['class'] . '"  type="hidden" value="' . $this->value . '" />';

            }

            /**
             * Enqueue Function.
             * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
             *
             * @since ReduxFramework 3.0.0
             */
            function enqueue() {

                wp_enqueue_script(
                    'redux-field-color-palette-js',
                    ReduxFramework::$_url . 'inc/fields/color_palettes/field_color_palettes' . Redux_Functions::isMin() . '.js',
                    array( 'jquery', 'wp-color-picker', 'redux-js' ),
                    time(),
                    true
                );

                wp_enqueue_style('minicolors-style', HOLO_INCLUDES_DIR_URI . '/vendors/jquery-minicolors/jquery.minicolors.css');

                wp_enqueue_script('minicolors-script', HOLO_INCLUDES_DIR_URI . '/vendors/jquery-minicolors/jquery.minicolors.min.js', array(), false, true);
            }

        }
    }