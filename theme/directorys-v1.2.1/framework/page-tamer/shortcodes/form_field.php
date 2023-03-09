<?php

class holo_form_field extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Form Field';
        $this->child = true;

        $this->attributes = array(
            'type' => array(
                'label' => 'Field Type',
                'type' => 'select',
                'options' => array('text' => 'Text Field', 'textarea' => 'Textarea', 'checkbox' => 'Checkbox', 'select' => 'Dropdown Select'),
                'default' => 'text'
            ),
            'label' => array(
                'label' => 'Field Label',
                'type' => 'text',
                'default' => 'The label of your field goes here'
            ),
        );

    }

    public function shortcode_function($atts, $content)
    {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $GLOBALS['form_fields'][] = array('label' => $label, 'type' => $type);

    }
}