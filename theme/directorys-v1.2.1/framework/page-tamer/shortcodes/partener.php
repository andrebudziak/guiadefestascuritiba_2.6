<?php

class holo_partener extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Partener';
        $this->child = true;

        $this->attributes = array(
            'image' => array(
                'label' => 'Image',
                'type' => 'upload',
            ),
            'text' => array(
                'label' => 'Caption',
                'type' => 'text',
                'default' => ''
            ),
            'link' => array(
                'label' => 'Partner link',
                'type' => 'text',
                'default' => ''
            )
        );

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $GLOBALS['parteners'][] = array('image' => $image, 'text' => $text, 'link' => $link);

    }

}