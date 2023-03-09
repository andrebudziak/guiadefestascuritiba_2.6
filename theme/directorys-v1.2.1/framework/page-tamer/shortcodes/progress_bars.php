<?php

class holo_progress_bars extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Progress Bars';
        $this->children_class = 'holo_progress_bar';
        $this->admin_icon = 'entypo-chart-bar';

        $this->attributes = array(
//            'color_style' => array(
//                'label' => 'Color Style',
//                'type' => 'color_palette',
//                'options' => $this->get_color_palettes(),
//                'default' => '',
//                'description' => '',
//                'group' => array(
//                    'p_heading_color' => array(
//                        'type' => 'none',
//                    ),
//                    'p_text_color' => array(
//                        'type' => 'none',
//                    ),
//                    'p_highlight_color' => array(
//                        'type' => 'none',
//                    ),
//                    'p_background_color' => array(
//                        'type' => 'none',
//                    ),
//                    'p_border_color' => array(
//                        'type' => 'none',
//                    ),
//                )
//            ),
        );

        $this->use_styles(array(
//            'background_transparency',
//            'border_radius',
            'margin_top',
            'margin_right',
            'margin_bottom',
            'margin_left',
        ));

    }

    public function shortcode_function($atts, $content)
    {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $border_radius = $this->extract_inline_style('border-radius');

        $bar_inline_style = $this->create_inline_style(array(
            'border-radius' => $border_radius
        ));

        $return_markup = '';
        $GLOBALS['progress_bars'] = array();

        do_shortcode($content);

        $progress_bars = '';

        $index = 1;
        foreach( $GLOBALS['progress_bars'] as $progress_bar ) {

            $style_class = ('striped' == $progress_bar['style'] ? ' progress-striped' : '');

            $progress_bars .= '
                <h6>' . $progress_bar['text'] . '</h6>
                <div id="pbar-' . $index++ . '" class="progress ' . $style_class . '" ' . $bar_inline_style . '>
                    <div role="progressbar" class="progress-bar" data-size="' . $progress_bar['fill'] . '">
                        <div title="' . $progress_bar['fill'] . '%" data-toggle="tooltip" class="inside"></div>
                    </div>
                </div>
            ';

            $index++;

        }

        $return_markup .= '
            <div class="progress-bars" ' . $this->get_inline_styles() . '>
                ' . $progress_bars . '
            </div>'
        ;

        return $return_markup;

    }
}
