<?php

class holo_counters extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Counters';
        $this->children_class = 'holo_counter';
        $this->admin_icon = 'entypo-gauge';

        $this->use_styles(array(
//            'background_transparency',
            'margin_top',
            'margin_bottom',
            'margin_right',
            'margin_left',
        ));

    }

    public function shortcode_function($atts, $content)
    {
        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $return_markup = '';
        $GLOBALS['counters'] = array();

        $inline_styles = $this->get_styles_markup();

        do_shortcode($content);

        $counters = '';

        $counters_count = count($GLOBALS['counters']);

        foreach( $GLOBALS['counters'] as $counter ) {

            $style_class = ('solid' == $counter['style'] ? ' main' : ' alt');

            $counters .= '
                <div class="col-sm-' . (12 / $counters_count) . '">
                    <div class="box counter ' . $style_class . '">
                        <div data-refresh-interval="50" data-speed="3500" data-to="' . $counter['value'] . '" data-from="0" class="count">' . $counter['value'] . '</div>
                        <div class="unit">' . $counter['text'] . '</div>
                    </div>
                </div>
            ';

        }

        $return_markup = $inline_styles . '<div class="row" id="' . $this->unique_id . '">' . $counters . '</div>';

        return $return_markup;
    }
}
