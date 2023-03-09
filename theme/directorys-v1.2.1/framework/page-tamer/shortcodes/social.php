<?php

class holo_social extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Social Icons';

        $this->attributes = array(
            'social_icons' => array(
                'label' => 'Social Icons',
                'type' => 'social'
            )
        );

        $this->use_styles(array(
            'margin_top',
            'margin_right',
            'margin_bottom',
            'margin_left'
        ));

    }

    public function shortcode_function($atts, $content)
    {
        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $return_markup = '';
        $socials = explode(',', $social_icons);

        foreach( $socials as $social_icon) {

            $values = explode('|', $social_icon);

            $return_markup .= '<a href="' . $values[1] . '" class="' . $values[0] . '" title="" data-toggle="tooltip" data-original-title="Benjamin on Facebook"> <i class="fa fa-' . $values[0]. '"></i> </a>';

        }

//        $return_markup = $socials[0];

//        foreach( ${$social} as $social_icon ) {
//
//            $return_markup .= ' ' . $social_icon;
//
//        }

        return $return_markup;
    }

}
