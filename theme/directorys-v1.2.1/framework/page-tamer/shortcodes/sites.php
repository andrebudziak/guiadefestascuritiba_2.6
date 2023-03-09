<?php

class holo_sites_posts extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Sites';
        $this->admin_icon = 'entypo-globe';

        $this->attributes = array(
            'sites_per_page' => array(
                'label' => 'Sites Per Page',
                'type' => 'text',
                'default' => 10
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
        global $directorys_options;

        $return_markup = '';
        $events_posts = '';

        if (is_front_page()) {

            $page = get_query_var('page') ? get_query_var('page') : 1;

        } else {

            $page = get_query_var('paged') ? get_query_var('paged') : 1;

        }

        $categories_query = array();
        $locations_query = array();

        $args = array(
            'post_type' => 'site',
            'posts_per_page' => $sites_per_page,
            'paged' => $page,
        );

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

        $sites_query = new WP_Query($args);

        $sites_count = 0;
        if ($sites_query->have_posts()) {
            while ($sites_query->have_posts()) {
                $sites_query->the_post();

                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'site_thumb');

                $contact_fields = get_post_meta($post->ID, 'contact', true);

                $category = wp_get_post_terms($post->ID, 'sites_category');

                if (!empty($category)) {

                    $category_info = get_option('taxonomy_' . $category[0]->term_id);

                    $category_icon = '<img src="' . $category_info['badge'] . '" alt="site badge" />';

                } else {
                    $category_icon = '';
                }

                $address = isset($contact_fields['address']) ? $contact_fields['address'] : array('value' => '');
                $phone = isset($contact_fields['phone']) ? $contact_fields['phone'] : array('value' => '');

                $fallback_thumb = $directorys_options['listings_fallback_featured_image']['url'];
                $fallback_thumb = holo_get_image_by_size($fallback_thumb, 274, 199);

                if (empty($thumbnail)) {
                    $event_thumb ='<img src="' . $fallback_thumb . '">';
                } else {
                    $event_thumb = '<img src="' . $thumbnail[0] . '" alt="site thumbnail">';
                }

                $ratings = holo_get_ratings($post->ID);

                $events_posts .= '
                    <div class="site-wrapper clearfix">
                        <div class="picture">
                            ' . $event_thumb . '
                        </div>
                        <div class="description"><i class="iconstyle">' . $category_icon . '</i>
                            <div class="col-md-9 descriptioninfo">
                                <h5><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h5>
                                <p>' . $address['value'] . '</p>
                                <p>' . $this->get_excerpt_by_id($post->ID, 13) . '</p>
                                <i class="contact-info">' . $phone['value'] . '</i>
                            </div>
                            <div class="col-md-3 rating">
                                ' . $ratings . '
                            </div>
                        </div>
                    </div>
                ';

                $sites_count++;
            }
        }

        $found_posts = $sites_query->found_posts;

        $items_showed_info = holo_get_number_items_show_markup($found_posts, $sites_per_page, $sites_count, $page);

        $return_markup .= '
            <div class="blog-wrapper">
                <div class="recent-places">
                    <div class="post-header clearfix">
                        <div class="posts-show-number">' . $items_showed_info . '</div>
                    </div>

                        ' . $events_posts . '

                </div>
        ';

        $pagination = wpthemess_paginate(array('posts_per_page' => $sites_per_page), $sites_query, false);

        $return_markup .= '<div class="page-nav clearfix">' . $pagination . '</div></div>';

        return $return_markup;

    }

    public function get_excerpt_by_id($post_id, $length = 35){

//        $the_post = get_post($post_id); //Gets post ID
//        $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
//        $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images

        $the_excerpt = get_the_excerpt();
        $words = explode(' ', $the_excerpt, $length + 1);

        if(count($words) > $length) :
            array_pop($words);
            array_push($words, '…');
            $the_excerpt = implode(' ', $words);
        endif;

        return $the_excerpt;

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
