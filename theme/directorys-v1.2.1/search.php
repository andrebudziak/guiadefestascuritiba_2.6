<?php
/**
 * Search Template
 */

get_header();

if ( get_query_var('search_post_type') ) {

    $search_post_type = get_query_var('search_post_type');

    $wp_query->query['post_type'] = $search_post_type;

    query_posts( $wp_query->query );

    if($search_post_type == 'place') {

        $wp_query->query['post_type'] = 'site';

        query_posts( $wp_query->query );

        get_template_part('templates/search/place');

    }

} else {

    $wp_query->query['post_type'] = 'post';

    query_posts( $wp_query->query );

    get_template_part('templates/search/posts');

}

get_footer();