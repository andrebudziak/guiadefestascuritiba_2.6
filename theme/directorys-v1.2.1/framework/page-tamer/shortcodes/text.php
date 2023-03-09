<?php

class holo_text extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Text';
        $this->admin_icon = 'entypo-pencil';

        $this->content = array(
            'label' => 'Content',
            'type' => 'editor'
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

        $content = ht_remove_unpaired_p($content);

        $return_content = do_shortcode($content);

        return '<div class="text"' . $inline_styles . '>' . $return_content . '</div>';

    }

}