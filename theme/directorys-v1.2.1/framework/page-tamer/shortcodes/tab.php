<?php

class holo_tab extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Tab';
        $this->child = true;

        $this->attributes = array(
            'title' => array(
                'type' => 'text',
                'label' => 'Tabs Item Title'
            )
        );

        $this->content = array(
            'label' => 'Tab Content',
            'type' => 'editor',
            'default' => ''
        );

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $content = do_shortcode($content);

        $content = ht_remove_unpaired_p($content);

        $GLOBALS['tabs'][] = array('title' => $title, 'content' => $content);

    }

}