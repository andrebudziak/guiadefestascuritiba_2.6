<?php

class holo_message_box extends Holo_Abstract_Shortcodes {

    function __construct() {

        parent::__construct();

        $this->name = 'Message Box';
        $this->admin_icon = 'entypo-info';

        $this->attributes = array(
            'type' => array(
                'label' => 'Type',
                'type' => 'select',
                'options' => array('error' => 'Error', 'thumbs_up' => 'Thumbs Up', 'warning' => 'Warning', 'success' => 'Success'),
                'default' => ''
            )
        );

        $this->use_styles(array(
            'margin_top',
            'margin_right',
            'margin_bottom',
            'margin_left',
            'padding_top',
            'padding_right',
            'padding_bottom',
            'padding_left'
        ));

        $this->content = array(
            'label' => 'Message',
            'type' => 'textarea',
            'default' => ''
        );

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $message_class = '';

        $inline_style = $this->get_styles_markup();

        switch ( $type ) {

            case 'error' :

                $message_class = 'alert-danger';
                $icon = '<i class="fa fa-attention-circled pull-left"></i>';

                break;
            case 'thumbs_up' :

                $message_class = 'alert-info';
                $icon = '<i class="fa fa-thumbs-up pull-left"></i>';

                break;
            case 'warning' :

                $message_class = 'alert-warning';
                $icon = '<i class="fa fa-attention pull-left"></i>';

                break;
            case 'success' :

                $message_class = 'alert-success';
                $icon = '<i class="fa fa-info pull-left"></i>';

                break;

        }

        $return_markup = $inline_style . '
            <div class="alert ' . $message_class . '" id="' . $this->unique_id . '">
                ' . $icon . '
                <div class="text">' . $content . '</div>
            </div>'
        ;

        return $return_markup;

    }

}