<?php

class holo_pricing_table_row extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Pricing Table Row';
        $this->child = true;

        $this->attributes = array();

        $this->content = array(
            'label' => 'Table Row Content',
            'type' => 'text'
        );

    }

    public function shortcode_function($atts, $content)
    {

        $GLOBALS['pricing_table_rows'][] = array('content' => $content);

    }

}
