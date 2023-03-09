<?php


class holo_divider extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Divider';
        $this->admin_icon = 'entypo-minus';

        $this->attributes = array(
            'type' => array(
                'label' => 'Divider Type',
                'type' => 'select',
                'options' => array('type1' => 'Type 1', 'type2' => 'Type 2', 'type3' => 'Type 3', 'type4' => 'Type 4', 'type5' => 'Type 5'),
                'default' => 'type1'
            ),
        );

        $this->content = array(
            'label' => 'Title',
            'type' => 'text'
        );

        $this->use_styles(array(
            'margin_top',
            'margin_bottom',
        ));

    }

    public function shortcode_function($atts, $content)
    {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $return_markup = $this->get_styles_markup();

        switch ( $type ) {
            case 'type1' :

                $return_markup .=
                    '<div id="' . $this->unique_id . '" class="divider divider-1">
                        <h1>' . $content . '</h1><div class="separator"></div>
                    </div>
                ';

                break;
            case 'type2' :

                $return_markup .= '
                    <div id="' . $this->unique_id . '" class="divider divider-2">
                        <h1>' . $content . '</h1><div class="separator"></div>
                    </div>
                ';

                break;
            case 'type3' :

                $return_markup .= '
                    <div id="' . $this->unique_id . '" class="divider divider-3">
                        <h1>' . $content . '</h1><div class="separator"></div>
                    </div>
                ';

                break;
            case 'type4' :

                $return_markup .= '
                    <div id="' . $this->unique_id . '" class="divider divider-4">
                        <h1>' . $content . '</h1><div class="separator"></div>
                    </div>
                ';

                break;
            case 'type5' :

                $return_markup .= '
                    <div id="' . $this->unique_id . '" class="divider divider-5">
                        <h1>' . $content . '</h1><div class="separator"></div>
                    </div>
                ';

                break;
        }

//        $return_markup = '
//            <div class="sep heading container">
//                <h4>' . $content . '</h4>
//            </div>
//        ';

        return $return_markup;

    }
}