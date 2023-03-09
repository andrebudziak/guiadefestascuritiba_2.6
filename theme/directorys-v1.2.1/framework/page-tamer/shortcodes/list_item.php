<?php

class holo_list_item extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'List Item';
        $this->child = true;

        $this->attributes = array(
            'icon' => array(
                'label' => 'List Item Icon',
                'type' => 'icon',
            )
        );

        $this->content = array(
            'label' => 'List Item Content',
            'type' => 'textarea',
            'default' => 'Your content goes here'
        );

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $GLOBALS['list_items'][] = array(
            'icon' => $icon,
            'content' => $content
        );

    }

}
