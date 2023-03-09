<?php

class holo_testimonial extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Testimonial';
        $this->form = '#testimonial-form';
        $this->child = true;

        $this->attributes = array(
            'author_name' => array(
                'label' => 'Author Name',
                'type' => 'text',
                'id' => 'author_name',
                'default' => '',
                'placeholder' => 'Author name goes here'
            ),
            'author_job' => array(
                'label' => 'Author Job',
                'type' => 'text',
                'default' => '',
                'placeholder' => 'Author job goes here'
            ),
            'author_image' => array(
                'label' => 'Author Image',
                'type' => 'upload',
                'default' => ''
            )
        );

        $this->content = array(
            'label' => 'Message',
            'type' => 'editor',
            'default' => '',
            'placeholder' => 'Testimonial message goes here'
        );

    }

    public function shortcode_function($atts, $content)
    {
        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $content = ht_remove_unpaired_p($content);

        $GLOBALS['testimonials'][] = array(
            'author_name' => $author_name,
            'author_job' => $author_job,
            'author_image' => $author_image,
            'message' => $content
        );

    }

}
