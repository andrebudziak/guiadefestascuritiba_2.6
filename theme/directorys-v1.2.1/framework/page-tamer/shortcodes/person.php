<?php

class holo_person extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Person';
        $this->child = true;

        $this->attributes = array(
            'image' => array(
                'label' => 'Image',
                'type' => 'upload',
                'default' => ''
            ),
            'name' => array(
                'label' => 'Name',
                'type' => 'text',
                'default' => ''
            ),
            'job' => array(
                'label' => 'Job',
                'type' => 'text',
                'default' => ''
            ),
            'description' => array(
                'label' => 'About',
                'type' => 'textarea',
                'default' => ''
            ),
            'link' => array(
                'label' => 'link',
                'type' => 'text',
                'default' => ''
            ),
            'new_tab' => array(
                'label' => 'Open link in new tab',
                'type' => 'checkbox',
                'default' => 0
            ),
            'social' => array(
                'label' => 'Social Links',
                'type' => 'social'
            )
        );

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $GLOBALS['persons'][] = array(
            'image' => $image,
            'name' => $name,
            'job' => $job,
            'description' => $description,
            'link' => $link,
            'new_tab' => $new_tab,
            'social' => $social,
            'content' => $content
        );

    }

}
