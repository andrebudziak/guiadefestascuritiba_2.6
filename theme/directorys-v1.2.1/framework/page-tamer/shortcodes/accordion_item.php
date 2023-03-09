<?php

class holo_accordion_item extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Accordion Item';
        $this->child = true;
        $this->form_title = 'Accordion item';

        $this->attributes = array(
            'title' => array(
                'type' => 'text',
                'label' => 'Accordion Item Title',
                'id' => 'accordion_item_title'
            ),
            'category' => array(
                'type' => 'text',
                'label' => 'Category'
            ),
            'opened' => array(
                'type' => 'checkbox',
                'label' => 'Opened Tab'
            )
        );

        $this->content = array(
            'type' => 'editor',
            'label' => 'Accordion Item Content',
        );

    }

    public function shortcode_function($atts, $content)
    {
        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $content = do_shortcode($content);

        $content = ht_remove_unpaired_p($content);

        $GLOBALS['accordion_items'][] = array('title' => $title, 'opened' => $opened, 'category' => $category, 'content' => $content);
    }
}
