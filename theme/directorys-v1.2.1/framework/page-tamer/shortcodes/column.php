<?php

class holo_column extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Column';
        $this->show_as_model = false;

        $this->attributes = array(
            'size' => array(
                'label' => 'Size',
                'type' => 'hidden',
            ),
        );

        $this->content = array(
            'type' => 'hidden',
        );

    }

    public function shortcode_function($atts, $content)
    {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        return '<div class="' . $size . '">' . do_shortcode($content) . '</div>';
    }

}