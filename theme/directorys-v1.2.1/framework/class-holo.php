<?php

class Holo {

    public function __construct() {

    }

    public static function colors_palettes($selected_palette) {

        $color_palettes = (false !== get_option( 'holo_color_palettes' ) ? get_option( 'holo_color_palettes' ) : array());

        $select_options = '';
        $palettes_markup = '';

        if ( !empty($color_palettes) ) {

            $index = 0;
            foreach ( $color_palettes as $slug => $palette ) {

                $colors_markup = '';
                $selected_palette_class = '';

                foreach ( $palette['colors'] as $color_id => $color ) {

                    $colors_markup .= '
                        <div class="color">
                            <input type="text" class="holo-color-palette-field" value="' . $color['value'] . '" data-opacity="' . $color['opacity'] . '" />
                        </div>
                    ';
                }

                if ($slug == $selected_palette) {

                    $select_options .= '<option value="' . $slug . '" selected>' . $palette['name'] . '</option>';

                    $selected_palette_class = 'holo-selected-palette';

                } else {

                    $select_options .= '<option value="' . $slug . '">' . $palette['name'] . '</option>';

                }

                $palettes_markup .= '
                    <div class="holo-color-palette-wrapper-display ' . $selected_palette_class . ' clearfix" id="' . $slug . '">
                    ' . $colors_markup . '
                    </div>
                ';

                $index++;
            }

            echo '
                <select class="palette-select">
                ' . $select_options . '
                </select>
            ' . $palettes_markup;

        } else {

            echo 'no color palettes';

        }

    }

    public static function get_palette_colors($palette_slug) {

        $color_palettes = (false !== get_option( 'holo_color_palettes' ) ? get_option( 'holo_color_palettes' ) : array());

        return $color_palettes[$palette_slug]['colors'];

    }

    public function icons() {

    }

}