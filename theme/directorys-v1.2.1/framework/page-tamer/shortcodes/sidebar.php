<?php

class holo_sidebar extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Sidebar';
        $this->admin_icon = 'entypo-doc-text';

        $this->attributes = array(
            'sidebar' => array(
                'label' => 'Sidebar',
                'type' => 'select',
                'options' => holo_get_reg_sidebars()
            )
        );

        $this->use_styles(array(
            'margin_top',
            'margin_bottom',
        ));

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $inline_styles = $this->get_inline_styles();

        ob_start();

        dynamic_sidebar($sidebar);

        $output = ob_get_clean();


        return '<div class="custom-sidebar"' . $inline_styles . '>' . $output . '</div>';

    }

}