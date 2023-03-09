<?php

class holo_testimonials extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Testimonials';
        $this->children_class = 'holo_testimonial';
        $this->admin_icon = 'entypo-quote';

        $this->attributes = array(
            'style' => array(
                'label' => 'Testimonials Style',
                'type' => 'select',
                'id' => 'testimonials_style',
                'options' => array('sidebar' => 'Sidebar', 'listed' => 'Listed'),
                'default' => 'sidebar'
            ),
            'title' => array(
                'label' => 'Testimonials Title',
                'type' => 'text',
                'id' => 'testimonials_title',
                'default' => '',
                'placeholder' => 'Testimonials title goes here',
                'dependent_on' => 'style',
                'dependent_value' => array('sidebar')
            ),
//            'sidebar_background_image' => array(
//                'label' => 'Testimonials Background',
//                'type' => 'upload',
//                'id' => 'testimonials_background',
//                'dependencies' => array('style' => 'sidebar'),
//                'default' => ''
//            ),
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
            'background_image',
            'background_repeat',
            'background_color',
            'background_transparency',
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

        $GLOBALS['testimonials'] = array();
        $return_markup = '';
        $testimonials = '';
        $indicators = '';

        $inline_styles = $this->get_styles_markup();

        do_shortcode($content);

        $background_markup = $this->get_background();

        switch ($style) {

            case 'sidebar' :

                if ( is_array($GLOBALS['testimonials']) ) {

                    $index = 1;
                    foreach ($GLOBALS['testimonials'] as $testimonial) {

                        ( $index === 1 ) ? $active_class = ' active' : $active_class = '';

                        $author_image = holo_get_image_by_size($testimonial['author_image'], '150', '150');

                        $testimonials .= '
                            <div class="item' . $active_class . '">
                                <div class="top">
                                    <div style="position: relative">
                                        <div class="head alt-text-color">
                                            ' . $title . '
                                        </div>
                                        <span class="italic alt-text-color">' . $testimonial['message'] . '</span>
                                    </div>
                                </div>
                                <div class="bot">
                                    <h5 class="main-text-color medium">' . $testimonial['author_name'] . '</h5>
                                    <p>' . $testimonial['author_job'] . '</p>
                                    <div class="avatar">
                                        <img src="' . $author_image . '" width="57px" height="57px" />
                                    </div>
                                </div>
                            </div>
                        ';

                        $indicators .= '<li class="item" data-slide-to="' . $index . '" data-target="#' . $this->unique_id . '"></li>';

                        $index++;

                    }
                }

                $return_markup = ''
                    . $inline_styles .
                    '<div id="' . $this->unique_id . '" class="carousel slide carousel-fade testimonials-1" data-ride="carousel">
                        <div class="carousel-inner">
                            ' . $background_markup . '

                            ' . $testimonials . '

                        </div>
                    </div>

                    <ol class="test-1 carousel-indicators indicators">
                        ' . $indicators . '
                    </ol>
                ';

                break;
            case 'listed' :

                $border_radius = $this->extract_inline_style('border-radius');

                $text_inline_style = $this->create_inline_style(array(
                    'border-radius' => $border_radius
                ));

                if ( is_array($GLOBALS['testimonials']) ) {
                    foreach ($GLOBALS['testimonials'] as $testimonial) {

                        $author_image = holo_get_image_by_size($testimonial['author_image'], '150', '150');

                        $testimonials .= '
                            <div class="item">
                                <div class="text" ' . $text_inline_style . '>';

                        if ($testimonial['message']) {
                            $testimonials .= '<p class="italic">"' . $testimonial['message'] . '"</p>';
                        }

                        if ($testimonial['author_image']) {
                            $testimonials .= '
                                <div class="avatar">
                                    <img src="' . $author_image . '" width="56px" height="56px" />
                                </div>';
                        }

                        $testimonials .= '
                            </div>
                                <div class="client">
                                    <h5 class="main-text-color medium">' . $testimonial['author_name'] . '</h5>
                                    <p>' . $testimonial['author_job'] . '</p>
                                </div>
                            </div>
                        ';
                    }
                }

                $return_markup = $inline_styles . '<div id="' . $this->unique_id . '" class="testimonials-2">' . $background_markup . '' . $testimonials . '</div>';

                break;

        }

        return $return_markup;
    }

}
