<?php

class holo_content_box extends Holo_Abstract_Shortcodes {

    function __construct() {

        parent::__construct();

        $this->name = 'Content Box';
        $this->admin_icon = 'entypo-credit-card';

        $this->attributes = array(
            'type' => array(
                'label' => 'Type',
                'type' => 'select',
                'options' => array('type_1' => 'Type 1', 'type_2' => 'Type 2', 'type_3' => 'Type 3'),
                'default' => 'type_1'
            ),
            'highlighted' => array(
                'label' => 'Highlighted',
                'type' => 'checkbox',
                'dependencies' => array('type' => 'type_3')
            ),
            'title' => array(
                'label' => 'Title',
                'type' => 'text',
                'default' => 'Title',
                'dependencies' => array('type' => 'type_1')
            ),
            'heading' => array(
                'label' => 'Heading',
                'type' => 'text',
                'default' => 'Here Goes the Heading'
            ),
            'icon' => array(
                'label' => 'Icon',
                'type' => 'icon',
                'default' => '',
            ),
            'link' => array(
                'label' => 'Link',
                'type' => 'text',
                'default' => 'http://holobest.com'
            ),
            'new_tab' => array(
                'label' => 'Open In New Tab?',
                'type' => 'checkbox',
                'default' => 0
            ),
            'image' => array(
                'label' => 'Image',
                'type' => 'upload',
                'default' => '',
                'dependencies' => array('type' => 'type_1')
            ),
            'last_box' => array(
                'label' => 'Last Box',
                'type' => 'checkbox',
                'default' => '',
                'dependencies' => array('type' => 'type_3')
            )
//            'background_image' => array(
//                'label' => 'Background Image',
//                'type' => 'upload',
//                'default' => '',
//                'dependencies' => array('type' => 'type_2')
//            ),
//            'box_background_color' => array(
//                'label' => 'Background Color',
//                'type' => 'color',
//                'default' => '',
//                'dependencies' => array('type' => 'type_2')
//            ),
//            'box_background_transparency' => array(
//                'label' => 'Background Transparency',
//                'type' => 'slider',
//                'min' => 0,
//                'max' => 1,
//                'step' => 0.1,
//                'default' => 0.5,
//                'dependencies' => array('type' => 'type_2')
//            )
        );

        $this->use_styles(array(
            'background_image',
            'background_color',
            'background_transparency',
            'margin_top',
            'margin_right',
            'margin_bottom',
            'margin_left'
        ));

        $this->content = array(
            'label' => 'Content',
            'type' => 'textarea',
            'default' => 'Here goes the content'
        );

    }

    public function shortcode_function($atts, $content)
    {
        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $inline_styles = $this->get_styles_markup();

        $new_tab_attr = ( (int)$new_tab === 1 ? 'target="_blank"' : '' );

        $return_markup = $inline_styles;

        switch ( $type ) {

            case 'type_1' :

                $return_markup .= '
                    <div class="feature-box">
                        <div class="head">
                            <img src="' . $image . '" class="img-responsive" alt="image" />
                            <span class="box-title">' . $title . '</span>
                        </div>
                        <div class="body text-center">
                            <h5><a href="' . $link . '" ' . $new_tab_attr . '>' . $heading . '</a></h5>
                            <p>' . $content . '</p>
                        </div>
                    </div>
                ';

                break;
            case 'type_2' :

                $background_markup = $this->get_background();

                $return_markup .= '
                    <div class="card">

                        ' . $background_markup . '

                        <div class="content-wrapper">
                            <div class="top">
                                <i class="' . $icon . ' alt-text-color pull-left"></i>
                                <h4 class="alt-text-color light">' . $heading . '</h4>
                            </div>
                            <p class="alt-text-color">' . $content . '</p>
                        </div>

                        <a href="' . $link . '" ' . $new_tab_attr . '>
                            <div class="button light"><div class="over"></div>+</div>
                        </a>
                    </div>
                ';

                break;

            case 'type_3' :

                $link_markup = '';
                $icon_markup = '';
                $arrow_markup = '';

                if (1 === (int)$highlighted) {

                    $link_markup = '<h6 class="alt-text-color"><a class="read-more" href="' . $link . '" ' . $new_tab_attr . '>Read More</a> <i class="fa fa-right-circled2"></i> </h6>';

                    $highlight_class = ' highlight';

                }
                else {

                    $icon_markup = '<i class="' . $icon . ' alt-text-color"></i>';

                }

                if ( $last_box == 'undefined' ) {
                    $arrow_markup = '<div class="arrow hidden-sm hidden-xs"></div>';
                }

                $return_markup .= '
                    <div class="box-8' . $highlight_class . '">
                        ' . $icon_markup . '
                        <h5 class="box-heading">' . $heading . '</h5>
                        <p>' . $content . '</p>
                        ' . $link_markup . '
                        ' . $arrow_markup . '
                    </div>
                ';

                break;

        }

        return $return_markup;

    }

}
