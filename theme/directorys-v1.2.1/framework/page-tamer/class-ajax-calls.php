<?php

class Ajax_Calls {

    function __construct() {

        add_action('wp_ajax_holo_shortcodes_to_markup', array($this,'holo_shortcodes_to_markup'));
        add_action('wp_ajax_holo_shortcodes_to_elements', array($this,'holo_shortcodes_to_elements'));
        add_action('wp_ajax_holo_get_element_data', array($this,'get_element_data'));
        add_action('wp_ajax_holo_get_columns', array($this, 'get_columns'));
        add_action('wp_ajax_holo_get_columns_structures', array($this, 'get_columns_structures'));
        add_action('wp_ajax_holo_parse_shortcode', array($this, 'parse_shortcode'));

    }

    public function holo_shortcodes_to_elements() {

        $shortcodes_elements = array();

        foreach ( $this->shortcodes as $class=>$shortcode ) {

            $shortcodes_elements[$class] = $shortcode;

        }

        echo json_encode($shortcodes_elements);

        exit();

    }

}
