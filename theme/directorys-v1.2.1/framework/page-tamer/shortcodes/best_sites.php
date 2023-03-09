<?php

class holo_best_sites_posts extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Best sites';
        $this->admin_icon = 'entypo-location';

        $this->attributes = array(
            'max_sites' => array(
                'label' => 'Number of displayed sites',
                'type' => 'text',
                'default' => 3
            ),
            'columns' => array(
                'label' => 'Number of columns',
                'type' => 'select',
                'options' => array(
                    '3' => 3,
                    '4' => 4
                ),
                'default' => 3
            ),
            'featured_sites' => array(
                'label' => 'Only displays featured listings',
                'type' => 'checkbox',
                'default' => 0
            ),
            'categories' => array(
                'label' => 'Post Category',
                'type' => 'multiple_select',
                'options' => $this->get_categories()
            ),
            'locations' => array(
                'label' => 'Post Locations',
                'type' => 'multiple_select',
                'options' => $this->get_locations()
            )
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

        global $post;

        $return_markup = '';
        $events_posts = '';

        $args = array(
            'post_type' => 'site',
            'posts_per_page' => $max_sites
        );

        if ($featured_sites && $featured_sites == 1) {

            $args['meta_query'] = array(
                array(
                    'key' => 'holo_site_featured',
                    'value' => '1',
                )
            );

        }

        if ($categories !== 'null' && !empty($categories)) {

            $category_array = explode(',', $categories);

            $categories_query = array(
                'taxonomy' => 'sites_category',
                'field' => 'slug',
                'terms' => $category_array
            );

            $args['tax_query'][] = $categories_query;
        }

        if ($locations !== 'null' && !empty($locations)) {

            $locations_array = explode(',', $locations);

            $locations_query = array(
                'taxonomy' => 'sites_location',
                'field' => 'slug',
                'terms' => $locations_array
            );

            $args['tax_query'][] = $locations_query;
        }

        if ( isset($args['tax_query']) && count($args['tax_query']) > 1) {
            $args['tax_query']['relation'] = 'OR';
        }

        $sites = get_posts($args);

        $rows_number = ceil($max_sites / $columns);

        $events_posts .= '<div class="row">';

        $index = 1;
        foreach ($sites as $post) {

            setup_postdata($post);

            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'best_site_thumb');

            $contact_fields = get_post_meta($post->ID, 'contact', true);

            $address = isset($contact_fields['address']) ? $contact_fields['address'] : array('value' => '');

            $category = wp_get_post_terms($post->ID, 'sites_category');

            if (!empty($category)) {

                $category_info = get_option('taxonomy_' . $category[0]->term_id);

                $category_icon = '<img src="' . $category_info['badge'] . '" alt="badge" />';

            } else {
                $category_icon = '';
            }

            if (empty($thumbnail)) {
                $event_thumb = '';
            } else {
                $event_thumb = '<img src="' . $thumbnail[0] . '" alt="site thumbnail" />';
            }

            $ratings = holo_get_ratings($post->ID);

            $col_size = 12 / $columns;

            $events_posts .= '
                <div class="col-md-' . $col_size . ' site">
                    <div class="picture">
                        ' . $event_thumb . '
                    </div>
                    <div class="info">
                        <i class="iconstyle">' . $category_icon . '</i>
                        <h5><a href="' . get_the_permalink() . '">' . get_the_title($post->ID) . '</a></h5>
                        <p>' . $address['value'] . '</p>

                        ' . $ratings . '
                    </div>
                </div>
            ';

            if ( ($index % $columns) == 0 ) {

                $events_posts .= '</div><div class="row">';

            }

            $index++;

        }

        $events_posts .= '</div>';

        $return_markup .= '
            <div class="site-wrapper best-sites">
                ' . $events_posts . '
            </div>
        ';

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

    function get_locations() {

        $args = array(
            'type' => 'site',
            'taxonomy' => 'sites_location',
        );

        $post_categories = get_categories($args);

        $categories = array();

        foreach ($post_categories as $category) {

            $categories[$category->slug] = $category->name;

        }

        return $categories;

    }

}
