<?php

class holo_button extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Button';
        $this->show_as_model = true;
        $this->admin_icon = 'entypo-progress-3';

        $this->attributes = array(
            'type' => array(
                'label' => 'Button Style',
                'type' => 'select',
                'options' => array('solid' => 'Solid', 'empty' => 'Empty'),
                'default' => 'solid'
            ),
            'size' => array(
                'label' => 'Button Size',
                'type' => 'select',
                'options' => array('small' => 'Small', 'medium' => 'Medium', 'large' => 'Large'),
                'default' => 'medium'
            ),
            'color' => array(
                'label' => 'Color',
                'type' => 'color',
                'default' => '#ccc'
            ),
            'icon' => array(
                'label' => 'Icon',
                'type' => 'icon',
                'default' => '',
                'dependencies' => array('type' => 'solid')
            ),
            'link' => array(
                'label' => 'Button link',
                'id' => 'button_link',
                'type' => 'text',
                'default' => ''
            ),
            'new_tab' => array(
                'label' => 'Open link in new tab',
                'type' => 'checkbox',
                'default' => ''
            )
        );

        $this->use_styles(array(
            'float',
            'margin_top',
            'margin_right',
            'margin_bottom',
            'margin_left',
        ));

        $this->content = array(
            'label' => 'Text',
            'type' => 'text',
            'default' => 'Button'
        );

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        switch ($size) {
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

        $target = (1 === (int)$new_tab) ? ' target="_blank"' : '';
        $icon = $icon !== '' ? '<i class="' . $icon . '"></i> ' : '';

        if ( $type == 'solid' ) {

            $this->add_inline_style(array(
                'background-color' => $color
            ));

            $hover_style = '#' . $this->unique_id . ':hover { background-color: ' . blend_alpha(hex2rgb($color)) . ' }';

            $returnContent = $this->get_styles_markup($hover_style);

            $returnContent .= '
                <a id="' . $this->unique_id . '" class="button solid ' . $size . '" href="' . $link . '" ' . $target . '>
                    ' . $icon . '' . $content . '
                </a>
            ';

        } else {

            $this->add_inline_style(array(
                'background-color' => 'transparent',
                'border' => '1px solid ' . $color,
                'color' => $color
            ));

            $returnContent = $this->get_styles_markup();

            $returnContent .= '<a class="button striped ' . $size . '" href="' . $link . '" ' . $this->get_inline_styles() . '' . $target . '>' . $content . '</a>';

        }

        return $returnContent;

    }

}