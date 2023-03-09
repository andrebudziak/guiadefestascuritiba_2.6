<?php

class holo_progress_bar extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Progress Bar';
        $this->child = true;

        $this->attributes = array(
            'style' => array(
                'label' => 'Style',
                'type' => 'select',
                'options' => array('solid' => 'Solid', 'striped' => 'Striped'),
                'default' => ''
            ),
            'text' => array(
                'label' => 'Text',
                'type' => 'text',
                'default' => ''
            ),
            'fill' => array(
                'label' => 'Fill Percent',
                'type' => 'text',
                'default' => ''
            )
        );

    }

    public function shortcode_function($atts, $content)
    {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $GLOBALS['progress_bars'][] = array('style' => $style, 'text' => $text, 'fill' => $fill);

    }
}