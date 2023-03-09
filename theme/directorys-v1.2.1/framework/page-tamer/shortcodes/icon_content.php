<?php

class holo_icon_content extends Holo_Abstract_Shortcodes {

    public function __construct() {
        parent::__construct();

        $this->name = 'Icon Content';
        $this->admin_icon = 'entypo-info-circled';

        $this->attributes = array(
            'icon_position' => array(
                'label' => 'Icon Position',
                'type' => 'select',
                'options' => array('top' => 'Top', 'left' => 'Left'),
                'default' => 'left'
            ),
            'icon' => array(
                'label' => 'Icon',
                'type' => 'icon',
            ),
            'icon_size' => array(
                'label' => 'Icon Size',
                'type' => 'slider',
                'default' => 60
            ),
            'icon_color' => array(
                'label' => 'Icon Color',
                'type' => 'color'
            ),
            'badge_background' => array(
                'label' => 'Badge Color',
                'type' => 'color'
            ),
            'badge_border_width' => array(
                'label' => 'Badge Border Width',
                'type' => 'slider',
                'default' => 1
            ),
            'badge_border_color' => array(
                'label' => 'Badge Border Color',
                'type' => 'color',
                'default' => '#ccc'
            ),
            'badge_border_radius' => array(
                'label' => 'Badge Border Radius',
                'type' => 'text',
                'default' => 50
            ),
            'title' => array(
                'label' => 'Title',
                'type' => 'text'
            ),
            'link_type' => array(
                'label' => 'Link Type',
                'type' => 'select',
                'options' => array('normal_link' => 'Normal Link', 'listings_link' => 'Generate Listings Category Link'),
                'default' => 'normal_link'
            ),
            'link' => array(
                'label' => 'Link',
                'type' => 'text',
                'dependencies' => array('link_type' => 'normal_link')
            ),
            'category' => array(
                'label' => 'Category',
                'type' => 'select',
                'options' => $this->get_categories(),
                'dependencies' => array('link_type' => 'listings_link')
            )
        );

        $this->use_styles(array(
            'margin_top',
            'margin_right',
            'margin_bottom',
            'margin_left',
            'padding_top',
            'padding_right',
            'padding_bottom',
            'padding_left'
        ));

        $this-> content = array(
            'label' => 'Content',
            'type' => 'editor',
            'description' => 'list content'
        );
    }

    public function shortcode_function($atts, $content)
    {
        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $content = ht_remove_unpaired_p($content);

        $unique_id = $this->unique_id;

        $return_markup = '';
        $icon_style = '';

        $padding_top = $this->extract_inline_style('padding-top');
        $padding_right = $this->extract_inline_style('padding-right');
        $padding_bottom = $this->extract_inline_style('padding-bottom');
        $padding_left = $this->extract_inline_style('padding-left');

        $left_padding = ( (int)$padding_left !== 0 ? $padding_left : ($icon_size + 15) . 'px' );

        $text_inline_style = $this->create_inline_style(array(
            'padding-top' => $padding_top,
            'padding-right' => $padding_right,
            'padding-bottom' => $padding_bottom,
            'padding-left' => $left_padding
        ));

        $font_size = $icon_size * 0.5;

        $icon_style = $this->create_inline_style(array(
           'font-size' =>  $font_size . 'px',
            'width' => $icon_size . 'px',
            'height' => $icon_size . 'px',
            'line-height' => $icon_size . 'px',
            'color' => $icon_color,
            'background-color' => $badge_background,
            'border-width' => $badge_border_width . 'px',
            'border-color' => $badge_border_color,
            'border-style' => 'solid',
            'border-radius' => $badge_border_radius . 'px'
        ));

        if ($link_type == 'normal_link') {

            if (!empty($link)) {
                $title = '<a href="' . $link . '">' . $title . '</a>';
            }

        } else {

            $link = $this->get_category_link($category);

            $title = '<a href="' . $link . '">' . $title . '</a>';

        }

        if ($icon_position == 'top') {

            $return_markup = '
                <div id="' . $unique_id . '" class="icon-content top-icon clearfix" ' . $this->get_inline_styles() . '>
                    <div class="icon-badge">
                        <i class="' . $icon . ' circled" ' . $icon_style . '></i>
                    </div>
                    <div class="text">
                        <h4>' . $title . '</h4>
                        ' . $content . '
                    </div>
                </div>
            ';

        } else {

            $return_markup = '
                <div id="' . $unique_id . '" class="icon-content clearfix" ' . $this->get_inline_styles() . '>
                    <div class="pull-left">
                        <i class="' . $icon . ' circled" ' . $icon_style . '></i>
                    </div>
                    <div class="text" ' . $text_inline_style . '>
                        <h4>' . $title . '</h4>
                        ' . $content . '
                    </div>
                </div>
            ';

        }

        return $return_markup;

    }

    function get_categories() {

        $args = array(
            'type' => 'site',
            'taxonomy' => 'sites_category',
        );

        $post_categories = get_categories($args);

        $categories = array();

        foreach ($post_categories as $category) {

            $categories[$category->slug] = $category->name;

        }

        return $categories;

    }

    function get_category_link($category_slug) {

        $link = '';
        $permalink_structure = get_option( 'permalink_structure' );

        switch($permalink_structure) {

            case '/%postname%/' :
                $link = get_home_url() . '/sites_category/' . $category_slug . '/?post_type=site';
                break;

            case '/archives/%post_id%' :
                $link = get_home_url() . '/archives/sites_category/' . $category_slug . '/?post_type=site';
                break;

            case '/%year%/%monthnum%/%postname%/' :
                $link = get_home_url() . '/sites_category/' . $category_slug . '/?post_type=site';
                break;

            case '/%year%/%monthnum%/%day%/%postname%/' :
                $link = get_home_url() . '/sites_category/' . $category_slug . '/?post_type=site';
                break;

            default :
                $link = get_home_url() . '?post_type=site&sites_category=' . $category_slug;
                break;

        }

        return $link;

    }

}
