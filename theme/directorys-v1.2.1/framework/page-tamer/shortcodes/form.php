<?php

class holo_form extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Form';
//        $this->children_class = 'holo_form_field';
        $this->admin_icon = 'entypo-vcard';

        $this->attributes = array(
            'form_style' => array(
                'label' => 'Form Style',
                'type' => 'select',
                'options' => array('style_1' => 'Style 1', 'style_2' => 'Style 2', 'style_3' => 'Style 3')
            ),
            'form_id' => array(
                'label' => 'form',
                'type' => 'select',
                'options' => $this->get_forms_id()
            )
        );

    }

    public function shortcode_function($atts, $content)
    {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $form_style_class = '';

        switch ($form_style) {
            case 'style_1' :

                $return_markup =
                    '<div class="form form-1">

                        ' . do_shortcode('[contact-form-7 id="' . $form_id . '"]') . '

                    </div>';

                break;

            case 'style_2' :

                $return_markup =
                    '<div class="form form-2">

                        ' . do_shortcode('[contact-form-7 id="' . $form_id . '"]') . '

                    </div>';

                break;

            case 'style_3' :

                $return_markup =
                    '<div class="form form-3">
                        ' . do_shortcode('[contact-form-7 id="' . $form_id . '"]') . '
                    </div>';

                break;
        }


        return $return_markup;
    }

    public function get_forms_id() {

        $forms_array = array();

        $args = array(
            'post_type' => 'wpcf7_contact_form',
            'posts_per_page' => -1
        );

        $forms = get_posts($args);

        foreach ( $forms as $form ) {

            $forms_array[$form->ID] = $form->post_title;

        }

        return $forms_array;

    }
}
