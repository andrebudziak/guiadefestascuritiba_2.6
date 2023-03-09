<?php

class holo_persons extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Persons';
        $this->children_class = 'holo_person';
        $this->admin_icon = 'entypo-users';

        $this->attributes = array();

        $this->use_styles(array(
            'margin_top',
            'margin_right',
            'margin_bottom',
            'margin_left'
        ));

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $border_radius = $this->extract_inline_style('border-radius');

        $icons_array = array(
            'facebook' => 'fa-facebook',
            'twitter' => 'fa-twitter',
            'google_plus' => 'fa-gplus',
            'dribbble' => 'fa-dribbble',
            'vimeo' => 'fa-vimeo-squared',
            'skype' => 'fa-skype',
            'linkedin' => 'fa-linkedin',
            'pinterest' => 'fa-pinterest-circled',
        );

        $person_inline_style = $this->create_inline_style(array(
           'border-radius' => $border_radius
        ));

        $GLOBALS['persons'] = array();
        $return_markup = '';
        $persons = '';
        $columns = 1;

        do_shortcode($content);

        if ( !empty($GLOBALS['persons'])) {
            $rows = floor(12 / count($GLOBALS['persons']));
        }

        foreach ( $GLOBALS['persons'] as $person ) {

            $social_markup = '';
            $target = (1 === (int)$person['new_tab']) ? ' target="_blank"' : '';

            if ( !empty($person['social']) ) {
                $social_links = explode(',', $person['social']);

                foreach( $social_links as $social_link ) {

                    $social_icon = explode('|', $social_link);

                    $social_markup .= '
                        <a href="' . $social_icon[1] . '" class="' . $social_icon[0] . '" title="' . $person['name'] . ' on ' . $social_icon[0] . '" target="_blank" data-toggle="tooltip">
                            <i class="fa ' . $icons_array[$social_icon[0]] . '"></i>
                        </a>
                    ';

                }
            }

            $persons .= '
                <div class="col-sm-' . $rows . '">
                    <div class="person" ' . $person_inline_style . '>
                        <div class="photo" style="border-radius: inherit">
                            <div class="overlay">
                                <div class="socials">
                                ' . $social_markup . '
                                </div>
                            </div>

                            <img class="img-responsive" src="' . $person['image'] . '" style="border-radius: inherit" alt="person image" />
                        </div>

                        <div class="details">
                            <h5 class="medium name">' . $person['name'] . '</h5>
                            <p class="italic title">' . $person['job'] . '</p>
                            <p>' . $person['description'] . '<span class="main-text-color"><a class="read-more" href="' . $person['link'] . '" ' . $target . '>Read More </a><i class="fa fa-right-circled2"></i></span> </p>
                        </div>
                    </div>
                </div>
            ';

        }

        $return_markup = '<div class="row" ' . $this->get_inline_styles() . '>' . $persons . '</div>';

        return $return_markup;

    }

}
