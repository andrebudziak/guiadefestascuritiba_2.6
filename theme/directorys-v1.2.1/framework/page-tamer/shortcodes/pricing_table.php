<?php

class holo_pricing_table extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Pricing Table';
        $this->children_class = 'holo_pricing_table_row';
        $this->admin_icon = 'entypo-cc-nc';

        $this->attributes = array(
            'title' => array(
                'label' => 'Table Title',
                'type' => 'text'
            ),
            'price' => array(
                'label' => 'Price',
                'type' => 'text'
            ),
            'currency' => array(
                'label' => 'Currency',
                'type' => 'text'
            ),
            'payment_type' => array(
                'label' => 'Payment Type',
                'type' => 'text'
            ),
            'highlight' => array(
                'label' => 'Highlighted Table',
                'type' => 'checkbox'
            ),
            'link' => array(
                'label' => 'Link',
                'type' => 'text'
            ),
            'button_label' => array(
                'label' => 'Button Label',
                'type' => 'text',
                'default' => 'Buy'
            ),
            'button_type' => array(
                'label' => 'Button Style',
                'type' => 'select',
                'options' => array('solid' => 'Solid', 'empty' => 'Empty'),
                'default' => 'solid'
            ),
            'button_size' => array(
                'label' => 'Button Size',
                'type' => 'select',
                'options' => array('small' => 'Small', 'medium' => 'Medium', 'large' => 'Large'),
                'default' => 'medium'
            ),
            'button_icon' => array(
                'label' => 'Icon',
                'type' => 'icon',
                'default' => '',
                'dependencies' => array('type' => 'solid')
            ),
            'new_tab' => array(
                'label' => 'Open link in new tab',
                'type' => 'checkbox',
                'default' => ''
            )
        );

        $this->use_styles(array(
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

        $return_markup = '';
        $rows = '';
        $GLOBALS['pricing_table_rows'] = array();

        do_shortcode($content);

        foreach ( $GLOBALS['pricing_table_rows'] as $pricing_table_row ) {

            $rows .= '<div class="field">' . $pricing_table_row['content'] . '</div>';

        }

        if ( !empty($link) ) {

            $icon = $button_icon !== '' ? '<i class="' . $button_icon . '"></i> ' : '';
            $target = (1 === (int)$new_tab) ? ' target="_blank"' : '';

            switch ($button_size) {
                case 'small' :
                    $size = 'sm';
                    break;
                case 'medium' :
                    $size = 'md';
                    break;
                case 'large' :
                    $size = 'lg';
                    break;
            }

            if ( $button_type == 'solid' ) {

                $table_link = '
                    <a class="button solid grey ' . $size . '" href="' . $link . '" ' . $target . '>
                        ' . $icon . '' . $button_label . '
                    </a>
                ';

            } else {

                $table_link = '<a class="button striped grey ' . $size . '" href="' . $link . '" ' . $target . '>' . $button_label . '</a>';

            }

//            $table_link = '<a href="' . $link . '" class="button solid grey sm" ' . $target . '><div class="over">' . $button_label . '</div></a>';

        } else {
            $table_link = '';
        }

        $highlight_class = (1 === (int)$highlight ? ' highlight' : '');

        $inline_style = $this->get_styles_markup();

        $return_markup .= $inline_style;

        $return_markup .= '
            <div class="pricing table ' . $highlight_class . '" id="' . $this->unique_id . '">
                <div class="head"><h4>' . $title . '</h4></div>
                <div class="price">

                    <div class="amount">
                        ' . $price . '
                        <div class="unit">' . $currency . '</div>
                    </div>
                    <h5>' . $payment_type . '</h5>
                </div>

                ' . $rows . '

                ' . $table_link . '
            </div>
        ';

        return $return_markup;
    }

}
