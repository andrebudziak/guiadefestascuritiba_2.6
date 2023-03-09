<?php
//todo: attach markup for tablet and phone screen in accordion type
//todo: add required options
//todo: add required variables in the shortcode markup

class holo_latest_posts extends Holo_Abstract_Shortcodes {

    public function __construct() {

        parent::__construct();

        $this->name = 'Latest Posts';
        $this->admin_icon = 'entypo-menu';

        $this->attributes = array(
            'type' => array(
                'label' => 'Type',
                'type' => 'select',
                'options' => array('list' => 'List', 'grid' => 'Grid', 'accordion' => 'Accordion'),
                'default' => 'list'
            ),
            'max_posts' => array(
                'label' => 'Number of displayed posts',
                'type' => 'text',
                'default' => 4
            ),
            'columns' => array(
                'label' => 'Number Of Columns',
                'type' => 'text',
                'dependencies' => array('type' => 'grid'),
                'default' => 4
            ),
            'categories' => array(
                'label' => 'Post Category',
                'type' => 'multiple_select',
                'options' => $this->get_categories()
            )
        );

        $this->use_styles(array(
            'margin_top',
            'margin_bottom',
            'margin_right',
            'margin_left',
        ));

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

    public function get_excerpt_by_id($post_id, $length = 35){
        $the_post = get_post($post_id); //Gets post ID
        $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
        $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
        $words = explode(' ', $the_excerpt, $length + 1);

        if(count($words) > $length) :
            array_pop($words);
            array_push($words, '…');
            $the_excerpt = implode(' ', $words);
        endif;

        return $the_excerpt;
    }

    public function shortcode_function($atts, $content)
    {
        $this->register_attributes($atts);

        extract($this->get_registered_attributes());

        $border_radius = $this->extract_inline_style('border-radius');

        $thumb_inline_styles = $this->create_inline_style(array(
            'border-radius' => $border_radius
        ));

        global $post;

        $return_markup = '';
        $posts = '';

        if ($type == 'accordion') { $max_posts = 3; }

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $max_posts,
        );

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

        $posts_array = get_posts($args);

        $args = array(
            'type' => 'post',
            'taxonomy' => 'category',
        );

        $author_link = '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author() . '</a>';

        switch ( $type ) {

            case 'list' :
                foreach ( $posts_array as $post ) {

//                    $excerpt = apply_filters('get_the_excerpt', $post->post_excerpt);

                    $posts .= '
                        <div class="col-sm-12 post">
                            <div class="date pull-left">
                                <div class="day bold main-text-color">' . get_the_date('d') . '</div>
                                <div class="bold month alt-text-color main-bg-color">' . get_the_date('M') . '</div>
                            </div>
                            <div class="text">
                                <h5 class="medium"><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></h5>
                                <p class="comments italic comments">' . get_comments_number() . ' ' . __('comments', THEME_TEXT_DOMAIN) . '</p>
                                <p>
                                    ' . $this->get_excerpt_by_id($post->ID) . '
                                    <span class="main-text-color"><a class="read-more" href="' . get_permalink($post->ID) . '">Read More </a><i class="fa fa-play-circle-o"></i> </span>
                                </p>
                            </div>
                        </div>
                    ';
                }

                $return_markup .= '<div class="row"' . $this->get_inline_styles() . '>' . $posts . '</div>';

                break;
            case 'grid' :

                foreach ( $posts_array as $post ) {

                    $categories = get_the_category($post->ID);

                    if (!empty($categories)) {

                        $category = array_shift($categories);

                        $category_link_markup = ', in <a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';

                    } else {
                        $category_link_markup = '';
                    }

                    $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                    $post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'preview_gallery');

                    if ( !empty($post_thumb) ) {
                        $post_image = '<img src="' . $post_thumb[0] . '" class="img-responsive" alt="post image" />';
                    } else {
                        $post_image = '';
                    }

                    $random = rand(100, 999);

                    $posts .= '
                        <div class="col-md-' . (12 / $columns) . ' col-sm-6">
                            <div class="post-thumb">
                                <div class="photo"  ' . $thumb_inline_styles . '>
                                    <a href="' . $full_image[0] . '" class="overlay mgp-img">
                                        <i class="fa-search md"></i>
                                    </a>
                                    ' . $post_image . '
                                </div>
                                <div class="text">
                                    <h5>' . get_the_title() . '</h5>
                                    <p class="italic info"><a>' . get_the_date('d M') . '</a>, By ' . $author_link . $category_link_markup . '</p>
                                    <p>' . $this->get_excerpt_by_id($post->ID, 13) . '</p>
                                    <p class="main-text-color"><a class="read-more" href="' . get_permalink($post->ID) . '">Read More </a><i class="fa fa-play-circle-o"></i> </p>
                                </div>
                            </div>
                        </div>
                    ';
                }

                $return_markup .= '<div class="row post-accordion"' . $this->get_inline_styles() . '>' . $posts . '</div>';

                break;
            case 'accordion' :

                foreach ( $posts_array as $post ) {

                    $categories = get_the_category($post->ID);

                    if (!empty($categories)) {

                        $category = array_shift($categories);

                        $category_link_markup = ', in <a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';

                    } else {
                        $category_link_markup = '';
                    }

                    $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                    $post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'preview_gallery');

                    if ( !empty($post_thumb) ) {
                        $post_image = '<img src="' . $post_thumb[0] . '" class="img-responsive" alt="post thumbnail" />';
                    } else {
                        $post_image = '';
                    }

                    $posts .= '
                        <div class="col-md-6 element" style="position: absolute; top: 0px; float: none;">
                            <div class="row">
                                <a href="' . $full_image[0] . '" class="col-xs-6 mgp-img">
                                    <div class="post-thumb">
                                        <div class="photo" ' . $thumb_inline_styles . '>
                                            <div class="overlay">
                                                <i class="fa-search md"></i>
                                            </div>
                                            ' . $post_image . '
                                        </div>
                                    </div>
                                </a>

                                <div class="col-xs-6">
                                    <div class="post-thumb">
                                        <div class="text">
                                            <h5>' . get_the_title() . '</h5>
                                            <p class="italic info"><a>' . get_the_date('d M') . '</a>, By ' . $author_link . $category_link_markup . '</p>
                                            <p>' . $this->get_excerpt_by_id($post->ID, 13) . '</p>
                                            <p class="main-text-color"><a class="read-more" href="' . get_permalink($post->ID) . '">Read More </a><i class="fa fa-play-circle-o"></i> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }

                $return_markup .= '
                    <div id="#post-accordion-1" class="post-acc"' . $this->get_inline_styles() . '>
                        <div class="elements row hidden-sm hidden-xs">
                        ' . $posts . '
                        </div>
                    </div>
                    ';

                break;

        }

        wp_reset_postdata();

        return $return_markup;

    }
}
