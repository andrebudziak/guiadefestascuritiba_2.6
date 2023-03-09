<?php

class holo_blog extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Blog';
        $this->admin_icon = 'entypo-newspaper';

        $this->attributes = array(
            'posts_per_page' => array(
                'label' => 'Posts Per Page',
                'type' => 'text',
                'default' => 10
            ),
            'categories' => array(
                'label' => 'Post Category',
                'type' => 'multiple_select',
                'options' => $this->get_categories()
            ),
            'tags' => array(
                'label' => 'Post Tags',
                'type' => 'multiple_select',
                'options' => $this->get_tags()
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

        $return_markup = '';
        $posts = '';

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $posts_per_page,
            'paged' => get_query_var('paged')
        );

        global $post;

        $category_array = explode(',', $categories);

        if ($category_array[0] !== 'null') {
            $terms_string = '';

            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category_array
                ),
            );
        }

        if ( $tags !== 'null') {

            $args['tag__in'] = array( $tags );
        }

        $posts_query = new WP_Query($args);

        if ($posts_query->have_posts()) {
            while ($posts_query->have_posts()) {
                $posts_query->the_post();

                $category = get_the_category();

                $comments_number = get_comments_number();
                $comments_string = $comments_number . ' ' . (1 == $comments_number ? __('Comment', THEME_TEXT_DOMAIN) : __('Comments', THEME_TEXT_DOMAIN));

                $author_link = '<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author() . '</a>';
                $date_link = '<span> ' . get_the_date('', $post->ID) . '</span>';
                $category_link = '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->name . '</a>';
                $comments_link = '<a href="' . get_permalink($post->ID) . '#comments">' . $comments_string . '</a>';

                $post_media = holo_get_media_by_post_format($post->ID, 'post_image');

                $posts .= '
                    <div id="post-' . $post->ID . '" class="post">

                        ' . $post_media . '

                        <div class="post-body">
                            <h3><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></h3>
                            <p class="author">
                                ' . __('Posted By', THEME_TEXT_DOMAIN) . ' ' . $author_link . ' / ' . $date_link . ' / ' . $comments_link . '
                            </p>

                            ' . get_the_excerpt() . '
                        </div>
                    </div>
                ';

            }
        }


        $pagination = wpthemess_paginate(array('posts_per_page' => $posts_per_page), $posts_query, false);

        $pagination_markup = '<div class="page-nav">' . $pagination . '</div>';

        $return_markup = '<div class="blog-wrapper">' . $posts . $pagination_markup . '</div>';

        return $return_markup;

    }

    public function get_categories() {

        $args = array(
            'type' => 'post',
            'taxonomy' => 'category',
        );

        $post_categories = get_categories($args);

        $categories = array();

        foreach ($post_categories as $category) {

            $categories[$category->slug] = $category->name;

        }

        return $categories;

    }

    function get_tags() {

        $post_tags = get_tags();

        $tags = array();

        if ( is_array($post_tags) ) {
            foreach ($post_tags as $tag) {

                $tags[$tag->term_id] = $tag->name;

            }
        }

        return $tags;

    }

}
