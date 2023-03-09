<?php

class holo_row extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Row';
        $this->show_as_model = false;

        $this->attributes = array(
            'boxed' => array(
                'label' => 'Box Wrap',
                'type' => 'checkbox',
                'description' => 'Wrap the content from this row with a customizable box'
            )

        );

        $this->use_styles(array(
            'margin_top',
            'margin_bottom',
            'padding_top',
            'padding_bottom',
            'border_top',
            'border_bottom',
            'border_left',
            'border_right',
        ));

        $this->content = array(
            'type' => 'hidden',
        );

    }

    public function shortcode_function($atts, $content)
    {
        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $this->add_inline_style(array('position' => 'relative'));

        if ($border_top == 1) {
            $this->add_inline_style(array('border-top-width' => '1px'));
        }

        if ($border_bottom == 1) {
            $this->add_inline_style(array('border-bottom-width' => '1px'));
        }

        if ($border_left == 1) {
            $this->add_inline_style(array('border-left-width' => '1px'));
        }

        if ($border_right == 1) {
            $this->add_inline_style(array('border-right-width' => '1px'));
        }

        $return_markup = '';

        $unique_id = $this->unique_id;

        if (!empty($unique_id)) {
            $row_id = 'id="' . $unique_id . '"';
        } else {
            $row_id = '';
        }

        if ( 0 === (int)$boxed ) {
            $return_markup .= '
                <div ' . $row_id . ' class="content"' . $this->get_inline_styles() . '>
                    <div class="row">
                        ' . do_shortcode($content) . '
                    </div>
                </div>
            ';
        } else {
            $return_markup .='
                <div ' . $row_id . ' class="content box-wrap"' . $this->get_inline_styles() . '>
                    <div class="row">
                        ' . do_shortcode($content) . '
                    </div>
                </div>
            ';
        }

        return $return_markup;

    }

}