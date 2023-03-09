<?php

class holo_media extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Media';
        $this->admin_icon = 'entypo-video';

        $this->image_size = $this->get_size_options();

        $array = $this->get_size_options();
        reset($array);

        $this->default = key($array);

        $this->attributes = array(
            'type' => array(
                'label' => 'Media Type',
                'type' => 'select',
                'options' => array('image' => 'Image', 'video' => 'Video', 'audio' => 'Audio'),
                'default' => 'image'
            ),
            'image' => array(
                'label' => 'Image',
                'type' => 'upload',
                'dependencies' => array('type' => 'image')
            ),
            'size' => array(
                'label' => 'Images Size',
                'type' => 'select',
                'options' => $this->image_size,
                'default' => $this->default,
                'dependencies' => array('type' => 'image')
            ),
//            'video' => array(
//                'label' => 'Video',
//                'type' => 'textarea',
//                'default' => 'Here goes your video iframe',
//                'dependencies' => array('type' => 'video')
//            ),
//            'audio' => array(
//                'label' => 'SoundCloud Embed',
//                'type' => 'textarea',
//                'default' => 'Here goes your audio link',
//                'description' => 'Insert the link from the SoundCloud',
//                'dependencies' => array('type' => 'audio')
//            )
        );

        $this->content = array(
            'label' => 'Video/Audio Iframe',
            'type' => 'textarea',
            'description' => 'Insert the iframe here',
            'dependencies' => array('type' => 'audio')
        );

        $this->use_styles(array(
            'margin_top',
            'margin_bottom',
            'margin_right',
            'margin_left',
        ));

    }

    public function shortcode_function($atts, $content)
    {
        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $return_markup = '';

        switch ( $type ) {

            case 'image' :

                if ($size = 'full') {

                    $thumb_url = $image;

                } else {

                    $image_size = $this->get_image_sizes( $size );

                    $thumb_url = holo_get_image_by_size($image, $image_size['width'], $image_size['height']);

                }

                $return_markup = '
                    <div class="thumb" style="position: relative; width: ' . $image_size['width'] . 'px;">
                        <a class="overlay mgp-img" href="' . $image . '">
                            <i class="fa fa-search md"></i>
                        </a>
                        <img src="' . $thumb_url . '" class="img-responsive" alt="image thumbnail">
                    </div>
                ';

                break;
            case 'video' :

                $return_markup = '<div class="video-frame box">' .   $content . '</div>';

                break;
            case 'audio' :

                $return_markup = '<div class="player">' . $content . '</div>';

                break;

        }

        return $return_markup;
    }

    public function get_size_options() {

        global $_wp_additional_image_sizes;

        $image_sizes = array('full' => 'Full Size');

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
