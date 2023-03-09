<?php

class holo_counter extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Counter';
        $this->child = true;

        $this->attributes = array(
            'style' => array(
                'label' => 'Style',
                'type' => 'select',
                'options' => array('solid' => 'Solid', 'empty' => 'empty'),
                'default' => '',
                'description' => 'The style of the counter'
            ),
            'text' => array(
                'label' => 'Text',
                'type' => 'text',
                'default' => 'Here goes the text'
            ),
            'value' => array(
                'label' => 'Value',
                'type' => 'text',
                'default' => '15000'
            )
        );

    }

    public function shortcode_function($atts, $content)
    {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $GLOBALS['counters'][] = array('style' => $style, 'text' => $text, 'value' => $value);

    }
}