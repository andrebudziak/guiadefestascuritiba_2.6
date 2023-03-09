<?php

class holo_parteners extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Parteners';
        $this->children_class = 'holo_partener';
        $this->admin_icon = 'entypo-heart';

        $this->attributes = array(
            'items_show' => array(
                'label' => 'Items to show',
                'type' => 'text',
                'default' => '6'
            ),
            'items_scroll' => array(
                'label' => 'Items to show',
                'type' => 'text',
                'default' => '6'
            )
        );

        $this->use_styles(array(
            'margin_top',
            'margin_right',
            'margin_bottom',
            'margin_left',
        ));

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $inline_styles = $this->get_styles_markup();

        $partners = '';
        $GLOBALS['parteners'] = array();

        do_shortcode($content);

        foreach ( $GLOBALS['parteners'] as $partner ) {

            if (!empty($partner['link'])) {
                $partners .= '
                    <li><a href="' . $partner['link'] . '" target="_blank"><img src="' . $partner['image'] . '" data-original-title="' . $partner['text'] . '" alt="partner logo" /></a></li>
                ';
            } else {
                $partners .= '
                    <li><img src="' . $partner['image'] . '" data-original-title="' . $partner['text'] . '" alt="partner logo" /></li>
                ';
            }

        }

        $return_markup = $inline_styles . '
            <div id="' . $this->unique_id . '">
                <ul class="partener clearfix" data-items="' . $items_show . '" data-scroll="' . $items_scroll . '">
                    ' . $partners . '
                </ul>
            </div>
        ';

        return $return_markup;

    }

}