<?php

class holo_gallery extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Gallery';
        $this->admin_icon = 'entypo-picture';

        $this->image_size = $this->get_size_options();

        $array = $this->get_size_options();
        reset($array);

        $this->default = key($array);

        $this->attributes = array(
            'type' => array(
                'label' => 'Type',
                'type' => 'select',
                'options' => array('default' => 'Default', 'with_preview' => 'With Preview')
            ),
            'images_on_row' => array(
                'label' => 'Number Of Images on a row',
                'type' => 'text',
                'default' => 4
            ),
            'gallery' => array(
                'label' => 'Gallery Images',
                'type' => 'gallery'
            ),
            'size' => array(
                'label' => 'Images Size',
                'type' => 'select',
                'options' => $this->image_size,
                'default' => $this->default
            )
        );

        $this->use_styles(array(
            'margin_top',
            'margin_bottom'
        ));

    }

    public function shortcode_function($atts, $content) {

        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $inline_styles = $this->get_styles_markup();

        $gallery_items = array();
        $return_markup = '';
        $images = '';
        $preview_image = '';

        $gallery_data_array = explode(',', $gallery);

        foreach ( $gallery_data_array as $image_data ) {
            $gallery_items[] = $image_data;
        }

        do_shortcode($content);

        switch ( $type ) {

            case 'default' :

                $index = 1;
                foreach ( $gallery_items as $image_data ) {

                    $image_data_array = explode('|', $image_data);

                    $image_url = $image_data_array[0];

                    if ( $index % ($images_on_row + 1) === 0 ) {
                        $images .= '<div class="row">';
                    }

                    if ($image_url) {

                        $image_size = $this->get_image_sizes( $size );

                        $thumb_url = holo_get_image_by_size($image_url, $image_size['width'], $image_size['height']);

                        $image_caption = $image_data_array[1];

                        $images .= '
                            <div class="col-sm-' . 12 / $images_on_row . ' col-xs-12">
                                <div title="" data-toggle="tooltip" class="item" data-original-title="' . $image_caption . '">
                                    <a href="' . $image_url . '" class="overlay image-gallery mgp-img">
                                        <i class="fa fa-search md"></i>
                                    </a>
                                    <img class="img-responsive" src="' . $thumb_url . '" alt="thumbnail" />
                                </div>
                            </div>
                        ';

                    }

                    if ( $index % $images_on_row === 0 ) {
                        $images .= '</div>';
                    }


                }

                $return_markup = $inline_styles . '
                    <div class="standard gallery clearfix" id="' . $this->unique_id . '">
                        <div class="row">
                            ' . $images . '
                        </div>
                    </div>
                ';

                break;

            case 'with_preview' :

                $index = 1;
                foreach ( $gallery_items as $image_data ) {

                    $image_data_array = explode('|', $image_data);

                    $image_url = $image_data_array[0];

                    $thumb_url = holo_get_image_by_size($image_url, 150, 150);
                    $preview_url = holo_get_image_by_size($image_url, 555, 403);

                    $image_caption = $image_data_array[1];

                    $images .= '
                        <div class="frame" data-toggle="tooltip" data-placement="bottom" data-preview="' . $preview_url . '" title="gallery">
                            <div class="image">
                                <a class="overlay">
                                    <i class="fa fa-search sm"></i>
                                </a>
                                <img src="' . $thumb_url . '" alt="preview image">
                            </div>
                        </div>
                    ';

                    $index++;

                }

                $return_markup = $inline_styles . '
                    <div class="gallery preview" id="' . $this->unique_id . '">
                        <div class="navigation">
                            <div class="thumb">
                                <div class="img-container">
                                    <div class="images clearfix">
                                        ' . $images . '
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                ';

                break;

        }

        return $return_markup;

    }

    public function get_size_options() {

        global $_wp_additional_image_sizes;

        $image_sizes = array();

        $registered_image_sizes = get_intermediate_image_sizes();

        foreach ( $registered_image_sizes as $size_name) {

            if ( !is_null($_wp_additional_image_sizes) && !empty($_wp_additional_image_sizes[$size_name]) ) {

                $image_size = $_wp_additional_image_sizes[$size_name]['width'] . 'x' . $_wp_additional_image_sizes[$size_name]['height'];

                $image_sizes[$size_name] = $size_name . ' (' . $image_size . ')';

            } else {

                $image_sizes[$size_name] = $size_name;

            }

        }

        unset($image_sizes['medium']);
        unset($image_sizes['large']);

        return $image_sizes;

    }

    public function get_image_sizes( $size = '' ) {

        global $_wp_additional_image_sizes;

        $sizes = array();
        $get_intermediate_image_sizes = get_intermediate_image_sizes();

        // Create the full array with sizes and crop info
        foreach( $get_intermediate_image_sizes as $_size ) {

            if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

                $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
                $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
                $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

            } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                $sizes[ $_size ] = array(
                    'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                    'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                    'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
                );

            }

        }

        // Get only 1 size if found
        if ( $size ) {

            if( isset( $sizes[ $size ] ) ) {
                return $sizes[ $size ];
            } else {
                return false;
            }

        }

        return $sizes;
    }

}